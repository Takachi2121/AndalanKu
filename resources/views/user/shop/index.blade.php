<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords"
        content="ShopUS, bootstrap-5, bootstrap, sass, css, HTML Template, HTML,html, bootstrap template, free template, figma, web design, web development,front end, bootstrap datepicker, bootstrap timepicker, javascript, ecommerce template">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{asset('img/icon.png')}}">

    <!--title  -->
    <title>Andalanku</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!--------------- swiper-css ---------------->
    <link rel="stylesheet" href="{{asset('css/swiper10-bundle.min.css')}}">

    <!--------------- bootstrap-css ---------------->
    <link rel="stylesheet" href="{{asset('css/bootstrap-5.3.2.min.css')}}">

    <!---------------------- Range Slider ------------------->
    <link rel="stylesheet" href="{{asset('css/nouislider.min.css')}}">

    <!---------------------- Scroll ------------------->
    <link rel="stylesheet" href="{{asset('css/aos-3.0.0.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="bg-white">
    @include('user.component.header')

    @yield('content')

    @include('user.component.footer')

    <div class="whatsapp-wrapper">
        <a href="https://api.whatsapp.com/send?phone=6285233899868&text=Halo%20kak,%20saya%20mau%20tanya%20apakah%20alat%20lighting%20ini%20masih%20tersedia%3F"
            target="_blank"
            class="whatsapp-float">
            <i class="fa-brands fa-whatsapp"></i>
            <span class="text">Customer Service 2</span>
        </a>
    </div>

    <div class="whatsapp-wrapper2">
        <a href="https://api.whatsapp.com/send?phone=6285233899868&text=Halo%20kak,%20saya%20mau%20tanya%20apakah%20alat%20lighting%20ini%20masih%20tersedia%3F"
            target="_blank"
            class="whatsapp-float">
            <i class="fa-brands fa-whatsapp"></i>
            <span class="text">Customer Service 1</span>
        </a>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
