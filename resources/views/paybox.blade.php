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
                    <form method="get" action="{!! route('payboxSearch') !!}">
                        <div class="row ">
                            <div class="col-md-3">
                                <lable>Payout Partner Country</lable>
                                <select class="form-control" name="beneficiary_country">
                                    <option value="">---Select---</option>
                                    <option value="Pakistan"  >Pakistan</option>
                                    <option value="India"  >India</option>
                                    <option value="Bangladesh"  >Bangladesh</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <lable>Payment Type</lable>
                                <select class="form-control" name="payment_type">
                                    <option value="">---Select---</option>
                                    <option value="CASH"  >CASH</option>
                                    <option value="BANK"  >BANK</option>

                                </select>
                            </div>


                            <div class="col-md-3">
                                <lable></lable><br>
                                <input class="btn btn-dark border-dark" type="submit"  value="Submit" />
                            </div>

                        </div>
                    </form>

                </div>
                <br>
                <div class=" table-responsive ">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
<!--                    <a href="" class="btn btn-dark fa-pull-right border-dark"><span>Push TRX.</span></a>-->
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Customer Name</th>
                                <th>Customer Country</th>
                                <th>Date</th>
                                <th>Beneficiary Country</th>
                                <th>Payment Method</th>
                                <th>Bank</th>
                                <th>Pin No</th>
                                <th>Status</th>
                                <th>Amt.</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paybox as $node)
                            <tr align="">
                                <td>{!! $loop->iteration !!}</td>
                                <td>{!! $node->customer_fullname !!}</td>
                                <td>{!! $node->customer_country !!}</td>
                                <td>{!! $node->trx_date !!}</td>
                                <td>{!! $node->beneficiary_country !!}</td>
                                <td>{!! $node->payment_method !!}</td>
                                <td class="text-left">{!! $node->paymentBoxReceiver->bank_name !!}</td>
                                <td>{!! $node->pin_no !!}</td>
                                <td>{!! $node->getStatus() !!}</td>
                                <td>{!! $node->amount !!}</td>

                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
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
    $(document).ready(function () {
        $('#example').DataTable({
            "paging": false,
            "lengthChange": false,
            "info": false
        });
    });
</script>
@endpush