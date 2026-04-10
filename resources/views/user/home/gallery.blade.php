<link rel="stylesheet" href="{{ asset('css/home/grid.css') }}">

<section id="gallery-section">
    <div class="container my-5">
        <h4 class="text-center fw-bold">GALLERY</h4>
        <br>
        <!-- FLEXIBLE GRID -->
        <div class="grid-container grid-count-{{ $count > 10 ? 10 : $count }}">
            {{-- @foreach($galleries as $key => $data)
                <div class="item img-{{ $key + 1 }}">
                    <img src="{{ asset('img/data/galeri/' . $data->thumbnail) }}" loading="lazy" alt="{{ $data->title }}">
                    <div class="overlay-textgallery">
                        <h5>{{ $data->title }}</h5>
                        <p class="fw-light text-white">{{ Str::limit($data->caption, 120) }}</p>
                    </div>
                </div>
            @endforeach --}}
            @for($i = 0; $i < 2; $i++)
                <div class="item img-{{ $i }}">
                    <img src="{{ asset('img/1769756448_2.jpg') }}" loading="lazy" alt="Lorem Ipsum">
                    <div class="overlay-textgallery">
                        <h5>Lorem Ipsum</h5>
                        <p class="fw-light text-white">{{ Str::limit('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 120) }}</p>
                    </div>
                </div>
            @endfor
        </div>


        <div class="d-flex mt-2 align-content-center justify-content-center">
            <a href="{{ route('listGaleri') }}" class="btn px-4 py-3 btn-outline-danger button-sewa text-white">
                <span class="text-center">Lihat Galeri Kami</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

