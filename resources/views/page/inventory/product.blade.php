@extends('layouts.common')
@section('content')
    @include('layouts.headers.inventory')
    <section class="page-content dashboard" id="inspector_app">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Products</h3>
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

                    <div class="card inspactionoverview">
                        <div class="title">
                            <h4 class="text-left">Products</h4>
                        </div>
                        <div class="content Scroll " style="min-height:400px;padding:7px;">
                            <table class="table selectable">

                                <tr>
                                    <th>Product</th>
                                    <th>Unit</th>
                                    <th>Edit</th>
                                    {{--<th>Terminate</th>--}}
                                </tr>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="col-1">{{$product->name}}</td>
                                        <td class="col-2">{{$product->units}}</td>
                                        <td><a href="{{URL::to('inventory/product/'.$product->encoded.'/edit')}}"
                                               class="btn btn-success">Edit</a>
                                        </td>
                                        {{--<td><a href="{{URL::to('inventory/product/'.$product->encoded.'/delete')}}"--}}
                                        {{--class="btn btn-danger">Terminate</a>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endforeach
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
@endsection