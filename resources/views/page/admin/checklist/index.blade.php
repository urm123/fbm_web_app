@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')

    <section class="page-content dashboard" id="checklists">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-1">
                    <h3>Checklists</h3>
                </div>
                <div class="col-xs-12 col-sm-7">
                    <div class="second-navbar page">
                        <ul>

{{--                            <li><a href="{{route('admin.checklist.index')}}">Checklists</a></li>--}}
                            <li><a href="{{URL::to('/admin/inspectors')}}">Inspectors</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card cleaneroverview">
                        <div class="title">
                            <h4 class="text-left">Checklists Overview</h4>
                            <h4 class="text-right" style="float:right;"><a href="{{route('admin.checklist.create')}}">
                                    Add New Checklist + </a></h4>
                        </div>
                        <div class="content Scroll" style="min-height:400px;">
                            <table class="table selectable client-table">

                                <tr>
                                    <th>Class</th>
                                    <th>Checklist Name</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($checklists as $checklist)
                                    <tr>
                                        <td class="col-1">{{$checklist->category->name}}</td>
                                        <td class="col-1">{{$checklist->title}}</td>
                                        <td>
                                            <a href="{{route('admin.checklist.edit',$checklist)}}"
                                               class="btn btn-success">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger"
                                                    @click.prevent="deleteChecklist($event,{{$checklist->id}})"
                                                    type="button">
                                                Delete
                                            </button>
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
            </div>
        </div>

    </section>

    <script type="text/javascript">
        var data = {};

        var checklists = new Vue({
            el: '#checklists',
            data: data,
            methods: {
                deleteChecklist: function (event, checklist_id) {
                    event.preventDefault();
                    var confirm_delete = confirm('Are you sure you want to delete this item?');
                    var $this = this;
                    if (confirm_delete) {
                        axios.post('{{route('admin.checklist.index')}}/' + checklist_id, {
                            _token: '{{csrf_token()}}',
                            _method: 'DELETE'
                        }).then(function (response) {
                            if (response.data.success) {
                                alert(response.data.success);
                            }
                            window.location.reload();
                        })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }
                },
            }
        });
    </script>
@endsection