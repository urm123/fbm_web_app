@extends('layouts.common')

@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="inspectors_details">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Inspectors</h3>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                    <div class="second-navbar page">
                        <ul>
                            <li class="active"><a href="{{URL::to('admin/inspectors/login-details')}}">Login Details</a>
                            </li>
                            <li><a href="{{URL::to('admin/inspectors')}}">Inspector Information</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card logoverview">
                        <div class="title">
                            <h4>Inspector Log Overview</h4>
                            <h4 class="text-right" style="float:right;">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1"
                                       data-toggle="dropdown">
                                        <img class="svg Deactive " src="{{URL::asset('assets/assets/moreoptions.svg')}}"
                                             alt="info" width="33"
                                             height="33">
                                    </a>
                                    <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#" id="filterbyname"
                                               @click="setSource(true)">
                                                <img class="svg " src="{{URL::asset('assets/assets/calendar.svg')}}"
                                                     alt="info" width="33"
                                                     height="33">
                                                Filter by Date
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </h4>
                        </div>
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">

                                <div class="tab-content">

                                    <div class="content tab-pane fade in active Scroll" id="notifi-tab1"
                                         style="min-height:400px;">


                                        <table class="table selectable">

                                            <tr>
                                                <th>SI Number</th>
                                                <th>Inspector Name</th>
                                                <th>Assigned Client</th>
                                                <th>Booked Time Slot</th>
                                                <th>Last Logged-In</th>
                                                <th>Last Logged-Out</th>
                                            </tr>
                                            <tr @click="setInspector(inspector.id,inspector.client_id)"
                                                v-for="inspector in all_inspectors">
                                                <td class="col-1">@{{ inspector.pan_number}}</td>
                                                <td class="col-2">@{{ inspector.first_name}} @{{ inspector.last_name}}
                                                </td>
                                                <td class="col-3">@{{ inspector.client_first_name}}</td>
                                                <td class="col-4">@{{ inspector.start_time}}
                                                    - @{{ inspector.end_time}}
                                                </td>
                                                <td class="col-5">@{{ inspector.login}}</td>
                                                <td class="col-6">@{{ inspector.logout}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--/end tab-pane-->

                                    <div class="content tab-pane fade in Scroll" id="notifi-tab2"
                                         style="min-height:400px;padding:8px;">
                                        <table class="table selectable">
                                            <tr>
                                                <th>SI Number</th>
                                                <th>Inspector Name</th>
                                                <th>Assigned Client</th>
                                                <th>Booked Time Slot</th>
                                                <th>Last Logged-In</th>
                                                <th>Last Logged-Out</th>
                                            </tr>
                                            <tr @click="setInspector(inspector.id,inspector.client_id)"
                                                v-for="inspector in all_inspectors"
                                                v-if="inspector.type==0">
                                                <td class="col-1">@{{ inspector.pan_number}}</td>
                                                <td class="col-2">@{{ inspector.first_name}} @{{ inspector.last_name}}
                                                </td>
                                                <td class="col-3">@{{ inspector.client_first_name}}</td>
                                                <td class="col-4">@{{ inspector.start_time}}
                                                    - @{{ inspector.end_time}}
                                                </td>
                                                <td class="col-5">@{{ inspector.login}}</td>
                                                <td class="col-6">
                                                    <span v-if="inspector.logout!='Absent'">@{{ inspector.logout}}</span>
                                                    <label v-if="inspector.logout=='Absent'" class="label label-danger">Absent</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--/end tab-pane-->

                                </div>
                                <!--/end tab-content -->
                            </div>
                            <!--/end   panel-body -->

                        </div>
                        <!--/end panel-default contener -->

                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->


                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 card-contener">
                    <div class="card inspectordetails">
                        <div class="title">
                            <h4>Inspector Details</h4>
                        </div>
                        <div class="content Scroll" style="min-height:300px;padding:8px;">
                            <table class="table">

                                <tr>
                                    <td class="col-1">Name:</td>
                                    <td class="col-2">@{{ inspector.first_name }} @{{ inspector.last_name }}</td>
                                </tr>
                                <tr>
                                    <td class="col-1">Contact Number:</td>
                                    <td class="col-2">@{{ inspector.telephone }}</td>
                                </tr>
                                <tr>
                                    <td class="col-1">Assigned Client:</td>
                                    <td class="col-2">@{{ inspector.client_first_name }}</td>
                                </tr>
                                <tr>
                                    <td class="col-1">Booked Time Slot:</td>
                                    <td class="col-2">@{{ inspector.start_time }} - @{{ inspector.end_time }}</td>
                                </tr>


                            </table>
                        </div>
                        <!--/end content -->
                    </div>
                </div>
                <!--/end card-contener -->

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 card-contener">
                    <div class="card cleanerlog">
                        <div class="title">
                            <h4>Inspector Log</h4>
                        </div>
                        <div class="content Scroll" style="min-height:300px;padding:8px;">
                            <table class="table">

                                <tr>
                                    <th>Date</th>
                                    <th>Logged-In</th>
                                    <th>Logged-Out</th>
                                </tr>

                                <tr v-for="time in selected_times">
                                    <td class="col-1">@{{ time.start_time }}</td>
                                    <td class="col-2">@{{ time.login }}</td>
                                    <td class="col-3">
                                        <span v-if="time.logout!='Absent'">@{{ time.logout}}</span>
                                        <label v-if="time.logout=='Absent'" class="label label-danger">Absent</label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--/end content -->
                    </div>
                </div>
                <!--/end card-contener -->

            </div>
        </div>
        <div class="container dash-alert-container">
            <div class="row">


            </div>
        </div>

        <!-- Modal Content  -->
        <div class="modal fade" id="FilterModal" tabindex="-1" role="dialog"
             aria-labelledby="FilterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;
                        </button>
                        <h4 class="modal-title" id="FilterModalLabel">Filter by
                            Date</h4>
                    </div>
                    <div class="modal-body" style="height:280px;">
                        <div class="form-horizontal">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"
                                           for="InputStartDate">Start Date</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control inputdate"
                                               id="InputStartDate" v-model="start_date"
                                               @blur="setStartDate($event)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"
                                           for="InputStartDate">End Date</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control inputdate"
                                               id="InputStartDate" v-model="end_date"
                                               @blur="setEndDate($event)">
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-default save"
                                            @click="setFilter">
                                        Apply
                                    </button>
                                    <button type="reset" class="btn btn-default clear"
                                            data-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Content  -->


    </section>

    <script>
        var data = {
            inspectors: {!! json_encode($inspectors) !!},
            all_inspectors: {!! json_encode($inspectors) !!},
            inspector: [],
            selected_times: [],
            start_date: moment().format('YYYY-MM-DD'),
            end_date: moment().format('YYYY-MM-DD'),
            source: true,
        };
        var inspectors_details = new Vue({
            el: '#inspectors_details',
            data: data,
            methods: {
                setInspector: function (id, client_id) {
                    var selected_inspector = this.inspectors.filter(function (inspector) {
                        return inspector.id == id && client_id == inspector.client_id;
                    });
                    this.inspector = selected_inspector[0];
                    this.selected_times = selected_inspector;
                },
                setFilter: function () {
                    if (this.source) {
                        var $this = this;
                        var selected_inspectors = this.inspectors.filter(function (selected_inspector) {
                            return moment(selected_inspector.start_datetime).isSameOrAfter(moment($this.start_date).format('YYYY-MM-DD')) && moment(selected_inspector.start_datetime).isSameOrBefore(moment($this.end_date).format('YYYY-MM-DD'))
                        });
                        this.all_inspectors = selected_inspectors;

                        $('#FilterModal').modal('hide');
                    } else {
                        var $this = this;
                        var selected_times = this.selected_times.filter(function (selected_time) {
                            return moment(selected_time.start_time).isSameOrAfter(moment($this.start_date).format('YYYY-MM-DD')) && moment(selected_time.start_time).isSameOrBefore(moment($this.end_date).format('YYYY-MM-DD'));
                        });

                        this.selected_times = selected_times;

                        $('#FilterModal').modal('hide');
                    }
                },
                setStartDate: function (event) {
                    this.start_date = event.target.value;
                },
                setEndDate: function (event) {
                    this.end_date = event.target.value;
                },
                setSource: function (value) {
                    this.source = value;
                }
            }
        });
    </script>
@endsection