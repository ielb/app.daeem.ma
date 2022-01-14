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
              <li class="breadcrumb-item active" aria-current="page">{{ __('List of Orders') }}</li>
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
    <div class="row">
        <div class="col">
          <div class="card shadow">
            <!-- Card header filter section -->
            @include('orders.partials.filter')
            <div class="col-12"> 
              @include('partials.flash') 
          </div>
            <div class="table-responsive py-4" >
              <table class="table align-items-center table-flush" id="datatable-basic">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">{{ __('ID') }}</th>
                        <th scope="col">{{ __('store') }}</th>
                        <th scope="col">{{ __('P-Qty') }}</th>
                        <th scope="col">{{ __('Order time') }}</th>
                        <th scope="col">{{ __('Time slot') }}</th>
                        <th scope="col">{{ __('Last status') }}</th>
                        <th scope="col">{{ __('client') }}</th>
                        <th scope="col">{{ __('Delivery time') }}</th>
                        <th scope="col">{{ __('Address') }}</th>
                        @if (auth()->user()->role == 'admin')
                              <th scope="col">{{ __('Driver') }}</th>
                        @endif
                        <th scope="col">{{__('Collector')}}</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col">{{ __('Delivery price') }}</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)

                      <tr>  
                          <td><a class="btn badge badge-success badge-pill" href="orders/{{ $order->id }}">#{{$order->code}}</a></td>
                          <td>
                            <div class="media align-items-center">
                              <a class="avatar mr-3">
                                  <img alt="..." src="public/images/stores/logos/{{$order->store->logo}}">
                              </a>
                              <div class="media-body">
                                  <span class="mb-0 text-sm">{{  $order->store->name }}</span>
                              </div>
                          </div>   
                             </td>
                             @php
                                  $qty = 0;
                                  $weight = 0;
                             @endphp
                             @foreach ($order->products as $key=>$product)
                            @php  
                                $qty += $product->pivot->qty;
                                $weight += $product->weight * $product->pivot->qty;
                            @endphp
                             @endforeach
                             <td>{{$qty}}</td>
                          <td>{{  $order->created_at->format(config('settings.datetime_display_format')) }}</td>
                          <td>{{  $order->delivery_pickup_interval }}</td>
                          <td><span class="badge badge-{{$order->status->color}} badge-md badge-pill">{{ $order->status->name }}</span></td>
                          <td><a  href="{{route('clients.show',$order->client->id)}}">{{  $order->client->name }}</a></td>
                          <td>
                              @if($order->use_delivery_time == 1)
                                  <span>{{ $order->delivery_time }}</span>
                              @else
                                  <span class="badge badge-info badge-md badge-pill">ASAP</span>
                              @endif
                          </td>
                          <td>{{  $order->address->address_details }}</td>
                          @if (auth()->user()->role == 'admin')
                              <td><a  href="{{!empty($order->user->name) ? route('drivers.edit',$order->user->id) : "#"}}">{{ !empty($order->user->name) ? $order->user->name : "" }}</a></td>
                          @endif
                          <td>{{ !empty($order->collector->name) ? $order->collector->name : "" }}</td>
                          <td>{{  $order->order_price }}<span class="badge badge-gray"> MAD</span></td>
                          <td>{{  $order->delivery_price }}<span class="badge badge-gray"> MAD</span></td>
                          <td>@include('orders.partials.actions')
                            @include('orders.partials.modal',$order)
                          </td>
                        </tr>
                      @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('scripts')

@endsection
