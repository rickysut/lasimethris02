// Define KML layer variable
let kmlLayer;

// Define function to load KML layer
function loadKmlLayer(kmlUrl) {
	// Remove previous KML layer if it exists
	if (kmlLayer) {
		kmlLayer.setMap(null);
	}

	// Create new KML layer
	kmlLayer = new google.maps.KmlLayer({
		url:
			"http://www.google.com/maps/d/u/0/kml?forcekml=1&mid=" +
			kmlUrl +
			"&time=" +
			new Date().getTime(),
		map: myMap,
	});
}

// Define form submission handler function
function handleFormSubmit(event) {
	event.preventDefault();
	const input = document.getElementById("kml-input");
	const kmlUrl = input.value;
	loadKmlLayer(kmlUrl);
}

// Add event listener to form
const form = document.getElementById("kml-form");
form.addEventListener("submit", handleFormSubmit);
