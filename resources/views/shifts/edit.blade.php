@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Shifts') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit shift') }}</li>
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
                            <h3 class="mb-0">{{ __('Shifts Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('shifts') }}"
                               class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        @include('partials.flash')
                    </div>
                    <h6 class="heading-small text-muted mb-4">{{ __('Shifts information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('shift.update') }}" autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="shift_id" value="{{$shift->id}}">
                            <div class="form-group row">
                                <label for="example-week-input"
                                       class="col-md-2 col-form-label form-control-label">Week</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="week"  disabled value="{{$week}}" name="week" id="example-week-input">
                                </div>
                            </div>
                            

                            <div class="row">

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" checked disabled name="day"
                                                           class="custom-control-input" id="day_id"
                                                           value="{{$shift->day_id}}">
                                                    <label class="custom-control-label"
                                                           for="day{{$shift->day->number}}">{{$shift->day->name}}</label>
                                                </div>
                                                <button class="btn btn-sm btn-success btn-plus"
                                                        data-value="{{$shift->day->number}}" type="button"><i
                                                            class="fa fa-plus"></i></button>

                                            </div>
                                            <div class="col-3">
                                            </div>
                                            <hr>
                                            <div class="col-12">
                                                <div class="row" id="row-{{$shift->day->number}}">
                                                    @foreach($shift->shifts_ as $key => $sh)

                                                            <div class="col-6" id="col-{{$key+1}}">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                        class="ni ni-time-alarm"></i></span>
                                                                            </div>
                                                                            <input type="hidden" name="option_ids[]" value="{{$sh[2]}}">
                                                                            <input id="shift_from-{{$key+1}}"
                                                                                   name="shift_from[]"
                                                                                   value="{{$sh[0]}}"
                                                                                   class="flatpickr datetimepicker datetimepicker-from form-control"
                                                                                   type="text"
                                                                                   placeholder="{{ __("Time") }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 text-center">
                                                                        <p class="display-4">-</p>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                        class="ni ni-time-alarm"></i></span>
                                                                            </div>
                                                                            <input id="shift_to-{{$key+1}}"
                                                                                   name="shift_to[]"
                                                                                   value="{{$sh[1]}}"
                                                                                   class="flatpickr datetimepicker datetimepicker-to form-control"
                                                                                   type="text"
                                                                                   placeholder="{{ __("Time") }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <button class="btn btn-sm btn-danger mt-2 btn-remove-shift" type="button"
                                                                                    data-value="col-{{$key+1}}"><i
                                                                                        class="fa fa-minus"></i></button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
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
        @endsection
        @section('scripts')
            <script >
                (function () {




                })();
            </script>
            <script type="text/javascript">
                (function () {
                    //hour store
                    "use strict";
                    var defaultHourFrom = "07:00";
                    var defaultHourTo = "22:00";

                    var timeFormat = '{{ env('TIME_FORMAT', '24hours') }}';

                    function formatAMPM(date) {
                        //var hours = date.getHours();
                        //var minutes = date.getMinutes();
                        var hours = date.split(':')[0];
                        var minutes = date.split(':')[1];

                        var ampm = hours >= 12 ? 'pm' : 'am';
                        hours = hours % 12;
                        hours = hours ? hours : 12; // the hour '0' should be '12'
                        //minutes = minutes < 10 ? '0'+minutes : minutes;
                        var strTime = hours + ':' + minutes + ' ' + ampm;
                        return strTime;
                    }

                    //console.log(formatAMPM("19:05"));

                    var config = {
                        enableTime: true,
                        dateFormat: timeFormat == "AM/PM" ? "h:i K" : "H:i",
                        noCalendar: true,
                        altFormat: timeFormat == "AM/PM" ? "h:i K" : "H:i",
                        altInput: true,
                        allowInput: true,
                        time_24hr: timeFormat == "AM/PM" ? false : true,
                        onChange: [
                            function (selectedDates, dateStr, instance) {
                                //...
                                this._selDateStr = dateStr;
                            },
                        ],
                        onClose: [
                            function (selDates, dateStr, instance) {
                                if (this.config.allowInput && this._input.value && this._input.value !== this._selDateStr) {
                                    this.setDate(this.altInput.value, false);
                                }
                            }
                        ]
                    };


                    var hourFrom = flatpickr($('.datetimepicker-from'), config);
                    var hourTo = flatpickr($('.datetimepicker-to'), config);

                    //hourFrom.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourFrom) : defaultHourFrom, false);

                    // ==================================================


                    var days = {{count($shift->shifts_)}} ;



                    $('.btn-plus').click(function () {

                        var row = $(this).attr('data-value');
                        var d = 0;

                        days++;
                        d = days;


                        var html = ' <div class="col-6" id="col-' + d + '">' +
                            '<div class="row">' +
                            '<div class="col-4">' +
                            '<div class="input-group">' +
                            '<div class="input-group-prepend">' +
                            '<span class="input-group-text"><i class="ni ni-time-alarm"></i></span>' +
                            '</div>' +
                            '<input  name="option_ids[]" value="-1" type="hidden" > ' +
                            '<input id="shift_from-' + d + '" name="shift_from[]" ' +
                            'value="09:00" class="flatpickr datetimepicker datetimepicker-from form-control" type="text" placeholder="Time" >' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-1 text-center">' +
                            '<p class="display-4">-</p>' +
                            '</div>' +
                            '<div class="col-4">' +
                            '<div class="input-group">' +
                            '<div class="input-group-prepend">' +
                            '<span class="input-group-text"><i class="ni ni-time-alarm"></i></span>' +
                            '</div>' +
                            '<input id="shift_to-' + d + '" name="shift_to[]" value="13:00"' +
                            'class="flatpickr datetimepicker datetimepicker-to form-control" type="text"' +
                            'placeholder="Time">' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-3">' +
                            '<div class="form-group">' +
                            '<button type="button" class="btn btn-sm btn-danger mt-2 btn-remove-shift" data-value="col-' + d + '"><i class="fa fa-minus"></i></button></div></div></div> </div>';

                        $('#row-' + row).append(html)

                        flatpickr($('.datetimepicker-from'), config);
                        flatpickr($('.datetimepicker-to'), config);
                    })

                    // remove column shift
                    $('body').delegate('.btn-remove-shift','click',function (){


                        var col = $(this).attr('data-value');
                        $('#'+col).hide();


                    })
                })();
            </script>

@endsection