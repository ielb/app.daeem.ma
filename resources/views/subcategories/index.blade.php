@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Subcategories') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                             <li class="breadcrumb-item"><a href="{{ route('categories.index', $category->store) }}">{{ __('Categories') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('List of Subcategories') }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <button class="btn btn-sm btn-neutral" type="button" id="edit" data-toggle="modal" data-target="#modal-edit-category" data-toggle="tooltip" data-placement="top" title="{{ __('Edit category') }} {{ $category->name }}" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-image="{{ $category->image }}" data-status="{{ $category->status }}">
                        <span class="btn-inner--icon">{{__('Edit category')}}</span>
                    </button>
                    @include('categories.modal')
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
                                    <!-- Surtitle -->
                                    <h6 class="surtitle">{{ $category->store->name }}</h6>
                                    <!-- Title -->
                                <h3 class="mb-0">{{ $category->name }}
                                    @if($category->status == 0)
                                        <span class="badge badge-warning mr-2">{{ __("NOT ACTIVE") }}</span>
                                    @endif
                                </h3>

                            </div>
                            <div class="col-auto">
                                <script>
                                    function setSelectedCategoryId(id){
                                        $('.category_id').val(id);
                                    }
                                </script>
                                <button class="btn btn-icon btn-1 btn-sm btn-info" type="button" data-toggle="modal" data-target="#modal-multiple-subcategories" data-toggle="tooltip" data-placement="top" title="{{ __('Add subcategory') }} in {{$category->name}}" onClick=(setSelectedCategoryId({{ $category->id }}))>
                                    <span class="btn-inner--icon">{{ __('Add Multiple subcategory') }}</span>
                                </button>
                                <button class="btn btn-icon btn-1 btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-subcategories-category" data-toggle="tooltip" data-placement="top" title="{{ __('Add subcategory') }} in {{$category->name}}" onClick=(setSelectedCategoryId({{ $category->id }}))>
                                    <span class="btn-inner--icon">{{ __('Add new subcategory') }}</span>
                                </button>
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

                {{--                @if(count($category->subcategories)==0)--}}
{{--                    <div class="col-lg-3" >--}}
{{--                        <a  data-toggle="modal" data-target="#modal-subcategories-category" data-toggle="tooltip" data-placement="top" title="{{ __('Add new subcategory') }} in {{$category->name}}" onClick=(setSelectedCategoryId({{ $category->id }}))>--}}
{{--                            <div class="card">--}}
{{--                                <img class="card-img-top" src="{{ asset('images') }}/default/add_new_item.jpg" alt="...">--}}
{{--                                <div class="card-body">--}}
{{--                                    <h3 class="card-title text-primary text-uppercase">{{ __('Add first subcategory') }}</h3>--}}
{{--                                </div>--}}
{{--                                <script>--}}
{{--                                    function setSelectedCategoryId(id){--}}
{{--                                        $('#category_id').val(id);--}}
{{--                                    }--}}
{{--                                </script>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <br />--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                @foreach ($category->subcategories as $subcategory)--}}
{{--                    @if($subcategory->status == 1)--}}
{{--                        <div class="alert alert-default">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col">--}}
{{--                                    <span class="h1 font-weight-bold mb-0 text-white">{{ $subcategory->name }}</span>--}}
{{--                                </div>--}}
{{--                                <div class="col-auto">--}}
{{--                                    <div class="row">--}}
{{--                                        <script>--}}
{{--                                            function setSelectedSubcategoryId(id){--}}
{{--                                                $('#subcategory_id').val(id);--}}
{{--                                            }--}}
{{--                                        </script>--}}
{{--                                        <button class="btn btn-icon btn-1 btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-new-category" data-toggle="tooltip" data-placement="top" title="{{ __('Add Product') }} in {{$subcategory->name}}" onClick=(setSelectedSubcategoryId({{ $subcategory->id }})) >--}}
{{--                                            <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>--}}
{{--                                        </button>--}}
{{--                                        @include('subcategories.modal', ['subcategory->id' => $subcategory->id])---}}

{{--                                                                                    <a href="{{ route('plans.current')}}" class="btn btn-icon btn-1 btn-sm btn-warning" type="button"  >--}}
{{--                                                                                        <span class="btn-inner--icon"><i class="fa fa-plus"></i> {{ __('Menu size limit reaced') }}</span>--}}
{{--                                                                                    </a>--}}

{{--                                        <a class="text-white hite btn btn-icon btn-1 btn-sm btn-warning" id="edit" data-toggle="tooltip" data-placement="top" title="{{ __('Edit store') }} {{ $store->name }}" href="{{route('store.show',$store)}}" >--}}
{{--                                            <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>--}}
{{--                                        </a>--}}
{{--                                        @if(count($subcategories)>1)--}}
{{--                                            <div style="margin-left: 10px; margin-right: 10px">|</div>--}}
{{--                                        @endif--}}

{{--                                        <button class="btn btn-icon btn-1 btn-sm btn-success" type="button" data-toggle="collapse" data-target="#collapseSubcategory{{$subcategory->id}}" aria-expanded="true" aria-controls="collapseCategory{{$subcategory->id}}" >--}}
{{--                                            <span class="btn-inner--icon"><i class="fas fa-angle-down"></i></span>--}}
{{--                                        </button>--}}

{{--                                        <!-- UP -->--}}
{{--                                                                                @if ($index!=0)--}}
{{--                                                                                    <a href="{{ route('categories.reorder',['up'=>$store->id]) }}"  class="btn btn-icon btn-1 btn-sm btn-success" >--}}
{{--                                                                                        <span class="btn-inner--icon"><i class="fas fa-arrow-up"></i></span>--}}
{{--                                                                                    </a>--}}
{{--                                                                                @endif--}}


{{--                                                                            <!-- DOWN -->--}}
{{--                                                                                @if ($index+1!=count($stores))--}}
{{--                                                                                    <a href="{{ route('categories.reorder',['up'=>$stores[$index+1]->id]) }}" class="btn btn-icon btn-1 btn-sm btn-success">--}}
{{--                                                                                        <span class="btn-inner--icon"><i class="fas fa-arrow-down"></i></span>--}}
{{--                                                                                    </a>--}}
{{--                                                                                @endif--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @if($category->status == 1)--}}
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="row row-grid">
                                    @foreach ( $category->subcategories as $subcategory)
                                        <div class="col-lg-3">
                                            <a href="{{ route('products.index', $subcategory) }}">
                                                <div class="card">
                                                    @if($subcategory->image == null)
                                                        <img class="card-img-top" src="{{asset('images/default/category_avatar.jpeg') }}" alt="...">
                                                    @else
                                                        <img class="card-img-top" src="{{asset('images/subcategories/'.$subcategory->image) }}" alt="...">
                                                    @endif
                                                    <div class="card-body">
                                                        <h3 class="card-title text-primary text-uppercase"> {{ $subcategory->name }}</h3>
                                                        <p class="mt-3 mb-0 text-sm">
                                                            @if($subcategory->status == 1)
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
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-subcategories-category" data-toggle="tooltip" data-placement="top" title="{{ __('Add new subcategory') }} in {{$category->name}}" onClick=(setSelectedCategoryId({{ $category->id }}))>
                                            <div class="card">
                                                <img class="card-img-top" src="{{ asset('images') }}/default/add_new_item.jpg" alt="...">
                                                <div class="card-body">
                                                    <h3 class="card-title text-primary text-uppercase">{{ __('Add Subcategory') }}</h3>
                                                </div>
                                            </div>
                                            <script>
                                                function setSelectedCategoryId(id){
                                                    $('.category_id').val(id);
                                                }
                                            </script>
                                        </a>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                    @endif--}}
{{--                @endforeach--}}
            </div>
        </div>
    </div>
