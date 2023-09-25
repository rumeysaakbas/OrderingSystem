@extends('layouts.app1')
@section('content')

    <div class="container-fluid">
        <div class="col-8 m-auto">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg"
                            alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                    <p class="text-muted text-center">2 Yıldır Üye</p>
                    <div class="card-header p-2">
                        <a class="nav-link m-auto btn btn-outline-primary" href="#settings" data-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="collapseExample"
                            data-toggle="tab">Settings</a>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="collapse" id="settings">

                                <form class="form-horizontal" action="{{ route('users.update', Auth::user()->id) }}" method="post">
                                    @csrf
                                    @method('put')

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

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">İsim Soyisim</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="edit_name" id="inputName"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="edit_email" id="inputEmail"
                                                value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputNumber" class="col-sm-2 col-form-label">Telefon Numarası</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="edit_phone_number" id="inputNumber"
                                                value="{{ Auth::user()->phone_number }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputAddress" class="col-sm-2 col-form-label">Adres</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="inputAddress" name="edit_address"
                                                value="{{ Auth::user()->address }}">
                                        </div>
                                    </div>

                                    <hr>
                                    @if (Auth::user()->role == '1')
                                        <div class="form-group row">
                                            <label for="store_name" class="col-sm-2 col-form-label">Restorant Adı</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="store_name" name="edit_store_name"
                                                    value="{{ Auth::user()->store->name }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="store_address" class="col-sm-2 col-form-label">Restorant
                                                Adresi</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="store_address" name="edit_store_address"
                                                    value="{{ Auth::user()->store->address }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="store_phone_number" class="col-sm-2 col-form-label">Restorant
                                                Telefon Numarası</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="store_phone_number"
                                                    name="edit_store_phone_number"
                                                    value="{{ Auth::user()->store->phone_number }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="store_email" class="col-sm-2 col-form-label">Restorant Email</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="store_email" name="edit_store_email"
                                                    value="{{ Auth::user()->store->email }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="store_explanation" class="col-sm-2 col-form-label">Açıklama</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="store_explanation" name="edit_store_explanation">{{ Auth::user()->store->explanation }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Değişklikleri Kaydet</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
