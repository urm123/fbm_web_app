@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="clients">
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                    <ol class="breadcrumb" style="background: #fff;">
                        <?php echo $breadcrumb; ?>
                    </ol>
                </div> 
            </div> 
        </div>
        <div id="exTab2" class="container">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#1" data-toggle="tab">Cleaner Info</a></li>
                <li><a href="#2" data-toggle="tab">Client Details</a></li>
                <li><a href="#3" data-toggle="tab">Sign In / Sign Off</a></li>
            </ul>
            <div class="tab-content ">
                <div class="tab-pane active" id="1">
                    <br />
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                            <div class="card cleanerdetails"> 
                                <div class="content Scroll" style="min-height:300px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                                    <table class="table table-hover" id="print">
                                        <tr>
                                            <td class="col-1" style="width:30%;">Name:</td>
                                            <td class="col-2"><span id="cName"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="col-1" style="width:30%;">Username:</td>
                                            <td class="col-2"><span id="cUname"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="col-1">Telephone Number:</td>
                                            <td class="col-2"><span id="cTel"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="col-1">Mobile Number:</td>
                                            <td class="col-2"><span id="cMobile"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="col-1">Address:</td>
                                            <td class="col-2"><span id="cAddress"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="col-1">Start Date:</td>
                                            <td class="col-2"><span id="cSdate"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="col-1">Cleaner Type:</td>
                                            <td class="col-2"><span id="cType"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="col-1">Password:</td>
                                            <td class="col-2" style="font-family: monospace"><span id="cPass"></span></td>
                                        </tr> 
                                        <!-- <tr v-if="cleaner.file">
                                            <td class="col-1">Document:</td>
                                            <td class="col-2"><a id="image" href="" target="_blank">Download</a></td>
                                        </tr> -->
                                        <tr>
                                            <td colspan="2">
                                                <table class="table table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 25%">Client</th>
                                                        <th style="width: 75%">Time Slot</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="timeSlot">
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div> 
                                <br />
                                <!--/end content -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="2">
                    <br />
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                            <div class="card cleanerdetails">
                                <div class="content Scroll" style="min-height:300px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                                    <table class="table" id="print">
                                        <thead>
                                            <th>Client</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($cleanerClients as $clients)
                                                <tr>
                                                    <td class="col-2">{{ $clients->client_first_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="3">
                    <br />
                    <div class="container">
                        <div class="row">
                            <!--/end card-contener -->
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                                <div class="card cleanerdetails">
{{--                                    <div class="title">--}}
{{--                                        <h4>Client Details</h4>--}}
{{--                                    </div>--}}
                                    <div class="content Scroll" style="min-height:300px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Client</th>
                                                    <th>Task</th>
                                                    <th>Booked Time Slot</th>
                                                    <th>Logged-In</th>
                                                    <th>Logged-Out</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($cleanerLogs as $detail)
                                                <tr>
                                                    <td>{{ $detail->client_first_name }} </td>
                                                    <td>{{ $detail->task_name }} </td>
                                                    <td>{{ $detail->start_time }} - {{ $detail->end_time }}</td>
                                                    <td>{{ $detail->login }}</td>
                                                    <td>{{ $detail->logout }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    <section class="page-content dashboard" id="cleaners_details">--}}
{{--        <!-- Page header  -->--}}
{{--        <div class="container page-header">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">--}}
{{--                    <h3>Cleaners</h3>--}}
{{--                </div>--}}
{{--                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">--}}
{{--                </div>--}}
{{--                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">--}}
{{--                    <div class="second-navbar page">--}}
{{--                        <ul>--}}
{{--                            <li class="active"><a href="{{URL::to('admin/cleaners/login-details')}}">Login Details</a></li>--}}
{{--                            <li><a href="{{URL::to('admin/cleaners')}}">Cleaner Information</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /end Page header  -->--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">--}}
{{--                    <div class="card logoverview">--}}
{{--                        <div class="title">--}}
{{--                            <h4>Cleaner Log Overview</h4>--}}
{{--                            <h4 class="text-right" style="float:right;">--}}
{{--                                <div class="dropdown">--}}
{{--                                    <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1"--}}
{{--                                       data-toggle="dropdown">--}}
{{--                                        <img class="svg Deactive " src="{{URL::asset('assets/assets/moreoptions.svg')}}"--}}
{{--                                             alt="info" width="33"--}}
{{--                                             height="33">--}}
{{--                                    </a>--}}
{{--                                    <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">--}}
{{--                                        <li role="presentation">--}}
{{--                                            <a role="menuitem" tabindex="-1" href="#" id="filterbyname"--}}
{{--                                               @click="setSource(true)">--}}
{{--                                                <img class="svg " src="{{URL::asset('assets/assets/calendar.svg')}}"--}}
{{--                                                     alt="info" width="33"--}}
{{--                                                     height="33">--}}
{{--                                                Filter by Date--}}
{{--                                            </a>--}}
{{--                                        </li>--}}

{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </h4>--}}
{{--                        </div>--}}
{{--                        <div class="panel with-nav-tabs panel-default">--}}
{{--                            <div class="panel-body">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="content tab-pane fade in active Scroll" id="notifi-tab1"--}}
{{--                                         style="min-height:400px;">--}}
{{--                                        <table class="table selectable">--}}
{{--                                            <tr>--}}
{{--                                                <th>SI Number</th>--}}
{{--                                                <th>Cleaner Name</th>--}}
{{--                                                <th>Assigned Client</th>--}}
{{--                                                <th>Booked Time Slot</th>--}}
{{--                                                <th>Last Logged-In</th>--}}
{{--                                                <th>Last Logged-Out</th>--}}
{{--                                            </tr>--}}
{{--                                            <tr @click="setCleaner(cleaner.id,cleaner.client_id)"--}}
{{--                                                v-for="cleaner in all_cleaners"--}}
{{--                                                v-if="cleaner.type==1">--}}
{{--                                                <td class="col-1">@{{ cleaner.pan_number}}</td>--}}
{{--                                                <td class="col-2">@{{ cleaner.first_name}} @{{ cleaner.last_name}}</td>--}}
{{--                                                <td class="col-3">@{{ cleaner.client_first_name}}</td>--}}
{{--                                                <td class="col-4">@{{ cleaner.start_time}}--}}
{{--                                                    - @{{ cleaner.end_time}}--}}
{{--                                                </td>--}}
{{--                                                <td class="col-5">@{{ cleaner.login}}</td>--}}
{{--                                                <td class="col-6">@{{ cleaner.logout}}</td>--}}
{{--                                            </tr>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <!--/end tab-pane-->--}}

{{--                                    <div class="content tab-pane fade in Scroll" id="notifi-tab2"--}}
{{--                                         style="min-height:400px;padding:8px;">--}}
{{--                                        <table class="table selectable">--}}
{{--                                            <tr>--}}
{{--                                                <th>SI Number</th>--}}
{{--                                                <th>Cleaner Name</th>--}}
{{--                                                <th>Assigned Client</th>--}}
{{--                                                <th>Booked Time Slot</th>--}}
{{--                                                <th>Last Logged-In</th>--}}
{{--                                                <th>Last Logged-Out</th>--}}
{{--                                            </tr>--}}
{{--                                            <tr @click="setCleaner(cleaner.id,cleaner.client_id)"--}}
{{--                                                v-for="cleaner in all_cleaners"--}}
{{--                                                v-if="cleaner.type==0">--}}
{{--                                                <td class="col-1">@{{ cleaner.pan_number}}</td>--}}
{{--                                                <td class="col-2">@{{ cleaner.first_name}} @{{ cleaner.last_name}}</td>--}}
{{--                                                <td class="col-3">@{{ cleaner.client_first_name}}</td>--}}
{{--                                                <td class="col-4">@{{ cleaner.start_time}}--}}
{{--                                                    - @{{ cleaner.end_time}}--}}
{{--                                                </td>--}}
{{--                                                <td class="col-5">@{{ cleaner.login}}</td>--}}
{{--                                                <td class="col-6">--}}
{{--                                                    <span v-if="cleaner.logout!='Absent'">@{{ cleaner.logout}}</span>--}}
{{--                                                    <label v-if="cleaner.logout=='Absent'" class="label label-danger">Absent</label>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <!--/end tab-pane-->--}}
{{--                                </div>--}}
{{--                                <!--/end tab-content -->--}}
{{--                            </div>--}}
{{--                            <!--/end   panel-body -->--}}
{{--                            <div class="cord-footer">--}}
{{--                                <div class="panel-heading">--}}
{{--                                    <ul class="nav nav-tabs">--}}
{{--                                        <li class="active"><a href="#notifi-tab1" data-toggle="tab">Cleaner</a></li>--}}
{{--                                        <li><a href="#notifi-tab2" data-toggle="tab">Sub-Contractor</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <!-- end panel-heading -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--/end panel-default contener -->--}}
{{--                    </div>--}}
{{--                    <!--/end Card -->--}}
{{--                </div>--}}
{{--                <!--/end card-contener -->--}}
{{--                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 card-contener">--}}
{{--                    <div class="card cleanerdetails">--}}
{{--                        <div class="title">--}}
{{--                            <h4>Cleaner Details</h4>--}}
{{--                        </div>--}}
{{--                        <div class="content Scroll" style="min-height:300px;padding:8px;">--}}
{{--                            <table class="table">--}}
{{--                                <tr>--}}
{{--                                    <td class="col-1">Name:</td>--}}
{{--                                    <td class="col-2">@{{ cleaner.first_name }} @{{ cleaner.last_name }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="col-1">Contact Number:</td>--}}
{{--                                    <td class="col-2">@{{ cleaner.telephone }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="col-1">Assigned Client:</td>--}}
{{--                                    <td class="col-2">@{{ cleaner.client_first_name }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="col-1">Booked Time Slot:</td>--}}
{{--                                    <td class="col-2">@{{ cleaner.start_time }} - @{{ cleaner.end_time }}</td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <!--/end content -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!--/end card-contener -->--}}
{{--                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 card-contener">--}}
{{--                    <div class="card cleanerlog">--}}
{{--                        <div class="title">--}}
{{--                            <h4>Cleaner Log</h4>--}}
{{--                        </div>--}}
{{--                        <div class="content Scroll" style="min-height:300px;padding:8px;">--}}
{{--                            <table class="table">--}}
{{--                                <tr>--}}
{{--                                    <th>Date</th>--}}
{{--                                    <th>Logged-In</th>--}}
{{--                                    <th>Logged-Out</th>--}}
{{--                                </tr>--}}
{{--                                <tr v-for="time in selected_times">--}}
{{--                                    <td class="col-1">@{{ time.start_time }}</td>--}}
{{--                                    <td class="col-2">@{{ time.login }}</td>--}}
{{--                                    <td class="col-3">--}}
{{--                                        <span v-if="time.logout!='Absent'">@{{ time.logout}}</span>--}}
{{--                                        <label v-if="time.logout=='Absent'" class="label label-danger">Absent</label>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <!--/end content -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!--/end card-contener -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="container dash-alert-container">--}}
{{--            <div class="row">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Modal Content  -->--}}
{{--        <div class="modal fade" id="FilterModal" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="FilterModalLabel" aria-hidden="true">--}}
{{--            <div class="modal-dialog">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <button type="button" class="close" data-dismiss="modal"--}}
{{--                                aria-hidden="true">&times;--}}
{{--                        </button>--}}
{{--                        <h4 class="modal-title" id="FilterModalLabel">Filter by--}}
{{--                            Date</h4>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body" style="height:280px;">--}}
{{--                        <div class="form-horizontal">--}}
{{--                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="col-sm-4 control-label"--}}
{{--                                           for="InputStartDate">Start Date</label>--}}
{{--                                    <div class="col-sm-8">--}}
{{--                                        <input type="text"--}}
{{--                                               class="form-control inputdate"--}}
{{--                                               id="InputStartDate" v-model="start_date"--}}
{{--                                               @blur="setStartDate($event)">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="col-sm-4 control-label"--}}
{{--                                           for="InputStartDate">End Date</label>--}}
{{--                                    <div class="col-sm-8">--}}
{{--                                        <input type="text"--}}
{{--                                               class="form-control inputdate"--}}
{{--                                               id="InputStartDate" v-model="end_date"--}}
{{--                                               @blur="setEndDate($event)">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group text-right">--}}
{{--                                    <button type="submit" class="btn btn-default save"--}}
{{--                                            @click="setFilter">--}}
{{--                                        Apply--}}
{{--                                    </button>--}}
{{--                                    <button type="reset" class="btn btn-default clear"--}}
{{--                                            data-dismiss="modal">Cancel--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /Modal Content  -->--}}
{{--    </section>--}}
 
    <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script> 
    <script>
        var data = {
            {{--cleaners: {!! json_encode($cleaners) !!},--}}
            {{--all_cleaners: {!! json_encode($cleaners) !!},--}}
            {{--cleaner: [],--}}
            {{--selected_times: [],--}}
            {{--start_date: moment().format('YYYY-MM-DD'),--}}
            {{--end_date: moment().format('YYYY-MM-DD'),--}}
            {{--source: true,--}}
        };

        var data1 = {
            'cleaners': {!! json_encode($cleanerInfo) !!},
            'cleaner': [],
            'cleaner_id': '{{$cleaner_id}}',
            'filtered_cleaners': []
        };
        $(document).ready(function(){

            var json_arr = data1['cleaners']; 
            var as = $(json_arr).filter(function (i,n){
                return n.user_id == data1['cleaner_id'];
            }); 

            $("#cName").html(as[0].first_name +' '+ as[0].last_name);
            $("#cUname").html(as[0].username);
            $("#cTel").html(as[0].telephone);
            $("#cMobile").html(as[0].mobile);
            $("#cAddress").html(as[0].address);
            $("#cSdate").html(as[0].start_date);
            $("#cType").html(as[0].type);
            $("#cPass").html(as[0].initial_password);
            $("#image").attr("href", as[0].image);

            $('#timeSlot').html('');
            var list = $('<tr></tr>');
            $('#timeSlot').append(list);
            $.each(as[0]['tasks'], function (index, titleObj) {
                $('#timeSlot').append('<tr><td>' + titleObj.name + '</td><td>' + titleObj.name + '</td></tr>');
            });
        });

        // var cleaners_details = new Vue({
        //     el: '#cleaners_details',
        //     data: data,
        //     methods: {
        //         setCleaner: function (id, client_id) {
        //             var selected_cleaner = this.cleaners.filter(function (cleaner) {
        //                 return cleaner.id == id && client_id == cleaner.client_id;
        //             });
        //             this.cleaner = selected_cleaner[0];
        //             this.selected_times = selected_cleaner;
        //         },
        //         setFilter: function () {
        //             if (this.source) {
        //                 var $this = this;
        //                 var selected_cleaners = this.cleaners.filter(function (selected_cleaner) {
        //                     return moment(selected_cleaner.start_datetime).isSameOrAfter(moment($this.start_date).format('YYYY-MM-DD')) && moment(selected_cleaner.start_datetime).isSameOrBefore(moment($this.end_date).format('YYYY-MM-DD'))
        //                 });
        //                 this.all_cleaners = selected_cleaners;
        //
        //                 $('#FilterModal').modal('hide');
        //             } else {
        //                 var $this = this;
        //                 var selected_times = this.selected_times.filter(function (selected_time) {
        //                     return moment(selected_time.start_time).isSameOrAfter(moment($this.start_date).format('YYYY-MM-DD')) && moment(selected_time.start_time).isSameOrBefore(moment($this.end_date).format('YYYY-MM-DD'));
        //                 });
        //
        //                 this.selected_times = selected_times;
        //
        //                 $('#FilterModal').modal('hide');
        //             }
        //         },
        //         setStartDate: function (event) {
        //             this.start_date = event.target.value;
        //         },
        //         setEndDate: function (event) {
        //             this.end_date = event.target.value;
        //         },
        //         setSource: function (value) {
        //             this.source = value;
        //         }
        //     }
        // });
    </script>
@endsection