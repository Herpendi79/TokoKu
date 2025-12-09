<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Realtime</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    <style>
        #map {
            height: 100vh;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <script>
        const destLat = {{ $location->latitude }};
        const destLng = {{ $location->longitude }};

        let map = L.map("map").setView([destLat, destLng], 14);

        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

        let userMarker = null;
        let routingControl = null;

        const userIcon = L.icon({
            iconUrl: "https://cdn-icons-png.flaticon.com/128/684/684908.png",
            iconSize: [40, 40],
            iconAnchor: [20, 40]
        });

        // Tujuan
        L.marker([destLat, destLng]).addTo(map)
            .bindPopup("Lokasi Tujuan: {{ $location->name }}");

        let previousLatLng = null;

        function animateMarker(marker, from, to, duration = 1000) {
            const frames = 30;
            const step = 1 / frames;
            let i = 0;

            const latDiff = to.lat - from.lat;
            const lngDiff = to.lng - from.lng;

            const interval = setInterval(() => {
                i++;
                const newLat = from.lat + (latDiff * step * i);
                const newLng = from.lng + (lngDiff * step * i);

                marker.setLatLng([newLat, newLng]);

                if (i >= frames) clearInterval(interval);
            }, duration / frames);
        }

        function updateLocation() {
            navigator.geolocation.getCurrentPosition((pos) => {

                let lat = pos.coords.latitude;
                let lng = pos.coords.longitude;
                let newLatLng = L.latLng(lat, lng);

                // Marker user
                if (!userMarker) {
                    userMarker = L.marker(newLatLng, {
                        icon: userIcon
                    }).addTo(map);
                    map.setView(newLatLng, 15);

                    // Buat routingControl sekali saja
                    routingControl = L.Routing.control({
                        waypoints: [
                            newLatLng,
                            L.latLng(destLat, destLng)
                        ],
                        routeWhileDragging: false,
                        draggableWaypoints: false,
                        addWaypoints: false
                    }).addTo(map);

                } else {
                    animateMarker(userMarker, previousLatLng ?? newLatLng, newLatLng);

                    // Update waypoint pertama (posisi user) tanpa remove/add control
                    routingControl.setWaypoints([
                        newLatLng,
                        L.latLng(destLat, destLng)
                    ]);
                }

                previousLatLng = newLatLng;

            }, () => {
                console.log("Lokasi tidak bisa diambil.");
            });
        }

        updateLocation();
        setInterval(updateLocation, 3000);
    </script>


</body>