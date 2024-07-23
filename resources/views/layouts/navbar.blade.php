<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="navbar">
            <div class="navbar-logo">
                <a href="{{ route('home') }}">
                    <img src="img/log.png" alt="Logo" height="40">
                </a>
            </div>
            @guest
                <div class="toggle-button" onclick="toggleMenu()">
                    <a href="#">&#9776;</a>
                </div>
                <div class="navbar-actions" id="navbarAction">
                    <a href="{{ route('register') }}">Daftar</a>
                    <a href="{{ route('login') }}">Masuk</a>
                </div>
            @else
                <div class="toggle-drop" onclick="toggleDrop()">
                    <a href="#">
                        {{ Auth::user()->name }}
                        <img src="img/pp.png" alt="pp" height="40">
                    </a>
                </div>
                <div class="dropdown-action" id="dropdownAction">
                    @if (Auth::user()->role === 'saba')
                    <a href="/dashba">My Profile</a>
                    <a href="#" id="logout">Log Out</a>
                    @elseif (Auth::user()->role === 'admin')
                    <a href="/dashmin">Dashboard</a>
                    <a href="#" id="logout">Log Out</a>
                    @endif
                </div>
            @endguest
        </div>
    </div>
</div>
@push('script')
    <script>
        function toggleMenu() {
            var navbarActions = document.getElementById('navbarAction');
            navbarActions.classList.toggle('show');
        }
        function toggleDrop(){
            var dropdownAction = document.getElementById('dropdownAction');
            dropdownAction.classList.toggle('show');
        }
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
