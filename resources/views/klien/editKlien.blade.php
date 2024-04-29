@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="col-sm-6 mt-3 mb-2">
            <h3 class="mb-4">Edit Data Klien</h3>
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
                        <form method="POST" action="{{ route('updateKlien', ['id' => $user->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                            <div class="form-group">
                                <label for="name" style="color: white;">Username</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <label for="email" style="color: white;">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <label for="kontak" style="color: white;">Kontak</label>
                                <input type="text" class="form-control" id="kontak" name="kontak"
                                    value="{{ $user->kontak }}">
                            </div>

                            <div class="form-group">
                                <label for="alamat" style="color: white;">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="{{ $user->alamat }}">
                            </div>

                            <div class="form-group">
                                <label for="tahun_langganan" style="color: white;">Tahun Langganan</label>
                                <input type="text" class="form-control" id="tahun_langganan" name="tahun_langganan"
                                    value="{{ $user->tahun_langganan }}">
                            </div>

                            <div class="form-group">
                                <label for="latitude" style="color: white;">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                    value="{{ $user->latitude }}">
                            </div>

                            <div class="form-group">
                                <label for="longitude" style="color: white;">longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                    value="{{ $user->longitude }}">
                            </div>

                            <div class="form-group">
                                <label for="server" style="color: white;">Server:</label>
                                <select class="custom-select" id="server_id" name="server_id"
                                    aria-label="Default select example" style="color:black;">
                                    <option value="">none</option>
                                    @foreach ($server as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $s->id == $user->server_id ? 'selected' : '' }}>{{ $s->nama_server }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="role" style="color: white;">Role</label>
                                <select class="custom-select" name="role">
                                    <option value="Klien" {{ old('role') == 'Klien' ? 'selected' : '' }}>Klien</option>
                                    <option value="Teknisi" {{ old('role') == 'Teknisi' ? 'selected' : '' }}>Teknisi
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputimage" style="color: white;">Logo</label>
                                <input type="file" name="image" class="form-control" id="image"
                                    placeholder=" Masukkan image" value="{{ $user->image }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1" style="color: white;">Password</label>
                                <input type="password" name="password" class="form-control"" id="exampleInputPassword1"
                                    placeholder=" Masukkan Password">
                            </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <a href="{{ route('dataKlien') }}" class="btn btn-danger">Cancel</a>
                    </div>

                    </form>

            </div><!-- /.container-fluid -->

            </section>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div><!-- /.container-fluid -->
@endsection
