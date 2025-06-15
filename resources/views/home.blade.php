@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Dashboard Admin</h1>
    </div>
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Selamat Datang</h3>
                    <p>{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-6">
                    <div class="card">
                        <div class="card-header">
                            Informasi
                        </div>
                        <div class="card-body">
                            <p>Anda login sebagai <strong>{{ Auth::user()->email }}</strong></p>
                            <p>Role: <span class="badge badge-secondary">Admin</span></p>
                            <p>Gunakan menu di sidebar untuk mengelola data portal berita.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
