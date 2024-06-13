@extends('layouts.adm-main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Kategori</div>
                    <div class="card-body">
                        <form action="{{ route('kategori.update', $rsetKategori->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <input type="text" name="deskripsi" value="{{ $rsetKategori->deskripsi }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <select name="kategori" class="form-control" required>
                                    @foreach ($aKategori as $key => $value)
                                        <option value="{{ $key }}" {{ $rsetKategori->kategori == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-md btn-warning">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection