@extends('layouts.app')
@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Clients</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">List of Clients</li>
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
              <div class="col-12 p-2">
                @include('partials.flash')
            </div>
                <!-- Card header -->
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Phone') }}</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col">{{ __('Statu Email') }}</th>
                            <th scope="col">{{ __('Statu Phone') }}</th>
                            <th scope="col">{{ __('status') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($clients as $item)
                          <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                              @if ($item->email_verified_at == '')
                                  <span class="badge badge-danger">Email Not Verified</span>
                              @else
                                  <span class="badge badge-success">Email Verified</span>
                              @endif
                            </td>

                            <td>
                              @if ($item->phone_verified_at == '')
                                  <span class="badge badge-danger">Phone Not Verified</span>
                              @else
                                  <span class="badge badge-success">Phone Verified</span>
                              @endif
                            </td>
                            
                            @if ($item->status == 1)
                              <td><span class="badge badge-success">{{ __('Active') }}</td>  
                            @else
                            <td><span class="badge badge-danger">{{ __('Not Active') }}</td>
                            @endif
                            
                              <td class="text-right">
                                <div class="dropdown">
                                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="{!! route('clients.show',['id'=>$item->id]) !!}">Show</a>
                                    @if ($item->status == 1)
                                       <a class="dropdown-item" href="{!! route('clients.status',['id'=>$item->id,'status'=>$item->status]) !!}">Deactivate</a>
                                    @else
                                       <a class="dropdown-item" href="{!! route('clients.status',['id'=>$item->id,'status'=>$item->status]) !!}">Active</a> 
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