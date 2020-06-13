@extends('layouts.common')

@section('content')
    @include('layouts.headers.admin')
    <section class="page-content dashboard" id="cleaners">

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
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                    <div class="second-navbar page">
                        <ul>
                            <li><a href="{{URL::to('/admin/cleaners/login-details')}}">Login Details</a></li>
                            <li class="active"><a href="{{URL::to('/admin/cleaners')}}">Cleaner Information</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- /end Page header  -->

        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 card-contener">

                    <div class="card form-card ">

                        <div class=" row title">
                            <div class="col-md-3">
                                <h4 class="text-left">Create New Cleaner</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="panel-heading">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#notifi-tab1" data-toggle="tab">Cleaner</a></li>
                                        <li><a href="#notifi-tab2" data-toggle="tab">Sub-Contractor</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h4 class="text-right goBack" style="float:right;"><a
                                            href="{{URL::to('/admin/cleaners')}}"> Cleaner Overview</a></h4>
                            </div>
                        </div>

                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="content tab-pane fade in active " id="notifi-tab1" style="overflow:visible;">
                                        <form id="create-new-cleaner" method="post" enctype="multipart/form-data"
                                              @submit.prevent="validateCleaner($event)" class="form-horizontal"
                                              action="{{URL::to('admin/cleaners/post-new-cleaner')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="type" value="cleaner">
                                            <div class="col-sm-6">
                                                <div class="form-group" :class="{ 'has-error': cleaner_validation.first_name }">
                                                    <label class="col-sm-4 control-label" for="first_name">First Name <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="first_name" id="first_name" name="first_name" value="{{old('first_name')}}">
                                                        <span class="help-block" v-if="cleaner_validation.first_name">
                                                            <strong>@{{ cleaner_validation.first_name[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group" :class="{ 'has-error': cleaner_validation.last_name }">
                                                    <label class="col-sm-4 control-label" for="last_name">Last Name <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{old('last_name')}}">
                                                        <span class="help-block" v-if="cleaner_validation.last_name">
                                                            <strong>@{{ cleaner_validation.last_name[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group" :class="{ 'has-error': cleaner_validation.street_number }">
                                                    <label class="col-sm-4 control-label" for="street_number">Street Number <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="street_number" name="street_number" value="{{old('street_number')}}">
                                                        <span class="help-block" v-if="cleaner_validation.street_number">
                                                            <strong>@{{ cleaner_validation.street_number[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group" :class="{ 'has-error': cleaner_validation.street_name }">
                                                    <label class="col-sm-4 control-label" for="street_name">Street Name <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="street_name" id="street_name" value="{{old('street_name')}}">
                                                        <span class="help-block" v-if="cleaner_validation.street_name">
                                                            <strong>@{{ cleaner_validation.street_name[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group" :class="{ 'has-error': cleaner_validation.city }">
                                                    <label class="col-sm-4 control-label"
                                                           for="city">City <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="city"
                                                               id="city" value="{{old('city')}}">
                                                        <span class="help-block" v-if="cleaner_validation.city">
                                                            <strong>@{{ cleaner_validation.city[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': cleaner_validation.post_code }">
                                                    <label class="col-sm-4 control-label" for="post_code">Postal Code <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="post_code"
                                                               id="post_code" value="{{old('post_code')}}">
                                                        <span class="help-block" v-if="cleaner_validation.post_code">
                                                            <strong>@{{ cleaner_validation.post_code[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group" :class="{ 'has-error': cleaner_validation.email }">
                                                    <label class="col-sm-4 control-label" for="email">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" name="email"
                                                               id="email" value="{{old('email')}}">
                                                        <span class="help-block" v-if="cleaner_validation.email">
                                                            <strong>@{{ cleaner_validation.email[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': cleaner_validation.username }">
                                                    <label class="col-sm-4 control-label"
                                                           for="username">Username <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="username"
                                                               id="username" value="{{old('username')}}">
                                                        <span class="help-block" v-if="cleaner_validation.username">
                                                            <strong>@{{ cleaner_validation.username[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': cleaner_validation.telephone }">
                                                    <label class="col-sm-4 control-label" for="telephone">Home Telephone Number <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="tel" class="form-control" name="telephone"
                                                               id="telephone" value="{{old('telephone')}}">
                                                        <span class="help-block" v-if="cleaner_validation.telephone">
                                                            <strong>@{{ cleaner_validation.telephone[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': cleaner_validation.mobile }">
                                                    <label class="col-sm-4 control-label" for="mobile">Mobile Telephone <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="tel" class="form-control" name="mobile"
                                                               id="mobile" value="{{old('mobile')}}">
                                                        <span class="help-block" v-if="cleaner_validation.mobile">
                                                            <strong>@{{ cleaner_validation.mobile[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': cleaner_validation.first_name }">
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control " style="visibility:hidden;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': cleaner_validation.start_date }">
                                                    <label class="col-sm-4 control-label" for="start_date">Start Date <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control inputdate"
                                                               id="start_date" name="start_date"
                                                               value="{{old('start_date')}}">
                                                        <span class="help-block" v-if="cleaner_validation.start_date">
                                                            <strong>@{{ cleaner_validation.start_date[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': cleaner_validation.docs }">
                                                    <label class="col-sm-4 control-label" for="docs">Upload
                                                        Docs</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class=" file" id="docs" name="docs">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control" disabled>
                                                            <span class="input-group-btn">
                                                                <button class="browse btn btn-primary" type="button">
                                                                    <img class="svg Green"
                                                                         src="{{URL::asset('assets/assets/Upload.svg')}}"
                                                                         alt="info" width="33"
                                                                         height="33"></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                <button type="submit" class="btn btn-default save">Save & Continue
                                                </button>
                                                <button type="reset" class="btn btn-default clear">Clear</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--/end tab-pane-->

                                    <div class="content tab-pane fade in " id="notifi-tab2" style="overflow:visible;">
                                        <form id="create-new-cleaner" method="post" enctype="multipart/form-data"
                                              @submit.prevent="validateSubContractor($event)" class="form-horizontal"
                                              action="{{URL::to('admin/cleaners/post-new-cleaner')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="type" value="contractor">
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.first_name }">
                                                    <label class="col-sm-4 control-label"
                                                           for="first_name">Name <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="first_name"
                                                               id="first_name" value="{{old('first_name')}}">
                                                        <span class="help-block" v-if="sub_contractor_validation.first_name">
                                                            <strong>@{{ sub_contractor_validation.first_name[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.street_number }">
                                                    <label class="col-sm-4 control-label" for="street_number">Street
                                                        Number <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="street_number"
                                                               id="street_number" value="{{old('street_number')}}">
                                                        <span class="help-block" v-if="sub_contractor_validation.street_number">
                                                            <strong>@{{ sub_contractor_validation.street_number[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.street_name }">
                                                    <label class="col-sm-4 control-label" for="street_name">Street
                                                        Name <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="street_name"
                                                               id="street_name" value="{{old('street_name')}}">
                                                        <span class="help-block" v-if="sub_contractor_validation.street_name">
                                                            <strong>@{{ sub_contractor_validation.street_name[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.post_code }">
                                                    <label class="col-sm-4 control-label" for="post_code">Postal
                                                        Code <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="post_code"
                                                               id="post_code" value="{{old('post_code')}}">
                                                        <span class="help-block" v-if="sub_contractor_validation.post_code">
                                                            <strong>@{{ sub_contractor_validation.post_code[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.city }">
                                                    <label class="col-sm-4 control-label"
                                                           for="city">City <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="city"
                                                               id="city" value="{{old('city')}}">
                                                        <span class="help-block" v-if="sub_contractor_validation.city">
                                                            <strong>@{{ sub_contractor_validation.city[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.telephone }">
                                                    <label class="col-sm-4 control-label" for="telephone">Home
                                                        Telephone
                                                        Number <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="tel" class="form-control" name="telephone"
                                                               id="telephone" value="{{old('telephone')}}">
                                                        <span class="help-block" v-if="sub_contractor_validation.telephone">
                                                            <strong>@{{ sub_contractor_validation.telephone[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.email }">
                                                    <label class="col-sm-4 control-label" for="email">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" name="email"
                                                               id="email" value="{{old('email')}}">
                                                        <span class="help-block" v-if="sub_contractor_validation.email">
                                                            <strong>@{{ sub_contractor_validation.email[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.username }">
                                                    <label class="col-sm-4 control-label"
                                                           for="username">Username <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="username"
                                                               id="username" value="{{old('username')}}">
                                                        <span class="help-block" v-if="sub_contractor_validation.username">
                                                            <strong>@{{ sub_contractor_validation.username[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.first_name }">
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control "
                                                               style="visibility:hidden;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.mobile }">
                                                    <label class="col-sm-4 control-label" for="mobile">Mobile
                                                        Telephone <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="tel" class="form-control" name="mobile"
                                                               id="mobile" value="{{old('mobile')}}">
                                                        <span class="help-block" v-if="sub_contractor_validation.mobile">
                                                            <strong>@{{ sub_contractor_validation.mobile[0] }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.docs }">
                                                    <label class="col-sm-4 control-label" for="docs">Upload
                                                        Docs</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class=" file" id="docs" name="docs">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control" disabled>
                                                            <span class="input-group-btn">
                              <button class="browse btn btn-primary" type="button"><img class="svg Green"
                                                                                        src="{{URL::asset('assets/assets/Upload.svg')}}"
                                                                                        alt="info" width="33"
                                                                                        height="33"></button>
                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"
                                                     :class="{ 'has-error': sub_contractor_validation.start_date }">
                                                    <label class="col-sm-4 control-label" for="start_date">Start
                                                        Date <span style="color: #ff0000;"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control  inputdate"
                                                               id="start_date" name="start_date">
                                                    </div>
                                                    <span class="help-block" v-if="sub_contractor_validation.start_date">
                                                        <strong>@{{ sub_contractor_validation.start_date[0] }}</strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button-control">
                                                <button type="submit" class="btn btn-default save">Save & Continue
                                                </button>
                                                <button type="reset" class="btn btn-default clear">Clear</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--/end tab-pane-->

                                </div>
                            </div>
                            <!--/end   panel-body -->

                            <div class="cord-footer">

                                <!-- end panel-heading -->
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
            cleaner_validation: [
                {first_name: []},
                {last_name: []},
                {mobile: []},
                {telephone: []},
                {street_number: []},
                {street_name: []},
                {city: []},
                {post_code: []},
                {email: []},
                {start_date: []},
                {username: []},
            ],
            sub_contractor_validation: [
                {first_name: []},
                {last_name: []},
                {mobile: []},
                {telephone: []},
                {street_number: []},
                {street_name: []},
                {city: []},
                {post_code: []},
                {email: []},
                {start_date: []},
                {username: []},
            ],

        };
        var cleaners = new Vue({
            el: '#cleaners',
            data: data,
            methods: {
                validateCleaner: function (event) {
                    var elements = event.target.elements;

                    this.cleaner_validation = [
                        {first_name: []},
                        {last_name: []},
                        {mobile: []},
                        {telephone: []},
                        {street_number: []},
                        {street_name: []},
                        {city: []},
                        {post_code: []},
                        {email: []},
                        {start_date: []},
                        {username: []},
                    ];
                    var $this = this;

                    var form_elements = {};
                    for (var i = 0; i < elements.length; i++) {
                        form_elements[elements[i].getAttribute('name')] = elements[i].value;
                    }


                    axios.post('{{URL::to('/admin/cleaners/validate-new-cleaner')}}', form_elements)
                        .then(function (response) {
                            if (response.data.message == 'Failed') {
                                $this.cleaner_validation = response.data.validation;
                            } else if (response.data.message == 'Success') {
                                event.target.submit();
                            } else {
                                console.log(response);
                            }
                        })
                        .catch(function (error) {
                            if (error.response) {
                                var errors = error.response.data.errors;
                                console.log(errors);
                            }
                        });
                },
                validateSubContractor: function (event) {
                    var elements = event.target.elements;

                    this.sub_contractor_validation = [
                        {first_name: []},
                        {last_name: []},
                        {mobile: []},
                        {telephone: []},
                        {street_number: []},
                        {street_name: []},
                        {city: []},
                        {post_code: []},
                        {email: []},
                        {start_date: []},
                        {username: []},
                    ];
                    var $this = this;

                    var form_elements = {};
                    for (var i = 0; i < elements.length; i++) {
                        form_elements[elements[i].getAttribute('name')] = elements[i].value;
                    }

                    axios.post('{{URL::to('/admin/cleaners/validate-new-cleaner')}}', form_elements)
                        .then(function (response) {
                            if (response.data.message == 'Failed') {
                                $this.sub_contractor_validation = response.data.validation;
                            } else if (response.data.message == 'Success') {
                                event.target.submit();
                            } else {
                                console.log(response);
                            }
                        })
                        .catch(function (error) {
                            if (error.response) {
                                var errors = error.response.data.errors;
                                console.log(errors);
                            }
                        });
                }
            }
        });
    </script>
@endsection