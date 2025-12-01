<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords"
        content="ShopUS, bootstrap-5, bootstrap, sass, css, HTML Template, HTML,html, bootstrap template, free template, figma, web design, web development,front end, bootstrap datepicker, bootstrap timepicker, javascript, ecommerce template">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{asset('img/icon-white.png')}}">

    <title>Andalanku</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-5.3.2.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">

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

    <div class="row g-0">
        <!-- Bagian Login -->
        <div class="col-lg-6 p-5 bg-white rounded-start-4 d-flex align-items-center">
            <div class="w-100">
                <div class="login-page">
                    <div class="img-logo">
                        <img src="{{ asset('img/header/logo.png') }}" alt="Logo">
                    </div>
                    <div class="form-login">
                        <h1 class="fw-medium fs-3 text-center mb-2">Selamat Datang</h1>
                        <p class="text-muted text-center">Masukkan Email dan Password Untuk Akses Akun</p>
                        <div class="mb-5"></div>
                        <form action="{{ route('authLogin') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control shadow-sm" name="emailUser" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="email">
                            </div>
                            <div class="mb-3 password-wrapper">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control shadow-sm" name="passUser" id="exampleInputPassword1" name="password">
                                <i class="fa-solid fa-eye" id="togglePassword"></i>
                            </div>

                            <button type="submit" class="btn text-white py-2 w-100">Masuk Sebagai Admin</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="{{ route('home') }}" class="text-decoration-none fw-semibold text-danger">Kembali ke Halaman Utama</a>
                        </div>
                    </div>
                    <div class="text-add">
                        <p class="text-muted fw-medium text-center">Andalanku Production membantu Anda mengelola kebutuhan dengan lebih mudah dan efisien, kapan saja dan di mana saja.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 bg-login d-none rounded-end-4 shadow-sm d-lg-block"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin/login.js') }}"></script>
</body>

</html>
