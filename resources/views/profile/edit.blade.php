@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Edit Profil</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-4 text-center">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/'.Auth::user()->profile_photo) }}" alt="Foto Profil" class="rounded-circle mb-2" style="width:90px;height:90px;object-fit:cover;">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-inline-flex justify-content-center align-items-center mb-2" style="width:90px;height:90px;font-size:2.2rem;">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>
                    @endif
                    <div class="mt-2">
                        <input type="file" name="profile_photo" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted">Format: jpg, png. Maks 2MB. Opsional</small>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password Baru <small>(kosongkan jika tidak ganti)</small></label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary">Update Profil</button>
            </form>

        </div>
    </div>

</div>
@endsection
