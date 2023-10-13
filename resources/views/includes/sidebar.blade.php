<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path
                    d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm54.2 253.8c-6.1 20.3-24.8 34.2-46 34.2H80c-8.8 0-16-7.2-16-16s7.2-16 16-16h8.2c7.1 0 13.3-4.6 15.3-11.4l14.9-49.5c3.4-11.3 13.8-19.1 25.6-19.1s22.2 7.7 25.6 19.1l11.6 38.6c7.4-6.2 16.8-9.7 26.8-9.7c15.9 0 30.4 9 37.5 23.2l4.4 8.8H304c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-6.1 0-11.6-3.4-14.3-8.8l-8.8-17.7c-1.7-3.4-5.1-5.5-8.8-5.5s-7.2 2.1-8.8 5.5l-8.8 17.7c-2.9 5.9-9.2 9.4-15.7 8.8s-12.1-5.1-13.9-11.3L144 349l-9.8 32.8z" />
            </svg>
        </div>
        <div class="sidebar-brand-text mx-3">SI-SUPER</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Beranda -->
    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">
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

    {{-- Divider --}}
    <hr class="sidebar-divider">

    <li class="nav-item {{ Request::is('arsip') ? 'active' : '' }}">
        <a class="nav-link" href="/arsip">
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
