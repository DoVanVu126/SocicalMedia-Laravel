<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
        ->orderBy('created_at', 'desc') // Sắp xếp giảm dần theo thời gian tạo
        ->get();

        return view('home', compact('posts'));
    }

}
