@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="container-fluid ">
            <div class="row p-5" style="margin-bottom : 20px; background-color: #1265A8; ">

                {{-- @if (Auth::user()->role == 'admin')
                    <div class="col-lg-4 col-sm-12">
                        <div class="float-left">

                            <!-- Button Modal -->
                            <div class="text-center">
                                <a href="" class="btn btn-light btn-rounded mb-4" data-toggle="modal"
                                    style="color:#12ACED" data-target="#modalLoginForm"><i class="iconify nav-icon mr-3"
                                        data-icon="line-md:account-add"></i>Tambah Klien</a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="color:white; background:#1265A8; padding:10px;">
                                        <div class="modal-header text-start">
                                            <h5 class="modal-title w-100 font-weight-bold">Tambah Klien</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                style="color: white;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <form class="" method="POST" action="{{ route('tambahKlien') }}">
                                            @csrf
                                            <div class="modal-body mx-3">
                                                <div class="mb-2">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-Username">Nama Klien</label>
                                                    <input type="text" name="name" id="defaultForm-username"
                                                        class="form-control validate" placeholder="Input nama">
                                                </div>

                                                <div class="mb-2">
                                                    <i class="iconify nav-icon mr-3" data-icon="ic:outline-email"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-email">Email</label>
                                                    <input type="email" name="email" id="defaultForm-email"
                                                        class="form-control validate" placeholder="Input email"
                                                        style="color:black;">
                                                </div>

                                                <div class="mb-2">
                                                    <i class="iconify nav-icon mr-3"
                                                        data-icon="teenyicons:password-outline"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-pass">Password</label>
                                                    <input type="password" name="password" id="defaultForm-pass"
                                                        class="form-control validate" placeholder="Input password"
                                                        style="color:black;">
                                                </div>

                                                <div class="mb-2">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-Username">Kontak</label>
                                                    <input type="text" name="kontak" id="defaultForm-kontak"
                                                        class="form-control validate" placeholder="Input kontak"
                                                        style="color:black;">
                                                </div>

                                                <div class="mb-2">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-Username">Alamat</label>
                                                    <input type="text" name="alamat" id="defaultForm-alamat"
                                                        class="form-control validate" placeholder="Input alamat"
                                                        style="color:black;">
                                                </div>

                                                <div class="mb-2">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-Username">Tahun Langganan</label>
                                                    <input type="text" name="tahun_langganan" id="defaultForm-tahun"
                                                        class="form-control validate" placeholder="Input tahun"
                                                        style="color:black;">
                                                </div>

                                                <div class="mb-2">
                                                    <i class="mr-3 fas fa-globe"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-latitude">Latitude</label>
                                                    <input type="number" step=any name="latitude"
                                                        id="defaultForm-latitude" class="form-control validate"
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
                                                    <label for="server" class="ml-3">Server</label>
                                                    <select class="custom-select form-control validate" id="server_id"
                                                        name="server_id" aria-label="Default select example"
                                                        style="color:black;">
                                                        <option value="">none</option>
                                                        @foreach ($server as $s)
                                                            <option value="{{ $s->id }}">
                                                                {{ $s->nama_server }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Tambah Klien</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalLoginTeknisi" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="color:white; background:#1265A8; padding:10px;">
                                        <div class="modal-header text-start">
                                            <h5 class="modal-title w-100 font-weight-bold">Tambah Teknisi</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close" style="color: white;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <form class="" method="POST" action="">
                                            @csrf
                                            <div class="modal-body mx-3">
                                                <div class="mb-2">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-Username">Nama Teknisi</label>
                                                    <input type="text" name="name" id="defaultForm-username"
                                                        class="form-control validate" placeholder="Input nama">
                                                </div>

                                                <div class="mb-2">
                                                    <i class="iconify nav-icon mr-3" data-icon="ic:outline-email"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-email">Email</label>
                                                    <input type="email" name="email" id="defaultForm-email"
                                                        class="form-control validate" placeholder="Input email">
                                                </div>

                                                <div class="mb-2">
                                                    <i class="iconify nav-icon mr-3"
                                                        data-icon="teenyicons:password-outline"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-pass">Password</label>
                                                    <input type="password" name="password" id="defaultForm-pass"
                                                        class="form-control validate" placeholder="Input password">
                                                </div>




                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Tambah Teknisi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- /modal -->

                        </div>
                    </div>
                @elseif (Auth::user()->role == 'teknisi')
                @endif --}}
            </div>
        </div>
        <div class="container-fluid">
            {{-- <div class="col-12">
                    <a href="{{ route('create') }}" class="btn btn-primary mb-3">Tambah Data Produk</a> --}}
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><b>List Klien</b></h1>
                </div>
                <!-- /.card-header -->
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
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Nama Klien</th>
                                    <th scope="col">Kontak</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Server</th>
                                    <th scope="col">Perangkat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($d->image)
                                            <img src="{{ asset('storage/' . $d->image) }}" class="img-fluid" alt="image"
                                                width="30" />
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->kontak }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>{{ $d->server->nama_server }}</td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <a href="{{ route('detailDevice', ['id' => $d->id]) }}"
                                                class="btn btn-info">{{ $d->device->count() }} <i
                                                    class="iconify nav-icon ml-auto" data-icon="bxs:detail"></i>
                                            </a>
                                        </td>
                                        <td>

                                            <a href="{{ route('editKlien', ['id' => $d->id]) }}" class="btn btn-primary"><i
                                                    class= "fas fa-pen"></i></a>
                                            <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"
                                                class="btn btn-danger"><i class= "fas fa-trash-alt"></i></a>
                                            <a href="{{ route('editKlien', ['id' => $d->id]) }}" class="btn btn-success"><i
                                                    class= "fa-solid fa-map-location-dot"></i></a>
                                        </td>
                                    @elseif(Auth::user()->role == 'teknisi')
                                        <td>
                                            <a href="{{ route('teknisi.detailDevice', ['id' => $d->id]) }}"
                                                class="btn btn-info">{{ $d->device->count() }} <i
                                                    class="iconify nav-icon ml-auto" data-icon="bxs:detail"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('teknisi.klienlokasi', ['id' => $d->id]) }}"
                                                class="btn btn-success">Lihat lokasi <i
                                                    class= "fa-solid fa-map-location-dot"></i></a>
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
                                                <p>Apakah Anda yakin ingin menghapus data user
                                                    <b>{{ $d->nama }}</b>
                                                </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <form action="{{ route('deleteKlien', ['id' => $d->id]) }}" method="POST">
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
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
        </div>
    </div>
    </div><!-- /.container-fluid -->
@endsection
