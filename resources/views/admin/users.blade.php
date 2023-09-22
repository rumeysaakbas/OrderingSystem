@extends('layouts.app1')

@section('content')


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

    <div class="container-fluid">
        <!-- Customer Table -->
        <div class="card mt-3">
            <div class="card-header">
                <h2 class="card-title mt-1 font-weight-bold">Müşteriler</h2>
                <div class="row float-right">
                    <button class="btn btn-primary mr-2" type="button" data-toggle="modal"
                        data-target="#create_customer">Müşteri Ekle</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="dataTable" class="table table-bordered table-hover  table-head-fixed">
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
                        @if ($customers)
                            @foreach ($customers as $customer)
                                <tr>
                                    <td id="customer_name_{{ $customer->id }}" data-value="{{ $customer->name }}">
                                        {{ $customer->name }}</td>
                                    <td id="customer_email_{{ $customer->id }}" data-value="{{ $customer->email }}">
                                        {{ $customer->email }}</td>
                                    <td id="customer_phone_number_{{ $customer->id }}"
                                        data-value="{{ $customer->phone_number }}"> {{ $customer->phone_number }} </td>
                                    <td id="customer_address_{{ $customer->id }}" data-value="{{ $customer->address }}">
                                        {{ $customer->address }}</td>
                                    <td><button id="customer_edit_button" type="button"
                                            class="btn btn-secondary customer_edit_button" data-target="#edit_customer"
                                            data-user-id="{{ $customer->id }}" data-toggle="modal">Düzenle</button></td>
                                    <td>
                                        <form method="post" class="delete_form"
                                            action="{{ route('users.destroy', $customer->id) }}">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="_method" value="Delete">
                                            <button class="btn btn-danger delete_button" data-toggle="tooltip"
                                                title='Delete' type="submit">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td> Kayıtlı Müşteri Bulunmamaktadır</td>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Seller Table-->
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="card-title mt-1 font-weight-bold">Satıcılar</h2>
                <div class="row float-right">
                    <button class="btn btn-primary mr-2" type="button" data-toggle="modal"
                        data-target="#create_seller">Restorant Ekle</button>
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive p-0">
                <table id="dataTable" class="table table-bordered table-hover  table-head-fixed ">
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
                        @if ($sellers)
                            @foreach ($sellers as $seller)
                                <tr>
                                    <td id="seller_name_{{ $seller->id }}" data-value="{{ $seller->name }}">
                                        {{ $seller->name }}</td>
                                    <td id="seller_email_{{ $seller->id }}" data-value="{{ $seller->email }}">
                                        {{ $seller->email }}</td>
                                    <td id="seller_phone_number_{{ $seller->id }}"
                                        data-value="{{ $seller->phone_number }}">{{ $seller->phone_number }}</td>
                                    <td id="seller_address_{{ $seller->id }}" data-value="{{ $seller->address }}">
                                        {{ $seller->address }}</td>
                                    <td id="store_name_{{ $seller->id }}" data-value="{{ $seller->store->name }}">
                                        {{ $seller->store->name }}</td>
                                    <td id="store_address_{{ $seller->id }}" data-value="{{ $seller->store->address }}">
                                        {{ $seller->store->address }}</td>
                                    <td id="store_phone_number_{{ $seller->id }}"
                                        data-value="{{ $seller->store->phone_number }}">{{ $seller->store->phone_number }}
                                    </td>
                                    <td id="store_email_{{ $seller->id }}" data-value="{{ $seller->store->email }}">
                                        {{ $seller->store->email }}</td>
                                    <td id="store_explanation_{{ $seller->id }}"
                                        data-value="{{ $seller->store->explanation }}">{{ $seller->store->explanation }}
                                    </td>
                                    <td><button class="btn btn-secondary seller_edit_button" id="seller_edit_button"
                                            type="button" data-toggle="modal" data-target="#edit_seller" user-type="seller"
                                            data-user-id="{{ $seller->id }}">Düzenle</button></td>
                                    <td>
                                        <form method="post" class="delete_form"
                                            action="{{ route('users.destroy', $seller->id) }}">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger delete_button" type="submit">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td>Kayıtlı Satıcı Bulunmamaktadır</td>
                        @endif
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
                    <form action="{{ route('users.create') }}" method="post">
                        @csrf

                        <input type="hidden" name="registration_type" value="customer">

                        <div class="form-group row">
                            <label for="name" name="name" class="col-sm-4 col-form-label">İsim Soyisim</label>
                            <div class="col-sm-8">
                                <input type="text" name="customer_name" class="form-control" id="name" required
                                    value="{{ old('customer_name') }}">
                            </div>
                            @error('customer_name')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email" name="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="customer_email" required
                                    value="{{ old('customer_email') }}">
                            </div>
                            @error('customer_email')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" name="phone_number" class="col-sm-4 col-form-label">Telefon
                                Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="customer_phone_number"
                                    id="phone_number" maxlength="15" required
                                    value="{{ old('customer_phone_number') }}">
                            </div>
                            @error('customer_phone_number')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="address" name="address" class="col-sm-4 col-form-label">Adres</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" name="customer_address"
                                    maxlength="250" required value="{{ old('customer_address') }}">
                            </div>
                            @error('customer_address')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="password" name="password" class="col-sm-4 col-form-label">Şifre</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="customer_password" id="password"
                                    required>
                            </div>
                            @error('customer_password')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
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
                    <form action="{{ route('users.create') }}" method="post">
                        @csrf
                        <input type="hidden" name="registration_type" value="seller">
                        <div class="form-group row">
                            <label for="name" name="name" class="col-sm-4 col-form-label">İsim Soyisim</label>
                            <div class="col-sm-8">
                                <input type="text" name="seller_name" class="form-control" id="name" required
                                    maxlength="250" value="{{ old('seller_name') }}">
                            </div>
                            @error('seller_name')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email" name="name" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="seller_email" required
                                    maxlength="200" value="{{ old('seller_email') }}">
                            </div>
                            @error('seller_email')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" name="phone_number" class="col-sm-4 col-form-label">Telefon
                                Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="seller_phone_number" id="phone_number"
                                    maxlength="250" required value="{{ old('seller_phone_number') }}">
                            </div>
                            @error('seller_phone_number')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="address" name="address" class="col-sm-4 col-form-label">Adres</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" name="seller_address"
                                    maxlength="250" required value="{{ old('seller_address') }}">
                            </div>
                            @error('seller_address')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="store_name" name="store_name" class="col-sm-4 col-form-label">Restorant
                                Adı</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_name" name="store_name"
                                    maxlength="250" required value="{{ old('store_name') }}">
                            </div>
                            @error('store_name')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="store_address" name="store_address" class="col-sm-4 col-form-label">Restorant
                                Adresi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_address" name="store_address"
                                    maxlength="250" required value="{{ old('store_address') }}">
                            </div>
                            @error('store_address')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="store_phone_number" name="store_phone_number"
                                class="col-sm-4 col-form-label">Restorant Telefon Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_phone_number"
                                    name="store_phone_number" maxlength="15" required
                                    value="{{ old('store_phone_number') }}">
                            </div>
                            @error('store_phone_number')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="store_email" name="store_email" class="col-sm-4 col-form-label">Restorant
                                Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="store_email" name="store_email"
                                    maxlength="200" value="{{ old('store_email') }}">
                            </div>
                            @error('store_email')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="store_explanation" name="store_explanation"
                                class="col-sm-4 col-form-label">Açıklama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="store_explanation"
                                    name="store_explanation" maxlength="250" value="{{ old('store_explanation') }}">
                            </div>
                            @error('store_explanation')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password" name="password" class="col-sm-4 col-form-label">Şifre</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="seller_password" id="password">
                            </div>
                            @error('seller_password')
                                <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                            @enderror
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

    <!-- Modal edit customer-->
    <div class="modal fade" id="edit_customer" tabindex="-1" aria-labelledby="edit_label" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="edit_label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="post" id="edit_customer_form">
                    @method('put')
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" name="user_id" id="customer_id" value="">

                        <div class="form-group row">
                            <label for="name" name="name" class="col-sm-4 col-form-label">İsim Soyisim</label>
                            <div class="col-sm-8">
                                <input type="text" name="edit_name" class="form-control" id="edit_customer_name"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" name="name" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="edit_email" class="form-control" id="edit_customer_email"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" name="phone_number" class="col-sm-4 col-form-label">Telefon
                                Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="edit_phone_number"
                                    id="edit_customer_phone_number" required maxlength="15">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" name="address" class="col-sm-4 col-form-label">Adres</label>
                            <div class="col-sm-8">
                                <input type="text" name="edit_address" class="form-control"
                                    id="edit_customer_address" maxlength="250" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-danger" id="">Değişiklikleri Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit seller-->
    <div class="modal fade" id="edit_seller" tabindex="-1" aria-labelledby="edit_label" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="edit_label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="post" id="edit_seller_form">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">

                            <input type="hidden" name="user_id" id="seller_id" value="">

                            <label for="name" name="name" class="col-sm-4 col-form-label">İsim Soyisim</label>
                            <div class="col-sm-8">
                                <input type="text" name="edit_name" class="form-control" id="edit_seller_name"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" name="name" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="edit_email" class="form-control" id="edit_seller_email"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" name="phone_number" class="col-sm-4 col-form-label">Telefon
                                Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="edit_phone_number"
                                    id="edit_seller_phone_number" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" name="address" class="col-sm-4 col-form-label">Adres</label>
                            <div class="col-sm-8">
                                <input type="text" name="edit_address" class="form-control" id="edit_seller_address"
                                    required>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="store_name" name="store_name" class="col-sm-4 col-form-label">Restorant
                                Adı</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="edit_store_name" name="edit_store_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_address" name="store_address" class="col-sm-4 col-form-label">Restorant
                                Adresi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="edit_store_address"
                                    name="edit_store_address">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_phone_number" name="store_phone_number"
                                class="col-sm-4 col-form-label">Restorant Telefon Numarası</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="edit_store_phone_number"
                                    name="edit_store_phone_number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_email" name="store_email" class="col-sm-4 col-form-label">Restorant
                                Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="edit_store_email"
                                    name="edit_store_email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="store_explanation" name="store_explanation"
                                class="col-sm-4 col-form-label">Açıklama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="edit_store_explanation"
                                    name="edit_store_explanation">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-danger" id="">Değişiklikleri Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.sweetAlert')

    <!-- script for modals inputs -->
    <script>
        // customer modal
        document.querySelectorAll(".customer_edit_button").forEach(button => {
            button.addEventListener("click", function() {
                const userId = this.getAttribute("data-user-id");

                const name = document.getElementById("customer_name_" + userId).getAttribute(
                    "data-value");
                const email = document.getElementById("customer_email_" + userId).getAttribute(
                    "data-value");
                const phone_number = document.getElementById("customer_phone_number_" + userId)
                    .getAttribute("data-value");
                const address = document.getElementById("customer_address_" + userId).getAttribute(
                    "data-value");

                document.getElementById("customer_id").value = userId;
                document.getElementById("edit_customer_name").value = name;
                document.getElementById("edit_customer_email").value = email;
                document.getElementById("edit_customer_phone_number").value = phone_number;
                document.getElementById("edit_customer_address").value = address;

                $('#edit_customer').modal('show');

                var edit_form = document.getElementById("edit_customer_form");
                edit_form.action = "{{ route('users.update', '') }}/" + userId;
            });
        });


        // seller modal
        document.querySelectorAll(".seller_edit_button").forEach(button => {
            button.addEventListener("click", function() {
                const userId = this.getAttribute("data-user-id");

                const name = document.getElementById("seller_name_" + userId).getAttribute("data-value");
                const email = document.getElementById("seller_email_" + userId).getAttribute("data-value");
                const phone_number = document.getElementById("seller_phone_number_" + userId).getAttribute(
                    "data-value");
                const address = document.getElementById("seller_address_" + userId).getAttribute(
                    "data-value");
                const store_name = document.getElementById("store_name_" + userId).getAttribute(
                    "data-value");
                const store_address = document.getElementById("store_address_" + userId).getAttribute(
                    "data-value");
                const store_phone_number = document.getElementById("store_phone_number_" + userId)
                    .getAttribute("data-value");
                const store_email = document.getElementById("store_email_" + userId).getAttribute(
                    "data-value");
                const store_explanation = document.getElementById("store_explanation_" + userId)
                    .getAttribute("data-value");

                document.getElementById("seller_id").value = userId;
                document.getElementById("edit_seller_name").value = name;
                document.getElementById("edit_seller_email").value = email;
                document.getElementById("edit_seller_phone_number").value = phone_number;
                document.getElementById("edit_seller_address").value = address;
                document.getElementById("edit_store_name").value = store_name;
                document.getElementById("edit_store_address").value = store_address;
                document.getElementById("edit_store_phone_number").value = store_phone_number;
                document.getElementById("edit_store_email").value = store_email;
                document.getElementById("edit_store_explanation").value = store_explanation;

                $('#edit_seller').modal('show');
                var edit_form = document.getElementById("edit_seller_form");
                edit_form.action = "{{ route('users.update', '') }}/" + userId;
            });
        });
    </script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#dataTable').DataTable({
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
