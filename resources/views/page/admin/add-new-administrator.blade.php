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
        </div>
        <!-- /end Page header  --> 
        <div class="container">
            <div class="row"> 
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener"> 
                    <div class="card form-card create-new-inspector">
                        <div class="title">
                            <h4 class="text-left">Create New Administrator</h4>
                            <h4 class="text-right goBack" style="float:right;">
                                <a href="{{URL::to('/admin/administrators')}}">
                                    Administrator Overview</a>
                            </h4>
                        </div> 
                        <div class="content" style="overflow:visible;min-height:450px;">
                            <form id="create-new-cleaner" method="post" class="form-horizontal"
                                  action="{{URL::to('admin/administrators/post-new-administrator')}}">
                                {{csrf_field()}}
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="first_name">First
                                            Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                   value="{{old('first_name')}}">
                                            @if ($errors->has('first_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="street_number">
                                            Street Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="street_number"
                                                   name="street_number" value="{{old('street_number')}}">
                                            @if ($errors->has('street_number'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('street_number') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label"
                                               for="city">City</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="city" name="city"
                                                   value="{{old('city')}}">
                                            @if ($errors->has('city'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="email">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="email" name="email"
                                                   value="{{old('email')}}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="mobile">Mobile
                                            Telephone</label>
                                        <div class="col-sm-8">
                                            <input type="tel" class="form-control" id="mobile" name="mobile"
                                                   value="{{old('mobile')}}">
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group" style="">
                                        <label class="col-sm-4 control-label" for="level">Access
                                            Level</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="level" name="level">
                                                <option value="1">Level 01</option>
                                                <option value="2">Level 02</option>
                                                <option value="3">Level 03</option>
                                                <option value="4">Level 04</option>
                                                <option value="5">Level 05</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="last_name">Last Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                   value="{{old('last_name')}}">
                                            @if ($errors->has('last_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('street_name') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="street_name">Street Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="street_name"
                                                   name="street_name" value="{{old('street_name')}}">
                                            @if ($errors->has('street_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('street_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('post_code') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="post_code">Postal
                                            Code</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="post_code" name="post_code"
                                                   value="{{old('post_code')}}">
                                            @if ($errors->has('post_code'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('post_code') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="telephone">Home Telephone
                                            Number</label>
                                        <div class="col-sm-8">
                                            <input type="tel" class="form-control" id="telephone" name="telephone"
                                                   value="{{old('telephone')}}">
                                            @if ($errors->has('telephone'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('agreement_start') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="agreement_start">
                                            Agreement Start</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inputdate" id="agreement_start"
                                                   name="agreement_start" value="{{old('agreement_start')}}">
                                            @if ($errors->has('agreement_start'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('agreement_start') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="level">Administrator Type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="user" name="user">
                                                <option value="3">Admin</option>
                                                <option value="2">Super Admin</option>
                                            </select>
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
    <style type="text/css">
        .select-svg{
            display: none;
        }
    </style>
@endsection