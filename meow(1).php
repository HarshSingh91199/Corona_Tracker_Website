
<?php 
require_once 'dbConfig.php'; 
$result = $db->query("SELECT * FROM locations"); 
$result2 = $db->query("SELECT * FROM locations"); 
?>
<html>
<head>
<title>Covid</title>
 <?php include 'Header.php';?>
</head>
<style>
form{
    margin: 0 auto 0 auto;
    width:  30%;
    height: 20%;
}


h1
{
	color: red;
}
h4
{	
	align: center;

}
h3
{	
	align: center;
    margin: px 10px;
}
#mapCanvas { 
	border: 10px solid WHITE;
	margin: 0 auto 0 auto;
    width: 	70%;
    height: 70%;
}
</style>
<body>

<div id="mapCanvas"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpNGMP3b_3ARQ1ExMvAkE12Gi7Iq8sXgI"></script>
<script>
function initMap() {
	 x = parseFloat(document.getElementById("myr").value);
    document.getElementById("demo").innerHTML = x;
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
    	  center: {lat: 19.174, lng: 72.87},
          zoom: 4
        };                 
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);    
    var markers = [
        <?php if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
                echo '["'.$row['name'].'",'.$row['latitude'].','.$row['longitude'].',"'.$row['Address'].'",'.$row['count'].'],'; 
            } 
        } 
        ?>
    ];               

    var infoWindowContent = [
        <?php if($result2->num_rows > 0){ 
            while($row = $result2->fetch_assoc()){ ?>
                ['<div class="info_content">' +
                '<h4>Name :- <?php echo $row['name']; ?></h4>' +
                '<p><h4>Address:- <?php echo $row['Address']; ?></h4></p>' +'<h4>No. of Cases :- <?php echo $row['count']; ?></h4>' + '</div>'],
        <?php } 
        } 
        ?>
    ];
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: 'https://mt.googleapis.com/vt/icon/name=icons/onion/124-red.png',
            title: markers[i][0]
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

            var cir = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: position,
            radius: 100
          });
    
 }

    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    }); 
 

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            markers = new google.maps.Marker({
            position: pos,
            map: map
        });

            var infowindows = new google.maps.InfoWindow({
    		content: "Your location"
  			});
			markers.addListener('click', function() {
    		infowindows.open(map, markers);
  			});
            var cir1 = new google.maps.Circle({
            strokeColor: '#32CD32',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#32CD32',
            fillOpacity: 0.2,
            map: map,
            center: pos,
            radius: x
        });
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindows, map.getCenter());
          });
        } else {
          handleLocationError(false, infoWindows, map.getCenter());
        }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindows.setPosition(pos);
        infoWindows.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindows.open(map);
      }
}

google.maps.event.addDomListener(window, 'load', initMap);
</script>
<br>
<div class = "maincontainer">
<h3 align ="center">
<div class = "notcontainer1"> 0m.</div>
<div class = "notcontainer"><input type="range" id="myr" value="500" min="0" max="5000"></div>
<div class = "notcontainer2">5000m.</div>
<br>
<br>
Radius :-<label id="demo"><b><b></label> Metres
<br>
<br>
<button onclick="initMap()">Refresh </button>
</h4>
</div>
</body>
</html>