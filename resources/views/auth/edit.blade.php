@extends('layouts.app')
@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Profile</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">{{ __('Profile') }}</li>
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

<div class="col-12">
    @include('partials.flash')
</div>
<div class="row">
    <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ __('Profile') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary">{{ __('Back to dashboard') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">{{ __('USER INFORMATION') }}</h6>
                <div class="pl-lg-4">
                    <form method="POST" action="{{ route('auth.update',auth()->user()->id) }}" >
                        @csrf
                        @method('put')
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name',auth()->user()->name) }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email',auth()->user()->email) }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="phone">{{ __('Phone') }}</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" value="{{ old('phone',auth()->user()->phone) }}" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="my-4" />
                <h6 class="heading-small text-muted mb-4">{{ __('PASSWORD') }}</h6>
                <div class="pl-lg-4">
                    
                    <form method="POST" action="{{ route('auth.password') }}" >
                        @csrf
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="name">{{ __('Current Password') }}</label>
                                <input type="password" name="current_password" id="current_password" class="form-control form-control-alternative{{ $errors->has('current_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="{{ old('current_password') }}" required>
                                @if ($errors->has('current_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="email">{{ __('New Password') }}</label>
                                <input type="password" name="new_password" id="new_password" class="form-control form-control-alternative{{ $errors->has('new_password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="{{ old('new_password') }}" required>
                                @if ($errors->has('new_password'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('new_password') }}</strong>
                                            </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="phone">{{ __('Confirm New Password') }}</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-alternative{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Confirm New Password') }}" value="{{ old('confirm_password') }}" required>
                                @if ($errors->has('confirm_password'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                            </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

@endsection
