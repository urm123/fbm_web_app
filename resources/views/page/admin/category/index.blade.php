@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')

    <section class="page-content dashboard" id="categories">

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
                <div class="col-xs-12 col-sm-4">
                </div>
                <div class="col-xs-12 col-sm-4">
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

                    <div class="card cleaneroverview">
                        <div class="title">
                            <h4 class="text-left">Classes Overview</h4>
                            <h4 class="text-right" style="float:right;"><a href="{{route('admin.category.create')}}">
                                    Add New Class + </a></h4>
                        </div>
                        <div class="content Scroll" style="min-height:400px;">
                            <table class="table selectable client-table">

                                <tr>
                                    <th>Class Name</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="col-1">{{$category->name}}</td>
                                        <td>
                                            <a href="{{route('admin.category.edit',$category)}}"
                                               class="btn btn-success">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger"
                                                    @click.prevent="deleteCategory($event,{{$category->id}})"
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

        var categories = new Vue({
            el: '#categories',
            data: data,
            methods: {
                deleteCategory: function (event, category_id) {
                    event.preventDefault();
                    var confirm_delete = confirm('Are you sure you want to delete this item?');
                    var $this = this;
                    if (confirm_delete) {
                        axios.post('{{route('admin.category.index')}}/' + category_id, {
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