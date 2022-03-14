<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
        <img src="img/logo/logo3.png">
        </div>
        <div class="sidebar-brand-text mx-3"></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Fitur
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('position.index') }}">
            <i class="fas fa-sort-amount-up"></i>
        <span>Jabatan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('employee.index') }}">
            <i class="fas fa-user"></i>
        <span>Karyawan</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>
<!-- Sidebar -->
