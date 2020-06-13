@extends('layouts.common')

@section('content')
    @include('layouts.headers.inventory')
    <section class="page-content dashbord">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Overview</h3>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">

                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card">
                        <div class="title">
                            <h4 class="text-left">Inventory Overview</h4>
                        </div>


                        <div class="content Scroll " style="padding:15px;min-height:400px;">

                            <table class="table">

                                <tr>
                                    <th>Inventory</th>
                                    <th>Last Added Date</th>
                                    <th>Available Quantity</th>
                                    <th>Minimum Quantity</th>
                                </tr>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="col-1">{{$product->name}}</td>
                                        <td class="col-2">{{$product->added_date}}</td>
                                        <td class="col-3">{{$product->qty}} {{$product->units}}</td>
                                        <td class="col-3">{{$product->shortage_alert}} {{$product->units}}</td>
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