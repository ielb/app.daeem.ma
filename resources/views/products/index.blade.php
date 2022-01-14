@extends('layouts.app')

@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Products') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a
                                        href="{{ route('subcategories.index', $subcategory->category) }}">{{__('Subcategories')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('List of Products') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button class="btn btn-sm btn-neutral" type="button" id="edit" data-toggle="modal"
                            data-target="#modal-edit-subcategory" data-toggle="tooltip" data-placement="top"
                            title="{{ __('Edit subcategory') }} {{ $subcategory->name }}"
                            data-id="{{ $subcategory->id }}" data-name="{{ $subcategory->name }}"
                            data-image="{{ $subcategory->image }}" data-status="{{ $subcategory->status }}">
                        <span class="btn-inner--icon">{{__('Edit subcategory')}}</span>
                    </button>
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
                            <!-- Surtitle -->
                            <h6 class="surtitle">{{ $subcategory->category->store->name }}</h6>
                            <!-- Title -->
                            <h3 class="mb-0">{{ $subcategory->name }}'s {{__('products')}}
                                @if($subcategory->status == 0)
                                    <span class="badge badge-warning mr-2">{{ __("NOT ACTIVE") }}</span>
                                @endif
                            </h3>
                        </div>
                        <div class="col-4 text-right">
                            <script>
                                function setSelectedSubcategoryId(id) {
                                    $('.subcategory_id').val(id);
                                }
                            </script>
                            {{--                            <a   data-toggle="modal" data-target="#modal-upload-excel"--}}
                            {{--                                 data-placement="top" title="{{__('Upload Excel File')}}"--}}
                            {{--                                 href="javascript:void(0);" class="btn btn-sm btn-success tool">--}}
                            {{--                                <i class="fa fa-file-excel"></i>  {{ __('Upload Excel') }}--}}
                            {{--                            </a>--}}
                            <a data-toggle="modal" data-target="#modal-multiple-product"
                               data-placement="top" title="{{__('Add multiple Products')}}"
                               href="javascript:void(0);" onclick="setSelectedSubcategoryId({{$subcategory->id}})"
                               class="btn btn-sm btn-success tool">
                                <i class="fa fa-plus"></i> {{ __('Add multiple Products') }}
                            </a>
                            <a href="{{ route('products.create', $subcategory) }}"
                               class="btn btn-sm btn-primary">{{ __('Add a product') }}</a>
                        </div>
                    </div>
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
                            <th scope="col">{{ __('Availability') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Creation Date') }}</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($subcategory->products as $product)
                            <tr>
                                <td><span class="badge badge-success badge-pill">{{ $product->sku }}</span></td>
                                <td> 
                                    <div class="media align-items-center">
                                    <a class="avatar mr-3">
                                        @if($product->image == null)
                                        <img class="rounded" src="{{asset('images/default/product_avatar.jpeg') }}"
                                                 alt="..." width="50px" height="50px">
                                    @else
                                        <img class="rounded" src="{{asset('images/products/'.$product->image) }}"
                                           alt="..." width="50px" height="50px">
                                    
                                    </a>
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">{{ $product->name }}</span>
                                    </div>
                                </div> 
                            </td>                             
                                   
                                @endif
                                <td>{{ $product->price }}<span class="badge badge-gray"> MAD</span></td>
                                <td>{{ $product->weight }}<span class="badge badge-gray"> KG</span></td>
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
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item"
                                               href="{{ route('products.edit', $product) }}">{{ __('Edit') }}</a>
                                            <form action="{{ route('products.deactivate', $product) }}" method="post">
                                                @csrf
                                                @method('put')
                                                @if($product->status == 0)
                                                    <a class="dropdown-item"
                                                       href="{{ route('products.activate', $product) }}">{{ __('Activate') }}</a>
                                                @else
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Deactivate') }}
                                                    </button>
                                                @endif
                                            </form>
                                            <form action="{{ route('products.unavailable', $product) }}" method="post">
                                                @csrf
                                                @method('put')
                                                @if($product->available == 0)
                                                    <a class="dropdown-item"
                                                       href="{{ route('products.available', $product) }}">{{ __('Set to available') }}</a>
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
    @include('products.modal')
    @include('products.partials.select')
@endsection
@section('scripts')
    <script>
        $("[data-target='#modal-edit-subcategory']").click(function () {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var image = $(this).attr('data-image');
            var status = $(this).attr('data-status');
            // var category = $(this).attr('data-category');

            $('#subcategory_id_edit').val(id);
            $('#subcategory_name_edit').val(name);
            if (image == "") {
                $('#subcategory_image_edit').attr("src", "{{ asset('images') }}/default/category_avatar.jpeg");
            } else {
                $('#subcategory_image_edit').attr('src', '{{ asset('images') }}/subcategories/' + image + '');
            }
            if (status == 1) {
                $('input:checkbox[name=subcategory_status_edit]').attr('checked', true);
            } else {
                $('input:checkbox[name=subcategory_status_edit]').attr('checked', false);
            }
            // $('#subcategory_category_edit').val(category);
            $("#form-edit-subcategory").attr("action", "{{ route('subcategories.update', $subcategory ) }}");
        })

        $(function () {

            {{--$('#laravel-ajax-file-upload').submit(function(e) {--}}
            {{--    e.preventDefault();--}}
            {{--    var formData = new FormData(this);--}}
            {{--    $.ajax({--}}
            {{--        type:'POST',--}}
            {{--        url: "{{ route('products.upload')}}",--}}
            {{--        data: formData,--}}
            {{--        cache:false,--}}
            {{--        contentType: false,--}}
            {{--        processData: false,--}}
            {{--        dataType : 'JSON',--}}
            {{--        success: (data) => {--}}

            {{--           var columns  = ['store','category','name','sku','description','price','weight'];--}}
            {{--           var html = "";--}}
            {{--            for(var i= 0 ; i< data.length ;i++){--}}

            {{--                html += '<tr align="center">';--}}
            {{--                var col = data[i];--}}
            {{--                var check = false;--}}
            {{--                for(var j = 0 ; j< col.length;j++){--}}
            {{--                    var c = col[j];--}}
            {{--                    if($.inArray(c, columns) === -1){--}}
            {{--                        check = true;--}}
            {{--                        html +='<td>'+c+'</td>';--}}
            {{--                    }--}}
            {{--                }--}}
            {{--                if(check){--}}
            {{--                    html +=   '<td><input id="file" name="images[]" type="file"></td>';--}}
            {{--                }--}}
            {{--                html += '</tr>';--}}
            {{--            }--}}

            {{--            $("#excel-data").html(html);--}}

            {{--        },--}}
            {{--        error: function(data){--}}
            {{--            console.log(data);--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}


        })
    </script>

    <script>

        $(function () {


            $('.btn-add-row').click(function () {

                var select = $('#product_subcategory_select').html();
                var row = ' <tr class="p-1">' +
                    '<td class="p-1">' +
                    '<div class="form-group">' +
                    '<input class="form-control" name="products_sku[]"  placeholder="{{ __('Product Sku') }} ..." type="text" required>' +
                    '</div>' +
                    '</td>' +
                    '<td class="p-1">' +
                    '<div class="form-group">' +
                    '<input class="form-control" name="products_name[]"  placeholder="{{ __('Name') }} ..." type="text" required>' +
                    '</div>' +
                    '</td>' +
                    '<td class="p-1">' +
                    '<div class="form-group"><select class="form-control select2 product_subcategory form-control-alternative" id="product_subcategory" name="product_subcategory[]" required>' +
                    '</select></div>' +
                    ' </td>' +
                    '<td class="p-1">' +
                    '<div class="form-group">' +
                    '<input class="form-control" name="product_description[]"  placeholder="{{ __('Description') }} ..." type="text" required>' +
                    '</div>' +
                    '</td>' +
                    '<td class="p-1">'+
                        '<div class="form-group">'+
                            '<input class="form-control" name="product_weight[]"  placeholder="{{ __('Weight') }} ..." type="text" required>'+
                        '</div>'+
                    '</td>'+
                    '<td class="p-1">' +
                    '<div class="form-group">' +
                    '<input class="form-control" name="products_price[]"  placeholder="{{ __('Price') }} ..." type="text" required>' +
                    '</div>' +
                    '</td>' +
                    '<td class="p-1">' +
                    '<div class="form-group text-center">' +
                    '<div class="text-center ">' +
                    '<div class="fileinput fileinput-new" data-provides="fileinput">' +
                    '<div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 40px; height: 40px;">' +
                    '<img src="https://www.fastcat.com.ph/wp-content/uploads/2016/04/dummy-post-square-1-768x768.jpg" width="60px" height="60px" alt="..."/>' +
                    '</div>' +
                    ' <div>' +
                    '<span class="btn btn-outline-secondary btn-file">' +
                    '<span class="fileinput-new">{{ __('Select image') }}</span><span class="fileinput-exists">{{ __('Change') }}</span>' +
                    '<input type="file" required name="product_image[]" accept="*">' +
                    '</span>' +
                    '<a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    ' </div>' +
                    '</td>' +
                    '<td>' +
                    ' <button class="btn btn-sm btn-danger btn-remove-row tool" type="button" title="{{__('Remove')}}"> <i class="fa fa-trash"></i> </button>' +
                    '</td>' +
                    '</tr>';
                $('#rows-container').append(row);

                $('.product_subcategory').html(select);

            })

            $('body').delegate('.btn-remove-row', 'click', function () {
                $(this).parent('td').parent('tr').remove();
            })

        });
    </script>
@endsection