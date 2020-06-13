@extends('layouts.common')

@section('content')
    @include('layouts.headers.inventory')
    <section class="page-content dashbord" id="products">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Alert</h3>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">

                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card cleaneroverview">
                        <div class="title">
                            <h4 class="text-left">Alerts Overview</h4>
                        </div>
                        <div class="content Scroll" style="min-height:400px;">
                            <table class="table selectable">

                                <tr>
                                    <th></th>
                                    <th colspan="2">Client</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Minimum limit</th>
                                    <th>Price</th>
                                </tr>
                                @foreach($products as $product)
                                    <tr @click="setProduct({{$product->id}})">
                                        <td class="col-1">
                                            <img class="svg {{$product->alert}}"
                                                 src="{{URL::asset('assets/assets/clock.svg')}}" alt="info"
                                                 width="33"
                                                 height="33"></td>
                                        <td class="col-2">{{$product->client_name}}</td>
                                        <td class="col-2">{{$product->client_address}}</td>
                                        <td class="col-2">{{$product->product_name}}</td>
                                        <td class="col-3">{{$product->quantity}} {{$product->units}}</td>
                                        <td class="col-4">{{$product->shortage_alert}} {{$product->units}}</td>
                                        <td class="col-5">{{$product->price}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!--/end tab-pane-->
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card cleanerdetails">
                        <div class="title">
                            <h4>Alert Details</h4>
                        </div>
                        <div class="content Scroll" style="min-height:300px;">
                            <table class="table">

                                <tr>
                                    <th class="col-1">@{{ heading }}</th>
                                </tr>
                                <tr>
                                    <td class="col-2">@{{ description }}</td>
                                </tr>
                            </table>
                        </div>
                        <!--/end content -->
                    </div>
                </div>
                <!--/end card-container -->

            </div>
        </div>
    </section>

    <script type="text/javascript">
        var data = {
            products: {!! json_encode($products) !!},
            heading: '',
            description: ''
        };

        var products = new Vue({
            el: '#products',
            data: data,
            methods: {
                setProduct: function (product_id) {
                    var selected_product = this.products.filter(function (product) {
                        return product_id == product.id
                    });

                    var remaining_quantity = selected_product[0].quantity - selected_product[0].shortage_alert;
                    if (remaining_quantity > 0 && remaining_quantity < 5) {
                        this.heading = 'Warning, the product will be out of stock soon!';
                        this.description = 'There is only ' + remaining_quantity + ' ' + selected_product[0].units + ' remaining until it hits minimum item limit. You need to purchase more soon!';
                    } else if (remaining_quantity <= 0) {
                        this.heading = 'Warning, the product is out of stock!';
                        this.description = 'There is only ' + selected_product[0].quantity + ' ' + selected_product[0].units + ' remaining. You need to purchase more now!';
                    } else {
                        this.heading = 'Products are available.';
                        this.description = 'No need to purchase more soon.';
                    }
                }
            }
        });

    </script>

@endsection