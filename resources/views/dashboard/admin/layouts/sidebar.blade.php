<aside id="sidebar">
    <div class="d-flex" style="border-bottom: whitesmoke solid 1px;">
        <button class="toggle-btn" id="toggle-btn" type="button">
            <img src="{{ asset('img/log.png') }}" alt="logo" width="40px" style="margin-left: 0">
        </button>
        <div class="sidebar-logo">
            <a href="#">SIS-PONCIL</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Route::is('dashmin') ? 'active' : '' }}">
            <a href="{{ route('dashmin') }}" class="sidebar-link">
                <i class="lni lni-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item {{ Route::is('data_saba_all') ? 'active' : '' }}">
            <a href="{{ route('data_saba_all') }}" class="sidebar-link">
                <i class="lni lni-consulting"></i>
                <span>Data Santri</span>
            </a>
        </li>
        <li class="sidebar-item ">
            <a href="#" class="sidebar-link collapsed has-dropdown {{ Route::is('index.invoice') ? 'active' : '' }}"
            data-bs-toggle="collapse" data-bs-target="#pembayaran" aria-expanded="false" aria-controls="pembayaran">
                <i class="lni lni-credit-cards"></i>
                <span>Pembayaran</span>
            </a>
            <ul id="pembayaran" class="sidebar-dropdown collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('index.invoice') }}" class="sidebar-link">
                        <i class="lni lni-checkmark-circle"></i>
                        Tagihan
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-checkmark-circle"></i>
                        Daftar Transaksi
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item ">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#report" aria-expanded="false" aria-controls="report">
                <i class="lni lni-files"></i>
                <span>Report</span>
            </a>
            <ul id="report" class="sidebar-dropdown collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-calendar"></i>
                        Report Bulanan
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-calendar"></i>
                        Report Tahunan
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown {{ Route::is('admin.index')|| Route::is('user.index') ? 'active' : '' }}" data-bs-toggle="collapse"
                data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                <i class="lni lni-users"></i>
                <span>User</span>
            </a>
            <ul id="auth" class="sidebar-dropdown collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item {{ Route::is('admin.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        Admin
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('user.index') ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        Santri
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown {{ Route::is('pembayaran')|| Route::is('kamar') ? 'active' : '' }}" data-bs-toggle="collapse"
                data-bs-target="#settings" aria-expanded="false" aria-controls="settings">
                <i class="lni lni-cog"></i>
                <span>Settings</span>
            </a>
            <ul id="settings" class="sidebar-dropdown collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item {{ Route::is('pembayaran') ? 'active' : '' }}">
                    <a href="{{ route('pembayaran') }}" class="sidebar-link">
                        <i class="lni lni-wallet"></i>
                        Jenis Pembayaran
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('kamar') ? 'active' : '' }}">
                    <a href="{{ route('kamar') }}" class="sidebar-link">
                        <i class="lni lni-layers"></i>
                        Kamar
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
