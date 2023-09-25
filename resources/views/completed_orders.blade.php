@extends('layouts.app1')
@section('content')

    @php
        $role = '0';
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Tamamlanan Siparişler</h3>
            </div>
        </div>

        @if ($orders->isNotEmpty())
            <div class="row mt-3">
                @if ($role === '0')
                    @foreach ($orders as $order)
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        {{ $order->store ? $order->store->name : 'İlgili Restorant Bulunamadı' }}
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $order->food ? $order->food->name : 'İlgili Yemek Bulunamadı' }}
                                </div>
                                <div class="card-footer">
                                    {{ $order->created_at }} <div class="float-right">{{ $order->paid_price }}&#8378;</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="row">
                @if ($role === '1')
                    @foreach ($orders as $order)
                        <div class="col-4">
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
                                    {{ $order->food ? $order->food->name : 'İlgili Yemek Bulunamadı' }}
                                </div>
                                <div class="card-footer">
                                    {{ $order->created_at }} <div class="float-right">{{ $order->paid_price }}&#8378;</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        @else
        Sipariş Bulunmamaktadır
        @endif

    </div><!-- /.container-fluid -->

@endsection
