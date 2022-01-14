@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Products') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.edit', $product) }}">{{ $product->name }}</a></li>
                            <li class="breadcrumb-item"><a href="">{{__('Options')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('New') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <br/>
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Add options') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                            {{--                                                    @elseif(auth()->user()->hasRole('admin'))--}}
                            {{--                                                        <a href="{{ route('items.admin', $restorant) }}" class="btn btn-sm btn-primary">{{ __('Back to items') }}</a>--}}
                            {{--                                                    @endif--}}
                        </div>
                    </div>
                </div>
                <br/>
                <div class="col-12">
                    @include('partials.flash')
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">{{ __('Options information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('products.options.store', $product) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('options_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="options_name">{{ __('Option Name') }}</label>
                                        <input type="text" name="options_name" id="options_name" class="form-control form-control-alternative{{ $errors->has('options_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter option name,ex size') }}" value="{{ old('options_name') }}" required autofocus>
                                        @if ($errors->has('options_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('options_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('option_list') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="option_list">{{ __('Comma separated list of option values') }}</label>
                                        <input type="text" name="option_list" id="option_list" class="form-control form-control-alternative{{ $errors->has('option_list') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter comma separated list of avaliable option values, ex: small,medium,large') }}" value="{{ old('option_list') }}" required autofocus>
                                        @if ($errors->has('option_list'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('option_list') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection