@extends('layouts.common')

@section('content')
    @include('layouts.headers.inventory')
    <section class="page-content dashbord" id="inventory">

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

                    <div class="card">
                        <div class="title">
                            <h4 class="text-left">Client Supply</h4>
                        </div>

                        <div class="content tab-pane fade in active "
                             style="padding:15px;overflow:visible;min-height:400px;">

                            <form id="create-new-cleaner" method="post" class="form-horizontal"
                                  action="{{URL::to('inventory/product/post-assign-to-task')}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}">
                                            <label class="col-sm-4 control-label" for="client">Client Name</label>
                                            <div class="col-sm-8">
                                                <select class="form-control selectpicker" id="client" name="client">
                                                    <option value="">Select a client</option>
                                                    @foreach($clients as $client)
                                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('client'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('client') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="type">Product Type:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" id="type" name="type"
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
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
                                            <label class="col-sm-4 control-label" for="product">Product</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" id="product" name="product"
                                                        v-model="product_id" @change="setProduct">
                                                    <option value="">Select a product</option>
                                                    <option v-for="product in selected_products" :value="product.id">
                                                        @{{product.name}}
                                                    </option>
                                                </select>
                                                @if ($errors->has('product'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                            <label class="col-sm-4 control-label" for="quantity">Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="quantity" name="quantity"
                                                       min="0" value="{{old('quantity')}}">
                                                @if ($errors->has('quantity'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                            <label class="col-sm-4 control-label">Available Quantity</label>
                                            <div class="col-sm-8">
                                                <input disabled="disabled" v-model="product_quantity"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group{{ $errors->has('shortage_alert') ? ' has-error' : '' }}">
                                            <label class="col-sm-4 control-label" for="shortage_alert">Shortage
                                                Alert</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="shortage_alert"
                                                       name="shortage_alert"
                                                       min="0" value="{{old('shortage_alert')}}">
                                                @if ($errors->has('shortage_alert'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('shortage_alert') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <button type="submit" class="btn btn-default save">Assign & Continue</button>
                                    <button type="reset" class="btn btn-default clear">Clear</button>
                                </div>
                            </form>
                        </div>
                        <!--/end tab-pane-->


                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->


            </div>
        </div>

    </section>

    <script>
        var data = {
            product_id: '',
            product_quantity: '',
            selected_products: [],
            products: {!! json_encode($products) !!}
        };

        var inventory = new Vue({
            el: '#inventory',
            data: data,
            mounted: function () {
                var vm = this;
                this.selected_products = this.products;
                window.addEventListener('load', function () {
                    jQuery('#product').select2({
                        dropdownAutoWidth: true
                    }).on('change', function (event) {
                        vm.$emit('input', this.value);
                        vm.product_id = this.value;
                        vm.setProduct();
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
                setProduct: function () {
                    var $this = this;
                    axios.post('{{URL::to('/inventory/product/ajax-get-product')}}', {
                        _token: '{{csrf_token()}}',
                        product_id: $this.product_id
                    })
                        .then(function (response) {
                            $this.product_quantity = response.data.product.qty;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                setType: function (event) {
                    var type = event.target.value;
                    var selected_products = this.products.filter(function (product) {
                        return type == product.type;
                    });

                    this.selected_products = [];
                    var vm = this;

                    selected_products.forEach(function (product, index) {
                        vm.selected_products.push(product);
                        vm.selected_products[index].text = product.name;
                    });

                    this.selected_products = selected_products;
                }
            }
        });

        window.addEventListener('load', function () {
            $('#client').select2({dropdownAutoWidth: true});
        });
    </script>
@endsection