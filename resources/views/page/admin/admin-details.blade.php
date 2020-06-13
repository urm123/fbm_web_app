@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="clients"> 
        <div id="exTab2" class="container">
            <!-- Page header  -->
            <div class="container page-header" style="margin-bottom: 0;">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                        <ol class="breadcrumb" style="background: #fff;">
                            <?php echo $breadcrumb; ?>
                        </ol>
                    </div> 
                </div>
            </div>
            <!-- /end Page header  -->
            <div class="tab-content ">
                <div class="tab-pane active" id="1">
                    <br />
                    <div class="container">
                        <div class="row">
                            <!--/end card-contener -->
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                                <div class="card cleanerdetails">
                                    <div class="title">
                                        <h4>Admin Details</h4>
                                    </div>
                                    <div class="content Scroll" style="height:200px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                                        <table class="table" id="print">
                                            <tr>
                                                <td class="col-1" style="width:30%;">Name:</td>
                                                <td class="col-2">{{ $administrator_details->first_name }} {{ $administrator_details->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Address:</td>
                                                <td class="col-2">{{ $administrator_details->street_number }}, {{ $administrator_details->street_name }}, {{ $administrator_details->city }}, {{ $administrator_details->post_code }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">PAN Number:</td>
                                                <td class="col-2">{{ $administrator_details->pan_number }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Admin Access:</td>
                                                <td class="col-2">{{ $administrator_details->level }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Status:</td>
                                                <td class="col-2">{{ $administrator_details->status }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Password:</td>
                                                <td class="col-2">{{ $administrator_details->initial_password }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

        });

    </script>
@endsection