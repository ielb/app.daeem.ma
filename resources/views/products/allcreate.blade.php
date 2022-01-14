@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Products') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.allproducts') }}">{{__('List of Products')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Add products') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <br/>
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Product Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            {{--                        @if(auth()->user()->hasRole('owner'))--}}
                            {{--                            <a href="{{ route('items.index') }}" class="btn btn-sm btn-primary">{{ __('Back to items') }}</a>--}}
                            {{--                        @elseif(auth()->user()->hasRole('admin'))--}}
                            {{--                            <a href="{{ route('items.admin', $restorant) }}" class="btn btn-sm btn-primary">{{ __('Back to items') }}</a>--}}
                            {{--                        @endif--}}
                        </div>
                    </div>
                </div>
                <br/>
                <div class="col-12">
                    @include('partials.flash')
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">{{ __('Product information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('products.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('product_sku') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="product_sku">{{ __('Product SKU') }}</label>
                                        <input type="text" name="product_sku" id="product_sku" class="form-control form-control-alternative{{ $errors->has('product_sku') ? ' is-invalid' : '' }}" placeholder="{{ __('SKU') }}" value="{{ old('product_sku') }}" required autofocus>
                                        @if ($errors->has('product_sku'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_sku') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="product_name">{{ __('Product Name') }}</label>
                                        <input type="text" name="product_name" id="product_name" class="form-control form-control-alternative{{ $errors->has('product_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('product_name') }}" required autofocus>
                                        @if ($errors->has('product_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('product_subcategory') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="stores">{{ __('stores') }}</label>
                                        <select class="form-control select2 form-control-alternative" id="stores" name="stores" required>
                                            <option value="">{{__('SELECT STORE')}}</option>
                                            @foreach ($stores as $store)
                                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('product_subcategory') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="category">{{ __('Category') }}</label>
                                        <select class="form-control select2 form-control-alternative" id="category" name="category" required>
                                                        <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('product_subcategory') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="product_subcategory">{{ __('Subcategory') }}</label>
                                        <select class="form-control select2 form-control-alternative" id="product_subcategory" name="product_subcategory" required>
                                                        <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group{{ $errors->has('product_description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="product_description">{{ __('Product Description') }}</label>
                                        <textarea id="product_description" name="product_description" class="form-control form-control-alternative{{ $errors->has('product_description') ? ' is-invalid' : '' }}" placeholder="{{ __('Product Description here ... ') }}" value="{{ old('product_description') }}" required autofocus rows="3"></textarea>
                                        @if ($errors->has('product_description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('product_price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="product_price">{{ __('Product Price') }}</label>
                                        <input type="number" step="any" name="product_price" id="product_price" class="form-control form-control-alternative{{ $errors->has('product_price') ? ' is-invalid' : '' }}" placeholder="{{ __('Price') }}" value="{{ old('product_price') }}" required autofocus>
                                        @if ($errors->has('product_price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="product_weight">{{ __('Product Weight') }}</label>
                                        <input type="text" name="product_weight" id="product_weight" class="form-control form-control-alternative" placeholder="{{ __('Weight') }}" value="{{ old('product_weight') }}" autofocus>
                                    </div>
                                    <div class="form-group text-center{{ $errors->has('product_image') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="product_image">{{ __('Product Image') }}</label>
                                        <div class="text-center">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                    <img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg" width="200px" height="150px" alt="..."/>
                                                </div>
                                                <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select image') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="product_image" accept="image/x-png,image/gif,image/jpeg">
                                    </span>
                                                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-6 mb-xl-0">
            <br/>
            <div class="card card-profile shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="h3 mb-0">{{ __('Availability & Status') }}</h5>
                            <div class="form-group text-center mt-5">
                                <label class="form-control-label" for="">{{ __('Availability') }}</label>
                                <label class="custom-toggle" style="float: right">
                                    <input type="checkbox" checked disabled>
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                            </div>
                            <div class="form-group text-center">
                                <label class="form-control-label" for="">{{ __('Status') }}</label>
                                <label class="custom-toggle" style="float: right">
                                    <input type="checkbox" checked disabled>
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2({
                allowClear: true,
                width: "resolve"
            });

            // stores category

            $('#stores').change(function(){
                var storeID = $(this).val();
                    if(storeID){
                     $.ajax({
                         type:"GET",
                         dataType : 'JSON',
                         url:'/products/stores/subcategory/'+storeID,
                         success:function(response){
                             if(response){
                                var categories = response.data;
                             $('#category').html('');
                                 var html = '<option{{__('Select a Category')}}</option>';
                             
                             for(var i = 0; i<categories.length ; i++){

                               html += '<option value="'+categories[i].id+'">'+categories[i].name+'</option>';
                             
                             }
                     
                             $('#category').html(html).select2({
                                 allowClear : true
                             }).change();

                             }else{
                                $("category").empty();
                            }
                             
                         }


                        });
                    }
                        else{
                            $("category").empty();
                        }
         
             });

             // category
             $('#category').change(function(){
                var categoryID = $(this).val();
                     $.ajax({
                         type:"GET",
                         dataType : 'JSON',
                         url:'/products/stores/subcategory/category/'+categoryID,
                         success:function(res){
                             console.log(res);
                            
                                var subcategories = res.data;
                             $('#product_subcategory').html('');
                             var html = '<option{{__('Select a sub Category')}}</option>';
                             
                             for(var i = 0; i<subcategories.length ; i++){

                               html += '<option name="subcategory_id" value="'+subcategories[i].id+'">'+subcategories[i].name+'</option>';
                             
                             }
                     
                             $('#product_subcategory').html(html).select2({
                                 allowClear : true
                             });

                             
                         }


                        });
         
             });

        });


        


    </script>
@endsection