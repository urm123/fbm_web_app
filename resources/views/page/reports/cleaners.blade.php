@extends('layouts.common')

@section('content')
    @include('layouts.headers.reports')

    <section class="page-content dashbord" id="store">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Cleaner</h3>
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
                            <h4 class="text-left">Cleaner Report</h4>
                        </div>


                        <div class="content" style="overflow:visible;min-height:1150px;">
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

                                    <label class="col-sm-4 control-label" for="absent">Cleaner Absent:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select name="absent" id="absent" @change="setAbsent($event)"
                                                class="form-control">
                                            <option value="">Select cleaner status</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
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
                                                        <th>Cleaner</th>
                                                        <th>Client</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Working Hours</th>
                                                        <th>Status</th>
                                                        <th>Rating</th>
                                                        <th>Incomplete</th>
                                                        <th>Complete</th>
                                                        <th>Details</th>
                                                        <th>Complaints</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="client in clients">
                                                        <td>@{{client.cleaner}}
                                                        <td>@{{client.client}}</td>
                                                        <td>@{{client.cleaner_start_time}}</td>
                                                        <td>@{{client.cleaner_end_time}}</td>
                                                        <td>@{{client.working_hours}} <span
                                                                    v-if="client.absent==true">Absent</span></td>
                                                        <td>@{{ client.deleted }}</td>
                                                        <td>
                                                            <i v-for="index in 10" class="fa fa-star rating-star"
                                                               :class="{'rating-active':index<=client.rating}"></i>
                                                        </td>
                                                        <td>@{{ client.incomplete_count }}</td>
                                                        <td>@{{ client.complete_count }}</td>

                                                        <td>
                                                            <button type="button" class="btn btn-primary"
                                                                    @click="getDetails(client.cleaner_schedule_id)">
                                                                Details
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <button v-if="client.complaints.length>0" type="button"
                                                                    class="btn btn-primary"
                                                                    @click="getComplaints(client.complaints)">
                                                                Complaints
                                                            </button>
                                                        </td>

                                                    </tr>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="4">Total</td>
                                                        <td>@{{total}}</td>
                                                    </tr>
                                                    </tfoot>
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
        <div class="modal fade" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">@{{ single.client }} - @{{ single.cleaner }}</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Task Item</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="task_item in single.task_items">
                                <td>@{{ task_item.name }}</td>
                                <td>
                                    <span v-if="task_item.status==''">INCOMPLETE</span>
                                    <span v-if="task_item.status!=''">FINISHED</span>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr v-for="sound in single.audio">
                                <td colspan="2">
                                    <audio controls
                                           :src="'data:audio/x-m4a;base64,'+sound.audio"/>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="complaints-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Complaints</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Complaint</th>
                                <th>Date</th>
                                <th>Approved By Admin</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="complaint in selected_complaint">
                                <td>@{{ complaint.complaint }}</td>
                                <td>@{{ complaint.date}}</td>
                                <td>
                                    <span v-if="complaint.resolved=='1'">Yes</span>
                                    <span v-if="complaint.resolved=='0'">No</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            total: '',
            client: '',
            cleaner: '',
            absent: '',
            download: '',
            single: [],
            selected_complaint: [],
        };
        var store = new Vue({
            data: data,
            el: '#store',
            mounted: function () {
                this.filterValues();
                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#cleaner').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.$emit('input', this.value);
                        vm.cleaner = this.value;
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
                setAbsent: function (event) {
                    this.absent = event.target.value;
                    this.filterValues();
                },
                filterValues: function () {
                    var from_date = this.from_date;
                    var to_date = this.to_date;
                    var cleaner = this.cleaner;
                    var absent = this.absent;
                    var client = this.client;
                    var base = '{{URL::to('reports/cleaners/download')}}';
                    this.download = base + '?from_date=' + from_date + '&to_date=' + to_date + '&cleaner=' + cleaner + '&client=' + client + '&absent=' + absent;
                    var $this = this;
                    var result = [];
                    axios.post('{{URL::to('reports/cleaners/filter')}}', {
                        from_date: from_date,
                        to_date: to_date,
                        cleaner: cleaner,
                        client: client,
                        absent: absent,
                    })
                        .then(function (response) {
                            $this.clients = response.data.clients;
                            $this.total = response.data.total;
                            return $this.clients;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                getDetails: function (schedule_id) {
                    var selected_client = this.clients.filter(function (client) {
                        return client.cleaner_schedule_id == schedule_id;
                    });

                    this.single = selected_client[0];

                    jQuery('#details-modal').modal('show');
                },
                getComplaints: function (complaint) {
                    this.selected_complaint = complaint;
                    jQuery('#complaints-modal').modal('show');
                }
            }
        });
    </script>

@endsection