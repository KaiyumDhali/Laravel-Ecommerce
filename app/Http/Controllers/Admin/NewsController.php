<?php

// app/Http/Controllers/Admin/NewsController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\CompanyInfo;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('image')?->store('news', 'public');

        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('image')?->store('news', 'public');

        $news->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path ?? $news->image,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return back()->with('success', 'News deleted successfully.');
    }


    public function detai_show($id){
        $news = News::findOrFail($id);
        $company_info = CompanyInfo::first();
        $categories = Category::withCount('products')->get();
        return view('newsdetails', compact('news','company_info','categories'));
    }
}
