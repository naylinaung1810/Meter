@extends('admin.master')

@section('content')
    <div class="content-wrapper" style="margin-bottom: 30px">
        <section class="content-header">
            <h1>
                Check Meter

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">meter check</li>
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

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-md-4">
           <div class="card">
               <div class="card-header">
                   <span>Check Out Meter</span>
               </div>
               <div class="card-body">
                   <form action="{{route('meter.check')}}" method="post">
                       @csrf
                       <div class="form-group has-feedback @if($errors->has('meter_id')) has-error @endif">
                           <label for="meter_id" class="control-label">Meter Owner Name</label>
                           <input list="meters" name="meter_id" class="form-control">
                           <datalist id="meters">
                               @foreach($meters as $meter)
                                   <option value="{{$meter->id}}">{{$meter->user->name}}</option>
                               @endforeach
                           </datalist>

                           <span class="fa fa-user-md form-control-feedback"></span>
                           @if($errors->has('meter_id')) <span class="help-block">{{$errors->first('meter_id')}}</span> @endif
                       </div>
                       <div class="form-group has-feedback @if($errors->has('unit')) has-error @endif">
                           <label for="unit" class="control-label">Meter Unit</label>
                           <input type="number" name="unit" id="unit" class="form-control">
                           <span class="glyphicon glyphicon-home form-control-feedback"></span>
                           @if($errors->has('unit')) <span class="help-block">{{$errors->first('unit')}}</span> @endif
                       </div>


                       <div class="form-group">
                           <button type="submit" class="btn btn-primary btn-lg">Save</button>
                       </div>

                   </form>
               </div>
           </div>
        </div>
        <div class="col-md-8">
            <div class="table-responsive" style="border-radius: 10px">
                <table class="table" >
                    <thead class="bg-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Cost</th>
                        <th>Previous</th>
                        <th>Current</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Pay</th>
                        <th>Created Date</th>
                    </tr>
                    </thead>
                    @foreach($meter_detail as $md)
                        @if($md->status==false)
                        <tr>
                            <td>{{$md->id}}</td>
                            <td>{{$md->meter->user->name}}</td>
                            <td>{{$md->meter->type->type}}</td>
                            <td>{{$md->meter->type->cost}}</td>
                            <td>{{$md->pre_unit}}</td>
                            <td>{{$md->curr_unit}}</td>
                            <td>{{$md->rate}} units</td>
                            <td>{{$md->amount}} MMK</td>
                            <td><a href="{{route('meter.checkout.admin',['id'=>$md->id])}}"><span class="glyphicon glyphicon-copy"></span> </a> </td>
                            <td>{{date('Y/M/D',strtotime($md->created_at))}}</td>
                        </tr>
                        @endif
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
    </div>

    @stop