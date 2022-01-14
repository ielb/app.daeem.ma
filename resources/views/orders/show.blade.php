@extends('layouts.app', ['title' => __('Orders')])
@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{{ __('Orders') }}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">{{ __('Order detail') }}</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          @include('orders.partials.actions')
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content')
<div class="container-fluid mt--7">
  <div class="row">
      <div class="col-xl-7 ">
          <br/>
          <div class="card bg-secondary shadow">
              <div class="card-header bg-white border-0">
                  <div class="row align-items-center">
                      <div class="col-8">
                        <h3 class="mb-0">{{ "#".$order->code." - ".$order->created_at->format(config('settings.datetime_display_format')) }}</h3>

                      </div>
                      <div class="col-4 text-right">
                          <a href="{{ route('orders') }}" class="btn btn-sm btn-primary"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                          {{-- @if ($pdFInvoice) --}}
                          @if ($order->status->alias == "delivered")
                           <a target="_blank" href="{{ route('invoice',$order->id) }}" class="btn btn-sm btn-success"><i class="fas fa-print"></i> {{ __('Print bill') }}</a>
                          @endif
                          {{-- @endif --}}  
                      </div>
                  </div>
              </div>
             @include('orders.partials.orderinfo',['order_products'=>$order_products])
             {{-- @include('orders.partials.actions.buttons',['order'=>$order]) --}}
          </div>
      </div>
      <div class="col-xl-5  mb-5 mb-xl-0">
          <br/>
          <div class="card card-profile shadow">
              <div class="card-header">
                  <h5 class="h3 mb-0">{{ __("Order tracking")}}</h5>
              </div>
              <div class="card-body">
                  @include('orders.partials.map',['order'=>$order])
              </div>
          </div>

          <br/>
          <div class="card card-profile shadow">
              <div class="card-header">
                  <h5 class="h3 mb-0">{{ __("Status History")}}</h5>
              </div>
              @include('orders.partials.orderstatus')
              
          </div>
      
      </div>
  </div>

  @include('orders.partials.modal')

</div>


@endsection
