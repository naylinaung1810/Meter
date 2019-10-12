@extends('admin.master')

@section('content')
    <div class="content-wrapper" style="margin-bottom: 40px">
        <section class="content-header">
            <h1>
                Top Up
                <small>All Barcode</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-paypal"></i> Payment</a></li>
                <li class="active">Barcode</li>
            </ol>
            <div class="container mt-5">
                <div class="row">
                    <a class="btn btn-outline-success border-success btn-lg" href="{{route('key.print')}}">
                        <i class="fa fa-print"></i>
                        Print</a>
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
    <div class="container-fluid mt-3">
        <div class="row">
            @foreach($keys as $key)
                @if($key->printed==true && $key->used!=true)
                    <div class="col-4">
                        <div class="card mt-3">
                            <div class="card-body text-center">
                                <h4 class="text-center text-success" style="font-size: 20px">{{$key->amount->amount}} MMK</h4>
                                <p><span>Pin - </span><span>{{$key->pin}}</span></p>
                                <p><span>Serial No - </span><span>{{$key->serial_num}}</span></p>
                                <p class="text-center" style="font-size: 10px"><?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($key->serial_num, "C39+",1,33) . '" alt="barcode"   />';?></p>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
        </div>
    </div>

    </div>
    @stop