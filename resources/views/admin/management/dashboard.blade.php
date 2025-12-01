@extends('admin.main')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan data dan aktivitas terbaru untuk mengelola Andalanku Production.')

@section('content')
@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
@endif

    <div class="row mx-1">
        <div class="col-lg-4 col-md-12 px rounded-2 shadow-sm">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <h5 class="fw-semibold m-0">Total Alat</h5>
                            <i class="fa-solid fa-toolbox"></i>
                        </div>
                        <div class="col-12 pt-3">
                            <h1 class="fw-bold text-start">{{ $totalProduk }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 px rounded-2 shadow-sm">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <h5 class="fw-semibold m-0">Total Galeri</h5>
                            <i class="fa-solid fa-images"></i>
                        </div>
                        <div class="col-12 pt-3">
                            <h1 class="fw-bold text-start"> {{ $totalGaleri }} </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 px rounded-2 shadow-sm">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <h5 class="fw-semibold m-0">Total Testimoni</h5>
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <div class="col-12 pt-3">
                            <h1 class="fw-bold text-start">{{ $totalTestimoni }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <h5 class="fw-semibold m-0">Chart Pengunjung</h5>
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="col-12 pt-3">
                            <canvas id="pengunjungChart" height="700"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('pengunjungChart').getContext('2d');
    const pengunjungChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Pengunjung',
                data: {!! json_encode($data) !!},
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#4e73df',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5W7EVQSJRL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-5W7EVQSJRL');
</script>
@endsection
