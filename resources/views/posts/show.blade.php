@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4 fw-bold text-start">Detail Berita</h1>
            <div class="bg-white p-4 shadow-sm rounded-3 mb-4">
                <h3 class="fw-semibold mb-2">{{ $post->title }}</h3>
                <div class="mb-2 text-muted small">
                    <span class="me-3"><b>Kategori:</b> {{ $post->category->name ?? '-' }}</span>
                    <span class="me-3"><b>Status:</b> <span class="badge {{ $post->status == 'draft' ? 'bg-warning' : 'bg-success' }}">{{ ucfirst($post->status) }}</span></span>
                    <span><b>Author:</b> {{ $post->author->name ?? '-' }}</span>
                </div>
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" alt="Gambar Berita" class="rounded mb-3 d-block mx-auto" style="max-width:100%;max-height:320px;object-fit:cover;">
                @endif
                <div class="mb-3"><b>Isi Berita:</b></div>
                <div class="mb-4" style="white-space:pre-line">{!! nl2br(e($post->content)) !!}</div>
                <div class="d-flex flex-column flex-md-row gap-2">
    <a href="{{ route('posts.index') }}" class="btn btn-secondary w-100">Kembali</a>
    @if((Auth::user()->role == 'editor' || Auth::user()->role == 'admin') && $post->status == 'draft')
        <form action="{{ route('posts.approve', $post->id) }}" method="POST" class="w-100">
            @csrf
            <button class="btn btn-success w-100" onclick="return confirm('Approve berita ini?')">Approve</button>
        </form>
    @endif
</div>

{{-- Komentar Section --}}
<div class="mt-5">
    <h5 class="mb-3">Komentar</h5>
    @auth
        <form action="{{ url('/posts/'.$post->id.'/comments') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-2">
                <textarea name="content" class="form-control" rows="3" placeholder="Tulis komentar..." required>{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
        </form>
    @else
        <div class="alert alert-info">Silakan <a href="{{ route('login') }}">login</a> untuk menulis komentar.</div>
    @endauth
    <div class="bg-light p-3 rounded-3">
        @forelse($post->comments as $comment)
            <div class="mb-3 pb-3 border-bottom">
                <div class="fw-semibold">{{ $comment->user->name ?? 'User' }} <span class="text-muted small">&bull; {{ $comment->created_at->diffForHumans() }}</span></div>
                <div>{{ $comment->content }}</div>
            </div>
        @empty
            <div class="text-muted">Belum ada komentar.</div>
        @endforelse
    </div>
</div>
            </div>
        </div>
    </div>
</div>

@endsection
