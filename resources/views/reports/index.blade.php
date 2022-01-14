@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Reports') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('List of Reports') }}</li>
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
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Orders Reports') }}</h3>
                        </div>
{{--                        <div class="col-4 text-right">--}}
{{--                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-sync-alt"></i></a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-12">
                    @include('partials.flash')
                </div>
                <div class="container-fluid">
                    <div class="header-body">
                        <form id="filter_w_date" method="GET">
                            @csrf
                            <div class="form-group row">
                                <label for="example-week-input" class="col-md-2 col-form-label form-control-label">Date</label>
                                <div class="date-div form-group col-md-10 col-sm-3">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="ni ni-calendar-grid-58 text-primary"></i></span>                                        </div>
                                        <input type="text" class="form-control filter_date" id="reports_date" name="reports_date">
                                    </div>
                                </div>
                            </div>
                        </form>
                        @include('reports.partials.card')
                    </div>
                </div>
                @include('reports.partials.orders_table')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Shifts Reports') }}</h3>
                        </div>
                        {{--                        <div class="col-4 text-right">--}}
                        {{--                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-sync-alt"></i></a>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="col-12">
                    @include('partials.flash')
                </div>
                <div class="container-fluid">
                    <div class="header-body">
                        <form id="filter_w_week" method="GET">
                            @csrf
                            <div class="form-group row">
                                <label for="example-week-input" class="col-md-2 col-form-label form-control-label">Date</label>
                                <div class="date-div form-group col-md-10 col-sm-3">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="ni ni-calendar-grid-58 text-primary"></i></span>                                        </div>
                                        <input class="form-control filter_week" type="week" name="reports_week" value="{{ $week }}" id="reports_week">
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{--                        @include('reports.partials.shiftcards')--}}
                    </div>
                </div>
                @include('reports.partials.shifts_table')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>


        $(document).ready(function() {

            var start = moment().format("YYYY/MM/DD"); //moment().startOf('month').format("DD/MM/YYYY");
            var end =moment().format("YYYY/MM/DD"); // moment().endOf('month').format("DD/MM/YYYY");

            function cb(start, end) {
                $('.filter_date span').html(start + ' - ' + end);
            }

            $('.filter_date').daterangepicker({
                locale: {
                    format: 'YYYY/MM/DD',
                    "firstDay": 1,
                    "separator": " - ",
                },
                "alwaysShowCalendars": true,
                "showWeekNumbers": true,
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'This Week': [moment().startOf('isoWeek'), moment().endOf('isoWeek')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
            cb(start, end);


            $('.filter_date').on('change.datepicker', function(ev){
                var picker = $(ev.target).data('daterangepicker');
                console.log(picker.startDate); // contains the selected start date
                console.log(picker.endDate); // contains the selected end date
                var form = $('#filter_w_date');
                form.submit();
                // ... here you can compare the dates and call your callback.
            });

            $('.filter_week').on('change', function(){
                var form = $('#filter_w_week');
                form.submit();
                // ... here you can compare the dates and call your callback.
            });
            
        });
    </script>
@endsection