@extends('admin.master')

@section('content')
    <div class="content-wrapper" style="margin-bottom: 30px">
        <section class="content-header">
            <h1>
                Top Up
                <small>All Data</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-paypal"></i> Payment</a></li>
                <li class="active">Top Up</li>
            </ol>
            <div class="container mt-5">
                <div class="row">
                    <a class="btn btn-outline-success border-success btn-lg" href="#" data-toggle="modal" data-target="#key_gen">
                        <i class="fa fa-plus"></i>
                        Add Key</a>
                </div>
            </div>
        </section>

        @if(Session('info'))
            <div class="alert alert-success alert-dismissible mt-3 fixed-bottom" role="alert">
                {{Session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    @endif

        <!-- Modal -->
        <div class="modal fade" id="key_gen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{route('key.create')}}" method="post">
                    @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group has-feedback @if($errors->has('amount')) has-error @endif">
                            <label for="amount" class="control-label">Amount</label>
                            <select name="amount" id="amount" class="form-control">
                                <option value="" disabled>Select Amount</option>
                                @foreach($amounts as $amount)
                                    <option value="{{$amount->id}}">{{$amount->amount}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('amount')) <span class="help-block">{{$errors->first('amount')}}</span> @endif
                        </div>
                        <div class="form-group has-feedback @if($errors->has('count')) has-error @endif">
                            <label class="control-label" for="count">
                                Count
                            </label>
                            <input type="number" class="form-control" name="count" id="new_password">
                            @if($errors->has('count'))<span class="help-block">{{$errors->first('count')}}</span>@endif
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row table-responsive">
                <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Serial Number</th>
                        <th>Pin</th>
                        <th>Amount</th>
                        <th>Action</th>
                        <th>Print</th>
                        <th>Used</th>
                        <th>Detail</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    @foreach($keys as $key)
                        <tr class="">
                            <td>{{$key->id}}</td>
                            <td>{{$key->serial_num}}</td>
                            <td>{{$key->pin}}</td>
                            <td>{{$key->amount->amount}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class=" dropdown-toggle text-success" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item text-primary" href="#"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="#" class="dropdown-item text-danger"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </td>
                            <td>@if($key->printed!=true)<a href="#" class="text-danger">Not print</a> @else <span class="text-success">Printed</span> @endif</td>
                            <td>@if($key->used==true)<span class="text-danger">Used</span> @else <span class="text-success">Not use</span> @endif</td>
                            <td><a class="" href="{{route('key.detail',['id'=>$key->id])}}">
                                     <i class="fa fa-reply-all"></i>
                                    </a> </td>
                            <td>{{$key->created_at}}</td>
                        </tr>
                        @endforeach
                </table>
                </div>
            </div>
        </div>

    </div>
    @stop