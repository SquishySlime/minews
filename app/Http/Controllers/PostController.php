<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Admin dan editor bisa lihat semua, wartawan hanya berita sendiri
        if (auth()->user()->role == 'wartawan') {
            $posts = \App\Models\Post::where('author_id', auth()->id())->with(['category', 'author'])->get();
        } else {
            $posts = \App\Models\Post::with(['category', 'author'])->get();
        }
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya wartawan yang bisa create
        if (auth()->user()->role !== 'wartawan') {
            abort(403);
        }
        $categories = \App\Models\Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'wartawan') {
            abort(403);
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Generate slug otomatis
        $slug = \Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (\App\Models\Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }
        $post = \App\Models\Post::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'status' => 'draft',
            'author_id' => auth()->id(),
        ]);
        return redirect()->route('posts.index')->with('success', 'Berita berhasil disimpan sebagai draft.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = \App\Models\Post::with(['category', 'author'])->findOrFail($id);
        // Wartawan hanya bisa lihat berita sendiri
        if (auth()->user()->role == 'wartawan' && $post->author_id != auth()->id()) {
            abort(403);
        }
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = \App\Models\Post::findOrFail($id);
        // Wartawan hanya bisa edit berita sendiri
        if (auth()->user()->role == 'wartawan' && $post->author_id != auth()->id()) {
            abort(403);
        }
        $categories = \App\Models\Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = \App\Models\Post::findOrFail($id);
        if (auth()->user()->role == 'wartawan' && $post->author_id != auth()->id()) {
            abort(403);
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }
        $post->title = $validated['title'];
        $post->slug = $validated['slug'];
        $post->category_id = $validated['category_id'];
        $post->content = $validated['content'];
        $post->save();
        return redirect()->route('posts.index')->with('success', 'Berita berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = \App\Models\Post::findOrFail($id);
        if (auth()->user()->role == 'wartawan' && $post->author_id != auth()->id()) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Approve post (editor only)
     */
    public function approve($id)
    {
        if (!in_array(auth()->user()->role, ['editor', 'admin'])) {
            abort(403);
        }
        $post = \App\Models\Post::findOrFail($id);
        $post->status = 'published';
        $post->save();
        return redirect()->route('posts.index')->with('success', 'Berita berhasil di-publish.');
    }
}
