@extends('layouts.app')
@section('header')
@include('cities.modals')
<div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Zones</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">List of Zones</li>
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
            <div class="card card-profile bg-secondary shadow">
                <div class="card-header">
            
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __("Store Zone")}}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('zones')}}" class="btn btn-sm btn-primary">{{ __('back To List') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <style>
                        #map_shift{
                            height: 500px;
                        }
                    </style>
                    <div class="form-group">
                         <label for="name" class="form-control-label">Name</label>
                         <input class="form-control " name="name"   type="text" value="" id="name">
                      </div>
                    <div id="map_shift" class="form-control form-control-alternative"></div>
                    <br/>
                    <button type="button" id="save" class="btn btn-success btn-sm btn-block">{{__("Save")}}</button>
                    <input type="hidden" name="vertices" value="" id="vertices">
            
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKwIV-6y31LwzBieBhJqAztrZL9C76T7Y&libraries=drawing"></script>



{{-- map --}}
<script type="text/javascript">
    //clear marker
    

    // // get localisation from area
    // function getLocation(callback){
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         type:'GET',
    //         url: '/get/rlocation/'+$('#sid').val(),
    //         success:function(response){
            
    //             if(response.status){
    //                 console.log(response.data);
    //                 return callback(true, response.data);
    //             }
    //         }, error: function (response) {
    //         return callback(false, response.responseJSON.errMsg);
    //         }
    //     })
    // }

var map; // Global declaration of the map
var iw = new google.maps.InfoWindow(); // Global declaration of the infowindow
var lat_longs = new Array();
var markers = new Array();
var drawingManager;

function initialize(lat, lng) {
var myLatlng = new google.maps.LatLng(35.75949802247616, -5.833201828825662);
var myOptions = {
zoom: 13,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
map = new google.maps.Map(document.getElementById("map_shift"), myOptions);

drawingManager = new google.maps.drawing.DrawingManager({
drawingMode: google.maps.drawing.OverlayType.POLYGON,
drawingControl: true,
drawingControlOptions: {
position: google.maps.ControlPosition.TOP_CENTER,
drawingModes: [google.maps.drawing.OverlayType.POLYGON],
markerOptions: {
  icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
},
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
            url: '/zone/add',
            dataType: 'json',
            data: {
                //path: JSON.stringify(path.i)
                path: JSON.stringify(area),
                name: $('#name').val(),
                
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

            }else{
                $("#clear_area").hide();
                $("#save").show();

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
