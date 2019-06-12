<!DOCTYPE html>
<html>
	<head>
		<title>Ingress Tools by matatacmca</title>
	</head>
	<body>
		<h1>Welcome to Ingress Tools by matatacmca</h1>
		<?php
			error_reporting(!E_ALL);
			$data = json_decode(file_get_contents('data.json'),true);
			$accountDetails=json_decode(file_get_contents("accountDetails.json"),true);
			$errors = array();
			if(count($data["tilekeys"]) < 1){
				$errors[] = "No tileKeys have been configured, if you are using the automatic updates, please check your server connectivity settings from the chrome extension (Note that tilekeys are only submitted when the zoom shows all portals). Otherwise, Please update the tilekeys manually";
			}
			if($accountDetails["cookie"] == ""){
				$errors[] = "No cookies have been configured, if you are using the automatic updates, please check your server connectivity settings from the chrome extension. Otherwise, Please update the cookies manually";
			}
			if($accountDetails["verifier"] == ""){
				$errors[] = "No verifier has been configured, if you are using the automatic updates, please check your server connectivity settings from the chrome extension. Otherwise, Please update the verifier manually";
			}
			if($accountDetails["xcsrftoken"] == ""){
				$errors[] = "No xcsrftoken has been configured, if you are using the automatic updates, please check your server connectivity settings from the chrome extension. Otherwise, Please update the xcsrftoken manually";
			}
			if($accountDetails["mapsAPIKey"] == ""){
				$errors[] = "No mapsAPIKey has been configured, if you are using the automatic updates, please check your server connectivity settings from the chrome extension. Otherwise, Please update the mapsAPIKey manually";
			}
			if($accountDetails["autoUpdateSecret"] == ""){
				$errors[] = "No autoUpdateSecret has been configured, if you are using the automatic updates, please check your server connectivity settings from the chrome extension. Otherwise, Please update the autoUpdateSecret manually";
			}
			if(count($errors) > 0){
				?>
					<div style="background-color:tomato">
						<h2>You have the following configuration errors:</h2>
						<ul>
							<?php
								foreach($errors as $currentError){
									echo "<li>$currentError</li>";
								}
							?>
						</ul>
					</div>
				<?php
			}
		?>
		<h2>Select an option below to continue</h2>
		<ul>
			<li><a href="vulnurability.php">Portal Vulnurability Checker</a></li>
			<li>Portal Density Map<br>
				<ul>
					<li><a href="map.php">All Portals</a></li>
					<li><a href="map.php?owner=n">Neutral Portals</a></li>
					<li><a href="map.php?owner=e">Enlightened Portals</a></li>
					<li><a href="map.php?owner=r">Resistance Portals</a></li>
				</ul>
			</li>
		</ul>
	</body>
</html>