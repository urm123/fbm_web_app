@extends('layouts.common')

@section('content')
    @include('layouts.headers.reports')

    <section class="page-content dashbord" id="store">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Store</h3>
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
                            <h4 class="text-left">Followup Report</h4>
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

                                    <label class="col-sm-4 control-label" for="admin">Admin:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="admin"
                                                v-model="admin" @change="setAdmin($event)">
                                            <option value="">Select a admin</option>
                                            @foreach($admins as $admin)
                                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                                            @endforeach
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
                                                        <th>Followup</th>
                                                        <th>Type</th>
                                                        <th>Followup Admin</th>
                                                        <th>Followup Date</th>
                                                        <th>Comment</th>
                                                        <th>Commented Admin</th>
                                                        <th>Commented Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="followup in followups">
                                                        <td>@{{followup.client}}</td>
                                                        <td>@{{followup.comment}}
                                                        </td>
                                                        <td>@{{followup.type}}</td>
                                                        <td>@{{followup.followup_admin}}</td>
                                                        <td>@{{followup.date}}</td>
                                                        <td>@{{followup.feedback_comment}}</td>
                                                        <td>@{{followup.comment_admin}}</td>
                                                        <td>@{{followup.comment_date}}</td>
                                                        <td>
                                                            <label v-if="followup.status=='OPEN'"
                                                                   class="label label-warning">@{{followup.status}}</label>
                                                            <label v-if="followup.status=='ENDED'"
                                                                   class="label label-success">@{{followup.status}}</label>
                                                        </td>
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
            followups: [],
            client: '',
            admin: '',
            download: ''
        };
        var store = new Vue({
            data: data,
            el: '#store',
            mounted: function () {
                this.filterValues();
                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#admin').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.admin = this.value;
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
                setClient: function (event) {
                    this.client = event.target.value;
                    this.filterValues();
                },
                setAdmin: function (event) {
                    this.admin = event.target.value;
                    this.filterValues();
                },
                filterValues: function () {
                    var from_date = this.from_date;
                    var to_date = this.to_date;
                    var client = this.client;
                    var admin = this.admin;
                    var base = '{{URL::to('reports/followups/download')}}';
                    this.download = base + '?from_date=' + from_date + '&to_date=' + to_date + '&client=' + client + '&admin=' + admin;
                    var $this = this;
                    var result = [];
                    axios.post('{{URL::to('reports/followups/filter')}}', {
                        from_date: from_date,
                        to_date: to_date,
                        client: client,
                        admin: admin
                    })
                        .then(function (response) {
                            $this.followups = response.data.followups;
                            return $this.followups;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
            }
        });
    </script>

@endsection