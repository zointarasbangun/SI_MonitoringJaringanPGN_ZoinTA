@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <div class="row p-5" style=" margin-bottom : 20px; background-color: #1265A8; ">
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title"><b>Daftar Notifikasi</b></h1>
                </div>
                <!-- table -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="table-responsive" style="overflow-x:auto;">
                    <table class="table table-striped text-center" id="tablecar">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Nama Klien</th>
                                <th scope="col">Nama Perangkat</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Pesan</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifikasi as $index => $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($d->devices?->user->image)
                                            <img src="{{ asset('storage/' . $d->devices?->user->image) }}" class="img-fluid"
                                                alt="image" width="30" />
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $d->devices?->user->name }}
                                    </td>
                                    <td>{{ $d->devices?->nama_perangkat }}</td>
                                    <td><span class="badge bg-info">{{ $d->created_at->format('d-m-Y H:i') }}</span></td>
                                    <td>
                                        <span class="badge bg-danger">
                                            {{ $d->message }}
                                        </span>
                                    </td>

                                </tr>
                                <!-- /.modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <!-- /.container-fluid -->
@endsection
