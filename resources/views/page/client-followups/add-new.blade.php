@extends('layouts.common')

@section('content')
    @include('layouts.headers.client-followups')
    <!-- Page Content -->
    <section class="page-content dashbord" id="complaints">
        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
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
                    <div class="card form-card ">
                        <div class="title">
                            <h4 class="text-left">New Client Followup</h4>
                            <h4 class="text-right goBack" style="float:right;">
                                <a href="{{URL::to('client-followups')}}"> Client Followups Overview</a>
                            </h4>
                        </div>
                        <div class="content" style="overflow:visible;min-height:450px;">
                            <form id="create-new-cleaner" method="post" class="form-horizontal"
                                  action="{{URL::to('/client-followups/post-add-new')}}">
                                {{csrf_field()}}
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="client">Client</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" id="client" name="client">
                                                <option value="">Select a client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('client'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('client') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="type">Date</label>
                                        <div class="col-sm-8">
                                            <input class="form-control inputdate" id="date" name="date"
                                                   value="{{old('date')}}">
                                            @if ($errors->has('date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="type">Type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" id="type" name="type">
                                                <option value="">Select a type</option>
                                                <option value="Payment">Payment</option>
                                                <option value="Service Feedback">Service Feedback</option>
                                                <option value="Complaint">Complaint</option>
                                                <option value="Document">Document</option>
                                            </select>
                                            @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                        <label class="col-sm-2 control-label" for="comment">Description</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="8" id="comment" name="comment">{{old('comment')}}</textarea>
                                            @if ($errors->has('comment'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('comment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <button type="submit" class="btn btn-default save">Save</button>
                                    <button type="reset" class="btn btn-default clear">Cancel</button>
                                </div>
                            </form>
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
            tasks_loaded: false,
            tasks: []
        };
        var complaints = new Vue({
            data: data,
            el: '#complaints',
            mounted: function () {
                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#client').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.$emit('input', this.value);
                        vm.setClient('0', event);
                    });
                });
            },
            methods: {
                setClient: function (variable, event) {
                    var client_id = event.target.value;
                    var $this = this;
                    axios.post('{{URL::to('/admin/clients/ajax-get-tasks')}}', {
                        _token: '{{csrf_token()}}',
                        client_id: client_id
                    })
                        .then(function (response) {
                            $this.tasks = response.data.tasks;
                            $this.tasks_loaded = true;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        });
    </script>
@endsection