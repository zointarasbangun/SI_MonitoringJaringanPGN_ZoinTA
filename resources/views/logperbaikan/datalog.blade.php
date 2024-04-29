@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <div class="row p-5" style=" margin-bottom : 20px; background-color: #1265A8; ">
                <div class="col-lg-2 col-sm-6 text-light">
                    <label for="cariData">Cari :
                        <input type="text" class="form-control" name="search" id="cariData"
                            placeholder="Cari Data..."></label>
                </div>

                <div class="col-lg-5 col-sm-6 text-light">
                    <label for="cariTanggalAwal">Tanggal Awal :
                        <input type="date" class="form-control" name="cariTanggalAwal" id="cariAlamatAwal"
                            placeholder=""></label>
                    <label for="cariTanggalAkhir">Tanggal Akhir :
                        <input type="date" class="form-control" name="cariTanggalAkhir" id="cariAlamatAkhir"
                            placeholder=""></label>

                            <button class="btn btn-primary ml-2" type="submit"><i class="iconify nav-icon"
                            data-icon="material-symbols:search"></i></button>

                    <a href=" " class="btn btn-danger "><i class="iconify" data-icon="solar:refresh-linear"></i>
                    </a>
                </div>

                <div class="col-lg-5 col-sm-6 mt-4">
                    <div class="float-right">

                        <!-- Modal -->
                        <a href="" class="btn btn-light btn-rounded " data-toggle="modal" style="color:#12ACED"
                            data-target="#modalLoginRole"><i class="iconify nav-icon mr-3"
                                data-icon="line-md:account-add"></i>Tambah Akun</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
