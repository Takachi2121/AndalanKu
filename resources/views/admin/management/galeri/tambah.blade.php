@extends('admin.main')

@section('title', 'Tambah Galeri')
@section('subtitle', 'Tambahkan Galeri baru ke dalam daftar Galeri Andalanku.')

@section('content')
<form action="{{ route('storeGaleri') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="mb-4">
                <h5 class="fw-bold mb-3">Informasi Galeri</h5>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="nama_galeri" class="form-label">Nama Acara</label>
                        <input type="text" class="form-control" id="nama_galeri" name="nama_galeri" placeholder="Contoh: Harlah PKB-27" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="deskripsi_galeri" class="form-label">Deskripsi Acara</label>
                        <textarea class="form-control" style="min-height: 300px" id="deskripsi_galeri" name="deskripsi_galeri" placeholder="Contoh: Hari Lahir (Harlah) ke-27 Partai Kebangkitan Bangsa (PKB) yang diperingati pada 23 Juli 2025 mengusung tema “Indonesia Patriotik, Indonesia Produktif”, sebagai bentuk semangat PKB dalam membangun bangsa yang berdaya saing dan berjiwa kebangsaan tinggi. Peringatan ini menjadi momentum konsolidasi kader dan refleksi perjuangan partai selama 27 tahun, sekaligus wadah untuk menyapa masyarakat lebih luas melalui berbagai kegiatan. Rangkaian acara Harlah meliputi konferensi internasional tentang transformasi pesantren, bimbingan teknis untuk kader eksekutif dan legislatif, serta kegiatan seni budaya bertajuk Kolakarya yang menggabungkan berbagai genre seni. Selain itu, PKB juga mengadakan turnamen olahraga dan kegiatan sosial-lingkungan. Puncak perayaan digelar di Jakarta Convention Center (JCC), Senayan, yang dihadiri oleh Presiden Prabowo Subianto dan berbagai tokoh nasional. Dalam pidatonya, Ketua Umum PKB Muhaimin Iskandar menyampaikan harapan agar PKB terus menjadi bagian penting dalam arah pembangunan nasional ke depan." required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-9">
                        <label for="thumbnai;" class="form-label">Thumbnail Acara </label>
                        <input type="file" class="form-control" required id="thumbnail" name="thumbnail" accept=".png, .jpg">
                        <div class="form-text text-muted mt-2">
                            Note: Minimal ukuran foto 1920 x 792 dan bertipe PNG / JPG
                        </div>

                        <!-- Preview Gambar -->
                        <div class="mt-3">
                            <img id="preview-thumbnail" src="#" alt="Preview Gambar Produk" style="max-width: 220px; max-height: 220px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-4">
                <h5 class="fw-bold mb-3">Media</h5>
                <div class="col-md-9">
                    <label for="dokumentasi" class="form-label">Dokumentasi Acara </label>
                    <input type="file" class="form-control" required id="dokumentasi" name="dokumentasi" accept=".png, .jpg">
                    <div class="form-text text-muted mt-2">
                        Note: Minimal ukuran foto 1920 x 792 dan bertipe PNG / JPG
                    </div>

                    <!-- Preview Gambar -->
                    <div class="mt-3">
                        <img id="preview-dokumentasi" src="#" alt="Preview Gambar Produk" style="max-width: 220px; max-height: 220px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                    </div>
                </div>
                <div class="col-md-9">
                    <label for="rancangan" class="form-label">Rancangan Acara </label>
                    <input type="file" class="form-control" required id="rancangan" name="rancangan" accept=".png, .jpg">
                    <div class="form-text text-muted mt-2">
                        Note: Minimal ukuran foto 1920 x 792 dan bertipe PNG / JPG
                    </div>

                    <!-- Preview Gambar -->
                    <div class="mt-3">
                        <img id="preview-rancangan" src="#" alt="Preview Gambar Produk" style="max-width: 220px; max-height: 220px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Galeri
                </button>
            </div>
        </div>
    </div>
</form>

{{-- Script preview gambar --}}
<script>
    document.getElementById('thumbnail').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('preview-thumbnail');

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });
    document.getElementById('dokumentasi').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('preview-dokumentasi');

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });
    document.getElementById('rancangan').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('preview-rancangan');

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
