<div class="d-flex">
    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column p-4" id="sidebar">
        <!-- Logo -->
        <div class="text-center mb-5">
            <img src="{{ asset('img/header/logo-white.png') }}" class="object-fit-contain" width="170" alt="Logo">
        </div>

        <!-- Navigation -->
        <nav class="nav flex-column gap-2 flex-grow-1">
            <p class="text-uppercase text-white-50 small fw-bold mt-3 mb-1">Utama</p>

            <a class="nav-link {{ $active == 'dashboard' ? 'active' : '' }}" href="{{ route('mainDashboard') }}"><i class="fa-solid fa-dashboard me-2"></i> Dashboard</a>

            <a class="nav-link {{ $active == 'produk' ? 'active' : '' }}" href="{{ route('adminProduct') }}"><i class="fa-solid fa-box me-2"></i> Produk</a>

            <a class="nav-link {{ $active == 'kategori' ? 'active' : '' }}" href="{{ route('adminKategori') }}"><i class="fa-solid fa-list me-2"></i> Kategori</a>

            <p class="text-uppercase text-white-50 small fw-bold mt-4 mb-1">Lainnya</p>
            <a class="nav-link {{ $active == 'galeri' ? 'active' : '' }}" href="{{ route('adminGaleri') }}"><i class="fa-solid fa-image me-2"></i> Galeri</a>
            <a class="nav-link {{ $active == 'testimoni' ? 'active' : '' }}" href="{{ route('adminTestimoni') }}"><i class="fa-solid fa-comment me-2"></i> Testimoni</a>
            <a class="nav-link {{ $active == 'client' ? 'active' : '' }}" href="{{ route('adminClient') }}"><i class="fa-solid fa-building me-2"></i> Client</a>
        </nav>

        <!-- Logout -->
        <div class="mt-auto pt-4">
            <a href="{{ route('logout') }}" class="btn btn-danger w-100">
                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow-1 p-4" style="overflow-y: auto">
        <!-- Header Page -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Title & Subtitle -->
            <div>
                <h1 class="fw-bold mb-1">@yield('title')</h1>
                <p class="text-muted mb-0">@yield('subtitle')</p>
            </div>

            <!-- Hamburger (mobile only) -->
            <button class="btn btn-outline-light bg-dark d-md-none" id="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- Konten halaman -->
        @yield('content')
    </main>
</div>

<!-- Overlay (untuk mobile) -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>
