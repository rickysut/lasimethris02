// usermap.js
// let userMap;

function inituserMap() {
	//init the map viewport
	userMap = new google.maps.Map(document.getElementById("userMap"), {
		center: { lat: -2.5489, lng: 118.0149 },
		zoom: 5,
		mapTypeId: google.maps.MapTypeId.SATELLITE,
	});

	// 2. array to store the marker and polygon
	const usermarkers = [];
	// check if the latitude and longitude inputs have values, and if so, create a marker at that position
	var userlat = document.getElementById("userlat").value;
	var userlng = document.getElementById("userlng").value;
	if (userlat != "" && userlng != "") {
		var position = new google.maps.LatLng(userlat, userlng);
		var marker = new google.maps.Marker({
			position: position,
			map: userMap,
			draggable: false,
		});
		// add the marker to the array of markers, center the map on the marker, and add listeners for click events
		usermarkers.push(marker);
		userMap.setCenter(position);
		userMap.setZoom(18);
		google.maps.event.addListener(marker, "click", function () {
			userMap.setCenter(marker.getPosition());
		});
	}

	// 5. check if polygon has input value
	var userpolys = document.getElementById("userpoly").value;
	if (userpolys != "") {
		userpolys = JSON.parse(userpolys);
		var userpoly = new google.maps.Polygon({
			paths: userpolys,
			strokeColor: "#FF0000",
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: "#FF0000",
			fillOpacity: 0.35,
			editable: false,
			map: userMap,
		});
	}
}
