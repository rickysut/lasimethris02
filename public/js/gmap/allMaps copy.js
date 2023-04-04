var map;

function initMap() {
	map = new google.maps.Map(document.getElementById("allMap"), {
		center: { lat: -2.548926, lng: 118.014863 },
		zoom: 5,
		mapTypeId: google.maps.MapTypeId.HYBRID,
	});

	// Make an Ajax request to retrieve the marker data and polygons
	$.ajax({
		url: "http://127.0.0.1:8000/api/getAPIAnggotaMitraAll", // this is local server
		type: "GET",
		dataType: "json",
		success: function (data) {
			console.log(data);

			// Loop through the marker data and add each marker to the map
			$.each(data, function (index, anggotaMitra) {
				if (anggotaMitra.latitude && anggotaMitra.longitude) {
					var marker = new google.maps.Marker({
						position: {
							lat: parseFloat(anggotaMitra.latitude),
							lng: parseFloat(anggotaMitra.longitude),
						},
						map: map,
					});

					// Add a click event listener to the marker to zoom in to its location
					marker.addListener("click", function () {
						map.setZoom(15);
						map.panTo(marker.getPosition());
					});
				}

				if (anggotaMitra.polygon) {
					var polygon = new google.maps.Polygon({
						paths: JSON.parse(anggotaMitra.polygon),
						strokeColor: "#FF0000",
						strokeOpacity: 0.8,
						strokeWeight: 2,
						fillColor: "#FF0000",
						fillOpacity: 0.35,
						map: map,
					});

					// Add a click event listener to the polygon to zoom in to its path
					polygon.addListener("click", function () {
						var bounds = new google.maps.LatLngBounds();
						polygon.getPath().forEach(function (latLng) {
							bounds.extend(latLng);
						});
						map.fitBounds(bounds);
					});
				}
			});
		},
	});
}

// Extend the Map object to add a getMarkers() method
google.maps.Map.prototype.getMarkers = function () {
	var markers = [];
	for (var i = 0; i < this.overlayMapTypes.length; i++) {
		var overlay = this.overlayMapTypes.getAt(i);
		if (overlay instanceof google.maps.Marker) {
			markers.push(overlay);
		} else if (overlay instanceof google.maps.Polygon) {
			// If the overlay is a polygon, iterate over its paths and add any markers to the list
			overlay.getPath().forEach(function (path) {
				if (path instanceof google.maps.Marker) {
					markers.push(path);
				}
			});
		}
	}
	return markers;
};

// Extend the Map object to add a

// Extend the Map object to add a getMarkers() method
google.maps.Map.prototype.getMarkers = function () {
	var markers = [];
	for (var i = 0; i < this.overlayMapTypes.length; i++) {
		var overlay = this.overlayMapTypes.getAt(i);
		if (overlay instanceof google.maps.Marker) {
			markers.push(overlay);
		} else if (overlay instanceof google.maps.Polygon) {
			// If the overlay is a polygon, iterate over its paths and add any markers to the list
			overlay.getPath().forEach(function (path) {
				if (path instanceof google.maps.Marker) {
					markers.push(path);
				}
			});
		}
	}
	return markers;
};

// Extend the Map object to add a getPolygons() method
google.maps.Map.prototype.getPolygons = function () {
	var polygons = [];
	for (var i = 0; i < this.overlayMapTypes.length; i++) {
		var overlay = this.overlayMapTypes.getAt(i);
		if (overlay instanceof google.maps.Polygon) {
			polygons.push(overlay);
		}
	}
	return polygons;
};
initMap();
