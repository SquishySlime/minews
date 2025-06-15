@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <h1 class="mb-4 fw-bold text-start">Buat Berita Baru</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded-3">
                @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="category_id">Kategori</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="content">Isi Berita</label>
                                    <textarea class="form-control" name="content" rows="6" required>{{ old('content') }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="image">Unggah Gambar</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Simpan Draft</button>
            </form>
        </div>
    </div>
</div>
@endsection
