@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard">
        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Permission Information</h3>
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
        <div class="container" id="permission">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card form-card">
                        <div class="row title">
                            <div class="col-md-2">
                                <h4 class="text-left">Permission Registration</h4>
                            </div>
                        </div>
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="content tab-pane fade in active" id="notifi-tab2" style="padding:15px;overflow:visible;min-height:800px;">
                                        <form method="post" class="form-horizontal"
                                              action="{{route('admin.permission.update',$permission)}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="category_id" value="{{$permission->id}}">
                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="row">
                                                <div class="col-xs-12" style="padding-bottom:15px;">
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="name">Permission
                                                                Name</label>
                                                            <div class="col-sm-8">
{{--                                                                <input type="text" class="form-control" id="name"--}}
{{--                                                                       name="name" placeholder="John Doe" value="{{$permission->name}}">--}}
                                                                <select class="form-control selectpicker" id="name" name="name">
                                                                    @foreach($menuItems as $menu)
                                                                        <option value="{{$menu->name}}">{{$menu->name}}</option>>
                                                                    @endforeach
                                                                </select>
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
                                            <div class="row" v-for="(added_role,added_index) in added_roles">
                                                <div class="col-xs-12" style="padding-bottom: 15px;">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label"
                                                                   :for="'role'+added_index">Role</label>
                                                            <div class="col-sm-7">
                                                                <select name="roles[]" :id="'role'+added_index"
                                                                        class="form-control" v-model="added_role.id">
                                                                    <option value="">Please select a role to add </option>
                                                                    <option v-for="role in roles" :value="role.id">@{{
                                                                        role.name }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button class="btn btn-danger"
                                                                        @click.prevent="removeRole(added_index)">Remove
                                                                    Role
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 text-right" style="padding-bottom: 15px;">
                                                    <button class="btn btn-primary" @click.prevent="addRole">Add a role
                                                        to permission
                                                    </button>
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
    <script type="text/javascript">
        var data = {
            roles:{!! json_encode($roles) !!},
            added_roles: {!! json_encode($permission->roles) !!}
        };

        var permissions = new Vue({
            el: '#permission',
            data: data,
            mounted: function () {

            },
            methods: {
                addRole: function () {
                    this.added_roles.push({id: '', name: ''});
                },
                removeRole: function (index) {
                    this.added_roles.splice(index, 1);
                }
            }
        });
    </script>

@endsection