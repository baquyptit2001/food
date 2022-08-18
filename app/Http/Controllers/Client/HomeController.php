<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(): \Inertia\Response
    {
        $categories = CategoryResource::collection(Category::where('parent_id', null)->with('children')->get());
        $products = ProductResource::collection(Product::orderBy('id', 'desc')->take(4)->get());
        return Inertia::render('Client/Home/Index', compact('categories', 'products'));
    }
}
