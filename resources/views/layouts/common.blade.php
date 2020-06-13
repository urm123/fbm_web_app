<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FBM</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/data-table.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/fbm_main.css?ver='.\Carbon\Carbon::now()->timestamp)}}">
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/css/bootstrap-select.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/slick-theme.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

{{--    vue js--}}
    <script src="{{URL::asset('/assets/js/vue.js')}}"></script>
    <script src="https://unpkg.com/vue@2.5.17/dist/vue.js"></script>
{{--    axios--}}
        <script src="{{URL::asset('/assets/js/axios.js')}}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
{{--    moment--}}
    <script src="{{URL::asset('assets/plugins/momentjs/moment.min.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
{{--    Sweetalert--}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<header>
    <!-- Main Navigation bar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#fbm-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL::to('/')}}">FBM</a>
                <div class="User-profile">
                    <div class="notification-bell">
                        {{--<div class="notify"><span>5</span></div>--}}
                        <img class="svg" src="{{URL::asset('assets/assets/bell.svg')}}" alt="info" width="35"
                             height="35">
                    </div>
                    <a href="#" data-toggle="modal" data-target="#logout-modal">
                        <img class="img-responsive" src="{{URL::asset('assets/img/user-512.png')}}" alt="">
                        <p>
                            @if(Auth::check())
                                {{Auth::user()->name}}
                            @endif
                        </p>
                    </a>
                    <form id="logout-form"
                          action="{{URL::to('/logout')}}" method="POST" style="display: none;">
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="fbm-navbar-collapse">
                <ul class="nav navbar-nav">
                    @if($menus)
                        @foreach($menus as $menu)
                            <li><a href="{{URL::to($menu['url'])}}">{{$menu['name']}}</a></li>
                        @endforeach
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
{{--                    <form class="navbar-form navbar-left" method="post" action="{{URL::to('/search')}}">--}}
{{--                        {{csrf_field()}}--}}
{{--                        <div id="custom-search-input">--}}
{{--                            <div class="input-group col-md-12">--}}
{{--                                <span class="input-group-btn">--}}
{{--                                    <button class="btn btn-info " type="button">--}}
{{--                                        <img class="svg" src="{{URL::asset('assets/assets/Search.svg')}}" alt="info"--}}
{{--                                             width="28" height="23">--}}
{{--                                    </button>--}}
{{--                                </span>--}}
{{--                                <input type="text" class="form-control" name="keyword" placeholder="Search"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                    <li class="nav-tail">
                        <div class="User-profile">
                            <div class="notification-bell">
                                {{--<div class="notify">5</div>--}}
                                <img class="svg @if(count($alerts)>0) notify @endif"
                                     src="{{URL::asset('assets/assets/bell.svg')}}" alt="info" width="35"
                                     height="35">
                                <div id="alert-list">
                                    <ul>
                                        @foreach($alerts as $alert)
                                            <li>
                                                {{--<a href="{{URL::to('admin/alerts')}}">{{$alert->title}}--}}
                                                <a href="#">{{$alert->title}}
                                                    @if($alert->deleted_at=='')
                                                        @if($alert->task_status=='resolved')
                                                            <label class="label label-success">Approved By Admin</label>
                                                        @elseif($alert->task_status=='cleaner')
                                                            <label class="label label-warning">Cleaner completed</label>
                                                        @else
                                                            <label class="label label-danger">Pending</label>
                                                        @endif
                                                    @else
                                                        <label class="label label-success">Approved By Admin</label>
                                                    @endif
                                                </a>
                                                <br>
                                                <span>{{$alert->message}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @if(Auth::check())
                                <div style="display: inline-flex;" id="user-icon">
                                    <img class="img-responsive" src="{{URL::asset('assets/img/user-512.png')}}" alt="">
                                    <p>
                                        @if(Auth::check())
                                            {{Auth::user()->name}}
                                        @endif
                                    </p>
                                    <div id="logout-button" style="width: 200px;border: 1px solid #ccc;border-radius: 4px;">
                                        <ul style="list-style: none;padding-left: 0px; width: 150px;">
                                            <li style="color: #000;">
                                                <a href="#" data-toggle="modal" data-target="#logout-modal">
                                                    LogOut
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{URL::to('/change-password')}}">
                                                    Change Password
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

</header>

<!-- /end Main Navigation bar -->
@yield('content')

<!-- / Page Content -->
<footer>

</footer>

<div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Logout Alert!</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to logout from FBM admin panel?
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Yes
                </button>
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">No
                </button>
            </div>
        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{URL::asset('assets/js/FormValidationSettings.js')}}"></script>
<script src="{{URL::asset('assets/plugins/js/bootstrap-select.js?ver=1.0.0.5')}}"></script>
<script src="{{URL::asset('assets/js/data-tables.js')}}"></script>
<script src="{{URL::asset('assets/js/fbm_main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{URL::asset('assets/plugins/typeahead/typeahead.js')}}"></script>
<script src="{{URL::asset('assets/js/slick.min.js')}}"></script>
<!-- Datatables -->
<script src="{{URL::asset('assets/plugins/jquery/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">

    function PrintElem(elem) {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>' + document.title + '</title>');
        mywindow.document.write('</head><body >');
        // mywindow.document.write('<h1>' + document.title  + '</h1>');
        var element = document.getElementById(elem).innerHTML;

        mywindow.document.write('<table>' + document.getElementById(elem).innerHTML + '</table>');
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
</body>

</html>
