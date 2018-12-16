
@extends('layouts.app')

@section('content')

        <!-- <style type="text/css">
	body
	{
		
	}
	.btn
	{
		border: 1px solid lightgrey;
		height: 40px;
		width: 200px; 
		background: -webkit-linear-gradient(top, rgb(59, 154, 202), #069);
		color: white;
	}
	
	#txtarea{position: relative; left: 50px; width: 300px;}
	</style> -->
    <!-- <script type="text/javascript"></script> -->
	<script
	src="http://maps.googleapis.com/maps/api/js?key=AIzaSyApzL1AXKwyfJT2tT5c5KkxFqnfv2txpQw&sensor=false">
	</script>
    
    <div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary text-white"><h5 class="text-center">Evacuation Center Information</h5></div>
            <div class="card-body">
                {!! Form::open(['action' => 'CenterController@store', 'method' => 'POST']) !!}
                  <h5>Account Details</h5>
                    <div class="row">
                        <div class="col-md-4">
                            {{Form::label('username', 'Username')}}
                            {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username'])}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('password', 'Password')}}
                            {{Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password'))}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('confirm_password', 'Confirm Password')}}
                            {{Form::password('confirm_password', array('class' => 'form-control', 'placeholder' => 'Confirm Password'))}}
                        </div>
                    </div>

                    <br>

                  <h5>Evacuation Center Details</h5>  
                    <div class="row">
                        <div class="col-md-4">
                            {{Form::label('accommodation', 'Accommodation')}}
                            {{Form::number('accommodation', '', ['class' => 'form-control', 'placeholder' => 'Accommodation'])}}
                        </div>
                        <div class="col-md-4">
                            {{Form::label('location', 'Location')}}
                            {{Form::text('lat', '', ['class' => 'form-control', 'placeholder' => 'Location Latitude','id' => 'latspan','readOnly' ])}}
							{{Form::text('lng', '', ['class' => 'form-control', 'placeholder' => 'Location Latitude','id' => 'lngspan','readOnly' ])}}
							
                        </div>
                        <div class="col-md-4">
                        {{Form::label('location', 'Location')}}
                            {{Form::text('location', '', ['class' => 'form-control', 'placeholder' => 'location','id' => 'location' ])}}    
                        </div>
                    </div>
                    
					<br>
					<div class="row-fluid">
                    	<div class="card border-primary">
							<div id="googleMap" style="height:500px;width:1014px;" ></div>
                    	</div>
					</div>
					<br>
				<div class="row justify-content-md-center">
                    {{csrf_field()}}
                        {{Form::submit('Register', ['class'=>'btn btn-outline-success'])}}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>        
    </div>
</div>

                  
    <?php                
        $markers[] = array();
    ?>
    
    <script>
    markers = <?php echo json_encode($markers)?>;   
	var map;
	var select = 0;
	var myCenter=new google.maps.LatLng(10.390571576337738, 123.82201194763184);
	var markersArray = [];
	
	
	function initialize(){	
		
        var mapProp = {
            center:myCenter,
            zoom:8,
            mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		
            map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        	var marker=new google.maps.Marker({
	        position:myCenter,
	    });
	      
	    // marker.setMap(map);
		var allowedBounds = new google.maps.LatLngBounds(
		new google.maps.LatLng(9.588478573018719,123.29202890396118),
		new google.maps.LatLng(11.235485427130337, 124.11319255828857) 
		);

		google.maps.event.addListener(map, 'dragend', function() {
    	if(allowedBounds.contains(map.getCenter())) return;

   		map.setCenter(myCenter);
	});

		map.setOptions({ minZoom: 9});

	var infowindow = new google.maps.InfoWindow(), marker, i;
	for (i = 0; i < markers.length; i++) {  
	    marker = new google.maps.Marker({
	    position: new google.maps.LatLng(markers[i][0], markers[i][1]),
	    map: map
	});
	        google.maps.event.addListener(marker, 'click', (function(marker, i) {
    return function() {
            infowindow.setContent(markers[i][2]);
            infowindow.open(map, marker);
    }
	})(marker, i));
	}
 	
	     
		google.maps.event.addListener(map, 'click', function(event) {
	
		document.getElementById('latspan').value = event.latLng.lat();
		document.getElementById('lngspan').value = event.latLng.lng();
	
		placeMarker(event.latLng);
	
		map.panTo(event.latLng);
	
	});
	}
	
	
	function placeMarker(location){
	deleteOverlays();
	var marker = new google.maps.Marker({
		position: location,
		animation:google.maps.Animation.BOUNCE,
		map: map,
	});
	
		markersArray.push(marker);
	var infowindow = new google.maps.InfoWindow({
		content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
	});
		infowindow.open(map,marker);
	}
	function deleteOverlays() {
		if (markersArray) {
			for (i in markersArray) {
			markersArray[i].setMap(null);
		}
			markersArray.length = 0;
		}
	}
	
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>


	@endsection