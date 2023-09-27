@extends('layouts.app1')
@section('content')

    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <h3>Devam Eden Siparişler</h3>
            </div>
        </div>

        @if ($orders->isNotEmpty())
            @if (Auth::user()->role ==="seller")
                <div class="row">
                    @foreach ($orders as $order)
                        <div class="col-4">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $order->customer->name }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $order->food ? $order->food->name .' | '.$order->food->explanation : 'İlgili Yemek Bulunamadı' }}
                                    <div class="mt-4">
                                        <form action="{{ route('orders.update', $order->id) }}" method="POST"
                                            class="orderForm">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                @csrf
                                                @method('put')
                                                <div class="">
                                                    <select class="custom-select my-1 mr-sm-2 orderStatus" name="status">
                                                        @if ($order->status == 0)
                                                            <option value="0" selected>Hazırlanıyor</option>
                                                            <option value="1">Yola Çıkarıldı</option>
                                                        @elseif($order->status == 1)
                                                            <option value="1" selected>Yola Çıkarıldı</option>
                                                            <option value="2">Teslim Edildi</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="ml-3 mt-1"> <button
                                                        class="btn btn-danger float-right saveButton" type="submit">Durumu
                                                        Kaydet</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {{ $order->created_at->format('Y.m.d H:i') }} <div class="float-right">{{ $order->paid_price }}&#8378;</div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    @endforeach
                </div>
            @endif

            @if (Auth::user()->role === "customer")
                <div class="row mt-4">
                    @foreach ($orders as $order)
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        {{ $order->food ? $order->food->name : 'İlgili Yemek Bulunamadı' }}
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $order->store ? $order->store->name : 'İlgili Restorant Bulunamadı' }}
                                    {{ $order->food ? $order->food->explanation : ' ' }}
                                    @if ($order->status === 0)
                                        <div class="text-success text-sm mt-4">Durum - Hazırlanıyor</div>
                                    @else
                                        <div class="text-danger text-sm mt-4">Durum - Yola Çıkarıldı!</div>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    {{ $order->created_at->format('Y.m.d H:i') }} <div class="float-right">{{ $order->paid_price }}&#8378;</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <div> Devam Eden Sipariş Bulunmamakta</div>
        @endif

    </div><!-- /.container-fluid -->

    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const orderForms = document.querySelectorAll(".orderForm");

        //     orderForms.forEach(function(form) {
        //         const orderStatus = form.querySelector(".orderStatus");
        //         const saveButton = form.querySelector(".saveButton");
        //         let currentStatus = orderStatus.value;

        //         // form.addEventListener("submit", function(event) {
        //         //     event.preventDefault();

        //         // });

        //         form.addEventListener("submit", function(event) {
        //             // Eğer önceki durum 0 (Hazırlanıyor) ise ve yeni durum 1 (Yola Çıkarıldı) ise formu gönder
        //             if ((currentStatus == 0 && orderStatus.value == 1) || (currentStatus == 1 && orderStatus.value == 2)) {
        //                 form.submit();
        //             } else {
        //                 event.preventDefault();
        //             }

        //             // Şu anki durumu kaydet
        //             currentStatus = orderStatus.value;
        //         });

        //     });
        // });

        document.addEventListener("DOMContentLoaded", function() {
            const orderForms = document.querySelectorAll(".orderForm");

            orderForms.forEach(function(form) {
                const orderStatus = form.querySelector(".orderStatus");
                const saveButton = form.querySelector(".saveButton");
                let currentStatus = orderStatus.value;

                form.addEventListener("submit", function(event) {
                    event.preventDefault();
                });

                orderStatus.addEventListener("change", function() {
                    const newStatus = orderStatus.value;

                    if ((currentStatus === "0" && newStatus === "1") || (currentStatus === "1" &&
                            newStatus === "2")) {
                        saveButton.addEventListener("click", function() {
                            form.submit();
                        })
                    } else {
                        currentStatus = orderStatus.value;
                    }
                });
            });
        });
    </script>

@endsection
