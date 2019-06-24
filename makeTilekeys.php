<pre><?php
	if(!file_exists("accountDetails.json")){
		fclose(fopen("accountDetails.json",'x'));
	}
	if(!file_exists("data.json")){
		fclose(fopen("data.json",'x'));
	}
	//$min = "15_18432_18370_0_8_100";
	//$max = "15_18552_18465_0_8_100";
	$mina = 18432;
	$minb = 18370;
	$maxa = 18552;
	$maxb = 18465;
	$tilekeys = array();
	for($a = $mina; $a <= $maxa; $a++){
		for($b = $minb; $b <= $maxb; $b++){
			$tilekey = "15". "_$a". "_$b"."_0_8_100";
			$tilekeys[] = $tilekey;
		}
	}
	$data = json_decode(file_get_contents('data.json'),true);
	$data["tilekeys"] = $tilekeys;
	file_put_contents('data.json',json_encode($data));
?>
</pre>