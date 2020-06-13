@extends('layouts.common')
@section('content')
    @include('layouts.headers.complaints')
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
                <!--/end card-contener -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card form-card">
                        <div class="title">
                            <h4>Complaints-Detailed View</h4>
                        </div>
                        <?php
//                        dd($media);
                        ?>
                        <div class="content" style="overflow:visible;height:530px;"> 
                            <form id="create-new-cleaner" method="post" class="form-horizontal"
                                  onsubmit="return false;">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="InputComment">Complaint</label>
                                        <div class="col-sm-10 ">
                                            <div class="comment-box Scroll">
                                                {{ $complaint->complaint }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="InputComment">Client</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{ $client->name }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="InputComment">Task Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{ $task->name }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="InputComment">Inspector</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{ $inspector->first_name }} {{ $inspector->last_name }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="InputComment">Complaint
                                            Images</label>
                                        <div class="col-sm-8">
                                            <a v-for="image in images">
                                                <img style="width: 30%; max-height: 172px; float: left; margin-bottom: 20px; margin-right: 3%" :src="image.path" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="InputComment">Complaint
                                            Audio</label>
                                        <div class="col-sm-8">
                                            <audio v-for="audio in audios" controls :src="audio.path"></audio>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                    <button type="button" class="btn btn-default clear" @click="endFollowup">Complaint
                                        Fixed
                                    </button>
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
    <script type="text/javascript">
        var data = {
            complaints: {!! json_encode($complaint) !!},
            complaint: {clients_name: ''},
            selected_complaints: [],
            complaint_followups: [],
            followup_comment: '',
            description: '',
            date: '',
            upload: '',
            complaint_id: {{ $complaint->id }},
            start_date: '',
            start_time: '',
            end_date: '',
            end_time: '',
            cleaner: '',
            client: '',
            inspector: '',
            image_path: '',
            images: {!! json_encode($media) !!},
            audios: {!! json_encode($audios) !!},
            videos: [],
        };

        window.addEventListener('load', function () {
            var complaints = new Vue({
                el: '#complaints',
                data: data,
                mounted: function () {
                    var vm = this;
                },
                methods: {
                    endFollowup: function () {
                        var $this = this;
                        axios.post('{{URL::to('/complaints/ajax-end-complaint-followups')}}', {
                            _token: '{{csrf_token()}}',
                            complaint_id: this.complaint_id
                        }).then(function (response) {
                            if (response.data.message == 'Success') {
                                window.location.href = '{{URL::to('/complaints')}}';
                            }
                        }).catch(function (error) {
                            console.log(error);
                        });
                    },
                    setUpload: function (variable, event) {
                        this.upload = event.target.files[0];
                    },
                    editSchedule: function (complaint_id) {
                        var selected_complaint = this.complaints.filter(function (complaint) {
                            return complaint_id == complaint.id;
                        });

                        this.complaint_id = selected_complaint[0].id;
                        jQuery('#assign-task').modal('show');
                    },
                    setInspector: function (event) {
                        this.complaints.forEach(function (complaint) {
                            complaint.selected = false;
                        });
                        this.inspector = event.target.value;
                        var inspector = this.inspector;
                        var selected_complaints = this.complaints.filter(function (complaint) {
                            return complaint.inspector_id == inspector;
                        });

                        selected_complaints.forEach(function (complaint) {
                            complaint.selected = true;
                        });
                        this.selected_complaints = selected_complaints;
                    },
                    openImage: function (images) {
                        this.images = images;
                        jQuery('#image').modal('show');
                    }
                }
            });

            jQuery('#image').on('shown.bs.modal', function (e) {
                var slider = jQuery('#image-slider');
                if (slider.hasClass('slick-slider')) {
                    slider.slick('unslick');
                }
                slider.slick({
                    arrows: true,
                    dots: true,
                    autoplay: true,
                    autoplaySpeed: 4000,
                    fade: true,
                    speed: 2000
                });
            });
        });
    </script>
@endsection