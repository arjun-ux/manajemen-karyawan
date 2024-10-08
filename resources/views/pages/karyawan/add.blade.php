@extends('layouts.app')

@section('content')
<style>
    #previewFoto img {
        max-width: 100%;
        max-height: 200px;
    }
</style>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
        </div>
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-start">
                    <span>Form Tambah <i class="fas fa-sm fa-edit"></i></span>
                </div>
            </div>
            <div class="card-body">
                <form action="#" id="form_simpan" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">No Ktp:</label>
                                <input type="text" name="no_ktp" class="form-control" placeholder="Masukan no ktp">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Nama Lengkap:</label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    placeholder="Masukan nama lengkap">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="">Alamat Tempat Tinggal:</label>
                        <textarea name="alamat_tempat_tinggal" class="form-control" id="" cols="30" rows="5"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Tanggal Lahir:</label>
                                <input type="date" name="tanggal_lahir" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Tempat Lahir:</label>
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukan tempat lahir">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Agama:</label>
                                <input type="text" name="agama" class="form-control" placeholder="Masukan agama">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">No Telepon:</label>
                                <input type="text" name="no_telepon" class="form-control"
                                    placeholder="Masukan no telepon">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Jenis Kelamin:</label>
                                <select name="jenis_kelamin" id="" class="form-control">
                                    <option value="perempuan">Perempuan</option>
                                    <option value="laki-laki">Laki-Laki</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Status Pernikahan:</label>
                                <select name="status_pernikahan" id="" class="form-control">
                                    <option value="sudah">Sudah</option>
                                    <option value="belum">Belum</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Jenjang Pendidikan:</label>
                                <input type="text" name="jenjang_pendidikan" class="form-control"
                                    placeholder="Masukan jenjang pendidikan">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Jabatan Kerja:</label>
                                <input type="text" name="jabatan_kerja" class="form-control"
                                    placeholder="Masukan jabatan kerja">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">No BPJS Ketenaga Kerja:</label>
                                <input type="text" name="no_bpjs_ketenaga_kerja"
                                    placeholder="Masukan no bpjs ketenaga kerja" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Gaji:</label>
                                <input type="number" class="form-control" placeholder="Masukan gaji" name="gaji">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Tanggal Masuk Kerja</label>
                                <input type="date" name="tanggal_masuk_kerja" class="form-control" name="tanggal_mmasuk_kerja">
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Status Kerja</label>
                                <input type="text" name="status_kerja" class="form-control"
                                    placeholder="Masukan status kerja">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Aktif Kerja:</label>
                                <select name="" class="form-control" name="aktif_kerja">
                                    <option value="aktif">Akitf</option>
                                    <option value="tidak aktif">Tidak aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukan email">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="inputFoto">Foto:</label>
                                <input type="file" name="foto" id="inputFoto" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6" id="previewContainer" style="display: none;">
                            <div id="previewFoto"></div>
                        </div>
                    </div>


                    <button class="form-control" type="submit" style="background-color: #0c2435a9; color:whitesmoke">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        document.getElementById('inputFoto').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('previewContainer');
            const previewFoto = document.getElementById('previewFoto');
            const file = event.target.files[0];

            // Clear previous preview
            previewFoto.innerHTML = '';

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    previewFoto.appendChild(img);
                    previewContainer.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
        $(document).ready(function() {
            $("#form_simpan").submit(function(e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '{{ route('karyawan.store') }}',
                    method: 'post',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        console.log(data);
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
