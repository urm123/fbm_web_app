@extends('layouts.common')

@section('content')
    @include('layouts.headers.sales')
    <section class="page-content dashbord" id="prospects">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Prospects</h3>
                </div>
                <div class="col-xs-12 col-sm-4">

                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('sales/prospect-details')}}">Prospect Details</a></li>
                            <li><a href="{{URL::to('sales/prospects')}}">Add New Prospect</a></li>
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
                        <div class="title">
                            <h4 class="text-left">Prospect Details</h4>
                        </div>


                        <div class="content " style="overflow:visible;min-height:330px;">

                            <form method="post" class="form-horizontal"
                                  action="{{URL::to('/sales/followup/post-edit')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="prospect_id" value="{{$prospect->id}}">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="first_name">First Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                   value="{{$prospect->first_name}}">
                                            @if ($errors->has('first_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="telephone">Primary Telephone
                                            Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="telephone" name="telephone"
                                                   value="{{$prospect->telephone}}">
                                            @if ($errors->has('telephone'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="email">Email</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="email" name="email"
                                                   value="{{$prospect->email}}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="status">Prospect
                                            State</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" name="status" id="status">
                                                <option value="">Select a status</option>
                                                <option @if($prospect->status=="Inquiry") selected="selected"
                                                        @endif value="Inquiry">Inquiry
                                                </option>
                                                <option @if($prospect->status=="Appointment Scheduled") selected="selected"
                                                        @endif value="Appointment Scheduled">Appointment Scheduled
                                                </option>
                                                <option @if($prospect->status=="Quote Given") selected="selected"
                                                        @endif value="Quote Given">Quote Given
                                                </option>
                                                <option @if($prospect->status=="Sale Closed") selected="selected"
                                                        @endif value="Sale Closed">Sale Closed
                                                </option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="address">Address</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control selectpicker" name="address"
                                                   id="address">
                                            @if ($errors->has('address'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="business_name">Business Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="business_name"
                                                   name="business_name"
                                                   value="{{$prospect->last_name}}">
                                            @if ($errors->has('business_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('business_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="mobile">Secondary Phone
                                            Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                   value="{{$prospect->mobile}}">
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="reference">Service Request</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="reference" name="reference">
                                                <option value="">Select a service request</option>
                                                <option @if($prospect->reference=="Regular Cleaning") selected="selected"
                                                        @endif value="Regular Cleaning">Regular Cleaning
                                                </option>
                                                <option @if($prospect->reference=="Deep Cleaning") selected="selected"
                                                        @endif value="Deep Cleaning">Deep Cleaning
                                                </option>
                                                <option @if($prospect->reference=="Pressure Wash") selected="selected"
                                                        @endif value="Pressure Wash">Pressure Wash
                                                </option>
                                                <option @if($prospect->reference=="Waxing") selected="selected"
                                                        @endif value="Waxing">Waxing
                                                </option>
                                                <option @if($prospect->reference=="Carpet Cleaning") selected="selected"
                                                        @endif value="Carpet Cleaning">Carpet Cleaning
                                                </option>
                                                <option @if($prospect->reference=="Other") selected="selected"
                                                        @endif value="Other">Other
                                                </option>
                                            </select>
                                            @if ($errors->has('reference'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('reference') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('sq_footage') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="sq_footage">SQ Footage</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="sq_footage" name="sq_footage"
                                                   value="{{$prospect->sq_footage}}">
                                            @if ($errors->has('sq_footage'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('sq_footage') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('quote') ? ' has-error' : '' }}">
                                        <label class="col-sm-4 control-label" for="quote">Quote</label>
                                        <div class="col-sm-8">
                                            <input type="file" class=" file" id="quote" name="quote">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control" disabled>
                                                <span class="input-group-btn">
                                                                <button class="browse btn btn-primary" type="button">
                                                                    <img class="svg Green"
                                                                         src="{{URL::asset('assets/assets/Upload.svg')}}"
                                                                         alt="info" width="33"
                                                                         height="33"></button>
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <button type="submit" class="btn btn-default save">Save & Continue
                                    </button>
                                    <button type="reset" class="btn btn-default clear">Clear</button>
                                </div>
                            </form>

                        </div>
                        <!--/end tab-pane-->


                    </div>
                    <!--/end Card -->

                {{--<div class="card ">--}}
                {{--<div class="title">--}}
                {{--<h4 class="text-left">Prospect Details</h4>--}}
                {{--<h4 class="text-right" style="float:right;"><a id="addnewMeeting" href="#"--}}
                {{--@click.prevent="addNewMeeting"> Add New--}}
                {{--Meeting--}}
                {{--+ </a></h4>--}}
                {{--</div>--}}
                {{--<div class="content Scroll " style="min-height:300px;">--}}
                {{--<div class="col-xs-8 col-xs-offset-2">--}}
                {{--<div class="form-group">--}}
                {{--<label for="prospects">Prospects</label>--}}
                {{--<select name="prospects" id="prospects" class="form-control"--}}
                {{--@change="setProspect($event)">--}}
                {{--<option value="">Select a prospect</option>--}}
                {{--@foreach($prospects as $prospect)--}}
                {{--<option value="{{$prospect->id}}">{{$prospect->first_name}} {{$prospect->business_name}}</option>--}}
                {{--@endforeach--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<table class="table editable">--}}
                {{--<tr>--}}
                {{--<th>Meeting Date</th>--}}
                {{--<th>Description</th>--}}
                {{--</tr>--}}

                {{--<tr v-for="prospect_meeting in prospect_meetings">--}}
                {{--<td class="col-1">@{{ prospect_meeting.date }}</td>--}}
                {{--<td class="col-2">--}}
                {{--@{{ prospect_meeting.description }}--}}
                {{--</td>--}}
                {{--</tr>--}}
                {{--</table>--}}

                {{--</div>--}}
                {{--</div>--}}
                <!--/end card-->

                </div>
                <!--/end card-contener -->


            </div>
        </div>
        <!-- Modal -->
        {{--<div class="modal fade" id="meeting-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
        {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
        {{--<div class="modal-header">--}}
        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
        {{--aria-hidden="true">&times;</span></button>--}}
        {{--<h4 class="modal-title" id="myModalLabel">Add Meeting</h4>--}}
        {{--</div>--}}
        {{--<div class="modal-body">--}}
        {{--<div class="form-group">--}}
        {{--<label for="date">Meeting Date:</label>--}}
        {{--<input type="text" v-model="date" id="date" name="date" @blur="setDate($event)"--}}
        {{--class="form-control inputdate">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
        {{--<label for="description">Description:</label>--}}
        {{--<input type="text" v-model="description" id="description" name="description"--}}
        {{--class="form-control">--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="modal-footer">--}}
        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
        {{--<button type="button" @click="saveMeeting" class="btn btn-primary">Save changes</button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </section>

    <script type="text/javascript">
        {{--var data = {--}}
        {{--prospect_meetings: [],--}}
        {{--prospect_id: '',--}}
        {{--date: '',--}}
        {{--description: ''--}}
        {{--};--}}
        {{--var prospects = new Vue({--}}
        {{--data: data,--}}
        {{--el: '#prospects',--}}
        {{--methods: {--}}
        {{--setProspect: function (event) {--}}
        {{--var prospect_id = event.target.value;--}}
        {{--this.reloadMeetings(prospect_id);--}}
        {{--},--}}

        {{--reloadMeetings: function (prospect_id) {--}}
        {{--var $this = this;--}}
        {{--axios.post('{{URL::to('/sales/prospects/ajax-get-prospect-meetings')}}', {--}}
        {{--_token: '{{csrf_token()}}',--}}
        {{--prospect_id: prospect_id--}}
        {{--})--}}
        {{--.then(function (response) {--}}
        {{--$this.prospect_meetings = response.data.prospect_meetings;--}}
        {{--$this.prospect_id = prospect_id;--}}
        {{--})--}}
        {{--.catch(function (error) {--}}
        {{--console.log(error);--}}
        {{--});--}}
        {{--},--}}
        {{--saveMeeting: function () {--}}
        {{--var $this = this;--}}
        {{--console.log(this.date);--}}
        {{--axios.post('{{URL::to('/sales/prospects/ajax-post-prospect-meeting')}}', {--}}
        {{--_token: '{{csrf_token()}}',--}}
        {{--prospect_id: $this.prospect_id,--}}
        {{--date: $this.date,--}}
        {{--description: $this.description--}}

        {{--})--}}
        {{--.then(function (response) {--}}
        {{--$this.reloadMeetings(response.data.prospect_id);--}}
        {{--$('#meeting-modal').modal('hide');--}}
        {{--})--}}
        {{--.catch(function (error) {--}}
        {{--console.log(error);--}}
        {{--});--}}
        {{--},--}}
        {{--setDate: function (event) {--}}
        {{--this.date = event.target.value;--}}
        {{--},--}}
        {{--addNewMeeting: function () {--}}
        {{--if (this.prospect_id == '') {--}}
        {{--alert('Please select a prospect');--}}
        {{--} else {--}}
        {{--$('#meeting-modal').modal('show');--}}
        {{--}--}}
        {{--}--}}
        {{--}--}}
        {{--});--}}
    </script>
@endsection