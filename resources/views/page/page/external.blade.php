<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FBM</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/fbm_main.css?ver='.\Carbon\Carbon::now()->timestamp)}}">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700" rel="stylesheet">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--vue js--}}
    {{--<script src="{{URL::asset('/assets/js/vue.js')}}"></script>--}}
    <script src="https://unpkg.com/vue@2.5.17/dist/vue.js"></script>
    {{--axios--}}
    {{--    <script src="{{URL::asset('/assets/js/axios.js')}}"></script>--}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{--moment--}}
    <script src="{{URL::asset('assets/plugins/momentjs/moment.min.js')}}"></script>

</head>

<body>

<section class="page-content dashboard" id="view">
    <div class="container-fluid">
        <div class="row">

            <div class="col-xs-12 col-sm-12" style="padding:0;">

                <div class="col-xs-12 col-sm-4 card-contener">
                    <div class="card overview">
                        <div class="title">
                            <h4>Daily Work Schedules</h4>
                        </div>
                        <div class="content">
                            <div class="col-xs-12">
                                <div class="row" v-for="task in upcomingTasks">
                                    <div class="col-xs-12 external-row">
                                        <div class="row">
                                            <div class="col-xs-5">Name:</div>
                                            <div class="col-xs-6">@{{ task.name }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Client:</div>
                                            <div class="col-xs-6">@{{ task.client }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Cleaner:</div>
                                            <div class="col-xs-6">@{{ task.cleaner }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Inspector:</div>
                                            <div class="col-xs-6">@{{ task.inspector }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Time:</div>
                                            <div class="col-xs-6">@{{ task.time }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--/end content -->
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 card-contener">
                    <div class="card overview">
                        <div class="title">
                            <h4>Incomplete Jobs</h4>
                        </div>
                        <div class="content">
                            <div class="col-xs-12">
                                <div class="row" v-for="task in incompleteTasks">
                                    <div class="col-xs-12 external-row">
                                        <div class="row">
                                            <div class="col-xs-5">Name:</div>
                                            <div class="col-xs-6">@{{ task.name }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Client:</div>
                                            <div class="col-xs-6">@{{ task.client }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Cleaner:</div>
                                            <div class="col-xs-6">@{{ task.cleaner }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Inspector:</div>
                                            <div class="col-xs-6">@{{ task.inspector }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Time:</div>
                                            <div class="col-xs-6">@{{ task.time }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--/end content -->
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 card-contener">
                    <div class="card overview">
                        <div class="title">
                            <h4>Pending Complaints</h4>
                        </div>
                        <div class="content">
                            <div class="col-xs-12">
                                <div class="row" v-for="task in pendingComplaints">
                                    <div class="col-xs-12 external-row">
                                        <div class="row">
                                            <div class="col-xs-5">Name:</div>
                                            <div class="col-xs-6">@{{ task.name }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Client:</div>
                                            <div class="col-xs-6">@{{ task.client }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Cleaner:</div>
                                            <div class="col-xs-6">@{{ task.cleaner }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">Inspector:</div>
                                            <div class="col-xs-6">@{{ task.inspector }}</div>
                                        </div>
                                        {{--                                        <div class="row">--}}
                                        {{--                                            <div class="col-xs-5">Time:</div>--}}
                                        {{--                                            <div class="col-xs-6">@{{ task.time }}</div>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--/end content -->
                    </div>
                </div>
                <!--/end card-contener -->


            </div>
        </div>
    </div>
</section>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>


<script type="text/javascript">
    var data = {
        upcomingTasks: [],
        incompleteTasks: [],
        pendingComplaints: []
    };

    var view = new Vue({
        data: data,
        el: '#view',
        mounted: function () {
            this.getData();
        },
        methods: {
            getData: function () {
                setInterval(function () {
                    var $this = this;
                    axios.get('{{route('external.data')}}').then(function (response) {
                        $this.upcomingTasks = response.data.upcomingTasks;
                        $this.incompleteTasks = response.data.incompleteTasks;
                        $this.pendingComplaints = response.data.pendingComplaints;
                    }).catch(function (error) {
                        console.log(error);
                    });
                }.bind(this), 1000);
            }
        }
    });
</script>

<style type="text/css">
    .external-row {
        margin-bottom: 10px;
        border-bottom: 1px solid #e7e7e7;
    }

    .external-row .row {
        margin: 0;
    }

    .external-row .row div {
        padding: 5px;
        font-size: 12px;
    }


</style>


</body>

</html>