@extends('layouts.app1')
@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show col-8 mx-auto"
                style="background-color: rgba(255, 0, 0, 0.6);">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="text-center">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Hata!</h5>
                </div>
                <ul style="list-style:none;">
                    @foreach ($errors->all() as $error)
                        <li class="text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-8 mx-auto mt-4">
            <ul class="list-group">
                @foreach ($food->foodRawMaterials as $food_raw_material)
                    <li class="list-group-item">
                        <div class="row d-flex justify-content-between">
                            <div class="row ml-2">
                                <p class="" data-name="{{ $food_raw_material->name }}">{{ $food_raw_material->name }}
                                    - </p>
                                <p class="ml-1" data-value="{{ $food_raw_material->value }}">
                                    {{ $food_raw_material->value }}</p>
                                <p class="ml-1" data-value-type="{{ $food_raw_material->valueType->id }}">
                                    {{ $food_raw_material->valueType->name }}</p>
                            </div>
                            <div class="buttons float-right d-flex justify-content-end">

                                <form action="" method="post" class="form-inline">
                                    @csrf
                                    @method('put')
                                    <div class="row" id="edit_container">

                                    </div>
                                    <button class="btn btn-secondary edit_button" type="button"
                                        data-id="{{ $food_raw_material->id }}">Düzenle</button>
                                </form>

                                <form method="post" action="{{ route('rawMaterial.delete', $food_raw_material->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger ml-2 delete_button" type="submit">Sil</button>
                                </form>
                            </div>
                        </div>

                        <div class=" form-group row">

                        </div>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class="text-center">
            <button class="btn btn-dark mt-4 mx-auto d-block" id="add_material" type="button">Yeni Ürün Ekle</button>

            <form action="{{ route('rawMaterial.store', $food->id) }}" method="post" class="form-group mx-auto"
                id="form">
                @csrf
                <div class="row justify-content-center">
                    <div id="form-container" class="">

                    </div>
                </div>
                <div class="row justify-content-center" id="button-container">
                    <button type="submit" class="btn btn-danger mt-5" id="save_button"
                        style="display:none;">Kaydet</button>
                </div>
            </form>
        </div>
    </div>

    <!-- form repeater -->
    <script>
        var valueTypes = {!! json_encode($value_types) !!};

        var isAdd = false;
        document.getElementById('add_material').addEventListener('click', function() {
            isAdd = true;
            const formContainer = document.getElementById('form-container');

            const newForm = document.createElement('div');
            newForm.classList.add('row', 'mb-3', 'mt-5');

            const inputName = document.createElement('div');
            inputName.classList.add('col');
            inputName.innerHTML =
                '<label class="form-label">Ürün Adı</label><input type="text" class="form-control" name="material_name[]">';

            const selectDiv = document.createElement('div');
            selectDiv.classList.add('form-group', 'col');

            const label = document.createElement('label');
            label.textContent = "Ölçü Birimi";

            const select = document.createElement('select');
            select.classList.add("custom-select");
            select.name = "value_type[]";

            console.log(valueTypes);
            valueTypes.forEach(function(valueType) {
                const option = document.createElement('option');
                option.value = valueType.id;
                option.textContent = valueType.name;
                select.appendChild(option);
            });

            selectDiv.appendChild(label);
            selectDiv.appendChild(select);

            const inputQuantity = document.createElement('div');
            inputQuantity.classList.add('col');
            inputQuantity.innerHTML =
                '<label class="form-label">Ürün Miktarı</label><input type="range" class="custom-range custom-range-danger mt-2" name="material_quantity[]"><span class="range-value">50</span>';

            const removeButton = document.createElement('div');
            removeButton.classList.add('align-self-end', 'col');
            removeButton.innerHTML =
                '<button type="button" class="btn btn-danger remove-material mb-3">Sil</button>';

            newForm.appendChild(inputName);
            newForm.appendChild(selectDiv);
            newForm.appendChild(inputQuantity);
            newForm.appendChild(removeButton);

            formContainer.appendChild(newForm);

            const removeButtons = document.querySelectorAll('.remove-material');
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    formContainer.removeChild(button.parentElement.parentElement);
                });
            });

            const rangeInputs = document.querySelectorAll('input[type="range"]');
            rangeInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    const rangeValue = input.nextElementSibling;
                    rangeValue.textContent = input.value;
                });
            });

            document.getElementById('save_button').style.display = "block";
        });

        document.getElementById('form').addEventListener('submit', function(event) {
            if (!isAdd) {
                event.preventDefault();
            }
        });
    </script>

    <!-- edit food raw material-->
    <script>
        const editButtons = document.querySelectorAll(".edit_button");
        editButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const foodRawMaterialId = event.target.getAttribute("data-id");
                const foodRawMaterialName = this.closest('.row').querySelector('[data-name]').getAttribute(
                    'data-name');;
                const foodRawMaterialValue = this.closest('.row').querySelector('[data-value]')
                    .getAttribute('data-value');;
                const foodRawMaterialValueType = this.closest('.row').querySelector('[data-value-type]')
                    .getAttribute('data-value-type');;

                console.log(foodRawMaterialValueType);
                this.closest('.row').querySelector('[data-name]').textContent = "";
                this.closest('.row').querySelector('[data-value]').textContent = "";
                this.closest('.row').querySelector('[data-value-type]').textContent = "";

                this.parentElement.parentElement.querySelector('.delete_button').style = "margin-top:33px;";
                const form = event.target.closest("form");

                if (!form.classList.contains("input-added")) {

                    const editContainer = document.getElementById('edit_container');

                    const newForm = document.createElement('div');
                    newForm.classList.add('row', 'mb-3', 'mt-5');

                    const inputName = document.createElement('input');
                    inputName.classList.add('form-control', 'col-3', 'mr-1');
                    inputName.type = "text"
                    inputName.name = "material_name";
                    inputName.value = foodRawMaterialName;

                    const select = document.createElement('select');
                    select.classList.add('custom-select', 'col-3', 'mr-1');
                    select.name = "value_type";

                    valueTypes.forEach(function(valueType) {
                        const option = document.createElement('option');
                        option.value = valueType.id;
                        option.textContent = valueType.name;
                        select.appendChild(option);
                        if (option.value === foodRawMaterialValueType) {
                            option.selected = true;
                        }
                    });

                    const inputQuantity = document.createElement('input');
                    inputQuantity.type = "range";
                    inputQuantity.classList.add('custom-range', 'custom-range-danger', 'mt-2', 'col-3',
                        'mr-1');
                    inputQuantity.name = "material_quantity";
                    inputQuantity.value = foodRawMaterialValue;
                    const span = document.createElement('span');
                    span.classList.add('range-value', 'mt-1', 'mr-5');
                    span.textContent = foodRawMaterialValue;

                    inputQuantity.addEventListener('input', function() {
                        span.textContent = inputQuantity.value;
                    });

                    newForm.appendChild(inputName);
                    newForm.appendChild(select);
                    newForm.appendChild(inputQuantity);
                    newForm.appendChild(span);

                    form.insertBefore(newForm, button);
                    form.classList.add('input-added');

                }

                button.className = "btn btn-dark edit_button float-right mr-3";
                button.innerText = "Kaydet";

                button.addEventListener("click", function() {
                    form.action = "{{ route('rawMaterial.update', '') }}/" + foodRawMaterialId;
                    form.submit();
                });
            });
        });
    </script>

@endsection
