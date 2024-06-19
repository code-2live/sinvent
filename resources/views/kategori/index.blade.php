@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row justify-content-center"> <!-- Center-align the content -->
            <div class="col-md-12">
                <div class="pull-left">
                    <h2>DAFTAR KATEGORI</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('Gagal'))
                        <div class="alert alert-danger mt-3">
                            {{session('Gagal')}}
                        </div>
                    @endif
                    <form action="{{ route('kategori.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
                    <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</a>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rsetKategori as $kategori)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $kategori->deskripsi }}</td>
                                    <td>{{ $kategori->kategori }}</td>
                                    <td>{{ $kategori->ketKategori }}</td>
                                    <td>
                                        <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>

                                        <!-- Form untuk handle delete -->
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $rsetKategori->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
        </div>
    </div>
@endsection
