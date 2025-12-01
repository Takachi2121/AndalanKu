@extends('admin.main')

@section('title', 'Tambah Kategori')
@section('subtitle', 'Tambahkan kategori baru ke dalam daftar kategori Andalanku.')

@section('content')
<!-- CDN Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<form action="{{ route('storeKategori') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Informasi Kategori</h5>
        <div class="row">
            <div class="col-md-6">
                <label for="IconKategori" class="form-label">Icon Kategori</label>
                <input type="file" class="form-control" required id="IconKategori" name="IconKategori" accept=".png, .jpg">
                <div class="form-text text-muted mt-2">
                    Note: Silahkan mengambil icon dari <a href="https://www.flaticon.com/search?word=&shape=outline" target="_blank" rel="noopener noreferrer">Flaticon</a> dan upload disini dengan background transparan
                </div>

                <!-- Preview Gambar -->
                <div class="mt-3">
                    <img id="preview-icon" src="#" alt="Preview Gambar Produk" style="max-width: 100px; max-height: 100px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Contoh: Lighting" required>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Media</h5>
        <div class="col-md-6">
            <label for="thumbnail" class="form-label">Gambar Thumbnail</label>
            <input type="file" class="form-control" required id="thumbnail" name="thumbnail" accept=".png, .jpg">
            <div class="form-text text-muted mt-2">
                Note: Minimal ukuran foto 220 x 220 dan bertipe PNG / JPG
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
            <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Kategori
        </button>
    </div>
</form>

{{-- Script preview gambar dan ikon --}}
<script>
    document.getElementById('thumbnail').addEventListener('change', function(event) {
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

    document.getElementById('IconKategori').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('preview-icon');

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
