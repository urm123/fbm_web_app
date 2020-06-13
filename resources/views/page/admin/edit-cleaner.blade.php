@extends('layouts.common')

@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard"> 
        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                    <ol class="breadcrumb" style="background: #fff;">
                        <?php echo $breadcrumb; ?>
                    </ol>
                </div> 
            </div>
            <div class="row"> 
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('/admin/cleaners/login-details')}}">Login Details</a></li>
                            <li class="active"><a href="{{URL::to('/admin/cleaners')}}">Cleaner Information</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card form-card ">

                        <div class=" row title">
                            <div class="col-md-3">
                                <h4 class="text-left">Edit Cleaner</h4>
                            </div>
                        </div>

                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">

                                    <div class="content tab-pane fade in active " id="notifi-tab1"
                                         style="overflow:visible;">

                                        <form id="create-new-cleaner" method="post" class="form-horizontal"
                                              enctype="multipart/form-data"
                                              action="{{URL::to('admin/cleaners/post-edit-cleaner')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="cleaner_id" value="{{$cleaner->cleaner_id}}">
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="first_name">First
                                                        Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="first_name"
                                                               id="first_name" value="{{$cleaner->first_name}}">
                                                        @if ($errors->has('first_name'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="last_name">Last
                                                        Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="last_name"
                                                               id="last_name" value="{{$cleaner->last_name}}">
                                                        @if ($errors->has('last_name'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="street_number">Street
                                                        Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="street_number"
                                                               id="street_number"
                                                               name="street_number"
                                                               value="{{$cleaner->street_number}}">
                                                        @if ($errors->has('street_number'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('street_number') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('street_name') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="street_name">Street
                                                        Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="street_name"
                                                               id="street_name" value="{{$cleaner->street_name}}">
                                                        @if ($errors->has('street_name'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('street_name') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label"
                                                           for="city">City</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="city"
                                                               id="city" value="{{$cleaner->city}}">
                                                        @if ($errors->has('city'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('post_code') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="post_code">Postal
                                                        Code</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="post_code"
                                                               id="post_code" value="{{$cleaner->post_code}}">
                                                        @if ($errors->has('post_code'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('post_code') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="email">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" name="email"
                                                               id="email" value="{{$cleaner->email}}">
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="password">New
                                                        Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="password"
                                                               id="password">
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="telephone">Home
                                                        Telephone
                                                        Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="tel" class="form-control" name="telephone"
                                                               id="telephone" value="{{$cleaner->telephone}}">
                                                        @if ($errors->has('telephone'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="mobile">Mobile
                                                        Telephone</label>
                                                    <div class="col-sm-8">
                                                        <input type="tel" class="form-control" name="mobile"
                                                               id="mobile" value="{{$cleaner->mobile}}">
                                                        @if ($errors->has('mobile'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control "
                                                               style="visibility:hidden;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="start_date">Start
                                                        Date</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control inputdate"
                                                               id="start_date" name="start_date"
                                                               value="{{$cleaner->start_date}}">
                                                        @if ($errors->has('start_date'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('docs') ? ' has-error' : '' }}">
                                                    <label class="col-sm-4 control-label" for="docs">Upload
                                                        Docs</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class=" file" id="docs" name="docs">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control" disabled>
                                                            <span class="input-group-btn">
                                                                <button class="browse btn btn-primary" type="button">
                                                                    <img class="svg Green"
                                                                         src="{{URL::asset('assets/assets/Upload.svg')}}"
                                                                         alt="info" width="33"
                                                                         height="33"></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                <button type="submit" class="btn btn-default save">Save & Continue
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--/end tab-pane-->
                                </div>
                            </div>
                            <!--/end   panel-body -->

                            <div class="cord-footer">

                                <!-- end panel-heading -->
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