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
                    <div class="container-fluid bg-white pt-5 pb-5">
                        <div class="row">
                            <div class="col-12 col-md-12 mt-5 mb-5 text-center">
                                <h1 class="font-weight-bold italic-font font-darkBlue">
                                    <span class="text-success">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        Success!</span><br>
                                    {!! $message !!}<br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-2">
                                            <a href="{!! $url !!}" class="btn btn-white mb-2 p-2 bg-dark text-white  btn-sm btn-block-sm font-weight-bold custom-radius nav-link"> {!! $title !!}</a>
                                        </div>
                                        <div class="col-md-5"></div>
                                    </div>
                                </h1>

                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@stop