<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\TinhResource;
use App\Http\Resources\UserInfoResource;
use App\Models\Cart;
use App\Models\Quan;
use App\Models\Tinh;
use App\Models\UserInfo;
use App\Models\Xa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['quan', 'xa']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $carts = Cart::where('user_id', auth()->id())->orderBy('updated_at', 'desc')->get();
        return Inertia::render('Client/Cart/Index', [
            'carts' => CartResource::collection($carts),
        ]);
    }

    public function update(Request $request, Cart $cart): \Illuminate\Http\RedirectResponse
    {
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->route('client.carts.index');
    }

    public function checkout(): Response
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        $tinhs = Tinh::all();
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->quantity * $cart->product->price;
        }
        $addressList = UserInfo::where('user_id', auth()->id())->orderBy('is_default', 'desc')->get();
        return Inertia::render('Client/Cart/Checkout', [
            'tinhs' => $tinhs,
            'carts' => CartResource::collection($carts),
            'total' => $total,
            'addresses' => UserInfoResource::collection($addressList),
        ]);
    }

    public function quan($matp): \Illuminate\Http\JsonResponse
    {
        $quans = Quan::where('matp', $matp)->get();
        return response()->json($quans);
    }

    public function xa($maqh): \Illuminate\Http\JsonResponse
    {
        $xa = Xa::where('maqh', $maqh)->get();
        return response()->json($xa);
    }

    public function addAddress(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'receiver' => 'required',
            'phone' => 'required|numeric',
            'matp' => 'required',
            'maqh' => 'required',
            'xaid' => 'required',
        ]);

        $user = auth()->user();
        $userInfo = new UserInfo();
        $userInfo->user_id = $user->id;
        $userInfo->address = $request->address;
        $userInfo->receiver = $request->receiver;
        $userInfo->phone = $request->phone;
        $userInfo->matp = $request->matp;
        $userInfo->maqh = $request->maqh;
        $userInfo->xaid = $request->xaid;
        if (UserInfo::where('user_id', $user->id)->count() == 0) {
            $userInfo->is_default = true;
        }
        $userInfo->save();
        return redirect()->route('client.carts.checkout');
    }

    public function deleteAddress(UserInfo $address): \Illuminate\Http\RedirectResponse
    {
        $address->delete();
        return redirect()->route('client.carts.checkout');
    }

    public function setDefaultAddress(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();
        $address = UserInfo::where([
            ['user_id', $user->id],
            ['is_default', 1]
        ])->first();
        if ($address) {
            $address->is_default = 0;
            $address->save();
        }
        $address = UserInfo::find($request->id);
        $address->is_default = 1;
        $address->save();
        return redirect()->route('client.carts.checkout');
    }


    public function updateAddress(Request $request, UserInfo $address): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'address' => 'required',
            'receiver' => 'required',
            'phone' => 'required|numeric',
            'matp' => 'required',
            'maqh' => 'required',
            'xaid' => 'required',
        ]);
        $address->address = $request->address;
        $address->receiver = $request->receiver;
        $address->phone = $request->phone;
        $address->matp = $request->matp;
        $address->maqh = $request->maqh;
        $address->xaid = $request->xaid;
        $address->save();
        return redirect()->route('client.carts.checkout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);
        $cart = Cart::where([
            ['user_id', auth()->id()],
            ['product_id', $request->product_id]
        ])->first();
        if ($cart) {
            $cart->quantity += $request->quantity;
        } else {
            $cart = new Cart();
            $cart->user_id = auth()->id();
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
        }
        $cart->save();
        return Redirect::back();
    }
}
