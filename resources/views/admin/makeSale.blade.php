@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('message'))
                <div class="error" style="text-align:center;">
                    <h4 class="error">{{ Session::get('message') }}</h4>
                </div>

                @endif
            <form action="{{route('makeSaleProcess')}}" method="POST" enctype="multipart/form-data">
@csrf
                <div class="card">
                    <div class="card-header">Make sale
                        <div style="float: right;">
                            <a href="{{route('getSaleList')}}" class="d">>> Sale List</a>
                        </div>
                    </div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
    
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" >
    
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
    
                            <div class="col-md-6">
                                <input id="description" type="textarea" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" >
    
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
    
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" >
    
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="discounted_price" class="col-md-4 col-form-label text-md-right">Discounted Price</label>
    
                            <div class="col-md-6">
                                <input id="discounted_price" type="text" class="form-control @error('discounted_price') is-invalid @enderror" name="discounted_price" value="{{ old('discounted_price') }}" >
    
                                @error('discounted_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>
    
                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" >
    
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="publish_date" class="col-md-4 col-form-label text-md-right">Publish Date</label>
    
                            <div class="col-md-6">
                                <input id="publish_date" type="date" class="form-control @error('publish_date') is-invalid @enderror" name="publish_date" value="{{ old('publish_date') }}" >
    
                                @error('publish_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="sale_image" class="col-md-4 col-form-label text-md-right">Sale Image</label>
    
                            <div class="col-md-6">
                                <input id="sale_image" type="file" class="form-control @error('sale_image') is-invalid @enderror" name="sale_image" value="{{ old('sale_image') }}" >
    
                                @error('sale_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row" style="    place-content: center;
                    ">
                            <input type="submit" class="btn btn-success" value="Save Sale">
                        </div>
    
    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
