<html>
	<head>
		<title>Ingress Portal Vulnurability</title>
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
		
	</head>
	<body>
		<div class="container-fluid text-center">
			<label for="faction">SELECT YOUR FACTION</label>
			<select id="faction" class="form-control" onchange="updateData();" id="faction">
				<option selected>Enlightened</option>
				<option>Resistance</option>
			</select><br>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-default" style="height:80vh; max-height:80vh;">
						<div class="panel-heading text-center">Neutral Portals (<span id="neutralCount"></span>)</div>
						<div class="panel-body" style="overflow-y:auto; max-height:90%;" id="neutralPortals"></div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default" style="height:80vh; max-height:80vh;">
						<div class="panel-heading text-center">Vulnurable Portals (<span id="vulnurableCount"></span>)</div>
						<div class="panel-body" style="overflow-y:auto; max-height:90%;" id="vulnurablePortals"></div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default" style="height:80vh; max-height:80vh;">
						<div class="panel-heading text-center">Enemy Portals (<span id="enemyCount"></span>)</div>
						<div class="panel-body" style="overflow-y:auto; max-height:90%;" id="enemyPortals"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid text-center">
			<button id="updateButton" class="btn btn-success" onclick="runUpdate()">Last Update was <span id="lastUpdate"></span> ago. Click to run Update Now</button>
		</div>
		<script>
			updateData();
			function updateData(){
				var lastUpdate = 0;
				var neutralCount = 0;
				var vulnurableCount = 0;
				var enemyCount = 0;
				var playerFaction = document.getElementById('faction').value;
				$.getJSON("data.json",function(data){
					var portals = data.portals;
					for(var portalID in portals){
						var currentPortal = portals[portalID];
						var now = (new Date().getTime())/1000;
						var difference = now - currentPortal.timestamp;
						if(difference > lastUpdate){
							lastUpdate = difference;
						}
						var portalElement = document.getElementById(`portal_${portalID}`);
						if(portalElement !== null){
							portalElement.parentElement.removeChild(portalElement);
						}
						portalElement = document.createElement("div");
						portalElement.setAttribute("id",`portal_${portalID}`);
						portalElement.innerHTML = `<strong>${currentPortal.name} (L${currentPortal.level})</strong> ${currentPortal.health}% (${elapsedTime(difference)} ago) <a target="_blank" href="https://intel.ingress.com/intel?z=15&pll=${latlong(currentPortal.lat,currentPortal.long)}">`;
						portalElement.classList.add('well','well-sm');
						if(currentPortal.owner == "Neutral"){
							document.getElementById('neutralPortals').appendChild(portalElement);
							neutralCount += 1;
						}
						else if(currentPortal.owner == playerFaction){
							if(currentPortal.health <= 50){
								document.getElementById('vulnurablePortals').appendChild(portalElement);
								vulnurableCount += 1;
							}
						}
						else{
							document.getElementById('enemyPortals').appendChild(portalElement);
							enemyCount += 1;
						}
					}
					document.getElementById('lastUpdate').innerText = elapsedTime(lastUpdate);
					document.getElementById('neutralCount').innerText = neutralCount;
					document.getElementById('vulnurableCount').innerText = vulnurableCount;
					document.getElementById('enemyCount').innerText = enemyCount;
				});
				
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
			function elapsedTime(difference){
				difference = difference/60;
				var days = Math.floor(difference / (60*24));
				var hours = Math.floor((difference - (days*60*24))/(60));
				var minutes = Math.floor((difference - (days*60*24) - (hours * 60)));
				return `${days}d${hours}h${minutes}m`;
			}
			function runUpdate(){
				var updateButton = document.getElementById('updateButton');
				updateButton.setAttribute('disabled',true);
				updateButton.classList.add('btn-disabled');
				updateButton.classList.remove('btn-success');
				updateButton.innerHTML = `UPDATING, PLEASE WAIT!!! <span id="updateProgress"></span>`;
				var previousData;
				var oReq = new XMLHttpRequest();
				oReq.onreadystatechange = function(){
					if (this.readyState == 4 && this.status == 200){
						updateButton.removeAttribute('disabled');
						updateButton.classList.remove('btn-disabled');
						updateButton.classList.add('btn-success');
						updateButton.innerHTML = `Last Update was <span id="lastUpdate"></span> ago. Click to run Update Now`;
						updateData();
					}
					if (this.readyState > 2){
						var partialResponse = this.responseText;
						if(previousData !== undefined){
							partialResponse = partialResponse.replace(previousData, "");
							previousData += partialResponse;
						}
						else
						{
							previousData = partialResponse;
						}
						if(document.getElementById('updateProgress') !== null){
							document.getElementById('updateProgress').innerText = partialResponse;
						}
					}
				}
				oReq.open("get", "update.php", true);
				oReq.send();
			}
		</script>
	</body>
</html>
<?php
	
?>