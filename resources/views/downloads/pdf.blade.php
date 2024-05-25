<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perbaikan</title>
    <style>
        @page {
            size: landscape;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        #header {
            text-align: center;
            padding: 10px;
        }

        #header .img-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #header img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 20px;
        }

        h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .badge {
            display: inline-block;
            padding: 0.5em 0.75em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge-primary {
            color: #fff;
            background-color: #007bff;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .badge-warning {
            color: #212529;
            background-color: #ffc107;
        }
    </style>
</head>

<body>

    <div id="header" style="display: flex; align-items: center; justify-content: center; padding: 10px; ">
        <div class="img-container" style="display: flex; align-items: center; text-align: center;">
            <img src="{{ public_path('img/akhlak.png') }}" alt="Gambar 1"
                style="max-width: 100px; max-height: 100px; margin-right: 20px;">
            <img src="{{ public_path('img/pgncom.png') }}" alt="Gambar 2"
                style="max-width: 100px; max-height: 100px; margin-right: 15px; margin-left: auto; ">
            <img src="{{ public_path('img/pertamina.png') }}" alt="Gambar 3"
                style="max-width: 200px; max-height: 100px; margin-bottom : 10px;">
        </div>
    </div>

    <div class="laporan" style="text-align: center; padding: 10px;">
        <h2>Laporan Perbaikan Monitoring Jaringan PGNCOM</h2>
        <p>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
    </div>

    <div class="container-fluid mt-3">
        <div class="card-body table-responsive p-0" style="max-height: 600px; overflow-y: auto;">
            <table class="table table-striped text-center" id="tablecar">
                <thead>
                    <tr>
                        <th scope="col">Teknisi</th>
                        <th scope="col">Server</th>
                        <th scope="col">Klien</th>
                        <th scope="col">Device</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Status Log</th>
                        <th scope="col">Status Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($log as $d)
                        <tr>
                            <td>{{ $d->teknisi }}</td>
                            <td>{{ $d->serverlog->nama_server }}</td>
                            <td> {{ $d->userlog->name }}</td>
                            <td>{{ $d->devicelog->nama_perangkat }}</td>
                            <td> {{ $d->tanggal }} </td>
                            <td> {{ $d->keterangan }} </td>
                            <td><img src="{{ public_path('storage/' . $d->foto) }}" width="100"
                                height="100" alt="-" /></td>
                            <td>
                                @if ($d->foto)
                                    <span class="badge badge-success">Selesai</span>
                                @else
                                    <span class="badge badge-primary">Proses</span>
                                @endif
                            </td>
                            <td>
                                @if ($d->statusadmin === 'ditolak')
                                    <span class="badge badge-danger">
                                        {{ $d->statusadmin }}
                                    </span>
                                @elseif($d->statusadmin === 'menunggu')
                                    <span class="badge badge-warning">
                                        {{ $d->statusadmin }}
                                    </span>
                                @else
                                    <span class="badge badge-success">
                                        {{ $d->statusadmin }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <!-- /.modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
