@extends('layouts.app')

@section('header')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ __('Stores') }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Details store') }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    {{-- <a href="#" class="btn btn-sm btn-neutral">New</a> --}}
                    {{-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
                </div>
            </div>
            <div class="col-12">
                @include('partials.flash')
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="header pb-6 pt-5 pt-md-8"
         style="background-image: url('{{asset('images/stores/covers/'.$store->cover)}}');background-size: cover;border-radius: 5px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Total Orders')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$total_orders}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-active-40"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Processed Orders')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$processed_orders}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Finished Orders')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$finished_orders}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-chart-bar-32"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="res_menagment" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active " id="tabs-menagment-main" data-toggle="tab"
                           href="#menagment" role="tab" aria-controls="tabs-menagment" aria-selected="true"><i
                                    class="ni ni-badge mr-2"></i>{{ __('Store Management')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-menagment-main" data-toggle="tab" href="#hours"
                           role="tab" aria-controls="tabs-menagment" aria-selected="true"><i
                                    class="ni ni-time-alarm mr-2"></i>{{ __('Working Hours')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-menagment-main" data-toggle="tab" href="#orders"
                           role="tab" aria-controls="tabs-menagment" aria-selected="true"><i
                                    class="ni ni-bullet-list-67 mr-2"></i>{{ __('Orders History')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-menagment-main" data-toggle="tab" href="#area"
                           role="tab" aria-controls="tabs-menagment" aria-selected="true"><i
                                    class="ni  ni-map-big mr-2"></i>{{ __('Delivery Area')}}</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>



    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12">
                <br/>

                <div class="tab-content" id="tabs">
                    <!-- Tab Managment -->
                    <div class="tab-pane fade show active" id="menagment" role="tabpanel"
                         aria-labelledby="tabs-icons-text-1-tab">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h3 class="mb-0"> <b>[{{$store->id}}]</b> {{ strtoupper( $store->name ) }}</h3>
                                        <input type="hidden" name="sid" id="sid" value="{{$store->id}}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="heading-small text-muted mb-4">{{ __('Store information') }}</h6>
                                @include('stores.partials.details')
                            </div>
                        </div>
                    </div>

                    <!-- Tab Hours -->
                    <div class="tab-pane fade show" id="hours" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        @include('stores.partials.hours')
                    </div>

                    <!-- Tab Hours -->
                    <div class="tab-pane fade show" id="orders" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        @include('stores.partials.orders')

                    </div>
                    {{-- delivery area --}}
                    <div class="tab-pane fade show" id="area" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        @include('stores.partials.areas')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKwIV-6y31LwzBieBhJqAztrZL9C76T7Y&libraries=drawing"></script>

<script type="text/javascript">
    //hour store
        "use strict";
        var defaultHourFrom = "07:00";
        var defaultHourTo = "22:00";

        var timeFormat = '{{ env('TIME_FORMAT', '24hours') }}';

        function formatAMPM(date) {
            //var hours = date.getHours();
            //var minutes = date.getMinutes();
            var hours = date.split(':')[0];
            var minutes = date.split(':')[1];

            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            //minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }

        //console.log(formatAMPM("19:05"));

        var config = {
            enableTime: true,
            dateFormat: timeFormat == "AM/PM" ? "h:i K" : "H:i",
            noCalendar: true,
            altFormat: timeFormat == "AM/PM" ? "h:i K" : "H:i",
            altInput: true,
            allowInput: true,
            time_24hr: timeFormat == "AM/PM" ? false : true,
            onChange: [
                function (selectedDates, dateStr, instance) {
                    //...
                    this._selDateStr = dateStr;
                },
            ],
            onClose: [
                function (selDates, dateStr, instance) {
                    if (this.config.allowInput && this._input.value && this._input.value !== this._selDateStr) {
                        this.setDate(this.altInput.value, false);
                    }
                }
            ]
        };

        $("input[type='checkbox'][name='days[]']").change(function () {
            //console.log($('#'+ this.id).attr("valuetwo"))
            var hourFrom = flatpickr($('#' + this.value + '_from'), config);
            var hourTo = flatpickr($('#' + this.value + '_to'), config);

            if (this.checked) {
                hourFrom.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourFrom) : defaultHourFrom, false);
                hourTo.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourTo) : defaultHourTo, false);
            } else {
                hourFrom.clear();
                hourTo.clear();
            }
        });


        $('#store_logo').on('change', function (e) {
            $('#logo-img').css('display', 'block')
            var output = document.getElementById('logo-img');
            output.src = URL.createObjectURL(e.target.files[0]);
            $('.logo-icon').css('display', 'none');
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }

        });

        $('#store_cover').on('change', function (e) {
            $('#cover-img').css('display', 'block')
            var output = document.getElementById('cover-img');
            output.src = URL.createObjectURL(e.target.files[0]);
            $('.cover-icon').css('display', 'none');
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }

        });

        //delivery area store


        // function changeDeliveryArea(path){
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     console.log(path);
        //     $.ajax({
        //         type:'POST',
        //         url: '/updateres/delivery/'+$('#sid').val(),
        //         dataType: 'json',
        //         data: {
        //             //path: JSON.stringify(path.i)
        //             path: JSON.stringify(path)
        //         },
        //         success:function(response){
        //             if(response.status){
        //                 console.log(response.status);
        //             }
        //         }, error: function (response) {
        //             console.log(response.status);
                    
        //         }
        //     })
        // }
        
    </script>

{{-- map --}}
<script type="text/javascript">
        //clear marker
        
        $("#clear_area").on("click",function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           
            var area = null;
        
            $.ajax({
                type:'POST',
                url: '/updateres/delivery/'+$('#sid').val(),
                dataType: 'json',
                data: {
                    //path: JSON.stringify(path.i)
                    path: JSON.stringify(area)
                },
                success:function(response){
                    if(response.status){
                        Swal.fire(
                        'Good job!',
                        'Youre area is clear',
                        'success'
                        ).then(function(){ 
                        location.reload();
                        });
                        
                    }
                }, error: function (response) {
                    console.log(response.status);
                    
                }
            })

        });

        // get localisation from area
        function getLocation(callback){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'GET',
                url: '/get/rlocation/'+$('#sid').val(),
                success:function(response){
                
                    if(response.status){
                        console.log(response.data);
                        return callback(true, response.data);
                    }
                }, error: function (response) {
                return callback(false, response.responseJSON.errMsg);
                }
            })
        }

