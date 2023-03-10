<!DOCTYPE html>
<html>

<head>
    <title>Perpustakaan sebagai salah satu sumber belajar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container" style="background:#ccc">
        <div class="alert alert-info text-center">
            <h4 style="margin-bottom: 10px"><b>Selamat datang </b>di Perpustakaan Bersama</h4>
        </div>
        <div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/databuku">Data Buku</a>
                        </li>

                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/buku"> Tambah Buku
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-12 mt-3">
            <img src="{{ asset('image') }}/banner.jpeg" width="100%" height="280px">
        </div>
        <div>
            @yield('content')
        </div>
        <div class="col-md-12">
            <div class="row" style="background:#ccc">

            </div>
        </div>
    </div>

    <script>
    // Menangani klik tombol Tambah Buku
    document.getElementById("btnTambahBuku").addEventListener("click", function() {
        // Menampilkan modal
        $('#modalBukuTambah').modal('show');
    });
    document.getElementById("btnEditBuku").addEventListener("click", function() {
        // Menampilkan modal
        $('#modalBukuEdit').modal('show');
    });
    $(document).ready(function() {
        $('#formbukuedit').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(response) {
                    $('#modalBukuEdit').modal('hide');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>


</body>

</html>