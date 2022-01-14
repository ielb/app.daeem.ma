@extends('layouts.app')

@section('header')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{{ __('Users') }}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">{{ __('List of Users') }}</li>
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
                        <h3 class="mb-0">{{ __('Users') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('auth.create') }}" class="btn btn-sm btn-primary">{{ __('Add User') }}</a>
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
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Creation Date') }}</th>

                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                      <tr>
                          <td>{{ $user->name }}</td>
                          <td>
                              <a class="text-dark" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                          </td>
                          <td>
                              <a class="text-dark" href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                          </td>
                          <td>
                              @if($user->status == 1)
                                  <span class="badge badge-success">{{ __('Active') }}</span>
                              @else
                                  <span class="badge badge-warning">{{ __('Not active') }}</span>
                              @endif
                          </td>
                          <td>{{ $user->created_at->format(config('settings.datetime_display_format'))}}</td>

                          <td class="text-right">
                              <div class="dropdown">
                                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fas fa-ellipsis-v"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                      <form action="{{ route('auth.deactivate', $user) }}" method="post">
                                          @csrf
                                          @method('put')
                                          @if($user->status == 0)
                                              <a class="dropdown-item" href="{{ route('auth.activate', $user) }}">{{ __('Activate') }}</a>
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
      </div>
@endsection