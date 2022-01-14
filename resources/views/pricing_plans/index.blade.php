@extends('layouts.app')
@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Pricing Plans</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">List of Pricing Plans</li>
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
        <div class="col-xl-12 center">
            <div class="card shadow">
              <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ __('Pricing Plans') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{route('settings.delivery.create')}}" class="btn btn-sm btn-primary" >{{ __('Add a plan') }}</a>
                    </div>
                </div>
            </div>
              <div class="col-12 p-2">
                @include('partials.flash')
            </div>
                <!-- Card header -->
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Price from') }}</th>
                            <th scope="col">{{ __('Price To') }}</th>
                            <th scope="col">{{ __('Delivery price') }}</th>
                            <th scope="col">{{ __('Creation Date') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($deliverySetting as $item)
                            <tr>
                                <td>{{$item->price_from}} <span class="badge badge-gray">MAD</span> </td>
                                <td>{{$item->price_to}} <span class="badge badge-gray">MAD</span> </td>
                                <td>{{$item->delivery_price}} <span class="badge badge-gray">MAD</span> </td>
                                <td>{{$item->created_at->format(config('settings.datetime_display_format'))}}</td>
                                <td class="text-right">
                                  <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <a class="dropdown-item" href="{!! route('settings.delivery.edit',['id'=>$item->id]) !!}">Edit</a>
                                      <a class="dropdown-item" href="{!! route('settings.delivery.delete',['id'=>$item->id]) !!}">Delete</a>
                                    </div>
                                  </div>
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