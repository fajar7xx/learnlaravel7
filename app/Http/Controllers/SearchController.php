<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post(Request $request)
    {
        // return $request->all();
        $keyword = $request->keyword;
        $posts = Post::where('title', 'LIKE', "%$keyword%")->latest()->paginate(6);

        // return $post;
        return view('posts.index', compact('posts'));
    }
}
