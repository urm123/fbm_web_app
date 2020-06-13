@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="inspector_app">
        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-1">
                    <h3>Inspectors</h3>
                </div>
                <div class="col-xs-12 col-sm-11">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('admin/inspectors/login-details')}}">Login Details</a></li>
                            <li><a href="{{URL::to('/admin/inspectors')}}">Inspector Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                </div>
            </div>
        </div>
        <!-- /end Page header  -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card cleaneroverview">
                        <div class="title">
                            <h4 class="text-left">Inspector Overview</h4>
                            @if($admin->level <= 1)
                                <h4 class="text-right" style="float:right;"><a
                                            href="{{URL::to('admin/inspectors/add-new')}}"> Add New Inspector + </a></h4>
                            @endif
                        </div>
                        <div class="" style="min-height:200px;">
                            <div class="col-sm-12">
                                <br />
                                <table class="table table-striped table-bordered table-hover" id="emp_list" style="width: 100%;">
                                    <thead>
                                        <th>SI Number</th>
                                        <th>Inspector Name</th>
                                        <th>Address</th>
                                        <th>Telephone</th>
                                        <th>Level</th>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!--/end tab-pane-->
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
            </div>
        </div>
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">--}}
{{--                    <div class="card inspactionoverview">--}}
{{--                        <div class="title">--}}
{{--                            <h4 class="text-left">Inspector Overview</h4>--}}
{{--                            @if($admin->level<=1)--}}
{{--                                <h4 class="text-right" style="float:right;"><a--}}
{{--                                            href="{{URL::to('admin/inspectors/add-new')}}"> Add New--}}
{{--                                        Inspector + </a></h4>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="content Scroll " style="min-height:400px;padding:7px;">--}}
{{--                            <table class="table selectable inspector-table">--}}
{{--                                <tr>--}}
{{--                                    <th>SI Number</th>--}}
{{--                                    <th>Inspector Name</th>--}}
{{--                                    <th>Address</th>--}}
{{--                                    <th>Telephone</th>--}}
{{--                                    <th></th>--}}
{{--                                    <th></th>--}}
{{--                                </tr>--}}
{{--                                <tr v-for="inspector in filtered_inspectors" @click="setInspector(inspector.id)"--}}
{{--                                    :data-inspector="inspector.first_name+' '+inspector.last_name">--}}
{{--                                    <td class=" col-1">@{{inspector.pan_number}}</td>--}}
{{--                                    <td class="col-2">@{{inspector.first_name}} @{{inspector.last_name}}</td>--}}
{{--                                    <td class="col-3">--}}
{{--                                        @{{inspector.street_number}}, @{{inspector.street_name}}--}}
{{--                                        , @{{inspector.city}}, @{{inspector.post_code}}--}}
{{--                                    </td>--}}
{{--                                    <td class="col-6">@{{inspector.telephone}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a :href="'{{URL::to('admin/inspectors/')}}/'+inspector.encoded+'/edit'"--}}
{{--                                           class="btn btn-success">Edit</a>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <button class="btn btn-danger" type="button"--}}
{{--                                                @click.prevent="deleteInspector(inspector.user_id)">Terminate--}}
{{--                                        </button>--}}
{{--                                    </td>--}}
{{--                                    <td class="col-7">--}}
{{--                                        <img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}"--}}
{{--                                             alt="info"--}}
{{--                                             width="33"--}}
{{--                                             height="33"></td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <!--/end tab-pane-->--}}
{{--                    </div>--}}
{{--                    <!--/end Card -->--}}
{{--                </div>--}}
{{--                <!--/end card-contener -->--}}
{{--            </div>--}}
{{--        </div>--}}
    </section>
    <link  href="{{URL::asset('assets/plugins/jquery/jquery.dataTables.min.css')}}" rel="stylesheet">
    <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{URL::asset('assets/plugins/jquery/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery/dataTables.bootstrap.min.js')}}"></script>
    <style>
        #emp_list th:nth-child(3) {
            /*width: 10% !important;*/
        }
    </style>
    <script>

        $(document).ready(function(){

            $('#emp_list').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{URL::to('admin/get-inspectors')}}",
                "columns": [
                    {data: 'pan_number', name: 'pan_number'},
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    {data: 'telephone', name: 'telephone'},
                    {data: 'level', name: 'level'},
                    { data: 'btn', name: 'btn',
                        'render': function (data, type, full_row, meta){
                            return '<div style="display: block;">' +
                                '<a href="{{ url('admin/inspectors/') }}/' + full_row.encoded + '/edit" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ' +
                                '<a href="{{ url('admin/inspector/') }}/' + full_row.id + '/get" class="btn btn-primary btn-xs"><i class="fa fa-window-maximize" aria-hidden="true"></i></a>  '+
                                //'<button class="btn btn-danger btn-xs" type="button" onclick="deleteClient(' + full_row.id + ')">Terminate </button>'+
                                '</div>';
                        }
                    },
                    { data: 'img', name: 'img',
                        render: function( data, type, full, meta ) {
                            return '<img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}" alt="info" width="33" height="33">';
                        }
                    }
                ]
            });
        });

        var data = {
            inspectors: {!! json_encode($inspectors) !!},
            inspector: [],
            inspector_id: '{{$inspector_id}}',
            filtered_inspectors: []
        };

        {{--window.addEventListener('load', function (ev) {--}}

        {{--    Vue.component('typeahead', {--}}
        {{--        template: '#typeahead',--}}
        {{--        mounted: function () {--}}
        {{--            var vm = this--}}
        {{--            jQuery(this.$el)--}}
        {{--                .typeahead({--}}
        {{--                    source: {!! json_encode($inspectors) !!},--}}
        {{--                    autoSelect: true--}}
        {{--                }).val(this.value)--}}
        {{--                .trigger('change')--}}
        {{--                // emit event on change.--}}
        {{--                .on('change', function () {--}}
        {{--                    vm.$emit('input', this.value);--}}
        {{--                    var current_value = this.value;--}}

        {{--                    jQuery('.inspector-table tbody tr').each(function (item, value) {--}}
        {{--                        if (jQuery(value).data('inspector') == current_value) {--}}
        {{--                            jQuery(value).addClass('ended');--}}
        {{--                            jQuery(".card .Scroll").mCustomScrollbar('scrollTo', jQuery(value));--}}
        {{--                        } else {--}}
        {{--                            jQuery(value).removeClass('ended');--}}
        {{--                        }--}}
        {{--                    })--}}
        {{--                });--}}
        {{--        },--}}
        {{--        watch: {--}}
        {{--            value: function (value) {--}}
        {{--                console.log(value);--}}
        {{--                jQuery(this.$el)--}}
        {{--                    .val(value)--}}
        {{--                    .trigger('change');--}}

        {{--            },--}}
        {{--        },--}}
        {{--        methods: {--}}
        {{--            setValue: function (value) {--}}

        {{--            }--}}
        {{--        }--}}
        {{--    });--}}

        {{--    var inspectors = new Vue({--}}
        {{--        el: '#inspector_app',--}}
        {{--        data: data,--}}
        {{--        mounted: function () {--}}
        {{--            this.filtered_inspectors = this.inspectors;--}}
        {{--            var $this = this;--}}
        {{--            if (this.inspector_id != '0') {--}}
        {{--                var selected_inspector = this.inspectors.filter(function (inspector) {--}}
        {{--                    return $this.inspector_id == inspector.id;--}}
        {{--                });--}}

        {{--                this.inspector = selected_inspector[0];--}}
        {{--            }--}}
        {{--        },--}}
        {{--        methods: {--}}
        {{--            setInspector: function (id) {--}}
        {{--                var selected_inspector = this.inspectors.filter(function (inspector) {--}}
        {{--                    return id == inspector.id--}}
        {{--                });--}}
        {{--                this.inspector = selected_inspector[0]--}}
        {{--            },--}}
        {{--            deleteInspector: function (user_id) {--}}
        {{--                var confirm = window.confirm('Are you sure you want to terminate the inspector?');--}}
        {{--                if (confirm) {--}}
        {{--                    var termination = window.prompt("Reason for termination?", "");--}}
        {{--                    axios.post('{{URL::to("/admin/inspectors/ajax-delete")}}', {--}}
        {{--                        user_id: user_id,--}}
        {{--                        termination: termination,--}}
        {{--                        _token: '{{csrf_token()}}'--}}
        {{--                    })--}}
        {{--                        .then(function (response) {--}}
        {{--                            alert(response.data.message);--}}
        {{--                            window.location.reload();--}}
        {{--                        })--}}
        {{--                        .catch(function (error) {--}}
        {{--                            console.log(error);--}}
        {{--                        });--}}
        {{--                }--}}
        {{--            },--}}
        {{--            filterInspectors: function (event) {--}}
        {{--                var key_value = event.target.value;--}}

        {{--                if (key_value == "") {--}}
        {{--                    return true;--}}
        {{--                }--}}

        {{--                var regex = new RegExp(".*" + key_value.toLowerCase() + "*.");--}}
        {{--                var selected_inspectors = this.inspectors.filter(function (client) {--}}
        {{--                    var match_regex = regex.test(client.name.toLowerCase());--}}
        {{--                    return match_regex;--}}
        {{--                });--}}

        {{--                this.filtered_inspectors = selected_inspectors;--}}
        {{--            },--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection