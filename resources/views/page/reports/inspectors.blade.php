@extends('layouts.common')

@section('content')
    @include('layouts.headers.reports')

    <section class="page-content dashbord" id="store">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Inspector</h3>
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
                            <h4 class="text-left">Inspector Report</h4>
                        </div>


                        <div class="content" style="overflow:visible;min-height:1150px;">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="inspector">Inspector:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="inspector"
                                                v-model="inspector" @change="setinspector($event)">
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

                                    <label class="col-sm-4 control-label" for="absent">Inspector Absent:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select name="absent" id="absent" @change="setAbsent($event)"
                                                class="form-control">
                                            <option value="">Select inspector status</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="inspectorLevel">Inspector Level:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select name="inspectorLevel" id="inspectorLevel"
                                                @change="setInspectorLevel($event)"
                                                class="form-control">
                                            <option value="">Select inspector level</option>
                                            <option value="INSPECTOR_1">Inspector 1</option>
                                            <option value="INSPECTOR_2">Inspector 2</option>
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
                                                        <th>inspector</th>
                                                        <th>Client</th>
                                                        <th>Level</th>
                                                        <th>Inspection Time</th>
                                                        <th>Inspection Duration</th>
                                                        <th>Rating</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="client in clients">
                                                        <td>@{{client.inspector}}
                                                        </td>
                                                        <td>@{{client.client}}</td>
                                                        <td>
                                                            <span v-if="client.level=='INSPECTOR_2'">Inspector 2</span>
                                                            <span v-if="client.level=='INSPECTOR_1'">Inspector 1</span>
                                                        </td>
                                                        <td>@{{ client.inspector_feedback.last_date }}
                                                        <td>@{{client.working_hours}} <span
                                                                    v-if="client.absent==true">Absent</span></td>
                                                        <td>
                                                            <i v-for="index in 10" class="fa fa-star rating-star"
                                                               :class="{'rating-active':index<=client.inspector_feedback.feedback}"></i>
                                                        </td>
                                                        <td>@{{ client.deleted }}</td>
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
    </section>

    <script type="text/javascript">

        var data = {
            from_date: moment().subtract(1, 'month').format('YYYY-MM-DD'),
            to_date: moment().format('YYYY-MM-DD'),
            clients: [],
            client: '',
            inspector: '',
            download: '',
            absent: '',
            inspectorLevel: ''
        };
        var store = new Vue({
            data: data,
            el: '#store',
            mounted: function () {
                this.filterValues();
                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#client').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.client = this.value;
                        vm.$emit('input', this.value);
                        vm.filterValues();
                    });
                    jQuery('#inspector').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.inspector = this.value;
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
                setinspector: function (event) {
                    this.inspector = event.target.value;
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
                setInspectorLevel: function (event) {
                    this.inspectorLevel = event.target.value;
                    this.filterValues();
                },
                filterValues: function () {
                    var from_date = this.from_date;
                    var to_date = this.to_date;
                    var inspector = this.inspector;
                    var absent = this.absent;
                    var client = this.client;
                    var inspectorLevel = this.inspectorLevel;
                    var base = '{{URL::to('reports/inspectors/download')}}';
                    this.download = base + '?from_date=' + from_date + '&to_date=' + to_date + '&inspector=' + inspector + '&client=' + client + '&absent=' + absent + '&inspectorLevel=' + inspectorLevel;
                    var $this = this;
                    var result = [];
                    axios.post('{{URL::to('reports/inspectors/filter')}}', {
                        from_date: from_date,
                        to_date: to_date,
                        inspector: inspector,
                        client: client,
                        absent: absent,
                        inspectorLevel: inspectorLevel,
                    })
                        .then(function (response) {
                            $this.clients = response.data.clients;
                            return $this.clients;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        });
    </script>

@endsection