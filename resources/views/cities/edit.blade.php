@extends('layouts.app')
@section('header')
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
    <div class="">
    <div class="row">
        <div class="col-xl-12 ">
            <div class="card shadow px-2">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Update City') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('cities')}}" class="btn btn-sm btn-primary" >{{ __('Back To List') }}</a>
                        </div>
                    </div>
                </div>
              <div class="col-12 p-2">
                @include('partials.flash')
            </div>
            <form method="post" action="{{ route('cities.update') }}">
                @csrf
            <div class="row">
                <div class="col-xl-10 center">
                    <input type="text" name="id" hidden value="{{$city->id}}">
                      <div class="form-group">
                        <label for="city">Name</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{$city->name}}" placeholder="City" required>
                      </div>
                      <div class="form-group">
                        <label for="code_postal">Code Postal</label>
                        <input type="text" class="form-control" id="code_postal" name="code_postal" value="{{$city->code_postal}}" placeholder="EX : 90000" required>
                      </div>
                      <div class="pb-5 text-center">
                        <button type="submit" class="btn btn-success">Save</button>
                      </div>
                </div>
            </div>
            </form>
                </div>
            </div>
        </div></div>
    @endsection