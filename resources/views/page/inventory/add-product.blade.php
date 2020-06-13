@extends('layouts.common')

@section('content')
    @include('layouts.headers.inventory')
    <section class="page-content dashbord" id="add-product">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Product</h3>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('/inventory/product')}}">Product</a></li>
                            <li><a href="{{URL::to('/inventory/product/cost-monitoring')}}">Cost Monitoring</a></li>
                            <li><a href="{{URL::to('/inventory/product/client-supply')}}">Client Supply</a></li>
                            <li><a href="{{URL::to('/inventory/product/add-product')}}">Add a Product</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card form-card">

                        <div class="row title">
                            <div class="col-md-2">
                                <h4 class="text-left">Add a Product</h4>
                            </div>
                            <div class="col-md-7">
                                <div class="panel-heading" style="margin-left: -30px;">
                                    <ul class="nav nav-tabs">
                                        <li class="@if(empty(session('product'))||session('product')=='update') active @endif">
                                            <a href="#notifi-tab1" data-toggle="tab">Existing Product</a>
                                        </li>
                                        <li class="@if(!empty(session('product'))&&session('product')=='create') active @endif">
                                            <a href="#notifi-tab2" data-toggle="tab">New Product</a></li>
                                    </ul>
                                </div>
                                <!-- end panel-heading -->
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>


                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">

                                    <div class="content tab-pane fade @if(empty(session('product'))||session('product')=='update') in active @endif "
                                         id="notifi-tab1"
                                         style="height:260px;">

                                        <form id="create-new-cleaner" method="post"
                                              @submit.prevent="validateUpdate($event)" class="form-horizontal"
                                              action="{{URL::to('/inventory/product/post-update-product')}}">
                                            {{csrf_field()}}
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="type">Product
                                                        Type</label>
                                                    <div class="col-sm-8">
                                                        <select type="number" class="form-control select3" id="type"
                                                                @change="setType($event)">
                                                            <option value="" selected="selected">Select a Product Type
                                                            </option>
                                                            <option value="paper">Paper Products</option>
                                                            <option value="chemicals">Chemicals</option>
                                                            <option value="garbage">Garbage Bags</option>
                                                            <option value="janitorial">Janitorial</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="current_quantity">Current
                                                        Quanitity</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" id="current_quantity"
                                                               disabled="disabled"
                                                               :value="current_quantity" min="0"
                                                               name="current_quantity"
                                                               value="{{old('current_quantity')}}"
                                                               style="border: transparent">
                                                    </div>
                                                </div>
                                                <div class="form-group" :class="{'has-error':update_validation.price}">
                                                    <label class="col-sm-4 control-label" for="price">Unit Price</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" id="price"
                                                               min="0"
                                                               name="price" v-model="price"
                                                               value="{{old('price')}}">
                                                        <span class="help-block" v-if="update_validation.price">
                                        <strong>@{{ update_validation.price[0] }}</strong>
                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group"
                                                     :class="{'has-error':update_validation.product}">
                                                    <label class="col-sm-4 control-label" for="product">Product
                                                        Name</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control select2" id="product"
                                                                name="product" @change="setProduct(0,$event)">
                                                            <option value="">Select a product</option>
                                                            <option v-for="selected_product in selected_products"
                                                                    :value="selected_product.id">
                                                                @{{selected_product.name}}
                                                            </option>
                                                        </select>
                                                        <span class="help-block" v-if="update_validation.product">
                                        <strong>@{{ update_validation.product[0] }}</strong>
                                    </span>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':update_validation.quantity}">
                                                    <label class="col-sm-4 control-label" for="quantity">Add
                                                        Quantity</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control"
                                                               id="quantity" name="quantity" min="0" value="0"
                                                               value="{{old('quantity')}}">
                                                        <span class="help-block" v-if="update_validation.quantity">
                                        <strong>@{{ update_validation.quantity[0] }}</strong>
                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                <button type="submit" class="btn btn-default save">Save & Continue
                                                </button>
                                                <button type="reset" class="btn btn-default clear">Clear</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--/end tab-pane-->

                                    <div class="content tab-pane fade @if(!empty(session('product'))&&session('product')=='create') active in @endif"
                                         id="notifi-tab2">
                                        <form id="create-new-cleaner" method="post"
                                              @submit.prevent="validateCreate($event)" class="form-horizontal"
                                              action="{{URL::to('inventory/product/post-create-product')}}">
                                            {{csrf_field()}}
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group"
                                                     :class="{'has-error':create_validation.product}">
                                                    <label class="col-sm-4 control-label" for="product">Product
                                                        Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="product"
                                                               name="product" value="{{old('product')}}">
                                                        <span class="help-block" v-if="create_validation.product">
                                        <strong>@{{ create_validation.product[0] }}</strong>
                                    </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="description">Product
                                                        Code</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                               id="product_code" name="product_code"
                                                               value="{{old('product_code')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="description">Product
                                                        Description</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                               id="description" name="description"
                                                               value="{{old('description')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group" :class="{'has-error':create_validation.price}">
                                                    <label class="col-sm-4 control-label" for="description">Unit
                                                        Price</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                               id="price" name="price" value="{{old('price')}}">
                                                        <span class="help-block" v-if="create_validation.price">
                                        <strong>@{{ create_validation.price[0] }}</strong>
                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="unit">Product
                                                        Unit</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control"
                                                                id="unit" name="unit">
                                                            <option value="">Select a product unit</option>
                                                            <option value="Case">Case</option>
                                                            <option value="Each">Each</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':create_validation.type}">
                                                    <label class="col-sm-4 control-label" for="type">Product
                                                        Type</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control select2" id="type"
                                                                name="type">
                                                            <option value="" selected="selected">Select a Product Type
                                                            </option>
                                                            <option value="paper">Paper Products</option>
                                                            <option value="chemicals">Chemicals</option>
                                                            <option value="garbage">Garbage Bags</option>
                                                            <option value="janitorial">Janitorial</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                        <span class="help-block" v-if="create_validation.type">
                                        <strong>@{{ create_validation.type[0] }}</strong>
                                    </span>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':create_validation.quantity}">
                                                    <label class="col-sm-4 control-label" for="quantity">Add
                                                        Quanitity</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" id="quantity"
                                                               name="quantity" min="0" value="{{old('quantity')}}">
                                                        <span class="help-block" v-if="create_validation.quantity">
                                        <strong>@{{ create_validation.quantity[0] }}</strong>
                                    </span>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':create_validation.shortage_alert}">
                                                    <label class="col-sm-4 control-label" for="shortage_alert">Shortage
                                                        Alert Qty</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" id="shortage_alert"
                                                               name="shortage_alert" min="0"
                                                               value="{{old('shortage_alert')}}">
                                                        <span class="help-block"
                                                              v-if="create_validation.shortage_alert">
                                        <strong>@{{ create_validation.shortage_alert[0] }}</strong>
                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                <button type="submit" class="btn btn-default save">Save & Continue
                                                </button>
                                                <button type="reset" class="btn btn-default clear">Clear</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--/end tab-pane-->

                                </div>
                            </div>
                            <!--/end   panel-body -->

                            <div class="cord-footer">

                            </div>
                        </div>
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->


            </div>
        </div>

    </section>

    <script type="text/javascript">
        var data = {
            products: {!! $json_products !!},
            current_quantity: 0,
            price: 0,
            update_validation: [
                {product: []},
                {quantity: []},
                {price: []},
            ],
            create_validation: [
                {product: []},
                {quantity: []},
                {shortage_alert: []},
                {price: []},
                {type: []},
            ],
            selected_products: []
        };

        var add_product = new Vue({
                data: data,
                el: '#add-product',
                mounted: function () {
                    var vm = this;
                    this.selected_products = this.products;
                    window.addEventListener('load', function () {
                        jQuery('#product').select2({
                            dropdownAutoWidth: true
                        }).on('change', function (event) {
                            vm.inspector = this.value;
                            vm.$emit('input', this.value);
                            vm.setProduct(false, event);
                        });

                        jQuery('#type').select2({
                            dropdownAutoWidth: true
                        }).on('change', function (event) {
                            vm.$emit('input', this.value);
                            vm.setType(event);
                        });
                    });
                },
                methods: {
                    setProduct: function (variable, event) {
                        var product_id = event.target.value;

                        var selected_product = this.products.filter(function (product) {
                            return product.id == product_id;
                        });

                        this.current_quantity = selected_product[0].qty;

                        this.price = selected_product[0].price;
                    },
                    validateUpdate: function (event) {
                        var elements = event.target.elements;

                        this.update_validation = [
                            {product: []},
                            {quantity: []},
                            {price: []},
                        ];
                        var $this = this;

                        var form_elements = {};
                        for (var i = 0; i < elements.length; i++) {
                            form_elements[elements[i].getAttribute('name')] = elements[i].value;
                        }


                        axios.post('{{URL::to('/inventory/product/validate-update-product')}}', form_elements)
                            .then(function (response) {
                                if (response.data.message == 'Failed') {
                                    $this.update_validation = response.data.validation;
                                } else if (response.data.message == 'Success') {
                                    event.target.submit();
                                } else {
                                    console.log(response);
                                }
                            })
                            .catch(function (error) {
                                if (error.response) {
                                    var errors = error.response.data.errors;
                                    console.log(errors);
                                }
                            });
                    },
                    validateCreate: function (event) {
                        var elements = event.target.elements;

                        this.create_validation = [
                            {product: []},
                            {quantity: []},
                            {shortage_alert: []},
                            {price: []},
                            {type: []},
                        ];
                        var $this = this;

                        var form_elements = {};
                        for (var i = 0; i < elements.length; i++) {
                            form_elements[elements[i].getAttribute('name')] = elements[i].value;
                        }


                        axios.post('{{URL::to('/inventory/product/validate-create-product')}}', form_elements)
                            .then(function (response) {
                                if (response.data.message == 'Failed') {
                                    $this.create_validation = response.data.validation;
                                } else if (response.data.message == 'Success') {
                                    event.target.submit();
                                } else {
                                    console.log(response);
                                }
                            })
                            .catch(function (error) {
                                if (error.response) {
                                    var errors = error.response.data.errors;
                                    console.log(errors);
                                }
                            });
                    },
                    setType: function (event) {

                        var type = event.target.value;

                        var selected_products = [{id: 0, text: 'Select a product'}];

                        var selected = this.products.filter(function (product) {
                            return type == product.type;
                        });

                        selected.forEach(function (select) {
                            selected_products.push(select);
                        });

                        this.selected_products = [];
                        var vm = this;

                        selected_products.forEach(function (product, index) {
                            vm.selected_products.push(product);
                            vm.selected_products[index].text = product.name;
                        });

                        // this.selected_products = selected_products;

                        jQuery('#product').empty().select2({
                            dropdownAutoWidth: true,
                            data: vm.selected_products
                        }).on('change', function (event) {
                            vm.inspector = this.value;
                            vm.$emit('input', this.value);
                            vm.setProduct(false, event);
                        });
                    },
                }
            })
        ;
    </script>
@endsection