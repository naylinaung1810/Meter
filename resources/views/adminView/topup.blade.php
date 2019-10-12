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
                    <a class="btn btn-outline-success border-success btn-lg" href="{{route('key')}}">
                        <i class="fa fa-key"></i>
                        All Key</a>

                    <div class="form-group pull-right" style="margin-right: 0px">
                    <a class="btn btn-lg btn-primary" href="#" id="print"  data-toggle="modal" data-target="#printModal">
                        <i class="fa fa-print"></i>
                    </a>
                        <a class="btn btn-lg btn-primary" href="{{route('key.barcode')}}" >
                            <i class="fa fa-paypal"></i>
                        </a>
                    </div>
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
        <form method="post" action="{{route('key.print')}}">
    <!-- Modal -->
        <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 24px"><i class="fa fa-print"></i> Print </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <h4 style="font-size: 16px">Do you want to print <b id="count" class="text-success"></b> items</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="container mt-3">
            <div class="row table-responsive">
                <table class="table table-striped text-center" id="myTable">
                    <thead class="table-secondary">
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>Serial Number</th>
                        <th>Pin</th>
                        <th>Amount</th>
                        <th>Action</th>
                        <th>Print</th>
                        <th>Used</th>
                        <th>Created At</th>
                    </thead>
                    @foreach($keys as $key)
                        @if($key->printed!=true)
                        <tr class="">
                            <td><input type="checkbox" id="check" value="{{$key->id}}" name="id[]"></td>
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
                            <td>@if($key->printed==true)<span class="text-danger">Used</span> @else <span class="text-success">Not use</span> @endif</td>
                            <td>{{$key->created_at}}</td>
                        </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
        </form>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('#checkAll').click(function () {
                $('table #check').attr("checked", "checked");

            });

            $('#print').click(function () {
                var count=0;
                $("#myTable tr").each(function() {
                    if ($(this).find("td:first").find(':checkbox').is(':checked')) {
                        count++;
                    }
                });

                $('#count').html(count);
            });
        })
    </script>
    @stop