<div class="second-header">
    <div class="container">
        <div class="row">
            <div class=" col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <h2>Admin</h2>
            </div>
            <div class=" col-xs-12 col-sm-7 col-md-7 col-lg-7 "> 
                <div class="second-navbar">
                    <ul>
                        <li><a href="{{URL::to('admin/administrators')}}">Administrators</a></li>
                        <li><a href="{{URL::to('admin/clients')}}">Clients</a></li>
                        <li><a href="{{URL::to('admin/cleaners')}}">Cleaners</a></li>
                        <li><a href="{{URL::to('admin/inspectors')}}">Inspectors</a></li>
                        <li><a href="{{URL::to('admin/user-management')}}">User Management</a></li>
                        {{--<li><a href="{{URL::to('admin/alerts')}}">Alerts</a></li>--}}
                    </ul>
                </div>

            </div>
            {{--<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">--}}
                {{--<form class="navbar-form navbar-right">--}}
                    {{--<div id="custom-search-input">--}}
                        {{--<div class="input-group col-md-12">--}}
                            {{--<span class="input-group-btn">--}}
                                {{--<button class="btn btn-info " type="button">--}}
                                    {{--<img class="svg" src="{{URL::asset('/assets/assets/Search.svg')}}" alt="info"--}}
                                         {{--width="28"--}}
                                         {{--height="23">--}}
                                {{--</button>--}}
                            {{--</span>--}}
                            {{--<input type="text" class="form-control typeahead" placeholder="Search"--}}
                                   {{--data-provide="typeahead"/>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        </div>
    </div>
</div>

<script type="text/javascript">
    {{--window.addEventListener('load', function () {--}}

        {{--var $input = $(".typeahead");--}}

        {{--$.get('{{URL::to('/admin/ajax-get-entities')}}', function (data) {--}}

            {{--$input.typeahead({--}}
                {{--source: data,--}}
                {{--autoSelect: true--}}
            {{--});--}}
        {{--});--}}


        {{--$input.change(function () {--}}
            {{--var current = $input.typeahead("getActive");--}}
            {{--if (current) {--}}
                {{--// Some item from your model is active!--}}
                {{--if (current.name == $input.val()) {--}}
                    {{--window.location.href = '{{URL::to('admin/entity-search-result/')}}' + '/' + current.id + '/' + current.entity;--}}
                {{--}--}}
            {{--} else {--}}
                {{--// Nothing is active so it is a new value (or maybe empty value)--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}
</script>