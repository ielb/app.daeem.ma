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
              <li class="breadcrumb-item active" aria-current="page">{{ __('List of Staff') }}</li>
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
              <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-delivery-fast mr-2"></i>Staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-map-big mr-2"></i>Locations</a>
                    </li>
                </ul>
              </div>
            </div>
            <div>
              <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        <div class="row align-items-center">
                          <div class="col-8">
                              <h3 class="mb-0">{{ __('Staff') }}</h3>
                          </div>
                          <div class="col-4 text-right">
                              <a href="{{ route('drivers.create') }}" class="btn btn-sm btn-primary">{{ __('Add a staff member') }}</a>
                          </div>
                          <div class="col-12">
                            @include('partials.flash')
                        </div>
                      <div class="table-responsive py-4">
                        <table class="table align-items-center table-flush" id="datatable-basic">
                          <thead class="thead-light">
                              <tr>  
                                  <th scope="col">{{ __('Name') }}</th>
                                  <th scope="col">{{ __('Role') }}</th>
                                  <th scope="col">{{ __('Email') }}</th>
                                  <th scope="col">{{ __('Phone') }}</th>
                                  <th scope="col">{{ __('Cash') }}</th>
                                  <th scope="col">{{ __('Vehicle') }}</th>
                                  <th scope="col">{{ __('Working') }}</th>
                                  <th scope="col">{{ __('Status') }}</th>
                                  <th scope="col">{{ __('Creation Date') }}</th>
                                  <th scope="col"></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($drivers as $driver)
                                <tr>
                                    <td>
                                      <div class="media align-items-center">
                                        <a class="avatar mr-3">
                                            @if($driver->image == null)
                                            <img class="rounded" src="{{asset('images/drivers/driver-avatar.png') }}"
                                                    alt="..." width="50px" height="50px">
                                            @else
                                            <img class="rounded" src="{{asset('images/drivers/'.$driver->image) }}"
                                              alt="..." width="50px" height="50px">
                                            @endif
                                        </a>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">{{ $driver->name }}</span>
                                        </div>
                                      </div> 
                                    </td>
                                    <td>{{ $driver->role }}</td>
                                    <td>
                                        <a class="text-dark" href="mailto:{{ $driver->email }}">{{ $driver->email }}</a>
                                    </td>
                                    <td>
                                        <a class="text-dark" href="tel:{{ $driver->phone }}">{{ $driver->phone }}</a>
                                    </td>
                                    <td>{{ $driver->cash }}<span class="badge badge-gray"> MAD</span></td>
                                    <td>{{ $driver->vehicle }}</td>
                                    <td>
                                        @if($driver->working == 1)
                                            <span><i class="fas fa-circle text-success mr-2"></i>{{ __('Online') }}</span>
                                        @else
                                            <span><i class="fas fa-circle text-danger mr-2"></i>{{ __('Offline') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($driver->status == 1)
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('Not active') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $driver->created_at->format(config('settings.datetime_display_format'))}}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                              <a class="dropdown-item" href="{{ route('drivers.edit', $driver) }}">{{ __('Edit') }}</a>
                                                <form action="{{ route('drivers.deactivate', $driver) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    @if($driver->status == 0)
                                                        <a class="dropdown-item" href="{{ route('drivers.activate', $driver) }}">{{ __('Activate') }}</a>
                                                    @else
                                                        <button type="submit" class="dropdown-item">
                                                            {{ __('Deactivate') }}
                                                        </button>
                                                    @endif
                                                </form>
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
                      <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                         
                        @include('drivers.partials.map')
                        
                      </div>
                  </div>
              </div>
            </div>

          </div>
        </div>
      </div>
@endsection
