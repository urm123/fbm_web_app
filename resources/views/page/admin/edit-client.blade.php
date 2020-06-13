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
                                <h4 class="text-left">Client Registration</h4>
                            </div>
                        </div>
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="content tab-pane fade in active" id="notifi-tab1" style="padding:15px;overflow:visible;min-height:800px;">
                                        <form method="post" class="form-horizontal" action="{{URL::to('/admin/clients/post-edit-client')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="client_id" value="{{$client->id}}">
                                            <div class="row">
                                                <div class="col-xs-12" style="padding-bottom:15px;">
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="first_name">Business Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="first_name"
                                                                       name="first_name" placeholder="John Doe" value="{{$client->name}}">
                                                                @if ($errors->has('first_name'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="street_number">Street Number</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="street_number" name="street_number" value="{{$client->street_number}}">
                                                                @if ($errors->has('street_number'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('street_number') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('street_name') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="street_name">Street Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="street_name" name="street_name" value="{{$client->street_name}}">
                                                                @if ($errors->has('street_name'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('street_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('post_code') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="post_code">Postal Code</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="post_code" name="post_code" value="{{$client->post_code}}">
                                                                @if ($errors->has('post_code'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('post_code') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="city">City</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="city" name="city" value="{{$client->city}}">
                                                                @if ($errors->has('city'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('city') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="city">Class</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" id="category" name="category">
                                                                    <option value="">Select a Class</option>
                                                                    @foreach($categories as $category)
                                                                        <option @if($client->category_id==$category->id) selected="selected"
                                                                                @endif value="{{$category->id}}">{{$category->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('category'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('category') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12" style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;">
                                                    <div class="title" style="border-bottom:none;padding-left:0;">
                                                        <h4 class="text-left">Cleaner Checklist</h4>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-xs-12" style="border-top: 1px solid rgba(89, 89, 89, 0.2); padding: 15px 0;"
                                                                 v-for="(checklist,index) in checklists">
                                                                <div class="col-sm-3">
                                                                    <select class="form-control" name="order[]">
                                                                        <option value="1" selected="selected">Daily</option>
                                                                        <option value="2">Weekend</option>
                                                                        <option value="3">Monthly</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-9" style="">
                                                                    <div class="form-group">
                                                                        <label class="col-sm-4 control-label" for="name">Checklist
                                                                            Title</label>
                                                                        <div class="col-sm-7">
                                                                            <input type="text" class="form-control"
                                                                                   v-model="checklist.title" name="title[]" placeholder="Title" required>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <a href="#" class="btn btn-danger btn-sm pull-right" style="color: rgb(255, 255, 255);"
                                                                               @click.prevent="removeTitle(index)">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-10 col-xs-offset-2"
                                                                         v-for="(checklist_item,item_index) in checklist.items">
                                                                        <div class="form-group">
                                                                            <label class="col-sm-4 control-label" for="name">Checklist
                                                                                Item</label>
                                                                            <div class="col-sm-7">
                                                                                <input type="text" class="form-control"
                                                                                       :name="'checklist_item['+index+']['+item_index+']'"
                                                                                       v-model="checklist_item.name"
                                                                                       placeholder="Title" required>
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
                                                                    <div class="col-xs-10 col-xs-offset-2 text-right" style="border-top: 1px solid rgba(89, 89, 89, 0.2); padding-top: 15px; padding-bottom: 15px;">
                                                                        <button type="button" class="btn btn-primary"
                                                                                @click.prevent="addItem(checklist)">
                                                                            Add Item
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 text-right" style="border-top: 1px solid rgba(89, 89, 89, 0.2); padding-top: 15px; padding-bottom: 15px;">
                                                                <button type="button" class="btn btn-success" @click.prevent="addTitle">
                                                                    Add Title
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="col-xs-12" style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;" v-for="(contact, index) in operational_contacts">
                                                        <input type="hidden" :value="contact.id" name="extra_id[]">
                                                        <input type="hidden" value="operational" name="extra_contact_type[]">
                                                        <div class="title" style="border-bottom:none;padding-left:0;">
                                                            <h4 class="text-left col-xs-12"><span style="margin-top:8px;display:inline-block">Additional Operational Contact</span>
                                                                <a @click="removeOperationalContact(index,$event)" class="btn btn-danger btn-sm pull-right"
                                                                   style="color: #ffffff;" style="margin-top: -6px" href="#"><i class="fa fa-times"></i></a>
                                                            </h4>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" :for="'extra_first_name'+index">First Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" :id="'extra_first_name'+index" placeholder="Cene Gatsby" name="extra_first_name[]" :value="contact.first_name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" :for="'extra_email'+index">Email Address</label>
                                                                <div class="col-sm-8">
                                                                    <input type="email" class="form-control" :id="'extra_email'+index" name="extra_email[]" :value="contact.email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" :for="'extra_telephone'+index">Primary Telephone</label>
                                                                <div class="col-sm-8">
                                                                    <input type="tel" class="form-control" :id="'extra_telephone'+index" name="extra_telephone[]" :value="contact.telephone">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 text-right" style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px; padding-bottom: 15px;">
                                                        <button type="button" class="btn btn-primary" @click="addOperationalContact">
                                                            Add contact
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-xs-12" style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;" v-for="(contact, index) in accounting_contacts">
                                                        <input type="hidden" :value="contact.id" name="extra_id[]">
                                                        <input type="hidden" value="accounting" name="extra_contact_type[]">
                                                        <div class="title" style="border-bottom:none;padding-left:0;">
                                                            <h4 class="text-left col-xs-12"><span style="margin-top:8px;display:inline-block">Additional Accounting Contact</span>
                                                                <a @click="removeAccountingContact(index,$event)" class="btn btn-danger btn-sm pull-right" style="color: #ffffff;"
                                                                   style="margin-top: -6px" href="#"><i class="fa fa-times"></i></a>
                                                            </h4>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" :for="'extra_first_name'+index">First
                                                                    Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" :id="'extra_first_name'+index"
                                                                           placeholder="Cene Gatsby" name="extra_first_name[]" :value="contact.first_name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" :for="'extra_email'+index">Email Address</label>
                                                                <div class="col-sm-8">
                                                                    <input type="email" class="form-control" :id="'extra_email'+index" name="extra_email[]" :value="contact.email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label" :for="'extra_telephone'+index">Primary Telephone</label>
                                                                <div class="col-sm-8">
                                                                    <input type="tel" class="form-control" :id="'extra_telephone'+index" name="extra_telephone[]" :value="contact.telephone">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 text-right" style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px; padding-bottom: 15px;">
                                                        <button type="button" class="btn btn-primary" @click="addAccountingContact">
                                                            Add contact
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12" style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px; ">
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('alarm_code') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="alarm_code">Alarm Code</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="alarm_code" name="alarm_code" value="{{$client->alarm_code}}">
                                                                @if ($errors->has('alarm_code'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('alarm_code') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('lock_code') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="lock_code">Lock Code</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="lock_code" name="lock_code" value="{{$client->lock_code}}">
                                                                @if ($errors->has('lock_code'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('lock_code') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="start_date">Start Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control inputdate" id="start_date" name="start_date" value="{{$client->start_date}}">
                                                                @if ($errors->has('start_date'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('start_date') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('payment_date') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="payment_date">Payment Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control inputdate" id="payment_date" name="payment_date" value="{{$client->payment}}">
                                                                @if ($errors->has('payment_date'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('payment_date') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12" style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px;">
                                                    <div class="checkbox">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="InputEmail">Supply Required</label>
                                                            <div class="col-sm-8">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        @if($client->supply_required)
                                                                            <input type="checkbox" value="true" id="supply_required" name="supply_required" checked="checked">
                                                                        @else
                                                                            <input type="checkbox" value="true" id="supply_required" name="supply_required">
                                                                        @endif
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="continuous">Continuous Client</label>
                                                            <div class="col-sm-8">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        @if($client->continuous)
                                                                            <input type="checkbox" value="true" id="continuous" name="continuous" checked="checked">
                                                                        @else
                                                                            <input type="checkbox" value="true" id="continuous" name="continuous">
                                                                        @endif
                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group{{ $errors->has('termination_date') ? ' has-error' : '' }}">
                                                            <label class="col-sm-4 control-label" for="termination_date">Termination Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control inputdate" id="termination_date" name="termination_date" value="{{$client->termination_date}}">
                                                                @if ($errors->has('termination_date'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('termination_date') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                    <button type="submit" class="btn btn-default save">Save</button>
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
    <script>
        var data = {
            checklists: {!! json_encode($checklist) !!},
            operational_contacts: {!! json_encode($client->operational_contacts) !!},
            accounting_contacts: {!! json_encode($client->accounting_contacts) !!}
        };
        console.log(data.checklist);
        var client = new Vue({
            el: '#client',
            data: data,
            methods: {
                addOperationalContact: function () {
                    this.operational_contacts.push({id: false});
                },
                addAccountingContact: function () {
                    this.accounting_contacts.push({id: false});
                },
                removeAccountingContact: function (index, event) {
                    event.preventDefault();
                    this.accounting_contacts.splice(index, 1);
                },
                removeOperationalContact: function (index, event) {
                    event.preventDefault();
                    this.operational_contacts.splice(index, 1);
                }
            }
        });
    </script>
@endsection