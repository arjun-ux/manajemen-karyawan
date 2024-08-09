@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
        </div>


        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-start">
                    <span>Form Edit <i class="fas fa-sm fa-edit"></i></span>
                </div>
            </div>
            <div class="card-body">
                <form action="#" id="form_simpan" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $karyawan->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">No Ktp:</label>
                                <input type="text" name="no_ktp" class="form-control" placeholder="Masukan no ktp"
                                    value="{{ $karyawan->no_ktp }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Nama Lengkap:</label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    placeholder="Masukan nama lengkap" value="{{ $karyawan->nama_lengkap }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="">Alamat Tempat Tinggal:</label>
                        <textarea name="alamat_tempat_tinggal" class="form-control" id="" cols="30" rows="5">{{ $karyawan->alamat_tempat_tinggal }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Tanggal Lahir:</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ $karyawan->tanggal_lahir }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Tempat Lahir:</label>
                                <input type="text" name="tempat_lahir" class="form-control"
                                    placeholder="Masukan tempat lahir" value="{{ $karyawan->tempat_lahir }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Agama:</label>
                                <input type="text" name="agama" class="form-control" placeholder="Masukan agama"
                                    value="{{ $karyawan->agama }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">No Telepon:</label>
                                <input type="text" name="no_telepon" class="form-control"
                                    placeholder="Masukan no telepon" value="{{ $karyawan->no_telepon }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Jenis Kelamin:</label>
                                <select name="jenis_kelamin" id="" class="form-control">
                                    <option value="perempuan" @if ($karyawan->jenis_kelamin == 'perempuan') selected @endif>Perempuan
                                    </option>
                                    <option value="laki-laki" @if ($karyawan->jenis_kelamin == 'laki-laki') selected @endif>Laki-Laki
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Status Pernikahan:</label>
                                <select name="status_pernikahan" id="" class="form-control">
                                    <option value="sudah" @if ($karyawan->jenis_kelamin == 'sudah') selected @endif>Sudah</option>
                                    <option value="belum" @if ($karyawan->jenis_kelamin == 'belum') selected @endif>Belum</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Jenjang Pendidikan:</label>
                                <input type="text" name="jenjang_pendidikan" class="form-control"
                                    placeholder="Masukan jenjang pendidikan" value="{{ $karyawan->jenjang_pendidikan }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Jabatan Kerja:</label>
                                <input type="text" name="jabatan_kerja" class="form-control"
                                    placeholder="Masukan jabatan kerja" value="{{ $karyawan->jabatan_kerja }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">No BPJS Ketenaga Kerja:</label>
                                <input type="text" name="no_bpjs_ketenaga_kerja"
                                    placeholder="Masukan no bpjs ketenaga kerja" class="form-control"
                                    value="{{ $karyawan->no_bpjs_ketenaga_kerja }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Gaji:</label>
                                <input type="number" class="form-control" placeholder="Masukan gaji" name="gaji"
                                    value="{{ $karyawan->gaji }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Tanggal Masuk Kerja</label>
                                <input type="date" name="tanggal_masuk_kerja" class="form-control"
                                    name="tanggal_mmasuk_kerja" value="{{ $karyawan->tanggal_masuk_kerja }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Status Kerja</label>
                                <input type="text" name="status_kerja" class="form-control"
                                    placeholder="Masukan status kerja" value="{{ $karyawan->status_kerja }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Aktif Kerja:</label>
                                <select name="status_aktif" class="form-control" name="aktif_kerja">
                                    <option value="aktif" @if ($karyawan->jenis_kelamin == 'aktif') selected @endif>Akitf</option>
                                    <option value="tidak aktif" @if ($karyawan->jenis_kelamin == 'tidak aktif') selected @endif>Tidak
                                        aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Foto:</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukan email"
                                    value="{{ $karyawan->email }}">
                            </div>
                        </div>
                    </div>


                    <button class="form-control" type="submit" style="background-color: #0c2435a9; color:whitesmoke">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $("#form_simpan").submit(function(e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '{{ route('karyawan.update') }}',
                    method: 'post',
                    data: formData,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: data.status,
                                text: data.message,
                                title: 'Berhasil',
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            $('#form_simpan')[0].reset();
                            setTimeout(function() {
                                window.location.href = '{{ route('karyawan.index') }}';
                            }, 1500);
                            $('#form_simpan')[0].reset();
                        } else {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
