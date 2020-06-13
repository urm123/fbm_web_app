@extends('layouts.common')
@section('content')
    @include('layouts.headers.dashboard')
    <section class="page-content dashboard" id="dashboard">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-8" style="padding:0;">

{{--                    <div class="col-xs-12 col-sm-6 col-md-4-offset-6 col-lg-6 card-contener">--}}

{{--                        <div class="card notification">--}}
{{--                            <div class="title">--}}
{{--                                <h4>Inventory Shortage</h4>--}}
{{--                            </div>--}}
{{--                            <div class="panel with-nav-tabs panel-default">--}}
{{--                                <div class="panel-body">--}}

{{--                                    <div class="tab-content">--}}

{{--                                        <!--/end tab-pane-->--}}

{{--                                        <div class="content tab-pane fade in Scroll active" id="notifi-tab2"--}}
{{--                                             style="min-height:350px;">--}}
{{--                                            <table class="table">--}}
{{--                                                @foreach($inventory as $inventory_item)--}}
{{--                                                    @if($inventory_item->shortage>$inventory_item->client_quantity)--}}
{{--                                                        <tr>--}}
{{--                                                            <td class="col-1"><p>{{$inventory_item->product_name}}</p>--}}
{{--                                                            </td>--}}
{{--                                                            <td class="col-2">--}}
{{--                                                                <p>{{$inventory_item->client_name}}</p>--}}
{{--                                                            </td>--}}
{{--                                                            <td class="col-2">--}}
{{--                                                                <p>{{$inventory_item->client_quantity}}</p>--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                            </table>--}}
{{--                                        </div>--}}

{{--                                        <div class="content tab-pane  fade Scroll" id="notifi-tab1"--}}
{{--                                             style="min-height:350px;">--}}
{{--                                            <table class="table">--}}
{{--                                                @foreach($client_reminder as $client_reminder_item)--}}
{{--                                                    <tr>--}}
{{--                                                        <td>--}}
{{--                                                            <p>--}}
{{--                                                                {{$client_reminder_item->name}}--}}
{{--                                                            </p>--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            <p>--}}
{{--                                                                {{$client_reminder_item->start_date}}--}}
{{--                                                            </p>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                @endforeach--}}
{{--                                            </table>--}}
{{--                                        </div>--}}
{{--                                        <!--/end tab-pane-->--}}

{{--                                    </div>--}}
{{--                                    <!--/end tab-content -->--}}
{{--                                </div>--}}
{{--                                <!--/end   panel-body -->--}}
{{--                                <div class="cord-footer">--}}
{{--                                    <div class="panel-heading">--}}
{{--                                        <ul class="nav nav-tabs">--}}
{{--                                            <li class="active"><a href="#notifi-tab2" data-toggle="tab">Supply--}}
{{--                                                    Request</a></li>--}}
{{--                                            <li><a href="#notifi-tab1" data-toggle="tab">Client Renewal</a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                    <!-- end panel-heading -->--}}
{{--                                </div>--}}


{{--                            </div>--}}
{{--                            <!--/end panel-default contener -->--}}

{{--                        </div>--}}
{{--                        <!--/end Card -->--}}
{{--                    </div>--}}
                    <!--/end card-contener -->

