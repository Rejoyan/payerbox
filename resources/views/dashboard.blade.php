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


    <h4 align="center" class="font-weight-bold">Welcome to Dashboard</h4>
    <p align="center" class="text-dark">Here you can manage your all contents</p>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-2 mb-4 col-6"></div>
            <div class="col-md-1 mb-4 col-6"></div>

            <div class="col-md-2 mb-4 col-6">
                <a href="">
                    <div class="greenc border-dark rounded-top text-white pt-4 pb-4">
                        <h5 class="text-center pt-3 font-weight-bold"><i class="fas fa-user"></i><br> <span style="font-size:16px;"> Manage<br>User</span></h5>
                    </div>
                </a>

            </div>


            <div class="col-md-2 mb-4 col-6">
                <a href="">
                    <div class="greenc border-dark rounded-top text-white pt-4 pb-4">
                        <h5 class="text-center pt-3 font-weight-bold"><i class="fa fa-key"></i><br> <span style="font-size:16px;"> Change<br>Password</span></h5>
                    </div>
                </a>

            </div>


            <div class="col-md-2 mb-4 col-6">
                <a href="{!! route('paybox') !!}">
                    <div class="greenc border-dark rounded-top text-white pt-4 pb-4">
                        <h5 class="text-center pt-3 font-weight-bold"><i class="far fa-life-ring"></i><br> <span style="font-size:16px;"> Payment<br>Box</span></h5>
                    </div>
                </a>

            </div>



            <div class="col-md-1 mb-4 col-6">
                
                
        
                
            </div>
        
                
            </div>

            <div class="col-md-2 mb-4 col-6"></div>
            <div class="d-none">
                <form action="{{ route('import') }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" 
                           class="form-control">
                    <br>
                    <button class="btn btn-success">
                          Import User Data
                       </button>
                    
                </form>
            </div>
        </div>
    </div>



</div>
@stop