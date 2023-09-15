@extends('layouts.app1')
@section('content')

@php
    $state=0;
@endphp
<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <h3>Devam Eden Siparişler</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ayşe Kaya</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Yemek Adı - Açıklama Start creating your amazing application!
                    <div class="mt-4">
                        <form action="" method="POST">      
                            <div class="row">   
                                <div class="">
                                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                        @if($state == 0)
                                            <option value="0" selected>Hazırlanıyor</option>
                                            <option value="1">Yola Çıkarıldı</option>
                                        @elseif($state == 1)
                                            <option value="1" selected>Yola Çıkarıldı</option>
                                            <option value="2">Teslim Edildi</option>
                                        @endif
                                    </select>   
                                </div>
                                <div class="ml-3 mt-1"> <button class="btn btn-danger float-right">Durumu Kaydet</button></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    13.09.2023 16.06 <div class="float-right">Fiyat&#8378;</div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ayşe Kaya</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Yemek Adı - Açıklama Start creating your amazing application!
                    <div class="mt-4">
                        <form action="" method="POST">      
                            <div class="row">   
                                <div class="">
                                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                        @if($state == 0)
                                            <option value="0" selected>Hazırlanıyor</option>
                                            <option value="1">Yola Çıkarıldı</option>
                                        @elseif($state == 1)
                                            <option value="1" selected>Yola Çıkarıldı</option>
                                            <option value="2">Teslim Edildi</option>
                                        @endif
                                    </select>   
                                </div>
                                <div class="ml-3 mt-1"> <button class="btn btn-danger">Durumu Kaydet</button></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    13.09.2023 16.06 <div class="float-right">Fiyat&#8378;</div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ayşe Kaya</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Yemek Adı - Açıklama Start creating your amazing application!
                    <div class="mt-4">
                        <form action="" method="POST">      
                            <div class="row">   
                                <div class="">
                                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                        @if($state == 0)
                                            <option value="0" selected>Hazırlanıyor</option>
                                            <option value="1">Yola Çıkarıldı</option>
                                        @elseif($state == 1)
                                            <option value="1" selected>Yola Çıkarıldı</option>
                                            <option value="2">Teslim Edildi</option>
                                        @endif
                                    </select>   
                                </div>
                                <div class="ml-3 mt-1"> <button class="btn btn-danger">Durumu Kaydet</button></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    13.09.2023 16.06 <div class="float-right">Fiyat&#8378;</div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Öncü Döner</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Açıklama - Start creating your amazing application!
                    <div class="text-success text-sm mt-4">Durum - Hazırlanıyor</div>
                </div>
                <div class="card-footer">
                    13.09.2023 16.06 <div class="float-right">Fiyat&#8378;</div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Öncü Döner</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Açıklama - Start creating your amazing application!
                    <div class="text-success text-sm mt-4">Durum - Hazırlanıyor</div>
                </div>
                <div class="card-footer">
                    13.09.2023 16.06 <div class="float-right">Fiyat&#8378;</div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Öncü Döner</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Açıklama - Start creating your amazing application!
                    <div class="text-success text-sm mt-4">Durum - Hazırlanıyor</div>
                </div>
                <div class="card-footer">
                    13.09.2023 16.06 <div class="float-right">Fiyat&#8378;</div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Öncü Döner</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Açıklama - Start creating your amazing application!
                    <div class="text-danger text-sm mt-4">Durum - Yola Çıkarıldı!</div>
                </div>
                <div class="card-footer">
                    13.09.2023 16.06 <div class="float-right">Fiyat&#8378;</div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Öncü Döner</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Açıklama - Start creating your amazing application!
                    <div class="text-danger text-sm mt-4">Durum - Yola Çıkarıldı!</div>
                </div>
                <div class="card-footer">
                    13.09.2023 16.06 <div class="float-right">Fiyat&#8378;</div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        
        <div class="col-4">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Öncü Döner</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Açıklama - Start creating your amazing application!
                    <div class="text-danger text-sm mt-4">Durum - Yola Çıkarıldı!</div>
                </div>
                <div class="card-footer">
                    13.09.2023 16.06 <div class="float-right">Fiyat&#8378;</div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

</div><!-- /.container-fluid -->

@endsection