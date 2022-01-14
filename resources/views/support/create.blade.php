@extends('layouts.app')

@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{{ __('Staff') }}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">{{ __('Support') }}</li>
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
              <div class="align-items-center">
                  <div class="text-center">
                      <h3 class="display-1">{{ __('Staff Support') }}</h3>
                      <h5 class="text-muted">{{ __('How can we assist you?') }}</h5>
                  </div>
              </div>
          </div>
            <div class="col-12">
                @include('partials.flash')
            </div>
            <div class="row px-3">
              <div class="col-lg-6">
                <div class="card card-pricing border-0 text-center mb-4">
                  <div class="card-header bg-transparent">
                    <h4 class="text-uppercase ls-1  py-3 mb-0">Call Support</h4>
                  </div>
                  <div class="card-body px-lg-7">
                    <div class="display-2 my-4">+212699307502</div>
                    {{-- <div class="my-4"></div> --}}
                    <a href="https://wa.me/+212699307502" target="_blank" class="btn btn-success btn-icon mb-3">
                      <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                      <span class="btn-inner--text">Open whatsapp</span>
                    </a>
                  </div>
                  <div class="card-footer bg-transparent">
                    <div class="text-muted">You can reach us by phone everyday from 8 am to 11 pm CEST which is 8 am to 11 pm your time.</div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card card-pricing border-0 text-center mb-4">
                  <div class="card-header bg-transparent">
                    <h4 class="text-uppercase ls-1  py-3 mb-0">Email Support</h4>
                  </div>
                  <div class="card-body px-lg-7">
                    <div class="display-2 my-4">badreddin4681@gmail.com</div>
                    {{-- <div class="my-4"></div> --}}
                    <a href="mailto:badreddin4681@gmail.com" class="btn btn-danger btn-icon mb-3">
                      <span class="btn-inner--icon"><i class="fab fa-google-plus-g"></i></span>
                      <span class="btn-inner--text">Send email</span>
                    </a>
                  </div>
                  <div class="card-footer bg-transparent">
                    <div class="text-muted">We monitor emails everyday from 8 am to 11 pm CEST which is 8 am to 11 pm your time.</div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
@endsection