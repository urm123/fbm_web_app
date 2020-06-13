@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')

    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Task Details</h5>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                        <div class="card">
                            <table class="table table-responsive table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="col-2"><span>Task Name</span></td>
                                        <td class="col-2"><span id="taskName"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><span>Address</span></td>
                                        <td class="col-2"><span id="address"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><span>Start Time</span></td>
                                        <td class="col-2"><span id="startTime"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><span>End Time</span></td>
                                        <td class="col-2"><span id="endTime"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><span>Inspector</span></td>
                                        <td class="col-2"><span id="inspector"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><span>Cleaner</span></td>
                                        <td class="col-2"><span id="cleaner"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <section class="page-content dashboard" id="clients">
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                    <ol class="breadcrumb" style="background: #fff;">
                        <?php echo $breadcrumb; ?>
                    </ol>
                </div> 
            </div>
        </div>
        <div id="exTab2" class="container">
            <ul class="nav nav-tabs">
                <li class="active"><a  href="#1" data-toggle="tab">Client Details</a></li>
                <li><a href="#2" data-toggle="tab">Tasks</a></li>
                <li><a href="#3" data-toggle="tab">Sign In / Sign Off</a></li>
            </ul>
            <div class="tab-content ">
                <div class="tab-pane active" id="1">
                    <br />
                    <div class="container">
                        <div class="row">
                            <!--/end card-contener -->
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                                <div class="card cleanerdetails">
                                    <div class="title">
                                        <h4>Client Details</h4>
                                    </div>
                                    <div class="content Scroll" style="min-height:300px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                                        <table class="table" id="print">
                                            <tr>
                                                <td class="col-1" style="width:30%;">Name:</td>
                                                <td class="col-2">{{ $client->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Address:</td>
                                                <td class="col-2">{{ $client->street_number }}, {{ $client->street_name }}, {{ $client->city }}, {{ $client->post_code }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Start Date:</td>
                                                <td class="col-2">{{ $client->start_date }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">End Date:</td>
                                                <td class="col-2">{{ $client->termination_date }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Continuous:</td>
                                                <td class="col-2">{{ $client->continuous }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Supply Required:</td>
                                                <td class="col-2">{{ $client->supply_required }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Lock Code:</td>
                                                <td class="col-2">{{ $client->lock_code }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Alarm Code:</td>
                                                <td class="col-2">{{ $client->alarm_code }}</td>
                                            </tr>
                                            <tr>
                                                <td class="col-1">Contract:</td>
                                                <td class="col-2"><a href="{{ $client->contract }}" target="_blank">View/Download</a></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table class="table table-responsive">
                                                        <thead>
                                                        <tr>
                                                            <th>Cleaner</th>
                                                            <th>Task</th>
                                                            <th>Frequency</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($client->details as $detail)
                                                            <tr>
                                                                <td>{{ $detail->first_name }} {{ $detail->last_name }}</td>
                                                                <td>{{ $detail->name }}</td>
                                                                <td>
                                                                    @if($detail->repeat == '1')
                                                                        <span>
                                                                    {{ $detail->repeat_mode }}
                                                                </span>
                                                                    @else
                                                                        <span>
                                                                    No
                                                                </span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table class="table table-responsive">
                                                        <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Minimum Products Limit</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($client->products as $product)
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->quantity }}</td>
                                                                <td>{{ $product->shortage_alert }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table class="table table-responsive">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="2">Operational Contacts</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($client->operational_contacts as $operational_contact)
                                                            <tr>
                                                                <td>
                                                                    <table class="table table-responsive">
                                                                        <tr>
                                                                            <td>Name:</td>
                                                                            <td>{{ $operational_contact->first_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email:</td>
                                                                            <td>{{ $operational_contact->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Telephone:</td>
                                                                            <td>{{ $operational_contact->telephone }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-responsive">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="2">Accounting Contacts</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($client->accounting_contacts as $accounting_contact)
                                                            <tr>
                                                                <td>
                                                                    <table class="table table-responsive">
                                                                        <tr>
                                                                            <td>Name:</td>
                                                                            <td>{{ $accounting_contact->first_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email:</td>
                                                                            <td>{{ $accounting_contact->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Telephone:</td>
                                                                            <td>{{ $accounting_contact->telephone }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="2">
                    <br />
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                            <div class="card cleanerdetails">
                                <div class="content Scroll" style="min-height:300px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                                    <table class="table" id="print">
                                        <thead>
                                            <th>Task Name</th>
                                            <th>Client</th>
                                            <th>Inspector</th>
                                            <th>Address</th>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tbody> 
                                            @foreach ($taskList as $task)
                                                <tr>
                                                    <td class="col-2">{{ $task->task_name }}</td>
                                                    <td class="col-2">{{ $task->client_name }}</td>
                                                    <td class="col-2">{{ $task->inspector_first_name }} {{ $task->inspector_last_name }}</td>
                                                    <td class="col-3">{{ $task->address }}</td>
                                                    <td>
                                                        <a onclick="getTask({{ $task->task_id }})"
                                                           class="btn btn-xs btn-primary">View</a>
                                                        <a href="'{{URL::to('admin/clients/tasks/')}}/{{ $task->task_id }}/assign'"
                                                           class="btn btn-xs btn-success">Reassign</a>
                                                    </td>
                                                    <td class="col-5">
                                                        <img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}" alt="info" width="33" height="33">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="3">
                    <br />
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                            <div class="card cleanerdetails">
                                <div class="content Scroll" style="min-height:300px;margin: 14px; border: 1px solid #ccc; border-radius: 5px;">
                                    <table class="table" id="print">
                                        <thead>
                                            <th>Task Name</th>
                                            <th>Clearner</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                        @foreach ($timeList as $time)
                                            <tr>
                                                <td class="col-2">{{ $time->task_name }}</td>
                                                <td class="col-2">{{ $time->cleaner_first_name }} {{ $time->cleaner_last_name }}</td>
                                                <td class="col-3">{{ $time->start_date }}</td>
                                                <td class="col-3">{{ $time->end_date }}</td>
                                                <td class="col-5">
                                                    <img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}" alt="info" width="33" height="33">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br />
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

            $('#emp_list').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{URL::to('admin/getclients')}}",
                "columns": [
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    { data: 'btn', name: 'btn',
                        'render': function (data, type, full_row, meta){
                            return '<div style="display: block;">' +
                                '<a href="{{ url('admin/clients/') }}/' + full_row.id + '/edit" class="btn btn-success btn-xs">Edit</a> ' +
                                '<a href="{{ url('admin/clients/') }}/' + full_row.id + '/edit" class="btn btn-primary btn-xs">View</a>  '+
                                '<button class="btn btn-danger btn-xs" type="button" onclick="deleteClient(' + full_row.id + ')">Terminate </button>'+
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

        function getTask(task) {
            axios.post('{{URL::to("/admin/clients/getTask")}}', {
                encoded: task,
                _token: '{{csrf_token()}}'
            }).then(function (response) {

                $('#taskName').html('');
                $('#address').html('');
                $('#startTime').html('');
                $('#endTime').html('');
                $('#inspector').html('');
                $('#cleaner').html('');

                $('#taskName').html(response.data.taskData.name);
                $('#address').html(response.data.taskData.address);
                $('#startTime').html(response.data.taskData.start_time);
                $('#endTime').html(response.data.taskData.end_time);
                $('#inspector').html(response.data.taskData.first_name +' '+ response.data.taskData.last_name);
                $('#cleaner').html(response.data.taskData.cleaner_first_name +' '+ response.data.taskData.cleaner_last_name);

                $('#taskModal').modal('toggle');
            }).catch(function (error) {
                console.log(error);
            });
        }

    </script>
@endsection