@extends('layouts.adm-main')

@section('content')
    <section class="hero py-5">
        <div class="container text-center">
            <h1 class="font-weight-bold">SISTEM INFORMASI BARANG</h1>
            <p>Selamat Datang di Sistem Inventory Silahkan Pilih Menu Dibawah!</p>
            <!-- <a href="#features" class="btn btn-primary">Learn More</a> -->
        </div>
    </section>

    <hr>

    <section id="features" class="features py-5">
        <div class="container">
            <div class="row mt-4 d-flex">
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold">Kategori</h4>
                            <p class="flex-grow-1">Manage categories</p>
                            <a href="{{ route('kategori.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Kategori</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold">Barang</h4>
                            <p class="flex-grow-1">Manage items</p>
                            <a href="{{ route('barang.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Barang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold">Barang Masuk</h4>
                            <p class="flex-grow-1">Track incoming items</p>
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Barang Masuk</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold">Barang Keluar</h4>
                            <p class="flex-grow-1">Track outgoing items</p>
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Barang Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection