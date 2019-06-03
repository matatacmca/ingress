<?php
	$data = json_decode(file_get_contents('data.json'),true);
	$config = json_decode(file_get_contents("accountDetails.json"),true);
	$mapsKey = $config["mapsAPIKey"];
	error_reporting(!E_ALL);
?>
<html>
	<head>
		<title>Ingress Portals Map</title>
		<link rel="icon" href="https://intel.ingress.com/favicon.ico" type="image/x-icon"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<style >
			a[target="_blank"]:after {
				background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjEzIiBoZWlnaHQ9IjEzIiBmaWxsPSIjMWE3M2U4Ij48cGF0aCBkPSJNMTkgMTlINVY1aDdWM0g1YTIgMiAwIDAgMC0yIDJ2MTRhMiAyIDAgMCAwIDIgMmgxNGMxLjEgMCAyLS45IDItMnYtN2gtMnY3ek0xNCAzdjJoMy41OWwtOS44MyA5LjgzIDEuNDEgMS40MUwxOSA2LjQxVjEwaDJWM2gtN3oiLz48cGF0aCBmaWxsPSJub25lIiBkPSJNMCAwaDI0djI0SDBWMHoiLz48L3N2Zz4=);
				background-repeat: no-repeat;
				content: '';
				display: inline-block;
				height: 13px;
				margin: 0 3px 0 4px;
				position: relative;
				top: 2px;
				width: 13px;
			}
		</style>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style>
			#map{
				width:100%;
				height:100%;
			}
		</style>
	</head>
	<body>
		<div id="map"></div>
		<script>
			var map;
			function initMap() {
				map = new google.maps.Map(document.getElementById('map'), {
					center: {lat: -26.103894, lng: 27.990309},
					zoom: 10
				});
				<?php
					if(is_null($_GET["owner"])){
						?>
							var markers = [];
							var neutral = [<?php
								foreach($data["portals"] as $currentPortal){
									if($currentPortal["owner"] == "Neutral"){
										$lat = floatval($currentPortal["lat"])/1000000;
										$lng = floatval($currentPortal["long"])/1000000;
										echo "{lat: $lat,lng: $lng},";
									}
								}
							?>];
							var enl = [<?php
								foreach($data["portals"] as $currentPortal){
									if($currentPortal["owner"] == "Enlightened"){
										$lat = floatval($currentPortal["lat"])/1000000;
										$lng = floatval($currentPortal["long"])/1000000;
										echo "{lat: $lat,lng: $lng},";
									}
								}
							?>];
								var res = [<?php
								foreach($data["portals"] as $currentPortal){
									if($currentPortal["owner"] == "Resistance"){
										$lat = floatval($currentPortal["lat"])/1000000;
										$lng = floatval($currentPortal["long"])/1000000;
										echo "{lat: $lat,lng: $lng},";
									}
								}
							?>];
							
							
							
							for(var i = 0; i < neutral.length; i++)
							{
								
								markers.push(
									new google.maps.Marker({
										position: new google.maps.LatLng(neutral[i].lat,neutral[i].lng),
										icon:{
											url:"orange.png",
											scaledSize:  new google.maps.Size(20,20)
										}
									})
								);
							}
							for(var i = 0; i < enl.length; i++)
							{
								
								markers.push(
									new google.maps.Marker({
										position: new google.maps.LatLng(enl[i].lat,enl[i].lng),
										icon:{
											url:"green.png",
											scaledSize:  new google.maps.Size(20,20)
										}
									})
								);
							}
							for(var i = 0; i < res.length; i++)
							{
								
								markers.push(
									new google.maps.Marker({
										position: new google.maps.LatLng(res[i].lat,res[i].lng),
										icon:{
											url:"blue.png",
											scaledSize:  new google.maps.Size(20,20)
										}
									})
								);
							}
							var Cluster = new MarkerClusterer(map, markers,{
									imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
								});
							<?php
					}
					else{
						?>
							var markers = [];
							var neutral = [<?php
								foreach($data["portals"] as $currentPortal){
									if($currentPortal["owner"] == "Neutral"){
										$lat = floatval($currentPortal["lat"])/1000000;
										$lng = floatval($currentPortal["long"])/1000000;
										echo "{lat: $lat,lng: $lng},";
									}
								}
							?>];
							var enl = [<?php
								foreach($data["portals"] as $currentPortal){
									if($currentPortal["owner"] == "Enlightened"){
										$lat = floatval($currentPortal["lat"])/1000000;
										$lng = floatval($currentPortal["long"])/1000000;
										echo "{lat: $lat,lng: $lng},";
									}
								}
							?>];
								var res = [<?php
								foreach($data["portals"] as $currentPortal){
									if($currentPortal["owner"] == "Resistance"){
										$lat = floatval($currentPortal["lat"])/1000000;
										$lng = floatval($currentPortal["long"])/1000000;
										echo "{lat: $lat,lng: $lng},";
									}
								}
							?>];
							<?php
								if($_GET["owner"] == "n"){
									?>
										markers.Neutral = [];
										for(var i = 0; i < neutral.length; i++)
										{
											
											markers.Neutral.push(
												new google.maps.Marker({
													position: new google.maps.LatLng(neutral[i].lat,neutral[i].lng),
													icon:{
														url:"orange.png",
														scaledSize:  new google.maps.Size(20,20)
													}
												})
											);
										}
										var neutralCluster = new MarkerClusterer(map, markers.Neutral,{
												imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
											});
									<?php
								}
								elseif($_GET["owner"] == "e"){
									?>
										markers.Enlightened = [];
										for(var i = 0; i < enl.length; i++)
										{
											
											markers.Enlightened.push(
												new google.maps.Marker({
													position: new google.maps.LatLng(enl[i].lat,enl[i].lng),
													icon:{
														url:"green.png",
														scaledSize:  new google.maps.Size(20,20)
													}
												})
											);
										}
										var enlCluster = new MarkerClusterer(map, markers.Enlightened,{
											imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
										});
									<?php
								}
								elseif($_GET["owner"] == "r"){
									?>
										markers.Resistance = [];
										for(var i = 0; i < res.length; i++)
										{
											
											markers.Resistance.push(
												new google.maps.Marker({
													position: new google.maps.LatLng(res[i].lat,res[i].lng),
													icon:{
														url:"blue.png",
														scaledSize:  new google.maps.Size(20,20)
													}
												})
											);
										}
										var resCluster = new MarkerClusterer(map, markers.Resistance,{
											imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
										});
									<?php
								}
							?>
						<?php
					}
				?>
			}
			
			
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $mapsKey; ?>&callback=initMap"
		async defer></script>
		<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
	</body>
</html>
</html>
<?php
	
?>