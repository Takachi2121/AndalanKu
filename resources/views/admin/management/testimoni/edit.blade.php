@extends('admin.main')

@section('title', 'Edit Testimoni')
@section('subtitle', 'Ubah testimoni Andalanku.')

@section('content')
<form action="{{ route('updateTestimoni', $testimoni->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <h5 class="fw-bold mb-3">Informasi Testimoni</h5>
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="nama_testimoni" class="form-label">Nama Testimoni</label>
                <input type="text" class="form-control" id="nama_testimoni" name="nama_testimoni" placeholder="Contoh: Nelson Bogan" value="{{ $testimoni->nama_client }}" required>
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Contoh: Stokes Group" value="{{ $testimoni->nama_perusahaan }}" required>
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="testimoni" class="form-label">Testimoni</label>
                <textarea class="form-control" style="min-height: 100px" id="testimoni" name="testimoni" placeholder="Contoh: Pelayanan cepat dan alat-alatnya dalam kondisi sangat baik. Timnya juga sangat membantu dari awal hingga akhir. Pasti akan sewa lagi kalau ada acara berikutnya!" required>{{ $testimoni->testimoni }}</textarea>
            </div>
        </div>
        <div class="mb-4">
            <h5 class="fw-bold mb-3">Media</h5>
            <div class="col-md-5">
                <label for="img_testimoni" class="form-label">Foto</label>
                <input type="file" class="form-control" id="img_testimoni" name="img_testimoni" accept=".png, .jpg">
                <div class="form-text text-muted mt-2">
                    Note: Minimal ukuran foto 340 x 327 dan bertipe PNG / JPG
                </div>

                <!-- Preview Gambar -->
                <div class="mt-3">
                    <img id="preview-testimoni" src="{{ $testimoni->profile ? asset('img/data/testimoni/' . $testimoni->profile) : '#' }}"
                    alt="Preview Gambar Client"
                    style="max-width: 220px; max-height: 220px; {{ $testimoni->profile ? '' : 'display: none;' }} border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                </div>
            </div>
        </div>

    </div>

    {{-- Tombol Simpan --}}
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Testimoni
        </button>
    </div>
</form>

{{-- Script preview gambar --}}
<script>
    document.getElementById('img_testimoni').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('preview-testimoni');

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
