<link rel="stylesheet" href="{{ asset('css/home/grid.css') }}">

<section id="gallery-section">
    <div class="container my-5">
        <h4 class="text-center fw-bold">GALLERY</h4>
        <br>
        <!-- FLEXIBLE GRID -->
        <div class="grid-container grid-count-{{ $count > 10 ? 10 : $count }}">
            @foreach($galleries as $key => $data)
                <div class="item img-{{ $key + 1 }}">
                    <img src="{{ asset('img/data/galeri/' . $data->thumbnail) }}" alt="{{ $data->title }}">
                    <div class="overlay-textgallery">
                        <h5>{{ $data->title }}</h5>
                        <p class="fw-light text-white">{{ Str::limit($data->caption, 120) }}</p>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="d-flex mt-2 align-content-center justify-content-center">
            <a href="{{ route('listGaleri') }}" class="btn px-4 py-3 btn-outline-danger button-sewa text-white">
                <span class="text-center">Lihat Galeri Kami</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

