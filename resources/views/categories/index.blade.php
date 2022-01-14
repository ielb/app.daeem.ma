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
                             <li class="breadcrumb-item"><a href="{{ route('store_types.view') }}">List of Stores</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('List of Categories') }}</li>
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
                                <h3 class="mb-0">{{ __('Stores Category Management') }}</h3>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('store.create') }}" class="btn btn-sm btn-primary">{{ __('Add new store') }}</a>
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

                    @if($store->status == 1)
                        <div class="alert alert-default">
                            <div class="row">
                                <div class="col">
                                    <span class="h1 font-weight-bold mb-0 text-white">{{Str::upper($store->name)}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="row">
                                        <script>
                                            function setSelectedstoreId(id){
                                                $('.store_id').val(id);
                                            }
                                        </script>
                                            <button class="btn btn-icon btn-1 btn-sm btn-info tool" type="button" data-toggle="modal" data-target="#modal-multiple-categories" data-toggle="tooltip" data-placement="top" title="{{ __('Add Multiple Categories') }} in {{$store->name}}" onClick=(setSelectedstoreId({{ $store->id }})) >
                                                <span class="btn-inner--icon"><i class="fa fa-plus-square"></i></span>
                                            </button>
                                            <button class="btn btn-icon btn-1 btn-sm btn-primary tool" type="button" data-toggle="modal" data-target="#modal-new-category" data-toggle="tooltip" data-placement="top" title="{{ __('Add Category') }} in {{$store->name}}" onClick=(setSelectedstoreId({{ $store->id }})) >
                                                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                                            </button>
                                            @include('categories.modal', ['store->id' => $store->id])

{{--                                            <a href="{{ route('plans.current')}}" class="btn btn-icon btn-1 btn-sm btn-warning" type="button"  >--}}
{{--                                                <span class="btn-inner--icon"><i class="fa fa-plus"></i> {{ __('Menu size limit reaced') }}</span>--}}
{{--                                            </a>--}}

                                        <a class="text-white hite btn btn-icon btn-1 btn-sm btn-warning" id="edit" data-toggle="tooltip" data-placement="top" title="{{ __('Edit store') }} {{ $store->name }}" href="{{route('store.show',$store)}}" >
                                            <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
                                        </a>
                                            <div style="margin-left: 10px; margin-right: 10px">|</div>

                                        <button class="btn btn-icon btn-1 btn-sm btn-success" type="button" data-toggle="collapse" data-target="#collapseCategory{{$store->id}}" aria-expanded="true" aria-controls="collapseCategory{{$store->id}}" >
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
                    @endif
                    @if($store->status == 1)
                        <div class="collapse show" id="collapseCategory{{$store->id}}">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="row row-grid">
                                        @foreach ( $store->categories as $category)
                                            <div class="col-lg-3">
                                                <a href="{{ route('subcategories.index', $category) }}">
                                                    <div class="card">
                                                        @if($category->image == null)
                                                            <img class="card-img-top" src="{{asset('images/default/category_avatar.jpeg') }}" alt="...">
                                                        @else
                                                            <img class="card-img-top" src="{{asset('images/categories/'.$category->image) }}" alt="...">
                                                        @endif
                                                        <div class="card-body">
                                                            <h3 class="card-title text-primary text-uppercase">{{ $category->name }}</h3>
                                                            <p class="mt-3 mb-0 text-sm">
                                                                @if($category->status == 1)
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
                                            <a   data-toggle="modal" data-target="#modal-new-category" data-toggle="tooltip" data-placement="top" href="javascript:void(0);" onclick=(setSelectedstoreId({{ $store->id }}))>
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('images') }}/default/add_new_item.jpg" alt="...">
                                                    <div class="card-body">
                                                        <h3 class="card-title text-primary text-uppercase">{{ __('Add Category') }}</h3>
                                                    </div>
                                                </div>
                                            </a>
                                            <br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>

        $(function (){


            $('.btn-add-row').click(function (){


                var row = '<tr class="p-1">' +
                    '<td class="p-1">' +
                    '<div class="form-group">' +
                    '<input class="form-control" name="category_name[]"  placeholder="{{ __('Category name') }} ..." type="text" required>'+
                    '</div></td>' +
                    '<td class="p-1">' +
                    ' <div class="form-group text-center">' +
                    '<div class="text-center ">' +
                    '<div class="fileinput fileinput-new" data-provides="fileinput">' +
                    '<div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 40px; height: 40px;">' +
                    '<img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg"' +
                    'width="60px" height="60px" alt="..."/>' +
                    '</div>' +
                    ' <div>' +
                    '<span class="btn btn-outline-secondary btn-file">' +
                    '<span class="fileinput-new">{{ __('Select image') }}</span>'+
                    '<span class="fileinput-exists">{{ __('Change') }}</span>'+
                    '<input type="file" required name="category_image[]" accept="image/x-png,image/gif,image/jpeg">' +
                    '</span>' +
                    '<a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>'+
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    ' <td>' +
                    '<button class="btn btn-sm btn-danger btn-remove-row tool" type="button" title="{{__('Remove')}}"> <i class="fa fa-trash"></i> </button>' +
                '</td>' +
                '</tr>';

                    $('#rows-container').append(row);

            })

            $('body').delegate('.btn-remove-row','click',function (){
                $(this).parent('td').parent('tr').remove();
            })

        });
    </script>
@endsection