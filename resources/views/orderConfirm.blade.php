@extends('layouts.app')

@section('content')
<style>
    body {
        margin-top: 20px;
    }

    .panel-title {
        display: inline;
        font-weight: bold;
    }

    .checkbox.pull-right {
        margin: 0;
    }

    .pl-ziro {
        padding-left: 0px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="container">

            <div class="container">
                <div class="cb1">
                    <div class="row text-center" style="place-content: center;">
                        <span class="icon icon-xl icon-success">
                            <i class=""></i>
                        </span>
                        <h1>Thank You For Order!</h1>
                        <br>
                        {{-- <h4>You will receive it in 30 minutes.</h4>                  --}}
                    </div>
                    <div style="place-content: center;text-align: center;">
                        
                        <a href="{{route('getSale')}}" class="btn btn-danger"> Back To Home</a>
                    </div>
                </div>
            </div>
            {{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
          <script type="text/javascript" src="https://js.stripe.com/v2/"></script> --}}

        </div>
    </div>
</div>
@endsection