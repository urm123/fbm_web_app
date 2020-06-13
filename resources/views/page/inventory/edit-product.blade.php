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
                            <li><a href="{{URL::to('/inventory/product')}}">Products</a></li>
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
                                        <li class="active"><a href="#notifi-tab1" data-toggle="tab">Edit Product</a>
                                        </li>
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
                                    <div class="content tab-pane active fade in " id="notifi-tab2">
                                        <form id="create-new-cleaner" method="post" class="form-horizontal"
                                              action="{{URL::to('inventory/product/post-edit-product')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="name">Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="name"
                                                               id="name" value="{{$product->name}}">
                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="name">Unit</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="unit"
                                                               id="unit" value="{{$product->unit}}">
                                                        @if ($errors->has('unit'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                                        @endif
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
@endsection