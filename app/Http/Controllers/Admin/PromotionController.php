<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $promotions = Promotion::all();
        return Inertia::render('Admin/Promotions/Index', [
            'promotions' => PromotionResource::collection($promotions),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Promotions/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'minimum_price' => 'nullable|numeric',
            'maximum_discount' => 'nullable|numeric',
            'maximum_uses' => 'nullable|numeric',
            'type' => 'required|boolean',
        ]);
        $promotion = new Promotion();
        $promotion->name = $request->name;
        $promotion->description = $request->description;
        $promotion->discount = $request->discount;
        $promotion->start_date = date('Y-m-d', strtotime($request->start_date));
        $promotion->end_date = date('Y-m-d', strtotime($request->end_date));
        $promotion->minimum_price = $request->minimum_price;
        $promotion->maximum_discount = $request->maximum_discount;
        $promotion->maximum_uses = $request->maximum_uses;
        $promotion->type = $request->type;
        $promotion->save();
        return redirect()->route('admin.promotions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Promotion $promotion
     * @return Response
     */
    public function edit(Promotion $promotion): Response
    {
        return Inertia::render("Admin/Promotions/Edit", [
            "promotion" => PromotionResource::make($promotion)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Promotion $promotion
     * @return RedirectResponse
     */
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'minimum_price' => 'nullable|numeric',
            'maximum_discount' => 'nullable|numeric',
            'maximum_uses' => 'nullable|numeric',
            'type' => 'required|boolean',
        ]);
        $promotion->name = $request->name;
        $promotion->description = $request->description;
        $promotion->discount = $request->discount;
        $promotion->start_date = date('Y-m-d', strtotime($request->start_date));
        $promotion->end_date = date('Y-m-d', strtotime($request->end_date));
        $promotion->minimum_price = $request->minimum_price;
        $promotion->maximum_discount = $request->maximum_discount;
        $promotion->maximum_uses = $request->maximum_uses;
        $promotion->type = $request->type;
        $promotion->save();
        return redirect()->route('admin.promotions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
