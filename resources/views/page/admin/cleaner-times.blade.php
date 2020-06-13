@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="cleaners_app">
        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Cleaners</h3>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('admin/getCleanerTimes')}}">Cleaner Sign In / Out</a></li>
                            <li class="active"><a href="{{URL::to('admin/cleaners')}}">Cleaner Information</a></li>
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
                            <h4 class="text-left">Cleaner Time Overview</h4>
                            @if($admin->level <= 1)
                                <h4 class="text-right" style="float:right;"><a href="{{URL::to('admin/cleaners/add-new-time')}}"> Add New + </a></h4>
                            @endif
                        </div>
                        <div class="row" style="padding-top: 20px;">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="row input-daterange">
                                    <div class="col-md-4">
                                        <input type="text" name="start_date" id="start_date" class="form-control inputdate" placeholder="From Date" />
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                        <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="min-height:200px;padding: 10px;">
                            <div class="col-sm-12">
                                <br />
                                <table class="table table-striped table-bordered table-hover" id="cleaner_list" style="width: 100%;">
                                    <thead>
                                        <th>Cleaner</th>
                                        <th>Client</th>
                                        <th>Work Days</th>
                                        <th>Time</th>
                                        <th>Mobile</th>
                                        <th>Telephone</th>
                                        <th>No Of People</th>
                                        <th>In</th>
                                        <th>Out</th>
                                        <th></th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
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
        #emp_list th:nth-child(5) {
            width: 21% !important;
        }
    </style>
    <script>

        $(document).ready(function(){

            var from_date = $('#start_date').val();

            load_data();

            $('#filter').click(function(){
                var from_date = $('#start_date').val();
                if(from_date != '') {
                    $('#cleaner_list').DataTable().destroy();
                    load_data(from_date);
                }
            });
        });

        function load_data(from_date = '') {

            $('#cleaner_list').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url:'{{URL::to('admin/getCleanerTimes')}}',
                    data:{from_date:from_date}
                },
                "columns": [
                    {data: 'first_name', name: 'first_name'},
                    {data: 'client_first_name', name: 'client_first_name'},
                    {data: 'work_days', name: 'work_days'},
                    {data: 'time', name: 'time'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'telephone', name: 'telephone'},
                    {data: 'number_of_people', name: 'number_of_people'},
                    {data: 'time_in', name: 'time_in'},
                    {data: 'time_out', name: 'time_out'},
                    { data: 'btn', name: 'btn',
                        'render': function (data, type, full_row, meta){
                            return '<div style="display: block;">' +
                                '<button class="btn btn-danger btn-xs" type="button" onclick="deleteClient(' + full_row.id + ')">Terminate </button>'+
                                '</div>';
                        }
                    },
                ]
            });
        }

        function deleteCleaner(user_id) {
            var confirm = window.confirm('Are you sure you want to terminate the cleaner?');
            if (confirm) {
                var termination = window.prompt("Reason for termination?", "");
                axios.post('{{URL::to("/admin/cleaners/ajax-delete")}}', {
                    user_id: user_id,
                    termination: termination,
                    _token: '{{csrf_token()}}'
                }).then(function (response) {
                    window.location.reload();
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }

    </script>
@endsection