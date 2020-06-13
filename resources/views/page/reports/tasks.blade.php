@extends('layouts.common')

@section('content')
    @include('layouts.headers.reports')

    <section class="page-content dashbord" id="store">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Tasks</h3>
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

                    <div class="card">
                        <div class="title">
                            <h4 class="text-left">Tasks Report</h4>
                        </div>


                        <div class="content" style="overflow:visible;min-height:1150px;">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="from_date">From Date:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <input type="text" class="form-control inputdate" id="from_date"
                                               v-model="from_date" @blur="setFromValue($event)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="to_date">To Date:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <input type="text" class="form-control inputdate" id="to_date"
                                               v-model="to_date" @blur="setToValue($event)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="cleaner">Cleaner:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="cleaner"
                                                v-model="cleaner" @change="setCleaner($event)">
                                            <option value="">Select a cleaner</option>
                                            @foreach($cleaners as $cleaner)
                                                <option value="{{$cleaner->id}}">{{$cleaner->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="client">Client:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="client"
                                                v-model="client" @change="setClient($event)">
                                            <option value="">Select a client</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="inspector">Inspector:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="inspector"
                                                v-model="inspector" @change="setInspector($event)">
                                            <option value="">Select a inspector</option>
                                            @foreach($inspectors as $inspector)
                                                <option value="{{$inspector->id}}">{{$inspector->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="inspector">Status:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="inspector"
                                                v-model="status" @change="setStatus($event)">
                                            <option value="">All</option>
                                            <option value="COMPLETED">COMPLETED</option>
                                            <option value="INCOMPLETE">INCOMPLETE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"
                                 style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px;">
                                <div class="form-group">
                                    <div class="col-sm-12">

                                        <div class="Preview Scroll">

                                            <div class="page">
                                                <table class="table table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Client</th>
                                                        <th>Cleaner</th>
                                                        <th>Inspector</th>
                                                        <th>Task Name</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Task Items</th>
                                                        <th>Repeat</th>
                                                        <th>Repeat Time</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="client in clients">
                                                        <td>@{{client.client_name}}</td>
                                                        <td>@{{client.cleaner_first_name}} @{{client.cleaner_last_name}}
                                                            @{{ client.cleaner_number }}
                                                        <td>@{{client.inspector_first_name}}
                                                            @{{client.inspector_last_name}} @{{ client.inspector_number
                                                            }}
                                                        </td>
                                                        <td>@{{client.task_name}}</td>
                                                        <td>@{{client.start_time}}</td>
                                                        <td>@{{client.end_time}}</td>
                                                        <td v-html="client.task_items"></td>
                                                        <td>
                                                            <span v-if="client.task_repeat=='1'">Yes</span>
                                                            <span v-if="client.task_repeat=='0'">No</span>
                                                        </td>
                                                        <td>@{{ client.repeat_mode }}</td>
                                                        <td>
                                                            <label for="" class="label label-success"
                                                                   v-if="client.task_status=='COMPLETED'">@{{
                                                                client.task_status }}</label>
                                                            <label for="" class="label label-danger"
                                                                   v-if="client.task_status=='INCOMPLETE'">@{{
                                                                client.task_status }}</label>
                                                        </td>
                                                        <td><a v-if="client.images.length>0" href="#"
                                                               @click.prevent="showImage(client.task_id)"
                                                               class="btn btn-sm btn-primary">
                                                                Image</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                <a :href="download" target="_blank" type="submit"
                                   class="btn btn-default save">Download as Excel</a>
                            </div>

                        </div>
                        <!--/end tab-pane-->


                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
            </div>
        </div>
        <div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Image</h4>
                    </div>
                    <div class="modal-body">
                        <img v-for="image in images" :src="image.path" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">


        var data = {
            from_date: moment().subtract(1, 'month').format('YYYY-MM-DD'),
            to_date: moment().format('YYYY-MM-DD'),
            clients: [],
            client: '',
            inspector: '',
            cleaner: '',
            download: '',
            cleaners: {!! json_encode($cleaners) !!},
            cleaner_data: [],
            images: [],
            status: '',
            tasks: [],
        };

        var store = new Vue({
            data: data,
            el: '#store',
            mounted: function () {
                this.filterValues();
                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#cleaner').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.cleaner = this.value;
                        vm.$emit('input', this.value);
                        vm.filterValues();
                    });
                    jQuery('#inspector').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.inspector = this.value;
                        vm.$emit('input', this.value);
                        vm.filterValues();
                    });
                    jQuery('#client').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.client = this.value;
                        vm.$emit('input', this.value);
                        vm.filterValues();
                    });
                });
            },
            methods: {
                setFromValue: function (event) {
                    this.from_date = event.target.value;
                    this.filterValues();
                },
                setToValue: function (event) {
                    this.to_date = event.target.value;
                    this.filterValues();
                },
                setCleaner: function (event) {
                    this.cleaner = event.target.value;
                    this.filterValues();
                },
                setClient: function (event) {
                    this.client = event.target.value;
                    this.filterValues();
                },
                setInspector: function (event) {
                    this.inspector = event.target.value;
                    this.filterValues();
                },
                setStatus: function (event) {
                    this.status = event.target.value;
                    var status = this.status;
                    if (status == '') {
                        this.clients = this.tasks;
                    } else {
                        var selected_tasks = this.tasks.filter(function (task) {
                            return task.task_status == status;
                        });

                        this.clients = selected_tasks;
                    }

                },
                filterValues: function () {
                    var from_date = this.from_date;
                    var to_date = this.to_date;
                    var cleaner = this.cleaner;
                    var client = this.client;
                    var inspector = this.inspector;
                    var status = this.status;
                    var base = '{{URL::to('reports/tasks/download')}}';
                    this.download = base + '?from_date=' + from_date + '&to_date=' + to_date + '&cleaner=' + cleaner + '&client=' + client + '&inspector=' + inspector;
                    var $this = this;
                    var result = [];
                    axios.post('{{URL::to('reports/tasks/filter')}}', {
                        from_date: from_date,
                        to_date: to_date,
                        cleaner: cleaner,
                        client: client,
                        inspector: inspector,
                    })
                        .then(function (response) {
                            $this.clients = response.data.clients;
                            $this.tasks = $this.clients;
                            if (status == '') {
                                $this.clients = $this.tasks;
                            } else {
                                var selected_tasks = $this.tasks.filter(function (task) {
                                    return task.task_status == status;
                                });

                                $this.clients = selected_tasks;
                            }
                            return $this.clients;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                showImage: function (id) {
                    var selected_task = this.clients.filter(function (task) {
                        return id == task.task_id;
                    });

                    var image = selected_task[0].images;
                    if (image.length > 0) {
                        this.images = image;
                        $('#image-modal').modal('show');
                    }
                }
            },
        });
    </script>


@endsection