<!-- ADD Subcategory -->
<div class="modal fade" id="modal-add-options" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-notification">{{ __('Add new option') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group{{ $errors->has('options_name') ? ' has-danger' : '' }}">
                                <input class="form-control" name="options_name" id="options_name" placeholder="{{ __('Enter option name,ex size') }} ..." type="text" required>
                                @if ($errors->has('options_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('options_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('option_list') ? ' has-danger' : '' }}">
                                <textarea id="option_list" name="option_list" class="form-control form-control-alternative{{ $errors->has('option_list') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter comma separated list of avaliable option values, ex: small,medium,large') }}" value="{{ old('option_list') }}" required autofocus rows="3"></textarea>                                @if ($errors->has('option_list'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('option_list') }}</strong>
                                    </span>
                                @endif
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