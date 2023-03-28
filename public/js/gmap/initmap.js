function initMap() {
	// Part 1. create a new map with initial center and zoom level
	var map = new google.maps.Map(document.getElementById("myMap"), {
		center: { lat: -2.5489, lng: 118.0149 },
		zoom: 5,
	});

	// an array to store the markers
	var markers = [];

	// Part 2. create a drawing manager with a marker and polygon mode and add it to the map
	var drawingManager = new google.maps.drawing.DrawingManager({
		drawingMode: google.maps.drawing.OverlayType.MARKER,
		drawingControl: true,
		drawingControlOptions: {
			position: google.maps.ControlPosition.TOP_CENTER,
			drawingModes: ["marker", "polygon"],
		},
		polygonOptions: {
			fillColor: "#fd3995",
			strokeColor: "#fd3995",
			strokeWeight: 2,
			fillOpacity: 0.5,
			editable: true,
			draggable: true,
		},
	});
	drawingManager.setMap(map);

	// Part 3. add a listener for when a marker is completed
	google.maps.event.addListener(
		drawingManager,
		"markercomplete",
		function (marker) {
			// 3.a add the marker to the array of markers and make it draggable
			markers.push(marker);
			marker.setDraggable(true);
			// 3.b add a listener for when the marker is clicked, center the map on the marker, and update the input fields
			google.maps.event.addListener(marker, "click", function () {
				map.setCenter(marker.getPosition());
				document.getElementById("latitude").value = marker.getPosition().lat();
				document.getElementById("longitude").value = marker.getPosition().lng();
			});
			// 3.c add a listener for when the marker is dragged, update the input fields
			google.maps.event.addListener(marker, "drag", function () {
				document.getElementById("latitude").value = marker.getPosition().lat();
				document.getElementById("longitude").value = marker.getPosition().lng();
			});
		}
	);

	// Part 4. check if the latitude and longitude inputs have values, and if so, create a marker at that position
	var latitude = document.getElementById("latitude").value;
	var longitude = document.getElementById("longitude").value;
	if (latitude != "" && longitude != "") {
		var position = new google.maps.LatLng(latitude, longitude);
		var marker = new google.maps.Marker({
			position: position,
			map: map,
			draggable: true,
		});
		// Part 4.a add the marker to the array of markers, center the map on the marker, and add listeners for click and drag events
		markers.push(marker);
		map.setCenter(position);
		map.setZoom(18);
		google.maps.event.addListener(marker, "click", function () {
			map.setCenter(marker.getPosition());
		});
		google.maps.event.addListener(marker, "drag", function () {
			document.getElementById("latitude").value = marker.getPosition().lat();
			document.getElementById("longitude").value = marker.getPosition().lng();
		});
	}

	// check if the polygon inputs have values, and if so, create a polygon using the recorded value in polygon input fields
	var polygonCoords = document.getElementById("polygon").value;
	if (polygonCoords != "") {
		polygonCoords = JSON.parse(polygonCoords);
		var polygon = new google.maps.Polygon({
			paths: polygonCoords,
			strokeColor: "#FF0000",
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: "#FF0000",
			fillOpacity: 0.35,
			editable: true,
			map: map,
		});
		// Part 5.b add a listener for when the polygon is clicked, and update the input field
		google.maps.event.addListener(polygon, "click", function () {
			document.getElementById("polygon").value = JSON.stringify(
				polygon.getPath().getArray()
			);
		});
		// Part 5.c add a listener for when the polygon is edited, and update the input field
		google.maps.event.addListener(polygon.getPath(), "set_at", function () {
			document.getElementById("polygon").value = JSON.stringify(
				polygon.getPath().getArray()
			);
		});
		google.maps.event.addListener(polygon.getPath(), "insert_at", function () {
			document.getElementById("polygon").value = JSON.stringify(
				polygon.getPath().getArray()
			);
		});
	}

	// Part 5. add a listener for when a polygon is completed
	google.maps.event.addListener(
		drawingManager,
		"polygoncomplete",
		function (polygon) {
			// 5.a add the polygon to the map
			polygon.setMap(map);

			// 5.b add a listener for when the polygon is clicked, and update the input field
			google.maps.event.addListener(polygon, "click", function () {
				document.getElementById("polygon").value = JSON.stringify(
					polygon.getPath().getArray()
				);
			});

			// 5.c add a listener for when the polygon is edited, and update the input field
			google.maps.event.addListener(polygon.getPath(), "set_at", function () {
				document.getElementById("polygon").value = JSON.stringify(
					polygon.getPath().getArray()
				);
			});
			google.maps.event.addListener(
				polygon.getPath(),
				"insert_at",
				function () {
					document.getElementById("polygon").value = JSON.stringify(
						polygon.getPath().getArray()
					);
				}
			);
		}
	);

	// Part 5.a add a listener for when a polygon is completed
	google.maps.event.addListener(
		drawingManager,
		"polygoncomplete",
		function (polygon) {
			// 5.a add the polygon to the map
			polygon.setMap(map);

			// 5.b add a listener for when the polygon is clicked, and update the input field
			google.maps.event.addListener(polygon, "click", function () {
				document.getElementById("polygon").value = JSON.stringify(
					polygon.getPath().getArray()
				);

				// calculate and display the area of the polygon
				var luas = google.maps.geometry.spherical.computeArea(
					polygon.getPath()
				);
				document.getElementById("luas_kira").value = luas.toFixed(2);
			});

			// 5.c add a listener for when the polygon is edited, and update the input field
			google.maps.event.addListener(polygon.getPath(), "set_at", function () {
				document.getElementById("polygon").value = JSON.stringify(
					polygon.getPath().getArray()
				);

				// calculate and display the area of the polygon
				var luas = google.maps.geometry.spherical.computeArea(
					polygon.getPath()
				);
				document.getElementById("luas_kira").value = luas.toFixed(2);
			});

			google.maps.event.addListener(
				polygon.getPath(),
				"insert_at",
				function () {
					document.getElementById("polygon").value = JSON.stringify(
						polygon.getPath().getArray()
					);

					// calculate and display the area of the polygon
					var luas = google.maps.geometry.spherical.computeArea(
						polygon.getPath()
					);
					document.getElementById("luas_kira").value = luas.toFixed(2);
				}
			);
		}
	);
}
