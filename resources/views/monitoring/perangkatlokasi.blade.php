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
    <script>
        var greenIcon = new L.Icon({
            iconUrl: '{{ asset('img/green.png') }}',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var redIcon = new L.Icon({
            iconUrl: '{{ asset('img/red.png') }}',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var perangkats = @json($perangkats);
        var monitoring = perangkats.map((perangkat) => {
            // Generate the route URL directly in the JavaScript
            var userImageUrl = `{{ asset('storage/__IMAGE_PATH__') }}`.replace('__IMAGE_PATH__', perangkat.user
                .image);
            var statusContent;
            if (perangkat.status === true) {
                statusContent = `<span class="badge bg-success">Terhubung</span>`;
            } else {
                statusContent = `<span class="badge bg-danger">Tidak Terhubung</span>`;
            }

            // Using HTML span with Bootstrap badge class to display device_count and adding a link
            var popupContent = `
                <div style="display: flex; align-items: center;">
                    <img src="${userImageUrl}" alt="Logo" style="width: 25px; height: 25px; margin-right: 20px;">
                        <div>
                            <strong>${perangkat.nama_perangkat}</strong><br>
                            <div id="status-${perangkat.id}">${statusContent}</div>
                        </div>
                </div>
            `;

            // var markerIcon = perangkat.status === true ? greenIcon : redIcon;

            var marker = L.marker([perangkat.latitude, perangkat.longitude], {
                draggable: true,
                // icon: markerIcon
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
        var perangkats = @json($perangkats);

        function tesPing() {

            perangkats.forEach(perangkat => {
                $.ajax({
                    type: "get",
                    url: "{{ route('tespingajax') }}",
                    data: {
                        ip: perangkat.ip_perangkat
                    },
                    success: function(status) {
                        if (status == true) {
                            $("[id='status-" + perangkat.id + "']").html(
                                "<span class='badge bg-success'>Terhubung</span>")
                        } else {
                            $("[id='status-" + perangkat.id + "']").html(
                                "<span class='badge bg-danger'>Tidak Terhubung</span>")
                        }

                    }
                })
            });
        }

        $(document).ready(function() {
            tesPing()
            setInterval(tesPing, 20000);
        })
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
