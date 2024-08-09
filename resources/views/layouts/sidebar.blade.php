<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" id="toggle-btn" type="button">
            <img src="{{ asset('img/company.jpg') }}" alt="logo" width="40px" style="margin-left: 0">
        </button>
        <div class="sidebar-logo">
            <a class="fs-6" href="#">SISTEM MANAJEMEN KARYAWAN</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <i class="lni lni-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('karyawan.index') }}" class="sidebar-link">
                <i class="lni lni-consulting"></i>
                <span>Karyawan</span>
            </a>
        </li>
        @if (Auth::user()->role == 'superadmin')
            <li class="sidebar-item">
                <a href="{{ route('user.index') }}" class="sidebar-link">
                    <i class="lni lni-users"></i>
                    <span>User</span>
                </a>
            </li>
        @endif
    </ul>
</aside>
