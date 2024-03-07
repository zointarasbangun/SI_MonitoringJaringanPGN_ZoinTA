@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="card" style="background:#1265A8" padding:10px;">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-2" style="color:white">Admin</h1>
                        </div><!-- /.col -->
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class=" mr-5 col-lg-2 col-1"">
                                <!-- small box -->
                                <div class=" small-box bg-white" style="font-weight: bold;">
                                    <div class="inner">
                                        <h6
                                            style="vertical-align: middle; margin-right: 10px; color:#1265A8;  text-align:center">
                                            Total Server</h6>
                                        <p style="font-size: 36px; color:#1265A8; text-align:center">2</p>
                                        <a href="#" class="small-box-footer"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="mr-5 col-lg-2 col-1 mr-2">
                                <!-- small box -->
                                <div class="small-box bg-white" style="font-weight: bold;">
                                    <div class="inner">
                                        <h6
                                            style="vertical-align: middle; margin-right: 10px; color:#1265A8;  text-align:center">
                                            Total Klien</h6>
                                        <p style="font-size: 36px; color:#1265A8; text-align:center">2</p>
                                        <a href="#" class="small-box-footer"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="mr-5 col-lg-2 col-1 mr-2">
                                <!-- small box -->
                                <div class="small-box bg-white" style="font-weight: bold;">
                                    <div class="inner">
                                        <h6
                                            style="vertical-align: middle; margin-right: 10px; color:#1265A8;  text-align:center">
                                            Total Perangkat</h6>
                                        <p style="font-size: 36px; color:#1265A8; text-align:center">2</p>
                                        <a href="#" class="small-box-footer"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class=" col-lg-2 col-1 mr-5">
                                <!-- small box -->
                                <div class="small-box bg-white" style="font-weight: bold;">
                                    <div class="inner">
                                        <h6
                                            style="vertical-align: middle; margin-right: 10px; color:#1265A8;  text-align:center">
                                            Teknisi</h6>
                                        <p style="font-size: 36px; color:#1265A8; text-align:center">2</p>
                                        <a href="#" class="small-box-footer"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                    </div>
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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Klien</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Server</th>
                                <th>Perangkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->kontak }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>{{ $d->server }}</td>
                                    <td>{{ $d->perangkat }}</td>
                                    <td>

                                        <a href="{{ route('editAkun', ['id' => $d->id]) }}" class="btn btn-primary"><i
                                                class= "fas fa-pen"></i></a>
                                        <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"
                                            class="btn btn-danger"><i class= "fas fa-trash-alt"></i></a>
                                            <a href="#" class="btn btn-primary">
                                                <i class="fa-solid fa-map-location-dot"></i></i></a>
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
            <!-- /.card -->
        </div>
    </div>
    </div><!-- /.container-fluid -->
@endsection
