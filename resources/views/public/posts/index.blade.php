@extends('layouts.app')
@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="fw-bold mb-4 text-start">Berita Terbaru</h1>
            <div class="row g-4">
                @forelse($posts as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="bg-white shadow-sm rounded-3 h-100 d-flex flex-column p-0 overflow-hidden position-relative">
                        @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" class="w-100" style="max-height:180px;object-fit:cover;" alt="{{ $post->title }}">
                        @endif
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h5 class="fw-semibold mb-1">{{ $post->title }}</h5>
                            <div class="mb-2 text-muted small">{{ $post->category->name }} | {{ $post->author->name }}</div>
                            <p class="mb-2 small">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                            <a href="{{ route('public.posts.show', $post->slug) }}" class="mt-auto btn btn-primary btn-sm w-100 fw-semibold">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 d-flex flex-column align-items-center mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#adb5bd" class="mb-3" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.383V5.383zm-.034 7.434-5.966-3.584-5.966 3.584A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.183zM1 5.383v6l4.708-3.175L1 5.383z"/>
                    </svg>
                    <div class="alert alert-info small rounded-pill px-4">Belum ada berita.</div>
                </div>
                @endforelse
            </div>
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
<style>
.bg-white.shadow-sm:hover {
    box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,.10)!important;
    border-color: #0d6efd22;
}
</style>
@endsection
