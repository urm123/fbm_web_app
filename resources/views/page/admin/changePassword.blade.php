@extends('layouts.common')
@section('content')
    @include('layouts.headers.admin')
    <div class="container">
        <br />
        <div class="row justify-content-center">
            <div class="col-sm-4 col-md-4 col-sm-offset-4">
                @if(session('changeStatus'))

                    <div class="alert alert-success alert-dismissible" role="alert" style="text-align: center;">
                        {{ session('changeStatus') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
{{--            <div class="col-sm-8 col-md-8 col-sm-offset-2">--}}
{{--                @if(session('changeStatus'))--}}
{{--                    {{ session('changeStatus') }}--}}
{{--                @endif--}}
{{--            </div>--}}
            <div class="col-sm-2 col-md-2"></div>
            <div class="col-sm-8 col-md-8">
                <div class="card" align="center">
                    <br />
                    <div class="card-header"><b>Change Your Password !</b></div>
                    <br />
                    <div class="card-body">
                        <form method="POST" action="{{ route('change.password') }}">
                            {{ csrf_field() }}
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-md-2"></div>
        </div>
    </div>
@endsection
