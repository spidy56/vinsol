@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="container">
      @if (!empty($saleProduct))

      <div class="row" style="place-content: center">

        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
          {{-- <a href="{{route('makeSale',$saleProduct->id)}}" class="f">dd</a> --}}
          @if(Session::has('message'))
          <div class="error" style="text-align:center;">
            <h4 class="error">{{ Session::get('message') }}</h4>
          </div>

          @endif
          <div class="card">

            <img class="card-img" src="
      @if(!empty($saleProduct->sale_image))
        {{asset("uploads/images/".$saleProduct->sale_image)}}
   
@endif
    " alt="Sale Image">

            <div class="card-img-overlay d-flex justify-content-end">
              <a href="#" class="card-link text-danger like">
                <i class="fas fa-heart"></i>
              </a>
            </div>
            <div class="card-body">
              <h4 class="card-title">{{$saleProduct->title ?? ''}}</h4>
              <h6 class="card-subtitle mb-2 text-muted">Availiable Quantity: {{$saleProduct->quantity ?? ''}}</h6>
              <h6 class="card-subtitle mb-2 text-muted">Publish Date: {{$saleProduct->publish_date ?? ''}}</h6>
              <p class="card-text">
                {{$saleProduct->description ?? ''}}</p>

              <div class="options d-flex flex-fill">

                <select class="custom-select ml-1">
                  <option disabled>Quantity</option>
                  <option selected value="1">1</option>

                </select>
              </div>
              <div class="buy d-flex justify-content-between align-items-center">
                <div class="price text-success">
                  <h5 class="mt-4">
                    <del> ₹{{$saleProduct->price ?? ''}}</del>
                    ₹{{$saleProduct->discounted_price ?? ''}}
                  </h5>
                </div>
                @if ($saleProduct->product_check == 0)
                <a href="{{route('buyNow',$saleProduct->id)}}" class="btn btn-danger mt-3" style="z-index:11"><i
                    class="fas fa-shopping-cart"></i> Buy Now</a>
                @else
                <a href="#" class="btn btn-default mt-3" style="z-index:11"><i class="fas fa-shopping-cart"></i>
                  Purchased</a>

                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
      <center>No Sale Active</center>
      @endif
    </div>
  </div>
</div>
@endsection