@extends('layouts.app', ['title' => __('Orders')])
@section('header')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Live Orders') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('List Live Orders') }}</li>
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

        <div id="liveorders" class="row" bis_skin_checked="1">
                    <div class="col-xl-4" bis_skin_checked="1">
                        <div class="card" bis_skin_checked="1">
                            <div class="card-header" bis_skin_checked="1"><h5 class="h3 mb-0">New Orders</h5></div>
                            <div class="card-body" bis_skin_checked="1">
                                <ul class="list-group list-group-flush list my--3" id="list_just_created">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4" bis_skin_checked="1">
                        <div class="card" bis_skin_checked="1">
                            <div class="card-header" bis_skin_checked="1"><h5 class="h3 mb-0">Prepared</h5></div>
                            <div class="card-body" bis_skin_checked="1">
                                <ul class="list-group list-group-flush list my--3" id="list_prepared">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4" bis_skin_checked="1">
                        <div class="card" bis_skin_checked="1">
                            <div class="card-header" bis_skin_checked="1"><h5 class="h3 mb-0">Done</h5></div>
                            <div class="card-body" bis_skin_checked="1">
                                <ul class="list-group list-group-flush list my--3" id="list_done">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

        <audio id="myAudio">
            <source src="https://soundbible.com/mp3/Blop-Mark_DiAngelo-79054334.mp3" type="audio/mpeg">
        </audio>

@endsection

