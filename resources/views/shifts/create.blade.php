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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Add shift') }}</li>
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
                    <h6 class="heading-small text-muted mb-4">{{ __('Shifts information') }}</h6>
                    <div class="pl-lg-4">
                        <form method="post" action="{{ route('shift.store') }}" autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="example-week-input"
                                       class="col-md-2 col-form-label form-control-label">Week</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="week"  required name="week" id="example-week-input">
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-10">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                               for="zone">{{ __('Zones') }}</label>
                                        <select class="form-control" name="zone" id="zone" required>
                                            @foreach($zones as $zone)
                                                <option value="{{$zone->id}}">{{ucfirst($zone->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="example-week-input"
                                           class=" col-form-label form-control-label">&nbsp;</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"  name="all_zones"
                                               class="custom-control-input" id="all_zones"
                                               value="1">
                                        <label class="custom-control-label"
                                               for="all_zones">All</label>
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                @foreach($days as $key => $day)
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" checked name="days[]"
                                                           class="custom-control-input" id="day{{$day->number}}"
                                                           value="{{$day->id}}">
                                                    <label class="custom-control-label"
                                                           for="day{{$day->number}}">{{$day->name}}</label>
                                                </div>
                                                <button class="btn btn-sm btn-success btn-plus"
                                                        data-value="{{$day->number}}" type="button"><i
                                                            class="fa fa-plus"></i></button>

                                            </div>
                                            <div class="col-3">
                                            </div>
                                            <hr>
                                            <div class="col-12">
                                                <div class="row" id="row-{{$day->number}}">
                                                    <div class="col-6" id="col-{{$day->number}}-1">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                        class="ni ni-time-alarm"></i></span>
                                                                    </div>
                                                                    <input id="shift_from{{$day->number}}-1"
                                                                           name="shift_from{{$day->number}}[]"
                                                                           value="09:00"
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
                                                                    <input id="shift_to{{$day->number}}-1"
                                                                           name="shift_to{{$day->number}}[]"
                                                                           value="13:00"
                                                                           class="flatpickr datetimepicker datetimepicker-to form-control"
                                                                           type="text"
                                                                           placeholder="{{ __("Time") }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-group">
                                                                    <button class="btn btn-sm btn-danger mt-2 btn-remove-shift" type="button"
                                                                            data-value="col-{{$day->number}}-1"><i
                                                                                class="fa fa-minus"></i></button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6" id="col-{{$day->number}}-2">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                        class="ni ni-time-alarm"></i></span>
                                                                    </div>
                                                                    <input id="shift_from{{$day->number}}-2"
                                                                           name="shift_from{{$day->number}}[]"
                                                                           value="14:00"
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
                                                                    <input id="shift_to{{$day->number}}-2"
                                                                           name="shift_to{{$day->number}}[]"
                                                                           value="18:00"
                                                                           class="flatpickr datetimepicker datetimepicker-to form-control"
                                                                           type="text"
                                                                           placeholder="{{ __("Time") }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-group">
                                                                    <button class="btn btn-sm btn-danger mt-2 btn-remove-shift" type="button"
                                                                            data-value="col-{{$day->number}}-2"><i
                                                                                class="fa fa-minus"></i></button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


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


                     var d0 = 2 ;
                     var d1 = 2 ;
                     var d2 = 2 ;
                     var d3 = 2 ;
                     var d4 = 2 ;
                     var d5 = 2 ;
                     var d6 = 2;


                    $('.btn-plus').click(function () {

                        var row = $(this).attr('data-value');
                        var d = 0;

                        if(row === '0'){
                            d0++;
                            d=d0;
                        }else  if(row === '1'){
                            d1++;
                            d=d1;
                        }else if(row === '2'){
                            d2++;
                            d=d2;
                        }else if(row === '3'){
                            d3++;
                            d=d3;
                        }else if(row === '4'){
                            d4++;
                            d=d4;
                        }else if(row === '5'){
                            d5++;
                            d=d5;
                        }else if(row === '6'){
                            d6++;
                            d=d6;
                        }


                        var html = ' <div class="col-6" id="col-' + row + '-' + d + '">' +
                            '<div class="row">' +
                            '<div class="col-4">' +
                            '<div class="input-group">' +
                            '<div class="input-group-prepend">' +
                            '<span class="input-group-text"><i class="ni ni-time-alarm"></i></span>' +
                            '</div>' +
                            '<input id="shift_from' + row + '-' + d + '" name="shift_from'+row+'[]" ' +
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
                            '<input id="shift_to' + row + '-' + d + '" name="shift_to'+row+'[]" value="13:00"' +
                            'class="flatpickr datetimepicker datetimepicker-to form-control" type="text"' +
                            'placeholder="Time">' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-3">' +
                            '<div class="form-group">' +
                            '<button type="button" class="btn btn-sm btn-danger mt-2 btn-remove-shift" data-value="col-' + row + '-' + d + '"><i class="fa fa-minus"></i></button></div></div></div> </div>';

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