<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="width:450px;">
  <div class="login-logo">
    {{-- <a href="../../index2.html"><b>Giriş Yap</b></a> --}}
    <p class="text-secondary"><b>Giriş Yap</b></p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body mt-4">
      <form action="{{ route('login') }}" method="post">
        @csrf
        
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" style="background-color: rgba(255, 0, 0, 0.6);">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <ul style="list-style:none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="input-group mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
          <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Şifre') }}</label>
          <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                {{ __('Beni Hatırla') }}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Giriş Yap') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      @if (Route::has('password.request'))
      <a class="btn btn-link mb-1 mt-2" href="{{ route('password.request') }}">
          {{ __('Şifremi Unuttum') }}
      </a>
    @endif
      @if (Route::has('register'))
      <a class="btn btn-link mb-1 mt-2" href="{{ route('register') }}">
          {{ __('Yeni Üyelik Oluştur') }}
      </a>
    @endif
      {{-- <p class="mb-0">
        <a href="register.html" class="text-center">{{ __('Yeni Üyelik Oluştur') }}</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
