<?php
	error_reporting(!E_ALL);
	if(!file_exists("accountDetails.json")){
		fclose(fopen("accountDetails.json",'x'));
	}
	if(!file_exists("data.json")){
			fclose(fopen("data.json",'x'));
		}
	$accountDetails=json_decode(file_get_contents("accountDetails.json"),true);
	$autoUpdateSecret = $accountDetails["autoUpdateSecret"];
	if(!is_null($_POST["function"])){
		if($_POST["function"] == "test"){
			if(!is_null($_POST["secret"])){
				if($_POST["secret"] == $autoUpdateSecret){
					
					die(json_encode(array("success"=>true)));
				}
				else{
					die(json_encode(array("success"=>false,"error"=>"the request could not be completed as an invalid secret was specified")));
				}
			}
			else{
				die(json_encode(array("success"=>false,"error"=>"the request could not be completed as no secret was specified")));
			}
			
		}
		elseif($_POST["function"] == "updateCookie"){
			if($_POST["secret"] == $autoUpdateSecret){
				$accountDetails["cookie"] = $_POST["cookiesString"];
				$accountDetails["xcsrftoken"] = $_POST["XCRFtoken"];
				file_put_contents("accountDetails.json",json_encode($accountDetails));
				die(json_encode(array("success"=>true,"data"=>$_POST,"accountDetails"=>$accountDetails)));
			}
			else{
				die(json_encode(array("success"=>false,"error"=>"the request could not be completed as an invalid secret was specified","submittedData"=>$_POST)));
			}
		}
		elseif($_POST["function"] == "updateRequestInfo"){
			if($_POST["secret"] == $autoUpdateSecret){
				$accountDetails["verifier"] = $_POST["verifier"];
				file_put_contents("accountDetails.json",json_encode($accountDetails));
				if($_POST["tileKeys"] == "null"){
					die(json_encode(array("success"=>true,"data"=>$_POST,"accountDetails"=>$accountDetails)));
				}
				else
				{
					$data = json_decode(file_get_contents('data.json'),true);
					$tileKeys = explode(",",$_POST["tileKeys"]);
					foreach($tileKeys as $currentTileKey){
						if(!in_array($currentTileKey,$data["tilekeys"])){
							$data["tilekeys"][] = $currentTileKey;
						}
					}
					file_put_contents("data.json",json_encode($data));
					die(json_encode(array("success"=>true,"data"=>$_POST,"accountDetails"=>$accountDetails)));
				}
			}
			else{
				die(json_encode(array("success"=>false,"error"=>"the request could not be completed as an invalid secret was specified","submittedData"=>$_POST)));
			}
		}
		else{
			die(json_encode(array("success"=>false,"error"=>"the request could not be completed as an invalid function was specified","submittedData"=>$_POST)));
		}
	}
	else
	{
		die(json_encode(array("success"=>false,"error"=>"the request could not be completed as no function was specified")));
	}
	echo json_encode($data);
?>