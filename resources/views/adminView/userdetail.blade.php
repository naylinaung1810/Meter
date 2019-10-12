@extends('admin.master')

@section('content')
    <div class="content-wrapper" style="margin-bottom: 30px">
        <section class="content-header">
            <h1>
                User Detail
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">User detail</li>
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

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card border" style="border-radius: 10px">
                        <div class="card-header">
                            <span class="text-primary" style="font-size: 20px"><i class="fa fa-user"></i> {{$user->name}}</span>
                        </div>
                        <div class="">
                            <ul class="list-group">
                                <li class="list-group-item"><span>Name : </span><span>{{$user->name}}</span></li>
                                <li class="list-group-item"><span>Email : </span><span>{{$user->email}}</span></li>
                                <li class="list-group-item"><span>Status : </span><span>@if($user->auth_check==true) active @else not active @endif</span></li>
                                <li class="list-group-item"><span>Role : </span><span>{{$user->getRoleNames()->first()}}</span></li>
                                <li class="list-group-item"><span>Meter : </span>
                                    <span><a data-toggle="collapse" href="#muserCollapse" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-user fa-2x ml-5"></i> </a></span>
                                </li>
                            </ul>
                            <div class="collapse" id="muserCollapse">
                                <ul class="list-group">
                                    <li class="list-group-item bg-primary"><span>Meter Owner : </span><span>{{$meter->user->name}}</span></li>
                                    <li class="list-group-item bg-primary"><span>Meter Type : </span><span>{{$meter->type->type}}</span></li>
                                    <li class="list-group-item bg-primary"><span>Meter Used Unit : </span><span>{{$total_unit}}</span> units</li>
                                    <li class="list-group-item bg-primary"><span>Meter Created Date : </span><span>{{$meter->created_at}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{--<div class="mt-3">--}}
                        {{--<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#topModal"><i class="fa fa-money"></i> </a>--}}
                    {{--</div>--}}
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-money"></i> Billing Information
                                </div>
                                <div class="card-body">
                                    <p><span>Current Bills : </span><a class="text-success" data-toggle="collapse" href="#amountCollapse" aria-expanded="false" aria-controls="collapseExample">
                                           {{$user->total_amount}} MMK
                                        </a>
                                    </p>
                                    <div class="collapse" id="amountCollapse">
                                        <ul class="list-group">
                                            @foreach($keys as $key)
                                                <li class="list-group-item"><p><span>@foreach($amount as $aa) @if($aa->id==$key->amount_id) <span class="text-success" style="font-size: 18px">{{$aa->amount}}</span> MMK @endif @endforeach</span><span class="pull-right">{{$key->updated_at}}</span></p></li>

                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-money"></i> Meter Top Up Information
                                </div>
                                <div class="card-body">
                                    <p><span>Current used amount : </span><a class="text-success" data-toggle="collapse" href="#meterCollapse" aria-expanded="false" aria-controls="collapseExample">
                                            {{$total_cost}} MMK
                                        </a>
                                    </p>
                                    <div class="collapse" id="meterCollapse">
                                        <ul class="list-group">
                                            @foreach($meter->meterD as $m)
                                                <li class="list-group-item bg-primary"><p><span class="text-danger">{{$m->amount}}</span> MMK<span class="pull-right">{{$m->created_at}}</span></p></li>

                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <span>Login Information</span>
                                </div>
                            </div>
                            <div class="card-body border bg-white">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="text-center">Login</h4>
                                        <hr>
                                        <div>
                                            @foreach($log as $l)
                                                @if($l->status==true)
                                                    <p class="text-center">{{$l->created_at}}</p>
                                                    @endif
                                                @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="text-center">Logout</h4>
                                        <hr>
                                        <div>
                                            @foreach($log as $l)
                                                @if($l->status==false)
                                                    <p class="text-center">{{$l->created_at}}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @stop