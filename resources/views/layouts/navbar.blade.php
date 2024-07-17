<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/"><img height="38"
                src="{{ asset('img/log.png') }}" width="38"></a>
        <button class="navbar-toggler" data-bs-target="#navbarNav" data-bs-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="hover" href="#kegiatan-pesantren">PONPES</a>
                </li>
                <li class="nav-item">
                    <a class="hover" href="#">TENTANG KAMI</a>
                    <div class="dropdown">

                    </div>
                </li>
                <li class="nav-item">
                    <a class="hover" href="#">ASRAMA</a>
                    <div class="dropdown">
                    </div>
                </li>
                <li class="nav-item">
                    <a class="hover" href="#">PSB</a>
                    <div class="dropdown">
                        <a class="hover" href="#jalur-pendaftaran">BIAYA PENDAFTARAN</a>
                        <a class="hover" href="#alur-pendaftaran">ALUR PENDAFTARAN</a>
                        <a class="hover" href="#faq">FAQ</a>
                    </div>
                </li>


            </ul>
            <ul class="navbar-nav ">

                @guest
                    <li>
                        <a class="hover" href="{{ route('login') }}">Login</a>
                    </li>
                    <li>
                        <a class="hover" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li>
                        <a class="hover" href="#"><img src="{{ asset('img/pp.png') }}" alt="profil" class="rounded-circle img-fluid p-0"
                                src="{{ asset('iaida/profile.jpg') }}" width="30"></a>
                        <div class="dropdown">
                            @if (Auth::user()->role === 'saba')
                                <a class="hover" href="/dashba">My Profile</a>
                                <a class="hover" data-bs-target="#modalMaba" data-bs-toggle="modal" href="#">Log
                                    Out</a>
                            @elseif (Auth::user()->role === 'admin')
                                <a class="hover" href="/dashmin">Dashboard</a>
                                <a class="hover" href="#" id="logout">Log Out</a>

                            @endif
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
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
                url: '/logout',
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
                        location.reload();
                        window.location.href = '/'
                    });
                }
            });
        }
    </script>
@endpush
