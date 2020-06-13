@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')

    <section class="page-content dashboard" id="permissions">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Roles</h3>
                </div>
                <div class="col-xs-12 col-sm-8 ">
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

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card cleaneroverview">
                        <div class="title">
                            <h4 class="text-left">Permission Overview</h4>
                            <h4 class="text-right" style="float:right;"><a
                                        href="{{route('admin.permission.create')}}">
                                    Add New Permission + </a></h4>
                        </div>
                        <div class="content Scroll" style="min-height:400px;">
                            <table class="table selectable cleaner-table">

                                <tr>
                                    <th>Permission Name</th>
                                    <th></th>
                                    <th></th>
                                </tr>

                                @foreach($permissions as $permission)
                                    <tr>
                                        <td class="col-1">{{$permission->name}}</td>
                                        <td>
                                            <a href="{{route('admin.permission.edit',$permission)}}"
                                               class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" type="button"
                                                    onclick="deletePermission('{{$permission->id}}')">Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!--/end tab-pane-->
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->


                <!--/end card-contener -->

            </div>
        </div>

    </section>

    <script type="text/javascript">
        function deletePermission(permission_id) {
            var confirm = window.confirm('Are you sure you want to delete this permission?');

            if (confirm) {
                axios.delete('{{route('admin.permission.index')}}/' + permission_id).then(function (response) {
                    if (response.data) {
                        alert('Permission deleted successfully!');
                        window.location.reload();
                    }
                }).catch(function (error) {

                });
            }
        }
    </script>

@endsection