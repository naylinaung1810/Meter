@extends('admin.master')

@section('content')
    <div class="content-wrapper" style="margin-bottom: 30px">
        <section class="content-header">
            <h1>
                Meters
                <small>All Data</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-paypal"></i> dashboard</a></li>
                <li class="active">meter</li>
            </ol>
        </section>

        @if(Session('info'))
            <div class="alert alert-success alert-dismissible mt-3 fixed-bottom" role="alert">
                {{Session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session('error'))
            <div class="alert alert-danger alert-dismissible mt-3 fixed-bottom" role="alert">
                {{Session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    @endif

        <div class="container-fluid mt-5" style="margin-bottom: 30px">
            <div class="form-group ml-3">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#meterModal">
                    <i class="fa fa-plus"></i> Add Meter
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="meterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="{{route('meter.new')}}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="meterModalLabel">
                                <i class="fa fa-plus-square"></i>
                                Add New Meter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group has-feedback @if($errors->has('user')) has-error @endif">
                                <label for="user" class="control-label">Username</label>
                                <input list="users" name="user" class="form-control">
                                <datalist id="users">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </datalist>

                                <span class="fa fa-user-md form-control-feedback"></span>
                                @if($errors->has('user')) <span class="help-block">{{$errors->first('user')}}</span> @endif
                            </div>
                            <div class="form-group has-feedback @if($errors->has('type')) has-error @endif">
                                <label for="type" class="control-label">Meter Type</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="" disabled>--Select Type--</option>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->type}}</option>
                                    @endforeach
                                </select>

                                <span class="fa fa-folder form-control-feedback"></span>
                                @if($errors->has('type')) <span class="help-block">{{$errors->first('type')}}</span> @endif
                            </div>
                            <div class="form-group has-feedback @if($errors->has('home')) has-error @endif">
                                <label for="home" class="control-label">Home No</label>
                                <input type="number" name="home" id="home" class="form-control">
                                <span class="glyphicon glyphicon-home form-control-feedback"></span>
                                @if($errors->has('home')) <span class="help-block">{{$errors->first('home')}}</span> @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success " style="font-size: 16px">Save User</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- End Modal-->

            <div class="row">
                <div class="col-12">
                        <div class="table-responsive border" style="border-radius: 10px">
                            <table class="table table-hover">
                                <thead style="background: gainsboro">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Home No</th>
                                    <th>Meter Type</th>
                                    <th>Detail</th>
                                    <th>Created Date</th>
                                </tr>
                                </thead>
                                @foreach($meters as $meter)
                                <tr class="@if(count($meter->meterD)!=0 && $meter->meterD->last()->status==false) bg-warning @endif">
                                    <td>{{$meter->id}}</td>
                                    <td>{{$meter->user->name}}</td>
                                    <td>{{$meter->home}}</td>
                                    <td>{{$meter->type->type}}</td>
                                    <td><a href="{{route('meter.user',['id'=>$meter->user->id])}}" style="font-size: 20px"><i class="fa fa-info-circle"></i> </a> </td>
                                    <td>{{$meter->created_at}}</td>
                                </tr>
                                    @endforeach
                            </table>
                        </div>
                </div>
            </div>
        </div>

    </div>
    @stop