<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\NewsResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use stdClass;

class HomeController extends Controller
{
    public function index(): \Inertia\Response
    {
        $categories = CategoryResource::collection(Category::where('parent_id', null)->with('children')->get());
        $products = ProductResource::collection(Product::orderBy('id', 'desc')->take(4)->get());
        return Inertia::render('Client/Home/Index', compact('categories', 'products'));
    }

    public function search($search): \Illuminate\Http\JsonResponse
    {
        $products = Product::where('name', 'like', '%' . $search . '%')->take(5)->get();
        $news = News::where('title', 'like', '%' . $search . '%')->take(5)->get();
        $return = new StdClass();
        $return->products = ProductResource::collection($products);
        $return->news = NewsResource::collection($news);
        return response()->json($return);
    }
}