</div>
@include('subcategories.modal', ['category->id' => $category->id])

@endsection
@section('scripts')
    <script>
        $("[data-target='#modal-edit-category']").click(function() {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var image = $(this).attr('data-image');
            var status = $(this).attr('data-status');


            $('#cat_id').val(id);
            $('#cat_name').val(name);


            if(image == ""){
                $('#cat_image').attr("src", "{{ asset('images') }}/default/category_avatar.jpeg");
            }
            else {
                $('#cat_image').attr('src', '{{ asset('images') }}/categories/'+image+'');
            }
            if(status == 1)
            {
                $('input:checkbox[name=cat_status]').attr('checked',true);
            }
            else {
                $('input:checkbox[name=cat_status]').attr('checked',false);
            }
            $("#form-edit-category").attr("action", "{{ route('categories.update', $category) }}");
        })


        $(function (){
            $('body').delegate('.btn-add-row' ,'click' , function (){


                var row = '<tr class="p-1">' +
                    '<td class="p-1">' +
                    '<div class="form-group">' +
                    '<input class="form-control" name="subcategory_name[]"  placeholder="{{ __('Subcategory name') }} ..." type="text" required>'+
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
                    '<input type="file" required name="subcategory_image[]" accept="image/x-png,image/gif,image/jpeg">' +
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

                $('#rows-container-sub').append(row);

            })

            $('body').delegate('.btn-remove-row','click',function (){
                $(this).parent('td').parent('tr').remove();
            })
        })

    </script>
@endsection
