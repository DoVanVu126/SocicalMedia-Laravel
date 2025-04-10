<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy các bài viết mới nhất
        $posts = Post::with('user')->orderBy('CreatedAt', 'desc')->get();

        return view('home', compact('posts'));
    }
}
