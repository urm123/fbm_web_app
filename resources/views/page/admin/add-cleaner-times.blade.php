@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="allocations">
        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Client Information</h3>
                </div>
                <div class="col-xs-12 col-sm-1">
                </div>
                <div class="col-xs-12 col-sm-7">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('admin/cleaners')}}">Cleaner Information</a></li>
                            <li class="active"><a href="{{URL::to('admin/getCleanerTimes')}}">Cleaner Sign In / Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /end Page header  -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card form-card">
                        <div class="row title">
                            <div class="col-md-5">
                                <h4 class="text-left">Add Cleaner Sign In / Out</h4>
                            </div>
                            <div class="col-md-7">
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div>
                                    <div class="content" id="" style="overflow:visible;min-height:450px;">
                                        <form id="create-new-cleaner" method="post" class="form-horizontal" @submit.prevent="submitForm($event)">
                                            {{csrf_field()}}
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group" :class="{'has-error':validation.client}">
                                                    <label class="col-sm-4 control-label" for="client">Client</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control selectpicker" id="client" name="client">
                                                            <option value="">Select a client</option>
                                                            <option v-for="client in clients" :value="client.id">
                                                                @{{ client.name }}
                                                            </option>
                                                        </select>
                                                        <span class="help-block" v-if="validation.client">
                                                            <strong>@{{ validation.client[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="sub_client">Sub Contractor</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control selectpicker" id="sub_client" name="sub_client">
                                                            <option value="">Select a sub client</option>
                                                            <option v-for="client in clients" :value="client.id">
                                                                @{{ client.name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':validation.start_time}">
                                                    <label class="col-sm-4 control-label" for="start_time">Start Time</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control inputtime"
                                                               id="start_time" name="start_time">
                                                        <span class="help-block" v-if="validation.start_time">
                                                            <strong>@{{ validation.start_time[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group" :class="{'has-error':validation.mobile}">
                                                    <label class="col-sm-4 control-label" for="mobile">Mobile</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="mobile" name="mobile">
                                                        <span class="help-block" v-if="validation.mobile">
                                                            <strong>@{{ validation.mobile[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':validation.sign_in}">
                                                    <label class="col-sm-4 control-label" for="sign_in">Sign In</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control inputtime" id="sign_in" name="sign_in">
                                                        <span class="help-block" v-if="validation.sign_in">
                                                            <strong>@{{ validation.sign_in[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="people">No Of People</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control"id="people" name="people">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group" :class="{'has-error':validation['cleaner.0']}">
                                                    <label class="col-sm-3 control-label" for="cleaner">Cleaner</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control selectpicker" id="cleaner" name="cleaner">
                                                            <option value="">Select a cleaner</option>
                                                            @foreach($cleaners as $cleaner)
                                                                <option value="{{$cleaner->id}}">{{$cleaner->first_name}} {{$cleaner->last_name}}
                                                                    ({{$cleaner->pan_number}})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="help-block" v-if="validation['cleaner.0']">
                                                            <strong>@{{ validation['cleaner.0'][0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group" :class="{'has-error':validation.work_days}">
                                                    <label class="col-sm-3 control-label" for="address">Work Days</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="work_days" name="work_days">
                                                        <span class="help-block" v-if="validation.work_days">
                                                            <strong>@{{ validation.work_days[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':validation.end_time}">
                                                    <label class="col-sm-3 control-label" for="end_time">End Time</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control inputtime"
                                                               id="end_time" name="end_time">
                                                        <span class="help-block" v-if="validation.end_time">
                                                            <strong>@{{ validation.end_time[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="telephone">Telephone</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"id="telephone" name="telephone">
                                                    </div>
                                                </div>
                                                <div class="form-group"
                                                     :class="{'has-error':validation.sign_out}">
                                                    <label class="col-sm-3 control-label" for="sign_out">Sign Out</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control inputtime" id="sign_out" name="sign_out">
                                                        <span class="help-block" v-if="validation.sign_out">
                                                            <strong>@{{ validation.sign_out[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                <button type="submit" id="button" name="button"
                                                    class="btn btn-default save">Save & Continue
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--/end tab-pane-->
                                </div>
                            </div>
                            <!--/end   panel-body -->
                            <div class="cord-footer">
                            </div>
                        </div>
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
            </div>
        </div>
    </section>
    <script type="text/javascript">
        var data = {
            cleaners: {!! json_encode($cleaners) !!},
            validation: [
                {client: []},
                {cleaner: []},
                {start_time: []},
                {end_time: []},
                {mobile: []},
                {sign_in: []},
                {sign_out: []},
                {work_days: []}
            ],
            clients: {!! json_encode($clients) !!},
        };

        var allocations = new Vue({
            el: '#allocations',
            data: data,
            mounted: function () {

                var selected_clients = this.clients;
                this.clients = selected_clients;

                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#cleaner').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.$emit('input', this.value);
                    });

                    jQuery('#client').select2({
                        dropdownAutoWidth: true,
                        data: vm.clients
                    });

                    jQuery('#sub_client').select2({
                        dropdownAutoWidth: true,
                        data: vm.clients
                    });
                });
            },
            methods: {
                submitForm: function (event) {

                    // jQuery('#button').attr('disabled', 'disabled');
                    var elements = event.target.elements;

                    this.validation = [
                        {client: []},
                        {cleaner: []},
                        {start_time: []},
                        {end_time: []},
                        {mobile: []},
                        {sign_in: []},
                        {sign_out: []},
                        {work_days: []}
                    ];
                    var $this = this;
                    var form_elements = {};
                    for (var i = 0; i < elements.length; i++) {
                        form_elements[elements[i].getAttribute('name')] = elements[i].value;
                    }

                    axios.post('{{URL::to('/admin/cleaners/post-new-cleaner-time')}}', form_elements)
                        .then(function (response) {
                            if (response.data.message == 'Failed') {
                                $this.validation = response.data.validation;
                            } else {
                                swal("Client time added successfully !", "", "success");
                                location.reload();
                            }
                        }).catch(function (error) {
                            if (error.response) {
                                var errors = error.response.data.errors;
                                console.log(errors);
                            }
                        });
                }
            },
        });
    </script>
@endsection