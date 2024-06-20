@extends('layouts.app')
@section('content')
    <style>
    </style>

    <div class="content-wrapper">
        <div class="container-fluid p-5" style="background-color:#1265A8">
            <div class="row">
                <form action="{{ route('searchstatuslog') }}" class="form-inline w-100" method="GET">
                    <div class="col-lg-3 col-sm-12 text-light">
                        <label for="cariData" class="large">Cari :
                            <input type="text" class="form-control ml-1" name="search" id="cariData"
                                placeholder="Cari Data...">
                        </label>
                    </div>

                    <div class="col-lg-3 col-sm-6 text-light">
                        <label for="cariTanggalAwal">Tanggal Awal :
                            <input type="date" class="form-control ml-1" name="cariTanggalAwal" id="cariAlamatAwal"
                                placeholder="">
                        </label>
                    </div>
                    <div class="col-lg-3 col-sm-6 text-light">
                        <label for="cariTanggalAkhir">Tanggal Akhir :
                            <input type="date" class="form-control ml-1" name="cariTanggalAkhir" id="cariAlamatAkhir"
                                placeholder="">
                        </label>
                    </div>

                    <div class="col-lg-3 col-sm-12 d-flex justify-content-between align-items-center">
                        <div id="actionCari">
                            <button class="btn btn-primary ml-1" type="submit"><i class="iconify"
                                    data-icon="material-symbols:search"></i></button>
                            <a href="{{ route('datalog') }}" class="btn btn-danger ml-1"><i class="iconify"
                                    data-icon="solar:refresh-linear"></i></a>
                        </div>
                    </div>
                </form>

                @if (Auth::user()->role == 'admin')
                @elseif(Auth::user()->role == 'teknisi')
                    <div class="col-lg-2 col-sm-6 mt-4">
                        <div class="float-right">
                            <!-- Modal -->
                            <div class="text-center">
                                <a href="" class="btn btn-light btn-rounded " data-toggle="modal"
                                    style="color:#12ACED" data-target="#modalLogPerbaikan">
                                    <i class="iconify nav-icon mr-3" data-icon="line-md:document-add"></i>Tambah Laporan
                                </a>
                            </div>

                            <div class="modal fade" id="modalLogPerbaikan" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lgx`" role="document">
                                    <div class="modal-content" style="color:white; background:#1265A8; padding:10px;">
                                        <div class="modal-header text-start">
                                            <h5 class="modal-title w-100 font-weight-bold">Data Laporan Perbaikan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                style="color: white;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <form class="" method="POST" action="{{ route('teknisi.addlog') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body mx-3">
                                                <div class="mb-2">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="teknisi">Nama Teknisi</label>
                                                    <input type="text" name="teknisi" id="defaultForm-username"
                                                        class="form-control validate" placeholder="Input nama"
                                                        value="{{ Auth::user()->name }}" style="color:black;" readonly>
                                                </div>

                                                <div class="mb-2">
                                                    <i class="iconify nav-icon" data-icon="uil:server"></i>
                                                    <label for="user_id" class="ml-3">Klien</label>
                                                    <select class="custom-select form-control validate" id="user_id"
                                                        name="user_id" aria-label="Default select example"
                                                        style="color:black;">
                                                        <option value="">none</option>
                                                        @foreach ($user as $s)
                                                            <option value="{{ $s->id }}">{{ $s->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-2">
                                                    <i class="iconify nav-icon" data-icon="uil:server"></i>
                                                    <label for="server_id" class="ml-3">Server</label>
                                                    <select class="custom-select form-control validate" id="server_id"
                                                        name="server_id" aria-label="Default select example"
                                                        style="color:black;">
                                                        <option value="">none</option>
                                                        {{-- @foreach ($server as $s)
                                                        <option value="{{ $s->id }}">
                                                            {{ $s->nama_server }}</option>
                                                    @endforeach --}}
                                                    </select>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="device_id">Device</label>
                                                    <select class="custom-select form-control validate" id="device_id"
                                                        name="device_id" aria-label="Default select example"
                                                        style="color:black;">
                                                        <option value="">none</option>
                                                    </select>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input type="date" name="tanggal" id="tanggal"
                                                        class="form-control validate" style="color:black;">
                                                </div>

                                                <!-- Tambahkan kolom judul dengan nilai dari database -->
                                                <div class="mb-2">
                                                    <label for="judul">Judul</label>
                                                    <select name="judul" id="judul" class="form-control validate"
                                                        style="color:black;">
                                                        @foreach (App\Models\Logperbaikan::getEnumValues('judul') as $judulValue)
                                                            <option value="{{ $judulValue }}">{{ $judulValue }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <input type="text" name="judul_manual" id="judul_manual"
                                                    class="form-control mt-2" placeholder="Permasalahan lainnya" value=""> --}}
                                                </div>


                                                <!-- Tambahkan kolom keterangan -->
                                                <div class="mb-2">
                                                    <label for="keterangan">Keterangan</label>
                                                    <textarea class="form-control validate" name="keterangan" id="keterangan" rows="3" style="color:black;"></textarea>
                                                </div>

                                                <!-- Tambahkan kolom foto -->
                                                <div class="mb-2">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-Username">Foto</label>
                                                    <input type="file" name="foto" id="foto"
                                                        class="form-control validate" style="color:black;">
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Tambah Laporan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="container-fluid mt-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><b>Status Log Perbaikan</b></h1>
                </div>
                <!-- table -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body table-responsive p-0" style="max-height: 600px; overflow-y: auto;">
                    <table class="table table-striped text-center" id="tablecar">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Teknisi</th>
                                <th scope="col">Server</th>
                                <th scope="col">Klien</th>
                                <th scope="col">Device</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Status Log</th>
                                <th scope="col">Status Admin</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($log as $index => $d)
                                <tr>
                                    <td>{{ intval($index) + 1 }}</td>
                                    <td>{{ $d->teknisilog->name }}</td>
                                    <td>{{ $d->serverlog->nama_server }}</td>
                                    <td> {{ $d->userlog->name }}</td>
                                    <td>{{ $d->devicelog->nama_perangkat }}</td>
                                    <td> {{ $d->tanggal }} </td>
                                    <td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modaldeskripsi{{ $index }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content"
                                                    style="color:white; background:#1265A8; padding:10px;">
                                                    <div class="modal-header text-start">
                                                        <h4 class="modal-title w-100 font-weight-bold">Deskripsi</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body mx-3">
                                                        <div class="mb-2">
                                                            <label for="judul">Judul</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $d->judul }}" readonly>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="keterangan">Keterangan</label>
                                                            <textarea class="form-control" rows="3" readonly>{{ $d->keterangan }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-right">
                                                        <button class="btn btn-success" data-dismiss="modal"
                                                            aria-label="Close">Oke</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /modal -->
                                        <a href="#" class="btn btn-info" data-toggle="modal"
                                            data-target="#modaldeskripsi{{ $index }}">Lihat <i
                                                class="iconify nav-icon ml-auto" data-icon="bxs:detail"></i>
                                        </a>
                                    </td>

                                    <td>
                                        @if ($d->foto)
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalLihatAwal{{ $index }}"
                                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <!-- Tambahkan kelas modal-lg di sini -->
                                                    <div class="modal-content"
                                                        style="color:white; background:#1265A8; padding:10px;">
                                                        <div class="modal-header text-start">
                                                            <h4 class="modal-title w-100 font-weight-bold">Lihat Foto</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body mx-3">
                                                            <div class="mb-0">
                                                                <img src="{{ asset('storage/' . $d->foto) }}"
                                                                    class="img-fluid" alt="Foto Log perbaikan"
                                                                    style="max-width: 100%; height: auto;" />
                                                                <!-- Atur lebar gambar agar sesuai dengan lebar modal -->
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-right">
                                                            <button class="btn btn-success" data-dismiss="modal"
                                                                aria-label="Close">Oke</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /modal -->

                                            <!-- Button Modal -->
                                            <div class="text-center">
                                                <a href="#" class="btn btn-primary btn-rounded mb-4"
                                                    data-toggle="modal"
                                                    data-target="#modalLihatAwal{{ $index }}">lihat <i
                                                        class="iconify nav-icon" data-icon="mdi:eye"></i></a>
                                            </div>
                                            <!-- /button modal -->
                                        @else
                                            Gambar tidak tersedia
                                        @endif
                                    </td>

                                    <td>
                                        @if ($d->foto)
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-primary">Proses</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($d->statusadmin === 'ditolak')
                                            <span class="badge bg-danger">
                                                {{ $d->statusadmin }}
                                            </span>
                                        @elseif($d->statusadmin === 'menunggu')
                                            <span class="badge bg-warning">
                                                {{ $d->statusadmin }}
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                {{ $d->statusadmin }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (Auth::user()->role == 'admin')
                                            <button class="btn btn-success ml-1"
                                                onclick="confirmApproval({{ $d->id }})"><i
                                                    class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-danger ml-1"
                                                onclick="confirmRejection({{ $d->id }})">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @elseif (Auth::user()->role == 'teknisi')
                                            <a href=" {{ route('teknisi.editlog', ['id' => $d->id]) }}"
                                                class="btn btn-primary"><i class= "fas fa-pen"></i></a>
                                            <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"
                                                class="btn btn-danger"><i class= "fas fa-trash-alt"></i></a>
                                            {{-- <a href="#" class="btn btn-primary">
                                        <i class="fa-solid fa-map-location-dot"></i></a> --}}
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-hapus{{ $d->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Default Modal</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data Log
                                                    <b> {{ $d->userlog->name }}</b>
                                                </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <form action="{{ route('teknisi.deletelog', ['id' => $d->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Ya,
                                                        Hapus</button>

                                                </form>

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // AJAX untuk mengambil data device berdasarkan klien yang dipilih
        $(document).ready(function() {
            $('#user_id').change(function() {
                var userId = $(this).val();
                if (userId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('getDevicesByClient') }}",
                        data: {
                            'user_id': userId
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#device_id').empty();
                            $.each(data, function(key, value) {
                                $('#device_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#device_id').empty();
                }
            });
        });

        // AJAX untuk mengambil data server berdasarkan klien yang dipilih
        $(document).ready(function() {
            $('#user_id').change(function() {
                var userId = $(this).val();
                if (userId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('getServersByClient') }}",
                        data: {
                            'user_id': userId
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#server_id').empty();
                            $.each(data, function(key, value) {
                                $('#server_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#server_id').empty();
                }
            });
        });

        function confirmApproval(id) {
            if (confirm("Anda yakin ingin menyetujui laporan ini?")) {
                approveLaporan(id);
            } else {
                alert("Persetujuan dibatalkan.");
            }
        }

        function confirmRejection(id) {
            if (confirm("Anda yakin ingin menolak laporan ini?")) {
                rejectLaporan(id);
            } else {
                alert("Penolakan dibatalkan.");
            }
        }

        function approveLaporan(id) {
            $.ajax({
                type: "POST",
                url: '/approve-laporan/' + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    alert(data.message);
                    // Setelah berhasil, Anda dapat memperbarui tampilan atau memberikan notifikasi kepada pengguna
                    // ...

                    // Contoh: Reload halaman
                    window.location.reload();
                },
                error: function(error) {
                    console.log(error);
                    alert("Terjadi kesalahan saat menyetujui perjalanan.");
                }
            });
        }

        function rejectLaporan(id) {
            $.ajax({
                type: "POST",
                url: '/reject-laporan/' + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    alert(data.message);
                    // Setelah berhasil, Anda dapat memperbarui tampilan atau memberikan notifikasi kepada pengguna
                    // ...
                    // Contoh: Reload halaman
                    window.location.reload();
                },
                error: function(error) {
                    console.log(error);
                    alert("Terjadi kesalahan saat menolak laporan.");
                }
            });
        }
    </script>
@endsection
