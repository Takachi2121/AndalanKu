@extends('admin.main')

@section('title', 'Edit Kategori')
@section('subtitle', 'Ubah Kategori Andalanku.')

@section('content')
<form action="{{ route('updateKategori', $kategori->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Informasi Kategori</h5>
        <div class="row">
            <div class="col-md-6">
                <label for="IconKategori" class="form-label">Icon Kategori</label>
                <input type="file" class="form-control" id="IconKategori" name="IconKategori" accept=".png, .jpg">
                <div class="form-text text-muted mt-2">
                    Note: Silahkan mengambil icon dari <a href="https://www.flaticon.com/search?word=&shape=outline" target="_blank" rel="noopener noreferrer">Flaticon</a> dan upload disini dengan background transparan
                </div>

                <!-- Preview Gambar -->
                <div class="mt-3 mb-3">
                    <img id="preview-icon" src="{{ $kategori->icon_kategori ? asset('img/icon/' . $kategori->icon_kategori) : '#' }}"
                    alt="Preview Gambar Kategori"
                    style="max-width: 100px; max-height: 100px; {{ $kategori->icon_kategori ? '' : 'display: none;' }} border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Contoh: Lighting" required value="{{ $kategori->nama_kategori }}">
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Media</h5>
        <div class="col-md-6">
            <label for="gambar" class="form-label">Gambar Thumbnail</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept=".png, .jpg">
            <div class="form-text text-muted mt-2">
                Note: Minimal ukuran foto 220 x 220 dan bertipe PNG / JPG
            </div>

            <!-- Preview Gambar -->
            <div class="mt-3">
                <img
                    id="preview-gambar"
                    src="{{ $kategori->thumbnail ? asset('img/data/kategori/' . $kategori->thumbnail) : '#' }}"
                    alt="Preview Gambar Kategori"
                    style="max-width: 220px; max-height: 220px; {{ $kategori->thumbnail ? '' : 'display: none;' }} border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
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

{{-- Script preview gambar --}}
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
