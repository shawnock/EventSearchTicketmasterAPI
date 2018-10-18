<?php
require 'geohash.php';


// ticketmaster API call for user choosing their own location
if(isset($_GET['userLocation'])){

	$userLocation = $_GET['userLocation'];
	$userLocation = str_replace(' ', '+', $userLocation);
	$response = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$userLocation.'&key=AIzaSyDMiwLQglmBWZsPWiTPavsvJgtc_pJdgdQ');
	$response = json_decode($response, true);
	$lat = $response['results'][0]['geometry']['location']['lat'];
 	$lon = $response['results'][0]['geometry']['location']['lng'];
 	$geoPoint = encode($lat, $lon);

	if(isset($_GET['keyword'])){
		$keyword =$_GET['keyword'];
	}

	if(isset($_GET['radius'])){
		$radius =$_GET['radius'];
	}

	if(isset($_GET['choice'])){
		$choice =$_GET['choice'];

		if ($choice == "music"){
			$mySegmentId = "KZFzniwnSyZfZ7v7nJ";
		}
		elseif ($choice == "sports") {
			$mySegmentId = "KZFzniwnSyZfZ7v7nE";
		}
		elseif ($choice == "arts&theatre") {
			$mySegmentId = "KZFzniwnSyZfZ7v7na";
		}
		elseif ($choice == "film") {
			$mySegmentId = "KZFzniwnSyZfZ7v7nn";
		}
		elseif ($choice == "miscellaneous"){
			$mySegmentId = "KZFzniwnSyZfZ7v7n1";
		}
		else{
			$mySegmentId ="";
		}
	}

	if ($mySegmentId == null){
 		$ticketResponse = file_get_contents('https://app.ticketmaster.com/discovery/v2/events.json?apikey=TFJrOcWBZ1vKZC0LCcBXTiJYvAEjU55m&keyword='.$keyword.'&segmentId&radius='.$radius.'&unit=miles&geoPoint='.$geoPoint);
 	}
 	else{
 		$ticketResponse = file_get_contents('https://app.ticketmaster.com/discovery/v2/events.json?apikey=TFJrOcWBZ1vKZC0LCcBXTiJYvAEjU55m&keyword='.$keyword.'&segmentId='.$mySegmentId.'&radius='.$radius.'&unit=miles&geoPoint='.$geoPoint);
 	}

echo $ticketResponse;
return;
}

// ticketmaster API call for user using the default location
elseif(isset($_GET['lat'])){
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$geoPoint = encode($lat, $lon);

	if(isset($_GET['keyword'])){
		$keyword =$_GET['keyword'];
	}

	if(isset($_GET['radius'])){
		$radius =$_GET['radius'];
	}

	if(isset($_GET['choice'])){
		$choice =$_GET['choice'];

		if ($choice == "music"){
			$mySegmentId = "KZFzniwnSyZfZ7v7nJ";
		}
		elseif ($choice == "sports") {
			$mySegmentId = "KZFzniwnSyZfZ7v7nE";
		}
		elseif ($choice == "arts&theatre") {
			$mySegmentId = "KZFzniwnSyZfZ7v7na";
		}
		elseif ($choice == "film") {
			$mySegmentId = "KZFzniwnSyZfZ7v7nn";
		}
		elseif ($choice == "miscellaneous"){
			$mySegmentId = "KZFzniwnSyZfZ7v7n1";
		}
		else{
			$mySegmentId ="";
		}
	}

	if ($mySegmentId == null){
 		$ticketResponse = file_get_contents('https://app.ticketmaster.com/discovery/v2/events.json?apikey=TFJrOcWBZ1vKZC0LCcBXTiJYvAEjU55m&keyword='.$keyword.'&segmentId&radius='.$radius.'&unit=miles&geoPoint='.$geoPoint);
 	}
 	else{
 		$ticketResponse = file_get_contents('https://app.ticketmaster.com/discovery/v2/events.json?apikey=TFJrOcWBZ1vKZC0LCcBXTiJYvAEjU55m&keyword='.$keyword.'&segmentId='.$mySegmentId.'&radius='.$radius.'&unit=miles&geoPoint='.$geoPoint);
 	}

echo $ticketResponse;
return;
}

