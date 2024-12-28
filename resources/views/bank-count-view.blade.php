@extends('layouts.app')
@push('page-css')
@endpush

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
                    <form method="get" action="{!! route('bank-count-view') !!}">
                        <div class="row ">

                            <div class="col-md-3">
                                <lable>Start Date</lable>
                                <input  class="form-control" value="{!! request()->start_date !!}" type="date" name="start_date" />
                            </div>

                            <div class="col-md-3">
                                <lable>End Date</lable>
                                <input class="form-control" value="{!! request()->end_date !!}" type="date" name="end_date" />
                            </div>
                            <div class="col-md-2">
                                <lable>Pin No</lable>
                                <input class="form-control" value="{!! request()->pin_no !!}" type="text" name="pin_no" />
                            </div>
                            <input type="hidden" name="agent_name_pay" value="{!! request()->agent_name_pay !!}" />
                            <div class="col-md-3">
                                <lable>Status</lable>
                                <select class="form-control" name="status">
                                    <option >---Select---</option>
                                    <option value="0" {!! isset(request()->status) && request()->status == 0? 'selected' : '' !!} >UnPaid</option>
                                    <option value="1" {!!  isset(request()->status) &&  request()->status == 1? 'selected' : '' !!}  >Paid</option>
                                </select>
                            </div>


                            <div class="col-md-1">
                                <lable></lable><br>
                                <input class="btn btn-dark border-dark" type="submit"  value="Submit" />
                            </div>

                        </div>
                    </form>

                </div>
                <br>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
<!--                    <a href="" class="btn btn-dark fa-pull-right border-dark"><span>Push TRX.</span></a>-->
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Customer Name</th>
                            <th>Customer Country</th>
                            <th>Date</th>
                            <th>Beneficiary Country</th>
                            <th>Bank</th>
                            <th>Pin No</th>
                            <th>Status</th>
                            <th>Amt.</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paybox as $node)
                        <tr align="" >
                            <td>{!! $loop->iteration !!}</td>
                            <td>{!! $node->customer_fullname !!}</td>
                            <td>{!! $node->customer_country !!}</td>
                            <td>{!! $node->trx_date !!}</td>
                            <td>{!! $node->beneficiary_country !!}</td>
                            <td class="text-left">{!! $node->paymentBoxReceiver->bank_name !!}</td>
                            <td>{!! $node->pin_no !!}</td>
                            <td class="{!! $node->getStatusColor() !!}">{!! $node->getStatus() !!}</td>
                            <td>{!! $node->amount !!}</td>

                        </tr>
                        @endforeach

                    </tbody>
                    
                </table>
                <div class=" ">
                {!!$paybox->links()  !!}
                </div>
            </div>
        </div>
    </div>

</div>
@stop
@push('page-js')
<script type="text/javascript">
$(document).ready(function() {
$('#example').DataTable({
    "paging":false,
    "lengthChange": false,
            "info":     false
});
} );
</script>
@endpush