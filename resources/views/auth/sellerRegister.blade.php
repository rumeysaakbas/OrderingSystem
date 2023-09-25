<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page col">
    <div class="register-box justify-content-center mt-3 mb-3" style="width:600px;">
        <div class="register-logo">
            <p class="text-secondary"><b>Satıcı Başvuru Formu</b></p>
        </div>


        <div class="card">
            <div class="card-body register-card-body">


                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show"
                        style="background-color: rgba(255, 0, 0, 0.6);">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <ul style="list-style:none;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="registration_type" value="seller">
                    <div class="input-group mb-2">
                        <label for="name" class="col-md-4 col-form-label text-md-end">İsim Soyisim</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus maxlength="255">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <input type="email"id="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" maxlength="200">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-end">Telefon Numarası</label>
                        <input type="text" id="phone_number"
                            class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                            value="{{ old('phone_number') }}" required autocomplete="phone_number" maxlength="15">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">Adres</label>
                        <input type="text" id="address" class="form-control @error('address') is-invalid @enderror"
                            name="address" value="{{ old('address') }}" required autocomplete="address" maxlength="255">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="nav-icon fas fa-tree"></span>
                            </div>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="store_name" class="col-md-4 col-form-label text-md-end">Restorant Adı</label>
                        <input type="text" id="store_name"
                            class="form-control @error('store_name') is-invalid @enderror" name="store_name"
                            value="{{ old('store_name') }}" required autocomplete="store_name" maxlength="255">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="nav-icon fas fa-image"></span>
                            </div>
                            @error('store_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="store_address" class="col-md-4 col-form-label text-md-end">Restorant
                            Adresi</label>
                        <input type="text" id="store_address"
                            class="form-control @error('store_address') is-invalid @enderror" name="store_address"
                            value="{{ old('store_address') }}" required autocomplete="store_address" maxlength="255">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="nav-icon fas fa-pen"></span>
                            </div>
                            @error('store_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="store_phone_number" class="col-md-4 col-form-label text-md-end">Restorant Telefon
                            Numarası</label>
                        <input type="text" id="store_phone_number"
                            class="form-control @error('store_phone_number') is-invalid @enderror"
                            name="store_phone_number" value="{{ old('store_phone_number') }}" required
                            autocomplete="store_phone_number" maxlength="15">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="nav-icon fas fa-phone"></span>
                            </div>
                            @error('store_phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="store_email" class="col-md-4 col-form-label text-md-end">Restorant Email</label>
                        <input type="email" id="store_email"
                            class="form-control @error('store_email') is-invalid @enderror" name="store_email"
                            value="{{ old('store_email') }}" autocomplete="store_email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="nav-icon far fa-envelope"></span>
                            </div>
                            @error('store_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="explanation" class="col-md-4 col-form-label text-md-end">Açıklama</label>
                        <input type="email" id="explanation"
                            class="form-control @error('explanation') is-invalid @enderror" name="explanation"
                            value="{{ old('explanation') }}" autocomplete="explanation">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="nav-icon fas fa-edit"></span>
                            </div>
                            @error('explanation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Şifre</label>
                        <input type="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" minlength="8">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Şifre
                            Doğrulama</label>
                        <input type="password" class="form-control" name="password_confirmation" required
                            autocomplete="new-password" minlength="8">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Kayıt</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }} "></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }} "></script>
</body>

</html>
