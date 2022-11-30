<?php
    use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
    </head>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="height: 65px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">PROJECT-WP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a href="/risky-place" class="nav-link">สถานที่เสี่ยง</a>
                    </li>
                    <li class="nav-item">
                        <?php
                            if (!Auth::user()) : ?>
                            <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal" style="border: none; background-color: transparent;">เข้าสู่ระบบ</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบ</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" class="login-form" action="{{ route('authenticate') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <div>
                                                        <label for="email">E-mail</label>
                                                        <input type="text" class="form-control" name="email" placeholder="E-mail" required>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div>
                                                    <button type="submit" name="login" class="btn btn-primary btn-sm">Login</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (Auth::user() && Auth::user()->role = 'Admin') : ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="/manager/reports">จัดการข้อมูล</a>
                                </li>
                        <?php endif ?>
                        <?php if (Auth::user()) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="/auth/logout">ออกจากระบบ</a>
                                </li>
                        <?php endif ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </header>
    <body>
        @yield('content')
        @if(session()->has('auth-success'))
            <div class="alert">
                <script>
                    Swal.fire({
                        title: 'สำเร็จ!',
                        text: 'เข้าสู่ระบบสำเร็จแล้ว',
                        icon: 'success',
                        timer: 1000,
                        timerProgressBar: true
                    });
                </script>
            </div>
        @endif
        @if (session()->has('logout-success'))
            <script>
                Swal.fire({
                    title: 'สำเร็จ!',
                    text: 'ออกจากระบบแล้ว',
                    icon: 'success',
                    timer: 1000,
                    timerProgressBar: true
                });
            </script>
        @endif
    </body>
</html>