@extends('layouts.common')
@section('content')
    @include('layouts.headers.dashboard')
    <section class="page-content dashboard" id="dashboard">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 card-contener">

                    <div class="card notification">
                        <div class="title">
                            <h4>Search Results</h4>
                        </div>
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">

                                <table class="table">
                                    @foreach($search_result as $menu)
                                        <tr>
                                            <td class="col-1">{{$menu->name}}
                                            </td>
                                            <td class="col-3">
                                                <a href="{{$menu->url}}" class="btn bg-success">Go</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <!--/end tab-content -->
                            </div>
                            <!--/end   panel-body -->


                        </div>
                        <!--/end panel-default contener -->

                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
            </div>
        </div>
        <!-- Modal -->
    </section>
@endsection