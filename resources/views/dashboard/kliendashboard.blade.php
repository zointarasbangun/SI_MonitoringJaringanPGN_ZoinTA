@extends('layouts.app')
@section('content')
    <style>
        .small-box {
            border-radius: 10px;
        }

        .carousel-item img {
            max-width: 100%;
            margin: 0 auto;
        }

        /* Tambahkan gaya berikut untuk mengatur lebar gambar pada tampilan kecil */
        @media (max-width: 767px) {
            .carousel-item img {
                width: 100%;
            }
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 connectedSortable"
                    style="margin-bottom : 20px; background-color: #1265A8; color: #fff;">
                    <h3 style="margin-top: 30px; margin-left: 30px; font-weight: bold;">
                        {{ $namaTeknisi = Auth::user()->name }}</h3>
                    <div class="container fluid ">
                        <div class="row d-flex justify-content-around">
                            <div class="col-lg-3 col-md-6">
                                <div class="small-box bg-white text-center d-flex flex-column "
                                    style="font-weight: bold; padding: 20px; ">
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <h4 style="margin-bottom: 0;color: #1265A8;">Total Klien</h4>
                                        <i class="iconify nav-icon ml-auto" data-icon="fa6-solid:users"
                                            style="font-size: 36px; color: #1265A8;"></i>
                                    </div>
                                    <p style="font-size: 36px;color: #1265A8;">
                                        {{ $klien }}</p>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="small-box bg-white text-center d-flex flex-column "
                                    style="font-weight: bold; padding: 20px;">
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <h4 style="margin-bottom: 0;color: #1265A8;">Total Perangkat</h4>
                                        <i class="iconify nav-icon ml-auto" data-icon="mingcute:location-3-line"
                                            style="font-size: 36px; color: #1265A8;"></i>
                                    </div>
                                    <p style="font-size: 36px;color: #1265A8;">
                                        {{ $device }}</p>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="small-box bg-white text-center d-flex flex-column "
                                    style="font-weight: bold; padding: 20px;">
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <h4 style="margin-bottom: 0;color: #1265A8;">Perangkat Saya</h4>
                                        <i class="iconify nav-icon ml-auto" data-icon="mingcute:location-3-line"
                                            style="font-size: 36px; color: #1265A8;"></i>
                                    </div>
                                    <p style="font-size: 36px;color: #1265A8;">
                                        {{ $deviceCount }}</p>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="small-box bg-white text-center d-flex flex-column "
                                    style="font-weight: bold; padding: 20px;">
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <h4 style="margin-bottom: 0;color: #1265A8;">Total Teknisi</h4>
                                        <i class="iconify nav-icon ml-auto" data-icon="fa-solid:users-cog"
                                            style="font-size: 36px; color: #1265A8;"></i>
                                    </div>
                                    <p style="font-size: 36px;color: #1265A8;">
                                        {{ $teknisi }}</p>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="card-title"><b>List Perangkat</b></h1>
                    <a href="{{ route('klien.monitoringlokasi', ['id' => auth()->user()->id])  }}" class="btn btn-success ml-auto">Lihat lokasi
                        <i class="fa-solid fa-map-location-dot"></i>
                    </a>
                </div>
                <!-- table -->
                <div class="container-fluid ">
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
                    <table class="table table-striped text-center" id="tablecar">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Perangkat</th>
                                <th scope="col">Alamat IP</th>
                                <th scope="col">status</th>
                                {{-- <th scope="col">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $d)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $d->nama_perangkat }}</td>
                                    <td> {{ $d->ip_perangkat }}</td>
                                    <td id="status-{{ $d->id }}">
                                        @if ($d->status === true)
                                            <span class="badge bg-success">
                                                Terhubung
                                            </span>
                                        @elseif($d->status == 'waiting')
                                            <div class="spinner-border text-secondary" role="status">
                                                <span class="visually-hidden"> </span>
                                            </div>
                                        @else
                                            <span class="badge bg-danger">
                                                Tidak Terhubung
                                            </span>
                                        @endif
                                    </td>
                                    {{-- @if (Auth::user()->role == 'admin')
                                        <td>
                                            <a href="{{ route('editDevice', ['id' => $d->id]) }}"
                                                class="btn btn-primary"><i class= "fas fa-pen"></i></a>
                                            <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"
                                                class="btn btn-danger"><i class= "fas fa-trash-alt"></i></a>
                                            <a href="{{ route('monitoringlokasi', ['id' => $d->id]) }}"
                                                class="btn btn-success"> <i class= "fa-solid fa-map-location-dot"></i></a>
                                        </td>
                                    @elseif (Auth::user()->role == 'teknisi')
                                        <td>
                                            <a href="{{ route('teknisi.monitoringlokasi', ['id' => $d->id]) }}"
                                                class="btn btn-success">Lihat lokasi <i
                                                    class= "fa-solid fa-map-location-dot"></i></a>

                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('klien.monitoringlokasi', ['id' => auth()->user()->id]) }}"
                                                class="btn btn-success">Lihat lokasi <i
                                                    class= "fa-solid fa-map-location-dot"></i></a>
                                        </td>
                                    @endif --}}
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
                                                <p>Apakah Anda yakin ingin menghapus data perangkat
                                                    <b>{{ $d->nama_perangkat }}</b>
                                                </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <form action="{{ route('deleteDevice', ['id' => $d->id]) }}"
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
    </div><!-- /.container-fluid -->
@endsection

@section('js')
    <script>
        var data = @json($data);

        function tesPing() {

            data.forEach(d => {
                $.ajax({
                    type: "get",
                    url: "{{ route('tespingajax') }}",
                    data: {
                        ip: d.ip_perangkat,
                        id: d.id,
                    },
                    success: function(status) {
                        if (status == true) {
                            $("[id='status-" + d.id + "']").html(
                                "<span class='badge bg-success'>Terhubung</span>")
                        } else {
                            $("[id='status-" + d.id + "']").html(
                                "<span class='badge bg-danger'>Tidak Terhubung</span>")
                        }

                    }
                })
            });
        }

        $(document).ready(function() {
            tesPing()
            setInterval(tesPing, 300000);
            // $("[id='status-25']").html("<span class='badge bg-success'>Terhubung</span>")
        })
    </script>
@endsection