var map; // Global declaration of the map
var iw = new google.maps.InfoWindow(); // Global declaration of the infowindow
var lat_longs = new Array();
var markers = new Array();
var drawingManager;

function initialize(lat, lng) {
var myLatlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
var myOptions = {
zoom: 13,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
map = new google.maps.Map(document.getElementById("map_area"), myOptions);

drawingManager = new google.maps.drawing.DrawingManager({
drawingMode: google.maps.drawing.OverlayType.POLYGON,
drawingControl: true,
drawingControlOptions: {
  position: google.maps.ControlPosition.TOP_CENTER,
  drawingModes: [google.maps.drawing.OverlayType.POLYGON],

},
polygonOptions: {
  editable: true
}
});
drawingManager.setMap(map);

google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
var newShape = event.overlay;
newShape.type = event.type;
});

google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {  
overlayClickListener(event.overlay);
var st = event.overlay.getPath().getArray();

        var bounds = [];
            for (var i = 0; i < st.length; i++) {
                var point = {
                    lat: st[i].lat(),
                    lng: st[i].lng()
                };

                bounds.push(point);
            }
    $('#vertices').val(JSON.stringify(bounds));

});
}

function overlayClickListener(overlay) {
google.maps.event.addListener(overlay, "mouseup", function(event) {

var st = event.overlay.getPath().getArray();
var bounds = [];
    for (var i = 0; i < st.length; i++) {
        var point = {
            lat: st[i].lat(),
            lng: st[i].lng()
        };

        bounds.push(point);
    }

$('#vertices').val(JSON.stringify(bounds));

});
}
google.maps.event.addDomListener(window, 'load', initialize);

$(function() {
$('#save').click(function() {
//iterate polygon vertices?

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var area = $('#vertices').val();
            $.ajax({
                type:'POST',
                url: '/updateres/delivery/'+$('#sid').val(),
                dataType: 'json',
                data: {
                    //path: JSON.stringify(path.i)
                    path: JSON.stringify(area)
                },
                success:function(response){
                    if(response.status){
                        Swal.fire(
                        'Good job!',
                        'Youre area is saved',
                        'success'
                        ).then(function(){ 
                        location.reload();
                        });
                    }
                }, error: function (response) {
                    console.log(response.status);
                }
            })
});
});

window.onload = function () {

    getLocation(function(isFetched, currPost){
        if(isFetched){

            if(currPost.lat != 0 && currPost.lng != 0){
                initialize(currPost.lat, currPost.lng)
                // poly = new google.maps.Polyline({ map: map_area, path: currPost.area ? currPost.area : [], strokeColor: "#FF0000", strokeOpacity: 1.0, strokeWeight: 2 });
                if(currPost.area != null){
                $("#clear_area").show();
                $("#save").hide();
                // To hide:
                drawingManager.setOptions({
                 drawingControl: false
                });
                drawingManager.setMap(null);
                }else{
                    $("#clear_area").hide();
                    $("#save").show();
                    // To show:
drawingManager.setOptions({
  drawingControl: true
});
                }

                var resultArray = JSON.parse(currPost.area);
                var triangleCoordsLS12 = []
                for (var i=0; i<resultArray.length; i++) {
                    triangleCoordsLS12[i] = new google.maps.LatLng(resultArray[i].lat, resultArray[i].lng);
                }
                const bermudaTriangle = new google.maps.Polygon({
                paths: triangleCoordsLS12,
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
                });

                bermudaTriangle.setMap(map);

}



            }
         


        

    });


}

</script>
@endsection