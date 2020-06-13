@extends('layouts.common')

@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Role Information</h3>
                </div>
                <div class="col-xs-12 col-sm-1">
                </div>
                <div class="col-xs-12 col-sm-7">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{route('admin.permission.index')}}">Permissions</a></li>
                            <li><a href="{{route('admin.role.index')}}">Roles</a></li>
                            <li><a href="{{URL::to('/admin/user-management')}}">Activate/Deactivate Users</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container" id="role">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card form-card">

                        <div class="row title">
                            <div class="col-md-2">
                                <h4 class="text-left">Role Registration</h4>
                            </div>
                        </div>

                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">

                                    <div class="content tab-pane fade in active" id="notifi-tab2"
                                         style="padding:15px;overflow:visible;min-height:800px;">

                                        <form method="post" class="form-horizontal"
                                              action="{{route('admin.role.update',$role)}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="category_id" value="{{$role->id}}">
                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="row">
                                                <div class="col-xs-12"
                                                     style="padding-bottom:15px;">
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="name">Role
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="name"
                                                                       name="name"
                                                                       placeholder="John Doe"
                                                                       value="{{$role->name}}">
                                                                @if ($errors->has('name'))
                                                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                    <button type="submit" class="btn btn-default save">Save</button>
                                                    <button type="reset" class="btn btn-default clear">Cancel</button>
                                                </div>
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