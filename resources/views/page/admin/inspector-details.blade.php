@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="inspector_app">
        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-1">
                    <h3>Inspectors</h3>
                </div>
                <div class="col-xs-12 col-sm-11">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('admin/inspectors/login-details')}}">Login Details</a></li>
                            <li><a href="{{URL::to('/admin/inspectors')}}">Inspector Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                </div>
            </div>
        </div>
        <!-- /end Page header  -->
        <section class="page-content dashboard" id="clients">
            <div id="exTab2" class="container">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#1" data-toggle="tab">Inspector Details</a></li>
                    <li><a href="#2" data-toggle="tab">Sign In / Sign Off</a></li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane active" id="1">
                        <br />
                        <div class="container">
                            <div class="row">
                                <!--/end card-contener -->
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                                    <div class="card cleanerdetails">
                                        <div class="content Scroll" style="min-height:350px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                                            <table class="table" id="print">
                                                <tr>
                                                    <td class="col-1" style="width:30%;">Name:</td>
                                                    <td class="col-2">{{ $inspector->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-1" style="width:30%;">Username:</td>
                                                    <td class="col-2">{{ $inspector->username }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-1">Telephone Number:</td>
                                                    <td class="col-2">{{ $inspector->telephone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-1">Mobile Number:</td>
                                                    <td class="col-2">{{ $inspector->mobile }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-1">Address:</td>
                                                    <td class="col-2">{{ $inspector->address }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-1">Start Date:</td>
                                                    <td class="col-2">{{ $inspector->agreement_start }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-1">Password:</td>
                                                    <td class="col-2" style="font-family: monospace">
                                                        {{ $inspector->password }}
                                                    </td>
                                                </tr>
                                                @if($inspector->file)
                                                    <tr>
                                                        <td class="col-1">Document:</td>
                                                        <td class="col-2"><a href="{{ $inspector->image }}" target="_blank">Download</a></td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="2">
                                                        <table class="table table-responsive">
                                                            <thead>
                                                            <tr>
                                                                <th style="width: 25%">Client</th>
                                                                <th style="width: 75%">Time Slot</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($inspector->tasks as $task)
                                                                <tr>
                                                                    <td>{{ $task->name }} - {{ $task->task_name }}</td>
                                                                    <td>{{ $task->display_time }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="2">
                        <br />
                        <div class="container">
                            <div class="row">
                                <!--/end card-contener -->
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                                    <div class="card cleanerdetails">
                                        <div class="content Scroll" style="min-height:350px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                                            <table class="table" id="print">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20%">Client</th>
                                                        <th style="width: 25%">Task</th>
                                                        <th style="width: 15%">Task Type</th>
                                                        <th style="width: 20%">Sign In</th>
                                                        <th style="width: 20%">Sign Off</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($inspector_task_times as $taskTime)
                                                    <tr>
                                                        <td>{{ $taskTime->name }}</td>
                                                        <td>{{ $taskTime->task_name }}</td>
                                                        <td>
                                                            @if($taskTime->task_type == 'complaint')
                                                                Complaint
                                                            @else
                                                                Scheduled Task
                                                            @endif
                                                        </td>
                                                        <td>{{ $taskTime->start_date }}</td>
                                                        <td>{{ $taskTime->end_date }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script>

        {{--var data = {--}}
        {{--    inspectors: {!! json_encode($inspectors) !!},--}}
        {{--    inspector: [],--}}
        {{--    inspector_id: '{{$inspector_id}}',--}}
        {{--    filtered_inspectors: []--}}
        {{--};--}}


    </script>
@endsection