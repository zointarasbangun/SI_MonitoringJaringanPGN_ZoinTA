@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="col-sm-6 mt-3 mb-2">
            <h3 class="mb-4">Edit Data Akun</h3>
        </div>
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
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" style="color: white;">Password Saat Ini</label>
                                                    <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                                                        id="exampleInputPassword1">
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
                                                    <label for="exampleInputPassword1" style="color: white;">Password Baru</label>
                                                    <input type="password" name="password" class="form-control""
                                                        id="exampleInputPassword1" placeholder=" Masukkan Password Baru">
                                                    {{-- @error('password')
                                            <small>{{ $message }}</small>
                                          @enderror --}}
                                                </div>
                                                <div class="form-group">
                                                    <label for="role" style="color: white;">Role</label>
                                                    <select class="custom-select" name="role">
                                                        <option value="Klien" {{ old('role') == 'pembeli' ? 'selected' : '' }}>Klien</option>
                                                        <option value="Teknisi" {{ old('role') == 'pedagang' ? 'selected' : '' }}>Teknisi
                                                        </option>
                                                    </select>

                                                    <div class="input-group-append">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                <button type="submit" class="btn btn-danger">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!--/.col (left) -->
                            </div><!-- /.container-fluid -->
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
