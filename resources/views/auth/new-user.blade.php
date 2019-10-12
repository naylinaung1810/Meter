@extends('admin.master')

@section('content')
    <div class="content-wrapper" >
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">New user</li>
        </ol>
        <div class="container mt-5">
            <div class="row">
                <a class="btn btn-outline-success btn-lg border-success" href="{{route('users')}}">Users</a>
            </div>
        </div>
    </section>

    <div class="container" style="height: 600px">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card border">
                    <div class="card-header bg-secondary" style="font-size: 24px">
                        <div class="mt-3 mb-3 ml-3">
                            <i class="fa fa-plus-square text-white" style="font-size: 30px"></i>
                            <span>Add New User</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('new-user')}}">
                            <div class="form-group has-feedback @if($errors->has('name')) has-error @endif">
                                <label for="name" class="control-label">Username</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if($errors->has('name')) <span class="help-block">{{$errors->first('name')}}</span> @endif
                            </div>
                            <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
                                <label for="email" class="control-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if($errors->has('email')) <span class="help-block">{{$errors->first('email')}}</span> @endif
                            </div>
                            <div class="form-group has-feedback @if($errors->has('role')) has-error @endif">
                                <label for="role" class="control-label">Roles</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <span class="fa fa-user-md form-control-feedback"></span>
                                @if($errors->has('role')) <span class="help-block">{{$errors->first('role')}}</span> @endif
                            </div>
                            <div class="form-group has-feedback @if($errors->has('password')) has-error @endif">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if($errors->has('password')) <span class="help-block">{{$errors->first('password')}}</span> @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary btn-lg" style="border: 1px solid">Create</button>
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    @stop