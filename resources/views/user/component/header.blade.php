<header data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-4 border-bottom">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/header/logo.png') }}"
                    alt="Logo"
                    class="img-fluid"
                    style="object-fit: cover; max-width: 250px;">
                </a>
            </div>

            <!-- Menu kanan -->
            <div class="d-flex gap-3 align-items-center">

                <!-- Category -->
                <div class="category-menu-section">
                    <!-- Desktop trigger -->
                    <button class="header-kategori text-nowrap d-none d-md-block" id="dropdownToggleDesktop">
                        <i class="fa-solid fa-list pe-2"></i>PILIH KATEGORI
                    </button>
                    <!-- Mobile trigger -->
                    <i class="fa-solid fa-bars d-md-none fs-2 text-danger" id="dropdownToggleMobile"></i>

                    <!-- Dropdown -->
                    <div class="category-dropdown" id="dropdownMenu">
                        <ul class="category-list list-unstyled m-0 p-0">
                            @foreach($kategoriAll as $data)
                            <li class="category-list-item">
                                <a href="{{ route('homeProduct', ['kategori' => $data->nama_kategori]) }}">
                                    <div class="dropdown-item d-flex align-items-center">
                                        <img src="{{ asset('img/icon/' . $data->icon_kategori) }}" alt="Icon Kategori" class="pe-3" width="50">
                                        <span>{{ $data->nama_kategori }}</span>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
