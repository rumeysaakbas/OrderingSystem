@extends('layouts.app1')
@section('content')
    <div class="container col-8">
        <div class="justify-content-center">

            <div class="row mt-3">
                <div class="col">
                    <h4 class="font-weight-bold">Yemek Ekle</h4>
                </div>
            </div>

            <form action="{{ route('foods.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group row mt-4">
                    <label for="food_name" name="food_name" class="col-sm-4 col-form-label">Yemek Adı</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" id="food_name" required
                            value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="category" class="col-sm-4 col-form-label">Kategori</label>
                    <div class="col-sm-8" id="category" name="category">
                        <select class="custom-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="stock" name="name" class="col-sm-4 col-form-label">Stok Adedi</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="stock" name="stock" min="1"
                            max="250" value="1" required>
                    </div>
                    @error('stock')
                        <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="explanation" name="explanation" class="col-sm-4 col-form-label"> Açıklama</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="explanation" id="explanation"> {{ old('explanation') }} </textarea>
                    </div>
                    @error('explanation')
                        <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="price" name="price" class="col-sm-4 col-form-label">Fiyat</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="price" name="price" min="0"
                            value="{{ old('price') }}">
                    </div>
                    @error('price')
                        <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="form-group row justify-content-around mt-4">
                    <div class="col-sm-6 rounded-left border" style="min-height: 170px; background-color:white;">
                        <select class="custom-select mt-5 align-self-center" id="nutritional_type" name="nutritional_type">
                            <option value="1">Kalori</option>
                            <option value="2">Protein</option>
                            <option value="3">Karbonhidrat</option>
                            <option value="4">Yağ</option>
                        </select>

                        <div class="input-group text-center mb-5" id="inputValue" >
                            <input type="number" class="form-control" placeholder="Besin Değeri Yazınız" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text rounded-right" id="basic-addon2">kj</span>
                            </div>
                            <button class="btn btn-dark ml-2" type="button" id="saveSelectValue">Kaydet</button>
                        </div>

                    </div>
                    <div class="col-sm-6 rounded-right border" style="min-height: 170px; background-color:white;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Besin Türü</th>
                                    <th scope="col">Besin Değeri</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="form-group row mt-5">
                    <div class="col-sm-4">
                        <button class="btn btn-dark" type="button" id="add_image">Resim Ekle</button>
                    </div>
                    <div class="col-sm-4" id="images">

                    </div>
                    @error('images')
                        <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                    @enderror
                    @error('images.*')
                        <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="cancel_button">İptal</button>
                    <button type="submit" class="btn btn-danger">Kaydet</button>
                </div>
            </form>
        </div>
    </div>

    <!-- form repeater -->
    <script>
        var max_image_count = 5;
        var image_count = 0;
        var is_selected = false;
        var imageContainer = document.getElementById('images');

        document.getElementById('add_image').addEventListener('click', function() {
            if (image_count < max_image_count && !is_selected) {
                is_selected = true;

                image_count++;
                var input = document.createElement('input');
                input.type = 'file';
                input.name = 'images[]';
                input.accept = 'image/*';
                input.className = 'mt-1';

                input.addEventListener('change', function() {
                    is_selected = false;
                });

                imageContainer.appendChild(input);
            }
        });

        document.getElementById('cancel_button').addEventListener('click', function() {
            imageContainer.innerHTML = '';
            image_count = 0;
            is_selected = false;
        });
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#explanation'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        const selectMenu = document.getElementById("nutritional_type");
        selectMenu.addEventListener("change", selectFunction);

        const saveSelectButton = document.getElementById("saveSelectValue");
        saveSelectButton.addEventListener("click", saveSelectValue);

        const inputValue = document.getElementById("inputValue");

        document.addEventListener("DOMContentLoaded", function () {
            inputValue.style.visibility = "hidden"; 
        });

        function selectFunction(event)
        {
            //console.log(event.target.parentNode);
            //console.log(selectMenu.parentNode);
            selectMenu.style.visibility = "hidden";
            inputValue.style.visibility = "visible";
        }

        function saveSelectValue(event)
        {
            inputValue.style.visibility = "hidden";
            selectMenu.style.visibility = "visible";
        }

    </script>
@endsection
