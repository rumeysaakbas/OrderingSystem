@extends('layouts.app1')
@php
    $role='customer'
@endphp
@section('content')
    <div class="container-fluid">
      <!-- Customer Table -->
        <div class="card">
          <div class="card-header">
              <h2 class="card-title mt-1 font-weight-bold">Müşteriler</h2>
              <div class="row float-right">
                  <button class="btn btn-primary mr-2" type="button" data-toggle="modal"
                      data-target="#create_customer">Müşteri Ekle</button>
              </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="height: 450px;">
              <table id="example2" class="table table-bordered table-hover  table-head-fixed">
                  <thead>
                      <tr>
                          <th>İsim</th>
                          <th>Email</th>
                          <th>Telefon numarası</th>
                          <th>Adres</th>
                          <th>Düzenle</th>
                          <th>Sil</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($customers as $customer)
                      <tr>
                          <td>{{ $customer->name }}</td>
                          <td>{{ $customer->email }}</td>
                          <td>{{ $customer->phone_number }}</td>
                          <td>{{ $customer->address }}</td>
                          <td><button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#edit">Düzenle</button></td>
                          <td><button class="btn btn-danger">Sil</button></td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
          <!-- /.card-body -->
      </div>
      <!-- /.card -->

        <!-- Seller Table-->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title mt-1 font-weight-bold">Satıcılar</h2>
                <div class="row float-right">
                    <button class="btn btn-primary mr-2" type="button" data-toggle="modal"
                        data-target="#create_seller">Restorant Ekle</button>
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive p-0" style="height: 450px;">
                <table id="example2" class="table table-bordered table-hover  table-head-fixed ">
                    <thead>
                        <tr>
                            <th>İsim</th>
                            <th>Email</th>
                            <th>Telefon numarası</th>
                            <th>Adres</th>
                            <th>Restorant Adı</th>
                            <th>Restorant Adresi</th>
                            <th>Restorant Telefon Numarası</th>
                            <th>Restorant Email</th>
                            <th>Açıklama</th>
                            <th>Düzenle</th>
                            <th>Sil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $seller)
                        <tr>
                            <td>{{ $seller->name }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->phone_number }}</td>
                            <td>{{ $seller->address }}</td>
                            <td>{{ $seller->store->name }}</td>
                            <td>{{ $seller->store->address }}</td>
                            <td>{{ $seller->store->phone_number }}</td>
                            <td>{{ $seller->store->email }}</td>
                            <td>{{ $seller->store->explanation }}</td>
                            <td><button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#edit">Düzenle</button></td>
                            <td><button class="btn btn-danger">Sil</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div><!-- /.container-fluid -->

    <!-- Modal create customer -->
    <div class="modal fade" id="create_customer" tabindex="-1" aria-labelledby="create_customer_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="create_customer_label">Müşteri Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="registration_type" value="customer">
                        <div class="form-group row">
                            <label for="name" name="name" class="col-sm-4 col-form-label">İsim Soyisim</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" name="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" name="phone_number" class="col-sm-4 col-form-label">Telefon
                                Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone_number" id="phone_number" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" name="address" class="col-sm-4 col-form-label">Adres</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" name="password" class="col-sm-4 col-form-label">Şifre</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-danger">Kaydet</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal create seller -->
    <div class="modal fade" id="create_seller" tabindex="-1" aria-labelledby="create_seller_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="create_seller_label">Satıcı Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="registration_type" value="seller">
                        <div class="form-group row">
                            <label for="name" name="name" class="col-sm-4 col-form-label">İsim Soyisim</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="name" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" name="name" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" name="phone_number" class="col-sm-4 col-form-label">Telefon
                                Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone_number" id="phone_number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" name="address" class="col-sm-4 col-form-label">Adres</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" name="address" >
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="store_name" name="store_name" class="col-sm-4 col-form-label">Restorant
                                Adı</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_name" name="store_name" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="store_address" name="store_address" class="col-sm-4 col-form-label">Restorant
                                Adresi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_address" name="store_address">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_phone_number" name="store_phone_number"
                                class="col-sm-4 col-form-label">Restorant Telefon Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_phone_number"
                                    name="store_phone_number" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_email" name="store_email" class="col-sm-4 col-form-label">Restorant
                                Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_email" name="store_email" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="store_explanation" name="store_explanation"
                                class="col-sm-4 col-form-label">Açıklama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_explanation"
                                    name="store_explanation" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" name="password" class="col-sm-4 col-form-label">Şifre</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="password" >
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-danger">Kaydet</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal edit -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="edit_label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" name="name" class="col-sm-4 col-form-label">İsim Soyisim</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" name="name" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" name="phone_number" class="col-sm-4 col-form-label">Telefon
                                Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone_number" id="phone_number"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" name="address" class="col-sm-4 col-form-label">Adres</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        @if ($role=='seller')
                        <hr>
                        <div class="form-group row">
                            <label for="store_name" name="store_name" class="col-sm-4 col-form-label">Restorant
                                Adı</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_name" name="store_name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="store_address" name="store_address" class="col-sm-4 col-form-label">Restorant
                                Adresi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_address" name="store_address"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_phone_number" name="store_phone_number"
                                class="col-sm-4 col-form-label">Restorant Telefon Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_phone_number"
                                    name="store_phone_number" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_email" name="store_email" class="col-sm-4 col-form-label">Restorant
                                Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="store_email" name="store_email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="store_explanation" name="store_explanation"
                                class="col-sm-4 col-form-label">Açıklama</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="store_explanation"
                                    name="store_explanation" required>
                            </div>
                        </div>
                        @endif


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-danger">Değişiklikleri Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
