@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="col-sm-6 mt-3 mb-2">
            <h3 class="mb-4">Edit Data Server</h3>
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
                        <form method="POST" action="{{ route('updateServer', ['id' => $server->id]) }}">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <div class="mb-2 text-light">
                                    <i class="mr-3 fa-regular fa-user"></i>
                                    <label data-error="wrong" data-success="right" for="defaultForm-server">Nama
                                        Server</label>
                                    <input type="text" name="nama_server" id="defaultForm-username"
                                        class="form-control validate" placeholder="Input nama server"
                                        value="{{ $server->nama_server }}">
                                </div>

                                <div class="mb-2 text-light">
                                    <i class="mr-3 fas fa-globe"></i>
                                    <label data-error="wrong" data-success="right"
                                        for="defaultForm-latitude">Latitude</label>
                                    <input type="number" step=any name="latitude" id="defaultForm-latitude"
                                        class="form-control validate"
                                        placeholder="Input Latitude (contoh: -6.1754)"value="{{ $server->latitude }}">
                                </div>

                                <div class="mb-2 text-light">
                                    <i class="mr-3 fas fa-globe"></i>
                                    <label data-error="wrong" data-success="right"
                                        for="defaultForm-longitude">Longitude</label>
                                    <input type="number" step=any name="longitude" id="defaultForm-latitude"
                                        class="form-control validate"
                                        placeholder="Input Longitude (contoh: 111.1754)"value="{{ $server->longitude }}">
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <a href="{{ route('dataServer') }}" class="btn btn-danger">Cancel</a>
                                @if (session('dataServerMessage'))
                                    <div class="alert alert-warning">
                                        {{ session('dataServerMessage') }}
                                    </div>
                                @endif
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
