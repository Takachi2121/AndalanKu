@extends('admin.main')

@section('title', 'Galeri')
@section('subtitle', 'Kelola data Galeri Andalanku mulai dari menambah, mengedit, hingga menghapus produk yang tersedia.')

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
        <input type="text" id="search-nama" class="form-control" placeholder="Cari berdasarkan title galeri...">
    </div>
    <div class="col-auto">
        <a href="{{ route('tambahGaleri') }}" class="btn btn-primary">
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
                        <th>Title</th>
                        <th>Caption Gambar</th>
                        <th>Thumbnail</th>
                        <th>Dokumentasi</th>
                        <th>Rancangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $galeri)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $galeri->title }}</td>
                        <td>{{ Str::limit($galeri->caption, 20) }}</td>
                        <td>
                            <img src="{{ asset('img/data/galeri/'. $galeri->thumbnail) }}" class="img-fluid" loading="lazy" alt="Gambar Produk" width="56"/>
                        </td>
                        <td>
                            <img src="{{ asset('img/data/galeri/'. $galeri->dokumentasi) }}" class="img-fluid" loading="lazy" alt="Gambar Produk" width="56"/>
                        </td>
                        <td>
                            <img src="{{ asset('img/data/galeri/'. $galeri->rancangan) }}" class="img-fluid" loading="lazy" alt="Gambar Produk" width="56"/>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('editGaleri', $galeri->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button type="button" onclick="hapusData({{ $galeri->id }}, 'galeri')" class="btn btn-sm btn-danger">
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
