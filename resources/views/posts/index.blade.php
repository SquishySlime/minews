@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar Berita</h1>
        @if(Auth::user()->role === 'wartawan')
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Tambah Berita</a>
        @endif
    </div>
    <table class="table table-bordered table-striped w-100 mb-0">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name ?? '-' }}</td>
                                <td>
                                    @if($post->status == 'draft')
                                        <span class="badge bg-warning">Draft</span>
                                    @else
                                        <span class="badge bg-success">Publish</span>
                                    @endif
                                </td>
                                <td>{{ $post->author->name ?? '-' }}</td>
                                <td>
                                    @if($post->image)
                                        <img src="{{ asset('storage/'.$post->image) }}" width="60"/>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    @if(Auth::user()->id == $post->author_id || Auth::user()->role == 'admin')
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                    @if(Auth::user()->role == 'editor' && $post->status == 'draft')
                                        <form action="{{ route('posts.approve', $post->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
