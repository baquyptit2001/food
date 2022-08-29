<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function index(): \Inertia\Response
    {
        $news = NewsResource::collection(News::all()->sortByDesc("id"));
        return Inertia::render('Client/News/Index', compact('news'));
    }

    public function show(News $news): \Inertia\Response
    {
        return Inertia::render('Client/News/Show', [
            'news' => new NewsResource($news),
        ]);
    }
}
