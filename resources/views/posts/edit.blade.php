@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <h1 class="mb-4 fw-bold text-start">Edit Berita</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded-3">
                <input type="hidden" name="slug" value="{{ old('slug', $post->slug) }}">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                                <div class="form-group mb-3">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="category_id">Kategori</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                <div class="form-group mb-3">
                    <label for="image">Ganti Gambar (Opsional)</label>
                    @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" width="120" class="mb-2 d-block"/>
                    @endif
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="form-group mb-3">
                    <label for="content">Isi Berita</label>
                    <textarea class="form-control" name="content" rows="6" required>{{ old('content', $post->content) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update Berita</button>
            </form>
        </div>
    </div>
</div>
@endsection
