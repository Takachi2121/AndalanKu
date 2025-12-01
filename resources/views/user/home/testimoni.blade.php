<link rel="stylesheet" href="{{ asset('css/home/testimoni.css') }}">

<section id="section-testimoni">
    <h4 class="text-center fw-bold">APA KATA MEREKA</h4>
    <br>
    <div class="row gap-3">
        @foreach ($testimoni as $data)
        <div class="card rounded-2 border-0 col-md-3 shadow-lg p-3 mb-5 bg-body rounded" data-aos="fade-up" data-aos-duration="1000">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    @if ($data->profile)
                        <img src="{{ asset('img/data/testimoni/' . $data->profile) }}" loading="lazy" height="80" width="80" class="rounded-circle me-3" alt="Foto Testimoni">
                    @else
                        <img src="{{ asset('img/index/Testimoni.png') }}" loading="lazy" height="80" width="80" class="rounded-circle me-3" alt="Foto Testimoni">
                    @endif
                    <div>
                        <p class="fw-semibold fs-5 mb-1">{{ $data->nama_client }}</p>
                        <p class="fw-light mb-0">{{ $data->nama_perusahaan }}</p>
                    </div>
                </div>

                <p class="fw-light" style="min-height: 140px">
                    {{ $data->testimoni }}
                </p>

                <div class="d-flex justify-content-between mt-3">
                    <span>
                        <i class="fa-solid fa-star" style="color: gold"></i>
                        <i class="fa-solid fa-star" style="color: gold"></i>
                        <i class="fa-solid fa-star" style="color: gold"></i>
                        <i class="fa-solid fa-star" style="color: gold"></i>
                        <i class="fa-solid fa-star" style="color: gold"></i>
                    </span>
                    <p class="mb-0">{{ Date('d/m/Y', strtotime($data->created_at)) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