// event detail API call
elseif(isset($_GET['eventId'])){
	$eventId = $_GET['eventId'];
	$evetnDetailsResponse = file_get_contents('https://app.ticketmaster.com/discovery/v2/events/'.$eventId.'?apikey=TFJrOcWBZ1vKZC0LCcBXTiJYvAEjU55m');
	echo $evetnDetailsResponse;
	return;
}

// venue detail API call
elseif(isset($_GET['venueName'])){
	$venueName = $_GET['venueName'];
	$venueDetailsResponse = file_get_contents('https://app.ticketmaster.com/discovery/v2/venues?apikey=TFJrOcWBZ1vKZC0LCcBXTiJYvAEjU55m&keyword='.$venueName);
	echo $venueDetailsResponse;
	return;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="author" content="Shuai Xiao">
	<meta name="description" content="CSCI571 HW6">
	
	<style type="text/css">

		.main{
			width: 1200px;
			margin: auto;
		}

		.formcontainer{
			position: relative;
			left: 28%;
		}

		fieldset{
			height: 160px;
			width: 480px;
			border: 3px solid;
			border-color: rgb(204,204,204);
			background-color: rgb(248,248,248);
		}

		hr{
			border: 0 none;
			height: 2px;
			background-color: rgb(225,225,225);
		}

		img{
			width: 70%;
			height:50px;
		}

		table{
			border-style: solid;
			border-color: rgb(230,230,230);
		}
		td{
			border:1px solid;
			border-color: rgb(230,230,230);
		}

		#head {
			font-size: 32px;
			margin-top: -3px;
			margin-bottom: 5px;
			text-align: center;
		}
		.loccontainner{
			margin-left: 285px;
		}

		.buttoncontainer{
			margin-left: 60px;
		}

		#searchContainer{
			margin-top: 30px;
			z-index: 2;
		}

		.clickMe{
			cursor: pointer;
		}

		#detailHeader{
			font-size: 20px;
		}

		#eventInfoBox{
			position: relative;
			left: 200px;
			
		}

		#eventInfoBoxWithoutImg{
			position: relative;
			left: 542px;
		}

		#eventInfoBox p{
			font-size: 18px;
		}

		a{
			text-decoration: none;
			color: black;
		}

		#seatImg{
			float: right;
			position: relative;
			right: 366px;
			width: 500px;
			height: 300px;

		}

		#venueInfo{
			color: rgb(191,191,191);
		}

		#venuePhotos{
			color: rgb(191,191,191);
		}

		#arrowDown1{
			margin-left: 580px;
			width: 40px;
			height: 20px;
		}

		#arrowDown2{
			margin-left: 580px;
			width: 40px;
			height: 20px;
		}

		#venueTable{
			position: relative;
			left: 150px;
			width: 900px;
		}

		#photoTable{
			position: relative;
			left: 150px;
			width: 900px;
		}

		#photoTable img{
			width: 80%;
			height: 300px;
		}

		#map{
			margin-top: -200px;
			position: relative;
			width: 300px;
			height: 200px;
			display:none;
		}

	</style>


</head>

<body onload="init()">
	<div class = "main">
		<div class="formcontainer">
			<form id="myform" action="/event.php" method="POST">
				<fieldset>
					<p id = "head"><i>Event Search</i></p>
					<hr>
					<b>Keyword</b>
					<input id="keyword" type="text" name="keyword" required><br>
					<b>Category</b>
					<select id="category" name="category">
						<option value="default">Default</option>
						<option value="music">Music</option>
						<option value="sports">Sports</option>
						<option value="arts&theatre">Arts & Theatre</option>
						<option value="film">Film</option>
						<option value="miscellaneous">Miscellaneous</option>
					</select><br>
					<b>Distance(miles)</b>
					<input id="distance" type="text" name="distance" placeholder="10"><b>from</b>
					<input type="radio" id="here" name="loc" value="here" checked="checked" onclick="makeRequired()">
					<label for="here">Here</label><br>
					<input id = "hidelat" type="hidden" name="herelat" value="">
					<input id = "hidelon" type="hidden" name="herelon" value="">
					<input id = "hiddenVenue" type = "hidden" name="hiddenVenue" value="">
					<input id = "hiddenLat" type = "hidden" name="hiddenLat" value="">
					<input id = "hiddenLon" type = "hidden" name="hiddenLon" value="">
					<input id = "hiddenVenuePhoto" type = "hidden" name="hiddenVenuePhoto" value="">
					<div class="loccontainner">
						<input type="radio" id="loccheck" name="loc" value="loc" onclick="makeRequired()">
						<input type="text" id="locname" name="locname" placeholder="location">
						<br>
					</div>
					<div class="buttoncontainer">
						<input type="submit" id = "search" name="search" value="Search">
						<input type="submit" name="clear" value="Clear" onclick="clearAll()">
					</div>
				</fieldset>
			</form>
		</div>

		<div id="map">
			<p>Walk there</p><br>
			<p>Bike there</p><br>
			<p>Drive there</p>
		</div>
		<div id="searchContainer">
		</div>
	</div>


