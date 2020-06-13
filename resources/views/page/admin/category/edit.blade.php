@extends('layouts.common')

@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard">
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
        <div class="container" id="category">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">
                    <div class="card form-card">
                        <div class="row title">
                            <div class="col-md-2">
                                <h4 class="text-left">Class Registration</h4>
                            </div>
                        </div>

                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">

                                    <div class="content tab-pane fade in active" id="notifi-tab2"
                                         style="padding:15px;overflow:visible;min-height:800px;">

                                        <form method="post" class="form-horizontal" action="{{route('admin.category.update',$category)}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="category_id" value="{{$category->id}}">
                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="row">
                                                <div class="col-xs-12" style="padding-bottom:15px;">
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="name">Class
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="name"
                                                                       name="name"
                                                                       placeholder="John Doe"
                                                                       value="{{$category->name}}">
                                                                @if ($errors->has('name'))
                                                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row @if($errors->has('title')) has-error @endif">
                                                <div class="col-xs-12"
                                                     style="padding-bottom:15px;"
                                                     v-for="(checklist,index) in checklists">
                                                    <div class="col-sm-12"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2); padding: 15px 0;">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="name">Checklist
                                                                Title</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control"
                                                                       v-model="checklist.title"
                                                                       name="title[]"
                                                                       placeholder="Title">
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <a href="#" class="btn btn-danger btn-sm pull-right"
                                                                   style="color: rgb(255, 255, 255);"
                                                                   @click.prevent="removeTitle(index)">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-11 col-xs-offset-1"
                                                             v-for="(checklist_item,item_index) in checklist.items">
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="name">Checklist
                                                                    Item</label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control"
                                                                           :name="'checklist_item['+index+']['+item_index+']'"
                                                                           v-model="checklist_item.name"
                                                                           placeholder="Title">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <table class="table table-responsive">

                                                                        <tr>
                                                                            <td v-for="(day,day_index) in checklist_item"
                                                                                v-if="day_index!='id'&&day_index!='checklist_id'&&day_index!='name'&&day_index!='order'&&day_index!='created_at'&&day_index!='updated_at'&&day_index!='deleted_at'">
                                                                                <label :for="'checklistday'+checklist_item.id+day_index"
                                                                                       style="text-transform: capitalize;">
                                                                                    <input
                                                                                            type="checkbox"
                                                                                            :id="'checklistday'+checklist_item.id+day_index"
                                                                                            v-model="checklist_item[day_index]"
                                                                                            :name="'checklist_item_days['+index+']['+item_index+']['+day_index+']'">
                                                                                    @{{ day_index.substring(0,3)
                                                                                    }}</label>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <a href="#" class="btn btn-danger btn-sm pull-right"
                                                                       @click.prevent="removeItem(item_index,checklist.items)"
                                                                       style="color: rgb(255, 255, 255);">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-10 col-xs-offset-2 text-right"
                                                             style="border-top: 1px solid rgba(89, 89, 89, 0.2); padding-top: 15px; padding-bottom: 15px;">
                                                            <button type="button" class="btn btn-primary"
                                                                    @click.prevent="addItem(checklist)">
                                                                Add Item
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 text-right"
                                                     style="border-top: 1px solid rgba(89, 89, 89, 0.2); padding-top: 15px; padding-bottom: 15px;">
                                                    <button type="button" class="btn btn-primary"
                                                            @click.prevent="addTitle">
                                                        Add Checklist
                                                    </button>
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
            checklists: {!! json_encode($category->checklists) !!}
        };

        var checklist = new Vue({
            data: data,
            el: '#category',
            methods: {
                addTitle: function () {
                    this.checklists.push({title: '', items: [{name: ''}]});
                },
                addItem: function (checklist) {
                    checklist.items.push({
                        name: '',
                        sunday: false,
                        monday: false,
                        tuesday: false,
                        wednesday: false,
                        thursday: false,
                        friday: false,
                        saturday: false,
                    });
                },
                removeTitle: function (index) {
                    this.checklists.splice(index, 1);
                },
                removeItem: function (item_index, items) {
                    items.splice(item_index, 1);

                }
            }
        });
    </script>

@endsection