@extends('layouts.common')

@section('content')
    @include('layouts.headers.client-followups')
    <section class="page-content dashbord" id="client_followups">
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
                    <div class="card form-card">
                        <div class="title">
                            <h4>Client Followups Detailed View</h4>
                        </div>
                        <div class="content" style="overflow:visible;height:530px;">
                            <form id="create-new-cleaner" method="post" class="form-horizontal" onsubmit="return false;">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <a class="btn btn-success btn-xs" id="scrollFollowup" style="margin-bottom: 5px;float: right;">+</a>
                                        </div>
                                        <label class="col-sm-2 control-label" for="InputComment">Comment History</label>
                                        <div class="col-sm-10">
                                            <div class="comment-box Scroll" id="commentBox">
                                                <div>
                                                    <table v-for="client_followup_comment in client_followup_comments">
                                                        <tr>
                                                            <td class="msg">
                                                                @{{ client_followup_comment.comment }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="info">
                                                                Updated @{{ client_followup_comment.date }}
                                                                by
                                                                @{{ client_followup_comment.created_by }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="btn-panel">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label" for="CustomerName">Customer Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="CustomerName"
                                                       placeholder="Paramount" :value="client_followup.client_name" disabled="disabled">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="date">Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control inputdate" required="true" id="date" v-model="date" @blur="setDate($event)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="comment">Comment</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="comment" v-model="followup_comment" required="true"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    {{--                                    <div class="form-group">--}}
    {{--                                        <label class="col-sm-4 control-label" for="InputCreatedby">Created by</label>--}}
    {{--                                        <div class="col-sm-8">--}}
    {{--                                            <input type="text" class="form-control" id="InputCreatedby" value="{{Auth::user()->name}}" disabled="disabled">--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="form-group">--}}
    {{--                                        <label class="col-sm-4 control-label" for="upload">Upload Document</label>--}}
    {{--                                        <div class="col-sm-8">--}}
    {{--                                            <input type="file" class=" file" id="upload" @change="setUpload(0,$event)">--}}
    {{--                                            <div class="input-group col-xs-12">--}}
    {{--                                                <input type="text" class="form-control" disabled>--}}
    {{--                                                <span class="input-group-btn">--}}
    {{--                                                    <button class="browse btn btn-primary" type="button">--}}
    {{--                                                        <img class="svg Green" src="{{URL::asset('assets/assets/Upload.svg')}}"--}}
    {{--                                                             alt="info" width="33" height="33"></button>--}}
    {{--                                                </span>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                        <button type="submit" class="btn btn-default save" @click="saveFollowup">Save & Continue</button>
    {{--                                    <a type="reset" class="btn btn-default clear" href="{{URL::to('/complaints/add-new')}}">--}}
    {{--                                        Create a complaint--}}
    {{--                                    </a>--}}
                                        <button type="reset" class="btn btn-default clear" @click="endFollowup">End Followup</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/end tab-pane-->
                    </div>
                </div>
                <!--/end card-contener -->
            </div>
        </div>
    </section>
    <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">

        var scrolled = 0;
        $(document).ready(function(){

            $("#scrollFollowup").on("click" ,function(){
                scrolled = scrolled + 70;
                $("#mCSB_1").animate({
                    scrollTop: scrolled
                });
            });
        });

        var data = {
            client_followups: {!! json_encode($client_followups) !!},
            followup_id: {!! json_encode($followup_id) !!},
            client_followup: {clients_name: ''},
            client_followup_comments: [],
            followup_comment: '',
            description: '',
            date: '',
            upload: ''
        };

        var client_followups = new Vue({
            el: '#client_followups',
            data: data,
            mounted: function () {

                var client_followup_id = data.followup_id;
                var selected_client_followup = this.client_followups.filter(function (client_followup) {
                    return client_followup_id == client_followup.client_followup_id;
                });

                if(selected_client_followup[0].status == "ENDED"){
                    $("#btn-panel").hide();
                    $("#commentBox").css('height', '350px');
                }

                this.client_followup = selected_client_followup[0];
                this.client_followup.clients_name = selected_client_followup[0].client_first_name;
                this.loadFollowups(selected_client_followup[0].id, selected_client_followup[0].status);
                this.followup_comment = '';
            },
            methods: {
                saveFollowup: function () {

                    if (this.client_followup.client_followup_id) {
                        var $this = this;
                        var form_data = new FormData();

                        if($this.followup_comment != '' && $this.date != '') {
                            form_data.append('_token', '{{csrf_token()}}');
                            form_data.append('client_followup_id', $this.client_followup.client_followup_id);
                            form_data.append('comment', $this.followup_comment);
                            form_data.append('description', $this.description);
                            form_data.append('date', $this.date);
                            form_data.append('upload', $this.upload);
                            form_data.append('task_id', $this.client_followup.task_id);
                            axios.post('{{URL::to('/client-followups/ajax-save-client-followup-comments')}}', form_data).then(function (response) {
                                $this.loadFollowups(response.data.client_followup_comment.client_followup_id);
                                $this.client_followup.updated_at = response.data.client_followup_comment.updated_at;
                                $this.followup_comment = '';
                            }).catch(function (error) {
                                console.log(error);
                            });
                        }
                    } else {
                        alert('Please select a followup to add  details');
                    }
                },
                endFollowup: function () {
                    var $this = this;
                    axios.post('{{URL::to('/client-followups/ajax-end-client-followup')}}', {
                        _token: '{{csrf_token()}}',
                        client_followup_id: $this.client_followup.client_followup_id,
                        task_id: $this.client_followup.task_id
                    }).then(function (response) {
                        if (response.data.message == 'Success') {
                            window.location.href = '{{URL::to('/client-followups')}}';
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                },
                loadFollowups: function (client_followup_id, follow_up_status) {
                    var $this = this;

                    axios.post('{{URL::to('/client-followups/ajax-get-client-followup-comments')}}', {
                        _token: '{{csrf_token()}}',
                        client_followup_id: client_followup_id,
                        task_id: $this.client_followup.task_id
                    }).then(function (response) {
                        $this.client_followup_comments = response.data.client_followup_comments;
                        // if(response.data.client_followup_comments.length <= 5 && follow_up_status == 'ENDED'){
                        //     $("#scrollFollowup").hide();
                        // }
                        // var div = $('.mCSB_draggerContainer').is(":visible");

                        // var hasHorizontalScrollbar = div.scrollWidth > div.clientWidth;
                        // var hasVerticalScrollbar = div.scrollHeight > div.clientHeight;
                        // console.log(div);

                    }).catch(function (error) {
                        console.log(error);
                    });
                },
                setUpload: function (variable, event) {
                    this.upload = event.target.files[0];
                },
                setDate: function (event) {
                    this.date = event.target.value;
                },
                createTicket: function () {
                    var $this = this;
                    axios.post('{{URL::to('/client-followups/ajax-create-ticket')}}', {
                        _token: '{{csrf_token()}}',
                        client_followup_id: $this.client_followup.client_followup_id,
                        task_id: $this.client_followup.task_id
                    }).then(function (response) {
                        if (response.data.message == 'Success') {
                            window.location.href = '{{URL::to('/client-followups')}}';
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            }
        });
    </script>
@endsection