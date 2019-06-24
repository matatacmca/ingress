<?php
	error_reporting(!E_ALL);
	if(!file_exists("data.json")){
		fclose(fopen("data.json",'x'));
	}
	$data = json_decode(file_get_contents('data.json'),true);
	if($_POST["reset"] == "tileKeys"){
		$data["tilekeys"] = array();
		if(file_put_contents('data.json',json_encode($data))){
			$response = json_encode(array("success" => true));
		}
		else{
			$response = json_encode(array("success" => false,"error" => "something went wrong while saving the file"));
		}
	}
	elseif($_POST["reset"] == "portalData"){
		$data["portals"] = array();
		if(file_put_contents('data.json',json_encode($data))){
			$response = json_encode(array("success" => true));
		}
		else{
			$response = json_encode(array("success" => false,"error" => "something went wrong while saving the file"));
		}
	}
	else{
		$response = json_encode(array("success" => false,"error" => "Invalid data specified"));
	}
	echo $response;
?>