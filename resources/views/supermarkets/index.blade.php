@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Supermarkets') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('List of Supermarkets') }}</li>
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
                            <h3 class="mb-0">{{ __('Supermarkets') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('supermarket.create')}}" class="btn btn-sm btn-primary">{{ __('Add supermarket') }}</a>
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
                            <th scope="col">{{ __('Market') }}</th>
                            <th scope="col">{{ __('Phone') }}</th>
                            <th scope="col">{{ __('Address') }}</th>
                            <th scope="col">{{ __('City') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Creation Date') }}</th>
                            <th scope="col">{{ __('Options') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($supermarkets as $supermarket)
                            <tr>
                                {{-- <td><img src="{{asset('images/supermarkets/logos/'.$supermarket->logo) }}" width="40" height="40" alt="{{ __('Supermarket logo') }}"></td>
                                <td><a class="badge badge-primary badge-pill" href="{{route('supermarket.show',$supermarket)}}">{{$supermarket->name}} </a></td> --}}
                                <td>
                                    <div class="media align-items-center">
                                        <a class="avatar mr-3">
                                            <img alt="..." src="{{asset('images/supermarkets/logos/'.$supermarket->logo) }}">
                                        </a>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm"><a href="{{route('supermarket.show',$supermarket)}}">{{$supermarket->name}} </a></span>
                                        </div>
                                    </div>  
                                </td>
                                <td>{{$supermarket->phone}}</td>
                                <td>{{$supermarket->address}} </td>
                                <td>{{ ucfirst($supermarket->city->name) }} </td>
                                @if($supermarket->status == 1)
                                    <td><span class="badge badge-success">{{ __('Active') }}</td>
                                @else
                                    <td><span class="badge badge-danger">{{ __('Not Active') }}</td>

                                @endif
                                <td>{{$supermarket->created_at->format(config('settings.datetime_display_format'))}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a  href="{{route('supermarket.show',$supermarket)}}" class="dropdown-item" >
                                                {{ __('Details') }}
                                            </a>
                                            @if($supermarket->status == 1)
                                                 <form action="{{ route('supermarket.deactivate', $supermarket) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                     <button type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to deactivate this supermarket?") }}') ? this.parentElement.submit() : ''">
                                                         {{ __('Deactivate') }}
                                                     </button>
                                                </form>
                                            @else
                                                     <form action="{{ route('supermarket.activate', $supermarket) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                         <button type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to activate this supermarket?") }}') ? this.parentElement.submit() : ''">
                                                             {{ __('Activate') }}
                                                         </button>
                                                    </form>
                                                @endif

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

