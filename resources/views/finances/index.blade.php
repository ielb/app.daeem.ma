@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Finances') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="fas fa-home"></i></a></li>
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
    <form method="POST" id="date_form">
     @csrf
    <div class="form-group row text-white">
        <label for="example-week-input"
               class="col-md-2 col-form-label form-control-label text-white ">Date</label>
        <div class="date-div form-group col-md-10 col-sm-3 col-xs-12">
            <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="ni ni-calendar-grid-58 text-primary"></i></span>
                </div>
                <input type="text" class="form-control filter_date" id="inlineFormInputGroup" name="date_range">
            </div>
        </div>
    </div>
    </form>
    <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total orders</h5>
                            <span class="h2 font-weight-bold mb-0">{{$total_orders}}</span> <br>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> This month :</span>
                        <span class="font-weight-bold ml-1">
                                            {{$total_orders_this_month}}
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> Last month :</span>
                        <span class="font-weight-bold  ml-1">
                                            {{$total_orders_last_month}}
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                                        <span class="text-{{$total_orders_percent_color}} mr-2">
                                            <i class="fa fa-arrow-{{$total_orders_percent_arrow}}"></i>
                                            {{$total_orders_percent}}%
                                        </span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Delivered orders</h5>
                            <span class="h2 font-weight-bold mb-0">{{$total_delivered_orders}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> This month :</span>
                        <span class="font-weight-bold ml-1">
                                            {{$total_delivered_this_month}}
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> Last month :</span>
                        <span class="font-weight-bold  ml-1">
                                            {{$total_delivered_last_month}}
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-{{$delivered_orders_percent_color}} mr-2"><i
                                    class="fa fa-arrow-{{$delivered_orders_percent_arrow}}"></i> {{$delivered_orders_percent}}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Pending orders</h5>
                            <span class="h2 font-weight-bold mb-0">{{$total_pending_orders}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> This month :</span>
                        <span class="font-weight-bold ml-1">
                                            {{$total_pending_orders_this_month}}
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> Last month :</span>
                        <span class="font-weight-bold  ml-1">
                                            {{$total_pending_orders_last_month}}
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-{{$pending_orders_percent_color}} mr-2">
                            <i class="fa fa-arrow-{{$pending_orders_percent_arrow}}"></i> {{$pending_orders_percent}}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Refunded orders</h5>
                            <span class="h2 font-weight-bold mb-0">{{$total_refunded_orders}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> This month :</span>
                        <span class="font-weight-bold ml-1">
                                            {{$total_refunded_orders_this_month}}
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> Last month :</span>
                        <span class="font-weight-bold  ml-1">
                                            {{$total_refunded_orders_last_month}}
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-{{$refunded_orders_percent_color}} mr-2"><i
                                    class="fa fa-arrow-{{$refunded_orders_percent_arrow}}"></i> {{$refunded_orders_percent}}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Orders revenue</h5>
                            <span class="h2 font-weight-bold mb-0">{{$total_revenue_orders}} <span
                                        class="badge badge-gray">MAD</span></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> This month :</span>
                        <span class="font-weight-bold ml-1">
                                            {{$total_revenue_orders_this_month}} <span
                                    class="badge badge-gray">MAD</span>
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> Last month :</span>
                        <span class="font-weight-bold  ml-1">
                                            {{$total_revenue_orders_last_month}} <span
                                    class="badge badge-gray">MAD</span>
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-{{$revenue_orders_percent_color}} mr-2"><i
                                    class="fa fa-arrow-{{$revenue_orders_percent_arrow}}"></i> {{$revenue_orders_percent}}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Delivery revenue</h5>
                            <span class="h2 font-weight-bold mb-0">{{$delivery_revenue_orders}} <span
                                        class="badge badge-gray">MAD</span></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> This month :</span>
                        <span class="font-weight-bold ml-1">
                                            {{$delivery_revenue_orders_this_month}} <span
                                    class="badge badge-gray">MAD</span>
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> Last month :</span>
                        <span class="font-weight-bold  ml-1">
                                            {{$delivery_revenue_orders_last_month}} <span
                                    class="badge badge-gray">MAD</span>
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-{{$delivery_revenue_orders_percent_color}} mr-2"><i
                                    class="fa fa-arrow-{{$delivery_revenue_orders_percent_arrow}}"></i> {{$delivery_revenue_orders_percent}}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Products revenue</h5>
                            <span class="h2 font-weight-bold mb-0">{{$products_orders_revenue}} <span
                                        class="badge badge-gray">MAD</span></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> This month :</span>
                        <span class="font-weight-bold ml-1">
                                            {{$products_orders_revenue_this_month}} <span
                                    class="badge badge-gray">MAD</span>
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> Last month :</span>
                        <span class="font-weight-bold  ml-1">
                                            {{$products_orders_revenue_last_month}} <span
                                    class="badge badge-gray">MAD</span>
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-{{$products_orders_revenue_percent_color}} mr-2"><i
                                    class="fa fa-arrow-{{$products_orders_revenue_percent_arrow}}"></i> {{$products_orders_revenue_percent}}%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">NET DELIVERY</h5>
                            <span class="h2 font-weight-bold mb-0">{{$net_delivery_total}} <span
                                        class="badge badge-gray">MAD</span></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> This month :</span>
                        <span class="font-weight-bold ml-1">
                                            {{$net_delivery_total_this_month}} <span class="badge badge-gray">MAD</span>
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-nowrap"><i class="far fa-calendar-alt"></i> Last month :</span>
                        <span class="font-weight-bold  ml-1">
                                            {{$net_delivery_total_last_month}} <span class="badge badge-gray">MAD</span>
                                        </span>
                    </p>
                    <p class="mt-1 mb-0 text-sm">
                        <span class="text-{{$net_drivers_revenue_percent_color}} mr-2"><i
                                    class="fa fa-arrow-{{$net_drivers_revenue_percent_arrow}}"></i> {{$net_drivers_revenue_percent}}%</span>
                        <span class="text-nowrap">Since last month </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8 mb-3">
                                <h3 class="mb-0">{{ __('Drivers Stats') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">
                                    <i class="ni ni-bold-down"></i>
                                </button>
                            </div>

                            <div class="container collapse show" id="collapseExample">
                                <div class="row input-daterange datepicker">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="form-control-label">Date From</label>
                                            <input class="form-control form-control-sm" placeholder="Date From" name="fromDate" id="fromDate"
                                                   type="text" <?php if (isset($_GET['fromDate'])) {
                                                echo 'value="' . $_GET['fromDate'] . '"';
                                            } ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="form-control-label">Date to</label>
                                            <input class="form-control  form-control-sm" placeholder="Date to" name="toDate" id="toDate"
                                                   type="text" <?php if (isset($_GET['toDate'])) {
                                                echo 'value="' . $_GET['toDate'] . '"';
                                            } ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-control-label">Drivers</label>

                                        <select class="select2 form-control   form-control-sm" data-toggle="select" title="Simple select" data-live-search="true" data-placeholder="Select Driver ..."  name="driver_id" id="driver_id">
                                            <option></option>

                                            @foreach ($drivers as $driver)
                                                <option
                                                        {{ isset($_GET['driver_id']) && $_GET['driver_id'] == $driver->id ? "selected" : "" }}
                                                        value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-control-label">Stores</label>
                                        <select class="select2 form-control form-control-sm"  name="store_id" id="store_id" data-toggle="select" title="Simple select" data-live-search="true" data-placeholder="Select Store ..."  name="driver_id" id="driver_id">
                                        <option></option>
                                            @foreach ($stores as $store)
                                                <option
                                                        {{ isset($_GET['store_id']) && $_GET['store_id']  == $store->id ? "selected" : ""}}
                                                   value="{{ $store->id }}">{{$store->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-control-label">&nbsp;</label>
                                        @if ($parameters)

                                                <a href="{{ Request::url() }}"
                                                   class="btn btn-sm btn-block">{{ __('Clear Filters') }}</a>

                                        @endif

                                            <button type="button"
                                                    class="btn btn-primary btn-sm btn-block btn-get-stats">{{ __('Get stats') }}</button>

                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="row text-right">--}}
{{--                                @if ($parameters)--}}
{{--                                    <div class="col-md-9">--}}
{{--                                        <a href="{{ Request::url() }}"--}}
{{--                                           class="btn btn-md btn-block">{{ __('Clear Filters') }}</a>--}}
{{--                                    </div>--}}
{{--                                @else--}}
{{--                                    <div class="col-md-9"></div>--}}
{{--                                @endif--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <button type="submit"--}}
{{--                                            class="btn btn-primary btn-md btn-block">{{ __('Filter') }}</button>--}}
{{--                                </div>--}}
{{--                        </div>--}}
                    </div>
                <div class="row">
                    @include('partials.flash')
                </div>
                <div class="table-responsive py-5 px-3" style="" id="table-container">
                    <table class="table align-items-center table-flush" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Driver') }}</th>
                            <th scope="col">{{ __('Store') }}</th>
                            <th scope="col">{{ __('Last Month Earning') }}</th>
                            <th scope="col">{{ __('For Selected Date Earning') }}</th>
                            <th scope="col">{{ __('Total Earning') }}</th>
                        </tr>
                        </thead>
                        <tbody id="data-container">
                            @foreach($data as $row)
                                <tr>
                                    <td scope="col" >{{ $row['driver'] }}</td>
                                    <td scope="col">{{ $row['store']  }}</td>
                                    <td scope="col">{{ $row['last_month_earning']  }}<span class="badge badge-gray">MAD</span></td>
                                    <td scope="col">{{$row['date_earning'] }} <span class="badge badge-gray">MAD</span></td>
                                    <td scope="col">{{$row['total_earning'] }} <span class="badge badge-gray">MAD</span></td>
                                </tr>
                            @endforeach
                            <tr>
                                <th scope="col"></th>
                                <th scope="col" align="right">{{ __('Total') }}</th>
                                <th scope="col">{{$total_last_month_earning}} <span class="badge badge-gray">MAD</span></th>
                                <th scope="col">{{$total_date_earning}} <span class="badge badge-gray">MAD</span></th>
                                <th scope="col">{{$total_totals_earning}} <span class="badge badge-gray">MAD</span></th>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(function (){

                $('.select2').select2({
                    allowClear: true,
                    width: "resolve"
                });

            $('body').delegate('.btn-get-stats','click',function (){

                var date_from = $('#fromDate').val();
                var date_to   = $('#toDate').val();
                var store   = $('#store_id').val();
                var driver   = $('#driver_id').val();
                 console.log(date_from +"|" + date_to + "|" + store +"|"+ driver);

                if((
                    date_from == "" || date_from == null)
                    || (date_to == "" || date_to == null)){
                    return false;
                } else{

                    $('#table-container').show();

                    var data = new FormData();
                    data.append('date_from',date_from);
                    data.append('date_to',date_to);
                    data.append('store_id',store);
                    data.append('driver_id',driver);
                    $.ajax({
                        url: '/finances/stats',
                        method: 'POST',
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        data: data,
                        dataType    :   'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            console.log(response);

                            var table = $('#datatable-basic').DataTable();
                            table.clear().draw();
                             for(i in response.data) {
                                 table.row.add({
                                     0: response.data[i].driver,
                                     1: response.data[i].store == null ? "" : response.data[i].store,
                                     2: response.data[i].last_month_earning +' <span class="badge badge-gray">MAD</span>',
                                     3: response.data[i].date_earning +' <span class="badge badge-gray">MAD</span>',
                                     4: response.data[i].total_earning +' <span class="badge badge-gray">MAD</span>',
                                 }).draw();

                             }
                             var html ='<tr>' +
                                 '<th scope="col" align="right" colspan="2">{{ __('Total') }}</th>' +
                                 '<th scope="col">'+response.total_last_month_earning+' <span class="badge badge-gray">MAD</span></th>'+
                                 '<th scope="col">'+response.total_date_earning+' <span class="badge badge-gray">MAD</span></th>'+
                                 '<th scope="col">'+response.total_totals_earning+' <span class="badge badge-gray">MAD</span></th>'+
                                 '</tr>';

                            $('#datatable-basic').append(html)

                        }, error: function (jqXHR, textStatus, errorThrown) {

                            console.log("orders " + textStatus + " | " + errorThrown)
                        }
                    });
                }




            })


            $('.filter_date').change(function (){

                var form = $('#date_form');
                form.submit();

            })

        })
    </script>
    <script>

        var start = '{{$date_start}}';//moment().startOf('month').format("DD/MM/YYYY"); //moment().startOf('month').format("DD/MM/YYYY");
        var end = '{{$date_end}}'; //moment().endOf('month').format("DD/MM/YYYY"); // moment().endOf('month').format("DD/MM/YYYY");

        function cb(start, end) {
            $('.filter_date span').html(start + ' - ' + end);
        }

        $('.filter_date').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
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

    </script>
@endsection