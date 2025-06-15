@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar Komentar</h1>
    </div>
    <table class="table table-bordered table-striped w-100 mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Email</th>
                <th>Komentar</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $comment->user->name ?? '-' }}</td>
                <td>{{ $comment->user->email ?? '-' }}</td>
                <td>{{ $comment->content }}</td>
                <td>{{ $comment->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada komentar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
