@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Shifts') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">This week's shifts</a></li>
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
                            <h3 class="mb-0">{{ __('Shifts ') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('shifts.create')}}"
                               class="btn btn-sm btn-primary">{{ __('Add shift') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @include('partials.flash')
                </div>

                <div class="card-body">
                    <form method="get" id="form">
                        <div class="form-group row">

                            <label for="example-week-input"
                                   class="col-md-2 col-form-label form-control-label">Week</label>
                            <div class="col-md-10">
                                <input class="form-control" type="week" name="week" value="{{$week}}" id="week">
                            </div>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <h2>{{$dates['start_date'] . ' - ' . $dates['end_date']}}</h2>
                        </div>
                        <div class="col-12">
                        @foreach($zones as $k => $zone)
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="heading{{$k}}" data-toggle="collapse" data-target="#collapse{{$k}}" aria-expanded="true" aria-controls="collapse{{$k}}">
                                            <h5 class="mb-0">{{ $zone->name }}</h5>
                                        </div>
                                        <div id="collapse{{$k}}" class="collapse show" aria-labelledby="heading{{$k}}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach($zone->shifts as $shift)
                                                        <div class="col-6">
                                                            <div class="card">
                                                                <div class="p-3">
                                                                    <h3 class="mb-0 d-inline">{{$shift->day->name}}</h3>
                                                                    <div class="text-right">
                                                                        <a href="{{route('shift.edit',$shift)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}} </a>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <!-- Columns are always 50% wide, on mobile and desktop -->
                                                                    <div class="row ">
                                                                        @foreach($zone->shifts_ as $key => $sh)
                                                                            <div class="col-3">
                                                                                <h6>Shift {{$key+1}}</h6>
                                                                                @foreach($sh as $k => $item)
                                                                                    <div class="checklist-item {{ $k == 0 ? 'checklist-item-info' : 'checklist-item-warning'}} ">
                                                                                        <div class="{{ $k == 0 ? 'checklist-info' : 'checklist-warning'}}">
                                                                                            <small>{{$item}}</small>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
{{--                            <div class="card">--}}
{{--                                <!-- Card image -->--}}
{{--                                <!-- List group -->--}}
{{--                                <!-- Card body -->--}}
{{--                                <div class="card-body">--}}
{{--                                    <h2 class="card-title mb-3">Zone : {{$zone->name}}</h2>--}}
{{--                                    <div class="row">--}}
{{--                                    @foreach($zone->shifts as $shift)--}}
{{--                                        <div class="col-6">--}}
{{--                                            <div class="card">--}}
{{--                                                <div class="card-header">--}}
{{--                                                    <h3 class="mb-0 d-inline">{{$shift->day->name}}</h3>--}}
{{--                                                    <div class="text-right">--}}
{{--                                                        <a href="{{route('shift.edit',$shift)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}} </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="card-body">--}}
{{--                                                    <!-- Columns are always 50% wide, on mobile and desktop -->--}}
{{--                                                    <div class="row ">--}}
{{--                                                        @foreach($zone->shifts_ as $key => $sh)--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <h6>Shift {{$key+1}}</h6>--}}
{{--                                                                @foreach($sh as $k => $item)--}}
{{--                                                                    <div class="checklist-item {{ $k == 0 ? 'checklist-item-info' : 'checklist-item-warning'}} ">--}}
{{--                                                                        <div class="{{ $k == 0 ? 'checklist-info' : 'checklist-warning'}}">--}}
{{--                                                                            <small>{{$item}}</small>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                @endforeach--}}
{{--                                                            </div>--}}
{{--                                                        @endforeach--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {


            $('body').delegate('#week', 'change', function () {

                var form = $('#form');

                form.submit();


            })

        })
    </script>
@endsection


