<div class="card-header border-0">
        <form method="GET">
            <div class="tab-content products-filters">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="store">{{ __('Filter by Stores') }}</label>
                            <select class="select2" name="store_id" id="store_id">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="category">{{ __('Filter by Categories') }}</label>

                            <select class="select2" id="category_id" name="category_id">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="subcategory">{{ __('Filter by Subcategories') }}</label>
                            <select class="select2" name="subcategory_id" id="subcategory_id">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for=""></label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-md btn-block mt-2">{{ __('Filter') }}</button>
                                @if ($parameters)
                                    <a href="{{ Request::url() }}" class="btn btn-md btn-block">{{ __('Clear Filters') }}</a>
                                @else
                                    <div class="col-md-8"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

{{--                <div class="col-md-6 offset-md-6">--}}
{{--                    <div class="row">--}}
{{--                                                @if ($parameters)--}}
{{--                                                    <div class="col-md-4">--}}
{{--                                                        <a href="{{ Request::url() }}" class="btn btn-md btn-block">{{ __('Clear Filters') }}</a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-4">--}}
{{--                                                        <a href="{{Request::fullUrl()."&report=true" }}" class="btn btn-md btn-success btn-block">{{ __('Download report') }}</a>--}}
{{--                                                    </div>--}}
{{--                                                @else--}}
{{--                                                    <div class="col-md-8"></div>--}}
{{--                                                @endif--}}


{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </form>
</div>