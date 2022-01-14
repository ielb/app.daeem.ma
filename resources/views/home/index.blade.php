@extends('layouts.app')

@section('header')
  <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
            {{-- <a href="#" class="btn btn-sm btn-neutral">New</a> --}}
        
            <a class="btn btn-sm btn-neutral" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Filters</a>
          
          </div>
        </div>
        <div class="collapse" id="collapseExample">
            <form action="" method="GET">
            <div class="row input-daterange datepicker">
              <div class="col-xl-3 col-md-6">
                <div class="form-group">
                  <label class="form-control-label text-white">Date From</label>
                  <input class="form-control" placeholder="Date From" name="fromDate" type="text" <?php if(isset($_GET['fromDate'])){echo 'value="'.$_GET['fromDate'].'"';} ?>>
                </div>
              </div>
              
              <div class="col-xl-3 col-md-6">
                <div class="form-group">
                  <label class="form-control-label text-white">Date to</label>
                  <input class="form-control" placeholder="Date to" name="toDate" type="text" <?php if(isset($_GET['toDate'])){echo 'value="'.$_GET['toDate'].'"';} ?>>
                </div>
              </div>
              <div class="col-xl-3 col-md-6">
                <label for="form-control-label">  </label>
                <button type="submit" class="btn btn-primary btn-md btn-block mt-4">{{ __('Filter') }}</button>
              </div>
              @if ($parameters)
              <div class="col-xl-3 col-md-6">
                <label for="form-control-label">  </label>
                  <a href="{{ Request::url() }}" class="btn btn-md btn-block mt-4 bg-white">{{ __('Clear Filters') }}</a>
              </div>
          @else

              <div class="col-xl-3 col-md-6"></div>
          @endif
            </div>
          </form>
        </div>
        <!-- Card stats -->

        @include('home.partials.card')
      </div>
    </div>
@endsection


    
@section('content')
@include('home.partials.map')
@if (auth()->user()->role == "admin")
@include('home.partials.chart')
@endif
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=AIzaSyAKwIV-6y31LwzBieBhJqAztrZL9C76T7Y"> </script>

@endsection


<script>

  var market="/public/images/default/pin_supermarket.png";
  var link = "/storeslocations";
  
function initTheTrackingMap(currentPosiotion,){
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center:  new google.maps.LatLng(35.76295004057098, -5.8290441538767706),
    });
    
  axios.get(link).then(function (response) {
            response.data.stores.forEach(store => {
                    /**
                     *  store Marker
                     **/
                     var marker =new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(store.lat), parseFloat(store.lng)),
                        animation: google.maps.Animation.DROP,
                        map,
                        title: store.name,
                        icon:market,
                    });
                    openmarker(marker, store);

                      

            });

            function openmarker(marker, supermarket) {
              
            var content="<a href=\"/orders?supermarket_id="+supermarket.id+"\"><strong>"+supermarket.name+"</strong></a>";
            const infowindow = new google.maps.InfoWindow({
               content: content,
            });

            marker.addListener("click", () => {
              infowindow.open(marker.get("map"), marker);
            });
}
            
        });


  return map;

}

window.onload = function () {
    map = initTheTrackingMap();
 }
</script>

<style type="text/css">
#map {
      height: 500px;
    }
    </style>
   