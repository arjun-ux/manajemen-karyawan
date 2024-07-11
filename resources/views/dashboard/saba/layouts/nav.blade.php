<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/"><img height="38"
                src="{{ asset('img/log.png') }}" width="38"></a>
        <button class="navbar-toggler" data-bs-target="#navbarNav" data-bs-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ">
                @guest
                    <li>
                        <a class="hover" href="/login">Login</a>
                    </li>
                    <li>
                        <a class="hover" href="/register-saba">Register</a>
                    </li>
                @else
                    <li>
                        <a class="hover" href="#"><img src="{{ asset('img/pp.png') }}" width="30px" alt="pp" class="rounded-circle img-fluid p-0"></a>
                        <div class="dropdown">
                            <a class="hover" href="/dashba">My Profile</a>
                            <a class="hover" id="logout" href="#">Log
                                Out</a>
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
                    });
                }
            });
        }
    </script>
@endpush
