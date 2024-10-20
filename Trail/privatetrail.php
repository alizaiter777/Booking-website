<!DOCTYPE html>
<html>
<?php

require("Config.php");
?>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions Service</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            height: 100%;
            width: 100%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
        }

        #panel {
            padding: 10px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            min-width: 240px;
            z-index: 1000;
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            backdrop-filter: blur(10px);
        }

        .hstack {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
        }

        .input {
            flex-grow: 1;
            position: relative;
            margin-right: 8px;
        }

        .input input {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 12px;
        }

        .results {
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            max-height: 150px;
            overflow-y: auto;
            z-index: 1001;
            display: none;
        }

        .result-item {
            padding: 8px;
            cursor: pointer;
            font-size: 10px;
        }

        .result-item:hover {
            background-color: #f0f0f0;
        }

        .button-group {
            display: flex;
            gap: 8px;
        }

        .btn,
        .icon-button {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .btn {
            background-color: #ff69b4;
            color: white;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .icon-button {
            background-color: #f0f0f0;
            color: #333;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .text {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            font-size: 12px;
        }

        select {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div id="panel">
        <div class="hstack">
            <div class="input">
                <input type="text" placeholder="Origin" id="origin" oninput="searchPlace('origin')"
                    onfocus="showResults('origin')" onblur="hideResults('origin')" />
                <div id="origin-results" class="results"></div>
            </div>
            <div class="input">
                <input type="text" placeholder="Destination" id="destination" oninput="searchPlace('destination')"
                    onfocus="showResults('destination')" onblur="hideResults('destination')" />
                <div id="destination-results" class="results"></div>
            </div>
            <div class="button-group">
                <select id="mode-selector">
                    <option value="foot-walking">Running</option>
                    <option value="cycling-road">Cycling</option>
                </select>
                <button class="btn" onclick="calculateAndDisplayRoute()">Get Route</button>
                <button class="icon-button" onclick="clearRoute()">&#10006;</button>
                <button class="icon-button" >Book Now</button>

               
            </div>
        </div>
        <div class="text">
            <span id="distance">Distance: </span>
            <span id="duration">Duration: </span>
            <button class="icon-button" onclick="centerMap()">&#10149;</button>
        </div>
    </div>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([33.8547, 35.8623], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var redDotIcon = L.icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            shadowSize: [41, 41],
            shadowAnchor: [12, 41],
            popupAnchor: [0, -30]
        });

        var originMarker, destinationMarker, routePolyline;

        map.on('click', function (e) {
            if (!originMarker) {
                originMarker = L.marker(e.latlng).addTo(map);
                document.getElementById('origin').value = `${e.latlng.lat.toFixed(5)}, ${e.latlng.lng.toFixed(5)}`;
                document.getElementById('origin').dataset.coords = JSON.stringify([e.latlng.lat, e.latlng.lng]);
            } else if (!destinationMarker) {
                destinationMarker = L.marker(e.latlng, { icon: redDotIcon }).addTo(map);
                document.getElementById('destination').value = `${e.latlng.lat.toFixed(5)}, ${e.latlng.lng.toFixed(5)}`;
                document.getElementById('destination').dataset.coords = JSON.stringify([e.latlng.lat, e.latlng.lng]);
            }
        });

        function calculateAndDisplayRoute() {
            var origin = document.getElementById('origin').dataset.coords;
            var destination = document.getElementById('destination').dataset.coords;
            var travelMode = document.getElementById('mode-selector').value;

            if (origin && destination) {
                fetchAndDrawRoute(JSON.parse(origin), JSON.parse(destination), travelMode);
            } else {
                alert('Please select both origin and destination.');
            }
        }

        function fetchAndDrawRoute(originCoords, destinationCoords, travelMode) {
            clearMap();
            originMarker = L.marker(originCoords).addTo(map);
            destinationMarker = L.marker(destinationCoords, { icon: redDotIcon }).addTo(map);

            getRoute(originCoords, destinationCoords, travelMode)
                .then(routeData => {
                    if (routeData && routeData.features && routeData.features.length > 0) {
                        var route = routeData.features[0].geometry.coordinates;
                        var latlngs = route.map(coord => [coord[1], coord[0]]);

                        routePolyline = L.polyline(latlngs, { color: 'blue' }).addTo(map);
                        map.fitBounds(latlngs);

                        var durationSeconds = routeData.features[0].properties.segments[0].duration;
                        var distanceMeters = routeData.features[0].properties.segments[0].distance;
                        var distance = (distanceMeters / 1000).toFixed(2) + ' km';

                        var duration = formatDuration(durationSeconds);
                        document.getElementById('duration').textContent = 'Duration: ' + duration;

                        document.getElementById('distance').textContent = 'Distance: ' + distance;
                    } else {
                        alert('No route found. Please check the inputs and try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong. Please try again later.');
                });
        }

        function clearMap() {
            if (originMarker) {
                map.removeLayer(originMarker);
                originMarker = null;
            }
            if (destinationMarker) {
                map.removeLayer(destinationMarker);
                destinationMarker = null;
            }
            if (routePolyline) {
                map.removeLayer(routePolyline);
                routePolyline = null;
            }
            document.getElementById('duration').textContent = 'Duration: ';
            document.getElementById('distance').textContent = 'Distance: ';
        }

        function formatDuration(durationSeconds) {
            if (durationSeconds < 3600) {
                return Math.floor(durationSeconds / 60) + ' mins';
            } else {
                return (durationSeconds / 3600).toFixed(2) + ' hours';
            }
        }

        function clearRoute() {
            clearMap();
            document.getElementById('origin').value = '';
            document.getElementById('destination').value = '';
            document.getElementById('origin').dataset.coords = '';
            document.getElementById('destination').dataset.coords = '';
        }

        function centerMap() {
    // Center the map in Lebanon with appropriate zoom level
    map.setView([33.8547, 35.8623], 7);
}

        function searchPlace(inputId) {
            var input = document.getElementById(inputId).value.trim();
            var resultsContainer = document.getElementById(`${inputId}-results`);

            if (input.length < 3) {
                resultsContainer.innerHTML = '';
                resultsContainer.style.display = 'none';
                return;
            }

            fetch(`https://api.openrouteservice.org/geocode/search?api_key=5b3ce3597851110001cf6248f310fc3e4d824c7a8892ff1bad4ccd9d&text=${input}`)
                .then(response => response.json())
                .then(data => {
                    var results = data.features;
                    resultsContainer.innerHTML = '';

                    results.forEach(result => {
                        var item = document.createElement('div');
                        item.classList.add('result-item');
                        item.textContent = result.properties.label;
                        item.onclick = function () {
                            document.getElementById(inputId).value = result.properties.label;
                            document.getElementById(inputId).dataset.coords = JSON.stringify(result.geometry.coordinates.reverse());
                            resultsContainer.style.display = 'none';
                        };
                        resultsContainer.appendChild(item);
                    });

                    resultsContainer.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultsContainer.innerHTML = '';
                    resultsContainer.style.display = 'none';
                });
        }

        function showResults(inputId) {
            var resultsContainer = document.getElementById(`${inputId}-results`);
            if (resultsContainer.innerHTML.trim() !== '') {
                resultsContainer.style.display = 'block';
            }
        }

        function hideResults(inputId) {
            var resultsContainer = document.getElementById(`${inputId}-results`);
            setTimeout(() => {
                resultsContainer.style.display = 'none';
            }, 200);
        }

        function getRoute(originCoords, destinationCoords, travelMode) {
            var url = `https://api.openrouteservice.org/v2/directions/${travelMode}?api_key=5b3ce3597851110001cf6248f310fc3e4d824c7a8892ff1bad4ccd9d&start=${originCoords[1]},${originCoords[0]}&end=${destinationCoords[1]},${destinationCoords[0]}`;
            return fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to fetch route. Please try again later.');
                });
        }
    </script>
</body>

</html>