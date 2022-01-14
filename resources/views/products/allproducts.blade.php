@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Products') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
{{--                            <li class="breadcrumb-item"><a href=""></a></li>--}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('All products') }}</li>
                        </ol>
                    </nav>
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
                        <h3 class="mb-0">{{ __('All products') }}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('products.allcreate') }}" class="btn btn-sm btn-primary">{{ __('Add product') }}</a>
                        <button id="show-hide-product-filters" class="btn btn-icon btn-1 btn-sm btn-outline-secondary" type="button">
                            <span class="btn-inner--icon"><i id="button-prd-filters" class="ni ni-bold-down"></i></span>
                        </button>
                    </div>
                </div>
                @include('products.partials.products_filter')
            </div>

            <div class="col-12">
                @include('partials.flash')
            </div>
            <div class="table-responsive py-4">
                <table class="table align-items-center table-flush" id="datatable-basic">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">{{ __('SKU') }}</th>
                        <th scope="col">{{ __('Product') }}</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col">{{ __('Weight') }}</th>
                        <th scope="col">{{ __('Subcategory') }}</th>
                        <th scope="col">{{ __('Category') }}</th>
                        <th scope="col">{{ __('store') }}</th>
                        <th scope="col">{{ __('Availability') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Creation Date') }}</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><span class="badge badge-success badge-pill">{{ $product->sku }}</span></td>
                            <td> <div class="media align-items-center">
                                <a class="avatar mr-3">
                                    @if($product->image == null)
                                    <img class="rounded" src="{{asset('images/default/product_avatar.jpeg') }}" alt="..." width="50px" height="50px">
                                @else
                                    <img class="rounded" src="{{asset('images/products/'.$product->image) }}" alt="..." width="50px" height="50px">
                                @endif
                                </a>
                                <div class="media-body">
                                    <span class="mb-0 text-sm">{{ $product->name }}</span>
                                </div>
                            </div> 
                            </td>
                            <td>{{ $product->price }}<span class="badge badge-gray"> MAD</span></td>
                            <td>{{ $product->weight }} <span class="badge badge-gray"> KG</span></td>
                            <td>{{ $product->subcategory->name }}</td>
                            <td>{{ $product->subcategory->category->name }}</td>
                            <td>{{ $product->store->name }}</td>
                            <td>
                                @if($product->available == 1)
                                    <span class="badge badge-success">{{ __('Available') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('Unavailable') }}</span>
                                @endif
                            </td>
                            <td>
                                @if($product->status == 1)
                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('Not active') }}</span>
                                @endif
                            </td>
                            <td>{{ $product->created_at->format(config('settings.datetime_display_format'))}}</td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ route('products.edit', $product) }}">{{ __('Edit') }}</a>
                                        <form action="{{ route('products.deactivate_all', $product) }}" method="post">
                                            @csrf
                                            @method('put')
                                            @if($product->status == 0)
                                                <a class="dropdown-item" href="{{ route('products.activate_all', $product) }}">{{ __('Activate') }}</a>
                                            @else
                                                <button type="submit" class="dropdown-item">
                                                    {{ __('Deactivate') }}
                                                </button>
                                            @endif
                                        </form>
                                        <form action="{{ route('products.unavailable_all', $product) }}" method="post">
                                            @csrf
                                            @method('put')
                                            @if($product->available == 0)
                                                <a class="dropdown-item" href="{{ route('products.available_all', $product) }}">{{ __('Set to available') }}</a>
                                            @else
                                                <button type="submit" class="dropdown-item">
                                                    {{ __('Set to unavailable') }}
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {

            $('#store_id').select2({
                placeholder: "{{ __('Select a store') }}",
                allowClear: true,
                width: "resolve",
            });

            $('#category_id').select2({
                placeholder: "{{ __('Select a category') }}",
                allowClear: true,
                width: "resolve",
            });

            $('#subcategory_id').select2({
                placeholder: "{{ __('Select a subcategory') }}",
                allowClear: true,
                width: "resolve",
            });



            $("#show-hide-product-filters").on("click",function(){

                if($(".products-filters").is(":visible")){
                    $("#button-prd-filters").removeClass("ni ni-bold-up")
                    $("#button-prd-filters").addClass("ni ni-bold-down")
                }else if($(".products-filters").is(":hidden")){
                    $("#button-prd-filters").removeClass("ni ni-bold-down")
                    $("#button-prd-filters").addClass("ni ni-bold-up")
                }

                $(".products-filters").slideToggle();
            });



            $.ajax({
                url: '{{ route('stores.select2') }}',
                method: 'GET',
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                data: null,
                dataType: 'JSON',
                success: function (response) {
                    //console.log(response);
                    var html = "<option></option>";
                    for (i in response) {
                        html += "<option value='" + response[i].id + "'>" + response[i].name + "</option>";
                    }
                    $('#store_id').html(html);

                    $('#store_id option[value="{{$store}}"]').attr('selected', 'selected');

                    get_categories({{$store}});

                    $("#store_id").trigger("chosen:updated");

                }, error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });

            $('#store_id').on('change', function (e) {

            var store = $(this).val();

                get_categories(store);

            });

            function get_categories(store_id){

                $.ajax({
                    url: '{{ route('categories.select2') }}',
                    method: 'POST',
                    data: { store:store_id },
                    dataType: 'JSON',
                    success: function (response) {

                        console.log(response);
                        var html = "<option></option>";
                        for (i in response) {
                            html += "<option value='" + response[i].id + "'>" + response[i].name + "</option>";
                        }
                        $('#category_id').html(html);

                        $('#category_id option[value="{{$category}}"]').attr('selected', 'selected');

                        get_subcategories({{$category}});

                        $("#category_id").trigger("chosen:updated");

                    }, error: function (jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                    }
                });
            }

            $('#category_id').on('change', function (e) {

                var category = $(this).val();

                get_subcategories(category);

            });


            function get_subcategories(category_id){

                $.ajax({
                    url: '{{ route('subcategories.select2') }}',
                    method: 'POST',
                    data: { category:category_id },
                    dataType: 'JSON',
                    success: function (response) {

                        console.log(response);
                        var html = "<option></option>";
                        for (i in response) {
                            html += "<option value='" + response[i].id + "'>" + response[i].name + "</option>";
                        }
                        $('#subcategory_id').html(html);

                        $('#subcategory_id option[value="{{$subcategory}}"]').attr('selected', 'selected');

                        $("#subcategory_id").trigger("chosen:updated");

                    }, error: function (jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                    }
                });
            }




            {{--$('#store_id').select2({--}}
            {{--    placeholder: "{{ __('Select a store') }}",--}}
            {{--    allowClear: true,--}}
            {{--    width: "resolve",--}}
            {{--    ajax: {--}}
            {{--        url: "{{ route('stores.select2') }}",--}}
            {{--        dataType: 'json',--}}
            {{--        delay: 250,--}}
            {{--        processResults: function (data) {--}}
            {{--            return {--}}
            {{--                results: $.map(data, function (item) {--}}
            {{--                    return {--}}
            {{--                        text: item.name,--}}
            {{--                        id: item.id--}}
            {{--                    }--}}
            {{--                })--}}
            {{--            };--}}
            {{--        },--}}
            {{--        cache: true--}}
            {{--    }--}}
            {{--});--}}

            {{--$('#store_id option[value="{{$store_id}}"]').attr('selected', 'selected');--}}

            {{--$("#store_id").trigger("chosen:updated");--}}

            {{--if({{$store}} != '')--}}
            {{--{--}}
            {{--    var $newOption = $("<option selected='selected'></option>").val("{{$store->id}}").text("{{$store->name}}")--}}
            {{--    $("#store_id").append($newOption).trigger('change');--}}
            {{--}--}}





            {{--$('#category_id').select2({--}}
            {{--    placeholder: "{{ __('Select a category') }}",--}}
            {{--    allowClear: true,--}}
            {{--    width: "resolve",--}}
            {{--    ajax: {--}}
            {{--        url: "{{ route('categories.select2') }}",--}}
            {{--        // data: {store: store},--}}
            {{--        dataType: 'json',--}}
            {{--        delay: 250,--}}
            {{--        data: function (params) {--}}
            {{--            return {--}}
            {{--                q: params.term, // search term--}}
            {{--                page: params.page,--}}
            {{--                store: store--}}
            {{--            };--}}
            {{--        },--}}
            {{--        processResults: function (data) {--}}
            {{--            return {--}}
            {{--                results: $.map(data, function (item) {--}}
            {{--                    return {--}}
            {{--                        text: item.name,--}}
            {{--                        id: item.id,--}}
            {{--                    }--}}
            {{--                })--}}
            {{--            };--}}
            {{--        },--}}
            {{--        cache: true--}}
            {{--    }--}}
            {{--});--}}

            // var category;
            //
            // $('#category_id').on('select2:select', function (e) {
            //     category = e.params.data.id;
            // });

            {{--$('#subcategory_id').select2({--}}
            {{--    placeholder: "{{ __('Select a subcategory') }}",--}}
            {{--    allowClear: true,--}}
            {{--    width: "resolve",--}}
            {{--    ajax: {--}}
            {{--        url: "{{ route('subcategories.select2') }}",--}}
            {{--        dataType: 'json',--}}
            {{--        delay: 250,--}}
            {{--        data: function (params) {--}}
            {{--            return {--}}
            {{--                q: params.term, // search term--}}
            {{--                page: params.page,--}}
            {{--                category: category--}}
            {{--            };--}}
            {{--        },--}}
            {{--        processResults: function (data) {--}}
            {{--            return {--}}
            {{--                results: $.map(data, function (item) {--}}
            {{--                    return {--}}
            {{--                        text: item.name,--}}
            {{--                        id: item.id--}}
            {{--                    }--}}
            {{--                })--}}
            {{--            };--}}
            {{--        },--}}
            {{--        cache: true--}}
            {{--    }--}}
            {{--});--}}


        });



    </script>
@endsection