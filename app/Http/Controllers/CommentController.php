<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, \App\Models\Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $comment = new \App\Models\Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->author = auth()->user()->name;
        $comment->post_id = $post->id;
        $comment->save();
        return redirect()->route('posts.show', $post->id)->with('success', 'Komentar berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
