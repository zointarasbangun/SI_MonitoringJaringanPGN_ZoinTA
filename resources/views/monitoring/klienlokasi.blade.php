    @extends('layouts.app')
    @section('styles')
        <style>
            #map {
                height: 600px;
                width: 100%;
                /* Buat peta mengisi seluruh lebar layar */
            }

            .content-wrapper {
                position: relative;
                /* Diperlukan untuk membuat peta mengisi seluruh tinggi konten */
                overflow: hidden;
                /* Sembunyikan overflow untuk menghindari scrollbars */
            }

            #fullscreen-btn:-webkit-full-screen {
                display: none;
                /* Sembunyikan tombol saat fullscreen aktif di Chrome/Safari */
            }

            #fullscreen-btn:-moz-full-screen {
                display: none;
                /* Sembunyikan tombol saat fullscreen aktif di Firefox */
            }

            #fullscreen-btn:-ms-fullscreen {
                display: none;
                /* Sembunyikan tombol saat fullscreen aktif di IE/Edge */
            }

            #fullscreen-btn:-o-full-screen {
                display: none;
                /* Sembunyikan tombol saat fullscreen aktif di Opera */
            }

            #fullscreen-btn:fullscreen {
                display: none;
                /* Sembunyikan tombol saat fullscreen aktif di browser lainnya */
            }
        </style>
    @endsection

    @section('content')
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Monitoring Klien</title>
            <!-- Include Bootstrap 5 -->
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
            <!-- Include Leaflet CSS -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        </head>
        <div class="content-wrapper p-2">
            <div class="row">
                <div class="col-auto ml-auto">
                    <!-- Gunakan class "col-auto" untuk kolom yang ukurannya menyesuaikan kontennya -->
                    <a id="fullscreen-btn"> <i class="fas fa-expand-arrows-alt"> </i></a>
                </div>
            </div>
            <div id="map" class=""></div>
        </div>
    @endsection

    @section('js')
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            var users = @json($users);

            // Create an empty array for markers
            var monitoring = users.map((user) => {
                // Generate the route URL directly in the JavaScript
                var detailDeviceUrl = `{{ route('detailDevice', ['id' => '__ID__']) }}`.replace('__ID__', user.id);
                var userImageUrl = `{{ asset('storage/__IMAGE_PATH__') }}`.replace('__IMAGE_PATH__', user.image);

                // Using HTML span with Bootstrap badge class to display device_count and adding a link
                var popupContent = `
                    <div style="display: flex; align-items: center;">
                        <img src="${userImageUrl}" alt="Logo" style="width: 25px; height: 25px; margin-right: 20px;">
                        <div>
                            <strong>${user.name}</strong><br>
                            <a href="${detailDeviceUrl}" class="badge bg-primary">Devices: ${user.device_count}</a>
                        </div>
                    </div>
                    `;
                var marker = L.marker([user.latitude, user.longitude], {
                    draggable: true
                }).bindPopup(popupContent, {
                    autoClose: false
                });

                marker.openPopup(); // Open popup initially

                return marker;
            });

            // Awalnya, semua marker dianggap terbuka
            var openPopups = [...monitoring]; // Initialize openPopups with all markers
            var closePopups = [];

            monitoring.forEach(marker => {
                marker.on('click', function() {
                    if (openPopups.includes(marker)) {
                        marker.closePopup();
                        openPopups = openPopups.filter(m => m !== marker);
                        closePopups.push(marker);
                    } else {
                        marker.openPopup();
                        closePopups = closePopups.filter(m => m !== marker);
                        openPopups.push(marker);
                    }
                });

                marker.on('dragstart', function() {
                    marker.openPopup();
                    if (!openPopups.includes(marker)) {
                        openPopups.push(marker);
                    }
                });

                marker.on('dragend', function() {
                    marker.closePopup();
                    if (!closePopups.includes(marker)) {
                        closePopups.push(marker);
                    }
                });
            });

            var locations = L.layerGroup(monitoring);

            const map = L.map('map', {
                center: [-5.3647543, 105.2723488],
                zoom: 12,
                layers: [locations]
            });

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 16,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            monitoring.forEach(marker => marker.openPopup());

            // Function to open all popups
            function openAllPopups() {
                openPopups.forEach(marker => marker.openPopup());
            }

            // Event listener to keep all popups open
            monitoring.forEach(marker => {
                marker.on('click', () => {
                    openAllPopups();
                });
                marker.on('dragend', () => {
                    openAllPopups();
                });
            });
        </script>
        <script>
            document.getElementById('fullscreen-btn').addEventListener('click', function() {
                var elem = document.getElementById('map'); // Ambil elemen peta
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.mozRequestFullScreen) { // Firefox
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) { // Chrome, Safari & Opera
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) { // IE/Edge
                    elem.msRequestFullscreen();
                }
            });
        </script>
    @endsection
