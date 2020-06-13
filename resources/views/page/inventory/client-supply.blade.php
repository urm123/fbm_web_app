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

                        <div class="content tab-pane fade in active"
                             style="padding:15px;overflow:visible;min-height:400px;">

                            <form id="create-new-cleaner" method="post" class="form-horizontal" @submit.prevent="save"
                                  action="{{URL::to('inventory/product/post-assign-to-task')}}">
                                {{csrf_field()}}
                                <div class="col-xs-12">
                                    <label for="client">Client</label>
                                    <select name="client" id="client" class="form-control" @change="setClient($event)">
                                        <option value="">Select a client</option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-12">
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Product Type</th>
                                            <th>Product</th>
                                            <th>Available Quantity</th>
                                            <th>Shortage Alert</th>
                                            <th>Add Quantity</th>
                                            <th>Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(client_product,index) in client_products">
                                            <td>
                                                <select class="form-control select2"
                                                        @change="setType($event,index)">
                                                    <option value="">Select a product type</option>
                                                    <option :selected="client_product.product_type=='paper'"
                                                            value="paper">Paper
                                                        Products
                                                    </option>
                                                    <option :selected="client_product.product_type=='chemicals'"
                                                            value="chemicals">Chemicals
                                                    </option>
                                                    <option :selected="client_product.product_type=='garbage'"
                                                            value="garbage">
                                                        Garbage Bags
                                                    </option>
                                                    <option :selected="client_product.product_type=='janitorial'"
                                                            value="janitorial">Janitorial
                                                    </option>
                                                    <option :selected="client_product.product_type=='other'"
                                                            value="other">
                                                        Other
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control select2" @change="setProduct($event,index)">
                                                    <option value="">Select a product</option>
                                                    <option v-for="selected_product in client_product.selected_products"
                                                            :value="selected_product.id"
                                                            :selected="client_product.product_id==selected_product.id">
                                                        @{{ selected_product.name }}
                                                    </option>
                                                </select>
                                            </td>
                                            <td>@{{ client_product.quantity }}</td>
                                            <td><input class="form-control" type="text"
                                                       v-model="client_product.shortage_alert"></td>
                                            <td><input class="form-control" type="text"
                                                       v-model="client_product.additional_quantity"></td>
                                            <td>
                                                <button class="btn btn-danger" @click.prevent="removeProduct(index)">
                                                    Remove
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-right">
                                                <button class="btn btn-success" @click.prevent="addProduct">Add
                                                    product
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
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
            client_products_array: {!! json_encode($products) !!},
            client_products: [{quantity: 0, selected_products: [], id: 'new', product_id: 0}],
            products: {!! json_encode($all_products) !!},
            client: 0
        };

        var products = new Vue({
            data: data,
            el: '#inventory',
            mounted: function () {
            },
            methods: {
                setType: function (event, index) {
                    var type = event.target.value;
                    var selected_products = this.products.filter(function (product) {
                        return product.type == type;
                    });
                    this.client_products[index].selected_products = selected_products;
                    this.client_products[index].product_type = type;
                },
                addProduct: function () {
                    this.client_products.push({quantity: 0, selected_products: [], id: 'new', product_id: 0});
                },
                removeProduct: function (index) {
                    this.client_products.splice(index, 1);
                },
                setClient: function (event) {
                    var client = event.target.value;
                    this.client_products = this.client_products_array.filter(function (client_product) {
                        return client_product.client_id == client;
                    });
                    this.client = client;
                },
                save: function () {
                    var $this = this;
                    axios.post('{{URL::to('inventory/product/post-assign-to-task')}}', {
                        _token: '{{csrf_token()}}',
                        data: $this.client_products,
                        client: $this.client
                    })
                        .then(function (response) {
                            if (response.data) {
                                window.location.reload();
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                setProduct: function (event, index) {
                    var product = event.target.value;
                    this.client_products[index].product_id = product;
                }
            }
        });
    </script>
@endsection