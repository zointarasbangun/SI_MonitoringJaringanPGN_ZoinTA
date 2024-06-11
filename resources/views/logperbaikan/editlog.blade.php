@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="col-sm-6 mt-3 mb-2">
            <h3 class="mb-4">Edit Data Log</h3>
        </div>
        <div class="card" style="background:#1265A8" padding:10px;">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        @if (Auth::user()-> role == 'admin')
                        <form method="POST" action="{{ route('updatelog', ['id' => $log->id]) }} "
                            enctype="multipart/form-data">
                        @else
                        <form method="POST" action="{{ route('teknisi.updatelog', ['id' => $log->id]) }} "
                                enctype="multipart/form-data">
                        @endif

                        @csrf
                        @method('POST')
                        <div class="card-body text-light">
                            <div class="mb-2 ">
                                <i class="mr-3 fa-regular fa-user"></i>
                                <label data-error="wrong" data-success="right" for="defaultForm-Username">Nama
                                    Teknisi</label>
                                <input type="text" name="teknisi" id="defaultForm-username" class="form-control validate"
                                    placeholder="Input nama" value="{{ $namaTeknisi }}" style="color:black;" readonly>
                            </div>

                            <div class="mb-2">
                                <i class="iconify nav-icon" data-icon="uil:server"></i>
                                <label for="user_id" class="ml-3">Klien</label>
                                <select class="custom-select form-control validate" id="user_id" name="user_id"
                                    aria-label="Default select example" style="color:black;">
                                    <option value="">none</option>
                                    @foreach ($user as $s)
                                        <option value="{{ $s->id }}" {{ $s->id == $log->user_id ? 'selected' : '' }}>
                                            {{ $s->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-2">
                                <i class="iconify nav-icon" data-icon="uil:server"></i>
                                <label for="server" class="ml-3">Server</label>
                                <select class="custom-select form-control validate" id="server_id" name="server_id"
                                    aria-label="Default select example" style="color:black;">
                                    <option value="">none</option>
                                    @foreach ($server as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $s->id == $log->server_id ? 'selected' : '' }}>{{ $s->nama_server }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="device_id">Device</label>
                                <select class="custom-select form-control validate" id="device_id" name="device_id"
                                    aria-label="Default select example" style="color:black;">
                                    <option value="">none</option>
                                    @foreach ($device as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $s->id == $log->device_id ? 'selected' : '' }}>{{ $s->nama_perangkat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control validate"
                                    style="color:black;" value="{{ $log->tanggal }}">
                            </div>

                            <!-- Tambahkan kolom judul dengan nilai dari database -->
                            <div class="mb-2">
                                <label for="judul">Judul</label>
                                <select name="judul" id="judul" class="form-control validate" style="color:black;">
                                    @foreach (App\Models\Logperbaikan::getEnumValues('judul') as $judulValue)
                                        <option value="{{ $judulValue }}">{{ $judulValue }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" name="judul_manual" id="judul_manual"
                                        class="form-control mt-2" placeholder="Permasalahan lainnya" value=""> --}}
                            </div>


                            <!-- Tambahkan kolom keterangan -->
                            <div class="mb-2">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control validate" name="keterangan" id="keterangan" rows="3" style="color:black;">{{ $log->keterangan }}</textarea>
                            </div>

                            <!-- Tambahkan kolom foto -->
                            <div class="form-group text-light">
                                <label for="current_foto" style="color: white;">Current Image</label><br>
                                @if ($log->foto)
                                    <img src="{{ asset('storage/' . $log->foto) }}" alt="Current Image"
                                        style="max-width: 200px;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </div>
                            <!-- File input for new image -->
                            <div class="form-group">
                                <label for="foto" style="color: white;">New Foto</label>
                                <input type="file" name="foto" class="form-control" id="foto" accept="foto/*">
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Perbaharui Laporan</button>
                        </div>

                        </form>

                    </div><!-- /.container-fluid -->

                </section>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // AJAX untuk mengambil data device berdasarkan klien yang dipilih
        $(document).ready(function() {
            $('#user_id').change(function() {
                var userId = $(this).val();
                if (userId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('getDevicesByClient') }}",
                        data: {
                            'user_id': userId
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#device_id').empty();
                            $.each(data, function(key, value) {
                                $('#device_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#device_id').empty();
                }
            });
        });

        // AJAX untuk mengambil data server berdasarkan klien yang dipilih
        $(document).ready(function() {
            $('#user_id').change(function() {
                var userId = $(this).val();
                if (userId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('getServersByClient') }}",
                        data: {
                            'user_id': userId
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#server_id').empty();
                            $.each(data, function(key, value) {
                                $('#server_id').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#server_id').empty();
                }
            });
        });
    </script>
@endsection
