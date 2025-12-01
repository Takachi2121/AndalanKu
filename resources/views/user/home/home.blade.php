@extends('user.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home/index.css') }}">

<section id="hero-section">
    <div class="container py-5 text-white">
        <div class="row">
            <div class="col-md-8 d-flex flex-column justify-content-center align-items-start" data-aos="fade-right" data-aos-duration="1000">
                <h1 style="font-weight: bold">ANDALAN PRODUCTION SIAP MENJADI,<br>ANDALAN KEBUTUHAN ANDA.</h1>
                <p>Alat Lengkap, Event Hebat!</p>
                <a href="{{ route('homeProduct') }}" class="mt-4 button-sewa">
                    <span>Sewa Sekarang</span><i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Animated line at the bottom -->
    <div id="progress-bar"></div>
</section>

@include('user.home.noted')

@include('user.home.category')

@include('user.home.service')

@include('user.home.reason')

@include('user.home.testimoni')

@include('user.home.gallery')

@include('user.home.client')

@include('user.home.cta')

<script src="{{ asset('js/home/index.js') }}"></script>
@endsection
