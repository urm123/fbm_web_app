@extends('layouts.common')

@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="allocations">
        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                    <ol class="breadcrumb" style="background: #fff;">
                        <?php echo $breadcrumb; ?>
                    </ol>
                </div> 
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                </div>
                <div class="col-xs-12 col-sm-1">
                </div>
                <div class="col-xs-12 col-sm-7">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{route('admin.category.index')}}">Classes</a></li>
                            <li><a href="{{URL::to('admin/clients/allocations')}}">Allocations</a></li>
                            <li><a href="{{URL::to('admin/clients')}}">Clients</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- /end Page header  -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card form-card">
                        <div class="row title">
                            <div class="col-md-2">
                                <h4 class="text-left">Task Allocation</h4>
                            </div>
                            <div class="col-md-7">
                                <div class="panel-heading" style="margin-left: -30px;">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a @click="setRepeat(false)" href="#notifi-tab1"
                                                              data-toggle="tab">One Time</a></li>
                                        <li><a @click="setRepeat(true)" href="#notifi-tab2"
                                               data-toggle="tab">Continuous</a></li>
                                    </ul>
                                </div>
                                <!-- end panel-heading -->
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div>
                                    <div class="content" id="notifi-tab1" style="overflow:visible;min-height:450px;">
                                        <form id="create-new-cleaner" method="post" class="form-horizontal"
                                              action="{{URL::to('/admin/clients/post-allocate-tasks')}}" @submit.prevent="submitForm($event)">
                                            {{csrf_field()}}
                                            <input type="hidden" v-model="repeat" name="repeat">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group" :class="{'has-error':validation.client}">
                                                    <label class="col-sm-4 control-label" for="client">Client</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control selectpicker" id="client"
                                                                name="client" @change="setClientLocation($event)">
                                                            <option value="">Select a client</option>
                                                            <option v-for="client in clients" :value="client.id">@{{
                                                                client.name }}
                                                            </option>
                                                        </select>
                                                        <span class="help-block" v-if="validation.client">
                                                            <strong>@{{ validation.client[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':validation.name}">
                                                    <label class="col-sm-4 control-label" for="name">Task Name</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control"
                                                                id="name" name="name"
                                                                value="{{old('name')}}">
                                                        </select>
                                                        <span class="help-block" v-if="validation.name">
                                                            <strong>@{{ validation.name[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':validation.start_date}">
                                                    <label class="col-sm-4 control-label" for="start_date">Start
                                                        Date</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control inputdate"
                                                               id="start_date" name="start_date"
                                                               value="{{old('start_date')}}">
                                                        <span class="help-block" v-if="validation.start_date">
                                                            <strong>@{{ validation.start_date[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div v-if="!repeat"
                                                     class="form-group">
                                                    <label class="col-sm-4 control-label" for="end_date">End
                                                        Date</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control inputdate"
                                                               id="end_date" name="end_date"
                                                               value="{{old('end_date')}}">
                                                    </div>
                                                </div>
                                                {{--<div class="form-group">--}}
                                                {{--<label class="col-sm-4 control-label" for="type">Task--}}
                                                {{--Type</label>--}}
                                                {{--<div class="col-sm-8">--}}
                                                {{--<input type="text" class="form-control" id="type" name="type"--}}
                                                {{--value="{{old('type')}}">--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="form-group"
                                                     :class="{'has-error':validation['cleaner.0']}">
                                                    <label class="col-sm-4 control-label" for="cleaner">Cleaner</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control selectpicker" id="cleaner"
                                                                name="cleaner[]">
                                                            <option value="">Select a cleaner</option>
                                                            @foreach($cleaners as $cleaner)
                                                                <option value="{{$cleaner->id}}">{{$cleaner->first_name}} {{$cleaner->last_name}}
                                                                    ({{$cleaner->pan_number}})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="help-block" v-if="validation['cleaner.0']">
                                                            <strong>@{{ validation['cleaner.0'][0] }}</strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a href="#" @click="addCleaner($event)"
                                                           class="btn btn-success"><i class="fa fa-plus">
                                                            </i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div v-for="(cleaner_field,index) in cleaner_array"
                                                     class="form-group"
                                                     :class="{'has-error':validation['cleaner.'+addOneToIndex(index)]}">
                                                    <label class="col-sm-4 control-label"
                                                           for="cleaner">&nbsp;</label>
                                                    <div class="col-sm-6">
                                                        <i class="fa fa-spinner fa fa-spin"></i>
                                                        <select class="form-control selectpicker add-cleaner"
                                                                name="cleaner[]" v-model="cleaner_field.value"
                                                                :id="'cleaner-'+cleaner_field.id">
                                                            <option value="">Select an cleaner</option>
                                                            <option v-for="cleaner in cleaners"
                                                                    :value="cleaner.id">@{{cleaner.first_name}}
                                                                @{{cleaner.last_name}}
                                                                (@{{cleaner.pan_number}})
                                                            </option>
                                                        </select>
                                                        <span class="help-block" v-if="validation['cleaner.'+addOneToIndex(index)]">
                                                            <strong>@{{ validation['cleaner.'+addOneToIndex(index)][0] }}</strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a href="#" @click="removeCleaner(index, $event)"
                                                           class="btn btn-danger"><i class="fa fa-close">
                                                            </i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group"
                                                     :class="{'has-error':validation.address}">
                                                    <label class="col-sm-4 control-label" for="address">Location
                                                        Address</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                               id="address" name="address"
                                                               v-model="address">
                                                        <span class="help-block" v-if="validation.address">
                                                            <strong>@{{ validation.address[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div v-if="repeat" class="form-group" :class="{'has-error':validation.repeat_mode}">
                                                    <label class="col-sm-4 control-label" for="repeat_mode">Frequency</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="repeat_mode"
                                                                name="repeat_mode" :disabled="!repeat" @change.prevent="setWeekdays($event)"
                                                                :class="{'select-days':weekdays_trigger}">
                                                            <option value="">Select a frequency to repeated tasks
                                                            </option>
                                                            <option value="weekdays">Select Days</option>
                                                            <option value="weekly">Weekly</option>
                                                            <option value="monthly">Monthly</option>
                                                            <option value="semiannually">Semiannually</option>
                                                            <option value="annually">Annually</option>
                                                        </select>
                                                        <button type="button" class="btn btn-success pull-left"
                                                                v-if="weekdays_trigger" @click.prevent="clickWeekdays($event)">Change Days
                                                        </button>
                                                        <input type="hidden" name="weekdays" v-model="weekdays">
                                                        <span class="help-block" v-if="validation.repeat_mode">
                                                            <strong>@{{ validation.repeat_mode[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div v-if="!repeat"
                                                     class="form-group">
                                                    <label class="col-sm-4 control-label"
                                                           for="repeat_mode">Frequency</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="repeat_mode"
                                                                name="repeat_mode"
                                                                :disabled="repeat">
                                                            <option value="">Select a frequency to repeated tasks
                                                            </option>
                                                            <option value="3 months">3 months</option>
                                                            <option value="6 months">6 months</option>
                                                            <option value="1 year">1 year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':validation.start_time}">
                                                    <label class="col-sm-4 control-label" for="start_time">Start
                                                        Time</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control inputtime"
                                                               id="start_time" name="start_time" value="{{old('start_time')}}">
                                                        <span class="help-block" v-if="validation.start_time">
                                                            <strong>@{{ validation.start_time[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="end_time">End Time</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control inputtime" id="end_time" name="end_time"
                                                               value="{{old('end_time')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group" :class="{'has-error':validation['inspector.0']}">
                                                    <label class="col-sm-4 control-label" for="inspector">Inspector</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control selectpicker" id="inspector" name="inspector[]">
                                                            <option value="">Select an inspector</option>
                                                            <option v-for="inspector in inspectors" :value="inspector.id">
                                                                @{{inspector.first_name}} @{{inspector.last_name}} (@{{inspector.pan_number}})
                                                            </option>
                                                        </select>
                                                        <span class="help-block" v-if="validation['inspector.0']">
                                                            <strong>@{{ validation['inspector.0'][0] }}</strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a href="#" @click="addInspector($event)" class="btn btn-success">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div v-for="(inspector_field,index) in inspector_array"
                                                     class="form-group" :class="{'has-error':validation['inspector.'+addOneToIndex(index)]}">
                                                    <label class="col-sm-4 control-label" for="inspector">&nbsp;</label>
                                                    <div class="col-sm-6">
                                                        <i class="fa fa-spinner fa fa-spin"></i>
                                                        <select class="form-control selectpicker add-inspector" name="inspector[]"
                                                                :id="'inspector-'+inspector_field.id" v-model="inspector_field.value">
                                                            <option value="">Select an inspector</option>
                                                            <option v-for="inspector in inspectors" :value="inspector.id">@{{inspector.first_name}}
                                                                @{{inspector.last_name}}
                                                                (@{{inspector.pan_number}})
                                                            </option>
                                                        </select>
                                                        <span class="help-block" v-if="validation['inspector.'+addOneToIndex(index)]">
                                                            <strong>@{{ validation['inspector.'+addOneToIndex(index)][0] }}</strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a href="#" @click="removeInspector(index, $event)" class="btn btn-danger"><i class="fa fa-close"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <div class="col-xs-12">--}}
{{--                                                <table class="table table-responsive">--}}
{{--                                                    <thead>--}}
{{--                                                    <tr>--}}
{{--                                                        <th></th>--}}
{{--                                                        <th></th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <tbody>--}}
{{--                                                    <tr v-for="(task_item, element) in task_items">--}}
{{--                                                        <td style="width:75%;">--}}
{{--                                                            <input type="text" class="form-control grid-input" name="task_items[]" v-model="task_item.name">--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            <button type="button" class="btn btn-danger" @click="removeTaskItem(element)" style="font-size: 18px; line-height: 0; padding: 0 11px;">--}}
{{--                                                                <i class="ion-ios-close-empty ion"></i> Remove task item--}}
{{--                                                            </button>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    </tbody>--}}
{{--                                                    <tfoot>--}}
{{--                                                    <tr>--}}
{{--                                                        <td style="width:75%;">&nbsp;</td>--}}
{{--                                                        <td>--}}
{{--                                                            <button type="button" class="btn btn-success" @click="addTaskItem" style="font-size: 18px; line-height: 0; padding: 0 9px;">--}}
{{--                                                                <i class="ion ion-ios-plus-empty"></i> Add task item--}}
{{--                                                            </button>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    </tfoot>--}}
{{--                                                </table>--}}
{{--                                                <span class="help-block" v-if="validation.task_items">--}}
{{--                                                    <strong>@{{ validation.task_items[0] }}</strong>--}}
{{--                                                </span>--}}
{{--                                            </div>--}}
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                <button type="submit" id="button" name="button"
                                                        class="btn btn-default save">Save & Continue
                                                </button>
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
        <!-- Modal -->
        <div class="modal fade" id="weekdays-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Set Weekdays</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group" v-for="day in days">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" v-model="day.value" value="true"> @{{ day.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click.prevent="setDays">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        var data = {
            repeat: false,
            task_items: [],
            tasks: {!! json_encode(old('task_items')) !!},
            tasks_loaded: false,
            address: '{{old('address')}}',
            inspectors:{!! json_encode($inspectors) !!},
            cleaners:{!! json_encode($cleaners) !!},
            inspector_array: [],
            cleaner_array: [],
            validation: [
                {client: []},
                {name: []},
                {start_date: []},
                {start_time: []},
                {address: []},
                {task_items: []},
                {inspector: []},
                {cleaner: []},
                {repeat_mode: []},
            ],
            all_clients: {!! json_encode($clients) !!},
            clients: [],
            weekdays: '',
            days: [
                {value: false, name: 'Sunday'},
                {value: false, name: 'Monday'},
                {value: false, name: 'Tuesday'},
                {value: false, name: 'Wednesday'},
                {value: false, name: 'Thursday'},
                {value: false, name: 'Friday'},
                {value: false, name: 'Saturday'},
            ],
            options: [],
            one_time_options: {!! json_encode($single_task_options) !!},
            repeat_options: {!! json_encode($repeat_task_options) !!},
            weekdays_trigger: false
        };
        var allocations = new Vue({
            el: '#allocations',
            data: data,
            mounted: function () {

                var selected_clients = this.all_clients;

                this.clients = selected_clients;

                this.options = this.one_time_options;

                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#cleaner').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.$emit('input', this.value);
                    });
                    jQuery('#inspector').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.$emit('input', this.value);
                    });

                    jQuery('#name').select2({
                        dropdownAutoWidth: true,
                        data: vm.options,
                        tags: true
                    }).on('change', function (event) {
                        vm.$emit('input', this.value);
                    });

                    jQuery('#client').select2({
                        dropdownAutoWidth: true,
                        data: vm.clients
                    }).on('change', function (event) {
                        vm.$emit('input', this.value);
                        vm.setClientLocation(event);
                    });
                });

            },
            methods: {
                setRepeat: function (value) {
                    if (value) {
                        var selected_clients = this.all_clients.filter(function (client) {
                            return client.continuous == 1;
                        });
                        this.options = this.repeat_options;
                    } else {
                        var selected_clients = this.all_clients;
                        this.options = this.one_time_options;
                    }

                    this.clients = selected_clients;

                    jQuery('#client').empty().trigger('change');

                    jQuery('#name').empty().trigger('change');

                    this.clients.forEach(function (client) {
                        var newOption = new Option(client.name, client.id, false, false);
                        jQuery('#client').append(newOption).trigger('change');
                    });

                    this.options.forEach(function (option) {
                        var newOption = new Option(option.text, option.id, false, false);
                        jQuery('#name').append(newOption).trigger('change');
                    });

                    this.repeat = value;
                    this.validation = [
                        {client: []},
                        {name: []},
                        {start_date: []},
                        {start_time: []},
                        {address: []},
                        {task_items: []},
                        {inspector: []},
                        {cleaner: []},
                        {repeat_mode: []},
                    ]
                },
                addTaskItem: function () {
                    this.task_items.push({name: ''})
                },
                removeTaskItem: function (element) {
                    this.task_items.splice(element, 1);
                },
                setClientLocation: function (event) {
                    var client = event.target.value;
                    var $this = this;
                    axios.post('{{URL::to('/admin/clients/ajax-get-client-location')}}', {
                        _token: '{{csrf_token()}}',
                        client_id: client
                    })
                        .then(function (response) {
                            var location = response.data.location;
                            $this.address = location.street_number + ', ' + location.street_name + ', ' + location.city + ', ' + location.post_code;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                submitForm: function (event) {

                    jQuery('#button').attr('disabled', 'disabled');

                    var elements = event.target.elements;

                    this.validation = [
                        {client: []},
                        {name: []},
                        {start_date: []},
                        {start_time: []},
                        {address: []},
                        {task_items: []},
                        {inspector: []},
                        {cleaner: []},
                        {repeat_mode: []},
                    ];
                    var $this = this;

                    var form_elements = {};
                    for (var i = 0; i < elements.length; i++) {
                        form_elements[elements[i].getAttribute('name')] = elements[i].value;
                        if (elements[i].getAttribute('name') == 'task_items[]') {
                            var task_items_array = [];
                            $this.task_items.forEach(function (task_item) {
                                task_items_array.push(task_item.name);
                            });
                            form_elements['task_items'] = task_items_array;
                        }

                        if (elements[i].getAttribute('name') == 'cleaner[]') {
                            var cleaner_collection = [];
                            cleaner_collection.push(jQuery('#cleaner').val());
                            $this.cleaner_array.forEach(function (cleaner) {
                                cleaner_collection.push(cleaner.value);
                            });
                            form_elements['cleaner'] = cleaner_collection;
                        }

                        if (elements[i].getAttribute('name') == 'inspector[]') {
                            var inspector_collection = [];
                            inspector_collection.push(jQuery('#inspector').val());
                            $this.inspector_array.forEach(function (inspector) {
                                inspector_collection.push(inspector.value);
                            });
                            form_elements['inspector'] = inspector_collection;
                        }
                    }

                    axios.post('{{URL::to('/admin/clients/post-allocate-validation')}}', form_elements)
                        .then(function (response) {
                            console.log(response);
                            if (response.data.message == 'Failed') {
                                $this.validation = response.data.validation;

                                jQuery('#button').removeAttr('disabled');
                            } else if (response.data.message == 'Task Items') {
                                $this.validation = {
                                    client: [],
                                    name: [],
                                    start_date: [],
                                    start_time: [],
                                    address: [],
                                    //task_items: ['Task items cannot be empty.'],
                                    inspector: [],
                                    cleaner: [],
                                    repeat_mode: [],
                                };
                                jQuery('#button').removeAttr('disabled');
                            } else if (response.data.message == 'cleaner') {
                                $this.validation = {
                                    client: [],
                                    name: [],
                                    start_date: [],
                                    start_time: [],
                                    address: [],
                                    task_items: [],
                                    inspector: [],
                                    cleaner: ['Cleaners cannot be empty. Please add at least one cleaner.'],
                                    repeat_mode: [],
                                };
                                jQuery('#button').removeAttr('disabled');
                            } else if (response.data.message == 'inspector') {
                                $this.validation = {
                                    client: [],
                                    name: [],
                                    start_date: [],
                                    start_time: [],
                                    address: [],
                                    task_items: [],
                                    inspector: ['Inspectors cannot be empty. Please add at least one inspector.'],
                                    cleaner: [],
                                    repeat_mode: [],
                                };
                                jQuery('#button').removeAttr('disabled');
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
                setWeekdays: function (event) {
                    var mode = event.target.value;
                    if (mode == 'weekdays') {
                        jQuery('#weekdays-modal').modal('show');
                        this.weekdays_trigger = true;
                    } else {
                        this.weekdays_trigger = false;
                    }
                },
                setDays: function () {
                    this.weekdays = JSON.stringify(this.days);
                    jQuery('#weekdays-modal').modal('hide');
                },
                addInspector: function (event) {
                    event.preventDefault();
                    var vm = this;
                    var id = new Date().getTime();
                    this.inspector_array.push({id: id, value: ''});
                    setTimeout(function () {
                        jQuery('.fa-spin').remove();
                        jQuery('#inspector-' + id).select2({dropdownAutoWidth: true}).on('change', function (event) {
                            vm.$emit('input', this.value);
                            vm.setInspector(event, id);
                        });
                    }, 1000);
                },
                removeInspector: function (index, event) {
                    event.preventDefault();
                    this.inspector_array.splice(index, 1);
                },
                addCleaner: function (event) {
                    event.preventDefault();
                    var vm = this;
                    var id = new Date().getTime();
                    this.cleaner_array.push({id: id, value: ''});
                    setTimeout(function () {
                        jQuery('.fa-spin').remove();
                        jQuery('#cleaner-' + id).select2({dropdownAutoWidth: true}).on('change', function (event) {
                            vm.$emit('input', this.value);
                            vm.setCleaner(event, id);
                        });
                    }, 1000);
                },
                removeCleaner: function (index, event) {
                    event.preventDefault();
                    this.cleaner_array.splice(index, 1);
                },
                setInspector: function (event, id) {
                    var selected_inspector = this.inspector_array.filter(function (inspector) {
                        return inspector.id === id;
                    });

                    selected_inspector[0].value = event.target.value;
                },
                setCleaner: function (event, id) {
                    var selected_cleaner = this.cleaner_array.filter(function (cleaner) {
                        return cleaner.id === id;
                    });

                    selected_cleaner[0].value = event.target.value;
                },
                addOneToIndex: function (index) {
                    return index + 1;
                },
                clickWeekdays: function () {
                    jQuery('#weekdays-modal').modal('show');
                }
            },
        });
    </script>
@endsection