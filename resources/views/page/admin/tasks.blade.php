@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')

    <section class="page-content dashboard" id="tasks_app">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Tasks</h3>
                </div>
                <div class="col-xs-12 col-sm-1">
                </div>
                <div class="col-xs-12 col-sm-7">
                    <div class="second-navbar page">
                        <ul>

                            <li><a href="{{route('admin.category.index')}}">Classes</a></li>
                            <li><a href="{{URL::to('admin/clients')}}">Clients</a></li>
                            <li><a href="{{URL::to('admin/clients/tasks')}}">Tasks</a></li>
                            <li><a href="{{URL::to('admin/clients/allocations')}}">Allocations</a></li>
                            <li><a href="{{URL::to('admin/clients/add-new')}}">Register Client</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card taskoverview">
                        <div class="title">
                            <h4 class="text-left">Task Overview</h4>
                        </div>
                        <div>
                            <div style="padding: 15px;">
                                <div class="form-group" data-select2-id="9">
                                    <label for="cleaner"
                                           class="col-sm-4 control-label">Client:</label>
                                    <div class="col-sm-8">
                                        <select name="client" id="client" class="form-control select2">
                                            <option value="">Select a client</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content Scroll" style="min-height:400px;">
                            <table class="table selectable task-table">
                                <tr>
                                    <th>Task Name</th>
                                    <th>Client</th>
                                    <th>Address</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr v-for="task in selected_tasks" @click="setTask(task.task_id)">
                                    <td class="col-2">@{{task.task_name}}</td>
                                    <td class="col-2">@{{task.client_name}}</td>
                                    <td class="col-3">@{{task.address}}</td>
                                    <td>
                                        <a :href="'{{URL::to('admin/clients/tasks/')}}/'+task.task_id+'/assign'"
                                           class="btn btn-success">Reassign</a>
                                    </td>
                                    <td class="col-5">
                                        <img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}"
                                             alt="info"
                                             width="33"
                                             height="33"></td>
                                </tr>
                            </table>
                        </div>
                        <!--/end tab-pane-->
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card taskdetails">
                        <div class="title">
                            <h4>Task Details</h4>
                        </div>
                        <div class="content Scroll" style="min-height:300px;">
                            <table class="table" id="print">

                                <tr>
                                    <td class="col-1" style="width:30%;">Name:</td>
                                    <td class="col-2">@{{ task.task_name}}</td>
                                </tr>
                                <tr>
                                    <td class="col-1" style="width:30%;">Client:</td>
                                    <td class="col-2">@{{ task.client_name}}</td>
                                </tr>
                                <tr>
                                    <td class="col-1">Address:</td>
                                    <td class="col-2">@{{ task.address}}</td>
                                </tr>
                                <tr>
                                    <td class="col-1">Start Time:</td>
                                    <td class="col-2">@{{ task.start_time}}</td>
                                </tr>
                                <tr>
                                    <td class="col-1">End Time:</td>
                                    <td class="col-2">@{{ task.end_time}}</td>
                                </tr>
                                <tr>
                                    <td class="col-1">Frequency:</td>
                                    <td>
                                        {{--                                        <span v-if="task.repeat=='1'">--}}
                                        @{{ task.repeat_mode }}
                                        {{--                                        </span>--}}
                                        {{--                                        <span v-if="task.repeat=='0'">No Frequency</span>--}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-1">Cleaner:</td>
                                    <td class="col-2">@{{ task.cleaner_first_name}} @{{ task.cleaner_last_name}}</td>
                                </tr>
                                <tr>
                                    <td class="col-1">Inspector:</td>
                                    <td class="col-2">@{{ task.inspector_first_name}} @{{ task.inspector_last_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>Task Items</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="task_item in task.task_items">
                                                <td>@{{ task_item.task_item_name}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>


                            </table>
                        </div>
                        <button style="margin-right: 15px; margin-bottom: 15px;" class="btn btn-primary pull-right"
                                type="button" onclick="PrintElem('print')">Print
                        </button>
                        <!--/end content -->
                    </div>
                </div>
                <!--/end card-contener -->

            </div>
        </div>

    </section>

    <script>
        var data = {
            tasks: {!! json_encode($tasks) !!},
            task: [],
            selected_tasks: []
        };

        var tasks = new Vue({
            el: '#tasks_app',
            data: data,
            mounted: function () {
                this.selected_tasks = this.tasks;
                var vm = this;
                window.addEventListener('load', function (ev) {
                    jQuery('#client').select2({
                        dropdownAutoWidth: true
                    }).on('change', function (event) {
                        vm.$emit('input', this.value);
                        vm.filterTasks(event);
                    });
                });
            },
            methods: {
                setTask: function (task_id) {
                    var filtered_task = this.tasks.filter(function (single_task) {
                        return single_task.task_id == task_id
                    });

                    this.task = filtered_task[0];
                },
                filterTasks: function (event) {
                    var client = event.target.value;

                    var selected_tasks = this.tasks.filter(function (task) {
                        return task.client_id == client;
                    });

                    this.selected_tasks = selected_tasks;
                }
            }
        });


    </script>
@endsection