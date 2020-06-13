@extends('layouts.common')

@section('content')
    @include('layouts.headers.complaints')
    <!-- Page Content -->
    <section class="page-content dashbord" id="complaints">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
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

                    <div class="card form-card ">
                        <div class="title">
                            <h4 class="text-left">New Complaint</h4>
                            <h4 class="text-right goBack" style="float:right;"><a href="{{URL::to('/complaints')}}">
                                    Complaints
                                    Overview</a></h4>
                        </div>


                        <div class="content" style="overflow:visible;min-height:450px;">

                            <form id="create-new-cleaner" method="post" class="form-horizontal"
                                  enctype="multipart/form-data"
                                  action="{{URL::to('/complaints/post-add-new')}}" @submit.prevent="submitForm($event)">
                                {{csrf_field()}}
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group" :class="{'has-error':validation.client}">
                                        <label class="col-sm-4 control-label" for="client">Client</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" id="client" name="client"
                                                    @change="setClient(0,$event)">
                                                <option value="">Select a client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block" v-if="validation.client">
                                        <strong>@{{validation.client[0]}}</strong>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="form-group" :class="{'has-error':validation.complaint}">
                                        <label class="col-sm-4 control-label" for="complaint">Description</label>
                                        <div class="col-sm-8">
{{--                                            <input type="text" class="form-control" id="complaint" name="complaint" value="{{old('complaint')}}">--}}
                                            <textarea rows="5" class="form-control" id="complaint" name="complaint">{{old('complaint')}}</textarea>
                                            <span class="help-block" v-if="validation.complaint">
                                        <strong>@{{validation.complaint[0]}}</strong>
                                    </span>
                                        </div>
                                    </div>
                                    {{--<div class="form-group" :class="{'has-error':validation.start_date}">--}}
                                    {{--<label class="col-sm-4 control-label" for="complaint">Start Date</label>--}}
                                    {{--<div class="col-sm-8">--}}
                                    {{--<input type="text" class="form-control inputdate" id="start_date"--}}
                                    {{--name="start_date"--}}
                                    {{--value="{{old('start_date')}}">--}}
                                    {{--<span class="help-block" v-if="validation.start_date">--}}
                                    {{--<strong>@{{validation.start_date[0]}}</strong>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group" :class="{'has-error':validation.end_date}">--}}
                                    {{--<label class="col-sm-4 control-label" for="end_date">End Date</label>--}}
                                    {{--<div class="col-sm-8">--}}
                                    {{--<input type="text" class="form-control inputdate" id="end_date"--}}
                                    {{--name="end_date"--}}
                                    {{--value="{{old('end_date')}}">--}}
                                    {{--<span class="help-block" v-if="validation.end_date">--}}
                                    {{--<strong>@{{validation.end_date[0]}}</strong>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="form-group" :class="{'has-error':validation.date}">
                                        <label class="col-sm-4 control-label" for="date">Complaint Date</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inputdate" id="date"
                                                   name="date"
                                                   value="{{old('date')}}">
                                            <span class="help-block" v-if="validation.date">
                                        <strong>@{{validation.date[0]}}</strong>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group" :class="{'has-error':validation.task}">
                                        <label class="col-sm-4 control-label" for="task">Task</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="task" name="task"
                                                    :disabled="!tasks_loaded">
                                                <option value="">Select a task</option>
                                                <option v-for="task in tasks" :value="task.id">@{{ task.name }} -
                                                    Reference: @{{ task.id }}
                                                </option>
                                            </select>
                                            <span class="help-block" v-if="validation.task">
                                        <strong>@{{validation.task[0]}}</strong>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="upload">Upload Images</label>
                                        <div class="col-sm-8">
                                            <div class="input-group col-xs-12" v-for="(index, image) in images">
                                                <div class="col-sm-11" style="padding: 0;">
                                                    <input type="file" class="form-control"
                                                           style="margin-bottom: 15px;"
                                                           id="upload" name="uploads[]">
                                                </div>
                                                <div class="col-sm-1" style="padding: 0;">
                                                    <a href="#" class="btn btn-danger btn-sm pull-right"
                                                       style="color: rgb(255, 255, 255);"
                                                       @click.prevent="removeImage(index)">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-success pull-right"
                                                style="margin-right: 15px; margin-top: 15px;" type="button"
                                                @click.prevent="addImage">Add image
                                        </button>
                                    </div>
                                    {{--<div class="form-group" :class="{'has-error':validation.start_time}">--}}
                                    {{--<label class="col-sm-4 control-label" for="start_time">Start Time</label>--}}
                                    {{--<div class="col-sm-8">--}}
                                    {{--<input type="text" class="form-control inputtime" id="start_time"--}}
                                    {{--name="start_time"--}}
                                    {{--value="{{old('start_time')}}">--}}
                                    {{--<span class="help-block" v-if="validation.start_time">--}}
                                    {{--<strong>@{{validation.start_time[0]}}</strong>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group" :class="{'has-error':validation.end_time}">--}}
                                    {{--<label class="col-sm-4 control-label" for="end_time">End Time</label>--}}
                                    {{--<div class="col-sm-8">--}}
                                    {{--<input type="text" class="form-control inputtime" id="end_time"--}}
                                    {{--name="end_time"--}}
                                    {{--value="{{old('end_time')}}">--}}
                                    {{--<span class="help-block" v-if="validation.end_time">--}}
                                    {{--<strong>@{{validation.end_time[0]}}</strong>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <button type="submit" class="btn btn-default save">Save</button>
                                    <button type="reset" class="btn btn-default clear">Cancel</button>
                                </div>
                            </form>
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
            tasks_loaded: false,
            tasks: [],
            validation: [
                {client: []},
                {task: []},
                // {start_date: []},
                // {end_date: []},
                // {start_time: []},
                // {end_time: []},
                {description: []},
                {date: []},
            ],
            images: [{name: ''}]
        };
        var complaints = new Vue({
            data: data,
            el: '#complaints',
            mounted: function () {
                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#cleaner').select2({dropdownAutoWidth: true});
                    jQuery('#inspector').select2({dropdownAutoWidth: true});
                    jQuery('#client').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.$emit('input', this.value);
                        vm.setClient('0', event);
                    });
                });
            },
            methods: {
                setClient: function (variable, event) {
                    var client_id = event.target.value;
                    var $this = this;
                    axios.post('{{URL::to('/admin/clients/ajax-get-tasks')}}', {
                        _token: '{{csrf_token()}}',
                        client_id: client_id
                    })
                        .then(function (response) {
                            $this.tasks = response.data.tasks;
                            $this.tasks_loaded = true;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                submitForm: function (event) {
                    var elements = event.target.elements;

                    this.validation = [
                        {client: []},
                        {task: []},
                        // {start_date: []},
                        // {end_date: []},
                        // {start_time: []},
                        // {end_time: []},
                        {description: []},
                        {date: []},
                    ];

                    var $this = this;

                    var form_elements = {};

                    for (var i = 0; i < elements.length; i++) {
                        form_elements[elements[i].getAttribute('name')] = elements[i].value;
                    }


                    axios.post('{{URL::to('/complaints/post-complaint-validation')}}', form_elements)
                        .then(function (response) {
                            if (response.data.message == 'Failed') {
                                $this.validation = response.data.validation;
                            } else if (response.data.message == 'Success') {
                                event.target.submit();
                            } else {
                                console.log(response);
                            }
                        })
                        .catch(function (error) {
                            if (error.response) {
                                var errors = error.response.data.errors;
                                console.log(errors);
                            }
                        });
                },
                addImage: function () {
                    this.images.push({name: ''});
                },
                removeImage: function (index) {
                    this.images.splice(index, 1);
                }
            }
        });
    </script>
@endsection