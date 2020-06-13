@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
                    <h3>Inspector</h3>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-1 col-md-4 col-lg-4 ">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('/admin/inspectors')}}">Inspectors</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card form-card create-new-inspector">
                        <div class="title">
                            <h4 class="text-left">Create New Inspector</h4>
                            <h4 class="text-right goBack" style="float:right;"><a href="{{URL::to('admin/inspectors')}}">Inspector Overview</a></h4>
                        </div>
                        <div class="content" style="overflow:visible;min-height:450px;">

                            <form id="create-new-inspector" method="post" class="form-horizontal"
                                  action="{{URL::to('/admin/inspectors/post-new-inspector')}}">
                                {{csrf_field()}}
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="first_name">First Name <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                   placeholder="John Doe" value="{{old('first_name')}}">
                                            @if ($errors->has('first_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="street_number">Street Number <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="street_number"
                                                   id="street_number" value="{{old('street_number')}}">
                                            @if ($errors->has('street_number'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('street_number') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label"
                                               for="city">City <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="city" id="city"
                                                   value="{{old('city')}}">
                                            @if ($errors->has('city'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="mobile">Mobile Number <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="tel" class="form-control" name="mobile" id="mobile"
                                                   value="{{old('mobile')}}">
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="email">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" name="email" id="email"
                                                   value="{{old('email')}}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="start_date">Agreement
                                            Start <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inputdate" name="start_date"
                                                   id="start_date" value="{{old('start_date')}}">
                                            @if ($errors->has('start_date'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="last_name">Last Name <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                   value="{{old('last_name')}}">
                                            @if ($errors->has('last_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('street_name') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="street_name">Street Name <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="street_name"
                                                   id="street_name" value="{{old('street_name')}}">
                                            @if ($errors->has('street_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('street_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('post_code') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="post_code">Postal Code <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="post_code" id="post_code"
                                                   value="{{old('post_code')}}">
                                            @if ($errors->has('post_code'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('post_code') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="telephone">Home Number <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="tel" class="form-control" name="telephone" id="telephone"
                                                   value="{{old('telephone')}}">
                                            @if ($errors->has('telephone'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="username">Username <span style="color: #ff0000;"> *</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="username" id="username"
                                                   value="{{old('username')}}">
                                            @if ($errors->has('username'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="level">Inspector Level</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="level" id="level">
                                                <option value="INSPECTOR_1"
                                                        @if(old('level')=='INSPECTOR_1') selected="selected" @endif>
                                                    Inspector 1
                                                </option>
                                                <option value="INSPECTOR_2"
                                                        @if(old('level')=='INSPECTOR_2') selected="selected" @endif>
                                                    Inspector 2
                                                </option>
                                            </select>
                                            @if ($errors->has('level'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <button type="submit" class="btn btn-default save">Save & Continue</button>
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
@endsection