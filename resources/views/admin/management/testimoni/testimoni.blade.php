@extends('admin.main')

@section('title', 'Testimoni')
@section('subtitle', 'Kelola data Testimoni Andalanku mulai dari menambah, mengedit, hingga menghapus produk yang tersedia.')

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
        <input type="text" id="search-nama" class="form-control" placeholder="Cari berdasarkan nama testimoni...">
    </div>
    <div class="col-auto">
        <a href="{{ route('tambahTestimoni') }}" class="btn btn-primary">
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
                        <th>Nama Client</th>
                        <th>Nama Perusahaan</th>
                        <th>Testimoni</th>
                        <th>Profile Testimoni</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $testimoni)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $testimoni->nama_client }}</td>
                        <td>{{ $testimoni->nama_perusahaan }}</td>
                        <td>{{ Str::limit($testimoni->testimoni, 40) }}</td>
                        <td>
                            @if ($testimoni->profile)
                                <img src="{{ asset('img/data/testimoni/' . $testimoni->profile) }}" loading="lazy" height="80" width="80" class="me-3" alt="Foto Testimoni">
                            @else
                                <img src="{{ asset('img/index/Testimoni.png') }}" loading="lazy" height="80" width="80" class="me-3" alt="Foto Testimoni">
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('editTestimoni', $testimoni->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button type="button" onclick="hapusData({{ $testimoni->id }}, 'testimoni')" class="btn btn-sm btn-danger">
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
