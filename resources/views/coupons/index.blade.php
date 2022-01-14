@extends('layouts.app')
@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Coupons</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">List of Coupons</li>
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
                        <h3 class="mb-0">{{ __('Coupons') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{route('coupons.create')}}" class="btn btn-sm btn-primary" >{{ __('Add coupon') }}</a>
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
                            <th scope="col">{{ __('Code') }}</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('description') }}</th>
                            <th scope="col">{{ __('discount price') }}</th>
                            <th scope="col">{{ __('active from') }}</th>
                            <th scope="col">{{ __('active to') }}</th>
                            <th scope="col">{{ __('limit to num uses') }}</th>
                            <th scope="col">{{ __('used count') }}</th>
                            <th scope="col">Statu</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($coupons as $coupon)
                              <tr>
                                  <td>{{$coupon->code}}</td>
                                  <td>{{$coupon->name}}</td>
                                  <td>{{$coupon->description}}</td>
                                  <td>{{$coupon->discount_price}}<span class="badge badge-gray">MAD</span></td>
                                  <td>
                                      {{ Carbon\Carbon::parse($coupon->active_from)->format(config('settings.datetime_display_format')) }}
                                  </td>
                                  <td>
                                      {{ Carbon\Carbon::parse($coupon->active_to)->format(config('settings.datetime_display_format')) }}
                                  </td>
                                  <td>{{$coupon->limit_to_num_uses}}</td>
                                  <td>{{$coupon->used_count}} </td>
                                  <td>
                                    @if ($coupon->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                          <a class="dropdown-item" href="{!! route('coupons.edit',['id'=>$coupon->id]) !!}">Edit</a>
                                          @if ($coupon->status == 1)
                                           <a class="dropdown-item" href="{!! route('coupons.status',['id'=>$coupon->id , 'status'=>$coupon->status]) !!}">Deactivate</a>
                                          @else
                                           <a class="dropdown-item" href="{!! route('coupons.status',['id'=>$coupon->id , 'status'=>$coupon->status]) !!}">Active</a>
                                          @endif
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