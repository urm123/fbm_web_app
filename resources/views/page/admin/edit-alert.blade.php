@extends('layouts.common')

@section('content')
    @include('layouts.headers.admin')

    <section class="page-content dashboard">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Alerts</h3>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                    <div class="second-navbar page">

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
                            <h4 class="text-left">Edit Alert</h4>
                            <h4 class="text-right goBack" style="float:right;">
                                <a href="{{URL::to('/admin/alerts')}}">
                                    Alerts Overview</a>
                            </h4>
                        </div>

                        <div class="content" style="overflow:visible;min-height:450px;">
                            <form id="create-new-alert" method="post" class="form-horizontal"
                                  action="{{URL::to('admin/alerts/post-edit-alert')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="alert_id" value="{{$alert->id}}">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="title">Title</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="title" name="title"
                                                   value="{{$alert->title}}">
                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="type">Type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" id="type" name="type">
                                                @if($alert->type=='cleaner')
                                                    <option value="cleaner" selected="selected">Cleaner</option>
                                                    <option value="inspector">Inspector</option>
                                                @else
                                                    <option value="cleaner">Cleaner</option>
                                                    <option value="inspector" selected="selected">Inspector</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="type">Status</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" id="status" name="status">
                                                @if($alert->status==true)
                                                    <option value="true" selected="selected">Active</option>
                                                    <option value="false">Deactive</option>
                                                @else
                                                    <option value="true">Active</option>
                                                    <option value="false" selected="selected">Deactive</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="message">Message</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="message" name="message"
                                                   value="{{$alert->message}}">
                                            @if ($errors->has('message'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="date">
                                            Date</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inputdate" id="date"
                                                   name="date" value="{{$alert->date}}">
                                            @if ($errors->has('date'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
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