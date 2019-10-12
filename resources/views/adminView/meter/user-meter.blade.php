@extends('admin.master')

@section('content')
    <div class="content-wrapper" style="margin-bottom: 30px">
        <section class="content-header">
            <h1>
                Meters
                <small>{{Auth::User()->name}}</small>
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

        <div class="container mt-5">
            <a class="btn btn-primary btn-lg" href="{{route('meter')}}"><i class="fa fa-angle-left"></i> Meter User</a>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 border" style="border-radius: 10px">
                    <header>
                        <h1 style="font-size: 24px"><i class="fa fa-info-circle"></i> Meter Detail for {{$meter->user->name}}
                            @if(count($meter->meterD)!=0 && $meter->meterD->last()->status==false)

                            @endif
                        </h1>
                    </header>
                    <ul class="list-group">
                        <li class="list-group-item"><div class="row"><div class="col-4 text-right">Name : </div><div class="col-8">{{$meter->user->name}}</div></div></li>
                        <li class="list-group-item"><div class="row"><div class="col-4 text-right">Type : </div><div class="col-8">{{$meter->type->type}}</div></div></li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 text-right">Check Out : </div>
                                <div class="col-8">
                                    @if(count($meter->meterD)!=0)
                                    @if( $meter->meterD->last()->status==true)
                                        <span class="text-success">Yes</span>
                                        @else
                                        <span class="text-danger">NO</span>
                                            <a class="pull-right" href="{{route('meter.checkout.admin',['id'=>$meter->user->id])}}"><i class="fa fa-credit-card fa-2x"></i> </a>
                                        @endif
                                        @else
                                        <span class="text-success">Yes</span>
                                        @endif
                                </div>
                            </div></li>
                        <li class="list-group-item"><div class="row"><div class="col-4 text-right">Used Unit : </div><div class="col-8">{{$total_unit}} Units</div></div></li>
                        <li class="list-group-item"><div class="row"><div class="col-4 text-right">Created Date : </div><div class="col-8">{{$meter->created_at->format('d/M/Y')}}</div></div></li>
                        <li class="list-group-item"><div class="row"><div class="col-4 text-right">Used Amount : </div><div class="col-8">{{$total_amount}} MMK
                                    <a data-toggle="collapse" class="pull-right" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-history"></i> History</a>
                                </div></div></li>
                    </ul>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            @foreach($meter->meterD as $md)
                                @if($md->status==true)
                                <li class="list-group-item bg-primary">
                                    <div class="row">
                                        <div class="col-2">{{$md->pre_unit}} - {{$md->curr_unit}}</div>
                                        <div class="col-3 text-danger">{{$md->amount}} MMK</div>
                                        <div class="col-3">{{$md->rate}} units</div>
                                        <div class="col-4">{{$md->created_at->format('d/M/Y')}}</div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    @stop