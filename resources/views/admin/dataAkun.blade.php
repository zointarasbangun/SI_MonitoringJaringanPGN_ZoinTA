@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="container-fluid">
            <div class="card" style="background:#1265A8">
                <!-- /.content-header -->

                <div class="row p-5">
                    <div class="col-lg-4 col-sm-12">
                        <form action="/kendaraan/search" class="form-inline" method="GET">
                            <div class="input-group " style="flex-grow: 10;">
                                <input type="search" class="form-control mr-10" style="width: 200px;" name="search"
                                    id="cariDataKendaraan" placeholder="Cari Akun Pengguna...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary ml-1" type="submit"><i class="iconify"
                                            data-icon="material-symbols:search"></i> Cari</button>
                                    <a href="/tipeKendaraanUser" class="btn btn-danger ml-1"><i class="iconify"
                                            data-icon="solar:refresh-linear"></i> Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <div class="float-right">
                            <!-- Modal -->
                            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="color:white; background:#1265A8; padding:10px;">
                                        <div class="modal-header text-start">
                                            <h4 class="modal-title w-100 font-weight-bold">Tambah Akun User</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                style="color: white;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <form class="" method="POST" action="">
                                            @csrf
                                            <div class="modal-body mx-3">
                                                <div class="mb-5">
                                                    <i class="iconify nav-icon mr-3" data-icon="ic:outline-email"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-email">Email</label>
                                                    <input type="email" name="email" id="defaultForm-email"
                                                        class="form-control validate" placeholder="Input email">
                                                </div>

                                                <div class="mb-5">
                                                    <i class="mr-3 fa-regular fa-user"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-Username">Username</label>
                                                    <input type="text" name="name" id="defaultForm-username"
                                                        class="form-control validate" placeholder="Input nama">
                                                </div>

                                                <div class="mb-5">
                                                    <i class="iconify nav-icon mr-3"
                                                        data-icon="teenyicons:password-outline"></i>
                                                    <label data-error="wrong" data-success="right"
                                                        for="defaultForm-pass">Password</label>
                                                    <input type="password" name="password" id="defaultForm-pass"
                                                        class="form-control validate" placeholder="Input password">
                                                </div>

                                                <div class="mb-5">
                                                    <div class="d-flex align-items-center">
                                                        <i class="iconify" data-icon="carbon:user-role"></i>
                                                        <select class="form-select border-0 w-50 ml-3"
                                                            aria-label="Default select example">
                                                            <option selected value="teknisi">Teknisi</option>
                                                            <option selected value="klien">Klien</option>
                                                        </select>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Buat Akun</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- /modal -->

                            <!-- Button Modal -->
                            <div class="text-center">
                                <a href="" class="btn btn-light btn-rounded mb-4" data-toggle="modal"
                                    style="color:#12ACED" data-target="#modalLoginForm"><i class="iconify nav-icon mr-3"
                                        data-icon="line-md:account-add"></i>Tambah Akun</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main content -->
                {{-- <section class="content">
                    <div class="container-fluid p-5">
                        <div class="card-tools">
                            <h6 style="color: white;">Cari Akun Pengguna:</h6>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append mb-4">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('tambahAkun') }}" class="btn btn-light mb-3 float-right">Tambah
                                        Data</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </section> <!-- /.card --> --}}
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h1 class="card-title"><b>Data Akun</b></h1>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->password }}</td>
                                <td>{{ $d->role }}</td>
                                <td>{{ $d->status }}</td>
                                <td>

                                    <a href="{{ route('editAkun', ['id' => $d->id]) }}" class="btn btn-primary"><i
                                            class= "fas fa-pen"></i></a>
                                    <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"
                                        class="btn btn-danger"><i class= "fas fa-trash-alt"></i></a>
                                    {{-- <a href="#" class="btn btn-primary">
                                        <i class="fa-solid fa-map-location-dot"></i></a> --}}
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
                                            <p>Apakah Anda yakin ingin menghapus data user
                                                <b>{{ $d->nama }}</b>
                                            </p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <form action="{{ route('delete', ['id' => $d->id]) }}" method="POST">
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
        <!-- /.container-fluid -->
    @endsection
