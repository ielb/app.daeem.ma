@extends('layouts.app')
<style>
    .quiz_card_area {
        position: relative;
        margin-bottom: 30px;
    }

    .single_quiz_card {
        border: 1px solid #fff;
        -webkit-transition: all 0.3s linear;
        -moz-transition: all 0.3s linear;
        -o-transition: all 0.3s linear;
        -ms-transition: all 0.3s linear;
        -khtml-transition: all 0.3s linear;
        transition: all 0.3s linear;
    }

    .quiz_card_title {
        padding: 10px;
        text-align: center;
        background-color: #fff;
    }

    .quiz_card_title h5 {
        font-size: 16px;
        font-weight: 400;
        color: #292d3f;
        margin-bottom: 0;
        -webkit-transition: all 0.3s linear;
        -moz-transition: all 0.3s linear;
        -o-transition: all 0.3s linear;
        -ms-transition: all 0.3s linear;
        -khtml-transition: all 0.3s linear;
        transition: all 0.3s linear;
    }

    .quiz_card_title h5 i {
        opacity: 0;
    }

    .quiz_checkbox {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        z-index: 999;
        cursor: pointer;
    }

    .quiz_checkbox_disabled {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        z-index: 999;
        cursor: pointer;
    }

    .quiz_checkbox:checked ~ .single_quiz_card {
        border: 1px solid #525f7f;
    }

    .quiz_checkbox_disabled ~ .single_quiz_card {
        border: 1px solid #ffbebe;
    }

    .quiz_checkbox:checked:hover ~ .single_quiz_card {
        border: 1px solid #525f7f;
    }

    .quiz_checkbox_disabled:hover ~ .single_quiz_card {
        border: 1px solid #ffbebe;
    }

    .quiz_checkbox:checked ~ .single_quiz_card .quiz_card_content .quiz_card_title {
        background-color: #525f7f;
        color: #ffffff;
    }

    .quiz_checkbox_disabled ~ .single_quiz_card .quiz_card_content .quiz_card_title {
        background-color: #ffbebe;
        color: #ffffff;
    }

    .quiz_checkbox:checked ~ .single_quiz_card .quiz_card_content .quiz_card_title h5 {
        color: #ffffff;
    }

    .quiz_checkbox:checked ~ .single_quiz_card .quiz_card_content .quiz_card_title h5 i {
        opacity: 1;
    }

    .quiz_checkbox:checked:hover ~ .quiz_card_title {
        border: 1px solid #525f7f;
    }

    .quiz_checkbox_disabled ~ .single_quiz_card .quiz_card_content .quiz_card_title h5 {
        color: #ffffff;
    }

    .quiz_checkbox_disabled ~ .single_quiz_card .quiz_card_content .quiz_card_title h5 i {
        opacity: 1;
    }

    .quiz_checkbox_disabled:hover ~ .quiz_card_title {
        border: 1px solid #ffbebe;
    }

</style>
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
                {{-- <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Shifts ') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('shifts.create')}}"
                               class="btn btn-sm btn-primary">{{ __('Add shift') }}</a>
                        </div>
                    </div>
                </div> --}}
                <br>
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


                        <div class="form-group row">

                            <label for="example-week-input"
                                   class="col-md-2 col-form-label form-control-label">{{ __('Zones') }}</label>
                            <div class="col-md-10">
                                <select class="form-control" name="zones" id="zones">
                                    <option value="-1">Select Zone</option>
                                    @foreach($zones as $z)

                                        <option  @if($zone != null) {{$zone->id == $z->id ? 'selected' : ''}}  @endif value="{{$z->id}}">{{$z->name}}</option>
                                    @endforeach
                                </select>                            </div>

                        </div>

                    </form>


                    <div class="row">
                        <div class="col-12">
                            <h2>{{$dates['start_date'] . ' - ' . $dates['end_date']}}</h2>
                        </div>
                        <div class="col-12">
{{--                            @foreach($zones as $zone)--}}
                                <form method="post" action="{{route('shifts_save')}}">
                                    <input class="form-control" type="hidden" name="week_submit" value="{{$week}}" id="week_submit">

                                    @csrf
                                    @if($zone != null)
                                        <div class="card">
                                        <!-- Card image -->
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h3 class="mb-0 ">Zone : {{$zone->name}}</h3>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <button type="submit" name="zone" class="btn btn-success "
                                                            value="{{$zone->id}}">{{ __('Save') }}</button>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- List group -->

                                        <!-- Card body -->
                                        <div class="card-body">
                                            {{--                                            <h2 class="card-title mb-3">Zone : {{$zone->name}}</h2>--}}
                                            <div class="row">
                                                @foreach($zone->shifts as $shift)
                                                    <div class="col-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <input type="hidden" name="day_ids[]" value="{{$shift->day->id}}">
                                                                <h3 class="mb-0 d-inline">{{$shift->day->name}}</h3>
                                                                {{-- <div class="text-right">
                                                                    <a href="{{route('shift.edit',$shift)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}} </a>
                                                                </div> --}}
                                                            </div>
                                                            <div class="card-body">
                                                                <!-- Columns are always 50% wide, on mobile and desktop -->

                                                                <div class="row ">
                                                                    @foreach($shift->options as $key => $option)
                                                                        <div class="col-sm-3 ">
                                                                            <div class="quiz_card_area">
                                                                                <input {{$option->avaialability == false ? 'disabled checked' : ''}}  class="{{$option->avaialability == false ? 'quiz_checkbox_disabled' : 'quiz_checkbox'}}"
                                                                                       type="radio"
                                                                                       name="{{$option->avaialability == false ? 'op' : 'option'.$shift->day_id.'[]'}}"
                                                                                       value="{{$shift->id}}|{{$option->id}}"/>
                                                                                <div class="single_quiz_card border">
                                                                                    <div class="quiz_card_content">
                                                                                        <div class="quiz_card_title">
                                                                                            <h5 class="text-right"><i
                                                                                                        class="fa fa-check"
                                                                                                        aria-hidden="true"></i>
                                                                                            </h5>

                                                                                            @foreach($option->shift as $k => $item)
                                                                                                <div class="checklist-item {{ $k == 0 ? 'checklist-item-info' : 'checklist-item-warning'}}">
                                                                                                    <div class="{{ $k == 0 ? 'checklist-info' : 'checklist-warning'}}">
                                                                                                        <small>{{$item}}</small>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach

                                                                                        </div>
                                                                                        <!-- end of quiz_card_title -->
                                                                                    </div>
                                                                                    <!-- end of quiz_card_content -->
                                                                                </div><!-- end of single_quiz_card -->
                                                                            </div><!-- end of quiz_card_area -->
                                                                        </div><!-- end of col3  -->
                                                                    @endforeach

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                    @endif
                                </form>
{{--                            @endforeach--}}
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

                $('#week_submit').val($('#week').val());

            })

            $('body').delegate('#zones', 'change', function () {


                $('#week_submit').val($('#week').val());

                if($('#zones').val() != '-1'){
                    var form = $('#form');

                    form.submit();
                }



            })

        })
    </script>
@endsection

