<div class="main-panel ps ps--active-y p-2" id="main-panel">
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-transparent   navbar-absolute">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <div class="navbar-toggle">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <a class="navbar-brand" href="#pablo">Order tracking</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <livewire:admin.dashboard.nav.navitem />
        </div>
    </nav>

    <!-- Purchases Overview Section -->
    <div class="container mt-4" style="padding-top: 6%">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Ordered Location</h4>

            </div>

            <div class="card-body">
                <form wire:submit.prevent="submit">

                    <!-- Material Selection Panel -->

                    <div class="col">
                        <div id="map" style="height: 400px;" wire:ignore></div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-primary" onclick="openDirections()">
                                Get Directions
                            </button>
                        </div>

                        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

                        <script>
                            document.addEventListener('livewire:navigated', function() {
                                const lat = @js($latitude);
                                const lng = @js($longitude);

                                if (!lat || !lng) {
                                    console.warn("Coordinates not available.");
                                    return;
                                }

                                const mapContainer = document.getElementById('map');
                                if (!mapContainer) {
                                    console.warn("Map container not found.");
                                    return;
                                }

                                mapContainer.innerHTML = ""; // Clear previous map if any

                                const map = L.map('map').setView([lat, lng], 13);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '© OpenStreetMap contributors'
                                }).addTo(map);

                                L.marker([lat, lng]).addTo(map)
                                    .bindPopup("Order Location").openPopup();
                            });

                            function openDirections() {
                                const lat = @js($latitude);
                                const lng = @js($longitude);

                                if (!lat || !lng) {
                                    alert("Coordinates not available.");
                                    return;
                                }

                                // This opens Google Maps with the destination set
                                const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
                                window.open(googleMapsUrl, '_blank');
                            }
                        </script>
                    </div>





                </form>
            </div>
        </div>
    </div>


</div>
