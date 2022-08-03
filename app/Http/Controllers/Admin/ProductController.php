<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $products = Product::all();
        return Inertia::render("Admin/Product/Index", [
            'products' => ProductResource::collection($products),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $categories = \App\Models\Category::where('parent_id', null)->with('children')->get();
        return Inertia::render("Admin/Product/Create", [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
        ]);
        $product = new Product();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $product->image = $name;
        } else {
            return Redirect::back()->withErrors(['image' => 'Image is required']);
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->save();
        return Redirect::route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product): Response
    {
        $categories = \App\Models\Category::where('parent_id', null)->with('children')->get();
        return Inertia::render("Admin/Product/Edit", [
            'product' => ProductResource::make($product),
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
        ]);
        dd($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $product->image = $name;
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->save();
        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
