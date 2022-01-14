@extends('layouts.app')
@section('header')
@include('cities.modals')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Cities</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">List of Cities</li>
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
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Cities') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addcity">{{ __('Add a city') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-2">
                  @include('partials.flash')
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('ID') }}</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Code Postal') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                         @foreach ($cities as $city)
                             <tr>
                                 <td>{{$city->id}}</td>
                                 <td>{{$city->name}}</td>
                                 <td>{{$city->code_postal}}</td>
                                 @if ($city->status == 1)
                                 <td><span class="badge badge-success">{{ __('Active') }}</td>  
                                  @else
                                  <td><span class="badge badge-danger">{{ __('Not Active') }}</td>
                                  @endif
                                 <td  class="text-right">
                                  <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <a class="dropdown-item" href="{!! route('cities.edit',['id'=>$city->id]) !!}">Edit</a>
                                      @if ($city->status == 1)
                                       <a class="dropdown-item" href="{!! route('cities.status',['id'=>$city->id,'status'=>$city->status]) !!}">Deactivate</a>
                                      @else
                                       <a class="dropdown-item" href="{!! route('cities.status',['id'=>$city->id,'status'=>$city->status]) !!}">Active</a> 
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