@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="container-fluid ">
            <div class="row p-5" style=" margin-bottom : 20px; background-color: #1265A8; ">

                {{-- <div class="col-lg-4 col-sm-6">
                    <form action="{{ route('searchdetaildevice') }}" class="form-inline" method="GET">
                        <div class="input-group " style="flex-grow: 10;">
                            <input type="search" class="form-control mr-10" style="width: 200px;" name="search"
                                id="cariDataKendaraan" placeholder="Cari Data Perangkat...">
                            <div class="input-group-append">
                                <button class="btn btn-primary ml-1" type="submit"><i class="iconify"
                                        data-icon="material-symbols:search"></i> Cari</button>
                                @if (Auth::user()->role == 'admin')
                                    <a href=" " class="btn btn-danger ml-1"><i class="iconify"
                                            data-icon="solar:refresh-linear"></i> Reset</a>
                                @else
                                    <a href=" " class="btn btn-danger ml-1"><i
                                            class="iconify" data-icon="solar:refresh-linear"></i> Reset</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- Tambahkan kolom kosong untuk mempertahankan jarak -->
                </div> --}}

                @if (Auth::user()->role == 'admin')
                    <div class="col-lg-4 col-sm-12">
                        <div class="float-left">

                            <!-- Button Modal -->
                            <div class="text-center">
                                <a href="" class="btn btn-light btn-rounded mb-4" data-toggle="modal"
                                    style="color:#12ACED" data-target="#modalLoginForm"><i class="iconify nav-icon mr-3"
                                        data-icon="line-md:account-add"></i>Tambah Perangkat</a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="color:white; background:#1265A8; padding:10px;">
                                        <div class="modal-header text-start">
                                            <h5 class="modal-title w-100 font-weight-bold">Tambah Perangkat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                style="color: white;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <form class="" method="POST" action="{{ route('addDevice') }}">
                                            @csrf
                                            <div class="modal-body mx-3">
                                                <div class="mb-2">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-namaperangkat">Nama Perangkat</label>
                                                    <input type="text" name="nama_perangkat"
                                                        id="defaultForm-namaperangkat" class="form-control validate"
                                                        placeholder="Input nama perangkat">
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
                                                        id="defaultForm-longitude" class="form-control validate"
                                                        placeholder="Input Longitude (contoh: 111.1754)">
                                                </div>

                                                <div class="mb-2">
                                                    <i class="iconify nav-icon" data-icon="uil:server"></i>
                                                    <label for="klien" class="ml-3">Pilih Klien</label>
                                                    <select class="custom-select form-control validate" id="user_id"
                                                        name="user_id" aria-label="Default select example"
                                                        style="color:black;">
                                                        @foreach ($user as $s)
                                                            <option value="{{ $s->id }}">
                                                                {{ $s->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-2">
                                                    <i class="mr-3 fas fa-globe"></i>
                                                    <label data-error="wrong" data-success="right" for="defaultForm-ip">IP
                                                        Perangkat</label>
                                                    <input type="text" name="ip_perangkat" id="defaultForm-ip"
                                                        class="form-control validate"
                                                        placeholder="Input IP (contoh: 192.168.1.1)">
                                                </div>



                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Tambah Device</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /modal -->

                        </div>
                    </div>
                @elseif (Auth::user()->role == 'teknisi')
                @endif
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><b>List Perangkat</b></h1>
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
                                <th scope="col">Logo</th>
                                <th scope="col">Nama Perangkat</th>
                                <th scope="col">Alamat IP</th>
                                <th scope="col">status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $d)
                                <tr>
                                    <td>{{ intval($index) + 1 }}</td>
                                    <td>
                                        @if ($d->user->image)
                                            <img src="{{ asset('storage/' . $d->user->image) }}" class="img-fluid"
                                                alt="image" width="30" />
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
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
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <a href="{{ route('editDevice', ['id' => $d->id]) }}"
                                                class="btn btn-primary"><i class= "fas fa-pen"></i></a>
                                            <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"
                                                class="btn btn-danger"><i class= "fas fa-trash-alt"></i></a>
                                            <a href="{{ route('monitoringlokasi', ['id' => $d->id]) }}"
                                                class="btn btn-success"><i class= "fa-solid fa-map-location-dot"></i></a>
                                            {{-- <a href="#" class="btn btn-primary">
                                        <i class="fa-solid fa-map-location-dot"></i></a> --}}
                                        </td>
                                    @elseif(Auth::user()->role == 'teknisi')
                                        <td>
                                            <a href="{{ route('teknisi.monitoringlokasi', ['id' => $d->id]) }}"
                                                class="btn btn-success"> lihat lokasi <i class= "fa-solid fa-map-location-dot"></i></a>
                                        </td>
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
        <!-- /.card-body -->
        <!-- /.container-fluid -->
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
                            ip: d.ip_perangkat
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
                setInterval(tesPing, 30000);
                // $("[id='status-25']").html("<span class='badge bg-success'>Terhubung</span>")
            })
        </script>
    @endsection
