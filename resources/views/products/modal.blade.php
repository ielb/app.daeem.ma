<!-- EDIT Category -->
<div class="modal fade" id="modal-edit-subcategory" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-notification">{{ __('Edit Subcategory') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" id="form-edit-subcategory" method="post" action="" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input name="subcategory_id_edit" class="subcategory_id" id="subcategory_id_edit" type="hidden" required>
                            <div class="form-group{{ $errors->has('subcategory_name_edit') ? ' has-danger' : '' }}">
                                <input class="form-control" name="subcategory_name_edit" id="subcategory_name_edit" placeholder="{{ __('Subcategory name') }} ..." type="text" required>
                                @if ($errors->has('category_name_edit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_name_edit') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group text-center{{ $errors->has('subcategory_image_edit') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="subcategory_image_edit">{{ __('Subcategory Image') }}</label>
                                <div class="text-center">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            <img id="subcategory_image_edit" name="subcategory_image_edit" width="200px" height="150px" alt="..."/>
                                        </div>
                                        <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select image') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="subcategory_image_edit" accept="image/x-png,image/gif,image/jpeg">
                                    </span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input name="subcategory_category_edit" id="subcategory_category_edit" type="hidden" required>
                            <div class="form-group text-center">
                                <label class="form-control-label text-center" for="subcategory_status_edit">{{ __('Active') }}</label><br>
                                <label class="custom-toggle custom-toggle-success">
                                    <input type="checkbox" name="subcategory_status_edit" id="subcategory_status_edit">
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-multiple-product" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-new-item">{{ __('Add Multiple products') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="row p-0">
                            <div class="col text-right">
                                <button class="btn btn-sm btn-success tool btn-add-row" title="{{ __('Add row') }}"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                        <br>
                        <form role="form" method="post" action="{{ route('products.store_multiple') }}" enctype="multipart/form-data">
                            <input name="subcategory_id" class="subcategory_id" id="subcategory_id" type="hidden" required>
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                <th>{{ __('Product Sku') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Subcategory') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Weight') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Image') }}</th>
                                </thead>
                                <tbody id="rows-container">
                                <tr class="p-1">
                                    <td class="p-1">
                                        <div class="form-group">
                                            <input class="form-control" name="products_sku[]"  placeholder="{{ __('Product Sku') }} ..." type="text" required>
                                        </div>
                                    </td>
                                    <td class="p-1">
                                        <div class="form-group">
                                            <input class="form-control" name="products_name[]"  placeholder="{{ __('Name') }} ..." type="text" required>
                                        </div>
                                    </td>
                                    <td class="p-1">
                                        <div class="form-group">
                                            <select class="form-control select2 form-control-alternative product_subcategory" id="product_subcategory" name="product_subcategory[]" required>
                                                @foreach ($categories as $category)
                                                    <optgroup label="{{ $category->name }}">
                                                        @foreach($category->subcategories as $selectedsubcategory)
                                                            @if($selectedsubcategory->id == $subcategory->id)
                                                                <option selected value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                                            @else
                                                                <option value="{{ $selectedsubcategory->id }}">{{ $selectedsubcategory->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>                                        </div>
                                    </td>
                                    <td class="p-1">
                                        <div class="form-group">
                                            <input class="form-control" name="product_description[]"  placeholder="{{ __('Description') }} ..." type="text" required>
                                        </div>
                                    </td>
                                    <td class="p-1">
                                        <div class="form-group">
                                            <input class="form-control" name="product_weight[]"  placeholder="{{ __('Weight') }} ..." type="text" required>
                                        </div>
                                    </td>
                                    <td class="p-1">
                                        <div class="form-group">
                                            <input class="form-control" name="products_price[]"  placeholder="{{ __('Price') }} ..." type="text" required>
                                        </div>
                                    </td>
                                    <td class="p-1">
                                        <div class="form-group text-center">
                                            <div class="text-center ">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 40px; height: 40px;">
                                                        <img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg"
                                                             width="60px" height="60px" alt="..."/>
                                                    </div>
                                                    <div>
                                                        <span class="btn btn-outline-secondary btn-file">
                                                        <span class="fileinput-new">{{ __('Select image') }}</span>
                                                        <span class="fileinput-exists">{{ __('Change') }}</span>
                                                            <input type="file" required name="product_image[]" accept="*">
                                                        </span>
                                                        <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger btn-remove-row tool" type="button" title="{{__('Remove')}}"> <i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<div class="modal fade" id="modal-upload-excel" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-xl modal-dialog-centered modal-" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h3 class="modal-title" id="modal-title-notification">{{ __('Upload Excel file') }}</h3>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body p-0">--}}
{{--                <div class="card bg-secondary shadow border-0">--}}
{{--                    <div class="card-body px-lg-5 py-lg-5">--}}
{{--                        <div class="form-group text-center">--}}
{{--                            <label class="form-control-label" for="cat_image">{{ __('Excel file') }}</label>--}}
{{--                            <div class="text-center">--}}
{{--                                <form method="POST" enctype="multipart/form-data" id="laravel-ajax-file-upload">--}}
{{--                                    <input id="excel_input" name="excel_input" type="file">--}}
{{--                                    <button id="excel_btn" type="submit" class="btn btn-sm btn-info">Upload</button>--}}
{{--                                </form>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row table-responsive" id="data-div">--}}
{{--                            <style>--}}
{{--                                .label-file {--}}
{{--                                    cursor: pointer;--}}
{{--                                    color: #00b1ca;--}}
{{--                                    font-weight: bold;--}}
{{--                                }--}}
{{--                                .label-file:hover {--}}
{{--                                    color: #25a5c4;--}}
{{--                                }--}}

{{--                                /* et on masque le input*/--}}
{{--                                .input-file {--}}
{{--                                    display: none;--}}
{{--                                }--}}
{{--                            </style>--}}
{{--                            <table class="table">--}}

{{--                                <thead>--}}
{{--                                <th>{{__('store')}}</th>--}}
{{--                                <th>{{__('Subcategory')}}</th>--}}
{{--                                <th>{{__('Product Name')}}</th>--}}
{{--                                <th>{{__('Sku')}}</th>--}}
{{--                                <th>{{__('Description')}}</th>--}}
{{--                                <th>{{__('price')}}</th>--}}
{{--                                <th>{{__('weight')}}</th>--}}
{{--                                <th>{{__('Upload image')}}</th>--}}
{{--                                </thead>--}}
{{--                                <tbody id="excel-data">--}}

{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}