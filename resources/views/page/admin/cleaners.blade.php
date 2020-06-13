@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="cleaners_app">
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
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
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
                            <h4 class="text-left">Cleaner Overview</h4>
                            @if($admin->level<=1)
                                <h4 class="text-right" style="float:right;"><a
                                            href="{{URL::to('admin/cleaners/add-new')}}">
                                        Add New Cleaner + </a></h4>
                            @endif
                        </div>
                        <div class="" style="min-height:200px;">
                            <div class="col-sm-12">
                                <br />
                                <table class="table table-striped table-bordered table-hover" id="emp_list" style="width: 100%;">
                                    <thead>
                                        <th>SI Number</th>
                                        <th>Cleaner Name</th>
                                        <th>Address</th>
                                        <th>Telephone</th>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card cleanerdetails">
                        <div class="title">
                            <h4>Cleaner Details</h4>
                        </div>
                        <div class="content Scroll" style="min-height:300px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                            <table class="table table-hover" id="print">
                                <tr>
                                    <td class="col-1" style="width:30%;">Name:</td>
                                    <td class="col-2"><span id="cName"></span></td>
                                </tr>
                                <tr>
                                    <td class="col-1" style="width:30%;">Username:</td>
                                    <td class="col-2"><span id="cUname"></span></td>
                                </tr>
                                <tr>
                                    <td class="col-1">Telephone Number:</td>
                                    <td class="col-2"><span id="cTel"></span></td>
                                </tr>
                                <tr>
                                    <td class="col-1">Mobile Number:</td>
                                    <td class="col-2"><span id="cMobile"></span></td>
                                </tr>
                                <tr>
                                    <td class="col-1">Address:</td>
                                    <td class="col-2"><span id="cAddress"></span></td>
                                </tr>
                                <tr>
                                    <td class="col-1">Start Date:</td>
                                    <td class="col-2"><span id="cSdate"></span></td>
                                </tr>
                                <tr>
                                    <td class="col-1">Cleaner Type:</td>
                                    <td class="col-2"><span id="cType"></span></td>
                                </tr>
                                <tr>
                                    <td class="col-1">Password:</td>
                                    <td class="col-2" style="font-family: monospace"><span id="cPass"></span></td>
                                </tr>
                                <tr v-if="cleaner.file">
                                    <td class="col-1">Document:</td>
                                    <td class="col-2"><a id="image" href="" target="_blank">Download</a></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th style="width: 25%">Client</th>
                                                <th style="width: 75%">Time Slot</th>
                                            </tr>
                                            </thead>
                                            <tbody id="timeSlot">
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <button style="margin-right: 15px; margin-bottom: 15px;" class="btn btn-primary pull-right"
                                type="button" onclick="PrintElem('print')">Print
                        </button> 
                    </div>
                </div> -->
                <!--/end card-contener -->
            </div>
        </div>
    </section>
    <link  href="{{URL::asset('assets/plugins/jquery/jquery.dataTables.min.css')}}" rel="stylesheet">
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>--}}
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

            $('#emp_list').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('datatable.getcleaners') }}",
                "columns": [
                    {data: 'pan_number', name: 'pan_number'},
                    {data: 'name', name: 'name'},
                    {data: 'pan_number', name: 'pan_number'},
                    {data: 'telephone', name: 'telephone'},
                    { data: 'sdsd', name: 'sdsd',
                        'render': function (data, type, full_row, meta){
                            return '<div style="display: block;">' +
                                '<a href="{{ url('admin/cleaners/') }}/' + full_row.encoded + '/edit" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ' + 
                                '<a class="btn btn-warning btn-xs" type="button" href="{{ url('admin/cleaners/') }}/' + full_row.id + '/cleaner">Details </a> '+
                                '<button class="btn btn-danger btn-xs" type="button" onclick="deleteCleaner(' + full_row.user_id + ')">Terminate </button>'+
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
        });

        // function filterData(user){

        //     var json_arr = data1['cleaners'];
        //     console.log(json_arr);
        //     var as = $(json_arr).filter(function (i,n){
        //         return n.user_id == user;
        //     });

        //     $("#cName").html(as[0].first_name +' '+ as[0].last_name);
        //     $("#cUname").html(as[0].username);
        //     $("#cTel").html(as[0].telephone);
        //     $("#cMobile").html(as[0].mobile);
        //     $("#cAddress").html(as[0].address);
        //     $("#cSdate").html(as[0].start_date);
        //     $("#cType").html(as[0].type);
        //     $("#cPass").html(as[0].initial_password);
        //     $("#image").attr("href", as[0].image);

        //     $('#timeSlot').html('');
        //     var list = $('<tr></tr>');
        //     $('#timeSlot').append(list);
        //     $.each(as[0]['tasks'], function (index, titleObj) {
        //         $('#timeSlot').append('<tr><td>' + titleObj.name + '</td><td>' + titleObj.name + '</td></tr>');
        //     });
        // }

        function deleteCleaner(user_id) {
            var confirm = window.confirm('Are you sure you want to terminate the cleaner?');
            if (confirm) {
                var termination = window.prompt("Reason for termination?", "");
                axios.post('{{URL::to("/admin/cleaners/ajax-delete")}}', {
                    user_id: user_id,
                    termination: termination,
                    _token: '{{csrf_token()}}'
                }).then(function (response) {
                    alert(response.data.message);
                    window.location.reload();
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }

        var data1 = {
            'cleaners': {!! json_encode($allcleaners) !!},
            'cleaner': [],
            'cleaner_id': '{{$cleaner_id}}',
            'filtered_cleaners': []
        };
        // console.log(data1);

        // window.addEventListener('load', function (ev) {
        //     new Vue({
        //         el: '#cleaners_app',
        //         // data: data1,
        //         methods: {
        //             setCleaner: function (cleaner_id) {
        //                 alert();
        //                 // var filtered_cleaner = this.cleaners.filter(function (single_cleaner) {
        //                 //     return single_cleaner.id == cleaner_id
        //                 // });
        //                 //
        //                 // this.cleaner = filtered_cleaner[0];
        //             }
        //         }
        //     });
        // });

    </script>

    <script type="text/x-template" id="typeahead">
        <input type="text" class="form-control typeahead" placeholder="Search" data-provide="typeahead"/>
    </script>
@endsection