<?php
	error_reporting(!E_ALL);
	if(!file_exists("accountDetails.json")){
		fclose(fopen("accountDetails.json",'x'));
	}
	$accountDetails=json_decode(file_get_contents("accountDetails.json"),true);
	$cookie = $accountDetails["cookie"];
	$verifier = $accountDetails["verifier"];
	$xcsrftoken = $accountDetails["xcsrftoken"];
	
	if(!file_exists("data.json")){
		fclose(fopen("data.json",'x'));
	}
	$data = json_decode(file_get_contents('data.json'),true);
	$resonatorHealth = array("1"=>1000,"2"=>1500,"3"=>2000,"4"=>2500,"5"=>3000,"6"=>4000,"7"=>5000,"8"=>6000);
	$portals = $data["portals"];
	$tilekeys = $data["tilekeys"];
	
	
	$totalTilekeys = count($tilekeys);
	$retrievedTilekeys = 0;
	say("TOTAL TILEKEYS: " . $totalTilekeys . "<br>\r\n");
	foreach($tilekeys as $tilekey){
		$map = requestEntities($tilekey);
		foreach($map as $currentTileKey)
		{
			foreach($currentTileKey -> gameEntities as $currentEntity)
			{
				if($currentEntity[2][0] == "p")//currentEntity = portal
				{
					$portalID = $currentEntity[0];
					$currentPortal = array();
					$currentPortal["name"] = $currentEntity[2][8];
					$currentPortal["lat"] = strval($currentEntity[2][2]);
					$currentPortal["long"] = strval($currentEntity[2][3]);
					$portalDetails = requestPortalDetails($portalID);
					$currentPortal["level"] = strval($portalDetails[4]);
					$currentPortal["resonators"] = array();
					$health = 0;
					foreach($portalDetails[15] as $currentResonator)
					{
						$resLevel = strval($currentResonator[1]);
						$resHealth = strval($currentResonator[2]);
						$currentPortal["resonators"][] = strval($resHealth / $resonatorHealth[$resLevel] * 100);
						$health += $resHealth / $resonatorHealth[$resLevel] * 100;;
					}
					$currentPortal["health"] = strval($health / 8);
					$currentPortal["timestamp"] = microtime(true);
					if($currentEntity[2][1] == "N")//Portal is Neutral
					{
						$currentPortal["owner"] = "Neutral";
					}
					elseif($currentEntity[2][1] == "R")//Portal is Neutral
					{
						$currentPortal["owner"] = "Resistance";
					}
					elseif($currentEntity[2][1] == "E")//Portal is Neutral
					{
						$currentPortal["owner"] = "Enlightened";
					}
					$portals[$portalID] = $currentPortal; 
				}
			}
			$data["portals"] = $portals;
			file_put_contents('data.json',json_encode($data));
		}
		$retrievedTilekeys += 1;
		say("Progress: $retrievedTilekeys / $totalTilekeys (" . $retrievedTilekeys/$totalTilekeys*100 ."%)<br>\r\n");
	}
	
	
	function requestEntities($tilekey)
	{
		global $cookie, $verifier, $xcsrftoken;
		// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, 'https://intel.ingress.com/r/getEntities');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"tileKeys\":[\"$tilekey\"],\"v\":\"$verifier\"}");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		
		$headers = array();
		$headers[] = "Cookie: $cookie";
		$headers[] = 'Origin: https://intel.ingress.com';
		$headers[] = 'Accept-Encoding: gzip, deflate, br';
		$headers[] = 'Accept-Language: en,en-ZA;q=0.9';
		$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.108 Safari/537.36';
		$headers[] = "X-Csrftoken: $xcsrftoken";
		$headers[] = 'Content-Type: application/json; charset=UTF-8';
		$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
		$headers[] = 'Referer: https://intel.ingress.com/intel';
		$headers[] = 'Authority: intel.ingress.com';
		$headers[] = 'X-Requested-With: XMLHttpRequest';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		else
		{
			$parsedResult = json_decode($result);
			if(gettype($parsedResult) !== "object"){
				echo("Error: the server returned an unknown response\r\n");
			}
			return($parsedResult -> result -> map);
		}
		curl_close ($ch);
	}
	function requestPortalDetails($portalID)
	{
		global $cookie, $verifier, $xcsrftoken;
		$curl = curl_init();
		//GENERATED BY POSTMAN
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://intel.ingress.com/r/getPortalDetails",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\"guid\":\"$portalID\",\"v\":\"$verifier\"}",
		  CURLOPT_HTTPHEADER => array(
		    "accept: application/json, text/javascript, */*; q=0.01",
		    "cache-control: no-cache",
		    "content-type: application/json; charset=UTF-8",
		    "cookie: $cookie",
		    "debug: true",
		    "origin: https://intel.ingress.com",
		    "postman-token: 226df84b-5565-d1e4-0a4a-d027094615ba",
		    "referer: https://intel.ingress.com/",
		    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36",
		    "X-Csrftoken: $xcsrftoken",
		    "x-requested-with: XMLHttpRequest"
		  ),
		));
		
		$result = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		  return false;
		}
		else
		{
			$parsedResult = json_decode($result);
			if(gettype($parsedResult) !== "object"){
				echo("Error: the server returned an unknown response\r\n");
			}
			return($parsedResult -> result);
		}
	}
	
	function say($string){
		if(gettype($string) !== "string"){
			trigger_error("function say expects a string as parameter, instead a " . gettype($string) . " was sent",E_USER_NOTICE);
			return false;
		}
		if(count(ob_get_status()) > 0){//There is an output buffer available
			echo $string;
			ob_flush();
			flush();
		}
		else{
			echo $string;
		}
	}
?>