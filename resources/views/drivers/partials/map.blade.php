<div class="card">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">{{ __('Realtime map') }}</h6>
                <h2 class="mb-0">{{ __('Drivers Places')}}</h2>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div id="map_driver" class="form-control form-control-alternative"></div>
    </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=AIzaSyAKwIV-6y31LwzBieBhJqAztrZL9C76T7Y"> </script>

<script>

    var market="/public/images/default/driver-pin.png";
    var link = "/driversLocations";
 
  function initTheTrackingMap(currentPosiotion,){
      var map = new google.maps.Map(document.getElementById('map_driver'), {
          zoom: 14,
          center:  new google.maps.LatLng(35.76295004057098, -5.8290441538767706),
      });
      const trafficLayer = new google.maps.TrafficLayer();
      trafficLayer.setMap(map);
    axios.get(link).then(function (response) {
              response.data.drivers.forEach(driver => {
                      /**
                       *  driver Marker
                       **/
                       var marker =new google.maps.Marker({
                          position: new google.maps.LatLng(parseFloat(driver.lat), parseFloat(driver.lng)),
                          animation: google.maps.Animation.DROP,
                          map,
                          title: driver.name,
                          icon:market,
                      });
                      openmarker(marker, driver);
  
                        
  
              });
  
              function openmarker(marker, driver) {
                
              var content="<a href=\"/driver/"+driver.id+"/edit\"><strong>"+driver.name+"</strong></a>";
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
    #map_driver {
      height: 600px;
    }
  </style>