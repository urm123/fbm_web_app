@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="administrator_app">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                    <ol class="breadcrumb" style="background: #fff;">
                        <?php echo $breadcrumb; ?>
                    </ol>
                </div> 
            </div>
        </div>
        <!-- /end Page header  -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card inspactionoverview">
                        <div class="title">
                            <h4 class="text-left">Administrator Overview</h4>
                            @if($admin->level<=1)
                                <h4 class="text-right" style="float:right;"><a href="{{URL::to('/admin/administrators/add-new')}}"> Add New
                                        Administrator + </a></h4>
                            @endif
                        </div>
                        <div class="" style="min-height:200px;">
                            <div class="col-sm-12">
                                <br />
                                <table class="table table-striped table-bordered table-hover" id="emp_list" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SI Number</th>
                                        <th>Administrator Name</th>
                                        <th>E-Mail</th>
                                        <th>Contact Number</th>
                                        <th>Admin Access</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!--/end tab-pane-->
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
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
        #emp_list th:nth-child(6) {
            width: 18% !important;
        }
    </style>
    <script>

        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#emp_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{URL::to("admin/getAdministrators")}}',
                    method: 'POST'
                },
                columns: [
                    {data: 'pan_number', name: 'pan_number'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'email', name: 'email'},
                    {data: 'telephone', name: 'telephone'},
                    {data: 'level', name: 'level'},
                    { data: 'sdsd', name: 'sdsd',
                        'render': function (data, type, full_row, meta){
                            return '<div style="display: block;">' +
                                '<a class="btn btn-warning btn-xs" type="button" href="{{ url('admin/adminDetails/') }}/' + full_row.id + '">View Details </a> '+
                                '<button class="btn btn-danger btn-xs" type="button" onclick="deleteAdmin(' + full_row.id + ')">Terminate </button>'+
                            '</div>';
                        }
                    },
                    { data: 'sdsd', name: 'sdsd',
                        render: function( data, type, full, meta ) {
                            return '<img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}" alt="info" width="33" height="33">';
                        }
                    }
                ]
            });

            // $('#emp_list').DataTable({
            //     "processing": true,
            //     "serverSide": true,   
            //     "ajax": {
            //         type: "POST",
            //         url: "{{URL::to('admin/getAdministrators')}}",
            //         headers: {
            //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
            //                 .getAttribute('content')
            //         }
            //     },
            //     "columns": [
            //         {data: 'pan_number', name: 'pan_number'},
            //         {data: 'first_name', name: 'first_name'},
            //         {data: 'email', name: 'email'},
            //         {data: 'telephone', name: 'telephone'},
            //         {data: 'level', name: 'level'},
            //         { data: 'sdsd', name: 'sdsd',
            //             'render': function (data, type, full_row, meta){
            //                 return '<div style="display: block;">' +
            //                     '<a class="btn btn-warning btn-xs" type="button" href="{{ url('admin/adminDetails/') }}/' + full_row.id + '">View Details </a> '+
            //                     '<button class="btn btn-danger btn-xs" type="button" onclick="deleteAdmin(' + full_row.id + ')">Terminate </button>'+
            //                 '</div>';
            //             }
            //         },
            //         { data: 'sdsd', name: 'sdsd',
            //             render: function( data, type, full, meta ) {
            //                 return '<img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}" alt="info" width="33" height="33">';
            //             }
            //         }
            //     ]
            // });
        });

        function deleteAdmin(user_id) {
            var confirm = window.confirm('Are you sure you want to terminate the administrator?');
            if (confirm) {
                var termination = window.prompt("Reason for termination?", "");
                axios.post('{{URL::to("/admin/administrators/ajax-delete")}}', {
                    user_id: user_id,
                    termination: termination,
                    _token: '{{csrf_token()}}'
                })
                    .then(function (response) {
                        alert(response.data.message);
                        window.location.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }

        var data = {
            'administrators': {!! json_encode($administrator_details) !!},
            'administrator': [],
            'administrator_id': '{{$administrator_id}}'
        };
        // console.log(data);

        {{--window.addEventListener('load', function (ev) {--}}
        {{--    var administrators = new Vue({--}}
        {{--        el: '#administrator_app',--}}
        {{--        data: data,--}}
        {{--        mounted: function () {--}}
        {{--        },--}}
        {{--        methods: { --}}
        {{--            deleteAdmin: function (user_id) {--}}
        {{--                var confirm = window.confirm('Are you sure you want to terminate the administrator?');--}}
        {{--                if (confirm) {--}}
        {{--                    var termination = window.prompt("Reason for termination?", "");--}}
        {{--                    axios.post('{{URL::to("/admin/administrators/ajax-delete")}}', {--}}
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
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

    </script>
    <script type="text/x-template" id="typeahead">
        <input type="text" class="form-control typeahead" placeholder="Search" data-provide="typeahead"/>
    </script>
@endsection