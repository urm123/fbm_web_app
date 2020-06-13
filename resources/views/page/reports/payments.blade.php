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
                            <h4 class="text-left">Inspector Report</h4>
                        </div>


                        <div class="content" style="overflow:visible;min-height:1150px;">


                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="inspector">Inspector Name</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control selectpicker" v-model="inspector">
                                            <option value="">Select a inspector</option>
                                            @foreach($inspectors as $inspector)
                                                <option value="{{$inspector->id}}">{{$inspector->first_name}} {{$inspector->last_name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="InputTaskType">Time Range</label>
                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control selectpicker" v-model="time">
                                            <option value="all">All</option>
                                            <option value="last-month">Last Month</option>
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
                                                        <th>Inspector</th>
                                                        <th>Address</th>
                                                        <th>Telephone</th>
                                                        <th>Mobile</th>
                                                        <th>Pan Number</th>
                                                        <th>Start Date</th>
                                                        <th>Image</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="inspector in filtered_inspectors">
                                                        <td>@{{inspector.first_name}} @{{inspector.last_name}}</td>
                                                        <td>@{{inspector.street_number}},
                                                            @{{inspector.street_name}},
                                                            @{{inspector.city}}, @{{inspector.post_code}},
                                                        </td>
                                                        <td>@{{inspector.telephone}}</td>
                                                        <td>@{{inspector.mobile}}</td>
                                                        <td>@{{inspector.pan_number}}</td>
                                                        <td>@{{inspector.agreement_start}}</td>
                                                        <td><img style="max-width: 100px;"
                                                                 :src="inspector.image" alt=""></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                <button type="submit" class="btn btn-default save">Download as Excel</button>

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
            inspector_list: {!! json_encode($inspectors) !!},
            inspectors: [],
            inspector: '',
            time: '',
        };
        var store = new Vue({
            data: data,
            el: '#store',
            mounted: function () {
                this.inspectors = this.inspector_list
                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#inspector').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.inspector = this.value;
                        vm.$emit('input', this.value);
                    });
                });
            },
            computed: {
                filtered_inspectors: function () {
                    var inspector = this.inspector;
                    var time = this.time;
                    var case_name = 'none';
                    if (inspector != '' && time != 'all' && time != '') {
                        case_name = 'inspector-time';
                    }
                    if (inspector != '') {
                        case_name = 'inspector';
                    }
                    if (time != 'all' && time != '') {
                        case_name = 'time';
                    }
                    if (inspector == '' && (time == 'all' || time == '')) {
                        case_name = 'none';
                    }
                    var $this = this;

                    var filtered_inspector = this.inspector_list.filter(function (inspector_list_item) {
                        switch (case_name) {
                            case 'inspector-time':
                                return inspector_list_item.id == inspector && moment(inspector_list_item.agreement_start).isSameOrAfter($this.compareTime(time));
                            case 'inspector':
                                return inspector_list_item.id == inspector;
                            case 'time':
                                return moment(inspector_list_item.agreement_start).isSameOrAfter($this.compareTime(time));
                            case 'none':
                                return true;
                        }
                    });
                    return this.inspectors = filtered_inspector;
                }
            },
            methods: {
                compareTime: function (time) {
                    switch (time) {
                        case 'last-month':
                            return moment().subtract(1, 'month');
                    }
                }
            }
        });
    </script>

@endsection