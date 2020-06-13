@extends('layouts.common')

@section('content')
    @include('layouts.headers.reports')

    <section class="page-content dashbord" id="store">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Complaints</h3>
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

                    <div class="card">
                        <div class="title">
                            <h4 class="text-left">Complaint Report</h4>
                        </div>


                        <div class="content" style="overflow:visible;min-height:1150px;">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="from_date">From Date:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <input type="text" class="form-control inputdate" id="from_date"
                                               v-model="from_date" @blur="setFromValue($event)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="to_date">To Date:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <input type="text" class="form-control inputdate" id="to_date"
                                               v-model="to_date" @blur="setToValue($event)">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="cleaner">Cleaner:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="cleaner"
                                                v-model="cleaner" @change="setCleaner($event)">
                                            <option value="">Select a cleaner</option>
                                            @foreach($cleaners as $cleaner)
                                                <option value="{{$cleaner->id}}">{{$cleaner->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
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
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="inspector">Inspector:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="inspector"
                                                v-model="inspector" @change="setInspector($event)">
                                            <option value="">Select a inspector</option>
                                            @foreach($inspectors as $inspector)
                                                <option value="{{$inspector->id}}">{{$inspector->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding:15px;">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label" for="inspector">Status:</label>

                                    <div class="col-sm-8" style="margin-bottom:15px;">
                                        <select class="form-control" id="status"
                                                v-model="status" @change="setStatus($event)">
                                            <option value="">Select a status</option>
                                            <option value="false">Pending</option>
                                            <option value="true">Resolved</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"
                                 style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px;">
                                <div class="form-group">
                                    <div class="col-sm-12">

                                        <div class="Preview Scroll">

                                            <div class="page">
                                                <table class="table table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Client</th>
                                                        <th>Complaint</th>
                                                        <th>Task & Task Items</th>
                                                        <th>Cleaner</th>
                                                        <th>Inspector</th>
                                                        <th>Time</th>
                                                        <th>Status</th>
                                                        <th>Image</th>
                                                        <th>Audio</th>
                                                        <th>Video</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="complaint in complaints">
                                                        <td>@{{complaint.client}}</td>
                                                        <td>@{{complaint.complaint}}
                                                        </td>
                                                        <td>
                                                            {{--<span v-if="complaint.task">@{{ complaint.task.name }}</span>--}}
                                                            <ul style="padding: 0; margin: 0;" v-if="complaint.task">
                                                                <li v-for="task_item in complaint.task.task_items">
                                                                    @{{ task_item.name }}
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>@{{complaint.cleaner}}</td>
                                                        <td>@{{complaint.inspector}}</td>
                                                        <td>@{{complaint.date}}</td>
                                                        <td>@{{complaint.status}}</td>
                                                        <td><a v-if="complaint.images.length>0" href="#"
                                                               @click.prevent="showImage(complaint.id)"
                                                               class="btn btn-sm btn-primary">
                                                                Image</a></td>
                                                        <td><a v-if="complaint.audio.length>0" href="#"
                                                               @click.prevent="showAudio(complaint.id)"
                                                               class="btn btn-sm btn-primary">
                                                                Audio</a></td>
                                                        <td><a v-if="complaint.videos.length>0" href="#"
                                                               @click.prevent="showVideo(complaint.id)"
                                                               class="btn btn-sm btn-primary">
                                                                Video</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                <a :href="download" target="_blank" type="submit"
                                   class="btn btn-default save">Download as Excel</a>

                            </div>

                        </div>
                        <!--/end tab-pane-->


                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Image</h4>
                    </div>
                    <div class="modal-body">
                        <img v-for="image in images" :src="image.path" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="audio-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Audio</h4>
                    </div>
                    <div class="modal-body">
                        <audio v-for="clip in audio" controls="controls" :src="clip.path"></audio>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Video</h4>
                    </div>
                    <div class="modal-body">
                        <video v-for="video in videos" controls="controls" :src="video.path"></video>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <script type="text/javascript">

        var data = {
            from_date: moment().subtract(1, 'month').format('YYYY-MM-DD'),
            to_date: moment().format('YYYY-MM-DD'),
            complaints: [],
            total: '',
            client: '',
            cleaner: '',
            status: '',
            inspector: '',
            download: '',
            images: [],
            audio: [],
            videos: [],
        };
        var store = new Vue({
            data: data,
            el: '#store',
            mounted: function () {
                this.filterValues();
                var vm = this;
                window.addEventListener('load', function () {
                    jQuery('#cleaner').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.cleaner = this.value;
                        vm.$emit('input', this.value);
                        vm.filterValues();
                    });
                    jQuery('#inspector').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.inspector = this.value;
                        vm.$emit('input', this.value);
                        vm.filterValues();
                    });
                    jQuery('#client').select2({dropdownAutoWidth: true}).on('change', function (event) {
                        vm.client = this.value;
                        vm.$emit('input', this.value);
                        vm.filterValues();
                    });
                });
            },
            methods: {
                setFromValue: function (event) {
                    this.from_date = event.target.value;
                    this.filterValues();
                },
                setToValue: function (event) {
                    this.to_date = event.target.value;
                    this.filterValues();
                },
                setCleaner: function (event) {
                    this.cleaner = event.target.value;
                    this.filterValues();
                },
                setStatus: function (event) {
                    this.status = event.target.value;
                    this.filterValues();
                },
                setClient: function (event) {
                    this.client = event.target.value;
                    this.filterValues();
                },
                setInspector: function (event) {
                    this.inspector = event.target.value;
                    this.filterValues();
                },
                filterValues: function () {
                    var from_date = this.from_date;
                    var to_date = this.to_date;
                    var cleaner = this.cleaner;
                    var client = this.client;
                    var status = this.status;
                    var inspector = this.inspector;
                    var base = '{{URL::to('reports/complaints/download')}}';
                    this.download = base + '?from_date=' + from_date + '&to_date=' + to_date + '&cleaner=' + cleaner + '&client=' + client + '&inspector=' + inspector + '&status=' + status;
                    var $this = this;
                    var result = [];
                    axios.post('{{URL::to('reports/complaints/filter')}}', {
                        from_date: from_date,
                        to_date: to_date,
                        cleaner: cleaner,
                        client: client,
                        inspector: inspector,
                        status: status,
                    })
                        .then(function (response) {
                            $this.complaints = response.data.complaints;
                            $this.total = response.data.total;
                            return $this.complaints;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                showImage: function (id) {
                    var selected_complaint = this.complaints.filter(function (complaint) {
                        return id == complaint.id;
                    });

                    var image = selected_complaint[0].images;
                    if (image.length > 0) {
                        this.images = image;
                        $('#image-modal').modal('show');
                    }
                },
                showAudio: function (id) {
                    var selected_complaint = this.complaints.filter(function (complaint) {
                        return id == complaint.id;
                    });

                    var audio = selected_complaint[0].audio;
                    if (audio.length > 0) {
                        this.audio = audio;
                        $('#audio-modal').modal('show');
                    }
                },
                showVideo: function (id) {
                    var selected_complaint = this.complaints.filter(function (complaint) {
                        return id == complaint.id;
                    });

                    var videos = selected_complaint[0].videos;
                    if (videos.length > 0) {
                        this.videos = videos;
                        $('#video-modal').modal('show');
                    }
                }
            }
        });
    </script>

@endsection