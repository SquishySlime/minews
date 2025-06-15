@extends('layouts.app')
@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-white p-4 shadow-sm rounded-3 mb-4">
                <h1 class="fw-bold mb-3">{{ $post->title }}</h1>
                <div class="mb-2 text-muted small">
                    <span class="me-3"><b>Kategori:</b> {{ $post->category->name ?? '-' }}</span>
                    <span class="me-3"><b>Penulis:</b> {{ $post->author->name ?? '-' }}</span>
                    <span><b>Tanggal:</b> {{ $post->created_at->format('d M Y') }}</span>
                </div>
                @if($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="Gambar Berita" class="rounded mb-3 d-block mx-auto" style="max-width:100%;max-height:320px;object-fit:cover;">
                @endif
                <div class="mb-4" style="white-space:pre-line">{!! $post->content !!}</div>
                <a href="{{ route('public.posts.index') }}" class="btn btn-secondary w-100">Kembali ke Berita</a>
            </div>
        </div>
    </div>
</div>
@endsection
