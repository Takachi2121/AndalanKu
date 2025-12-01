@extends('user.shop.index')

@section('content')

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #fff !important; /* Panah putih */
        background-color: rgba(128, 128, 128, 0.3); /* Circle abu-abu transparan */
        width: 36px;  /* Lebar circle */
        height: 36px; /* Tinggi circle */
        border-radius: 50%; /* Circle */
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px; /* Ukuran panah */
        box-shadow: none;
        transition: none; /* Hilangkan hover transition */
    }

    /* Hilangkan efek hover */
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: rgba(128, 128, 128, 0.3);
    }

    .modal.fade .modal-dialog {
        transform: translate(0, -30px);
        transition: all 0.3s ease-in-out;
    }

    .modal.show .modal-dialog {
        transform: translate(0, 0);
    }
</style>

<div class="container">
    <div class="row align-items-center my-4">
        <div class="col-md-4 col-sm-12">
            <h5 class="text-muted m-0">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted">Halaman Utama</a> /
                <span class="text-black">Galeri</span>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @foreach ($galleries as $data)
                    <div class="col-lg-4 col-md-12 col-sm-12 d-flex">
                        <div class="card mb-3 d-flex flex-column" style="min-height: 350px;">
                            <div class="card-image">
                                <img src="{{ asset('img/data/galeri/' . $data->thumbnail) }}"
                                    class="card-img-top object-fit-scale" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $data->title }}</h5>
                                <p class="card-text">{{ Str::limit($data->caption, 60) }}</p>

                                @php
                                    $images = [];
                                    $images[] = asset('img/data/galeri/' . $data->thumbnail);

                                    if (!empty($data->dokumentasi) && file_exists(public_path('img/data/galeri/' . $data->dokumentasi))) {
                                        $images[] = asset('img/data/galeri/' . $data->dokumentasi);
                                    }

                                    if (!empty($data->rancangan) && file_exists(public_path('img/data/galeri/' . $data->rancangan))) {
                                        $images[] = asset('img/data/galeri/' . $data->rancangan);
                                    }
                                @endphp

                                <div class="text-end mt-auto">
                                    <button class="btn btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#galleryModal"
                                        data-title="{{ $data->title }}"
                                        data-desc="{{ $data->caption }}"
                                        data-images='@json($images)'>
                                        Lihat Gambar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 rounded-3 shadow-lg">
            <div class="modal-body p-0 d-flex flex-column flex-lg-row">

                <!-- Slideshow -->
                <div class="col-lg-8 position-relative">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper" id="modal-images">
                            <!-- Images injected by JS -->
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <!-- Title & Description -->
                <div class="col-lg-4 p-4 d-flex flex-column justify-content-center">
                    <h4 id="modal-title" class="fw-semibold"></h4>
                    <p id="modal-desc" class="text-muted"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    let swiper;

    const galleryModal = document.getElementById('galleryModal');

    galleryModal.addEventListener('shown.bs.modal', event => {
        const button = event.relatedTarget;
        const title = button.getAttribute('data-title');
        const desc = button.getAttribute('data-desc');
        const images = JSON.parse(button.getAttribute('data-images'));

        document.getElementById('modal-title').innerText = title;
        document.getElementById('modal-desc').innerText = desc;

        const imageContainer = document.getElementById('modal-images');
        imageContainer.innerHTML = ''; // Kosongkan container dulu

        images.forEach(src => {
            const slide = document.createElement('div');
            slide.className = 'swiper-slide';
            slide.innerHTML = `<img src="${src}" class="w-100 h-100 object-fit-cover" />`;
            imageContainer.appendChild(slide);
        });

        // Destroy instance swiper lama jika ada
        if (swiper) {
            swiper.destroy(true, true);
        }

        // Init swiper baru
        swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    });

    galleryModal.addEventListener('hidden.bs.modal', () => {
        if (swiper) {
            swiper.destroy(true, true);
            swiper = null;
        }
    });

</script>

@endsection
