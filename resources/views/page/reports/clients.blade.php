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
                            <h4 class="text-left">Clients Report</h4>
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

                                    <label class="col-sm-4 control-label" for="category">Category:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="category"
                                                v-model="category" @change="setCategory($event)">
                                            <option value="">Select a category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="continuous">Continuous:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="continuous"
                                                v-model="continuous" @change="setContinuous($event)">
                                            <option value="">Select a option</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="city">City:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="city"
                                                v-model="city" @change="setCity($event)">
                                            <option value="">Select a city</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->city}}">{{$city->city}}</option>
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
                                                        <th>Name</th>
                                                        <th>Address</th>
                                                        <th>Class</th>
                                                        <th>Continuous</th>
                                                        <th>Supply Required</th>
                                                        <th>Cleaning Dates</th>
                                                        <th>Sub Tasks</th>
                                                        <th>Cleaner</th>
                                                        <th>Inspector</th>
                                                        <th>Last Inspection Date</th>
                                                        <th>Last Feedback</th>
                                                        <th>Incomplete</th>
                                                        <th>Complete</th>
                                                        <th>Cleaner Feedback for this Client</th>
                                                        <th>Terminated</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="client in results">
                                                        <td>@{{client.name}}</td>
                                                        <td>@{{client.address}}</td>
                                                        <td>@{{client.category}}</td>
                                                        <td>
                                                            <span v-if="client.continuous==1">Yes</span>
                                                            <span v-if="client.continuous==0">No</span>
                                                        </td>
                                                        <td>
                                                            <span v-if="client.supply_required==1">Yes</span>
                                                            <span v-if="client.supply_required==0">No</span>
                                                        </td>
                                                        <td>
                                                            <span v-if="client.repeat_mode">@{{ client.repeat_mode }}</span>
                                                            <span v-if="!client.repeat_mode">@{{ client.start_time }}</span>
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                <li v-for="task_item in client.task_items">
                                                                    @{{ task_item.task_item_name }}
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>@{{ client.cleaner }}</td>
                                                        <td>@{{ client.inspector_feedback.first_name }} @{{
                                                            client.inspector_feedback.last_name }}
                                                        </td>
                                                        <td>@{{ client.inspector_feedback.last_date }}
                                                        <td>
                                                            <i v-for="index in 10" class="fa fa-star rating-star"
                                                               :class="{'rating-active':index<=client.inspector_feedback.feedback}"></i>
                                                        </td>
                                                        <td>@{{ client.incomplete_count }}</td>
                                                        <td>@{{ client.complete_count }}</td>
                                                        <td>
                                                            <i v-for="index in 10" class="fa fa-star rating-star"
                                                               :class="{'rating-active':index<=client.cleaner_rating_total}"></i>
                                                        </td>
                                                        <td>
                                                            <span v-if="client.deleted_at">@{{client.deleted_at}}</span>
                                                            <span v-if="!client.deleted_at">No</span>
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
            results: [],
            total: '',
            client: '',
            cleaner: '',
            inspector: '',
            category: '',
            city: '',
            continuous: '',
            download: ''
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
                setCategory: function (event) {
                    this.category = event.target.value;
                    this.filterValues();
                },
                setCity: function (event) {
                    this.city = event.target.value;
                    this.filterValues();
                },
                setContinuous: function (event) {
                    this.continuous = event.target.value;
                    this.filterValues();
                },
                filterValues: function () {
                    var from_date = this.from_date;
                    var to_date = this.to_date;
                    var cleaner = this.cleaner;
                    var client = this.client;
                    var inspector = this.inspector;
                    var category = this.category;
                    var city = this.city;
                    var continuous = this.continuous;
                    var base = '{{URL::to('reports/clients/download')}}';
                    this.download = base + '?from_date=' + from_date + '&to_date=' + to_date + '&cleaner=' + cleaner + '&client=' + client + '&inspector=' + inspector + '&category=' + category + '&continuous=' + continuous + '&city=' + city;
                    var $this = this;
                    var result = [];
                    axios.post('{{URL::to('reports/clients/filter')}}', {
                        from_date: from_date,
                        to_date: to_date,
                        cleaner: cleaner,
                        client: client,
                        inspector: inspector,
                        category: category,
                        city: city,
                        continuous: continuous,
                    })
                        .then(function (response) {
                            $this.results = response.data.results;
                            // $this.total = response.data.total;
                            return $this.results;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
            }
        });
    </script>

@endsection