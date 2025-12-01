@extends('admin.main')

@section('title', 'Edit Produk')
@section('subtitle', 'Ubah produk Andalanku.')

@section('content')
<form action="{{ route('updateProduk', $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <h5 class="fw-bold mb-3">Informasi Produk</h5>
        <div class="row">
            <div class="col-md-6">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $produk->nama_produk }}" placeholder="Contoh: Produk Andalanku">
            </div>
            <div class="col-md-6">
                <label for="kategori" class="form-label">Kategori Produk</label>
                <select class="form-select" id="kategori" name="kategori">
                    <option value="" style="display: none">-- Pilih Kategori --</option>
                    @foreach ($kategori as $data)
                        <option value="{{ $data->id }}" {{ $data->id == $produk->kategori_id ? 'selected' : '' }}>{{ $data->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3">
            <label for="deskripsi" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Tulis deskripsi produk di sini..."> {{ $produk->deskripsi }} </textarea>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Detail Harga</h5>
        <div class="col-md-6">
            <label for="harga" class="form-label">Harga Produk</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Contoh: 150000" value="{{ $produk->harga }}">
        </div>
    </div>

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Media</h5>
        <div class="col-md-6">
            <label for="gambar" class="form-label">Gambar Produk</label>
            <input type="file" class="form-control" id="gambar" name="gambar" accept=".png, .jpg">
            <div class="form-text text-muted mt-2">
                Note: Minimal ukuran foto produk adalah 220 x 220 dan bertipe PNG / JPG
            </div>

            <!-- Preview Gambar -->
            <div class="mt-3">
                <img
                    id="preview-gambar"
                    src="{{ $produk->gambar ? asset('img/data/produk/' . $produk->gambar) : '#' }}"
                    alt="Preview Gambar Produk"
                    style="max-width: 220px; max-height: 220px; {{ $produk->gambar ? '' : 'display: none;' }} border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
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
