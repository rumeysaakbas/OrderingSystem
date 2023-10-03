@extends('layouts.app1')


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



        @if (Auth::user()->role === 'seller')
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary float-right" type="button" data-toggle="modal"
                        data-target="#create_category">Kategori Ekle</button>
                    <a href="{{ route('foods.create') }}" type="button" class="btn btn-primary float-right mr-2">Yemek
                        Ekle</a>
                    <a href="{{ route('rawMaterial.index') }}" class="btn btn-primary float-right mr-2" type="button">Hammadde Ekle</a>
                </div>
            </div>
        @endif

        <!-- Food List for seller -->
        <div class="row mt-3">
            @if (Auth::user()->role === 'seller' && $foods->isNotEmpty())
                @foreach ($foods as $food)
                    <div class="col-4">
                        <div class="card">
                            <h5 class="card-header" id="food_name_{{ $food->id }}" data-value="{{ $food->name }}">
                                {{ $food->name }}</h5>
                            <div class="card-body">
                                <div class="row">
                                    <label for="food_stock_{{ $food->id }}">Stok:</label>
                                    <p class="card-text ml-1" id="food_stock_{{ $food->id }}" data-value="{{ $food->stock }}">{{ $food->stock }}</p>
                                </div>
                                <div class="row">
                                    <label for="food_explanation_{{ $food->id }}">Açıklama: </label>
                                    <p class="card-text ml-1" id="food_explanation_{{ $food->id }}"
                                        data-value="{{ $food->explanation }}">{!! $food->explanation !!}</p>
                                </div>
                                <div class="row">
                                    <p id="food_price_{{ $food->id }}" data-value="{{ $food->price }}">{{ $food->price }}&#8378;</p>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <p class="" style="height:70px;">
                                        @if ($food->images)
                                            @foreach ($food->images as $index => $image)
                                                @if ($index < 2)
                                                    <img src="{{ asset($image->image_path) }}" alt=""
                                                        style="max-width: 100px; max-height: 70px;"
                                                        class="img-thumbnail mr-1 ml-1">
                                                @endif
                                            @endforeach
                                        @endif
                                    </p>
                                </div>
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
            @elseif(Auth::user()->role === 'seller' && $foods->isEmpty())
                <div>Restorantınızın Kayıtlı Yemeği Bulunmamaktadır!</div>
            @endif



        </div>

        <!-- food list for customer -->
        <div class="row">
            @if (Auth::user()->role === 'customer' && $foods->isNotEmpty())
                @foreach ($foods as $food)
                    <div class="col-4">
                        <div class="card">
                            <h5 class="card-header" id="food_name_{{ $food->id }}" data-value="{{ $food->name }}">
                                {{ $food->name }}</h5>
                            <div class="card-body">
                                <div class="row">
                                    <p class="card-text" id="food_store_name_{{ $food->id }}"
                                        data-value="{{ $food->store->name }}">{{ $food->store->name }}</p>
                                </div>
                                <div class="row">
                                    <label for="exp">Açıklama:</label>
                                    <p class="card-text ml-1" id="exp">{!! $food->explanation !!}</p>
                                </div>
                                <div class="row">
                                    <p id="food_price_{{ $food->id }}" data-value="{{ $food->price }}">
                                        {{ $food->price }}&#8378;</p>
                                </div>
                                <div class="row">
                                    <p class="d-flex justify-content-center" style="height:70px;">
                                        @if ($food->images)
                                            @foreach ($food->images as $index => $image)
                                                @if ($index < 2)
                                                    <img src="{{ asset($image->image_path) }}" alt=""
                                                        style="max-width: 100px; max-height: 70px;"
                                                        class="img-thumbnail mr-1 ml-1">
                                                @endif
                                            @endforeach
                                        @endif
                                    </p>
                                </div>
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
            @elseif(Auth::user()->role === 'customer' && $foods->isEmpty())
                <div>Kayıtlı Yemek Bulunmamaktadır!</div>
            @endif

        </div>

        <!-- food list for admin -->
        <div class="row">
            @if (Auth::user()->role === 'admin' && $foods->isNotEmpty())
            @foreach ($foods as $food)
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header" id="food_name_{{ $food->id }}" data-value="{{ $food->name }}">
                        {{ $food->name }}</h5>
                    <div class="card-body">
                        <div class="row">
                            <p class="card-text" id="food_store_name_{{ $food->id }}"
                                data-value="{{ $food->store->name }}">{{ $food->store->name }}</p>
                        </div>
                        <div class="row">
                            <label for="exp">Açıklama:</label>
                            <p class="card-text ml-1" id="exp">{!! $food->explanation !!}</p>
                        </div>
                        <div class="row">
                            <p id="food_price_{{ $food->id }}" data-value="{{ $food->price }}">
                                {{ $food->price }}&#8378;</p>
                        </div>
                        <div class="row">
                            <p class="d-flex justify-content-center" style="height:70px;">
                                @if ($food->images)
                                    @foreach ($food->images as $index => $image)
                                        @if ($index < 2)
                                            <img src="{{ asset($image->image_path) }}" alt=""
                                                style="max-width: 100px; max-height: 70px;"
                                                class="img-thumbnail mr-1 ml-1">
                                        @endif
                                    @endforeach
                                @endif
                            </p>
                        </div>
                        <div class="row float-right mr-4">

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
            @elseif(Auth::user()->role === 'admin' && $foods->isEmpty())
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
                                    min="0" max="250" required>
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

    @if (Auth::user()->role === 'seller')
        <!-- Modal create category -->
        <div class="modal fade" id="create_category" tabindex="-1" aria-labelledby="create_food_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="create_food_label">Kategori Ekle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('category.create') }}" method="post"
                            class="form-inline justify-content-center">
                            @csrf

                            <div class="form-group row">
                                <div class="col-sm">
                                    <label for="category_name" name="category_name" class="col-form-label">Kategori
                                        Adı</label>
                                </div>
                                <div class="col-sm">
                                    <input type="text" name="category_name" class="form-control" id="category_name"
                                        required value="{{ old('category_name') }}">
                                </div>
                                <div class="col-sm float-right">
                                    <button type="submit" class="btn btn-danger float-right">Kaydet</button>
                                </div>
                                @error('category_name')
                                    <br> <small class="ml-2" style="color:red;"> {{ $message }} </small>
                                @enderror
                            </div>
                        </form>
                        <hr>
                        <div>
                            <ul class="list-group">
                                @foreach ($categories as $category)
                                    <li class="list-group-item">
                                        <div class="row d-flex justify-content-between">
                                            <p id="category_name_{{ $category->id }}">{{ $category->category_name }}</p>
                                            <div class="buttons float-right d-flex justify-content-end">
                                                <form action="" method="post" class="form-inline">
                                                    @csrf
                                                    @method('put')

                                                    <button class="btn btn-secondary edit_button" type="button"
                                                        category-id="{{ $category->id }}">Düzenle</button>
                                                </form>
                                                <form method="post"
                                                    action="{{ route('categories.delete', $category->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger ml-2" type="submit">Sil</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="editCategoryContainer form-group row">

                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('layouts.sweetAlert')
    @include('layouts.cartModal')

    <!-- food update and cart operations -->
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

    <!-- category update -->
    <script>

        const editButtons = document.querySelectorAll(".edit_button");
        editButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const categoryId = event.target.getAttribute("category-id");
                const categoryName = document.getElementById("category_name_" + categoryId).innerText;
                const form = event.target.closest("form");

                if (!form.classList.contains("input-added")) {
                    const input = document.createElement("input");
                    input.className = "form-control";
                    input.type = "text";
                    input.name = "edit_category_name";
                    input.id = "editted_category_name_"+categoryId;
                    input.value = categoryName;

                    form.insertBefore(input, button);
                    form.classList.add("input-added");
                }

                button.className = "btn btn-dark edit_button float-right ml-1";
                button.innerText = "Kaydet";

                button.addEventListener("click", function() {
                    if( categoryName != document.getElementById("editted_category_name_" + categoryId).value){
                        form.action = "{{ route('categories.update', '') }}/" + categoryId;
                        form.submit();
                    }
                });
            });
        });

    </script>
@endsection
