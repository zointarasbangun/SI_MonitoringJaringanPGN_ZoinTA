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
                <div class="col-lg-12 connectedSortable" style="margin-bottom : 20px; background-color: #1265A8; color: #fff;">
                    <h3 style="margin-top: 30px; margin-left: 30px; font-weight: bold;">Klien</h3>
                    <div class="container fluid ">
                        <div class="row d-flex justify-content-around">
                            <div class="col-lg-3 col-md-6">
                                <div class="small-box bg-white text-center d-flex flex-column "
                                    style="font-weight: bold; padding: 20px;">
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <h4 style="margin-bottom: 0;">Total Klien</h4>
                                        <i class="iconify nav-icon ml-auto" data-icon="fa6-solid:users"
                                            style="font-size: 36px; color: #1265A8;"></i>
                                    </div>
                                    <p style="font-size: 36px">
                                        11</p>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="small-box bg-white text-center d-flex flex-column "
                                    style="font-weight: bold; padding: 20px;">
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <h4 style="margin-bottom: 0;">Total Perangkat</h4>
                                        <i class="iconify nav-icon ml-auto" data-icon="mingcute:location-3-line"
                                            style="font-size: 36px; color: #1265A8;"></i>
                                    </div>
                                    <p style="font-size: 36px">
                                        11</p>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="small-box bg-white text-center d-flex flex-column "
                                    style="font-weight: bold; padding: 20px;">
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <h4 style="margin-bottom: 0;">Perangkat Klien</h4>
                                        <i class="iconify nav-icon ml-auto" data-icon="mingcute:location-3-line"
                                            style="font-size: 36px; color: #1265A8;"></i>
                                    </div>
                                    <p style="font-size: 36px;">
                                        11</p>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="small-box bg-white text-center d-flex flex-column "
                                    style="font-weight: bold; padding: 20px;">
                                    <div class="d-flex align-items-center justify-content-end mb-3">
                                        <h4 style="margin-bottom: 0;">Total Teknisi</h4>
                                        <i class="iconify nav-icon ml-auto" data-icon="fa-solid:users-cog"
                                            style="font-size: 36px; color: #1265A8;"></i>
                                    </div>
                                    <p style="font-size: 36px">
                                        11</p>
                                </div>
                            </div>



                        </div>
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
                <div class="container-fluid mt-3">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped text-center" id="tableakun">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Klien</th>
                                    <th scope="col">Kontak</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Server</th>
                                    <th scope="col">Perangkat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="" class="btn btn-success"><i
                                                    class= "fa-solid fa-map-location-dot"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-hapus">
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
                                                        <b></b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <form action="" method="POST">
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
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    </div><!-- /.container-fluid -->
@endsection
