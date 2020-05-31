
<?php 
// Include the database configuration file 
require_once 'dbConfig.php'; 
 
// Fetch the marker info from the database 
$result = $db->query("SELECT * FROM locations"); 
 
// Fetch the info-window data from the database 
$result2 = $db->query("SELECT * FROM locations"); 

?>
<html>
<head>
<title>Covid</title>
</head>
<style>
body {
	font-family: Arial;
}

#mapCanvas {
    width: 50%;
    height: 50%;
}
</style>
<body>
    <h3 align="center">
<label for="points">Points (between 0 and 10):</label>
<input type="range" id="myr" value="500" min="0" max="10000">
<button onclick="initMap()">Try it</button>
<br>
</h3>
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
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);    
    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
                echo '["'.$row['name'].'",'.$row['latitude'].','.$row['longitude'].',"'.$row['Address'].'",'.$row['count'].',"'.$row['icon'].'"]'; 
            } 
        } 
        ?>
    ];               
    //Info window content
    var infoWindowContent = [
        <?php if($result2->num_rows > 0){ 
            while($row = $result2->fetch_assoc()){ ?>
                ['<div class="info_content">' +
                '<h3>Name :- <?php echo $row['name']; ?></h3>' +
                '<p>Adress:- <?php echo $row['Address']; ?></p>' +'<h3>No. of Cases :- <?php echo $row['count']; ?></h3>' + '</div>'],
        <?php } 
        } 
        ?>
    ];
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        //bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: 'https://mt.googleapis.com/vt/icon/name=icons/onion/124-red.png',
            title: markers[i][0]
        });
    
 	
        // Add info window to marker    
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
            fillOpacity: 0.2,
            map: map,
            center: position,
            radius: 100
          });
 }
   // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    }); 
    infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            marker = new google.maps.Marker({
            position: pos,
            map: map,
        });
         
            var cir1 = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.2,
            map: map,
            center: pos,
            radius: x
        });
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
}


google.maps.event.addDomListener(window, 'load', initMap);

</script>
<br>
<h3 align="center" color = "Gray">
<label for="points">0m  </label>
<input type="range" id="myr" value="500" min="0" max="10000">
<label for="points">10000m</label>
<button onclick="initMap()">  Refresh </button>
<br>
<p id="demo"></p>
</h3>
</body>
</html>