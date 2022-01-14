@extends('layouts.app')
@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">settings delivery</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">Add plan</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          {{-- <a href="#" class="btn btn-sm btn-neutral">New</a> --}}
          {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content')
    <!-- Table -->
    <div class="row ">
        <div class="col-xl-12 ">
            <div class="card shadow ">
                <!-- Card header -->
                <div class="card-header border-0 ">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('settings.delivery')}}" class="btn btn-sm btn-primary" >{{ __('Back To List') }}</a>
                        </div>
                    </div>
                </div>
              <div class="cart-body ">
                <div class="col-12 p-2">
                  @include('partials.flash')
                </div>
            <form method="post" action="{{ route('settings.delivery.add') }}">
                @csrf
            <div class="row">
                <div class="col px-5">
                      <div class="form-group">
                        <label for="price_form">Price Form</label>
                        <input type="number" class="form-control" id="price_form" name="price_form" value="" placeholder="Price form" required>
                      </div>
                      <div class="form-group">
                        <label for="price_to">Price To</label>
                        <input type="number" class="form-control" id="price_to" name="price_to" value="" placeholder="Price To" required>
                      </div>
                      <div class="form-group">
                        <label for="delivery_price">Delivery Price</label>
                        <input type="number" class="form-control" id="delivery_price" name="delivery_price" value="" placeholder="Delivery Price" required>
                      </div>
                      <div class="pb-4 text-center">
                        <button type="submit" class="btn btn-success">Add</button>
                      </div>
                </div>
            </div>
            </form>
          </div>
                </div>
            </div>
        </div>
    @endsection