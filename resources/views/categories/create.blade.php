@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1 class="mb-4 fw-bold text-start">Tambah Kategori</h1>

            <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-4 shadow-sm rounded-3">
                @csrf
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">Simpan</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary w-100">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
