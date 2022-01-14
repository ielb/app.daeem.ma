<div class="card card-profile bg-secondary shadow">
    <div class="card-header">

        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">{{ __("Working Hours")}}</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content" id="shifts">
             <form method="post" action="{{route('store.workingHours',$store)}}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            @if($hours)
                                @foreach($days as $key => $value)
                                    @php
                                    $from = $key.'_from';
                                     $to = $key.'_to' ;
                                    @endphp


                                    <br/>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" @if($hours->$from != '00:00' && $hours->$from != '') checked @endif name="days[]" class="custom-control-input" id="{{ 'day'.$key }}" value={{ $key }} >
                                                <label class="custom-control-label" for="{{ 'day'.$key }}">{{ __($value) }}</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                                                </div>
                                                <input id="{{ $key.'_from' }}" name="{{ 'from_'.$key }}" value="{{$hours->$from }}" class="flatpickr datetimepicker form-control" type="text" placeholder="{{ __('Time') }}">
                                            </div>
                                        </div>
                                        <div class="col-2 text-center">
                                            <p class="display-4">-</p>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                                                </div>
                                                <input id="{{ $key.'_to' }}" name="{{ 'to_'.$key }}" value="{{ $hours->$to }}" class="flatpickr datetimepicker form-control" type="text" placeholder="{{ __('Time') }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            @else
                                @foreach($days as $key => $value)
                                    <br/>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="days[]" class="custom-control-input" id="{{ 'day'.$key }}" value={{ $key }} >
                                                <label class="custom-control-label" for="{{ 'day'.$key }}">{{ __($value) }}</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                                                </div>
                                                <input id="{{ $key.'_from' }}" name="{{ 'from_'.$key }}" class="flatpickr datetimepicker form-control" type="text" placeholder="{{ __('Time') }}">
                                            </div>
                                        </div>
                                        <div class="col-2 text-center">
                                            <p class="display-4">-</p>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                                                </div>
                                                <input id="{{ $key.'_to' }}" name="{{ 'to_'.$key }}" class="flatpickr datetimepicker form-control" type="text" placeholder="{{ __('Time') }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                        </div>
                    </form>
        </div>

    </div>
</div>
