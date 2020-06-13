@extends('layouts.common')

@section('content')
    @include('layouts.headers.sales')
    <section class="page-content dashbord">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Followup</h3>
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
                            <h4 class="text-left">New Followup</h4>
                        </div>


                        <div class="content " style="overflow:visible;min-height:300px;">

                            <form method="post" class="form-horizontal"
                                  action="{{URL::to('/sales/followup/post-new-followup')}}">
                                {{csrf_field()}}
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="client">Client</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" id="client" name="client">
                                                <option value="">Select a client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('client'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('client') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label"
                                               for="comment">Comment</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="comment" name="comment"
                                                   value="{{old('comment')}}">
                                            @if ($errors->has('comment'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="type">Type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" id="type" name="type">
                                                <option value="">Select a type</option>
                                                <option value="one">One</option>
                                                <option value="two">Two</option>
                                                <option value="three">Three</option>
                                                <option value="four">Four</option>
                                                <option value="five">Five</option>
                                            </select>
                                            @if ($errors->has('type'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="date">Date</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inputdate" id="date" name="date"
                                                   value="{{old('date')}}">
                                            @if ($errors->has('date'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <button type="submit" class="btn btn-default save">Save</button>
                                    <button type="reset" class="btn btn-default clear">Cancel</button>
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

    <script type="text/javascript">
        window.addEventListener('load', function () {
            $('#client').select2({dropdownAutoWidth: true});
        });
    </script>
@endsection