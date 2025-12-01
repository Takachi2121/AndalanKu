@extends('user.shop.index')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/stuff/main.css') }}">

    <div class="container mb-5 mt-3">
        <div class="row my-2 d-flex justify-content-between align-items-center mb-3">
            <div class="col-6">
                <h5 class="text-muted m-0"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Halaman Utama</a> / <span class="text-black">{{ $produk->nama_produk }}</span></h5>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('homeProduct') }}" class="text-dark text-decoration-none">
                    <i class="fa-solid fa-arrow-left fa-2x"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <img src="{{ asset('img/data/produk/' . $produk->gambar) }}" alt="Gambar Produk" class="w-100 border-2" style="object-fit: cover;">
            </div>
            <div class="col-lg-6">
                <h5 class="text-danger mb-4 mt-sm-4">{{ $produk->kategori->nama_kategori }}</h5>
                <div class="d-flex justify-content-between">
                    <h4 class="fw-semibold mb-0">{{ $produk->nama_produk }}</h4>
                    <h4 class="mb-0">5 <i class="fa-solid fa-star" style="color: gold"></i></h4>
                </div>
                <hr>
                <p class="text-muted">{{ $produk->deskripsi }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="gap-2 d-flex align-items-center">
                        <span class="fw-bold"><del>Rp {{ $produk->harga + 100000 }}</del></span> <span class="fw-bold fs-4 text-danger">Rp {{ $produk->harga }}</span>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 d-flex mb-3 justify-content-between">
                    <h4>Produk Terkait</h4>
                    <a href="{{ route('homeProduct', ['kategori' => $produk->kategori->nama_kategori]) }}" class="text-decoration-none fw-semibold text-danger align-self-center">Lihat Semua</a>
                </div>
                <div class="row m-0 p-0">
                    <div class="col-12 overflow-auto">
                        <div class="d-flex flex-row gap-3 flex-nowrap">
                            @forelse ($rekomendasi as $data)
                                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                    <div class="card h-100 shadow-sm border-0 rounded-3">
                                        <!-- Gambar Produk -->
                                        <div class="card-img position-relative">
                                            <img src="{{ asset('img/data/produk/' . $data->gambar) }}" alt="{{ $data->nama_produk }}') }}"
                                                class="w-100 rounded-top-3"
                                                style="height: 280px; object-fit: cover;"
                                                alt="Nama Alat">

                                            <!-- Kategori -->
                                            <span class="badge bg-dark kategori-stuff m-2 px-3 py-2 rounded-2">
                                                {{ $data->kategori->nama_kategori }}
                                            </span>

                                            <!-- Tombol Detail -->
                                            <a href="{{ route('detailProduct', $data->id) }}"
                                                class="btn btn-danger btn-sm detail-hover position-absolute rounded-2 px-4 py-2 fw-semibold">Detail Barang
                                            </a>
                                        </div>

                                        <!-- Body Card -->
                                        <div class="card-body text-center">
                                            <!-- Nama Produk -->
                                            <h5 class="fw-semibold text-dark mb-2">{{ $data->nama_produk }}</h5>

                                            <!-- Harga -->
                                            <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                                                <span class="text-muted text-decoration-line-through fw-semibold">
                                                    Rp {{ number_format($data->harga + 100000, 0, ',', '.') }}
                                                </span>
                                                <span class="text-danger fs-5 fw-bold">
                                                    Rp {{ number_format($data->harga, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <h5 class="text-center m-auto overflow-y-hidden">Produk Terkait Tidak Ada</h5>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
