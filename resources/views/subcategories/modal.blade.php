

<!-- ADD Subcategory -->
<div class="modal fade" id="modal-subcategories-category" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-notification">{{ __('Add new subcategory') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{ route('subcategories.store', $category) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="category_id" id="category_id"  name="category_id" />
                            <div class="form-group{{ $errors->has('subcategory_name') ? ' has-danger' : '' }}">
                                <input class="form-control" name="subcategory_name" id="subcategory_name" placeholder="{{ __('Subcategory name') }} ..." type="text" required>
                                @if ($errors->has('subcategory_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subcategory_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group text-center{{ $errors->has('subcategory_image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="subcategory_image">{{ __('Subategory Image') }}</label>
                                <div class="text-center">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            <img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg" width="200px" height="150px" alt="..."/>
                                        </div>
                                        <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select image') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="subcategory_image" accept="image/x-png,image/gif,image/jpeg">
                                    </span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>
                                        </div>
                                    </div>
                                </div>
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

<div class="modal fade" id="modal-multiple-subcategories" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-new-item">{{ __('Add Multiple subcategories') }}</h3>
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
                        <form role="form" method="post" action="{{ route('subcategories.store_multiple',$category) }}" enctype="multipart/form-data">
                            <input name="category_id" class="category_id" id="category_id" type="hidden" required>
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                <th>{{ __('Subcategory Name') }}</th>
                                <th>{{ __('Subcategory Image') }}</th>
                                <th>{{ __('Actions') }}</th>
                                </thead>
                                <tbody id="rows-container-sub">
                                <tr class="p-1">
                                    <td class="p-1">
                                        <div class="form-group">
                                            <input class="form-control" name="subcategory_name[]"  placeholder="{{ __('Subcategory name') }} ..." type="text" required>
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
                                                            <input type="file" required name="subcategory_image[]" accept="image/x-png,image/gif,image/jpeg">
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
