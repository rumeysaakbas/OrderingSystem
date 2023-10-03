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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yemekler</h3>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#valueType">Ölçü Birimi
                        Ekle</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Yemek Adı</th>
                                <th>Sipariş Oranı</th>
                                <th>Sipariş Sayısı</th>
                                <th> Malzeme Ekle </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $food)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $food->name }}</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger"
                                                style="width: {{ ($food->order_count / $totalOrders) * 100 }}%; "></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">{{ $food->order_count }}</span></td>
                                    <td><a href="{{ route('rawMaterial.create', $food->id) }}" type="button"
                                            class="btn btn-secondary">Malzeme Ekle</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


        <!-- value type modal -->
        <div class="modal fade" id="valueType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ölçü Birimi Ekle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('valueType.create') }}" method="post"
                            class="form-inline justify-content-center">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm">
                                    <label for="value_type" name="value_type" class="col-form-label">Ölçü Birimi</label>
                                </div>
                                <div class="col-sm">
                                    <input type="text" name="value_type" class="form-control" id="value_type" required
                                        value="{{ old('value_type') }}">
                                </div>
                                <div class="col-sm">
                                    <button type="submit" class="btn btn-primary float-right">Kaydet</button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <div>
                            <ul class="list-group">
                                @foreach ($value_types as $value_type)
                                    <li class="list-group-item">
                                        <div class="row d-flex justify-content-between">
                                            <p id="value_type_name_{{ $value_type->id }}">{{ $value_type->name }}</p>
                                            <div class="buttons float-right d-flex justify-content-end">
                                                <form action="" method="post" class="form-inline">
                                                    @csrf
                                                    @method('put')

                                                    <button class="btn btn-secondary edit_button" type="button"
                                                        value-type-id="{{ $value_type->id }}">Düzenle</button>
                                                </form>
                                                <form method="post"
                                                    action="{{ route('valueType.delete', $value_type->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger ml-2" type="submit">Sil</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="editValueTypeContainer form-group row">

                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="modal-footer mt-5">

                    </div>

                </div>
            </div>
        </div>

            <!-- value type update -->
    <script>
        const editButtons = document.querySelectorAll(".edit_button");
        editButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const valueTypeId = event.target.getAttribute("value-type-id");
                const valueTypeName = document.getElementById("value_type_name_" + valueTypeId).innerText;
                const form = event.target.closest("form");
                console.log(valueTypeName);
                console.log(valueTypeId);

                if (!form.classList.contains("input-added")) {
                    const input = document.createElement("input");
                    input.className = "form-control";
                    input.type = "text";
                    input.name = "edit_value_type_name";
                    input.id = "editted_value_type_name_"+valueTypeId;
                    input.value = valueTypeName;

                    form.insertBefore(input, button);
                    form.classList.add("input-added");
                }

                button.className = "btn btn-dark edit_button float-right ml-1";
                button.innerText = "Kaydet";

                button.addEventListener("click", function() {
                    if( valueTypeName != document.getElementById("editted_value_type_name_" + valueTypeId).value){
                        form.action = "{{ route('valueType.update', '') }}/" + valueTypeId;
                        form.submit();
                    }
                });
            });
        });


    </script>
    @endsection
    
