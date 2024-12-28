@extends('layouts.app')
@section('content')
<div id="content">
    <nav class="navbar navbar-expand-lg navbar-white border bg-light">
        <div class="container-fluid">

            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-align-justify"></i> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active"><i class="fas fa-user-check"></i>  Hi, Admin </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col-sm-12">
            <div class="common border ">
                <div class="col-sm-12 p-20">

                    @if(Session::has('error'))
                    <h1>

                        <span class="text-danger">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Error!</span>
                        {!!  session()->get('error') !!}<br>
                        <br>
                    </h1>
                    @endif


                    @if(Session::has('success'))
                    <h1>
                        <span class="text-success">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            Success!</span>
                        {{ session()->get('success') }}
                    </h1>
                    @endif

                    <form method="post" action="{!! route('payboxpush-to-payout') !!}">
                        <div class="row ">
                            @csrf

                            <div class="col-md-3">
                                <lable>Payout Partner APi</lable>
                                <select class="form-control" name="payout_api" required="">
                                    <option value="" selected="">---Select---</option>
                                    @foreach($payoutApis as $key=>$payoutApi)
                                    <option value="{!! $key !!}">{!! $payoutApi !!}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <lable>Payout Partner Country</lable>
                                <select class="form-control" name="payout_country" required="">
                                    <option value="">---Select---</option>
                                    <option value="">All</option>
                                    <option value="Brazil"  {!! request()->beneficiary_country == 'Brazil'? 'selected' : '' !!} >Brazil</option>
                                    <option value="Colombia"  {!! request()->beneficiary_country == 'Colombia'? 'selected' : '' !!} >Colombia</option>
                                    <option value="Pakistan"  {!! request()->beneficiary_country == 'Pakistan'? 'selected' : '' !!} >Pakistan</option>
                                    <option value="India" {!! request()->beneficiary_country == 'India'? 'selected' : '' !!} >India</option>
                                    <option value="Bangladesh" {!! request()->beneficiary_country == 'Bangladesh'? 'selected' : '' !!}  >Bangladesh</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <lable></lable><br>
                                <input class="btn btn-dark border-dark" type="submit"  value="Submit" />
                            </div>

                        </div>
                    </form>
                    Country : {!! request()->beneficiary_country !!} <br>
                    Payment Method : {!! request()->payment_type !!}

                </div>
                <br>
                <table id="example" class="table table-striped table-bordered" style="width:100%">

                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Customer Name</th>
                            <th>Beneficiary Full Name</th>
                            <th>Payment Method</th>
                            <th>Country</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th>Reference Number</th>
                            <th>Amt.</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paybox as $node)
                        <tr align="">
                            <td>{!! $loop->iteration !!}</td>
                            <td>{!! $node->remitter_full_name !!}</td>
                            <td>{!! $node->beneficiary_full_name !!}</td>
                            <td>{!! $node->delivery_method !!}</td>
                            <td>{!! $node->destination_country_name !!}</td>
                            <td class="text-left">{!! $node->beneficiary_bank_name !!}</td>
                            <td >{!! $node->status !!}</td>
                            <td>{!! $node->reference_number !!}</td>
                            <td>{!! $node->payout_amount !!}</td>

                        </tr>
                        @endforeach

                    </tbody>

                </table>
                <div class="d-flex justify-content-center">

                </div>
            </div>
        </div>
    </div>

</div>
@stop
@push('page-js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            "paging": true
        });
    });
</script>
@endpush