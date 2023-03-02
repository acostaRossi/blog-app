<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

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

    public function newComment($id, Request $request)
    {
        if(!$request->session()->get('logged')) {
            return false;
        }

        $user = $request->session()->get('user');

        $comment = $request->input("comment");

        $comment = Comment::create([
            'user_id' => $user->id,
            'news_id' => $id,
            'comment' => $comment
        ]);

        $options = [
          'cluster' => env('PUSHER_APP_CLUSTER'),
          'useTLS' => false
        ];

        $app_key = env("PUSHER_APP_KEY");
        $app_secret = env("PUSHER_APP_SECRET");
        $app_id = env("PUSHER_APP_ID");

        $pusher = new \Pusher\Pusher($app_key, $app_secret, $app_id, $options);

        $comment['user_name'] = $user->name;

        $pusher->trigger('post-' . $id, 'new-comment', $comment);

        return $comment;
    }

    public function getCommentsByNews($id)
    {
        $comments = News::find($id)->comments()->with("user")->get();

        foreach($comments as $c) {
            $c['humanDate'] = $c->created_at->diffForHumans();
        }

        return $comments;
    }
}
