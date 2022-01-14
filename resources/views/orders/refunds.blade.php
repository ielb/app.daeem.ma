@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Orders') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('List of Orders refunded') }}</li>
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
                            <h3 class="mb-0">{{ __('Refund Orders') }}</h3>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    @include('partials.flash')
                </div>

                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('ID') }}</th>
                            <th scope="col">{{ __('Client') }}</th>
                            <th scope="col">{{ __('Order') }}</th>
                            <th scope="col">{{ __('Reason') }}</th>
                            <th scope="col">{{ __('Refund time') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($refunds as $refund)
                                <td>{{ $refund->id }}</td>
                                <td><a  href="{{route('clients.show',$refund->client->id )}}"> {{ $refund->client->name }}</a></td>
                                <td><a class="btn badge badge-success badge-pill" href="{{route('orders.show',$refund->order->id)}}">#{{$refund->order->code}}</a></td>
                                <td>{{ $refund->reason }}</td>
                                <td>{{$refund->created_at->format(config('settings.datetime_display_format'))}}</td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

