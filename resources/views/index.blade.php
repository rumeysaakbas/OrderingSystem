@extends('layouts.app1')
@section('content')


<div class="container">

    <div class="row">
        <div class="col-12">
            <button class="btn btn-danger float-right" type="button" data-toggle="modal" data-target="#create_food">Yemek Ekle</button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-4">
            <div class="card">
                <h5 class="card-header">Yemek Adı</h5>
                <div class="card-body">
                    <p class="card-text">Stok: 56</p> 
                    <p class="card-text">Açıklama - With supporting text below as a natural lead-in to additional content.</p> 
                    <p>Fiyat&#8378;</p>
                    <div class="row justify-content-end">
                        <button class="btn btn-secondary mr-2" type="button" data-toggle="modal" data-target="#edit_food">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <h5 class="card-header">Yemek Adı</h5>
                <div class="card-body">
                    <p class="card-text">Stok: 56</p> 
                    <p class="card-text">Açıklama - With supporting text below as a natural lead-in to additional content.</p> 
                    <p>Fiyat&#8378;</p>
                    <div class="row justify-content-end">
                        <button class="btn btn-secondary mr-2" type="button" data-toggle="modal" data-target="#edit_food">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <h5 class="card-header">Yemek Adı</h5>
                <div class="card-body">
                    <p class="card-text">Stok: 56</p> 
                    <p class="card-text">Açıklama - With supporting text below as a natural lead-in to additional content.</p> 
                    <p>Fiyat&#8378;</p>
                    <div class="row justify-content-end">
                        <button class="btn btn-secondary mr-2" type="button" data-toggle="modal" data-target="#edit_food">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <h5 class="card-header">Yemek Adı</h5>
                <div class="card-body">
                    <p class="card-text">Restorant Adı</p> 
                    <p class="card-text">Açıklama - With supporting text below as a natural lead-in to additional content.</p> 
                    <p>Fiyat&#8378;</p>
                    <div class="row float-right">
                        <input class="form-input mr-4" type="number" id="quantity" name="quantity" value="1" min="1" step="1" style="width:35px;">
                        <a href="#" class="btn btn-primary">Sepete Ekle</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <h5 class="card-header">Yemek Adı</h5>
                <div class="card-body">
                    <p class="card-text">Restorant Adı</p> 
                    <p class="card-text">Açıklama - With supporting text below as a natural lead-in to additional content.</p> 
                    <p>Fiyat&#8378;</p>
                    <div class="row float-right">
                        <input class="form-input mr-4" type="number" id="quantity" name="quantity" value="1" min="1" step="1" style="width:35px;">
                        <a href="#" class="btn btn-primary">Sepete Ekle</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <h5 class="card-header">Yemek Adı</h5>
                <div class="card-body">
                    <p class="card-text">Restorant Adı</p> 
                    <p class="card-text">Açıklama - With supporting text below as a natural lead-in to additional content.</p> 
                    <p>Fiyat&#8378;</p>
                    <div class="row float-right">
                        <input class="form-input mr-4" type="number" id="quantity" name="quantity" value="1" min="1" step="1" style="width:35px;">
                        <a href="#" class="btn btn-primary">Sepete Ekle</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit food -->
    <div class="modal fade" id="edit_food" tabindex="-1" aria-labelledby="edit_food_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="edit_food_label">Yemeği Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="food_name" name="food_name" class="col-sm-4 col-form-label">Yemek Adı</label>
                            <div class="col-sm-8">
                                <input type="text" name="food_name" class="form-control" id="food_name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stock" name="name" class="col-sm-4 col-form-label">Stok Adedi</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stock" name="stock" min="1" value="1" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="explanation" name="explanation" class="col-sm-4 col-form-label"> Açıklama</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="explanation" id="explanation"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" name="price" class="col-sm-4 col-form-label">Fiyat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" name="price" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-danger">Değişiklikleri Kaydet</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal create food -->
    <div class="modal fade" id="create_food" tabindex="-1" aria-labelledby="create_food_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="create_food_label">YemeK Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="food_name" name="food_name" class="col-sm-4 col-form-label">Yemek Adı</label>
                            <div class="col-sm-8">
                                <input type="text" name="food_name" class="form-control" id="food_name" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stock" name="name" class="col-sm-4 col-form-label">Stok Adedi</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stock" name="stock" min="1" value="1" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="explanation" name="explanation" class="col-sm-4 col-form-label"> Açıklama</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="explanation" id="explanation"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" name="price" class="col-sm-4 col-form-label">Fiyat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" name="price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <button class="btn btn-secondary" type="button" id="add_image">Resim Ekle</button>
                            </div>
                            <div class="col-sm-4" id="images">
                                
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

<script>

    var max_image_count = 5;
    var image_count = 0;
    var is_selected = false;
    document.getElementById('add_image').addEventListener('click', function(){
        if(image_count < max_image_count && !is_selected ){
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
            document.getElementById('images').appendChild(input);
        }
    });


</script>


@endsection