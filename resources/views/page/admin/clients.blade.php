@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="clients">
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
                <div class="col-xs-12 col-sm-1"></div>
                <div class="col-xs-12 col-sm-11">
                    <div class="second-navbar page">
                        <ul>
{{--                            <li><a href="{{route('admin.category.index')}}">Classes</a></li>--}}
{{--                            <li><a href="{{URL::to('admin/clients')}}">Clients</a></li>--}}
{{--                            <li><a href="{{URL::to('admin/clients/tasks')}}">Tasks</a></li>--}}
{{--                            <li><a href="{{URL::to('admin/clients/allocations')}}">Allocations</a></li>--}}
{{--                            <li><a href="{{URL::to('admin/clients/add-new')}}">Register Client</a></li>--}}
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
                    <div class="card cleaneroverview">
                        <div class="title">
                            <h4 class="text-left">Clients Overview</h4>
                            <h4 class="text-right" style="float:right;"><a href="{{URL::to('admin/clients/add-new')}}">
                                    Add New Client + </a></h4>
                        </div>
                        <div class="" style="min-height:200px;">
                            <div class="col-sm-12">
                                <br />
                                <table class="table table-striped table-bordered table-hover" id="emp_list" style="width: 100%;">
                                    <thead>
                                        <th>Client Name</th>
                                        <th>Address</th>
                                        <th>Checklist</th>
                                        <th>Class</th>
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
    </section>
    <link  href="{{URL::asset('assets/plugins/jquery/jquery.dataTables.min.css')}}" rel="stylesheet">
    <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{URL::asset('assets/plugins/jquery/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery/dataTables.bootstrap.min.js')}}"></script>
    <style>
        #emp_list th:nth-child(3) {
            width: 17% !important;
        }
    </style>
    <script type="text/javascript">

        $(document).ready(function(){

            $('#emp_list').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{URL::to('admin/getclients')}}",
                "columns": [
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    { data: 'btnChecklist', name: 'btnChecklist',
                        'render': function (data, type, full_row, meta){
                            return '<div style="display: block;text-align;center;">' + 
                                '<a href="{{ url('admin/clients/') }}/' + full_row.id + '/getChecklist" class="btn btn-primary btn-xs">View Checklist</a>  '+ 
                                '</div>';
                        }
                    },
                    {data: 'category', name: 'category'},
                    { data: 'btn', name: 'btn',
                        'render': function (data, type, full_row, meta){
                            return '<div style="display: block;">' +
                                '<a href="{{ url('admin/clients/') }}/' + full_row.id + '/edit" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ' +
                                '<a href="{{ url('admin/clients/') }}/' + full_row.id + '/get" class="btn btn-primary btn-xs"><i class="fa fa-window-maximize" aria-hidden="true"></i></a>  '+
                                // '<button class="btn btn-danger btn-xs" type="button" onclick="deleteClient(' + full_row.id + ')">Terminate </button>'+
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
            clients: {!! json_encode($clients) !!},
            client: [],
            client_id: '{{$client_id}}',
            filtered_clients: []
        };
        {{--window.addEventListener('load', function (ev) { --}}

        {{--    var clients = new Vue({--}}
        {{--            el: '#clients',--}}
        {{--            data: data,--}}
        {{--            mounted: function () {--}}
        {{--                this.filtered_clients = this.clients;--}}
        {{--                var $this = this;--}}
        {{--                var vm = this;--}}
        {{--                jQuery(this.$el)--}}
        {{--                    .typeahead({--}}
        {{--                        source: {!! json_encode($clients) !!},--}}
        {{--                        autoSelect: true--}}
        {{--                    }).val(this.value)--}}
        {{--                    .trigger('change')--}}
        {{--                    // emit event on change.--}}
        {{--                    .on('change', function () {--}}
        {{--                        vm.$emit('input', this.value);--}}
        {{--                        var current_value = this.value;--}}

        {{--                        jQuery('.client-table tbody tr').each(function (item, value) {--}}
        {{--                            if (jQuery(value).data('client') == current_value) {--}}
        {{--                                jQuery(value).addClass('ended');--}}
        {{--                                jQuery(".card .Scroll").mCustomScrollbar('scrollTo', jQuery(value));--}}
        {{--                            } else {--}}
        {{--                                jQuery(value).removeClass('ended');--}}
        {{--                            }--}}
        {{--                        })--}}
        {{--                    });--}}
        {{--                if (this.client_id != '0') {--}}
        {{--                    var selected_client = this.clients.filter(function (client) {--}}
        {{--                        return $this.client_id == client.id;--}}
        {{--                    });--}}

        {{--                    this.client = selected_client[0];--}}
        {{--                }--}}
        {{--            },--}}
        {{--            methods: {--}}
        {{--                setClient: function (client_id) {--}}
        {{--                    var selected_client = this.clients.filter(function (client) {--}}
        {{--                        return client_id == client.id;--}}
        {{--                    });--}}
        {{--                    this.client = selected_client[0];--}}
        {{--                },--}}
        {{--                filterClients: function (event) {--}}
        {{--                    var key_value = event.target.value;--}}

        {{--                    if (key_value == "") {--}}
        {{--                        return true;--}}
        {{--                    }--}}

        {{--                    var regex = new RegExp(".*" + key_value.toLowerCase() + "*.");--}}
        {{--                    var selected_clients = this.clients.filter(function (client) {--}}
        {{--                        var match_regex = regex.test(client.name.toLowerCase());--}}
        {{--                        return match_regex;--}}
        {{--                    });--}}

        {{--                    this.filtered_clients = selected_clients;--}}
        {{--                },--}}
        {{--                deleteClient: function (client_id) {--}}
        {{--                    var confirm = window.confirm('Are you sure you want to terminate the client?');--}}
        {{--                    if (confirm) {--}}
        {{--                        axios.post('{{URL::to("/admin/clients/ajax-delete")}}', {--}}
        {{--                            client_id: client_id,--}}
        {{--                            _token: '{{csrf_token()}}'--}}
        {{--                        })--}}
        {{--                            .then(function (response) {--}}
        {{--                                alert(response.data.message);--}}
        {{--                                window.location.reload();--}}
        {{--                            })--}}
        {{--                            .catch(function (error) {--}}
        {{--                                console.log(error);--}}
        {{--                            });--}}
        {{--                    }--}}
        {{--                }--}}
        {{--            }, watch: {--}}
        {{--                value: function (value) {--}}
        {{--                    console.log(value);--}}
        {{--                    jQuery(this.$el)--}}
        {{--                        .val(value)--}}
        {{--                        .trigger('change');--}}

        {{--                },--}}
        {{--            },--}}
        {{--        });--}}
        {{--});--}}
    </script>
@endsection