@section('scripts')

    <script>

        $(function (){

            var neworders_count = 0;

            function getLiveOrders(){


                $.ajax({
                    url: '/order/liveapi',
                    method: 'GET',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    data: null,
                    dataType    :   'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {

                        var neworders = response.neworders;
                        var preparedorders = response.prepared;
                        var doneorders = response.done;
                        var neworders_html = "";
                        var preparedorders_html = "";
                        var doneorders_html = "";

                        for(i in neworders){

                            neworders_html += ' <li class="list-group-item px-0" id="card-'+neworders[i].id+'">' +

                                '<div class="row " >' +
                                '<div class="col"> <table class="table table-borderless">' +
                                '<tr><td class="p-1"><span>Status  </span></td><td class="p-1 "><small class="badge badge-'+neworders[i].status.color+'"> '+neworders[i].status.name+'</small></td></tr>' +
                                '<tr><td class="p-1"><span> Time  </span></td><td class="p-1 ">'+neworders[i].order_date+'</td></tr>' +
                                '<tr><td class="p-1"><span> store  </span></td><td class="p-1 "><h4 class="mb-0"><a href="/store/'+neworders[i].store_id+'/show">'+neworders[i].store.name+'</a></h4></td></tr>' +
                                '<tr><td class="p-1"><span>Client  </span></td><td class="p-1 "><h4><a href="/client/show/'+neworders[i].client_id+'">'+neworders[i].client_name+'</a></h4</td></tr>' +
                                '<tr><td class="p-1"><span>Price  </span></td><td class="p-1 ">MAD <b>'+neworders[i].order_price+'</b></td></tr></table></div>' +
                                '</div><hr class="m-2">' +
                                '<div class="row"> ' +
                                '<div class="col-3" ><div class="'+neworders[i].pulse+'"></div></div>' +
                                '<div class="col-3" ><a href="/orders/'+neworders[i].id+'" class="btn btn-sm btn-primary">Details</a></div>' +
                                '<div class="col-3 " ><button data-value="'+neworders[i].id+'" class="btn btn-sm btn-success btn-accept">Accept</button></div>' +
                                '<div class="col-3 " ><button data-value="'+neworders[i].id+'" class="btn btn-sm btn-danger btn-reject">Reject</button></div>' +
                                '</div>' +
                                '</li>';
                        }
                        for(i in preparedorders){

                            preparedorders_html += ' <li class="list-group-item px-0">' +
                                '<div class="row align-items-center" >' +
                                '<div class="col"> <table class="table table-borderless">' +
                                '<tr><td class="p-1"><span>Status  </span></td><td class="p-1 "><small class="badge badge-'+preparedorders[i].status.color+'"> '+preparedorders[i].status.name+'</small></td></tr>' +
                                '<tr><td class="p-1"><span> Time  </span></td><td class="p-1 ">'+preparedorders[i].order_date+'</td></tr>' +
                                '<tr><td class="p-1"><span> store  </span></td><td class="p-1 "><h4 class="mb-0"><a href="/store/'+preparedorders[i].store_id+'/show">'+preparedorders[i].store.name+'</a></h4></td></tr>' +
                                '<tr><td class="p-1"><span>Client  </span></td><td class="p-1 "><h4><a href="/client/show/'+preparedorders[i].client_id+'">'+preparedorders[i].client_name+'</a></h4</td></tr>' +
                                '<tr><td class="p-1"><span>Price  </span></td><td class="p-1 ">MAD <b>'+preparedorders[i].order_price+'</b></td></tr></table></div>' +
                                '</div><hr class="m-2"><div class="row"> ' +
                                '<div class="col-4" ><div class="'+preparedorders[i].pulse+'"></div></div>' +
                                '<div class="col-8 text-right" ><a href="/orders/'+preparedorders[i].id+'" class="btn btn-sm btn-primary">Details</a></div>' +
                                '</div></li>';
                        }
                        for(i in doneorders){

                            doneorders_html += ' <li class="list-group-item px-0">' +
                                '<div class="row align-items-center" >' +
                                '<div class="col"> <table class="table table-borderless">' +
                                '<tr><td class="p-1"><span>Status  </span></td><td class="p-1 "><small class="badge badge-'+doneorders[i].status.color+'"> '+doneorders[i].status.name+'</small></td></tr>' +
                                '<tr><td class="p-1"><span> Time  </span></td><td class="p-1 ">'+doneorders[i].order_date+'</td></tr>' +
                                '<tr><td class="p-1"><span> store  </span></td><td class="p-1 "><h4 class="mb-0"><a href="/store/'+doneorders[i].store_id+'/show">'+doneorders[i].store.name+'</a></h4></td></tr>' +
                                '<tr><td class="p-1"><span>Client  </span></td><td class="p-1 "><h4><a href="/client/show/'+doneorders[i].client_id+'">'+doneorders[i].client_name+'</a></h4</td></tr>' +
                                '<tr><td class="p-1"><span>Price  </span></td><td class="p-1 ">MAD <b>'+doneorders[i].order_price+'</b></td></tr></table></div>' +
                                '</div><hr class="m-2"><div class="row"> ' +
                                '<div class="col-4" ><div class="'+doneorders[i].pulse+'"></div></div>' +
                                '<div class="col-8 text-right" ><a href="/orders/'+doneorders[i].id+'" class="btn btn-sm btn-primary">Details</a></div>' +
                                '</div></li>';
                        }

                        $('#list_just_created').html(neworders_html);
                        $('#list_prepared').html(preparedorders_html);
                        $('#list_done').html(doneorders_html);


                        if(neworders_count == 0){
                            neworders_count = neworders.length;
                        }else if(neworders_count != neworders.length ){
                            neworders_count = neworders.length;
                            var x = document.getElementById("myAudio");
                             x.play();

                        }


                    }, error: function (jqXHR, textStatus, errorThrown) {

                        console.log("orders " + textStatus + " | " + errorThrown)
                    }
                });
            }

            getLiveOrders();

            setInterval(getLiveOrders, 10000);

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            // accept

            $('body').delegate('.btn-accept','click',function (){

                var order_id = $(this).attr('data-value');

                swalWithBootstrapButtons.fire({
                    title: 'Do you want to Accept this order ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Accept',
                    cancelButtonText: 'No, cancel',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        $.ajax({
                            url: '/order/accept/'+order_id,
                            type: 'GET',
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            data: null,
                            dataType    :   'JSON',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {

                                //console.log(response);

                                if(response.status == 'success'){
                                    swalWithBootstrapButtons.fire('Accepted!', '', 'success')
                                    neworders_count =  response.count;
                                    setTimeout(function (){
                                        $('#card-'+order_id).fadeOut();
                                    },500)

                                }


                            }, error: function (jqXHR, textStatus, errorThrown) {

                                console.log("accept " + textStatus + " | " + errorThrown)
                            }
                        });

                    } else if (result.isDenied) {
                        swalWithBootstrapButtons.fire('Changes are not saved', '', 'info')
                       // location.reload()
                    }
                })

            })

            $('body').delegate('.btn-reject','click',function (){

                var order_id = $(this).attr('data-value');
                swalWithBootstrapButtons.fire({
                    title: 'Do you want to Reject this order ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Reject',
                    cancelButtonText: 'No, cancel',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        $.ajax({
                            url: '/order/reject/'+order_id,
                            type: 'GET',
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            data: null,
                            dataType    :   'JSON',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {

                                // console.log(response);

                                if(response.status == 'success'){
                                    swalWithBootstrapButtons.fire('Rejected!', '', 'success')
                                    neworders_count =  response.count;
                                    setTimeout(function (){
                                        $('#card-'+order_id).fadeOut();
                                    },500)

                                }


                            }, error: function (jqXHR, textStatus, errorThrown) {

                                console.log("reject " + textStatus + " | " + errorThrown)
                            }
                        });

                    } else if (result.isDenied) {
                        swalWithBootstrapButtons.fire('Changes are not saved', '', 'info')
                        // location.reload()
                    }
                })



            })

        })

    </script>

@endsection