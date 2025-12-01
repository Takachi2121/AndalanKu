@extends('admin.main')

@section('title', 'Tambah Client')
@section('subtitle', 'Tambahkan Client baru ke dalam daftar Client Andalanku.')

@section('content')
<form action="{{ route('storeClient') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Informasi Client</h5>
        <div class="row">
            <div class="col-md-6">
                <label for="nama_client" class="form-label">Nama Client</label>
                <input type="text" class="form-control" id="nama_client" name="nama_client" placeholder="Contoh: Kemnaker" required>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Media</h5>
        <div class="col-md-6">
            <label for="logo" class="form-label">Logo Client</label>
            <input type="file" class="form-control" required id="logo" name="logo" accept=".png, .jpg">
            <div class="form-text text-muted mt-2">
                Note: foto bertipe PNG / JPG
            </div>

            <!-- Preview Gambar -->
            <div class="mt-3">
                <img id="preview-gambar" src="#" alt="Preview Gambar Produk" style="max-width: 220px; max-height: 220px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
            </div>
        </div>
    </div>

    {{-- Tombol Simpan --}}
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Client
        </button>
    </div>
</form>

{{-- Script preview gambar --}}
<script>
    document.getElementById('logo').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('preview-gambar');

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });
</script>
@endsection
