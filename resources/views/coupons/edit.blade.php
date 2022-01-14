@extends('layouts.app')
@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Coupon</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
<div class="card-wrapper">
<!-- Custom form validation -->
<div class="card">
  <!-- Card header -->
  <div class="card-header">
    <div class="row">
      <div class="col-8">
        <h3 class="">Update Coupon</h3>
      </div>
      <div class="col-4 text-right">
      <a href="{{route('coupons')}}" class="btn btn-sm btn-primary" >{{ __('Back To List') }}</a>
      </div>
    </div>
  </div>
  
  <!-- Card body -->
  <div class="card-body bg-secondary">
    <form class="needs-validation" action="{{route('coupons.update')}}" method="POST">
      @csrf
      <div class="form-row">
          <input type="text" name="id" value="{{$coupon->id}}" hidden>
        <div class="col-md-6 mb-3">
          <label class="form-control-label" for="code">Code</label>
          <input type="text" class="form-control" id="code" name="code" placeholder="" value="{{$coupon->code}}" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-control-label" for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{$coupon->name}}" required>
        </div>
        
      </div>
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label class="form-control-label" for="active_from">Active From</label>
          <input type="datetime-local" class="form-control" id="active_from" name="active_from" placeholder="" value="{{$coupon->active_from_f}}" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-control-label" for="active_to">Active To</label>
          <input type="datetime-local" class="form-control" id="active_to" name="active_to" placeholder="State" value="{{$coupon->active_to_f}}" required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label class="form-control-label" for="discount_price">Discount Price</label>
          <input type="number" step="any" class="form-control" id="discount_price" name="discount_price" placeholder="" value="{{$coupon->discount_price}}" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-control-label" for="limit_uses">Limit To Num Uses</label>
          <input type="number" class="form-control" id="limit_uses" name="limit_uses" placeholder="" value="{{$coupon->limit_to_num_uses}}" required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-12 mb-3">
          <label class="form-control-label" for="description">Description</label>
          <textarea class="form-control" id="description" name="description" rows="3" required>{{$coupon->description}}</textarea>
        </div>
      </div>
      <div class="form-row">
        <div class="col text-center ">
          <button class="btn btn-success " type="submit">Save</button>
        </div>
      </div>
      
    </form>
  </div>
</div>
</div>
@endsection