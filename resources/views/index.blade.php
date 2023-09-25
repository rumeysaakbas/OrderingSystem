@extends('layouts.app1')

@php
    $role = '1';
@endphp

@section('content')
    <div class="container">
        
        <!-- if there is an error it will be shown here -->

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



        @if ($role === '1')
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-danger float-right" type="button" data-toggle="modal"
                        data-target="#create_food">Yemek Ekle</button>
                </div>
            </div>
        @endif

        <!-- Food List for seller -->
        <div class="row mt-3">
            @if ($role === '1' && $foods->isNotEmpty())
                @foreach ($foods as $food)
                    <div class="col-4">
                        <div class="card">
                            <h5 class="card-header" id="food_name_{{ $food->id }}" data-value="{{ $food->name }}">
                                {{ $food->name }}</h5>
                            <div class="card-body">
                                <p class="card-text" id="food_stock_{{ $food->id }}" data-value="{{ $food->stock }}">
                                    Stok: {{ $food->stock }}</p>
                                <p class="card-text" id="food_explanation_{{ $food->id }}"
                                    data-value="{{ $food->explanation }}">Açıklama: {{ $food->explanation }}</p>
                                <p id="food_price_{{ $food->id }}" data-value="{{ $food->price }}">
                                    {{ $food->price }}&#8378;</p>
                                <p class="d-flex justify-content-center" style="height:70px;">
                                    @if ($food->images)
                                        @foreach ($food->images as $index => $image)
                                            @if ($index < 2)
                                                <img src="{{ asset($image->image_path) }}" alt=""
                                                    style="width:100px; height:70px;" class="img-thumbnail mr-1 ml-1">
                                            @endif
                                        @endforeach
                                    @endif
                                </p>
                                <div class="row justify-content-end">
                                    <form method="post" class="delete_form mr-2 delete_button"
                                        action="{{ route('foods.destroy', $food->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger delete_button" data-toggle="tooltip" title='Delete'
                                            data-id="{{ $food->id }}" type="submit">Sil</button>
                                    </form>

                                    <button class="btn btn-secondary mr-2 food_edit_button" id="food_edit_button"
                                        type="button" data-toggle="modal" data-target="#edit_food"
                                        data-id="{{ $food->id }}">Düzenle</button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif($role === '1' && $foods->isEmpty())
                <div>Restorantınızın Kayıtlı Yemeği Bulunmamaktadır!</div>
            @endif



        </div>

        <!-- food list for customer -->
        <div class="row">
            @if ($role === '0' && $foods->isNotEmpty())
                @foreach ($foods as $food)
                    <div class="col-4">
                        <div class="card">
                            <h5 class="card-header" id="food_name_{{ $food->id }}" data-value="{{ $food->name }}">
                                {{ $food->name }}</h5>
                            <div class="card-body">
                                <p class="card-text" id="food_store_name_{{ $food->id }}"
                                    data-value="{{ $food->store->name }}">{{ $food->store->name }}</p>
                                <p class="card-text">Açıklama: {{ $food->explanation }}</p>
                                <p id="food_price_{{ $food->id }}" data-value="{{ $food->price }}">
                                    {{ $food->price }}&#8378;</p>
                                <p class="d-flex justify-content-center" style="height:70px;">
                                    @if ($food->images)
                                        @foreach ($food->images as $index => $image)
                                            @if ($index < 2)
                                                <img src="{{ asset($image->image_path) }}" alt=""
                                                    style="width:100px; height:70px;" class="img-thumbnail mr-1 ml-1">
                                            @endif
                                        @endforeach
                                    @endif
                                </p>
                                <div class="row float-right mr-4">
                                    <input class="form-input mr-3" type="number" id="food_quantity_{{ $food->id }}"
                                        name="food_quantity" value="1" min="1" step="1" max="250"
                                        style="width:35px;">
                                    <button class="btn btn-primary add-to-cart" data-id="{{ $food->id }}">Sepete
                                        Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif($role === '0' && $foods->isEmpty())
                <div>Kayıtlı Yemek Bulunmamaktadır!</div>
            @endif

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
                    <form action="" method="post" id="edit_food_form">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="food_name" class="col-sm-4 col-form-label">Yemek Adı</label>
                            <div class="col-sm-8">
                                <input type="text" name="edit_food_name" class="form-control" id="name"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stock" class="col-sm-4 col-form-label">Stok Adedi</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stock" name="edit_food_stock"
                                    min="1" max="250" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="explanation" class="col-sm-4 col-form-label"> Açıklama</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="edit_food_explanation" id="explanation" maxlength="250"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-sm-4 col-form-label">Fiyat </label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="price" name="edit_food_price"
                                        min="0" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">₺</span>
                                    </div>
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
    </div>

    <!-- Modal create food -->
    <div class="modal fade" id="create_food" tabindex="-1" aria-labelledby="create_food_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="create_food_label">Yemek Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('foods.create') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
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
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <button class="btn btn-secondary" type="button" id="add_image">Resim Ekle</button>
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
        </div>
    </div>

    @include('layouts.sweetAlert')
    @include('layouts.cartModal')


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

    <script>
        // update food
        document.querySelectorAll(".food_edit_button").forEach(button => {
            button.addEventListener("click", function() {
                const foodId = this.getAttribute("data-id");
                const name = document.getElementById("food_name_" + foodId).getAttribute("data-value");
                const stock = document.getElementById("food_stock_" + foodId).getAttribute("data-value");
                const explanation = document.getElementById("food_explanation_" + foodId).getAttribute(
                    "data-value");
                const price = document.getElementById("food_price_" + foodId).getAttribute("data-value");

                document.getElementById("name").value = name;
                document.getElementById("stock").value = stock;
                document.getElementById("explanation").value = explanation;
                document.getElementById("price").value = price;

                $('#edit_food').modal('show');
                var edit_form = document.getElementById("edit_food_form");
                edit_form.action = "{{ route('foods.update', '') }}/" + foodId;

            });
        });

        // if cart is confirmed, clear cart contents and cartItems
        var confirm_cart_button = document.getElementById('confirm_cart');
        confirm_cart_button.addEventListener('click', function() {
            localStorage.removeItem('cartItems');
        });

        // cart modal
        var cartItems = {};

        var addToCartButtons = document.querySelectorAll(".add-to-cart");
        var cartModal = document.getElementById("cart_modal");
        var cartList = document.getElementById("cartList");
        var emptyCartMessage = document.getElementById("empty_cart_message");

        addToCartButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                const foodId = this.getAttribute("data-id");
                const food_name = document.getElementById("food_name_" + foodId).getAttribute("data-value");
                const food_quantity = document.getElementById("food_quantity_" + foodId).value;
                const store = document.getElementById("food_store_name_" + foodId).getAttribute(
                    "data-value");
                const food_price = document.getElementById("food_price_" + foodId).getAttribute(
                    "data-value");

                const calculated_price = food_price * food_quantity;

                addToCart(foodId, food_name, food_quantity, store, food_price);
                updateCart();
                document.getElementById("food_quantity_" + foodId).value = 1;

            });
        });

        // update the cart
        function updateCart() {
            var total_price = 0;

            while (cartList.firstChild) {
                cartList.removeChild(cartList.firstChild);
            }

            // create li for each cartItems object
            for (var foodId in cartItems) {
                if (cartItems.hasOwnProperty(foodId)) {
                    var food = cartItems[foodId];
                    // cerate list item and add the datas

                    var calculated_price = food.price * food.quantity;
                    var cartItem = document.createElement("li");
                    cartItem.className = "list-group-item";
                    cartItem.innerHTML = `
                        <div class="row justify-content-around">
                            <div class="col-3"> 
                                <p class="font-weight-bold" > ${food.food_name} </p>    
                                <p>${food.store}</p>    
                            </div>
                            <div class="food-quantity col-2">${food.quantity} adet</div>
                            <div class="food-price mr-2">${calculated_price}₺</div>
                            <div class="float-right"><a class="far fa-trash-alt delete-button text-black" data-id="${foodId}"></a></div>
                
                            <input type="hidden" name="food_items[${foodId}][food_id]" value="${foodId}"/>                     
                            <input type="hidden" name="food_items[${foodId}][food_quantity]" value="${food.quantity}"/>                                        
                        </div>
                    `;
                    total_price += calculated_price;

                    cartList.appendChild(cartItem);

                    // remove product from cart
                    cartItem.querySelector(".delete-button").addEventListener("click", function() {
                        var foodId = this.getAttribute("data-id");
                        delete cartItems[foodId];
                        localStorage.setItem('cartItems', JSON.stringify(cartItems));
                        updateCart();
                        checkEmptyCart();
                    });
                }
            }
            document.getElementById("total_price").textContent = total_price + "₺";
            saveCartToLocalStorage();
            checkEmptyCart();
            updateCartItemCount();
        }

        // check empty cart
        function checkEmptyCart() {
            if (cartList.children.length === 0) {
                emptyCartMessage.textContent = "Sepetinizde Ürün Bulunmamaktadır!";
                document.getElementById("total_price").textContent = "";
            } else {
                emptyCartMessage.textContent = "";
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            loadCartFromLocalStorage();
            checkEmptyCart();
        });

        function addToCart(foodId, food_name, food_quantity, store, food_price) {
            // If the product has already been added to the card
            if (cartItems.hasOwnProperty(foodId)) {
                cartItems[foodId].quantity += parseInt(food_quantity);
            } else {
                cartItems[foodId] = {
                    food_name: food_name,
                    store: store,
                    quantity: parseInt(food_quantity),
                    price: food_price
                };
            }
            saveCartToLocalStorage();
        }

        // save the cart to localstorage
        function saveCartToLocalStorage() {
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
        }

        // load the cart items from localstorage
        function loadCartFromLocalStorage() {
            var storedCartItems = localStorage.getItem('cartItems');
            if (storedCartItems) {
                cartItems = JSON.parse(storedCartItems);
                updateCart();
            }
        }

        function updateCartItemCount() {
            var cartItemCount = Object.keys(cartItems).length;
            document.getElementById("cart_item_count").textContent = cartItemCount;
        }
    </script>
@endsection
