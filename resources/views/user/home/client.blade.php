<section id="client-section">
    <div class="container pb-5">
        <div class="row">
            <h4 class="fw-bold text-center mb-5">TELAH DIPERCAYA OLEH</h4>
            <div class="col-md-12 client-logo-wrapper">
                <div class="client-track d-flex justify-content-center flex-wrap gap-4">
                    @foreach($client as $data)
                        <img src="{{ asset('img/data/client/' . $data->logo_client) }}" alt="{{ $data->nama_client }}" loading="lazy" class="img-fluid">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
