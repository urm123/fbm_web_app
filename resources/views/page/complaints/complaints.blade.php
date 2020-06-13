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
                <div class="col-xs-12">
                    <div class="col-xs-12 col-sm-4" style="padding:15px;">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="cleaner">Cleaner:</label>
                            <div class="col-sm-8" style="margin-bottom:15px;">
                                <select class="form-control" id="cleaner"
                                        v-model="cleaner" @change="setCleaner($event)">
                                    <option value="">Select a cleaner</option>
                                    @foreach($cleaners as $cleaner)
                                        <option value="{{$cleaner->id}}">{{$cleaner->first_name}} {{$cleaner->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4" style="padding:15px;">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="client">Client:</label>
                            <div class="col-sm-8" style="margin-bottom:15px;">
                                <select class="form-control" id="client"
                                        v-model="client" @change="setClient($event)">
                                    <option value="">Select a client</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4" style="padding:15px;">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="inspector">Inspector:</label>

                            <div class="col-sm-8" style="margin-bottom:15px;">
                                <select class="form-control" id="inspector"
                                        v-model="inspector" @change="setInspector($event)">
                                    <option value="">Select a inspector</option>
                                    @foreach($inspectors as $inspector)
                                        <option value="{{$inspector->id}}">{{$inspector->first_name}} {{$inspector->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card ">
                        <div class="title">
                            <h4 class="text-left">Complaints Overview</h4>
                            <h4 class="text-right" style="float:right;"><a href="{{URL::to('/complaints/add-new')}}">New Complaints + </a></h4>
                        </div>
                        <div class="content Scroll " style="min-height:400px;padding:7px;">
                            <table class="table selectable">
                                <tr>
                                    {{--<th>Due Date</th>--}}
                                    {{--<th>Type</th>--}}
                                    <th>Client</th>
                                    <th>Complaint Date</th>
{{--                                    <th>Complaint</th>--}}
                                    <th>Cleaner</th>
                                    <th>Last Updated</th>
                                    {{--<th></th>--}}
                                    <th>Status</th>
                                    <th></th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                <tr v-for="complaint in selected_complaints" @click="setComplaint(complaint.id)">
                                    {{--<td class="col-1">@{{complaint.date}}</td>--}}
                                    {{--<td class="col-2">@{{complaint.type}}</td>--}}
                                    <td class="col-3">@{{complaint.client_first_name}}</td>
                                    <td class="col-4">@{{complaint.date}}</td>
{{--                                    <td class="col-5">@{{complaint.complaint}}</td>--}}
                                    <td class="col-6">@{{complaint.cleaners_first_name}}
                                        @{{complaint.cleaners_last_name}}
                                    </td>
                                    <td class="col-8">@{{complaint.updated_at}}</td>
                                    <td class="col-8">
                                        <label class="label label-danger"
                                               v-if="complaint.status=='Pending'">@{{ complaint.status }}</label>
                                        <label class="label label-success"
                                               v-if="complaint.status=='Approved By Admin'">@{{ complaint.status
                                            }}</label>
                                        <label class="label label-warning"
                                               v-if="complaint.status!='Pending'&&complaint.status!='Approved By Admin'">@{{
                                            complaint.status }}</label>
                                    </td>
                                    {{--<td>--}}
                                    {{--<button class="btn btn-primary" @click.prevent="editSchedule(complaint.id)">--}}
                                    {{--Schedule--}}
                                    {{--</button>--}}
                                    {{--</td>--}}
                                    <td class="col-9">
                                        <img class="svg Green" src="{{URL::asset('assets/assets/info.svg')}}"
                                             alt="info" width="33" height="33"></td>
                                    <td>
                                        <a :href="'{{URL::to('complaints')}}/'+complaint.id+'/edit'"
                                           class="btn btn-success">Edit
                                        </a>
                                        <a :href="'{{URL::to('complaints')}}/'+complaint.id+'/view'"
                                           class="btn btn-warning">View
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" @click="deleteComplaint(complaint.id)">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--/end tab-pane-->
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
{{--                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">--}}
{{--                    <div class="card form-card">--}}
{{--                        <div class="title">--}}
{{--                            <h4>Complaints-Detailed View</h4>--}}
{{--                        </div>--}}
{{--                        <div class="content" style="overflow:visible;height:530px;">--}}
{{--                            <form id="create-new-cleaner" method="post" class="form-horizontal"--}}
{{--                                  onsubmit="return false;">--}}
{{--                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-sm-2 control-label" for="InputComment">Complaint</label>--}}
{{--                                        <div class="col-sm-10 ">--}}

{{--                                            <div class="comment-box Scroll">--}}
{{--                                                <div>--}}
{{--                                                    <table v-for="followup_comment in complaint_followups">--}}
{{--                                                        <tr>--}}
{{--                                                            <td class="msg">--}}
{{--                                                                @{{ followup_comment.comment }}--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <td class="info">Updated @{{ followup_comment.date }} by--}}
{{--                                                                @{{ followup_comment.created_by }}--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                    </table>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-sm-2 control-label" for="InputComment">Complaint--}}
{{--                                            Images</label>--}}
{{--                                        <div class="col-sm-10 ">--}}
{{--                                            <a v-for="image in complaint.images" href="#"--}}
{{--                                               @click.prevent="openImage(complaint.images)">--}}
{{--                                                <img style="width: 30%; max-height: 172px; float: left; margin-bottom: 20px; margin-right: 3%"--}}
{{--                                                     :src="image.path" alt="">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-sm-2 control-label" for="InputComment">Complaint--}}
{{--                                            Audio</label>--}}
{{--                                        <div class="col-sm-10 ">--}}
{{--                                            <audio v-for="audio in complaint.audios" controls :src="audio.path"></audio>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-sm-2 control-label" for="InputComment">Complaint--}}
{{--                                            Vidoes</label>--}}
{{--                                        <div class="col-sm-10 ">--}}
{{--                                            <video controls v-for="video in complaint.videos" :src="video.path"></video>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-sm-2 control-label" for="InputComment">Cleaner Images</label>--}}
{{--                                        <div class="col-sm-10 ">--}}
{{--                                            <a v-for="cleaner_image in complaint.cleaner_images" href="#"--}}
{{--                                               @click.prevent="openImage(complaint.cleaner_images)">--}}
{{--                                                <img style="width: 30%; float: left; max-height: 172px; margin-bottom: 20px; margin-right: 3%"--}}
{{--                                                     :src="cleaner_image.path" alt="">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-sm-4 control-label" for="date">Date</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                <input type="text" class="form-control inputdate" id="date"--}}
{{--                                                       v-model="date">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-sm-4 control-label" for="description">Description</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                <input type="text" class="form-control" id="description"--}}
{{--                                                       v-model="description">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-sm-4 control-label" for="comment">Comment</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                <input type="text" class="form-control" id="comment"--}}
{{--                                                       v-model="followup_comment">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-sm-4 control-label" for="InputCreatedby">Created--}}
{{--                                                by</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                <input type="text" class="form-control" id="InputCreatedby"--}}
{{--                                                       value="{{Auth::user()->name}}" disabled="disabled">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-sm-4 control-label" for="upload">Upload Document</label>--}}
{{--                                            <div class="col-sm-8">--}}
{{--                                                <input type="file" class=" file" id="upload"--}}
{{--                                                       @change="setUpload(0,$event)">--}}
{{--                                                <div class="input-group col-xs-12">--}}
{{--                                                    <input type="text" class="form-control" disabled>--}}
{{--                                                    <span class="input-group-btn">--}}
{{--                                                        <button class="browse btn btn-primary" type="button" style="margin: 0">--}}
{{--                                                        <img class="svg Green"--}}
{{--                                                             src="{{URL::asset('assets/assets/Upload.svg')}}" alt="info" width="33" height="33">--}}
{{--                                                        </button>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                    <button type="submit" class="btn btn-default save" @click.prevent="saveFollowup()">--}}
{{--                                        Save Followup--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-default clear" @click="endFollowup">Complaint--}}
{{--                                        Fixed--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <!--/end tab-pane-->--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!--/end card-contener -->
            </div>
        </div>

        <div class="modal fade" id="assign-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Assign Schedule for Complaint Task</h4>
                    </div>
                    <form @submit.prevent="saveSchedule()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="start-date">Start Date:</label>
                                <input type="text" class="form-control inputdate" placeholder="Start Date"
                                       v-model="start_date" @blur="setStartDate($event)">
                            </div>
                            <div class="form-group">
                                <label for="start-date">End Date:</label>
                                <input type="text" class="form-control inputdate" placeholder="End Date"
                                       v-model="end_date" @blur="setEndDate($event)">
                            </div>
                            <div class="form-group">
                                <label for="start-date">Start Time:</label>
                                <input type="text" class="form-control inputtime" placeholder="Start Time"
                                       v-model="start_time" @blur="setStartTime($event)">
                            </div>
                            <div class="form-group">
                                <label for="start-date">End Time:</label>
                                <input type="text" class="form-control inputtime" placeholder="End Time"
                                       v-model="end_time" @blur="setEndTime($event)">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click.prevent="editComplaint">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="image" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Image</h4>
                    </div>
                    <div class="modal-body">
                        <div id="image-slider">
                            <img v-for="image in images" :src="image.path" alt="" class="img-responsive"
                                 style="margin: auto;">

                        </div>
                        <div>

                            <audio controls v-for="audio in audios" :src="audio.path"></audio>

                        </div>

                        <div>

                            <video controls v-for="video in videos" :src="video.path"></video>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script type="text/javascript">
        var data = {
            complaints: {!! json_encode($complaints) !!},
            complaint: {clients_name: ''},
            selected_complaints: [],
            complaint_followups: [],
            followup_comment: '',
            description: '',
            date: '',
            upload: '',
            complaint_id: 0,
            start_date: '',
            start_time: '',
            end_date: '',
            end_time: '',
            cleaner: '',
            client: '',
            inspector: '',
            image_path: '',
            images: [],
            audios: [],
            videos: [],
        };

        window.addEventListener('load', function () {
            var complaints = new Vue({
                el: '#complaints',
                data: data,
                mounted: function () {
                    var vm = this;

                    this.selected_complaints = this.complaints;

                    jQuery('#cleaner').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.$emit('input', this.value);
                        vm.cleaner = this.value;
                        vm.setCleaner(event);
                    });
                    jQuery('#inspector').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.inspector = this.value;
                        vm.$emit('input', this.value);
                        vm.setInspector(event);
                    });
                    jQuery('#client').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.client = this.value;
                        vm.$emit('input', this.value);
                        vm.setClient(event);
                    });
                },
                methods: {
                    setComplaint: function (complaint_id) {
                        var selected_complaint = this.complaints.filter(function (complaint) {
                            return complaint_id == complaint.id;
                        });

                        this.complaint = selected_complaint[0];

                        this.complaint.clients_name = selected_complaint[0].client_first_name;

                        this.loadFollowups(selected_complaint[0].id);
                    },
                    editComplaint: function () {
                        var post_data = {
                            complaint_id: this.complaint_id,
                            start_date: this.start_date,
                            start_time: this.start_time,
                            end_date: this.end_date,
                            end_time: this.end_time,
                        };

                        axios.post('{{URL::to('complaints/ajax-assign-schedule')}}', post_data)
                            .then(function (response) {
                                console.log(response);
                                if (response.data) {
                                    jQuery('#assign-task').modal('hide');
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            })
                    },
                    saveFollowup: function () {
                        var $this = this;
                        var form_data = new FormData();

                        form_data.append('_token', '{{csrf_token()}}');
                        form_data.append('complaint_id', $this.complaint.id);
                        form_data.append('comment', $this.followup_comment);
                        form_data.append('description', $this.description);
                        form_data.append('date', $this.date);
                        form_data.append('upload', $this.upload);
                        axios.post('{{URL::to('/complaints/ajax-save-complaint-followups')}}', form_data)
                            .then(function (response) {
                                $this.loadFollowups(response.data.complaint_followup.complaint_id);
                                $this.complaint.updated_at = response.data.complaint_followup.updated_at;
                                window.location.href = '{{URL::to('/complaints')}}';
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    },
                    endFollowup: function () {
                        var $this = this;
                        axios.post('{{URL::to('/complaints/ajax-end-complaint-followups')}}', {
                            _token: '{{csrf_token()}}',
                            complaint_id: $this.complaint.id
                        })
                            .then(function (response) {
                                if (response.data.message == 'Success') {
                                    window.location.href = '{{URL::to('/complaints')}}';
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    },
                    loadFollowups: function (complaint_id) {
                        var $this = this;

                        axios.post('{{URL::to('/complaints/ajax-get-complaint-followups')}}', {
                            _token: '{{csrf_token()}}',
                            complaint_id: complaint_id,
                        })
                            .then(function (response) {
                                $this.complaint_followups = response.data.complaint_followups;
                            })
                            .catch(function (error) {
                                console.log(error);
                            });

                        axios.get('{{URL::to('/complaints/followup')}}', {
                            _token: '{{csrf_token()}}',
                            complaint_id: complaint_id,
                        })
                            .then(function (response) {
                                $this.complaint_followups = response.data.complaint_followups;
                            })
                            .catch(function (error) {
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
                    setStartDate: function (event) {
                        this.start_date = event.target.value;
                    },
                    setStartTime: function (event) {
                        this.start_time = event.target.value;
                    },
                    setEndDate: function (event) {
                        this.end_date = event.target.value;
                    },
                    setEndTime: function (event) {
                        this.end_time = event.target.value;
                    },
                    setCleaner: function (event) {
                        this.complaints.forEach(function (complaint) {
                            complaint.selected = false;
                        });
                        this.cleaner = event.target.value;
                        var cleaner = this.cleaner;
                        var selected_complaints = this.complaints.filter(function (complaint) {
                            return complaint.cleaner_id == cleaner;
                        });

                        selected_complaints.forEach(function (complaint) {
                            complaint.selected = true;
                        });
                        this.selected_complaints = selected_complaints;
                    },
                    setClient: function (event) {
                        this.complaints.forEach(function (complaint) {
                            complaint.selected = false;
                        });
                        this.client = event.target.value;
                        var client = this.client;
                        var selected_complaints = this.complaints.filter(function (complaint) {
                            return complaint.client_id == client;
                        });

                        selected_complaints.forEach(function (complaint) {
                            complaint.selected = true;
                        });
                        this.selected_complaints = selected_complaints;
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
                    },
                    deleteComplaint: function (id) {
                        var confirm = window.confirm('Are you sure you want to delete this complaint?');

                        if (!confirm) {
                            return false;
                        }

                        var $this = this;
                        axios.post('{{URL::to('/complaints/delete')}}', {
                            _token: '{{csrf_token()}}',
                            complaint_id: id
                        })
                            .then(function (response) {
                                if (response.data.message == 'Success') {
                                    alert('Deleted Successfully!');
                                    window.location.href = '{{URL::to('/complaints')}}';
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
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