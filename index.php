<html>
	<head>
		<title>Ingress Portal Vulnurability</title>
		<link rel="icon" href="https://intel.ingress.com/favicon.ico" type="image/x-icon"/>
		<script>
			tileKeys = [
				"15_18500_18406_0_8_100",
				"15_18500_18407_0_8_100",
				"15_18500_18408_0_8_100",
				"15_18500_18409_0_8_100",
				"15_18500_18410_0_8_100",
				"15_18500_18411_0_8_100",
				"15_18500_18412_0_8_100",
				"15_18500_18413_0_8_100",
				"15_18500_18414_0_8_100",
				"15_18501_18403_0_8_100",
				"15_18501_18404_0_8_100",
				"15_18501_18405_0_8_100",
				"15_18501_18406_0_8_100",
				"15_18501_18407_0_8_100",
				"15_18501_18408_0_8_100",
				"15_18501_18409_0_8_100",
				"15_18501_18410_0_8_100",
				"15_18501_18410_0_8_100",
				"15_18501_18411_0_8_100",
				"15_18501_18412_0_8_100",
				"15_18501_18413_0_8_100",
				"15_18501_18414_0_8_100",
				"15_18502_18402_0_8_100",
				"15_18502_18403_0_8_100",
				"15_18502_18404_0_8_100",
				"15_18502_18405_0_8_100",
				"15_18503_18402_0_8_100",
				"15_18503_18403_0_8_100",
				"15_18503_18404_0_8_100",
				"15_18503_18405_0_8_100",
				"15_18504_18402_0_8_100",
				"15_18504_18403_0_8_100",
				"15_18504_18404_0_8_100",
				"15_18504_18405_0_8_100",
				"15_18505_18402_0_8_100",
				"15_18505_18403_0_8_100",
				"15_18505_18404_0_8_100",
				"15_18505_18405_0_8_100",
				"15_18506_18402_0_8_100",
				"15_18506_18403_0_8_100",
				"15_18506_18404_0_8_100",
				"15_18506_18405_0_8_100",
				"15_18507_18403_0_8_100",
				"15_18507_18404_0_8_100",
				"15_18507_18406_0_8_100",
				"15_18507_18407_0_8_100",
				"15_18507_18408_0_8_100",
				"15_18507_18409_0_8_100",
				"15_18507_18410_0_8_100",
				"15_18507_18410_0_8_100",
				"15_18507_18411_0_8_100",
				"15_18507_18412_0_8_100",
				"15_18507_18413_0_8_100",
				"15_18507_18414_0_8_100"
				];
		</script>
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
		<script>
			getData();
			setInterval(function(){getData();},60000);
			function getData(){
				for(var i in tileKeys)
				{
					var currentTileKey = tileKeys[i];
					var settings = {
						"async": true,
						"crossDomain": true,
						"url": `getData.php?tilekey=${currentTileKey}`,
						"method": "GET",
						"headers": {
							"upgrade-insecure-requests": "1",
							"accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
							"cache-control": "no-cache",
							"postman-token": "dd9111ef-8254-09b5-6018-c8775d3c5288"
							},
						"dataType": "json"
					};
					
					$.ajax(settings).done(function (response) {
						updateInfo(response);
					});
				}
			}
			function updateInfo(response)
			{
				if(response.response !== undefined)
				{
					for(var faction in response.response)
					{
						var factionPortals = response.response[faction];
						for(var portalID in factionPortals)
						{
							var currentPortal = factionPortals[portalID];
							if(faction == "enlightened")//Worry about health
							{
								if(parseFloat(currentPortal.health) <= 50)//portal has low health
								{
									var portalDOM = document.getElementById(`portal_${portalID}`)
									if(portalDOM !== null)
									{
										portalDOM.parentElement.removeChild(portalDOM);
									}
									var portalDOM = document.createElement('div');
									portalDOM.classList.add('well','well-sm');
									portalDOM.setAttribute('id',`portal_${portalID}`);
									portalDOM.innerHTML = `<strong>${currentPortal.name} (L${currentPortal.level})</strong> ${currentPortal.health}% <a target="_blank" href="https://intel.ingress.com/intel?z=15&pll=${latlong(currentPortal.lat,currentPortal.long)}">`
									document.getElementById("vulnurablePortals").appendChild(portalDOM);
								}
								else //ensure that portal is removed
								{
									var portalDOM = document.getElementById(`portal_${portalID}`)
									if(portalDOM !== null)
									{
										portalDOM.parentElement.removeChild(portalDOM);
									}
								}
							}
							else if(faction == "resistance")
							{
								var portalDOM = document.getElementById(`portal_${portalID}`)
								if(portalDOM !== null)
								{
									portalDOM.parentElement.removeChild(portalDOM);
								}
								var portalDOM = document.createElement('div');
								portalDOM.classList.add('well','well-sm');
								portalDOM.setAttribute('id',`portal_${portalID}`);
								portalDOM.innerHTML = `<strong>${currentPortal.name} (L${currentPortal.level})</strong> ${currentPortal.health}% <a target="_blank" href="https://intel.ingress.com/intel?z=15&pll=${latlong(currentPortal.lat,currentPortal.long)}">`
								document.getElementById("enemyPortals").appendChild(portalDOM);
							}
							else if(faction == "neutral")
							{
								var portalDOM = document.getElementById(`portal_${portalID}`)
								if(portalDOM !== null)
								{
									portalDOM.parentElement.removeChild(portalDOM);
								}
								var portalDOM = document.createElement('div');
								portalDOM.classList.add('well','well-sm');
								portalDOM.setAttribute('id',`portal_${portalID}`);
								portalDOM.innerHTML = `<strong>${currentPortal.name} (L${currentPortal.level})</strong> ${currentPortal.health}% <a target="_blank" href="https://intel.ingress.com/intel?z=15&pll=${latlong(currentPortal.lat,currentPortal.long)}">`
								document.getElementById("neutralPortals").appendChild(portalDOM);
							}
						}
					}
				}
			}
			function latlong(lat,long)
			{
				var lat = lat.split('');
				lat = lat.reverse();
				lat.splice(6,0,".");
				lat = lat.reverse();
				latNew = "";
				for(var i in lat){
					latNew += lat[i];
				}
				var long = long.split('');
				long = long.reverse();
				long.splice(6,0,".");
				long = long.reverse();
				longNew = "";
				for(var i in long){
					longNew += long[i];
				}
				return `${latNew},${longNew}`
			}
		</script>
		
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-default" style="height:100vh; max-height:100vh;">
						<div class="panel-heading text-center">Neutral Portals</div>
						<div class="panel-body" style="overflow-y:auto; max-height:90%;" id="neutralPortals"></div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default" style="height:100vh; max-height:100vh;">
						<div class="panel-heading text-center">Vulnurable Portals</div>
						<div class="panel-body" style="overflow-y:auto; max-height:90%;" id="vulnurablePortals"></div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default" style="height:100vh; max-height:100vh;">
						<div class="panel-heading text-center">Enemy Portals</div>
						<div class="panel-body" style="overflow-y:auto; max-height:90%;" id="enemyPortals"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
	
?>