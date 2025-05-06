<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="IP Geolocation Finder - Locate and get detailed information about any IP address">
    <title>IP Geolocation Finder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .result-card {
            display: none;
            transition: all 0.3s ease;
            opacity: 0;
        }
        .result-card.show {
            opacity: 1;
        }
        .loading {
            display: none;
        }
        .map-container {
            height: 400px;
            width: 100%;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .copy-btn {
            cursor: pointer;
            padding: 2px 6px;
            font-size: 0.8rem;
            margin-left: 8px;
        }
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .error-message {
            display: none;
            color: #dc3545;
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
            background-color: #f8d7da;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-globe me-2"></i>IP Geolocation Finder</h3>
                    </div>
                    <div class="card-body">
                        <form id="ipForm" class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" id="ipInput" class="form-control" placeholder="Enter IP address or domain (e.g., 8.8.8.8 or google.com)" required>
                                <button type="submit" class="btn btn-primary">
                                    <span class="normal-state"><i class="fas fa-location-dot me-1"></i>Locate</span>
                                    <span class="loading">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </span>
                                </button>
                            </div>
                            <div class="error-message" id="errorMessage"></div>
                        </form>

                        <div class="result-card card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5><i class="fas fa-map-marker-alt me-2"></i>Location Details</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><strong>IP:</strong> <span id="ip"></span></span>
                                                <button class="btn btn-sm btn-outline-secondary copy-btn" data-value="ip">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </li>
                                            <li class="list-group-item"><strong>Country:</strong> <span id="country"></span></li>
                                            <li class="list-group-item"><strong>Region:</strong> <span id="region"></span></li>
                                            <li class="list-group-item"><strong>City:</strong> <span id="city"></span></li>
                                            <li class="list-group-item"><strong>ZIP:</strong> <span id="zip"></span></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><i class="fas fa-server me-2"></i>Technical Details</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Latitude:</strong> <span id="latitude"></span></li>
                                            <li class="list-group-item"><strong>Longitude:</strong> <span id="longitude"></span></li>
                                            <li class="list-group-item"><strong>Timezone:</strong> <span id="timezone"></span></li>
                                            <li class="list-group-item"><strong>ISP:</strong> <span id="isp"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="map" class="map-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast for copy notification -->
    <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Copied to clipboard!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
    <script>
        const toast = new bootstrap.Toast(document.querySelector('.toast'));
        let currentMap = null;
        let currentMarker = null;

        // Copy to clipboard functionality
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', () => {
                const valueId = button.getAttribute('data-value');
                const textToCopy = document.getElementById(valueId).textContent;
                navigator.clipboard.writeText(textToCopy).then(() => {
                    toast.show();
                });
            });
        });

        document.getElementById('ipForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const ipInput = document.getElementById('ipInput').value.trim();
            const resultCard = document.querySelector('.result-card');
            const loadingSpan = document.querySelector('.loading');
            const normalState = document.querySelector('.normal-state');
            const errorMessage = document.getElementById('errorMessage');

            // Input validation
            const ipRegex = /^(\d{1,3}\.){3}\d{1,3}$|^([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/;
            if (!ipRegex.test(ipInput)) {
                errorMessage.textContent = 'Please enter a valid IP address or domain name';
                errorMessage.style.display = 'block';
                return;
            }

            // Reset error message
            errorMessage.style.display = 'none';

            // Show loading state
            loadingSpan.style.display = 'inline-block';
            normalState.style.display = 'none';
            resultCard.style.display = 'none';

            try {
                const response = await fetch(`https://ipapi.co/${ipInput}/json/`);
                const data = await response.json();

                if (data.error) {
                    throw new Error(data.reason || 'Failed to fetch IP information');
                }

                // Update the results
                const fields = {
                    'ip': data.ip,
                    'country': `${data.country_name} (${data.country_code})`,
                    'region': data.region || 'N/A',
                    'city': data.city || 'N/A',
                    'zip': data.postal || 'N/A',
                    'latitude': data.latitude || 'N/A',
                    'longitude': data.longitude || 'N/A',
                    'timezone': data.timezone || 'N/A',
                    'isp': data.org || 'N/A'
                };

                Object.entries(fields).forEach(([id, value]) => {
                    document.getElementById(id).textContent = value;
                });

                // Update map
                if (data.latitude && data.longitude) {
                    const location = { lat: data.latitude, lng: data.longitude };
                    
                    if (!currentMap) {
                        currentMap = new google.maps.Map(document.getElementById('map'), {
                            center: location,
                            zoom: 12,
                            styles: [
                                {
                                    featureType: "poi",
                                    elementType: "labels",
                                    stylers: [{ visibility: "off" }]
                                }
                            ]
                        });
                    } else {
                        currentMap.setCenter(location);
                    }

                    if (currentMarker) {
                        currentMarker.setMap(null);
                    }

                    currentMarker = new google.maps.Marker({
                        position: location,
                        map: currentMap,
                        title: `${data.city || ''}, ${data.country_name || ''}`,
                        animation: google.maps.Animation.DROP
                    });
                }

                resultCard.style.display = 'block';
                setTimeout(() => resultCard.classList.add('show'), 10);
            } catch (error) {
                errorMessage.textContent = `Error: ${error.message}`;
                errorMessage.style.display = 'block';
            } finally {
                loadingSpan.style.display = 'none';
                normalState.style.display = 'inline-block';
            }
        });
    </script>
</body>
</html>
