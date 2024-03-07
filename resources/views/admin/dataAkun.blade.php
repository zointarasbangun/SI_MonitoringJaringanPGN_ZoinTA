@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="card" style="background:#1265A8" padding:10px;">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
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
                                    <a href="{{ route('tambahAkun') }}" class="btn btn-light mb-3 float-right">Tambah Data</a>
                                </div>

                            </div>
                        </div>
                        {{-- <div class="col-12">
                    <a href="{{ route('create') }}" class="btn btn-primary mb-3">Tambah Data Produk</a> --}}

                    </div>
            </div> <!-- /.card -->
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
                                <td>{{ $d->password}}</td>
                                <td>{{ $d->role}}</td>
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
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
