@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')

    <section class="page-content dashboard">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Activate/Deactivate Users</h3>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <div class="second-navbar page">
                        <ul>
                            {{--                            <li><a href="{{route('admin.checklist.index')}}">Checklists</a></li>--}}
                            <li><a href="{{route('admin.permission.index')}}">Permissions</a></li>
                            <li><a href="{{route('admin.role.index')}}">Roles</a></li>
                            <li><a href="{{URL::to('/admin/user-management')}}">Activate/Deactivate Users</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container" id="users">
            <div class="row">

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 card-contener">

                    <div class="card userActDact">
                        <div class="title">
                            <h4 class="text-left">Filter Users</h4>

                        </div>
                        <div class="content" style="overflow:visible; height:200px;">
                            <form method="post" class="form-horizontal" action="" @submit.prevent="">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="FilterSearch">Filter By Role</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" id="FilterSearch"
                                                    @change="filterByRole(0,$event)">
                                                <option value="">Select role</option>
                                                <option value="INSPECTOR_1">Inspectors (Level 1)</option>
                                                <option value="INSPECTOR_2">Inspectors (Level 2)</option>
                                                <option value="CLEANER">Cleaners</option>
                                                <option value="SUBCONTRACTOR">Sub-contractors</option>
                                                <option value="ADMIN">Administrators</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="FilterName">Search By Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="FilterName"
                                                   @keyup="filterByName(0,$event)">
                                        </div>
                                    </div>

                                </div>
                            </form>


                        </div>
                        <!--/end tab-pane-->
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 card-contener">

                    <div class="card userActDact">
                        <div class="title">
                            <h4 class="text-left">Activate/Deactivate Users</h4>

                        </div>
                        <div class="content Scroll" style="min-height:380px;">
                            <table class="table selectable">

                                <tr>
                                    <th>User Name</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr v-for="user in filtered_users">
                                    <td class="col-1">@{{user.name}}</td>
                                    <td class="col-2"><a href="#" @click="setActive(user.id,$event)">
                                            <i class="svg Green ion-ios-checkmark-empty"
                                               :class="{'Deactive':user.deactive}"></i></a></td>
                                    <td class="col-3"><a href="#" @click="setDeactive(user.id,$event)">
                                            <i class="svg Red ion-ios-close-empty"
                                               :class="{'Deactive':user.active}"></i></a></td>
                                </tr>
                            </table>
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
        var data = {
            users: {!! $users !!},
            filtered_users: [],
        };
        var vue_users = new Vue({
            data: data,
            el: '#users',
            mounted: function () {
                this.filtered_users = this.users;
            },
            methods: {
                setActive: function (user_id, event) {
                    event.preventDefault();

                    var $this = this;

                    axios.post('{{URL::to('/admin/user-management/post-set-active')}}', {
                        _token: '{{csrf_token()}}',
                        user_id: user_id
                    })
                        .then(function (response) {
                            if (response.data.status == 'success') {
                                $this.resetButtons(user_id, 'deactive');
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                setDeactive: function (user_id, event) {
                    event.preventDefault();

                    var $this = this;

                    axios.post('{{URL::to('/admin/user-management/post-set-deactive')}}', {
                        _token: '{{csrf_token()}}',
                        user_id: user_id
                    })
                        .then(function (response) {
                            if (response.data.status == 'success') {
                                $this.resetButtons(user_id, 'active');
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                resetButtons: function (user_id, status) {
                    var selected_user = this.filtered_users.filter(function (user) {
                        return user.id == user_id;
                    });

                    if (status == 'active') {
                        this.$set(selected_user[0], 'deactive', true);
                        this.$set(selected_user[0], 'active', false);
                    }
                    if (status == 'deactive') {
                        this.$set(selected_user[0], 'deactive', false);
                        this.$set(selected_user[0], 'active', true);
                    }
                },
                filterByRole: function (value, event) {
                    var filtered_users = this.users.filter(function (user) {
                        return user.role == event.target.value;
                    });

                    this.filtered_users = filtered_users;
                },
                filterByName: function (value, event) {
                    var filtered_users = this.users.filter(function (user) {
                        return user.name.toLowerCase().indexOf(event.target.value.toLowerCase()) > -1;
                    });

//@todo combine select and input values to create more advanced filter

                    if (filtered_users.length <= 0) {
                        this.filtered_users = this.users;
                    } else {
                        this.filtered_users = filtered_users;
                    }
                }
            }
        });
    </script>
@endsection