@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Task</h3>
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


                        <div class="content" style="overflow:visible;min-height:450px;">

                            <table class="table table-responsive">
                                <tr>
                                    <td>Client:</td>
                                    <td>{{$task->client_name}} {{$task->client_address}}</td>
                                </tr>
                                <tr>
                                    <td>Task:</td>
                                    <td>{{$task->task_name}} {{$task->task_address}}</td>
                                </tr>
                                <tr>
                                    <td>Cleaner:</td>
                                    <td>{{$task->cleaner_first_name}} {{$task->cleaner_last_name}}
                                        ({{$task->cleaner_number}})
                                    </td>
                                </tr>
                                <tr>
                                    <td>Inspector:</td>
                                    <td>{{$task->inspector_first_name}} {{$task->inspector_last_name}}
                                        ({{$task->inspector_number}})
                                    </td>
                                </tr>
                                <tr>
                                    <td>Start Time:</td>
                                    <td>{{$task->start_time}}</td>
                                </tr>
                                <tr>
                                    <td>End Time:</td>
                                    <td>{{$task->end_time}}</td>
                                </tr>
                                <tr>
                                    <td>Repeated Task:</td>
                                    <td>
                                        @if($task->schedule_repeat)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                </tr>
                                @if($task->schedule_repeat)
                                    <tr>
                                        <td>Client:</td>
                                        <td>{{$task->repeat_mode}}</td>
                                    </tr>
                                @endif
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
@endsection