@extends('layouts.common')

@section('content')
    @include('layouts.headers.sales')
    <section class="page-content dashbord" id="prospect-details">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Prospects Details</h3>
                </div>
                <div class="col-xs-12 col-sm-4">

                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('sales/prospect-details')}}">Prospect Details</a></li>
                            <li><a href="{{URL::to('sales/prospects')}}">Add New Prospects</a></li>
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
                        <div class="content Scroll" style="min-height:400px;">
                            <table class="table selectable cleaner-table">

                                <tr>
                                    <th>Name</th>
                                    <th>Business Name</th>
                                    <th>Address</th>
                                    <th>Telephone</th>
                                    <th>Service Request</th>
                                    <th>Status</th>
                                    <th>Updated Date</th>
                                    <th></th>
                                    <th>Edit</th>
                                    <th>Add meeting</th>
                                </tr>
                                @foreach($prospects as $prospect)
                                    <tr @click="setProspect({{$prospect->id}})">
                                        <td class="col-1">{{$prospect->first_name}}</td>
                                        <td class="col-1">{{$prospect->last_name}}</td>
                                        <td class="col-2">{{$prospect->address}}</td>
                                        <td class="col-3">{{$prospect->telephone}}</td>
                                        <td class="col-4">{{$prospect->reference}}</td>
                                        <td class="col-4">{{$prospect->status}}</td>
                                        <td class="col-4">{{$prospect->updated_at}}</td>
                                        <td class="col-5">
                                            <img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}"
                                                 alt="info"
                                                 width="33"
                                                 height="33"></td>
                                        <td>
                                            <a href="{{URL::to('sales/edit-prospect/'.$prospect->id)}}"
                                               class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{URL::to('sales/add-prospect-meeting/'.$prospect->id)}}"
                                               class="btn btn-success">Add meeting</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!--/end tab-pane-->
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card cleanerdetails">
                        <div class="title">
                            <h4>Prospect Meetings</h4>
                        </div>
                        <div class="content Scroll" style="min-height:300px;">
                            <table class="table" id="print">
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                </tr>
                                <tr v-for="prospect_meeting in prospect_meetings">
                                    <td class="col-2">@{{ prospect_meeting.date}}</td>
                                    <td class="col-2">@{{ prospect_meeting.description}}</td>
                                </tr>
                            </table>
                        </div>
                        <button style="margin-right: 15px; margin-bottom: 15px;" class="btn btn-primary pull-right"
                                type="button" onclick="PrintElem('print')">Print
                        </button>
                        <!--/end content -->
                    </div>
                </div>
                <!--/end card-contener -->

            </div>
        </div>

    </section>

    <script>
        var data = {
            prospects: {!! json_encode($prospects) !!},
            prospect_meetings: []
        };

        var prospect_details = new Vue({
            el: '#prospect-details',
            data: data,
            methods: {
                setProspect: function (prospect_id) {
                    var selected_prospect = this.prospects.filter(function (prospect) {
                        return prospect_id == prospect.id;
                    });

                    this.prospect_meetings = selected_prospect[0].meetings;
                }
            }
        });

    </script>
@endsection