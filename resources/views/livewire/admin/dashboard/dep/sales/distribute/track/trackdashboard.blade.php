<div>
    <div id="map" style="height: 400px;"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <script>
        document.addEventListener('livewire:navigated', function () {
            // Get location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // Send to Livewire
                    Livewire.dispatch('updateDeviceLocation', lat, lng);

                    // Show map
                    var map = L.map('map').setView([lat, lng], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    L.marker([lat, lng]).addTo(map)
                        .bindPopup("Your Location").openPopup();
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });
    </script>
</div>
