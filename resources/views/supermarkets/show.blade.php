@extends('layouts.app')



@section('header')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Supermarkets') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Details supermarket') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    {{-- <a href="#" class="btn btn-sm btn-neutral">New</a> --}}
                    {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
                </div>
            </div>
            <div class="col-12">
                @include('partials.flash')
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="header pb-6 pt-5 pt-md-8"
         style="background-image: url('{{asset('images/supermarkets/covers/'.$supermarket->cover)}}');background-size: cover;border-radius: 5px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Total Orders')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$total_orders}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-active-40"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Processed Orders')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$processed_orders}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Finished Orders')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$finished_orders}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-chart-bar-32"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="res_menagment" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active " id="tabs-menagment-main" data-toggle="tab"
                           href="#menagment" role="tab" aria-controls="tabs-menagment" aria-selected="true"><i
                                    class="ni ni-badge mr-2"></i>{{ __('Supermarket Management')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-menagment-main" data-toggle="tab" href="#hours"
                           role="tab" aria-controls="tabs-menagment" aria-selected="true"><i
                                    class="ni ni-time-alarm mr-2"></i>{{ __('Working Hours')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-menagment-main" data-toggle="tab" href="#orders"
                           role="tab" aria-controls="tabs-menagment" aria-selected="true"><i
                                    class="ni ni-bullet-list-67 mr-2"></i>{{ __('Orders History')}}</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>



    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12">
                <br/>

                <div class="tab-content" id="tabs">
                    <!-- Tab Managment -->
                    <div class="tab-pane fade show active" id="menagment" role="tabpanel"
                         aria-labelledby="tabs-icons-text-1-tab">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h3 class="mb-0"> <b>[{{$supermarket->id}}]</b> {{ strtoupper( $supermarket->name ) }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">{{ __('Supermarket information') }}</h6>
                                @include('supermarkets.partials.details')
                            </div>
                        </div>
                    </div>

                    <!-- Tab Hours -->
                    <div class="tab-pane fade show" id="hours" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        @include('supermarkets.partials.hours')
                    </div>

                    <!-- Tab Hours -->
                    <div class="tab-pane fade show" id="orders" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        @include('supermarkets.partials.orders')

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script type="text/javascript">
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

        $("input[type='checkbox'][name='days[]']").change(function () {
            //console.log($('#'+ this.id).attr("valuetwo"))
            var hourFrom = flatpickr($('#' + this.value + '_from'), config);
            var hourTo = flatpickr($('#' + this.value + '_to'), config);

            if (this.checked) {
                hourFrom.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourFrom) : defaultHourFrom, false);
                hourTo.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourTo) : defaultHourTo, false);
            } else {
                hourFrom.clear();
                hourTo.clear();
            }
        });


        $('#supermarket_logo').on('change', function (e) {
            $('#logo-img').css('display', 'block')
            var output = document.getElementById('logo-img');
            output.src = URL.createObjectURL(e.target.files[0]);
            $('.logo-icon').css('display', 'none');
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }

        });

        $('#supermarket_cover').on('change', function (e) {
            $('#cover-img').css('display', 'block')
            var output = document.getElementById('cover-img');
            output.src = URL.createObjectURL(e.target.files[0]);
            $('.cover-icon').css('display', 'none');
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }

        });

    </script>
@endsection