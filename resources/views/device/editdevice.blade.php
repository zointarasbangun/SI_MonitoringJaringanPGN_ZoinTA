@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="col-sm-6 mt-3 mb-2">
            <h3 class="mb-4">Edit Data Device</h3>
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
                        <form method="POST" action="{{ route('updateDevice', ['id' => $device->id]) }}" enctype="multipart/form-data>
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <div class="mb-2 text-light">
                                    <i class="mr-3 fa-regular fa-user"></i>
                                    <label data-error="wrong" data-success="right" for="defaultForm-namaperangkat">Nama
                                        Perangkat</label>
                                    <input type="text" name="nama_perangkat" id="defaultForm-namaperangkat"
                                        class="form-control validate" placeholder="Input nama perangkat"
                                        value="{{ $device->nama_perangkat }}">
                                </div>

                                <div class="mb-2 text-light">
                                    <i class="mr-3 fas fa-globe"></i>
                                    <label data-error="wrong" data-success="right"
                                        for="defaultForm-latitude">Latitude</label>
                                    <input type="number" step=any name="latitude" id="defaultForm-latitude"
                                        class="form-control validate" placeholder="Input Latitude (contoh: -6.1754)"
                                        value="{{ $device->latitude }}">
                                </div>

                                <div class="mb-2 text-light">
                                    <i class="mr-3 fas fa-globe"></i>
                                    <label data-error="wrong" data-success="right"
                                        for="defaultForm-longitude">Longitude</label>
                                    <input type="number" step=any name="longitude" id="defaultForm-longitude"
                                        class="form-control validate" placeholder="Input Longitude (contoh: 111.1754)"
                                        value="{{ $device->longitude }}">
                                </div>

                                <div class="mb-2 text-light">
                                    <i class="iconify nav-icon" data-icon="uil:server"></i>
                                    <label for="klien" class="ml-3">Pilih Klien</label>
                                    <select class="custom-select form-control validate" id="user_id" name="user_id"
                                        aria-label="Default select example" style="color:black;">
                                        @foreach ($user as $s)
                                            <option value="{{ $s->id }}"
                                                {{ $s->id == $device->user_id ? 'selected' : '' }}>{{ $s->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-2 text-light">
                                    <i class="mr-3 fas fa-globe"></i>
                                    <label data-error="wrong" data-success="right" for="defaultForm-ip">IP
                                        Perangkat</label>
                                    <input type="text" name="ip_perangkat" id="defaultForm-ip"
                                        class="form-control validate" placeholder="Input IP (contoh: 192.168.1.1)"
                                        value="{{ $device->ip_perangkat }}">
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <a href="{{ route('dataDevice') }}" class="btn btn-danger">Cancel</a>
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
