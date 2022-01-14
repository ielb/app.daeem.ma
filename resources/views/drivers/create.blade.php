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
                <li class="breadcrumb-item active" aria-current="page">{{ __('Add a staff member') }}</li>
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
    <div class="col-xl-12 order-xl-1">
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
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">{{ __('Staff information') }}</h6>
                <div class="pl-lg-4">
                    <form method="post" action="{{ route('drivers.store') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="pl-lg-4">
                            <div class="form-group text-center ">
                                <label class="form-control-label"
                                       for="driver_image">{{ __('Image') }}</label>
                                <div class="">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview img-thumbnail rounded-circle"
                                             data-trigger="fileinput" style="width: 150px; height: 150px;">
                                            <img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg"
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
                            <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="code">{{ __(' Code') }}</label>
                                <input type="text" name="code" id="code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="{{ __(' Code') }}" value="{{ old('code') }}" required>
                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('cash') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="cash">{{ __(' Cash') }}</label>
                                <input type="number" step="any" name="cash" id="cash" class="form-control form-control-alternative{{ $errors->has('cash') ? ' is-invalid' : '' }}" placeholder="{{ __(' Cash') }}" value="{{ old('cash') }}" required>
                                @if ($errors->has('cash'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cash') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="gender">{{ __(' Gender') }}</label>
                                <select type="text" name="gender" id="gender" class="form-control form-control-alternative" >
                                    <option></option>
                                    <option value="male">{{ __('Male') }}</option>
                                    <option value="female">{{ __('Female') }}</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="name">{{ __(' Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __(' Name') }}" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="email">{{ __(' Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __(' Email') }}" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="phone">{{ __(' Phone') }}</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __(' Phone') }}" value="{{ old('phone') }}" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span>
                                        <div class="form-group{{ $errors->has('_role') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Role') }}</label>
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="_role" class="custom-control-input" id="driver" value="driver" type="radio">
                                                <label class="custom-control-label mr-5" for="driver">{{ __('Driver') }}</label>
                                            </div>
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="_role" class="custom-control-input" id="collector" value="collector" type="radio">
                                                <label class="custom-control-label" for="collector">{{ __('Collector') }}</label>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                <div class="col">
                                    <span>
                                        <div class="form-group{{ $errors->has('vehicle_type') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">{{ __('Vehicle type') }}</label>
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="vehicle_type" class="custom-control-input" id="car" value="Car" type="radio">
                                                <label class="custom-control-label mr-5" for="car">Car</label>
                                            </div>
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="vehicle_type" class="custom-control-input" id="motorcycle" value="Motorcycle" type="radio">
                                                <label class="custom-control-label" for="motorcycle">Motorcycle</label>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                              </div>
                            
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="password">{{ __(' Password') }}</label>
                                <input type="password" name="password" id="password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input type="password" name="password_confirmation" id="password-confirm" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>

$(document).ready(function() {

    $('#gender').select2({
        placeholder: "{{ __('Choose gender') }}",
        allowClear: true,
        width: "resolve",
    });


    $( "#collector" ).click(function() {
        $("input[name='vehicle_type']").prop("disabled", true);
        $("input[name='vehicle_type']").prop("checked", false);
    });

    $( "#driver" ).click(function() {
        $("input[name='vehicle_type']").prop("disabled", false);
    });

    

});


</script>
@endsection