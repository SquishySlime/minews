@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Kategori</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $category->slug }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ $category->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate</th>
                            <td>{{ $category->updated_at }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
