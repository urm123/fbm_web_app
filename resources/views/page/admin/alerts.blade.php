@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="alerts">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Administrators</h3>
                </div>
                <div class="col-xs-12 col-sm-5"></div>
            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card inspactionoverview">
                        <div class="title">
                            <h4 class="text-left">Alerts Overview</h4>
                            @if($admin->level<=1)
                                <h4 class="text-right" style="float:right;"><a
                                            href="{{URL::to('/admin/alerts/add-new')}}"> Add New
                                        Alert + </a></h4>
                            @endif
                        </div>
                        <div class="content Scroll " style="min-height:400px;padding:7px;">
                            <table class="table selectable admin-table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($alerts as $alert)
                                    <tr>
                                        <td>{{$alert->title}}</td>
                                        <td>{{$alert->message}}</td>
                                        <td>{{$alert->type}}</td>
                                        <td>{{$alert->date}}</td>
                                        <td>
                                            @if($alert->status)
                                                Active
                                            @else
                                                Deactive
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{URL::to('/admin/alerts/'.$alert->id.'/edit')}}"
                                               class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" type="button"
                                                    @click.prevent="deleteAlert({{$alert->id}})">Terminate
                                            </button>
                                        </td>
                                        <td class="col-6">
                                            <img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}"
                                                 alt="info"
                                                 width="33"
                                                 height="33"></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--/end tab-pane-->
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
            </div>
        </div>
    </section>

    <script>
        var alerts = new Vue({
            el: '#alerts',
            methods: {
                deleteAlert: function (alert_id) {
                    var confirm = window.confirm('Are you sure you want to delete the alert?');
                    if (confirm) {
                        axios.post('{{URL::to("/admin/alerts/ajax-delete")}}', {
                            alert_id: alert_id,
                            _token: '{{csrf_token()}}'
                        })
                            .then(function (response) {
                                alert(response.data.message);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }
                }
            }
        });
    </script>

@endsection