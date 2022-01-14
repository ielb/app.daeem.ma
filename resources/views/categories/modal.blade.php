

<!-- EDIT Category -->
<div class="modal fade" id="modal-edit-category" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-notification">{{ __('Edit category') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" id="form-edit-category" method="post" action="" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input name="cat_id" id="cat_id" type="hidden" required>
                            <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                                <input class="form-control" name="cat_name" id="cat_name" placeholder="{{ __('Category name') }} ..." type="text" required>
                                @if ($errors->has('category_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group text-center{{ $errors->has('category_image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="cat_image">{{ __('Category Image') }}</label>
                                <div class="text-center">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            <img id="cat_image" name="cat_image" width="200px" height="150px" alt="..."/>
                                        </div>
                                        <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select image') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="cat_image" accept="image/x-png,image/gif,image/jpeg">
                                    </span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <label class="form-control-label text-center" for="cat_status">{{ __('Active') }}</label><br>
                                <label class="custom-toggle custom-toggle-success">
                                    <input type="checkbox" name="cat_status" id="cat_status">
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


<div class="modal fade" id="modal-new-category" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-new-item">{{ __('Add new category') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                                <input class="form-control" name="category_name" id="category_name" placeholder="{{ __('Category name') }} ..." type="text" required>
                                @if ($errors->has('category_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group text-center{{ $errors->has('category_image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="category_image">{{ __('Category Image') }}</label>
                                <div class="text-center">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            <img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg" width="200px" height="150px" alt="..."/>
                                        </div>
                                        <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select image') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="category_image" accept="image/x-png,image/gif,image/jpeg">
                                    </span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input name="store_id" class="store_id" id="store_id" type="hidden" required>
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
<div class="modal fade" id="modal-multiple-categories" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-new-item">{{ __('Add Multiple categories') }}</h3>
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
                        <form role="form" method="post" action="{{ route('categories.store_multiple') }}" enctype="multipart/form-data">
                            <input name="store_id" class="store_id" id="store_id" type="hidden" required>
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <th>{{ __('Category Name') }}</th>
                                    <th>{{ __('Category Image') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </thead>
                                <tbody id="rows-container">
                                    <tr class="p-1">
                                        <td class="p-1">
                                            <div class="form-group">
                                                <input class="form-control" name="category_name[]"  placeholder="{{ __('Category name') }} ..." type="text" required>
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
                                                            <input type="file" required name="category_image[]" accept="image/x-png,image/gif,image/jpeg">
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
{{--<div class="modal fade" id="modal-import-items" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h3 class="modal-title" id="modal-title-new-item">{{ __('Import items from CSV') }}</h3>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body p-0">--}}
{{--                <div class="card bg-secondary shadow border-0">--}}
{{--                    <div class="card-body px-lg-5 py-lg-5">--}}
{{--                        <div class="col-md-10 offset-md-1">--}}
{{--                            <form role="form" method="post" action="{{ route('import.items') }}" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
{{--                                <div class="form-group text-center{{ $errors->has('item_image') ? ' has-danger' : '' }}">--}}
{{--                                    <label class="form-control-label" for="items_excel">{{ __('Import your file') }}</label>--}}
{{--                                    <div class="text-center">--}}
{{--                                        <input type="file" class="form-control form-control-file" name="items_excel" accept=".csv, .ods, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <input name="res_id" id="res_id" type="hidden" value="{{ $restorant_id }}" required>--}}
{{--                                <div class="text-center">--}}
{{--                                    <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
