<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
        <!-- Right navbar links-->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">Giriş Yap</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">Kaydol</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sellerRegister') }}" class="nav-link">Restorant Kaydı</a>
            </li>
           {{-- <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">Giriş Yap</a>
            </li>  --}}
            {{-- <li class="nav-item">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-link">Kaydol</a>
            @endif
            </li> --}}
        </ul>
    </div>
    </nav>
    <!-- /.navbar -->



    <div class="container d-flex align-items-center mt-5">
            <div class="col align-self-center">

                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up the bulk of the card's
                            content.
                        </p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up the bulk of the card's
                            content.
                        </p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div><!-- /.card -->
            </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
</body>
</html>
