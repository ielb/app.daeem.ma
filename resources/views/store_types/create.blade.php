@extends('layouts.app')
@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Store Type</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">create Store Type</li>
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
                            <h3 class="mb-0">{{ __('Create Type Store') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('store_types.index')}}" class="btn btn-sm btn-primary" >{{ __('Back To List') }}</a>
                        </div>
                    </div>
                </div>
              <div class="cart-body ">
                <div class="col-12 p-2">
                  @include('partials.flash')
                </div>
            <form method="post" action="{{route('store_type.store')}}" enctype="multipart/form-data" autocomplete="off">
                @csrf
            <div class="row">
                <div class="col px-5">
                      <div class="form-group">
                        <label for="type_name">Name</label>
                        <input type="text" class="form-control" id="type_name" name="type_name" value="" placeholder="Type Name" required>
                      </div>
                      <div class="form-group text-center">
                        <label class="form-control-label"
                               for="product_image">{{ __('Image') }}</label>
                        <div class="">
                          <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview img-thumbnail"
                                     data-trigger="fileinput" style="width: 400px; height: 300px;">
                                    <img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg"
                                         width="400px" height="300px" alt="..."/>
                                </div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select Image') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="type_image"
                                              accept="image/x-png,image/gif,image/jpeg">
                                    </span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                              data-dismiss="fileinput">{{ __('Remove') }}</a>
                                </div>
                          </div>
                      </div>
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