@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Store Type') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('List of Store Types') }}</li>
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
                            <h3 class="mb-0">{{ __('Store Types') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('store_type.create')}}" class="btn btn-sm btn-primary">{{ __('Add a type') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @include('partials.flash')
                </div>
                <div class="table-responsive py-4">
                    <table class="table align-items-center table-flush" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Image') }}</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Creation Date') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($storeTypes as $storeType)
                            <tr>
                                <td>
                                    <img src="{{asset('images/type-store/'.$storeType->image)}}" alt="" width="50">
                                </td>
                                <td>{{ $storeType->name }}</td>
                                <td>{{ $storeType->created_at->format(config('settings.datetime_display_format'))}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{route('store_type.edit',['id'=>$storeType->id])}}">{{ __('Edit') }}</a>
                                            <a class="dropdown-item" href="{{route('store_type.delete',['id'=>$storeType->id])}}">{{ __('DELETE') }}</a>
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