@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="client">
        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                    <ol class="breadcrumb" style="background: #fff;">
                        <?php echo $breadcrumb; ?>
                    </ol>
                </div> 
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> 
                </div>
                <div class="col-xs-12 col-sm-1">
                </div>
                <div class="col-xs-12 col-sm-7 ">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{route('admin.category.index')}}">Classes</a></li>
                            <li><a href="{{URL::to('admin/clients/allocations')}}">Allocations</a></li>
                            <li><a href="{{URL::to('admin/clients')}}">Clients</a></li>
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
                            <div class="col-md-2">
                                <h4 class="text-left">Cleaner Checklist</h4>
                            </div>
                        </div>
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="content tab-pane fade in active" id="notifi-tab1" style="padding:15px;overflow:visible;min-height:500px;">  
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding:0;"> 
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12card-contener">
                                                        <div class="card assingnments">
                                                            <div class="title"><h4>Daily</h4></div>
                                                            <div class="panel with-nav-tabs panel-default">
                                                                <div class="panel-body"> 
                                                                    <div class="tab-content">
                                                                        <div class="content tab-pane fade in Scroll active" id="assin-tab1" style="min-height: 400px;padding: 5px;">
                                                                            <table class="table" style="">
                                                                                <?php
                                                                                // dd($checklist);
                                                                                ?>
                                                                                @foreach($checklist as $list)
                                                                                    @if($list->order == 1)
                                                                                        <tr>
                                                                                            <td class="">
                                                                                                {{$list->title}}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <table class="table table-responsive"> 
                                                                                                    <tbody>
                                                                                            @foreach($list->item as $sublist)
                                                                                            <tr style="background: #ebebeb;border-bottom: 1px solid #ccc;">
                                                                                                <td>
                                                                                                {{$sublist->name}}
                                                                                            </td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </table>
                                                                        </div>  
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            <!--/end   panel-body -->
                                                            <div class="cord-footer">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding:0;"> 
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12card-contener">
                                                        <div class="card assingnments">
                                                            <div class="title"><h4>Weekly</h4></div>
                                                            <div class="panel with-nav-tabs panel-default">
                                                                <div class="panel-body"> 
                                                                    <div class="tab-content">
                                                                        <div class="content tab-pane fade in Scroll active" id="assin-tab1" style="min-height: 400px;padding: 5px;">
                                                                            <table class="table" style="">
                                                                                <?php
                                                                                // dd($checklist);
                                                                                ?>
                                                                                @foreach($checklist as $list)
                                                                                    @if($list->order == 2)
                                                                                        <tr>
                                                                                            <td class="">
                                                                                                {{$list->title}}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <table class="table table-responsive"> 
                                                                                                    <tbody>
                                                                                            @foreach($list->item as $sublist)
                                                                                            <tr style="background: #ebebeb;border-bottom: 1px solid #ccc;">
                                                                                                <td>
                                                                                                {{$sublist->name}}
                                                                                            </td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </table>
                                                                        </div>  
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            <!--/end   panel-body -->
                                                            <div class="cord-footer">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding:0;"> 
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12card-contener">
                                                        <div class="card assingnments">
                                                            <div class="title"><h4>Monthly</h4></div>
                                                            <div class="panel with-nav-tabs panel-default">
                                                                <div class="panel-body"> 
                                                                    <div class="tab-content">
                                                                        <div class="content tab-pane fade in Scroll active" id="assin-tab1" style="min-height: 400px;padding: 5px;">
                                                                            <table class="table" style="">
                                                                                <?php
                                                                                // dd($checklist);
                                                                                ?>
                                                                                @foreach($checklist as $list)
                                                                                    @if($list->order == 3)
                                                                                        <tr>
                                                                                            <td class="">
                                                                                                {{$list->title}}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <table class="table table-responsive"> 
                                                                                                    <tbody>
                                                                                            @foreach($list->item as $sublist)
                                                                                            <tr style="background: #ebebeb;border-bottom: 1px solid #ccc;">
                                                                                                <td>
                                                                                                {{$sublist->name}}
                                                                                            </td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </table>
                                                                        </div>  
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            <!--/end   panel-body -->
                                                            <div class="cord-footer">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
            </div>
        </div>
    </section>
    <script>
        var data = {
            checklists: {!! json_encode($checklist) !!} 
        }; 

        var client = new Vue({
            el: '#client',
            data: data,
            methods: { 
            }
        });
    </script>
@endsection