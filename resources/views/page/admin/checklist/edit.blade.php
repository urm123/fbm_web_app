@extends('layouts.common')

@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Checklist Information</h3>
                </div>
                <div class="col-xs-12 col-sm-1">
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

        <div class="container" id="checklist">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card form-card">

                        <div class="row title">
                            <div class="col-md-3">
                                <h4 class="text-left">Checklist Edit</h4>
                            </div>
                        </div>

                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">

                                    <div class="content tab-pane fade in active" id="notifi-tab2"
                                         style="padding:15px;overflow:visible;min-height:800px;">

                                        <form method="post" class="form-horizontal"
                                              action="{{route('admin.checklist.update',$checklist)}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="put">
                                            <div class="row">
                                                <div class="col-xs-12"
                                                     style="padding-bottom:15px;">
                                                    <div class="form-group @if($errors->has('category')) has-error @endif">
                                                        <label class="col-sm-4 control-label"
                                                               for="category">Class</label>
                                                        <div class="col-sm-8">
                                                            <select name="category" id="category" class="form-control">
                                                                <option value="">Select a class</option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->id}}"
                                                                            @if($category->id==$checklist->category->id) selected="selected" @endif>{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('category'))
                                                                <span class="help-block">
                                                                    <strong>{{$errors->first('category')}}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row @if($errors->has('title')) has-error @endif">
                                                <div class="col-xs-12"
                                                     style="padding-bottom:15px;">
                                                    <div class="col-sm-12"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2); padding: 15px 0;">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="name">Checklist
                                                                Title</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       value="{{$checklist->title}}"
                                                                       name="title"
                                                                       placeholder="Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-10 col-xs-offset-2"
                                                             v-for="(checklist_item,item_index) in items">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" for="name">Checklist
                                                                    Item</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" class="form-control"
                                                                           :name="'checklist_item['+checklist_item.id+']'"
                                                                           v-model="checklist_item.name"
                                                                           placeholder="Title">
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <a href="#" class="btn btn-danger btn-sm pull-right"
                                                                       @click.prevent="removeItem(item_index,items)"
                                                                       style="color: rgb(255, 255, 255);">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-10 col-xs-offset-2 text-right"
                                                             style="border-top: 1px solid rgba(89, 89, 89, 0.2); padding-top: 15px; padding-bottom: 15px;">
                                                            <button type="button" class="btn btn-primary"
                                                                    @click.prevent="addItem(items)">
                                                                Add Item
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($errors->has('title'))
                                                <span class="help-block">
                                                                    <strong>{{$errors->first('title')}}</strong>
                                                                </span>
                                            @endif

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                    <button type="submit" class="btn btn-default save">Save</button>
                                                    <button type="reset" class="btn btn-default clear">Cancel</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>


                                    <!--/end tab-pane-->

                                </div>
                            </div>
                            <!--/end   panel-body -->

                            <div class="cord-footer">
                            </div>
                        </div>

                    </div>
                    <!--/end Card -->
                </div>
                <!--/end card-contener -->
            </div>
        </div>

    </section>

    <script type="text/javascript">
        var data = {
            items: {!! json_encode($checklist->items) !!}
        };

        var checklist = new Vue({
            data: data,
            el: '#checklist',
            methods: {
                addItem: function (items) {
                    var count = items.length + 1;
                    items.push({id: 'new_' + count, name: ''});
                },
                removeItem: function (item_index, items) {
                    items.splice(item_index, 1);

                }
            }
        });
    </script>

@endsection