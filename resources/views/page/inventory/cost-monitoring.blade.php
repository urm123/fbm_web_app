@extends('layouts.common')

@section('content')
    @include('layouts.headers.inventory')
    <section class="page-content dashbord" id="cost-monitoring">

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
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                    <div class="form-group">

                        <label class="col-sm-4 control-label" for="ClientName">Client Name</label>

                        <div class="col-sm-8" style="margin-bottom:15px;">
                            <select class="form-control selectpicker" @change="setProduct($event)" id="product"
                                    name="product">
                                <option value="">Select a product</option>
                                @foreach($stock_products as $stock_product)
                                    <option value="{{$stock_product->id}}">{{$stock_product->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card">
                        <div class="title">
                            <h4 class="text-left">Cost Monitoring</h4>
                        </div>


                        <div class="content Scroll " style="min-height:450px;">

                            <table class="table editable">

                                <tr>
                                    <th>Inventory</th>
                                    <th>Last Added Date</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th></th>
                                </tr>

                                <tr v-for="product in filtered_products">
                                    <td class="col-1">
                                        <input type="text" class="form-control"
                                               v-model="product.name"></td>
                                    <td class="col-2">
                                        <input type="text" class="form-control inputdate"
                                               v-model="product.added_date"></td>
                                    <td class="col-3">
                                        <input type="number" class="form-control"
                                               v-model="product.product_quantity" max="9999" maxlength="4"
                                               @keydown="quantityValidation($event)"></td>
                                    <td class="col-3">
                                        <input type="number" class="form-control"
                                               v-model="product.product_total" max="9999" maxlength="4"></td>
                                    <td class="col-4">
                                        <input type="number" class="form-control"
                                               v-model="product.product_price"></td>
                                    <td class="col-5">
                                        <input type="number" class="form-control"
                                               :value="product.product_quantity*product.product_price"
                                               :disabled="true">
                                    </td>
                                    <td class="col-6">
                                        <a href="#" class="Edit"><img class="svg Green "
                                                                      src="{{URL::asset('assets/assets/edit.svg')}}"
                                                                      alt="info" width="33" height="33"></a>
                                        <a href="#" class="Save"
                                           @click.prevent="saveInventory(product.stock_product_id)"><img
                                                    class="svg Green hide"
                                                    src="{{URL::asset('assets/assets/save.svg')}}"
                                                    alt="info" width="33" height="33"></a>
                                        <a href="#" class="Cancel"><img class="svg Pink hide"
                                                                        src="{{URL::asset('assets/assets/cancel.svg')}}"
                                                                        alt="info" width="33" height="33"></a>
                                    </td>
                                </tr>
                            </table>

                        </div>
                        <!--/end tab-pane-->


                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->


            </div>
        </div>

    </section>

    <script type="text/javascript">
        var data = {
            products: {!! $products !!},
            filtered_products: [],
        };
        var cost_monitoring = new Vue({
            data: data,
            el: '#cost-monitoring',
            mounted: function () {
                var vm = this;
                this.filtered_products = this.products;
                window.addEventListener('load', function () {
                    jQuery('#product').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.$emit('input', this.value);
                        vm.setProduct(this.value);
                    });
                });
            },
            methods: {
                saveInventory: function (product_id) {
                    var selected_product = this.products.filter(function (product) {
                        return product.stock_product_id == product_id
                    });

                    axios.post('{{URL::to('/inventory/product/post-product-cost')}}', {
                        _token: '{{csrf_token()}}',
                        product_id: selected_product[0].product_id,
                        stock_product_id: selected_product[0].stock_product_id,
                        name: selected_product[0].name,
                        added_date: selected_product[0].added_date,
                        price: selected_product[0].product_price,
                        quantity: selected_product[0].product_quantity,
                    })
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                quantityValidation: function (event) {
                    if (event.target.value.length > 3) {
                        if (event.keyCode != 8 && event.keyCode != 46) {
                            event.preventDefault();
                        }
                    }
                },
                setProduct: function (product_id) {
                    var filtered_product = this.products.filter(function (product) {
                        return product.product_id == product_id;
                    });

                    this.filtered_products = filtered_product;
                }
            }
        });
    </script>
@endsection