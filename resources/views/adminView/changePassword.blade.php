@extends('admin.master')

@section('content')
    <div class="content-wrapper" >
        <section class="content-header">
            <h1>
                Setting
                <small>Change Password</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Setting</a></li>
                <li class="active">change password</li>
            </ol>
            <div class="container mt-5">
                <div class="row">
                    <a class="btn btn-outline-success btn-lg border-success" href="#">Users</a>
                </div>
            </div>
        </section>
        @if(Session('error'))
            <div class="alert alert-danger alert-dismissible mt-3 fixed-bottom" role="alert">
                {{Session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session('info'))
            <div class="alert alert-success alert-dismissible mt-3 fixed-bottom" role="alert">
                {{Session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

    <div class="container" style="height: 600px">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header bg-success">
                        <h4 class="mt-3 mb-3 ml-3" style="font-size: 24px">
                            <i class="fa fa-lock text-white" style="font-size: 30px"></i>
                            Change Password
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('change.password')}}">
                            @csrf
                            <input type="hidden" value="{{Auth::User()->id}}" name="id">

                        <div class="form-group has-feedback @if($errors->has('new_password')) has-error @endif">
                            <label class="control-label" for="new_password">
                                Enter New Password
                            </label>
                            <input type="password" class="form-control" name="new_password" id="new_password">
                            @if($errors->has('new_password'))<span class="help-block">{{$errors->first('new_password')}}</span>@endif
                        </div>
                        <div class="form-group has-feedback @if($errors->has('con_password')) has-error @endif">
                            <label class="control-label" for="con_password">
                                Enter Password Again
                            </label>
                            <input type="password" class="form-control" name="con_password" id="con_password">
                            @if($errors->has('con_password'))<span class="help-block">{{$errors->first('con_password')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success btn-lg border">Save Change</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @stop

@section('script')
    <script>
        $(document).ready(function () {
            $('.card').hover(function () {
                $(this).addClass('shadow');
            },function () {
                $(this).removeClass('shadow');
            })
        })
    </script>
    @stop