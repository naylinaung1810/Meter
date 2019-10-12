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
            <div class="col-12">
                <p class="pull-right">

                </p>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card border" style="border-radius: 10px">
                    <div class="card-header">
                        Account Information
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><span>Name : </span><span>{{Auth::User()->name}}</span></li>
                            <li class="list-group-item"><span>Email : </span><span>{{Auth::User()->email}}</span></li>
                            <li class="list-group-item"><span>role : </span><span>{{Auth::User()->getRoleNames()->first()}}</span></li>
                            <li class="list-group-item"><span>Bills : </span><a class="" data-toggle="collapse" href="#amountCollapse" aria-expanded="false" aria-controls="collapseExample">
                                    {{Auth::User()->total_amount}} MMK
                                </a>
                                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#topModal"><i class="fa fa-plus-square"></i> </a>
                            </li>
                            <div class="collapse" id="amountCollapse">
                                <div class="card card-body">
                                    @foreach($keys as $key)
                                        <p class="list-group-item bg-primary">
                                            <span>@foreach($amount as $aa) @if($aa->id==$key->amount_id) <span class="text-success" style="font-size: 18px">{{$aa->amount}}</span> MMK @endif @endforeach</span>
                                            <span class="pull-right">{{$key->updated_at}}</span>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span>Meter Top Up</span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                        <li class="list-group-item"><div class="row"><div class="col-4 text-right">Name : </div><div class="col-8">{{$meters->user->name}}</div></div></li>
                        <li class="list-group-item"><div class="row"><div class="col-4 text-right">Type : </div><div class="col-8">{{$meters->type->type}}</div></div></li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 text-right">Check Out : </div>
                                <div class="col-8">
                                    @if(count($meters->meterD)!=0)
                                    @if(count($meters->meterD)!=0 && $meters->meterD->last()->status==true)
                                        <span class="text-success">Yes</span>
                                    @else
                                        <span class="text-danger">NO</span>
                                        <a class="pull-right" href="#" data-toggle="modal" data-target="#meterModal"><i class="fa fa-check-circle-o fa-2x"></i> </a>
                                    @endif
                                        @else
                                        <span class="text-success">Yes</span>
                                    @endif
                                </div>
                            </div></li>
                        <li class="list-group-item"><div class="row"><div class="col-4 text-right">Used Unit : </div><div class="col-8">{{$unit}} Units</div></div></li>
                        <li class="list-group-item"><div class="row"><div class="col-4 text-right">Created Date : </div><div class="col-8">{{$meters->created_at->format('d/M/Y')}}</div></div></li>
                            <li class="list-group-item"><div class="row"><div class="col-4 text-right">Used Cost : </div><div class="col-8 text-success">{{$cost}} MMK <span class="pull-right">
                                    <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fa fa-folder"></i> History</a> </span>
                                    </div>
                            </div>
                        </li>
                        </ul>
                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            @if(count($meters->meterD)!=0)
                            @foreach($meters->meterD as $meter)
                                @if($meter->status==true)
                                <li class="list-group-item bg-primary">
                                    <div class="row">
                                        <div class="col-2">{{$meter->pre_unit}} - {{$meter->curr_unit}}</div>
                                        <div class="col-3 text-danger">{{$meter->amount}} MMK</div>
                                        <div class="col-3">{{$meter->rate}} units</div>
                                        <div class="col-4">{{$meter->created_at}}</div>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!--Top Up Modal -->
        <div class="modal fade" id="topModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{route('account.bill')}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter PIN ......" name="pin" style="border-radius: 5px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!--End Top Up Modal-->

        <!--Meter Modal -->
        <div class="modal fade" id="meterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{route('meter.checkout')}}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @if(count($meters->meterD)!=0)
                            <input type="hidden" name="meter_id" value="{{\App\Meter::where('user_id',Auth::User()->id)->first()->id}}">
                            <div class="row"><div class="col-6">Owner : </div><div class="col-6">{{$meters->user->name}}</div></div>
                            <hr>
                            <div class="row"><div class="col-6">Previous : </div><div class="col-6">{{$meters->meterD->last()->pre_unit}} units</div></div>
                            <hr>
                            <div class="row"><div class="col-6">Current : </div><div class="col-6">{{$meters->meterD->last()->curr_unit}} units</div></div>
                            <hr>
                            <div class="row"><div class="col-6">Unit : </div><div class="col-6">{{$meters->meterD->last()->rate}} units</div></div>
                            <hr>
                            <div class="row"><div class="col-6">Amount : </div><div class="col-6">{{$meters->meterD->last()->amount}} MMK</div></div>
                                @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Meter Modal-->

    </div>
    @stop