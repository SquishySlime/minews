<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PublicPostController extends Controller
{
    // Daftar berita publish
    public function index()
    {
        $posts = Post::where('status', 'published')->orderByDesc('created_at')->with(['author', 'category'])->paginate(8);
        return view('public.posts.index', compact('posts'));
    }

    // Detail berita
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->with(['author', 'category'])->firstOrFail();
        return view('public.posts.show', compact('post'));
    }
}
