<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $news = News::all();
        return Inertia::render('Admin/News/Index', [
            'news' => NewsResource::collection($news),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/News/Create');
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
        $news = new News();
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/news'), $imageName);
                $news->image = $imageName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('Image upload failed');
            }
        }
        $news->title = $request->title;
        $news->description = $request->description;
        $news->save();
        return redirect()->route('admin.news.index')->with('success', 'News created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return Response
     */
    public function edit(News $news): Response
    {
        return Inertia::render('Admin/News/Edit', [
            'news' => NewsResource::make($news),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param News $news
     * @return RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
        if ($request->hasFile('image')) {
            try {
                if ($news->image) {
                    unlink(public_path('images/news/' . $news->image));
                }
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/news'), $imageName);
                $news->image = $imageName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('Image upload failed');
            }
        }
        $news->title = $request->title;
        $news->description = $request->description;
        $news->save();
        return redirect()->route('admin.news.index')->with('success', 'News updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return RedirectResponse
     */
    public function destroy(News $news): RedirectResponse
    {
        try {
            $news->delete();
            return redirect()->route('admin.news.index')->with('success', 'News deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('News deletion failed');
        }
    }
}