{{--                    <div class="col-xs-12 col-sm-6 col-md-6-offset-6  col-lg-6 card-contener">--}}
{{--                        <div class="card overview">--}}
{{--                            <div class="title">--}}
{{--                                <h4>Store Inventory Overview</h4>--}}
{{--                            </div>--}}
{{--                            <div class="content Scroll" style="min-height: 408px;">--}}
{{--                                <table class="table">--}}
{{--                                    @foreach($products as $product)--}}
{{--                                        <tr>--}}
{{--                                            <td class="col-1"><p>{{$product->name}}</p></td>--}}
{{--                                            <td class="col-2"><p>{{$product->qty}} {{$product->units}}</p></td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                            <!--/end content -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!--/end card-contener -->

                    <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12 card-contener">
                        <div class="card alerts">
                            <div class="title">
                                <h4>Alerts</h4>
                            </div>
                            <div class="content Scroll" style="min-height:348px;">
                                <table class="table">
                                    <tr v-for="(notification, index) in notifications">
                                        <td class="col-1">
                                            <img class="svg Red" src="{{URL::asset('assets/assets/clock.svg')}}"
                                                 alt="info"
                                                 width="33"
                                                 height="33">
                                        </td>
                                        <td class="col-2">
                                            <p>@{{notification.start_day}}
                                                <span>@{{notification.start_month}} @{{notification.start_year}}</span>
                                            </p>
                                        </td>
                                        {{--<td class="col-3"><p>@{{notification.task_name}}</p></td>--}}
                                        <td class="col-4">
                                            <p>@{{ notification.cleaner.first_name }} @{{ notification.cleaner.last_name
                                                }} not
                                                logged in for @{{ notification.client_first_name }}</p>
                                        </td>
                                        <td class="col-5"><p>
                                                @{{notification.due}}</p>
                                        </td>
                                        <td class="col-5"><a href="#"
                                                             @click.prevent="removeNotification(notification.task_id,index)"
                                                             class="btn btn-danger"><i
                                                        class="fa fa-close"></i></a></td>
                                    </tr>
                                    {{--separator--}}
                                        <tr>
                                            <td class="col-1">
                                                <a href="#" class="Red play-button">
                                                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
                                                </a>
                                            </td>
                                            <td class="col-2">
                                                <p>@{{sound.start_day}}
                                                    <span>@{{sound.start_month}} @{{sound.start_year}}</span>
                                                </p>
                                            </td>
                                            <td class="col-5">
                                                <audio controls :src="sound.audio"/>
                                            </td>
                                        </tr>
                                </table>
                            </div>
                            <!--/end content -->
                        </div>
                    </div>
                    <!--/end card-contener -->


                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding:0;">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12card-contener">
                        <div class="card assingnments">
                            <div class="title">
                                <h4>Assignments</h4>
                            </div>
                            <div class="panel with-nav-tabs panel-default">
                                <div class="panel-body">

                                    <div class="tab-content">
                                        <div class="content tab-pane fade in Scroll active" id="assin-tab1"
                                             style="min-height: 770px;">
                                            <table class="table">
                                                <tr v-for="task in filtered_tasks">
                                                    <td class="col-1">
                                                        <p>
                                                            @{{ task.start_day }}
                                                            <span>
                                                                    @{{ task.start_month }}
                                                                </span>
                                                        </p></td>
                                                    <td class="col-2"><p>
                                                            @{{task.task_name}}
                                                            at @{{task.client_first_name}}</p>
                                                    </td>
                                                    <td>
                                                        <a target="_blank"
                                                           :href="'{{URL::to('/admin/clients/tasks/')}}/'+task.task_id"><img
                                                                    class="svg Green"
                                                                    src="{{URL::asset('assets/assets/info.svg')}}"
                                                                    alt="info"
                                                                    width="33"
                                                                    height="33"></a>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                        <!--/end tab-pane-->
                                        <!--/end tab-pane-->

                                    </div>
                                    <!--/end tab-content -->
                                </div>
                                <!--/end   panel-body -->


                                <div class="cord-footer">

                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href=" #assin-tab2" @click="setTime('future')"
                                                                  data-toggle="tab">Upcoming</a></li>
                                            <li><a href=" #assin-tab2" @click="setTime('today')"
                                                   data-toggle="tab">Today</a></li>
                                            <li><a href="#assin-tab1" data-toggle="tab"
                                                   @click="setTime('last_week')">Week</a></li>
                                            <li><a href="#assin-tab3" data-toggle="modal"
                                                   data-target="#dashboard-modal">Select Date</a></li>
                                        </ul>
                                    </div>
                                    <!-- end panel-heading -->
                                </div>


                            </div>
                            <!--/end panel-default contener -->

                        </div>
                        <!--/end Card -->
                    </div>
                    <!--/end card-contener -->
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="dashboard-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Dashboard</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Select Date</label>
                            <input type="text" id="date" class="form-control inputdate"
                                   @blur="setCurrentDate($event)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" @click="setCurrentTime($event)" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">


        var data = {
            tasks: {!! json_encode($tasks) !!},
            filtered_tasks: [],
            selected_date: '',
            notifications: [],
            sounds:{!! json_encode($sounds) !!},
            sound_notifications: []
        };

        var dashboard = new Vue({
            data: data,
            el: '#dashboard',
            mounted: function () {
                // var last_week = moment().subtract(1, 'week').format('YYYY MM DD');
                this.filterTasksByFuture(moment('{{$today}}'));
                var notifications = this.tasks.filter(function (task) {
                    return !task.started && task.notification == '1';
                });

                this.notifications = notifications;

                var sounds = this.sounds.filter(function (sound) {
                    return sound.notification == '1'
                });

                this.sound_notifications = sounds;
            },
            methods: {
                setTime: function (time) {
                    switch (time) {
                        case 'today':
                            this.filterTasksByDate(moment('{{$today}}'));
                            break;
                        case 'last_week':
                            var last_week = moment().subtract(1, 'week').format('YYYY MM DD');
                            this.filterTasksByWeek(last_week);
                            break;
                        case 'future':
                            this.filterTasksByFuture(moment('{{$today}}'));
                            break;
                    }
                },
                filterTasksByDate: function (time) {
                    this.filtered_tasks = this.tasks.filter(function (task) {
                        return moment(task.schedule_start_date).isSame(time) && task.schedule_repeat_mode != 'Weekly' && !task.schedule_repeat_mode.includes('_');
                    });
                },
                filterTasksByWeek: function (time) {
                    this.filtered_tasks = this.tasks.filter(function (task) {
                        return moment(task.schedule_start_date).isSameOrAfter(time) && task.schedule_repeat_mode != 'Weekly' && !task.schedule_repeat_mode.includes('_');
                    });
                },
                filterTasksByFuture: function (time) {
                    this.filtered_tasks = this.tasks.filter(function (task) {
                        return moment(task.schedule_start_date).isSameOrAfter(time) && task.schedule_repeat_mode != 'Weekly' && !task.schedule_repeat_mode.includes('_');
                    });
                },
                setCurrentTime: function (event) {
                    this.filterTasksByDate(this.selected_date);
                    $('#dashboard-modal').modal('hide');
                },
                setCurrentDate: function (event) {
                    this.selected_date = event.target.value;
                },
                removeNotification: function (task_id, index) {
                    var $this = this;
                    axios.post('{{URL::to('/clear-notification')}}', {
                        _token: '{{csrf_token()}}',
                        task_id: task_id
                    })
                        .then(function (response) {
                            $this.notifications.splice(index, 1);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },

                removeSound: function (audio_id, index) {
                    var $this = this;
                    axios.post('{{URL::to('/clear-sound')}}', {
                        _token: '{{csrf_token()}}',
                        audio_id: audio_id
                    })
                        .then(function (response) {
                            $this.sound_notifications.splice(index, 1);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        });
    </script>
@endsection