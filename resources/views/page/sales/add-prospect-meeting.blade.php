@extends('layouts.common')

@section('content')
    @include('layouts.headers.sales')
    <section class="page-content dashbord" id="prospects">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Prospects</h3>
                </div>
                <div class="col-xs-12 col-sm-4">

                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('sales/prospect-details')}}">Prospect Details</a></li>
                            <li><a href="{{URL::to('sales/prospects')}}">Add New Prospect</a></li>
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
                        <div class="title">
                            <h4 class="text-left">Prospect Details</h4>
                        </div>


                        <div class="content " style="overflow:visible;min-height:330px;">

                            <form method="post" class="form-horizontal"
                                  action="{{URL::to('/sales/prospects/ajax-post-prospect-meeting')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="prospect_id" value="{{$prospect_id}}">
                                <div class="col-xs-12 col-sm-6" style="padding: 30px;">
                                    <div class="form-group">
                                        <label for="date">Meeting Date:</label>
                                        <input type="text" v-model="date" id="date" name="date" @blur="setDate($event)"
                                               class="form-control inputdate">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6" style="padding: 30px;">
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <input type="text" v-model="description" id="description" name="description"
                                               class="form-control">
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
                    <!--/end Card -->


                    <!--/end card-->

                </div>
                <!--/end card-contener -->


            </div>
        </div>
        <!-- Modal -->

    </section>
@endsection