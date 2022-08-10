<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(): \Inertia\Response
    {
        $categories = Category::where('parent_id', null)->with('children')->get();
        return Inertia::render('Client/Home/Index', [
            'categories' => $categories,
        ]);
    }
}