</body>

	<script type="text/javascript">

		// variables for default lat and lon
		var currentLat;
		var currentLon;

		var eventLength; // store the number of events 
		var searchButton = document.getElementById("search");

		// initial setup when users just open the page
		function init(){
			var xmlhttp = new XMLHttpRequest(); // a xmlrequest for getting user current location

			xmlhttp.open("GET", "http://ip-api.com/json", false);
			xmlhttp.send(null);

			var jsonObj = JSON.parse(xmlhttp.responseText);

			currentLat = jsonObj.lat;
			currentLon = jsonObj.lon;

			// able the search button if we get latitude or longitude
			if(currentLat == null || currentLon == null || currentLat == undefined || currentLon == undefined){		
				searchButton.disabled = true;
			}
			else{
				searchButton.disabled = false;
				document.getElementById("hidelat").value = currentLat;
				document.getElementById("hidelon").value = currentLon;
			}

			if(document.getElementById("here").checked){
				document.getElementById("locname").disabled = true;
			}
		}

		// function to make location text required if location radio button is selected
		function makeRequired(){
			document.getElementById("locname").required = document.getElementById("loccheck").checked;
			document.getElementById("locname").disabled = document.getElementById("here").checked;
		}

		// initialize google map
		function initMap(){
			var directionsService = new google.maps.DirectionsService();
  			var directionsDisplay = new google.maps.DirectionsRenderer();
			if(document.getElementById('map') != null || document.getElementById("hiddenLat").value != null || document.getElementById("hiddenLat").value !=undefined){
				var curLat = parseFloat(document.getElementById("hiddenLat").value);
				var curLon = parseFloat(document.getElementById("hiddenLon").value);
				var directionsService = new google.maps.DirectionsService();
				var directionsDisplay = new google.maps.DirectionsRenderer();
				var pinpoint = new google.maps.LatLng(curLat, curLon);
				var map = new google.maps.Map(document.getElementById('map'), {zoom: 4, center: pinpoint});
				var marker =  new google.maps.Marker({position: pinpoint, map: map});
			}

		}


		// show google map when users click the venue
		function showMap(id){
			var map = document.getElementById('map');
			initMap();
			venueId = "positionMap" + id;
			var cur = document.getElementById(venueId);
			if(cur != null){
				var rect = cur.getBoundingClientRect();
				var mapLeft = rect.left + "px";
				var adjustTop = rect.top + 30;
				var mapTop =  adjustTop + "px";

				if(map.style.display == "" || map.style.display =="none"){
					map.style.left = mapLeft;
					map.style.top = mapTop;
					map.style.display = "block";
				}
				else{
					map.style.display = "none";
				}
			}

			else{
				var newCur = document.getElementById("arrowDown1");
				var rect = newCur.getBoundingClientRect();
				var positionLeft = rect.left - 50;
				var mapLeft = positionLeft + "px";
				var positionTop = rect.top + 300;
				var mapTop = positionTop + "px"; 

				if(map.style.display == "" || map.style.display =="none"){
					map.style.left = mapLeft;
					map.style.top = mapTop;
					map.style.display = "block";
				}
				else{
					map.style.display = "none";
				}
			}

		}

		//create venueInfo table
		function createVenueInfoTable(name, lat, lon, address, city, postcode, url){
			document.getElementById("hiddenLat").value = lat;
			document.getElementById("hiddenLon").value = lon;

			if(document.getElementById("venueContainer") != null){
				var venueContainer = document.getElementById("venueContainer");

				if(document.getElementById("arrowDown1") != null){
					if(document.getElementById("arrowDown1").src == 'http://csci571.com/hw/hw6/images/arrow_down.png'){
						venueContainer.style.display = "block";
						document.getElementById("arrowDown1").src = 'http://csci571.com/hw/hw6/images/arrow_up.png';
						document.getElementById("venueInfo").innerHTML = "click to hide venue info";
					}
					else{
						venueContainer.style.display = "none";
						document.getElementById("arrowDown1").src = 'http://csci571.com/hw/hw6/images/arrow_down.png';
						document.getElementById("venueInfo").innerHTML = "click to show venue info";
					}
				}

				// if there isn't anything show no info
				if(name == null && lat == null && lon == null && address == null && postcode == null && url == null){
					var text = '<table id = "venueTable" border=1 width=100% cellpadding=0 cellspacing=0><tr><td align = "center"><b>No Venue Info Found</b></td></tr></table>';
				}
				else if(name != null && lat == null && lon == null && address == null && postcode == null && url == null){
					var text = '<table id = "venueTable" border=1 width=100% cellpadding=0 cellspacing=0><tr><td align = "right" width = "20%"><b>Name</b></td><td align = "center">';
					text += name;
					text += '</td></tr>';
					text += '<tr><td align = "right"><b>Upcoming Events</b></td><td align = "center">';
					text += '<a href = "';
					text += url;
					text += '">'
					text += name;
					text += 'Tickets';
					text += '</a>';
					text += '</td></tr>';
					text += '</table>';
				}
				else{
					var text = '<table id = "venueTable" border=1 width=100% cellpadding=0 cellspacing=0><tr><td align = "right" width = "20%"><b>Name</b></td><td align = "center">';
					text += name;
					text += '</td></tr>';
					text += '<tr><td align = "right"><b>Map</b></td><td align = "center">Walk there<br>Bike there<br>Drive there';
					text += '</td></tr>';
					text += '<tr><td align = "right"><b>Address</b></td><td align = "center">';
					text += address;
					text += '</td></tr>';
					text += '<tr><td align = "right"><b>City</b></td><td align = "center">';
					text += city;
					text += '</td></tr>';
					text += '<tr><td align = "right"><b>Postal Code</b></td><td align = "center">';
					text += postcode;
					text += '</td></tr>';
					text += '<tr><td align = "right"><b>Upcoming Events</b></td><td align = "center">';
					text += '<a href = "';
					text += url;
					text += '">'
					text += name;
					text += 'Tickets';
					text += '</a>';
					text += '</td></tr>';
					text += '</table>';
				}

				venueContainer.innerHTML = text;
			}
		}

		// function to create venue photo
		function createVenuePhoto(photo){
			if(document.getElementById("photoContainer") != null){
				var photoContainer = document.getElementById("photoContainer");

				if(document.getElementById("arrowDown2") != null){
					if(document.getElementById("arrowDown2").src == 'http://csci571.com/hw/hw6/images/arrow_down.png'){
						photoContainer.style.display = "block";
						document.getElementById("arrowDown2").src = 'http://csci571.com/hw/hw6/images/arrow_up.png';
						document.getElementById("venuePhotos").innerHTML = "click to hide venue info";
					}
					else{
						photoContainer.style.display = "none";
						document.getElementById("arrowDown2").src = 'http://csci571.com/hw/hw6/images/arrow_down.png';
						document.getElementById("venuePhotos").innerHTML = "click to show venue info";
					}
				}

				if(photo == null){
					var text = '<table id = "photoTable" border=1 width=100% cellpadding=0 cellspacing=0><tr><td align = "center"><b>No Venue Photos Found</b></td></tr></table>';
				}
				else{
					var text = '<table id = "photoTable" border=1 width=100% cellpadding=0 cellspacing=0><tr><td align = "center">';

					for(var i = 0; i < photo.length; i++){
						text += '<img src ="';
						text += photo[i];
						text += '">';
						text += '</td></tr>'
					}
					text += '</table>';
				}

				photoContainer.innerHTML = text;

			}
		}

		// function for getting venue info
		function getVenueInfo(){
			var venueNameStr = document.getElementById("hiddenVenue").value;
			venueNameStr = venueNameStr.replace(/\s/g, "%");
			var url = 'http://localhost/callTest.php?venueName=';
			url += venueNameStr;
			var venueRequest = new XMLHttpRequest();
			venueRequest.open("GET", url, false);
			venueRequest.send();
			var venueDetails = venueRequest.responseText;
			var venueObj = JSON.parse(venueDetails);
			if(venueObj._embedded != null && venueObj._embedded.venues[0] != null){
				var venueName = venueObj._embedded.venues[0].name;
			}
			var venueName;
			if(venueObj._embedded != null && venueObj._embedded.venues[0] != null){
				venueName = venueObj._embedded.venues[0].name;
				var venueLat = venueObj._embedded.venues[0].location.latitude;
				var venueLon = venueObj._embedded.venues[0].location.longitude;
				var venueAddress = venueObj._embedded.venues[0].address.line1;
				var venueCity = venueObj._embedded.venues[0].city.name;
				var postcode = venueObj._embedded.venues[0].postalCode;
				var venueUrl = venueObj._embedded.venues[0].url;
			}

			createVenueInfoTable(venueName, venueLat, venueLon, venueAddress, venueCity, postcode, venueUrl);
			showMap();
		}

		function getVenuePhoto(){
			var venueNameStr = document.getElementById("hiddenVenue").value;
			venueNameStr = venueNameStr.replace(/\s/g, "%");
			var url = 'http://localhost/callTest.php?venueName=';
			url += venueNameStr;
			var venueRequest = new XMLHttpRequest();
			venueRequest.open("GET", url, false);
			venueRequest.send();
			var venueDetails = venueRequest.responseText;
			var venueObj = JSON.parse(venueDetails);

			var venuePhotos = [];
			if(venueObj._embedded != null && venueObj._embedded.venues[0] != null){
				var photoNumber = venueObj._embedded.venues[0].images.length;
				for (var i =0; i < photoNumber; i++){
					var venuePhoto = venueObj._embedded.venues[0].images[i].url;
					venuePhotos.push(venuePhoto);
				}
			}

			createVenuePhoto(venuePhotos);

		}

		// function for showing event details
		function createEventDetailsContent(eventName, dateTime, performer,performerUrl, performer2, performerUrl2, venue, genres, priceRange, ticketStatus, buyFrom, seatMap){
			var container = document.getElementById("searchContainer");
			var detailText = '<p id = "detailHeader" align = "center"><b>';
			document.getElementById("hiddenVenue").value = venue;

			detailText += eventName;
			detailText += '</b></p>';
			
			if(seatMap!= null){
				detailText += '<div id = "eventInfoBox">';
				detailText += '<img id = "seatImg" src="';
				detailText += seatMap;
				detailText += '">';
				detailText += '<b>Date</b><br>';
				detailText += dateTime;
				if(performer != null){
					detailText += '<br><br><b>Artist/Team</b><br>';
					detailText += '<a href="';
					detailText += performerUrl;
					detailText += '" target="_blank">';
					detailText += performer;
					detailText += '</a>';
					if(performer2 != null){
						detailText += ' | ';
						detailText += '<a href="';
						detailText += performerUrl2;
						detailText += '" target="_blank">';
						detailText += performer2;
						detailText += '</a>';
					}
				}
				if(venue != null){
					detailText += '<br><br><b>Venue</b><br>';
					detailText += venue;
				}
				if(genres != null){
					detailText += '<br><br><b>Genres</b><br>';
					detailText += genres;
				}
				if(priceRange != null){
					detailText += '<br><br><b>Price Ranges</b><br>';
					detailText += priceRange;
				}
				if(ticketStatus != null){
					detailText += '<br><br><b>Ticket Status</b><br>';
					detailText += ticketStatus;
				}
				detailText += '<br><br><b>Buy Ticket At:</b><br>';
				detailText += '<a href="';
				detailText += buyFrom;
				detailText += '" target="_blank">';
				detailText += 'Ticketmaster';
				detailText += '</a>';
				detailText += '</div>';

				detailText += '<div id="venueSegment">';
				detailText += '<p id = "venueInfo" align = "center">click to show venue info</p>';
				detailText += '<img id="arrowDown1" src="http://csci571.com/hw/hw6/images/arrow_down.png" onclick="getVenueInfo()">';
				detailText += '<div id = "venueContainer"></div>';
				detailText += '<p id = "venuePhotos" align = "center">click to show venue photos</p>';
				detailText += '<img id="arrowDown2" src="http://csci571.com/hw/hw6/images/arrow_down.png" onclick="getVenuePhoto()">';
				detailText += '<div id = "photoContainer"></div>';
				detailText += '</div>';
				
				container.innerHTML = detailText;
			}

			else{
				detailText += '<div id = "eventInfoBoxWithoutImg">';
				detailText += '<b>Date</b><br>';
				detailText += dateTime;
				if(performer != null){
					detailText += '<br><br><b>Artist/Team</b><br>';
					detailText += performer;
				}
				if(venue != null){
					detailText += '<br><br><b>Venue</b><br>';
					detailText += venue;
				}
				if(genres != null){
					detailText += '<br><br><b>Genres</b><br>';
					detailText += genres;
				}
				if(priceRange != null){
					detailText += '<br><br><b>Price Ranges</b><br>';
					detailText += priceRange;
				}
				if(ticketStatus != null){
					detailText += '<br><br><b>Ticket Status</b><br>';
					detailText += ticketStatus;
				}
				detailText += '<br><br><b>Buy Ticket At:</b><br>';
				detailText += '<a href="';
				detailText += buyFrom;
				detailText += '" target="_blank">';
				detailText += 'Ticketmaster';
				detailText += '</a>';
				detailText += '</div>';

				detailText += '<div id="venueSegment">';
				detailText += '<p id="venueInfo" align = "center">click to show venue info</p>';
				detailText += '<img id="arrowDown1" src="http://csci571.com/hw/hw6/images/arrow_down.png" onclick="getVenueInfo()">';
				detailText += '<p id = "venuePhotos" align = "center">click to show venue photos</p>';
				detailText += '<img id="arrowDown2" src="http://csci571.com/hw/hw6/images/arrow_down.png" onclick="getVenuePhoto()">';
				detailText += '</div>';

				container.innerHTML = detailText;
			}
			
		}

		function getEventDetails(i){
			var eventIdNumber = "event" + i;
			var eventIdSend = document.getElementById(eventIdNumber).innerHTML;
			var url = 'http://localhost/callTest.php?eventId=';
			url += eventIdSend;
			var request = new XMLHttpRequest();
			request.open("GET", url, false);
			request.send();
			var eventDetails = request.responseText;
			// console.log(eventDetails);
			var eventDetailsObj = JSON.parse(eventDetails);

			var eventName = eventDetailsObj.name; // get event name

			// date and time
			var dateTime;
			var ticketStatus;
			if(eventDetailsObj.dates != null){
				var date = eventDetailsObj.dates.start.localDate;
				ticketStatus = eventDetailsObj.dates.status.code;
				if(eventDetailsObj.dates.start.localTime != "Undefined"){
				
				var time = eventDetailsObj.dates.start.localTime;
				dateTime = date +' '+ time;
				}
				else{
					dateTime = date;
				}
			}
			
			// performer
			var performer;
			var performer2;
			var performerUrl;
			var performerUrl2;
			if(eventDetailsObj._embedded.attractions != null && eventDetailsObj._embedded.attractions[0] != null){
				performer = eventDetailsObj._embedded.attractions[0].name;
				performerUrl = eventDetailsObj._embedded.attractions[0].url;
			}
			if(eventDetailsObj._embedded.attractions != null && eventDetailsObj._embedded.attractions[1] != null){
				performer2 = eventDetailsObj._embedded.attractions[1].name;
				performerUrl2 = eventDetailsObj._embedded.attractions[1].url;
			}

			var venue;
			if(eventDetailsObj._embedded.venues != null && eventDetailsObj._embedded.venues[0] != null){
				venue = eventDetailsObj._embedded.venues[0].name;
			}
			
			var genresInfo;
			if(eventDetailsObj.classifications != null && eventDetailsObj.classifications[0] != null){
				genresInfo = eventDetailsObj.classifications[0].segment.name;
				genresInfo += '|';
				genresInfo += eventDetailsObj.classifications[0].genre.name;
				if(eventDetailsObj.classifications[0].subGenre.name != "Undefined"){
					genresInfo += '|';
					genresInfo += eventDetailsObj.classifications[0].subGenre.name;
				}
				if(eventDetailsObj.classifications[0].type.name != "Undefined"){
					genresInfo += '|';
					genresInfo += eventDetailsObj.classifications[0].type.name;
				}
				if(eventDetailsObj.classifications[0].subType.name != "Undefined"){
					genresInfo += '|';
					genresInfo += eventDetailsObj.classifications[0].subType.name;
				}
			}


			var priceRange;
			if(eventDetailsObj.priceRanges != null && eventDetailsObj.priceRanges[0].min != "Undefined"){
				if(eventDetailsObj.priceRanges[0].max != "Undefined"){
					priceRange = eventDetailsObj.priceRanges[0].min;
					priceRange += '-';
					priceRange += eventDetailsObj.priceRanges[0].max;
				}
				else{
					priceRange = '(Min_price)';
					priceRange += priceRanges[0].min;
				}
			}
			else{
				if(eventDetailsObj.priceRanges != null && eventDetailsObj.priceRanges[0].max != "Undefined"){
					priceRange = '(Max_price)';
					priceRange += eventDetailsObj.priceRanges[0].max;
				}
				else{
					priceRange = null;
				}
			}

			var buyFrom;
			if(eventDetailsObj._embedded.attractions != null){
				buyFrom = eventDetailsObj._embedded.attractions[0].url;
			}
			
			var seatMap;
			if(eventDetailsObj.seatmap != null && eventDetailsObj.seatmap.staticUrl != null){
				seatMap = eventDetailsObj.seatmap.staticUrl;
			}

			createEventDetailsContent(eventName, dateTime, performer, performerUrl, performer2, performerUrl2, venue, genresInfo, priceRange, ticketStatus, buyFrom, seatMap);
		}

		// function to generate a table based on json file
		function generateTable(dateArr, timeArr, iconArr, eventArr, genreArr, venueArr, idArr, latArr, lonArr){
			var container = document.getElementById("searchContainer");

			var text = '<table border=1 width=100% cellpadding=0 cellspacing=0><tr><td width=10% align = "center"><b>Date</b></td><td width=15% align = "center"><b>Icon</b></td><td width = 40% align = "center"><b>Event</b></td><td width = 5% align = "center"><b>Genre</b></td><td width=30% align = "center"><b>Venue</b></td><tr>';
			for(var i = 0; i < eventArr.length; i++){
				text += '<tr>';
				document.getElementById("hiddenLat").value = latArr[i];
				document.getElementById("hiddenLon").value = lonArr[i];
				// console.log("first change" + document.getElementById("hiddenLat").value);

				for(var j = 0; j < 5; j++){

					//text += 'test';
					if(j == 0){
						text += '<td>';
						text += dateArr[i];
						text += '\n';
						if(timeArr[i] != undefined){
							text += timeArr[i];
						}
						
					}
					else if(j == 1){
						text += '<td align = "center">';
						if(iconArr[i] == undefined){
							text += 'N/A';
						}
						else{text += iconArr[i];}
					}
					else if(j == 2){
						text += '<td>';
						text += '<p hidden id="event';
						text += i;
						text += '">';
						text += idArr[i];
						text += '</p>';
						text += '<p class = "clickMe" onclick="getEventDetails('
						text += i
						text += ')">'
						text += eventArr[i];
						text += '</p>';
					}
					else if(j == 3){
						text += '<td>';
						if(genreArr[i] == undefined){
							text += 'N/A';
						}
						else{text += genreArr[i];}
					}
					else if(j == 4){
						text += '<td>';
						if(venueArr[i] == undefined){
							text += 'N/A';
						}
						else{
							text += '<span id = "positionMap';
							text += i;
							text += '" onclick = "showMap('
							text += i;
							text += ')">';
							text += venueArr[i];
							text += '</span>';
						}
					}
					text += '</td>';
				}

				text += '</tr>';
			}
			text += '</table>';
			//console.log(text);
			container.innerHTML = text;
		}

		// function to send user input to and get ticketmaster json back from the server
		function searchEvent(){

			document.getElementById("keyword").required;
			var eventArr;
			var noEvent;
			var userKeyword = document.getElementById("keyword").value;
			var selectionList = document.getElementById("category");
			var userSelection = selectionList.options[selectionList.selectedIndex].value;

			// deal with radius
			if(document.getElementById("distance").value == ""){
				var userRadius = 100; // default
			}
			else{var userRadius = document.getElementById("distance").value; }

			var request = new XMLHttpRequest();

			if(document.getElementById("loccheck").checked){
				var userLocation = document.getElementById("locname").value;
				//var inputGather = JSON.stringify({userKeyword,userSelection,userLocation,userRadius});
				request.open("GET", "http://localhost/callTest.php?keyword="+userKeyword+"&choice="+userSelection+"&userLocation="+userLocation+"&radius="+userRadius, false);
				request.send();
				var requestResponse = request.responseText;
				var responseObj = JSON.parse(requestResponse);
				noEvent = responseObj._embedded;

				if(noEvent == null){
					var searchContainer = document.getElementById("searchContainer");
					var noRecordText = '<table border=1 width=100% cellpadding=0 cellspacing=0><tr bgcolor="#D3D3D3"><td align = "center">No Records has been found</td></tr></table>';
					searchContainer.innerHTML = noRecordText;
				}

				else{
					eventArr = responseObj._embedded.events;
					eventLength = eventArr.length;
				}
			}
			
			// use the lat and lon from ip api directly
			else{
				var userLat = currentLat;
			 	var userLon = currentLon;

				request.open("GET", "http://localhost/callTest.php?keyword="+userKeyword+"&choice="+userSelection+"&lat="+userLat+"&lon="+userLon+"&radius="+userRadius, false);

				request.send();
				var requestResponse = request.responseText;
				var responseObj = JSON.parse(requestResponse);
				noEvent = responseObj._embedded;
				if(noEvent == null){
					var searchContainer = document.getElementById("searchContainer");
					var noRecordText = '<table border=1 width=100% cellpadding=0 cellspacing=0><tr bgcolor="#D3D3D3"><td align = "center">No Records has been found</td></tr></table>';
					searchContainer.innerHTML = noRecordText;
				}
				else{
					eventArr = responseObj._embedded.events;
					eventLength = eventArr.length;
				}
			}

			if(noEvent != null){
				var eventIconArr = [];
				var eventLocalDateArr = [];
				var eventLocalTimeArr = [];
				var eventNameArr = [];
				var eventGenreArr = [];
				var eventVenueArr = [];
				var eventIdArr = [];
				var latArr = [];
				var lonArr = [];

				for (var i = 0; i < eventLength; i++){
					var eventId = eventArr[i].id;
					eventIdArr.push(eventId);
					var eventName = eventArr[i].name;
					eventNameArr.push(eventName);
					var eventLocalDate = eventArr[i].dates.start.localDate;
					eventLocalDateArr.push(eventLocalDate);

					if(eventArr[i].dates.start.localTime != undefined){
						var eventLocalTime = eventArr[i].dates.start.localTime;
						eventLocalTimeArr.push(eventLocalTime);
					}
					if(eventArr[i].images != undefined && eventArr[i].images[0] != undefined){
						var eventIcon = '<img src="'+ eventArr[i].images[0].url + '">';
						eventIconArr.push(eventIcon);
					}
					if(eventArr[i].classifications != undefined){
						var eventGenre = eventArr[i].classifications[0].segment.name;
						eventGenreArr.push(eventGenre);
					}
					if(eventArr[i]._embedded.venues != undefined){
						var eventVenue = eventArr[i]._embedded.venues[0].name;
						eventVenueArr.push(eventVenue);
						var latNumber = eventArr[i]._embedded.venues[0].location.latitude;
						latArr.push(latNumber);
						var lonNumber = eventArr[i]._embedded.venues[0].location.longitude;
						lonArr.push(lonNumber);
					}				
				}

				generateTable(eventLocalDateArr,eventLocalTimeArr, eventIconArr, eventNameArr, eventGenreArr, eventVenueArr, eventIdArr, latArr, lonArr);

			}
		}

		// function for the clear button
		function clearAll(){
			document.getElementById("keyword").required = false;
			document.getElementById("locname").required = false;
			document.getElementById("myform").reset();
			//resultTable.style.display = "none";
		}

		searchButton.addEventListener("click",function(event){
			searchEvent();
			event.preventDefault();
			event.stopPropagation();
		});

	</script>

	<script async defer src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDMiwLQglmBWZsPWiTPavsvJgtc_pJdgdQ&callback=initMap"></script>
</html>