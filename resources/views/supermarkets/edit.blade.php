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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Add supermarket') }}</li>
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
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Supermarkets Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('supermarkets') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">{{ __('Supermarkets information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('supermarket.update',$supermarket) }}" autocomplete="off"  enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="logo">{{ __('Logo') }}</label>
                                            <div class="image-upload">
                                                <label for="supermarket_logo" style="cursor: pointer">
                                                    <img id="logo-img" width="150" height="150" src="#" style="display: none" />
                                                    <i class="ni ni-image logo-icon" style="font-size: 150px"></i>
                                                </label>
                                                <input  type="file"  accept="image/*"  style="display: none" name="supermarket_logo" id="supermarket_logo" />

                                            </div>
                                            <div class="valid-feedback">
                                                {{ __('Looks good!') }}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{ __('Please upload logo.') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="cover">{{ __('Cover') }}</label>
                                            <div class="image-upload">
                                                <label for="supermarket_cover" style="cursor: pointer">
                                                    <img id="cover-img" width="150" height="150" src="#" style="display: none" />
                                                    <i class="ni ni-image cover-icon" style="font-size: 150px"></i>
                                                </label>
                                                <input  type="file"  accept="image/*"  style="display: none" name="supermarket_cover" id="supermarket_cover" />

                                            </div>
                                            <div class="valid-feedback">
                                                {{ __('Looks good!') }}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{ __('Please upload cover.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group {{ $errors->has('supermarket_name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="supermarket_name">{{ __('Name') }}</label>
                                            <input type="text" name="supermarket_name" id="supermarket_name" class="form-control form-control-alternative {{ $errors->has('supermarket_name') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Supermarket Name') }}"
                                                   value="{{ $supermarket->name }}" required>
                                            @if ($errors->has('supermarket_name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('supermarket_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="supermarket_phone">{{ __('Phone') }}</label>
                                            <input type="text" name="supermarket_phone" id="supermarket_phone" class="form-control form-control-alternative" placeholder="{{ __('Supermarket Phone') }}" value="{{ $supermarket->phone }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="supermarket_address">{{ __('Address') }}</label>
                                            <input type="text" name="supermarket_address" id="supermarket_address" class="form-control form-control-alternative {{ $errors->has('supermarket_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Supermarket Address') }}" value="{{ $supermarket->address  }}" required>
                                            @if ($errors->has('supermarket_address'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('supermarket_address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="supermarket_city">{{ __('City') }}</label>
                                            <select class="form-control" name="supermarket_city" id="supermarket_city">
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{ucfirst($city->name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group{{ $errors->has('supermarket_lat') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="supermarket_lat">{{ __('Latitude') }}</label>
                                            <input type="text" name="supermarket_lat" id="supermarket_lat" class="form-control form-control-alternative{{ $errors->has('supermarket_lat') ? ' is-invalid' : '' }}" placeholder="{{ __('Supermarket Latitude') }}" value="{{ $supermarket->lat }}" required>
                                            @if ($errors->has('supermarket_lat'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('supermarket_lat') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="supermarket_lng">{{ __('Longitude') }}</label>
                                            <input type="text" name="supermarket_lng" id="supermarket_lng" class="form-control form-control-alternative{{ $errors->has('supermarket_lng') ? ' is-invalid' : '' }}" placeholder="{{ __('Supermarket Longitude') }}" value="{{ $supermarket->lng }}" required>
                                            @if ($errors->has('supermarket_lng'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('supermarket_lng') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="supermarket_description">{{ __('Description') }}</label>
                                            <textarea type="text" name="supermarket_description" id="supermarket_description" class="form-control form-control-alternative" placeholder="{{ __('Supermarket Description') }}" value="{{ $supermarket->description }}" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('scripts')
            <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        var forms = document.getElementsByClassName('needs-validation');
                        // Loop over them and prevent submission
                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                        });
                    }, false);


                    $('#supermarket_logo').on('change',function (e){
                        $('#logo-img').css('display','block')
                        var output = document.getElementById('logo-img');
                        output.src = URL.createObjectURL(e.target.files[0]);
                        $('.logo-icon').css('display','none');
                        output.onload = function () {
                            URL.revokeObjectURL(output.src) // free memory
                        }

                    });

                    $('#supermarket_cover').on('change',function (e){
                        $('#cover-img').css('display','block')
                        var output = document.getElementById('cover-img');
                        output.src = URL.createObjectURL(e.target.files[0]);
                        $('.cover-icon').css('display','none');
                        output.onload = function () {
                            URL.revokeObjectURL(output.src) // free memory
                        }

                    });


                })();
            </script>
@endsection