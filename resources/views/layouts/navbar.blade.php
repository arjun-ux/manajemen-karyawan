<nav class="navbar navbar-expand px-4 py-3">
    <!-- Button trigger modal -->
    <button type="button" id="btn_modalSidebar" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalMobile">
    &#9776;
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalMobile" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">SISTEM MANAJEMEN KARYAWAN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <li class="li_pro">
                        <a class="pro" href="">
                            <i class="lni lni-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="li_pro">
                        <a class="pro" href="#" class="collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="lni lni-users"></i>
                            <span>User</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown collapse" data-bs-parent="#sidebar">
                            <li class="li_pro">
                                <a class="pro" href="">
                                    <i class="lni lni-user"></i>
                                    Admin
                                </a>
                            </li>
                            <li class="li_pro">
                                <a class="pro" href="">
                                    <i class="lni lni-user"></i>
                                    Santri
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="li_pro">
                        <a class="pro" href="#" class="collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#settings" aria-expanded="false" aria-controls="settings">
                            <i class="lni lni-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </div>


    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    Selamat Datang, <strong>{{ Auth::user()->name }}</strong>
                    <img class="avatar img-fluid"
                        src="{{ asset('img/users.png') }}">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-end border-0"
                    aria-labelledby="userDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" id="logout" href="#">
                        <i class="lni lni-power-switch"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
@push('script')
    <script>
        $('#logout').click(function(e){
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Apakah Anda Yakin Keluar?',
                toast: true,
                position: 'top',
                showCancelButton: true,
            }).then((value)=>{
                if(value.isConfirmed){
                    logout();
                }
            });
        });
        function logout(){
            $.ajax({
                url: '{{ route('logout') }}',
                type: 'GET',
                success: function(res){
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        toast: true,
                        showConfirmButton: false,
                        timer: 1500,
                        position: 'top-end',
                        timerProgressBar: true,
                    }).then(()=>{
                        window.location.href = '{{ route('login') }}'
                    });
                }
            });
        }
    </script>
@endpush
