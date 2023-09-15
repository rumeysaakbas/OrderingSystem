@extends('layouts.app1')
@section('content')

@php
    $role='seller';
@endphp
<div class="container-fluid">
    <div class="col-8 m-auto">
        
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">name</h3>

                <p class="text-muted text-center">2 Yıldır Üye</p>

                {{-- <a href="#settings" class="btn btn-primary btn-block nav-item"><b>Settings</b></a> --}}
                <div class="card-header p-2">
                    {{-- <ul class="nav nav-pills">
                        <li class="nav-item m-auto btn btn-primary"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul> --}}
                    <a class="nav-link m-auto btn btn-primary" href="#settings" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample" data-toggle="tab">Settings</a>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="collapse" id="settings">
                        <form class="form-horizontal" action="" method="put">
                            @csrf
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Ad Soyad</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="inputName">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email"  id="inputEmail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Telefon Numarası</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone_number" id="inputNumber">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputAddress" class="col-sm-2 col-form-label">Adres</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="inputAddress" name="address">
                                </div>
                            </div>
                            <hr>
                            @if ($role=='seller')
                                
                            
                            <div class="form-group row">
                                <label for="store_name" class="col-sm-2 col-form-label">Restorant Adı</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="store_name" name="store_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="store_address" class="col-sm-2 col-form-label">Restorant Adresi</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="store_address" name="store_address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="store_phone_number" class="col-sm-2 col-form-label">Restorant Telefon</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="store_phone_number" name="store_phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="store_email" class="col-sm-2 col-form-label">Restorant Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="store_email" name="store_email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="store_explanation" class="col-sm-2 col-form-label">Açıklama</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="store_explanation" name="store_explanation"></textarea>
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