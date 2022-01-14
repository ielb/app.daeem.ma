<form method="post" action="{{ route('store.update',$store) }}" autocomplete="off" class="needs-validation" novalidate enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="pl-lg-4">

        <div class="row">
            
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-control-label" for="logo">{{ __('Store Logo') }}</label>
                    <div class="image-upload">
                        <label for="store_logo" style="cursor: pointer">
                            <img id="logo-img" width="250" height="150" src="{{asset('images/stores/logos/'.$store->logo) }}"  />
                        </label>
                        <input  type="file"  accept="image/*"  style="display: none" name="store_logo" id="store_logo" />

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-control-label" for="cover">{{ __('Store Cover') }}</label>
                    <div class="image-upload">
                        <label for="store_cover" style="cursor: pointer">
                            <img id="cover-img" width="250" height="150" src="{{asset('images/stores/covers/'.$store->cover) }}"  />
                        </label>
                        <input  type="file"  accept="image/*"  style="display: none" name="store_cover" id="store_cover" />

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
                            @if($type->id == $store->store_type_id)
                                <option value="{{$type->id}}" selected>{{ucfirst($type->name)}}</option>
                            @else
                                <option value="{{$type->id}}">{{ucfirst($type->name)}}</option>
                            @endif
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
                    <label class="form-control-label" for="store_name">{{ __('Name') }}</label>
                    <input type="text" name="store_name" id="store_name" class="form-control form-control-alternative{{ $errors->has('store_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Store Name') }}" value="{{ old('store_name',$store->name) }}" required>
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
                    <label class="form-control-label" for="store_phone">{{ __('Phone') }}</label>
                    <input type="text" name="store_phone" id="store_phone" class="form-control form-control-alternative{{ $errors->has('store_phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Store Phone') }}" value="{{ old('store_phone',$store->phone) }}" required>
                    @if ($errors->has('store_phone'))
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group{{ $errors->has('store_phone_two') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="store_phone_two">{{ __('Phone 2') }}</label>
                    <input type="text" name="store_phone_two" id="store_phone_two" class="form-control form-control-alternative{{ $errors->has('store_phone_two') ? ' is-invalid' : '' }}" placeholder="{{ __('Store Phone 2') }}" value="{{ old('store_phone_two',$store->phone_two) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-control-label" for="store_city">{{ __('City') }}</label>
                    <select class="form-control" name="store_city" id="store_city">
                        @foreach($cities as $city)
                            @if($store->city_id == $city->id)
                                <option value="{{$city->id}}" selected>{{ucfirst($city->name)}}</option>
                            @else
                                <option value="{{$city->id}}">{{ucfirst($city->name)}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group{{ $errors->has('store_address') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="store_address">{{ __('Address') }}</label>
                    <input type="text" name="store_address" id="store_address" class="form-control form-control-alternative{{ $errors->has('store_address') ? ' is-invalid' : '' }}" placeholder="{{ __('Store Address') }}" value="{{ old('store_address', $store->address) }}" required>
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
                    <label class="form-control-label" for="store_lat">{{ __('Latitude') }}</label>
                    <input type="text" name="store_lat" id="store_lat" class="form-control form-control-alternative{{ $errors->has('store_lat') ? ' is-invalid' : '' }}" placeholder="{{ __('Store Latitude') }}" value="{{ $store->lat }}" required>
                    @if ($errors->has('store_lat'))
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_lat') }}</strong>
                                            </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-control-label" for="store_lng">{{ __('Longitude') }}</label>
                    <input type="text" name="store_lng" id="store_lng" class="form-control form-control-alternative{{ $errors->has('store_lng') ? ' is-invalid' : '' }}" placeholder="{{ __('Store Longitude') }}" value="{{ $store->lng }}" required>
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
                           value="{{ old('store_email',$store->email) }}" required>
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
                           for="store_password">{{ __('Password ') }} ( <small class="text-warning"> you can less this field empty to keep old password</small> ) </label>
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
                           value="{{ old('store_commission',$store->commission) }}">
                </div>
                @if ($errors->has('store_commission'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('store_commission') }}</strong>
                                            </span>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="form-control-label" for="store_description">{{ __('Description') }}</label>
                    <textarea type="text" name="store_description" id="store_description" class="form-control form-control-alternative" placeholder="{{ __('Store Description') }}" >{{ $store->description }}</textarea>
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
                        <input type="checkbox" name="is_faked_rating"
                        @if($store->use_fake_rating == '1')
                            checked
                        @endif
                        >
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
