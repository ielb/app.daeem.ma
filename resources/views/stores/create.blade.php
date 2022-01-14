@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Stores') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Add store') }}</li>
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
                            <h3 class="mb-0">{{ __('Store Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('stores') }}"
                               class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">{{ __('Stores information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('store.store') }}" autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        {{--                                    <div class="form-group">--}}
                                        {{--                                        <label class="form-control-label" for="logo">{{ __('Logo') }}</label>--}}
                                        {{--                                        <div class="image-upload">--}}
                                        {{--                                            <label for="store_logo" style="cursor: pointer">--}}
                                        {{--                                                   <img id="logo-img" width="150" height="150" src="#" style="display: none" />--}}
                                        {{--                                                    <i class="ni ni-image logo-icon" style="font-size: 150px"></i>--}}
                                        {{--                                            </label>--}}
                                        {{--                                            <input  type="file"  accept="image/*"  style="display: none" name="store_logo" id="store_logo" />--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}

                                        <div class="form-group ">
                                            <label class="form-control-label"
                                                   for="product_image">{{ __('Store Logo') }}</label>
                                            <div class="">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview img-thumbnail"
                                                         data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                        <img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg"
                                                             width="200px" height="150px" alt="..."/>
                                                    </div>
                                                    <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select logo') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="store_logo"
                                               accept="image/x-png,image/gif,image/jpeg">
                                    </span>
                                                        <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                                           data-dismiss="fileinput">{{ __('Remove') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <label class="form-control-label" for="cover">{{ __('Cover') }}</label>--}}
                                        {{--                                            <div class="image-upload">--}}
                                        {{--                                                <label for="store_cover" style="cursor: pointer">--}}
                                        {{--                                                    <img id="cover-img" width="100%" height="150" src="#"--}}
                                        {{--                                                         style="display: none"/>--}}
                                        {{--                                                    <i class="ni ni-image cover-icon" style="font-size: 150px"></i>--}}
                                        {{--                                                </label>--}}
                                        {{--                                                <input type="file" accept="image/*" style="display: none"--}}
                                        {{--                                                       name="store_cover" id="store_cover"/>--}}

                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="product_image">{{ __('Store Cover') }}</label>
                                            <div class="">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview img-thumbnail"
                                                         data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                        <img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg"
                                                             width="200px" height="150px" alt="..."/>
                                                    </div>
                                                    <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select Cover') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="store_cover"
                                               accept="image/x-png,image/gif,image/jpeg">
                                    </span>
                                                        <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                                           data-dismiss="fileinput">{{ __('Remove') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group{{ $errors->has('store_type') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                   for="store_type">{{ __('Store type') }}</label>
                                            <select class="form-control" name="store_type" id="store_type">
                                                @foreach($store_types as $type)
                                                    <option value="{{$type->id}}">{{ucfirst($type->name)}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('store_type'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group{{ $errors->has('store_name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                   for="store_name">{{ __('Name') }}</label>
                                            <input type="text" name="store_name" id="store_name"
                                                   class="form-control form-control-alternative{{ $errors->has('store_name') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Store Name') }}"
                                                   value="{{ old('store_name') }}" required>
                                            @if ($errors->has('store_name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group{{ $errors->has('store_phone') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                   for="store_phone">{{ __('Phone') }}</label>
                                            <input type="text" name="store_phone" id="store_phone"
                                                   class="form-control form-control-alternative{{ $errors->has('store_phone') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Store Phone') }}"
                                                   value="{{ old('store_phone') }}" required>
                                            @if ($errors->has('store_phone'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group {{ $errors->has('store_phone') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                   for="store_phone_two">{{ __('Phone 2') }}</label>
                                            <input type="text" name="store_phone_two" id="store_phone_two"
                                                   class="form-control form-control-alternative{{ $errors->has('store_phone_two') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Store Phone 2') }}"
                                                   value="{{ old('store_phone_two') }}">
                                            @if ($errors->has('store_phone_two'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_phone_two') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="store_city">{{ __('City') }}</label>
                                            <select class="form-control" name="store_city" id="store_city">
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{ucfirst($city->name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group{{ $errors->has('store_address') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                   for="store_address">{{ __('Address') }}</label>
                                            <input type="text" name="store_address" id="store_address"
                                                   class="form-control form-control-alternative{{ $errors->has('store_address') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Store Address') }}"
                                                   value="{{ old('store_address') }}" required>
                                            @if ($errors->has('store_address'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group{{ $errors->has('store_lat') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                   for="store_lat">{{ __('Latitude') }}</label>
                                            <input type="text" name="store_lat" id="store_lat"
                                                   class="form-control form-control-alternative{{ $errors->has('store_lat') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Store Latitude') }}"
                                                   value="{{ old('store_lat') }}" required>
                                            @if ($errors->has('store_lat'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_lat') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="store_lng">{{ __('Longitude') }}</label>
                                            <input type="text" name="store_lng" id="store_lng"
                                                   class="form-control form-control-alternative{{ $errors->has('store_lng') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Store Longitude') }}"
                                                   value="{{ old('store_lng') }}" required>
                                            @if ($errors->has('store_lng'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_lng') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group{{ $errors->has('store_email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                   for="store_email">{{ __('Email') }}</label>
                                            <input type="email" name="store_email" id="store_email"
                                                   class="form-control form-control-alternative{{ $errors->has('store_email') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Store Email') }}"
                                                   value="{{ old('store_email') }}" required>
                                            @if ($errors->has('store_email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="store_password">{{ __('Password') }}</label>
                                            <input type="password" name="store_password" id="store_password"
                                                   class="form-control form-control-alternative{{ $errors->has('store_password') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Store Password') }}"
                                                   value="{{ old('store_password') }}" required>
                                            @if ($errors->has('store_password'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="store_commission">{{ __('Commission') }}</label>
                                            <input type="text" name="store_commission"
                                                      id="store_commission"
                                                      class="form-control form-control-alternative {{ $errors->has('store_lng') ? ' is-invalid' : '' }}"
                                                      placeholder="{{ __('Store Commission') }}"
                                                      value="{{ old('store_commission') }}">
                                        </div>
                                        @if ($errors->has('store_commission'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_commission') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="store_description">{{ __('Description') }}</label>
                                            <textarea type="text" name="store_description"
                                                      id="store_description"
                                                      class="form-control form-control-alternative"
                                                      placeholder="{{ __('Store Description') }}"
                                                      value="{{ old('store_description') }}"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">


                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                   for="is_faked_rating">{{ __('Use fake rating') }}</label>
                                            <br>
                                            <label class="custom-toggle">
                                                <input type="checkbox" name="is_faked_rating">
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                      data-label-on="Yes"></span>
                                            </label>
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
                (function () {


                    $('#store_logo').on('change', function (e) {
                        $('#logo-img').css('display', 'block')
                        var output = document.getElementById('logo-img');
                        output.src = URL.createObjectURL(e.target.files[0]);
                        $('.logo-icon').css('display', 'none');
                        output.onload = function () {
                            URL.revokeObjectURL(output.src) // free memory
                        }

                    });

                    $('#store_cover').on('change', function (e) {
                        $('#cover-img').css('display', 'block')
                        var output = document.getElementById('cover-img');
                        output.src = URL.createObjectURL(e.target.files[0]);
                        $('.cover-icon').css('display', 'none');
                        output.onload = function () {
                            URL.revokeObjectURL(output.src) // free memory
                        }

                    });


                })();
            </script>
@endsection