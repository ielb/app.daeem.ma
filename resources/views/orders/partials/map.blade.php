<div id="tracking_map" class="form-control form-control-alternative"></div>
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=AIzaSyAKwIV-6y31LwzBieBhJqAztrZL9C76T7Y"> </script>

<script>
  var start="https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Ball-Pink.png"
  var end="https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Ball-Chartreuse.png"
  var driver="https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Marker-Inside-Azure.png"

//Not in use - can be if you use direction API
function calculateRoute(from, to) {
        // Center initialized
        var myOptions = {
          zoom: 18,
          center: new google.maps.LatLng({{ $order->store->lat }}, {{ $order->client->address->lng }}),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
       
        // Draw the map
        var mapObject = new google.maps.Map(document.getElementById("tracking_map"), myOptions);
     
        var directionsService = new google.maps.DirectionsService();
        var directionsRequest = {
          origin: from,
          destination: to,
          travelMode: google.maps.DirectionsTravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.METRIC
        };
        directionsService.route(
          directionsRequest,
          function(response, status)
          {
            if (status == google.maps.DirectionsStatus.OK)
            {
              new google.maps.DirectionsRenderer({
                map: mapObject,
                directions: response
              });
            }else{
              $("#error").append("Unable to retrieve your route<br />");
            }
          }
        );
}

function changeMarkerPosition(marker) {
    var latlng = new google.maps.LatLng(35.763811121430365, -5.8382486197047125);
    marker.setPosition(latlng);
}


function initTheTrackingMap(currentPosiotion,){
    var map = new google.maps.Map(document.getElementById('tracking_map'), {
        zoom: 12,
        center:  new google.maps.LatLng({{ $order->store->lat }}, {{ $order->client->address->lng }}),
    });
    const trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);
  //Marker Start - Super market position
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng({{ $order->store->lat }}, {{ $order->store->lng }}),
    map: map,
    icon: start,
    title: '{{ $order->store->name }}'
  
  });

  //Marker end - Client address
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng({{ $order->client->address->lat }}, {{ $order->client->address->lng }}),
    map: map,
    icon: end,
    title: '{{ $order->client->name }}'
  });

  return map;

}

  
function getOrderLocation(){
  

      if(navigator.geolocation){
  navigator.geolocation.getCurrentPosition(function(position)
    { 
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
        };

      markerData = new google.maps.LatLng(pos.lat,pos.lng);
      if(driverMarker==null){
          //Create the marker
          driverMarker = new google.maps.Marker({
            position: markerData,
            map: map,
            icon:driver,
            title: 'Driver'
          });
         
        }else{

          //Update marker location
          driverMarker.setPosition(markerData);
        }
     
    });
}
  


};

var map = null;
var driverMarker=null;

window.onload = function () {
    map = initTheTrackingMap();
    setInterval(getOrderLocation,1000)
 }
</script>


<style type="text/css">
    #tracking_map {
      height: 400px;
    }
  </style>