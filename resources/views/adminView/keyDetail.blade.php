@extends('admin.master')

@section('content')
    <div class="content-wrapper" style="margin-bottom: 30px" >
        <section class="content-header">
            <h1>
                Top Up
                <small>All Data</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-paypal"></i> Payment</a></li>
                <li class="active">Top Up</li>
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

        <div class="container mt-5">
            <a href="{{route('key')}}" class="btn btn-lg btn-primary"><i class="fa fa-angle-left"></i> Keys</a>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="fa fa-paypal"></i> Top Up Detail</span>
                        </div>
                        <div class="card-body">
                            <p><span>ID : </span><span>{{$keys->id}}</span></p>
                            <p><span>Serial No : </span><span>{{$keys->serial_num}}</span></p>
                            <p><span>Pin : </span><span>{{$keys->pin}}</span></p>
                            <p><span>Amount : </span><span>{{$keys->amount->amount}} MMK</span></p>
                            <p><span>Created Date : </span><span>{{$keys->created_at}}</span></p>
                            <p><span>Print : </span><span>@if($keys->printed==true)Yes @else No @endif</span></p>
                            <p><span>Printed Date : </span><span>{{$keys->created_at}}</span></p>
                            <p><span>Topup Status : </span><span>@if($keys->used==true)Used @else Not Used @endif</span></p>
                            <p><span>View Topup User : </span>
                                @if($user!=null)
                                <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa fa-user-circle"></i>
                                </a>
                                    @else
                                    <span class="text-danger">No Info</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="collapse" id="collapseExample" style="margin-bottom: 30px">
                        <div class="card card-body bg-primary">
                            @if($user!=null)
                            <p><span>Topup User :</span><span>{{$user->name}}</span></p>
                            <p><span>User ID : </span><span>{{$user->id}}</span></p>
                            <p><span>Role : </span><span>{{$user->getRoleNames()->first()}}</span></p>
                            <p><span>Phone : </span><span></span></p>
                            <p><span>Topup Date : </span><span>{{$u->updated_at}}</span></p>
                                @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    @stop