@extends('layouts.common')

@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="client">

        <!-- Page header  -->
        <div class="container page-header">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Client Information</h3>
                </div>
                <div class="col-xs-12 col-sm-1">
                </div>
                <div class="col-xs-12 col-sm-7">
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
                            <div class="col-md-7">
                                <div class="panel-heading" style="margin-left: 0px;">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#notifi-tab2" data-toggle="tab">Continuous</a></li>
                                        <li><a href="#notifi-tab1" data-toggle="tab">One Time</a></li>
                                    </ul>
                                </div>
                                <!-- end panel-heading -->
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="content tab-pane fade in active" id="notifi-tab2"
                                         style="padding:15px;overflow:visible;min-height:800px;">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data"
                                              action="{{URL::to('/admin/clients/post-new-client')}}"
                                              @submit.prevent="validateNewClient($event)">
                                            {{csrf_field()}}
                                            <input type="hidden" value="continuous" name="type">
                                            <div class="row">
                                                <div class="col-xs-12"
                                                     style="padding-bottom:15px;">
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.first_name}">
                                                            <label class="col-sm-4 control-label" for="first_name">Business
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="first_name"
                                                                       name="first_name"
                                                                       placeholder="John Doe"
                                                                       value="{{old('first_name')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.first_name">
                                        <strong>@{{ validation.first_name[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.street_number}">
                                                            <label class="col-sm-4 control-label" for="street_number">Street
                                                                Number</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="street_number" name="street_number"
                                                                       value="{{old('street_number')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.street_number">
                                        <strong>@{{ validation.street_number[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.street_name}">
                                                            <label class="col-sm-4 control-label" for="street_name">Street
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="street_name" name="street_name"
                                                                       value="{{old('street_name')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.street_name">
                                        <strong>@{{ validation.street_name[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.post_code}">
                                                            <label class="col-sm-4 control-label" for="post_code">Postal
                                                                Code</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="post_code" name="post_code"
                                                                       value="{{old('post_code')}}">
                                                                <span class="help-block" v-if="validation.post_code">
                                        <strong>@{{ validation.post_code[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group" :class="{'has-error':validation.city}">
                                                            <label class="col-sm-4 control-label"
                                                                   for="city">City</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="city" name="city" value="{{old('city')}}">
                                                                <span class="help-block" v-if="validation.city">
                                        <strong>@{{ validation.city[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.category}">
                                                            <label class="col-sm-4 control-label"
                                                                   for="city">Class</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control"
                                                                        id="category" name="category">
                                                                    <option value="">Select a Class</option>
                                                                    @foreach($categories as $category)
                                                                        <option @if(old('category')==$category->id) selected="selected"
                                                                                @endif value="{{$category->id}}">{{$category->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="help-block" v-if="validation.category">
                                        <strong>@{{ validation.category[0] }}</strong></span>
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
                                                <div class="col-xs-6"
                                                     style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;">
                                                    <div class="title" style="border-bottom:none;padding-left:0;">
                                                        <h4 class="text-left">Operational Contact</h4>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_first_name}">
                                                            <label class="col-sm-4 control-label" for="oc_first_name">First
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="oc_first_name"
                                                                       placeholder="Cene Gatsby" name="oc_first_name"
                                                                       value="{{old('oc_first_name')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.oc_first_name">
                                        <strong>@{{ validation.oc_first_name[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_email}">
                                                            <label class="col-sm-4 control-label" for="oc_email">Email
                                                                Address</label>
                                                            <div class="col-sm-8">
                                                                <input type="email" class="form-control" id="oc_email"
                                                                       name="oc_email" value="{{old('oc_email')}}">
                                                                <span class="help-block" v-if="validation.oc_email">
                                        <strong>@{{ validation.oc_email[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_telephone}">
                                                            <label class="col-sm-4 control-label" for="oc_telephone">Primary
                                                                Telephone</label>
                                                            <div class="col-sm-8">
                                                                <input type="tel" class="form-control" id="oc_telephone"
                                                                       name="oc_telephone"
                                                                       value="{{old('oc_telephone')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.oc_telephone">
                                        <strong>@{{ validation.oc_telephone[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label"
                                                                   for="account_clone">Same for accounting
                                                                contact</label>
                                                            <div class="col-sm-8">
                                                                <input type="checkbox" class="form-control"
                                                                       id="account_clone"
                                                                       name="account_clone" value="true"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6"
                                                     style="border-top: 1px solid rgba(89, 89, 89, 0.2);border-left: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;">
                                                    <div class="title" style="border-bottom:none;padding-left:0;">
                                                        <h4 class="text-left">Accounting Contact</h4>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_first_name_2}">
                                                            <label class="col-sm-4 control-label" for="oc_first_name_2">First
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="oc_first_name_2"
                                                                       placeholder="Nate Johnson"
                                                                       name="oc_first_name_2"> <span class="help-block"
                                                                                                     v-if="validation.oc_first_name_2">
                                        <strong>@{{ validation.oc_first_name_2[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_email_2}">
                                                            <label class="col-sm-4 control-label" for="oc_email_2">Email
                                                                Address</label>
                                                            <div class="col-sm-8">
                                                                <input type="email" class="form-control" id="oc_email_2"
                                                                       name="oc_email_2" value="{{old('oc_email_2')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.oc_email_2">
                                        <strong>@{{ validation.oc_email_2[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_telephone_2}">
                                                            <label class="col-sm-4 control-label" for="oc_telephone_2">Primary
                                                                Telephone</label>
                                                            <div class="col-sm-8">
                                                                <input type="tel" class="form-control"
                                                                       id="oc_telephone_2"
                                                                       name="oc_telephone_2"
                                                                       value="{{old('oc_telephone_2')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.oc_telephone_2">
                                        <strong>@{{ validation.oc_telephone_2[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="col-xs-12"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;"
                                                         v-for="(contact, index) in operational_contacts">
                                                        <input type="hidden" value="operational"
                                                               name="extra_contact_type[]">
                                                        <div class="title" style="border-bottom:none;padding-left:0;">
                                                            <h4 class="text-left col-xs-12">
                                                                <span style="margin-top:8px;display:inline-block">Additional Operational
                                                                Contact</span>
                                                                <a @click="removeOperationalContact(index,$event)"
                                                                   class="btn btn-danger btn-sm pull-right"
                                                                   style="color: #ffffff;"
                                                                   style="margin-top: -6px" href="#"><i
                                                                            class="fa fa-times"></i></a>
                                                            </h4>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_first_name'+index">First
                                                                    Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                           :id="'extra_first_name'+index"
                                                                           placeholder="Cene Gatsby"
                                                                           name="extra_first_name[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_email'+index">Email
                                                                    Address</label>
                                                                <div class="col-sm-8">
                                                                    <input type="email" class="form-control"
                                                                           :id="'extra_email'+index"
                                                                           name="extra_email[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_telephone'+index">Primary
                                                                    Telephone</label>
                                                                <div class="col-sm-8">
                                                                    <input type="tel" class="form-control"
                                                                           :id="'extra_telephone'+index"
                                                                           name="extra_telephone[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 text-right"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px; padding-bottom: 15px;">
                                                        <button type="button" class="btn btn-primary"
                                                                @click="addOperationalContact">
                                                            Add contact
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-xs-12"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;"
                                                         v-for="(contact, index) in accounting_contacts">
                                                        <input type="hidden" value="accounting"
                                                               name="extra_contact_type[]">
                                                        <div class="title" style="border-bottom:none;padding-left:0;">
                                                            <h4 class="text-left col-xs-12">
                                                                <span style="margin-top:8px;display:inline-block">Additional Accounting
                                                                Contact</span>
                                                                <a @click="removeAccountingContact(index,$event)"
                                                                   class="btn btn-danger btn-sm pull-right"
                                                                   style="color: #ffffff;"
                                                                   style="margin-top: -6px" href="#"><i
                                                                            class="fa fa-times"></i></a>
                                                            </h4>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_first_name'+index">First
                                                                    Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                           :id="'extra_first_name'+index"
                                                                           placeholder="Cene Gatsby"
                                                                           name="extra_first_name[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_email'+index">Email
                                                                    Address</label>
                                                                <div class="col-sm-8">
                                                                    <input type="email" class="form-control"
                                                                           :id="'extra_email'+index"
                                                                           name="extra_email[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_telephone'+index">Primary
                                                                    Telephone</label>
                                                                <div class="col-sm-8">
                                                                    <input type="tel" class="form-control"
                                                                           :id="'extra_telephone'+index"
                                                                           name="extra_telephone[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 text-right"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px; padding-bottom: 15px;">
                                                        <button type="button" class="btn btn-primary"
                                                                @click="addAccountingContact">
                                                            Add contact
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12"
                                                     style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px; padding-bottom: 15px">
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.alarm_code}">
                                                            <label class="col-sm-4 control-label" for="alarm_code">Alarm
                                                                Code</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="alarm_code"
                                                                       name="alarm_code" value="{{old('alarm_code')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.alarm_code">
                                        <strong>@{{ validation.alarm_code[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.lock_code}">
                                                            <label class="col-sm-4 control-label" for="lock_code">Lock
                                                                Code</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="lock_code"
                                                                       name="lock_code" value="{{old('lock_code')}}">
                                                                <span class="help-block" v-if="validation.lock_code">
                                                                    <strong>@{{ validation.lock_code[0] }}</strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.start_date}">
                                                            <label class="col-sm-4 control-label" for="start_date">Start
                                                                Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control inputdate" id="start_date" name="start_date" value="{{old('start_date')}}">
                                                                <span class="help-block" v-if="validation.start_date">
                                                                    <strong>@{{ validation.start_date[0] }}</strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.payment_date}">
                                                            <label class="col-sm-4 control-label" for="payment_date">Payment
                                                                Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control inputdate"
                                                                       id="payment_date" name="payment_date"
                                                                       value="{{old('payment_date')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.payment_date">
                                        <strong>@{{ validation.payment_date[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12"
                                                     style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px;">

                                                    <div class="checkbox">

                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.telephone}">
                                                            <label class="col-sm-4 control-label" for="InputEmail">Supply
                                                                Required</label>
                                                            <div class="col-sm-8">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" value="true"
                                                                               id="supply_required"
                                                                               name="supply_required">
                                                                        <span class="cr"><i
                                                                                    class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.termination_date}">
                                                            <label class="col-sm-4 control-label"
                                                                   for="termination_date">Termination
                                                                Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control inputdate"
                                                                       id="termination_date" name="termination_date"
                                                                       value="{{old('termination_date')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.termination_date">
                                        <strong>@{{ validation.termination_date[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.contract}">
                                                            <label class="col-sm-4 control-label"
                                                                   for="contract">Contract</label>
                                                            <div class="col-sm-8">
                                                                <input type="file" class="form-control"
                                                                       id="contract" name="contract">
                                                                <span class="help-block" v-if="validation.contract">
                                        <strong>@{{ validation.contract[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                    <button type="submit" class="btn btn-default save">Save</button>
                                                    <button type="reset" class="btn btn-default clear">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="content tab-pane fade in" id="notifi-tab1"
                                         style="padding:15px;overflow:visible;min-height:800px;">

                                        <form method="post" class="form-horizontal"
                                              action="{{URL::to('/admin/clients/post-new-client')}}"
                                              @submit.prevent="validateNewClient">
                                            {{csrf_field()}}
                                            <input type="hidden" value="one-time" name="type">
                                            <div class="row">
                                                <div class="col-xs-12"
                                                     style="padding-bottom:15px;">
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.first_name}">
                                                            <label class="col-sm-4 control-label"
                                                                   for="first_name">Business Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="first_name"
                                                                       name="first_name"
                                                                       placeholder="John Doe"
                                                                       value="{{old('first_name')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.first_name">
                                        <strong>@{{ validation.first_name[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.street_number}">
                                                            <label class="col-sm-4 control-label" for="street_number">Street
                                                                Number</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="street_number" name="street_number"
                                                                       value="{{old('street_number')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.street_number">
                                        <strong>@{{ validation.street_number[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.street_name}">
                                                            <label class="col-sm-4 control-label" for="street_name">Street
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="street_name" name="street_name"
                                                                       value="{{old('street_name')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.street_name">
                                        <strong>@{{ validation.street_name[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.post_code}">
                                                            <label class="col-sm-4 control-label" for="post_code">Postal
                                                                Code</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="post_code" name="post_code"
                                                                       value="{{old('post_code')}}">
                                                                <span class="help-block" v-if="validation.post_code">
                                        <strong>@{{ validation.post_code[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group" :class="{'has-error':validation.city}">
                                                            <label class="col-sm-4 control-label"
                                                                   for="city">City</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="city" name="city" value="{{old('city')}}">
                                                                <span class="help-block" v-if="validation.city">
                                        <strong>@{{ validation.city[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.category}">
                                                            <label class="col-sm-4 control-label"
                                                                   for="city">Class</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control"
                                                                        id="category" name="category">
                                                                    <option value="">Select a Class</option>
                                                                    @foreach($categories as $category)
                                                                        <option @if(old('category')==$category->id) selected="selected"
                                                                                @endif value="{{$category->id}}">{{$category->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="help-block" v-if="validation.category">
                                        <strong>@{{ validation.category[0] }}</strong></span>
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
                                                <div class="col-xs-12 col-sm-6"
                                                     style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;">
                                                    <div class="title" style="border-bottom:none;padding-left:0;">
                                                        <h4 class="text-left">Operational Contact</h4>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_first_name}">
                                                            <label class="col-sm-4 control-label" for="oc_first_name">First
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="oc_first_name"
                                                                       placeholder="Cene Gatsby" name="oc_first_name"
                                                                       value="{{old('oc_first_name')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.oc_first_name">
                                        <strong>@{{ validation.oc_first_name[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_email}">
                                                            <label class="col-sm-4 control-label" for="oc_email">Email
                                                                Address</label>
                                                            <div class="col-sm-8">
                                                                <input type="email" class="form-control" id="oc_email"
                                                                       name="oc_email" value="{{old('oc_email')}}">
                                                                <span class="help-block" v-if="validation.oc_email">
                                        <strong>@{{ validation.oc_email[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_telephone}">
                                                            <label class="col-sm-4 control-label" for="oc_telephone">Primary
                                                                Telephone</label>
                                                            <div class="col-sm-8">
                                                                <input type="tel" class="form-control" id="oc_telephone"
                                                                       name="oc_telephone"
                                                                       value="{{old('oc_telephone')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.oc_telephone">
                                        <strong>@{{ validation.oc_telephone[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label"
                                                                   for="account_clone">Same for accounting
                                                                contact</label>
                                                            <div class="col-sm-8">
                                                                <input type="checkbox" class="form-control"
                                                                       id="account_clone"
                                                                       name="account_clone" value="true"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6"
                                                     style="border-top: 1px solid rgba(89, 89, 89, 0.2);border-left: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;">
                                                    <div class="title" style="border-bottom:none;padding-left:0;">
                                                        <h4 class="text-left">Accounting Contact</h4>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_first_name_2}">
                                                            <label class="col-sm-4 control-label" for="oc_first_name_2">First
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"
                                                                       id="oc_first_name_2"
                                                                       placeholder="Nate Johnson"
                                                                       name="oc_first_name_2"> <span class="help-block"
                                                                                                     v-if="validation.oc_first_name_2">
                                        <strong>@{{ validation.oc_first_name_2[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_email_2}">
                                                            <label class="col-sm-4 control-label" for="oc_email_2">Email
                                                                Address</label>
                                                            <div class="col-sm-8">
                                                                <input type="email" class="form-control" id="oc_email_2"
                                                                       name="oc_email_2" value="{{old('oc_email_2')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.oc_email_2">
                                        <strong>@{{ validation.oc_email_2[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.oc_telephone_2}">
                                                            <label class="col-sm-4 control-label" for="oc_telephone_2">Primary
                                                                Telephone</label>
                                                            <div class="col-sm-8">
                                                                <input type="tel" class="form-control"
                                                                       id="oc_telephone_2"
                                                                       name="oc_telephone_2"
                                                                       value="{{old('oc_telephone_2')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.oc_telephone_2">
                                        <strong>@{{ validation.oc_telephone_2[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6" style="padding:0;">
                                                    <div class="col-xs-12"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;"
                                                         v-for="(contact, index) in operational_contacts">
                                                        <input type="hidden" value="operational"
                                                               name="extra_contact_type[]">
                                                        <div class="title" style="border-bottom:none;padding-left:0;">
                                                            <h4 class="text-left col-xs-12" style="padding-right: 0;">
                                                                <span style="margin-top:8px;display:inline-block">Additional Operational
                                                                Contact</span>
                                                                <a @click="removeOperationalContact(index,$event)"
                                                                   class="btn btn-danger btn-sm pull-right"
                                                                   style="color: #ffffff;"
                                                                   style="margin-top: -6px" href="#"><i
                                                                            class="fa fa-times"></i></a>
                                                            </h4>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_first_name'+index">First
                                                                    Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                           :id="'extra_first_name'+index"
                                                                           placeholder="Cene Gatsby"
                                                                           name="extra_first_name[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_email'+index">Email
                                                                    Address</label>
                                                                <div class="col-sm-8">
                                                                    <input type="email" class="form-control"
                                                                           :id="'extra_email'+index"
                                                                           name="extra_email[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_telephone'+index">Primary
                                                                    Telephone</label>
                                                                <div class="col-sm-8">
                                                                    <input type="tel" class="form-control"
                                                                           :id="'extra_telephone'+index"
                                                                           name="extra_telephone[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 text-right"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px; padding-bottom: 15px;">
                                                        <button type="button" class="btn btn-primary"
                                                                @click="addOperationalContact">
                                                            Add contact
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6" style="padding:0">
                                                    <div class="col-xs-12"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-bottom:15px;"
                                                         v-for="(contact, index) in accounting_contacts">
                                                        <input type="hidden" value="accounting"
                                                               name="extra_contact_type[]">
                                                        <div class="title" style="border-bottom:none;padding-left:0;">
                                                            <h4 class="text-left col-xs-12" style="padding-right: 0">
                                                                <span style="margin-top:8px;display:inline-block">Additional Accounting
                                                                Contact</span>
                                                                <a @click="removeAccountingContact(index,$event)"
                                                                   class="btn btn-danger btn-sm pull-right"
                                                                   style="color: #ffffff;"
                                                                   style="margin-top: -6px" href="#"><i
                                                                            class="fa fa-times"></i></a>
                                                            </h4>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_first_name'+index">First
                                                                    Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                           :id="'extra_first_name'+index"
                                                                           placeholder="Cene Gatsby"
                                                                           name="extra_first_name[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_email'+index">Email
                                                                    Address</label>
                                                                <div class="col-sm-8">
                                                                    <input type="email" class="form-control"
                                                                           :id="'extra_email'+index"
                                                                           name="extra_email[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label"
                                                                       :for="'extra_telephone'+index">Primary
                                                                    Telephone</label>
                                                                <div class="col-sm-8">
                                                                    <input type="tel" class="form-control"
                                                                           :id="'extra_telephone'+index"
                                                                           name="extra_telephone[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 text-right"
                                                         style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px; padding-bottom: 15px;">
                                                        <button type="button" class="btn btn-primary"
                                                                @click="addAccountingContact">
                                                            Add contact
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12"
                                                     style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px; ">
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.alarm_code}">
                                                            <label class="col-sm-4 control-label" for="alarm_code">Alarm
                                                                Code</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="alarm_code"
                                                                       name="alarm_code" value="{{old('alarm_code')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.alarm_code">
                                        <strong>@{{ validation.alarm_code[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.lock_code}">
                                                            <label class="col-sm-4 control-label" for="lock_code">Lock
                                                                Code</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="lock_code"
                                                                       name="lock_code" value="{{old('lock_code')}}">
                                                                <span class="help-block" v-if="validation.lock_code">
                                        <strong>@{{ validation.lock_code[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.start_date}">
                                                            <label class="col-sm-4 control-label" for="start_date">Start
                                                                Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control inputdate"
                                                                       id="start_date" name="start_date"
                                                                       value="{{old('start_date')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.start_date">
                                        <strong>@{{ validation.start_date[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.payment_date}">
                                                            <label class="col-sm-4 control-label" for="payment_date">Payment
                                                                Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control inputdate"
                                                                       id="payment_date" name="payment_date"
                                                                       value="{{old('payment_date')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.payment_date">
                                        <strong>@{{ validation.payment_date[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12"
                                                     style="border-top: 1px solid rgba(89, 89, 89, 0.2);padding-top:15px;">

                                                    <div class="checkbox">

                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.telephone}">
                                                            <label class="col-sm-4 control-label" for="InputEmail">Supply
                                                                Required</label>
                                                            <div class="col-sm-8">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" value="true"
                                                                               id="supply_required"
                                                                               name="supply_required">
                                                                        <span class="cr"><i
                                                                                    class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.termination_date}">
                                                            <label class="col-sm-4 control-label"
                                                                   for="termination_date">Termination
                                                                Date</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control inputdate"
                                                                       id="termination_date" name="termination_date"
                                                                       value="{{old('termination_date')}}">
                                                                <span class="help-block"
                                                                      v-if="validation.termination_date">
                                        <strong>@{{ validation.termination_date[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group"
                                                             :class="{'has-error':validation.contract}">
                                                            <label class="col-sm-4 control-label"
                                                                   for="contract">Contract</label>
                                                            <div class="col-sm-8">
                                                                <input type="file" class="form-control inputdate"
                                                                       id="contract" name="contract"
                                                                       value="{{old('contract')}}">
                                                                <span class="help-block" v-if="validation.contract">
                                        <strong>@{{ validation.contract[0] }}</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
    <script>
        var data = {
            operational_contacts: [],
            accounting_contacts: [],
            validation: {
                first_name: '',
                street_number: '',
                street_name: '',
                city: '',
                post_code: '',
                oc_first_name: '',
                oc_email: '',
                oc_telephone: '',
                start_date: '',
                extra_first_name: '',
                extra_email: '',
                extra_telephone: '',
                category: '',
                oc_first_name_2: '',
                oc_email_2: '',
                oc_telephone_2: '',
            },
            order: [],
            checklists: [
                {title: '', items: [{name: ''}]}
            ]
        };
        var client = new Vue({
            el: '#client',
            data: data,
            methods: {
                addOperationalContact: function () {
                    this.operational_contacts.push({});
                },
                addAccountingContact: function () {
                    this.accounting_contacts.push({});
                },
                removeAccountingContact: function (index, event) {
                    event.preventDefault();
                    this.accounting_contacts.splice(index, 1);
                },
                removeOperationalContact: function (index, event) {
                    event.preventDefault();
                    this.operational_contacts.splice(index, 1);
                },
                validateNewClient: function (event) {
                    var $this = this;
                    var form = event.target;
                    var inputs = {};

                    event.target.querySelectorAll('input').forEach(function (input) {
                        var input_name = input.getAttribute('name');
                        var input_value = input.value;

                        if (input.getAttribute('type') == 'checkbox') {
                            if (input.checked) {
                                input_value = true;
                            } else {
                                input_value = false;
                            }
                        }
                        inputs[input_name] = input_value;
                    });

                    event.target.querySelectorAll('select').forEach(function (select) {
                        var select_name = select.getAttribute('name');
                        var select_value = select.value;
                        inputs[select_name] = select_value;
                    });

                    axios.post('{{route('admin.validate-add-new-client')}}', inputs).then(function (response) {
                        if (response.data.status == 'success') {
                            swal("Client created successfully !", "", "success");
                            event.target.submit();
                        }
                    }).catch(function (error) {
                        if (error.response.status) {
                            $this.validation = error.response.data.errors;
                        }
                    });
                },
                addTitle: function () {
                    this.checklists.push({title: '', order: '', items: [{name: ''}]});
                },
                addItem: function (checklist) {
                    checklist.items.push({name: ''});
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