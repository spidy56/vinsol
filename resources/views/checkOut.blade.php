@extends('layouts.app')

@section('content')
<style>
  body { margin-top:20px; }
.panel-title {display: inline;font-weight: bold;}
.checkbox.pull-right { margin: 0; }
.pl-ziro { padding-left: 0px; }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="container">

          <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
          <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
          
          <div class="container" >
              <div class="row">
                @if(Session::has('message'))
                <div class="error" style="text-align:center;">
                    <h4 class="error">{{ Session::get('message') }}</h4>
                </div>

                @endif
                  <div class="col-xs-12 col-md-4 col-sm-6">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">
                                  Payment Details
                              </h3>
                          </div>
                          <div class="panel-body">
                    <h4 class="card-title">Title : {{$saleProduct->title ?? ''}}</h4>
                             
                          </div>
                      </div>
                      <ul class="nav nav-pills nav-stacked">
                          <li class="active" style="width: -webkit-fill-available;"><a href="#" style="cursor: alias;"><span class="badge pull-right">₹{{$saleProduct->discounted_price ?? ''}}</span> Final Payment</a>
                          </li>
                      </ul>
                      <br/>
                      <a href="{{route('makePayment',$id)}}" class="btn btn-success btn-lg btn-block" role="button">Pay</a>
                  </div>
              </div>
          </div>
          {{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
          <script type="text/javascript" src="https://js.stripe.com/v2/"></script> --}}
          
          </div>
    </div>
</div>
@endsection
