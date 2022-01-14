<form method="post" action="{{ route('supermarket.update',$supermarket) }}" autocomplete="off" class="needs-validation" novalidate enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="pl-lg-4">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-control-label" for="logo">{{ __('Supermarket Logo') }}</label>
                    <div class="image-upload">
                        <label for="supermarket_logo" style="cursor: pointer">
                            <img id="logo-img" width="250" height="150" src="{{asset('images/supermarkets/logos/'.$supermarket->logo) }}"  />
                        </label>
                        <input  type="file"  accept="image/*"  style="display: none" name="supermarket_logo" id="supermarket_logo" />

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-control-label" for="cover">{{ __('Supermarket Cover') }}</label>
                    <div class="image-upload">
                        <label for="supermarket_cover" style="cursor: pointer">
                            <img id="cover-img" width="250" height="150" src="{{asset('images/supermarkets/covers/'.$supermarket->cover) }}"  />
                        </label>
                        <input  type="file"  accept="image/*"  style="display: none" name="supermarket_cover" id="supermarket_cover" />

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group{{ $errors->has('supermarket_name') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="supermarket_name">{{ __('Name') }}</label>
                    <input type="text" name="supermarket_name" id="supermarket_name" class="form-control form-control-alternative{{ $errors->has('supermarket_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Supermarket Name') }}" value="{{ old('supermarket_name',$supermarket->name) }}" required>
                    @if ($errors->has('supermarket_name'))
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('supermarket_name') }}</strong>
                                            </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group{{ $errors->has('supermarket_phone') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="supermarket_phone">{{ __('Phone') }}</label>
                    <input type="text" name="supermarket_phone" id="supermarket_phone" class="form-control form-control-alternative{{ $errors->has('supermarket_phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Supermarket Phone') }}" value="{{ old('supermarket_phone',$supermarket->phone) }}" required>
                    @if ($errors->has('supermarket_phone'))
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('supermarket_phone') }}</strong>
                                            </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group{{ $errors->has('supermarket_address') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="supermarket_address">{{ __('Address') }}</label>
                    <input type="text" name="supermarket_address" id="supermarket_address" class="form-control form-control-alternative{{ $errors->has('supermarket_address') ? ' is-invalid' : '' }}" placeholder="{{ __('Supermarket Address') }}" value="{{ old('supermarket_address', $supermarket->address) }}" required>
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
                            @if($supermarket->city_id == $city->id)
                            <option value="{{$city->id}}" selected>{{ucfirst($city->name)}}</option>
                            @else
                                <option value="{{$city->id}}">{{ucfirst($city->name)}}</option>
                            @endif
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
                    <textarea type="text" name="supermarket_description" id="supermarket_description" class="form-control form-control-alternative" placeholder="{{ __('Supermarket Description') }}" >{{ $supermarket->description }}</textarea>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
        </div>
    </div>
</form>
