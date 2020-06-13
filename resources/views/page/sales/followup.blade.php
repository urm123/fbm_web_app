@extends('layouts.common')

@section('content')
    @include('layouts.headers.sales')
    <section class="page-content dashbord" id="followups">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Followup</h3>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">

                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card">
                        <div class="title">
                            <h4 class="text-left">Followup Details</h4>
                            {{--<h4 class="text-right" style="float:right;"><a href="{{URL::to('sales/followup/add-new')}}">--}}
                            {{--New--}}
                            {{--Followup + </a></h4>--}}
                        </div>


                        <div class="content Scroll" style="min-height:300px;">

                            <table class="table selectable">

                                <tr>
                                    <th>Followup Date</th>
                                    <th>Client Name</th>
                                    <th>Service Request</th>
                                    <th>Prospect Status</th>
                                    <th>Last Updated On</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr v-for="followup in followups" @click="setFollowup(followup.id)"
                                    :class="{ended:followup.status=='ENDED'}">
                                    <td class="col-1">@{{followup.date}}</td>
                                    <td class="col-2">@{{followup.first_name}} @{{followup.last_name}}</td>
                                    <td class="col-3">@{{followup.reference}}</td>
                                    <td class="col-4">@{{followup.status}}</td>
                                    <td class="col-6">@{{followup.updated_at}}</td>
                                    <td class="col-7">
                                        <img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}"
                                             alt="info"
                                             width="33" height="33">
                                    </td>
                                    <td><a :href="'{{URL::to('sales/edit-followup/')}}/'+followup.id"
                                           class="btn btn-success">Edit</a></td>
                                    <td>
                                        <button type="button" @click.prevent="closeFollowup(followup.id)"
                                                class="btn btn-danger">
                                            Close Followup
                                        </button>
                                    </td>
                                </tr>
                            </table>

                        </div>
                        <!--/end tab-pane-->


                    </div>
                    <!--/end Card -->

                    <div class="card">
                        <div class="title">
                            <h4 class="text-left">Followup - Detailed View</h4>
                        </div>
                        <div class="content " style="min-height:500px;overflow:visible;">

                            <form id="create-new-cleaner" method="post" class="form-horizontal" action=""
                                  onsubmit="return false">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="InputComment">Comment History</label>
                                        <div class="col-sm-10 ">

                                            <div class="comment-box Scroll">
                                                <div>
                                                    <table v-for="followup_comment in followup_comments">
                                                        <tr>
                                                            <td class="msg">
                                                                @{{ followup_comment.comment }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="info">Updated @{{ followup_comment.date }} by
                                                                @{{ followup_comment.created_by }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="CustomerName">Customer Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="CustomerName"
                                                   placeholder="Paramount" :value="followup.client"
                                                   disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="date">Date</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control inputdate" id="date" v-model="date">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="description">Description</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="description"
                                                   v-model="description">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="InputCreatedby">Created by</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="InputCreatedby"
                                                   value="{{Auth::user()->name}}" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="upload">Upload Document</label>
                                        <div class="col-sm-8">
                                            <input type="file" class=" file" id="upload" @change="setUpload(0,$event)">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control" disabled>
                                                <span class="input-group-btn">
                <button class="browse btn btn-primary" type="button">
                <img class="svg Green"
                     src="{{URL::asset('assets/assets/Upload.svg')}}"
                     alt="info"
                     width="33" height="33"></button>
                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="comment">Comment</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="comment"
                                                   v-model="followup_comment">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <button type="submit" class="btn btn-default save" @click.prevent="saveFollowup()">
                                        Save &
                                        Continue
                                    </button>
                                    <button type="reset" class="btn btn-default clear">Clear</button>
                                    <button type="reset" class="btn btn-default clear" @click.prevent="endFollowup()">
                                        End Followup
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!--/end card-->

                </div>
                <!--/end card-contener -->


            </div>
        </div>

    </section>
    <script type="text/javascript">
        var data = {
            followups: {!! json_encode($followups) !!},
            followup: {client: ''},
            followup_comments: [],
            followup_comment: '',
            description: '',
            date: '',
            upload: ''
        };

        var followups = new Vue({
            el: '#followups',
            data: data,
            methods: {
                closeFollowup: function (followup_id) {
                    var $this = this;
                    axios.post('{{URL::to('/sales/ajax-close-followup')}}', {
                        _token: '{{csrf_token()}}',
                        followup_id: followup_id
                    })
                        .then(function (response) {
                            if (response) {
                                alert('Followup closed!')
                            }
                            $this.loadFollowups();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                setFollowup: function (followup_id) {
                    var selected_followup = this.followups.filter(function (followup) {
                        return followup_id == followup.id;
                    });

                    this.followup = selected_followup[0];

                    this.followup.client = selected_followup[0].last_name;

                    var $this = this;

                    this.loadFollowups(selected_followup[0].id);
                },

                saveFollowup: function () {
                    var $this = this;
                    var form_data = new FormData();

                    form_data.append('_token', '{{csrf_token()}}');
                    form_data.append('prospect_id', $this.followup.id);
                    form_data.append('comment', $this.followup_comment);
                    form_data.append('description', $this.description);
                    form_data.append('date', $this.date);
                    form_data.append('upload', $this.upload);
                    axios.post('{{URL::to('/sales/prospect/save-comment')}}', form_data)
                        .then(function (response) {
                            $this.loadFollowups(response.data.followup_comment.followup_id);
                            $this.followup.updated_at = response.data.followup_comment.updated_at;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },

                endFollowup: function () {
                    var $this = this;
                    axios.post('{{URL::to('/sales/prospect/end')}}', {
                        _token: '{{csrf_token()}}',
                        prospect_id: $this.followup.id
                    })
                        .then(function (response) {
                            if (response.data.message == 'Success') {
                                window.location.href = '{{URL::to('/sales/followup')}}';
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },

                loadFollowups: function (followup_id) {
                    var $this = this;

                    axios.post('{{URL::to('/sales/ajax-get-followups')}}', {
                        _token: '{{csrf_token()}}',
                    })
                        .then(function (response) {
                            $this.followups = response.data.followups;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    axios.get('{{URL::to('sales/prospect/comment')}}/' + followup_id).then(function (response) {
                        $this.followup_comments = response.data.comments;
                    }).catch(function (error) {
                        console.log(error);
                    });
                },
                // setUpload: function (variable, event) {
                //     this.upload = event.target.files[0];
                // }
            }
        });
    </script>
@endsection