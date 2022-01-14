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
                            <li class="breadcrumb-item"><a href="">{{__('Variants')}}</a></li>
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
                            <h3 class="mb-0">{{ __('Add Variants') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="col-12">
                    @include('partials.flash')
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">{{ __('Variants information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('products.variants.store', $product) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('variant_price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="variant_price">{{ __('Variant Price') }}</label>
                                        <input type="number" step="any" name="variant_price" id="variant_price" class="form-control form-control-alternative{{ $errors->has('variant_price') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter variant price') }}" value="{{ old('variant_price') }}" required autofocus>
                                        @if ($errors->has('variant_price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('variant_price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('variants_option') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="variants_option">{{ $options->name }}</label>
                                        <select class="form-control select2 form-control-alternative" id="variants_option" name="variants_option" required>
                                            @foreach ($variants_option as $variant_option)
                                                <option value="{{ $variant_option }}">{{ $variant_option }}</option>
                                            @endforeach
                                        </select>
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
    <script>
        $('#variants_option').select2({
            placeholder: "{{ __('Select ') }} {{ $options->name }}",
            allowClear: true,
            width: "resolve",
        });
    </script>
@endsection