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
              <li class="breadcrumb-item active" aria-current="page">{{ __('Edit staff member') }}</li>
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
  <!--<div class="col-xl-12 order-xl-1">-->
  <div class="col-xl-8">
      <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                  <div class="col-8">
                      <h3 class="mb-0">{{ __('Staff Management') }}</h3>
                  </div>
                  <div class="col-4 text-right">
                      <a href="{{ route('drivers.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
              </div>
          </div>
          <div class="col-12">
              @include('partials.flash')
          </div>
          <div class="card-body">
              <hr />
              <h6 class="heading-small text-muted mb-4">{{ __('Staff information') }}</h6>
                  <div class="pl-lg-4">

                      <form method="post" action="{{ route('drivers.update', $driver) }}" enctype="multipart/form-data" autocomplete="off">
                          @csrf
                          @method('put')
                          <div class="form-group text-center ">
                              <label class="form-control-label"
                                     for="driver_image">{{ __('Image') }}</label>
                              <div class="">
                                  <div class="fileinput fileinput-new" data-provides="fileinput">
                                      <div class="fileinput-preview img-thumbnail rounded-circle"
                                           data-trigger="fileinput" style="width: 150px; height: 150px;">
                                          <img src="{{asset('images/drivers/'.$driver->image)}}"
                                               width="200px" height="150px" alt="..." class="rounded-circle"/>
                                      </div>
                                      <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select image') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="driver_image"
                                               accept="image/x-png,image/gif,image/jpeg">
                                    </span>
                                          <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                             data-dismiss="fileinput">{{ __('Remove') }}</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group{{ $errors->has('code_driver') ? ' has-danger' : '' }}">
                              <label class="form-control-label" for="input-name">{{ __('Code') }}</label>
                              <input type="text" disabled name="code_driver" id="code_driver" class="form-control form-control-alternative{{ $errors->has('code_driver') ? ' is-invalid' : '' }}" placeholder="{{ __('Driver code') }}" value="{{ old('code_driver', $driver->code) }}">
                          </div>
                          <div class="form-group{{ $errors->has('cash_driver') ? ' has-danger' : '' }}">
                              <label class="form-control-label" for="input-name">{{ __('Cash') }}</label>
                              <input type="text" name="cash_driver" id="cash_driver" class="form-control form-control-alternative{{ $errors->has('cash_driver') ? ' is-invalid' : '' }}" placeholder="{{ __('Driver cash') }}" value="{{ old('cash_driver', $driver->cash) }}">
                          </div>
                          <div class="form-group{{ $errors->has('gender_driver') ? ' has-danger' : '' }}">
                              <label class="form-control-label" for="input-name">{{ __('Gender') }}</label>
                              <select type="text" name="gender_driver" id="gender_driver" class="form-control form-control-alternative" >
                                  <option {{ $driver->gender == 'male' ? 'selected' : '' }} value="male">Male</option>
                                  <option {{ $driver->gender == 'female' ? 'selected' : '' }} value="female">Female</option>
                              </select>
                          </div>
                          <div class="form-group{{ $errors->has('name_driver') ? ' has-danger' : '' }}">
                              <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                              <input type="text" name="name_driver" id="name_driver" class="form-control form-control-alternative{{ $errors->has('name_driver') ? ' is-invalid' : '' }}" placeholder="{{ __('Driver name') }}" value="{{ old('name_driver', $driver->name) }}">
                          </div>
                          @if ($errors->has('name_driver'))
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_driver') }}</strong>
                                </span>
                          @endif
                          <div class="form-group{{ $errors->has('email_driver') ? ' has-danger' : '' }}">
                              <label class="form-control-label" for="input-name">{{ __('Email') }}</label>
                              <input type="text" name="email_driver" id="email_driver" class="form-control form-control-alternative" placeholder="{{ __('Driver email') }}" value="{{ old('email_driver', $driver->email) }}" readonly>
                          </div>
                          <div class="form-group{{ $errors->has('phone_driver') ? ' has-danger' : '' }}">
                              <label class="form-control-label" for="phone_driver">{{ __('Phone') }}</label>
                              <input type="text" name="phone_driver" id="phone_driver" class="form-control form-control-alternative{{ $errors->has('phone_driver') ? ' is-invalid' : '' }}" placeholder="{{ __('Driver phone') }}" value="{{ old('phone_driver', $driver->phone) }}">
                          </div>
                          @if ($errors->has('phone_driver'))
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_driver') }}</strong>
                                </span>
                          @endif
                          @if ($driver->role != 'collector')
                            <div class="form-group{{ $errors->has('vehicle_type') ? ' has-danger' : '' }}">
                                <label class="form-control-label">{{ __('Vehicle type') }}</label>
                                <div class="custom-control custom-radio mb-3">
                                    <input name="vehicle_type" class="custom-control-input" id="car" value="Car" type="radio" {{ $driver->vehicle == 'Car' ? ' checked' : '' }}>
                                    <label class="custom-control-label mr-5" for="car">Car</label>
                                </div>
                                <div class="custom-control custom-radio mb-3">
                                    <input name="vehicle_type" class="custom-control-input" id="motorcycle" value="Motorcycle" type="radio" {{ $driver->vehicle == 'Motorcycle' ? ' checked' : '' }}>
                                    <label class="custom-control-label" for="motorcycle">Motorcycle</label>
                                </div>
                            </div>                            
                          @endif
                          @if(auth()->user()->role != 'admin')
                              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-change-passowrd">Change password</button>
                          @endif
                              <div class="text-center">
                              <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                          </div>
                      </form>
                  </div>




          </div>
      </div>
  </div>
  <br/>
  <div class="col-xl-4 mb-5 mb-xl-0">
      <div class="row">
           <div class="col-xl-12 col-md-6">
              @foreach($earnings as $key => $value)
                  <div class="card card-stats">
                      <div class="card-body">
                          <div class="row">
                              <div class="col">
                                  <h5 class="card-title text-uppercase text-muted mb-0">{{ __($key) }}</h5>
                                  <span class="h4 font-weight-bold mb-0">{{ __('Orders').": ".$value['orders'] }}</span>
                              </div>
                              <div class="col-auto">
                                  <div class="{{ 'icon icon-shape text-white rounded-circle shadow '.$value['icon'] }}">
                                      <i class="ni ni-chart-bar-32"></i>
                                  </div>
                              </div>
                          </div>
                          <p class="mb-0 text-sm">
{{--                              <!--<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
{{--                              <span class="text-nowrap">Since last month</span>-->--}}
{{--                              <span class="h4 mb-0 text-nowrap">{{ __('Earnings').": "}}@money($value['earning'], config('settings.cashier_currency'),config('settings.do_convertion'))</span>--}}
                          </p>
                      </div>
                  </div>
                  <br/>
              @endforeach
          </div>
      </div>
  </div>
</div>
    @include('drivers.partials.modal')
@endsection