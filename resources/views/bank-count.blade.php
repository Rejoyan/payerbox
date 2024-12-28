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
                    

                    <h3>Country: {!! request()->beneficiary_country !!}</h3>
                </div>
                <br>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <a href="{!! route('success') !!}" class="btn btn-dark fa-pull-right border-dark"><span>Push Success Response.</span></a>                
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Date</th>
                            <th>Bank Name</th>
                            <th>Trx Count</th>
                            


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bankCounts as $node)
                        <tr align="">
                            <td>{!! $loop->iteration !!}</td>
                            <td>{!! date('d/m/Y',time()) !!}</td>
                            <td><a target="_blank" href="{!! route('bank-count-view',['agent_name_pay'=>$node->agent_name_pay]) !!}" >{!! $node->agent_name_pay !!}</a></td>
                            <td><a  target="_blank" href="{!! route('bank-count-view',['agent_name_pay'=>$node->agent_name_pay]) !!}" >({!! $node->id !!})</a></td>

                        </tr>
                        @endforeach

                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

</div>
@stop
@push('page-js')
<script type="text/javascript">
$(document).ready(function() {
$('#example').DataTable({
    "paging":false
});
} );
</script>
@endpush