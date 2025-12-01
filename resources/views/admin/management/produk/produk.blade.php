@extends('admin.main')

@section('title', 'Produk')
@section('subtitle', 'Kelola data produk Andalanku mulai dari menambah, mengedit, hingga menghapus produk yang tersedia.')

@section('content')

@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
@endif

<div class="row d-flex justify-content-between align-items-center">
    <div class="col-6">
        <input type="text" id="search-nama" class="form-control" placeholder="Cari berdasarkan nama produk...">
    </div>

    <div class="col-auto">
        <a href="{{ route('tambahProduk') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            <span class="fw-semibold">Tambah Data</span>
        </a>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="table-responsive">
            <table id="produk-table" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $produk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>{{ Str::limit($produk->deskripsi, 30) }}</td>
                        <td>{{ $produk->kategori->nama_kategori }}</td>
                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td><img src="{{ asset('img/data/produk/'. $produk->gambar) }}" loading="lazy" class="img-fluid" alt="Gambar Produk" width="55"/></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('editProduk', $produk->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button type="button" onclick="hapusData({{ $produk->id }}, 'produk')" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
