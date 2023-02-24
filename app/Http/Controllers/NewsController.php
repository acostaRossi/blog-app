<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
    	$mainNews = News::orderBy('created_at', 'desc')->limit(1)->get()->first();

    	$news = News::orderBy('created_at', 'desc')->limit(10)->offset(1)->get();

        return view('news', [
        	'mainNews' => $mainNews,
            'news' => $news
        ]);
    }

    public function getNews($id)
    {
    	$news = News::find($id);

    	return view('news-detail', [
            'news' => $news
    	]);
    }

    public function getNewsByCategory($category)
    {
        $category = Category::find($category);

        $news = $category->news;

    	return view('news-by-category', [
            'news' => $news,
            'category' => $category
    	]);
    }

    public function getCategories() {

        return Category::all();
    }

    public function doComment(Request $request)
    {

    }
}
