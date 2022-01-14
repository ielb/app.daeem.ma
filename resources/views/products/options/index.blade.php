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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Manage') }}</li>
                        </ol>
                    </nav>
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
                            <h3 class="mb-0">{{ __('Options') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('products.options.create', $product) }}" class="btn btn-sm btn-primary">{{ __('Add options') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @include('partials.flash')
                </div>
                @if(count($options ?? '')==0)
                    <div class="card-footer py-4">
                        <h4>There are no options...</h4>
                    </div>
                @else
                <div class="table-responsive py-4">
                    <table class="table align-items-center table-flush" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Options') }}</th>
                            <th scope="col">{{ __('Creation Date') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($options as $option)
                            <tr>
                                <td>{{ $option->name }}</td>
                                <td>{{ $option->options }}</td>
                                <td>{{ $option->created_at->format(config('settings.datetime_display_format'))}}</td>
                                <td>
                                    <a href="{{ route('products.options.edit', [ $option, $product ]) }}" class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                    <a href="{{ route('products.options.delete', $option) }}" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection