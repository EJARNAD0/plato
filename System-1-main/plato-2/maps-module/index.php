<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hit Mapping Application</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- Custom CSS File -->
    <link rel="stylesheet" href="<?php echo $cssFile; ?>">
    <style>
        /* Styling for the map */
        #map {
            height: 500px;
        }

        /* Styling for the legend */
        .legend {
            background-color: white;
            padding: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            font-family: Arial, sans-serif;
            position: absolute;
            bottom: 30px; /* Distance from the bottom */
            left: 10px; /* Distance from the left */
            z-index: 1000; /* Ensure it is above map controls */
        }

        .legend .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend .legend-icon {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .legend .danger {
            background-color: red;
        }

        .legend .mid {
            background-color: orange;
        }

        .legend .safe {
            background-color: green;
        }
    </style>
</head>
<body>
    <h1>Hit Mapping In Barangay Mambulac</h1>
    <div id="map"></div> <!-- Map container -->
    <div class="legend">
        <div class="legend-item">
            <div class="legend-icon danger"></div>
            <span>Danger</span>
        </div>
        <div class="legend-item">
            <div class="legend-icon mid"></div>
            <span>Mid-level</span>
        </div>
        <div class="legend-item">
            <div class="legend-icon safe"></div>
            <span>Safe</span>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize the map and set the view to Barangay Mambulac, Silay City, Negros Occidental
        var map = L.map('map').setView([10.7957, 122.9702], 14); // Set view to Barangay Mambulac

        // Add a tile layer (the base map)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Custom icons for different hit statuses
        var redIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            shadowSize: [41, 41]
        });

        var orangeIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            shadowSize: [41, 41]
        });

        var greenIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            shadowSize: [41, 41]
        });

        // Sample hit data with status (danger, mid, safe)
        var hits = [
            {"lat": 10.7957, "lng": 122.9702, "info": "Hit 1: Danger", "status": "danger"},
            {"lat": 10.7967, "lng": 122.9712, "info": "Hit 2: Mid-level", "status": "mid"},
            {"lat": 10.7947, "lng": 122.9692, "info": "Hit 3: Safe", "status": "safe"}
        ];

        // Add markers to the map for each hit based on status
        hits.forEach(function(hit) {
            var icon;
            switch (hit.status) {
                case 'danger':
                    icon = redIcon;
                    break;
                case 'mid':
                    icon = orangeIcon;
                    break;
                case 'safe':
                    icon = greenIcon;
                    break;
                default:
                    icon = greenIcon; // Default to safe if no status
            }

            L.marker([hit.lat, hit.lng], {icon: icon})
                .addTo(map)
                .bindPopup(hit.info); // Display hit information on click
        });

        // Optionally: Add a click event to capture new hit locations
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            console.log("New Hit at Lat: " + lat + ", Lng: " + lng);
            
            // Add a marker for the new hit (default to green for safe)
            L.marker([lat, lng], {icon: greenIcon})
                .addTo(map)
                .bindPopup("New hit at " + lat + ", " + lng);

            // You can send this lat/lng data to your server for saving
        });
    </script>
</body>
</html>
