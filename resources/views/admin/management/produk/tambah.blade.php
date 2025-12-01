@extends('admin.main')

@section('title', 'Tambah Produk')
@section('subtitle', 'Tambahkan produk baru ke dalam daftar produk Andalanku.')

@section('content')
<form action="{{ route('storeProduk') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Informasi Produk</h5>
        <div class="row">
            <div class="col-md-6">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Contoh: Produk Andalanku" required>
            </div>
            <div class="col-md-6">
                <label for="kategori" class="form-label">Kategori Produk</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="" style="display: none">-- Pilih Kategori --</option>
                    @foreach ($kategori as $data)
                        <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3">
            <label for="deskripsi" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Tulis deskripsi produk di sini..." required></textarea>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Detail Harga</h5>
        <div class="col-md-6">
            <label for="harga" class="form-label">Harga Produk</label>
            <input type="text" class="form-control" id="harga" name="harga" placeholder="Contoh: 150000" required>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Media</h5>
        <div class="col-md-6">
            <label for="gambar" class="form-label">Gambar Produk</label>
            <input type="file" class="form-control" required id="gambar" name="gambar" accept=".png, .jpg">
            <div class="form-text text-muted mt-2">
                Note: Minimal ukuran foto produk adalah 220 x 220 dan bertipe PNG / JPG
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
            <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Produk
        </button>
    </div>
</form>

{{-- Script preview gambar --}}
<script>
    document.getElementById('gambar').addEventListener('change', function(event) {
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
