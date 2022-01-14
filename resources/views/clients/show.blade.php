@extends('layouts.app')
@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Client</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">Details of client</li>
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
<div class="row">
  <div class="col-xl-4 order-xl-2">
    <div class="card card-profile">
      <img src="../../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
      <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
          <div class="card-profile-image">
            <a href="#">
              <img src="{{ asset('assets/img/brand/'.env('avatar'))}}" class="rounded-circle bg-white">
            </a>
          </div>
        </div>
      </div>
      <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
        <div class="d-flex justify-content-between">
          @if ($client->email_verified_at == '')
            <a href="" class="btn btn-sm btn-warning disabled">Email Not Verified</a>
          @else
            <a href="" class="btn btn-sm btn-primary disabled">Email Verified</a>
          @endif
          @if ($client->status == 1)
          <a href="{!! route('clients.status',['id'=>$client->id,'status'=>$client->status]) !!}" class="btn btn-sm btn-danger float-right">Deactivate</a>
           @else
           <a href="{!! route('clients.status',['id'=>$client->id,'status'=>$client->status]) !!}" class="btn btn-sm btn-info float-right">Active</a>
           @endif
        </div>
      </div>
      <div class="card-body pt-0">
        <div class="text-center">
          <h5 class="h3">
            {{$client->name}}<span class="font-weight-light"></span>
          </h5>
          <div class="h4 font-weight-400">
            <i class="ni location_pin mr-2"></i>{{ isset($client->address) ? $client->address->address : '' }}, {{ isset($client->address->city) ? $client->address->city: '' }}
          </div>
          <div class="h4 mt-4">
            <i class="ni business_briefcase-24 mr-2"></i>{{ $client->email }}
          </div>
          <div>
            <i class="ni education_hat mr-2"></i>(+212) {{ $client->phone }}
          </div>
          <div class="mt-4">
             @if ($client->fb_id != '')
                
                 <button type="button" class="btn btn-facebook btn-icon">
                    <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
                    <span class="btn-inner--text">Sing up With</span>
                </button>
             @else
                @if ($client->go_id != '')
                    <button type="button" class="btn btn-google-plus btn-icon">
                        <span class="btn-inner--icon"><i class="fab fa-google-plus-g"></i></span>
                        <span class="btn-inner--text">Sign up With</span>
                    </button>
                @else
                  <button type="button" class="btn btn-google-plus btn-icon">
                    <span class="btn-inner--icon"><i class="fas fa-envelope"></i></span>
                    <span class="btn-inner--text">Sign up With</span>
                </button>
                @endif
                 
             @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-8 order-xl-1">
    <div class="row">
      <div class="col-lg-6">
        <div class="card bg-gradient-info border-0">
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Order</h5>
                <span class="h2 font-weight-bold mb-0 text-white">{{$totalorder}}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                  <i class="ni ni-basket text-orange"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card bg-gradient-danger border-0">
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total order's price</h5>
                <span class="h2 font-weight-bold mb-0 text-white">{{$totalprice}} MAD</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                  <i class="fas fa-dollar-sign"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">Orders of Client </h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-basic">
              <thead class="thead-light">
              <tr>
                  <th scope="col">{{ __('ID') }}</th>
                  <th scope="col">{{ __('Supermarkt') }}</th>
                  <th scope="col">{{ __('driver') }}</th>
                  <th scope="col">{{ __('Price') }}</th>
                  <th scope="col">{{ __('Delivery Price') }}</th>
                  <th scope="col">{{ __('Status') }}</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($orders as $item)
                <tr>
                  <td><h3><a href="{{route('orders.show',['id'=>$item->id])}}" class="badge badge-success badge-pill">#{{ $item->code }}</a></h3></td>
                  <td><h4><a href="{{route('store.show',$item->store->id)}}" class="badge badge-primary badge-pill ">{{ $item->store->name }}</a></h4></td>
                  <td> <h4 ><a href="{{route('drivers.edit',!empty($item->user->id) ? $item->user->id : "")}}" class="badge badge-primary badge-pill ">{{ !empty($item->user->name) ? $item->user->name : "" }}</a></h4></td>
                  <td>{{ $item->order_price }}</td>
                  <td>{{ $item->delivery_price }}</td>  
                  <td><span class="badge badge-{{$item->status->color}}">{{ $item->status->name }}</span></td>               
                </tr>
                @endforeach
              </tbody>
          </table>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection