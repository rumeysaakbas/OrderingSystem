<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yemek Sipariş Uygulaması</title>

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
        <!-- Right navbar links-->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link text-dark">Giriş Yap</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link text-dark">Kaydol</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register.seller') }}" class="nav-link text-dark">Restorant Kaydı</a>
            </li>
        </ul>
    </div>
    </nav>
    <!-- /.navbar -->



    <div class="container d-flex justify-content-center mt-5">
        <div class="col-8 mt-5">
    
            <div class="card card-primary card-outline mt-5">
                <div class="card-body">
                    <div class="text-center" style="font-size: 25px;">Anasayfa'yı görüntülemek için giriş yapın</div>
                    <p class="card-text">
                       
                    </p>
                </div>
            </div>
    
        </div>
    </div>
    

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
