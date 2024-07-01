@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="container-fluid ">
            <div class="row p-5" style=" margin-bottom : 20px; background-color: #1265A8; ">

                <div class="col-lg-4 col-sm-6">
                    <form action="{{ route('searchserver') }}" class="form-inline" method="GET">
                        <div class="input-group " style="flex-grow: 10;">
                            <input type="search" class="form-control mr-10" style="width: 200px;" name="search"
                                id="cariDataKendaraan" placeholder="Cari Data Server...">
                            <div class="input-group-append">
                                <button class="btn btn-primary ml-1" type="submit"><i class="iconify"
                                        data-icon="material-symbols:search"></i> Cari</button>
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('dataServer') }}" class="btn btn-danger ml-1"><i class="iconify"
                                            data-icon="solar:refresh-linear"></i> Reset</a>
                                @elseif (Auth::user()->role == 'teknisi')
                                    <a href="{{ route('teknisi.dataServer') }}" class="btn btn-danger ml-1"><i
                                            class="iconify" data-icon="solar:refresh-linear"></i> Reset</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- Tambahkan kolom kosong untuk mempertahankan jarak -->
                </div>

                @if (Auth::user()->role == 'admin')
                    <div class="col-lg-4 col-sm-12">
                        <div class="float-right">

                            <!-- Button Modal -->
                            <div class="text-center">
                                <a href="" class="btn btn-light btn-rounded mb-4" data-toggle="modal"
                                    style="color:#12ACED" data-target="#modalLoginForm"><i class="iconify nav-icon mr-3"
                                        data-icon="line-md:account-add"></i>Tambah Server</a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="color:white; background:#1265A8; padding:10px;">
                                        <div class="modal-header text-start">
                                            <h5 class="modal-title w-100 font-weight-bold">Tambah Server</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                style="color: white;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <form class="" method="POST" action="{{ route('addServer') }}">
                                            @csrf
                                            <div class="modal-body mx-3">
                                                <div class="mb-2">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-server">Nama
                                                        Server</label>
                                                    <input type="text" name="nama_server" id="defaultForm-username"
                                                        class="form-control validate" placeholder="Input nama server">

                                                </div>

                                                <div class="mb-2">
                                                    <i class="mr-3 fas fa-globe"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-latitude">Latitude</label>
                                                    <input type="number" step=any name="latitude" id="defaultForm-latitude"
                                                        class="form-control validate"
                                                        placeholder="Input Latitude (contoh: -6.1754)">

                                                </div>

                                                <div class="mb-2">
                                                    <i class="mr-3 fas fa-globe"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-longitude">Longitude</label>
                                                    <input type="number" step=any name="longitude"
                                                        id="defaultForm-latitude" class="form-control validate"
                                                        placeholder="Input Longitude (contoh: 111.1754)">

                                                </div>

                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Tambah Server</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /modal -->

                        </div>
                    </div>
                @elseif(Auth::user()->role == 'teknisi')
                @endif
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="card-title"><b>List Server</b></h1>
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('serverlokasi') }}" class="btn btn-success ml-auto">Lihat lokasi server
                            <i class="fa-solid fa-map-location-dot"></i>
                        </a>
                    @else
                        <a href="{{ route('teknisi.serverlokasi') }}" class="btn btn-success ml-auto">Lihat lokasi server
                            <i class="fa-solid fa-map-location-dot"></i>
                        </a>
                    @endif
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
                <div class="table-responsive" style="overflow-x:auto;">
                    <table class="table table-striped text-center" id="tablecar">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama server</th>
                                <th scope="col">Jumlah Klien</th>
                                @if (Auth::user()->role == 'admin')
                                    <th scope="col">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($server as $index => $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->nama_server }}</td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <a href="{{ route('detailKlien', ['id' => $d->id]) }}"
                                                class="btn btn-info">{{ $d->users->count() }} <i
                                                    class="iconify nav-icon ml-auto" data-icon="bxs:detail"></i>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{ route('editServer', ['id' => $d->id]) }}"
                                                class="btn btn-primary"><i class= "fas fa-pen"></i></a>
                                            <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"
                                                class="btn btn-danger"><i class= "fas fa-trash-alt"></i></a>
                                            {{-- <a href="{{ route('serverlokasi', ['id' => $d->id]) }}"
                                            class="btn btn-success"><i class= "fa-solid fa-map-location-dot"></i></a> --}}
                                            {{-- <a href="#" class="btn btn-primary">
                                        <i class="fa-solid fa-map-location-dot"></i></a> --}}
                                        </td>
                                    @elseif(Auth::user()->role == 'teknisi')
                                        <td>
                                            <a href="{{ route('teknisi.detailKlien', ['id' => $d->id]) }}"
                                                class="btn btn-info">{{ $d->users->count() }} <i
                                                    class="iconify nav-icon ml-auto" data-icon="bxs:detail"></i>
                                            </a>
                                        </td>
                                        {{-- <td>
                                        <a href="{{ route('teknisi.serverlokasi', ['id' => $d->id]) }}"
                                            class="btn btn-success">Lihat lokasi <i
                                                class= "fa-solid fa-map-location-dot"></i></a>
                                    </td> --}}
                                    @endif

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
                                                <p>Apakah Anda yakin ingin menghapus
                                                    <b>{{ $d->nama_server }}</b>
                                                </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <form action="{{ route('deleteServer', ['id' => $d->id]) }}"
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

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000
            });
        </script>
    @endif

    @if (session('errors'))
        <script>
            var errors = {!! html_entity_decode(session('errors')) !!};
            var errorMessage = '';

            // Loop through the errors object and concatenate all error messages
            for (var key in errors) {
                errorMessage += errors[key][0] + '<br>';
            }

            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: errorMessage
            });
        </script>
    @endif
    <!-- /.card-body -->
    <!-- /.container-fluid -->
@endsection
