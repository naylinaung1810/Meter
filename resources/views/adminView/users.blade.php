@extends('admin.master')

@section('content')
    <div class="content-wrapper" style="margin-bottom: 30px">
        <section class="content-header">
            <h1>
                Users
                <small>All users</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Users</li>
            </ol>
            <div class="container mt-5">
                <div class="row">
                    <a class="btn btn-outline-success border-success btn-lg" href="{{route('new-user')}}">New User</a>
                </div>
            </div>
        </section>

        <div class="container mt-5" >
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead style="border-radius: 10px;font-size: 18px">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                    <th>cdc</th>
                                    <th>Created At</th>

                                </tr>
                                </thead>
                                @foreach($users as $user)
                                        <tr class="@if($user->auth_check!=true) bg-danger @endif">
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->getRoleNames()->first()}}</td>
                                            <td><span class="text-success">{{$user->total_amount}}</span> MMK</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class=" dropdown-toggle text-success" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cogs"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item text-primary" data-toggle="modal" data-target="#e{{$user->id}}" href="#"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="#" @if(Auth::User()->name!=$user->name) data-toggle="modal" data-target="#d{{$user->id}}" @endif class="dropdown-item text-danger"><i class="fa fa-trash"></i> Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="e{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <form method="post" action="{{route('edit.user')}}">
                                                        <div class="modal-content border-success" style="border-radius: 10px;border: 1px solid">
                                                            <div class="modal-header border-success" style="border-bottom: 1px solid">
                                                                <h4 class="modal-title" id="myModalLabel" style="font-size: 24px">
                                                                    <i class="fa fa-edit text-success fa-2x"></i> Edit user <b>"{{$user->name}}"</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                                <div class="form-group has-feedback @if($errors->has('name')) has-error @endif">
                                                                    <label for="name" class="control-label">Username</label>
                                                                    <input value="{{$user->name}}" type="text" name="name" id="name" class="form-control">
                                                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                                                    @if($errors->has('name')) <span class="help-block">{{$errors->first('name')}}</span> @endif
                                                                </div>
                                                                <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
                                                                    <label for="email" class="control-label">Email Address</label>
                                                                    <input value="{{$user->email}}" type="email" name="email" id="email" class="form-control">
                                                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                                                    @if($errors->has('email')) <span class="help-block">{{$errors->first('email')}}</span> @endif
                                                                </div>
                                                                <div class="form-group has-feedback @if($errors->has('role')) has-error @endif">
                                                                    <label for="role" class="control-label">Roles</label>
                                                                    <select name="role" id="role" class="form-control">
                                                                        <option value="">Select Role</option>
                                                                        @foreach($roles as $role)
                                                                            <option @if($user->roles->first()->id == $role->id) selected  @endif>{{$role->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="fa fa-user-md form-control-feedback"></span>
                                                                    @if($errors->has('role')) <span class="help-block">{{$errors->first('role')}}</span> @endif
                                                                </div>
                                                                <div class="form-group has-feedback @if($errors->has('verify')) has-error @endif">
                                                                    <label for="verify" class="control-label">Permission</label>
                                                                    <select name="verify" id="verify" class="form-control">
                                                                        <option value="">Select</option>
                                                                            <option @if($user->auth_check==true) selected  @endif value="1">true</option>
                                                                            <option @if($user->auth_check!=true) selected  @endif value="0">false</option>
                                                                    </select>
                                                                    <span class="fa fa-user-md form-control-feedback"></span>
                                                                    @if($errors->has('verify')) <span class="help-block">{{$errors->first('verify')}}</span> @endif
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer border-success" style="border-top: 1px solid" >
                                                                <div class="mt-3 mb-3">
                                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="border: 1px solid">Close</button>
                                                                <button type="submit" class="btn btn-outline-success" style="border: 1px solid">Confirm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{csrf_field()}}
                                                    </form>
                                                </div>
                                            </div>


                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="d{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <form method="post" action="{{route('remove.user')}}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> confirm delete user account</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body text-danger">
                                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                                Are you sure want to delete this user account name of <b>"{{$user->name}}"</b>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                                            </div>

                                                        </div>
                                                        {{csrf_field()}}
                                                    </form>
                                                </div>
                                            </div><td><a href="{{route('user.detail',['id'=>$user->id])}}"><i class="fa fa-user"></i> </a> </td>
                                            <td>{{$user->created_at}}</td>

                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
        @stop

@section('script')
    <script>
        // $(document).ready(function () {
        //     $("table tr").click(function () {
        //         $(this).css("background-color", "yellow");
        //        // alert($(this).parent());
        //     })

        //})
    </script>
    @stop