@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="card" style="background:#1265A8" padding:10px;">
            <div class="content-header">
                <div class="container-fluid">

                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="m-2" style="color:white">Tambah Akun</h4>
                        </div><!-- /.col -->
                    </div>
                    <form action=""method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-8">
                                <!-- general form elements -->
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" style="color: white;">Email</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                name="nama" value="{{ old('email') }}">
                                            {{-- @error('nama')
                                         <small>{{ $message }}</small>
                                      @enderror --}}
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" style="color: white;">Username</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                name="Username" value="{{ old('name') }}">
                                            {{-- @error('nama')
                                      <small>{{ $message }}</small>
                                    @enderror --}}
                                        {{-- </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" style="color: white;">Password Saat
                                                Ini</label>
                                            <input type="password" name="password" class="form-control"
                                                value="{{ old('password') }}" id="exampleInputPassword1"> --}}
                                            {{-- @error('password')
                                        <small>{{ $message }}</small>
                                      @enderror --}}
                                            {{-- </div> --}}
                                            {{-- <div class="form-group">
                                                <label for="exampleInputEmail1" style="color: white;">Nomor Telepon</label>
                                                <input type="number" class="form-control" id="exampleInputEmail1"
                                                    name="nama" value="{{ old('email') }}" placeholder="Masukkan Nomor Telepon"> --}}
                                            {{-- @error('nama')
                                        <small>{{ $message }}</small>
                                      @enderror --}}
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" style="color: white;">Password</label>
                                            <input type="password" name="password" class="form-control""
                                                id="exampleInputPassword1" placeholder=" Masukkan Password">
                                            {{-- @error('password')
                                        <small>{{ $message }}</small>
                                      @enderror --}}
                                        </div>
                                        <div class="form-group">
                                            <label for="role" style="color: white;">Role</label>
                                            <select class="custom-select" name="role">
                                                <option value="pembeli" {{ old('role') == 'pembeli' ? 'selected' : '' }}>
                                                    Klien</option>
                                                <option value="pedagang" {{ old('role') == 'pedagang' ? 'selected' : '' }}>
                                                    Teknisi
                                                </option>
                                            </select>

                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Buat Akun</button>

                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
            </div><!-- /.container-fluid -->
            </form>
        </div>
    </div><!-- /.container-fluid -->
@endsection
