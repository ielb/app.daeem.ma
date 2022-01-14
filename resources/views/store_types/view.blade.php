@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Categories') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('List of Stores') }}</li>
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
                        <div class="col-12">
                            <div class="row">
                                <div class="col">
                                    <h3 class="mb-0">{{ __('Stores Management') }}</h3>
                                </div>
                                <div class="col-auto">
                                    <a href="" class="btn btn-sm btn-primary">{{ __('Add new store type') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="col-12">
                    @include('partials.flash')
                </div>
                <div class="card-body">
                    {{--                @if(count($categories)==0)--}}
                    {{--                    <div class="col-lg-3" >--}}
                    {{--                        <a  data-toggle="modal" data-target="#modal-items-category" data-toggle="tooltip" data-placement="top" title="{{ __('Add new category')}}">--}}
                    {{--                            <div class="card">--}}
                    {{--                                <img class="card-img-top" src="{{ asset('images') }}/default/add_new_item.jpg" alt="...">--}}
                    {{--                                <div class="card-body">--}}
                    {{--                                    <h3 class="card-title text-primary text-uppercase">{{ __('Add first category') }}</h3>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </a>--}}
                    {{--                        <br />--}}
                    {{--                    </div>--}}
                    {{--                @endif--}}

                    @foreach ($storeTypes as $index => $storeType)
                            <div class="alert alert-default">
                                <div class="row">
                                    <div class="col">
                                        <span class="h1 font-weight-bold mb-0 text-white">{{Str::upper($storeType->name)}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="row">
                                            <script>
                                                function setSelectedstoreTypeId(id){
                                                    $('.store_type_id').val(id);
                                                }
                                            </script>
{{--                                            <button class="btn btn-icon btn-1 btn-sm btn-info tool" type="button" data-toggle="modal" data-target="#modal-multiple-categories" data-toggle="tooltip" data-placement="top" title="{{ __('Add Multiple Categories') }} in {{$storeType->name}}" onClick=(setSelectedstoreId({{ $storeType->id }})) >--}}
{{--                                                <span class="btn-inner--icon"><i class="fa fa-plus-square"></i></span>--}}
{{--                                            </button>--}}
                                            <button class="btn btn-icon btn-1 btn-sm btn-primary tool" type="button" data-toggle="modal" data-target="#modal-new-store-type" data-toggle="tooltip" data-placement="top" title="{{ __('Add a Store Type') }} in {{$storeType->name}}" onClick=(setSelectedstoreTypeId({{ $storeType->id }})) >
                                                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                                            </button>
{{--                                            @include('store_types.modal', ['storeType->id' => $storeType->id])--}}

                                            {{--                                            <a href="{{ route('plans.current')}}" class="btn btn-icon btn-1 btn-sm btn-warning" type="button"  >--}}
                                            {{--                                                <span class="btn-inner--icon"><i class="fa fa-plus"></i> {{ __('Menu size limit reaced') }}</span>--}}
                                            {{--                                            </a>--}}

{{--                                            <a class="text-white hite btn btn-icon btn-1 btn-sm btn-warning" id="edit" data-toggle="tooltip" data-placement="top" title="{{ __('Edit store') }} {{ $storeType->name }}" href="{{route('store_type.edit',$storeType)}}" >--}}
{{--                                                <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>--}}
{{--                                            </a>--}}
{{--                                            @if(count($storeType)>1)--}}
                                                <div style="margin-left: 10px; margin-right: 10px">|</div>
{{--                                            @endif--}}

                                            <button class="btn btn-icon btn-1 btn-sm btn-success" type="button" data-toggle="collapse" data-target="#collapseCategory{{$storeType->id}}" aria-expanded="true" aria-controls="collapseCategory{{$storeType->id}}" >
                                                <span class="btn-inner--icon"><i class="fas fa-angle-down"></i></span>
                                            </button>

                                            <!-- UP -->
                                            {{--                                        @if ($index!=0)--}}
                                            {{--                                            <a href="{{ route('categories.reorder',['up'=>$store->id]) }}"  class="btn btn-icon btn-1 btn-sm btn-success" >--}}
                                            {{--                                                <span class="btn-inner--icon"><i class="fas fa-arrow-up"></i></span>--}}
                                            {{--                                            </a>--}}
                                            {{--                                        @endif--}}


                                            {{--                                    <!-- DOWN -->--}}
                                            {{--                                        @if ($index+1!=count($stores))--}}
                                            {{--                                            <a href="{{ route('categories.reorder',['up'=>$stores[$index+1]->id]) }}" class="btn btn-icon btn-1 btn-sm btn-success">--}}
                                            {{--                                                <span class="btn-inner--icon"><i class="fas fa-arrow-down"></i></span>--}}
                                            {{--                                            </a>--}}
                                            {{--                                        @endif--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse show" id="collapseCategory{{$storeType->id}}">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="row row-grid">
                                            @foreach ( $storeType->stores as $store)
                                                <div class="col-lg-3">
                                                    <a href="{{ route('categories.index', $store) }}">
                                                        <div class="card">
                                                            @if($store->logo == null)
                                                                <img class="card-img-top" src="{{asset('images/default/market_avatar.jpeg') }}" alt="...">
                                                            @else
                                                                <img class="card-img-top" src="{{asset('images/stores/logos/'.$store->logo) }}" alt="...">
                                                            @endif
                                                            <div class="card-body">
                                                                <h3 class="card-title text-primary text-uppercase">{{ $store->name }}</h3>
                                                                <p class="mt-3 mb-0 text-sm">
                                                                    @if($store->status == 1)
                                                                        <span class="badge badge-success mr-2">{{ __("ACTIVE") }}</span>
                                                                    @else
                                                                        <span class="badge badge-warning mr-2">{{ __("NOT ACTIVE") }}</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                    </a>
                                                </div>
                                            @endforeach
                                            <div class="col-lg-3" >
                                                <a data-toggle="tooltip" data-placement="top" href="{{ route('store.create')}}">
                                                    <div class="card">
                                                        <img class="card-img-top" src="{{ asset('images') }}/default/add_new_item.jpg" alt="...">
                                                        <div class="card-body">
                                                            <h3 class="card-title text-primary text-uppercase">{{ __('Add Store') }}</h3>
                                                        </div>
                                                    </div>
                                                </a>
                                                <br />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection