@extends('layouts.app')
@section('content')

	<script
	src="http://maps.googleapis.com/maps/api/js?key=AIzaSyApzL1AXKwyfJT2tT5c5KkxFqnfv2txpQw&sensor=false">
	</script>


  <div class="row-fluid">
    <div class="card border-primary">
      <div class="card-header bg-primary text-white"><h5 class="text-center"><i class="fas fa-map-marked-alt"></i> Center Location</h5></div>
        <div class="card">
          <div id="googleMap" style="height:500px;width:1055px;"></div>
        </div>
    </div>
  </div>


<?php
  function acc($id){
  $pop = HouseholdEvacs::all()->count()->where('center_id', $id);
  return $pop;
  }
?>
<?php
    $i = 0;
    $pins = [];
    

		foreach($location as $l){
      $barag = $l->brgy_id;
      if($barag == $brgy){
      $address = $l->location;
			$lat = $l->lat;
			$lng = $l->lng;
			$id = $l->id;
      $acc = $l->accommodation;
      if($pop[$i]['id'] == NULL){
        $acc1 = 0;
      }else{
        $acc1 = $pop[$i]['total'];
      }
			$pins[]= ['address' => $address,'lat' => $lat, 'lng' => $lng, 'acc' => $acc, 'acc1' => $acc1];
      } 
    }
		//$markers = json_encode( $pins );
		// var_dump($pins);
?>


  <script type="text/javascript">
	
	var locations = <?php echo json_encode($pins);?>;
	console.log(locations);
	console.log(locations.length);
	// console.log(JSON.stringify(locations))
  
	var myCenter=new google.maps.LatLng(10.390571576337738, 123.82201194763184);
    var map = new google.maps.Map(document.getElementById('googleMap'), {
      zoom: 10,
      center: myCenter,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });


    var allowedBounds = new google.maps.LatLngBounds(
		new google.maps.LatLng(9.588478573018719,123.29202890396118),
		new google.maps.LatLng(11.235485427130337, 124.11319255828857) 
		);
    google.maps.event.addListener(map, 'dragend', function() {
    	if(allowedBounds.contains(map.getCenter())) return;

   		map.setCenter(myCenter);
		});

		map.setOptions({ minZoom: 9});
    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i]['address']+'<br>'+'Current Population: '+ locations[i]['acc1']+'/'+ locations[i]['acc']+'<br>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
 </script>


@endsection