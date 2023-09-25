<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('index.html') }}">
        <div class="sidebar-brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path
                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
            </svg>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Beranda -->
    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Jenis Perjanjian
    </div>

    {{-- Menu Item --}}
    <li class="nav-item {{ Request::is('sarpras') ? 'active' : '' }}">
        <a class="nav-link" href="/sarpras">
            <span>SARPRAS</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sewa-bangunan') ? 'active' : '' }}">
        <a class="nav-link" href="/sewa-bangunan">
            <span>Sewa Bangunan</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sewa-kendaraan') ? 'active' : '' }}">
        <a class="nav-link" href="/sewa-kendaraan">
            <span>Sewa Kendaraan</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('tuks-tersus') ? 'active' : '' }}">
        <a class="nav-link" href="/tuks-tersus">
            <span>TUKS-TERSUS</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('upp') ? 'active' : '' }}">
        <a class="nav-link" href="/upp">
            <span>UPP</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('lainnya') ? 'active' : '' }}">
        <a class="nav-link" href="/lainnya">
            <span>Lainnya</span>
        </a>
    </li>


    {{-- <li class="nav-item">
    <a class="nav-link collapsed" href="#">
        <i class="fas fa-fw fa-cog"></i>
        <span>Perbarui Perjanjian Kerja Sama</span>
    </a>
  </li> --}}


    {{-- Divider --}}
    <hr class="sidebar-divider">

    <li class="nav-item {{ Request::is('lainnya') ? 'active' : '' }}">
        <a class="nav-link" href="/lainnya">
            <span>Arsip</span>
        </a>
    </li>

    {{-- Divider --}}
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
