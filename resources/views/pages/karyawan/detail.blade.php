<!-- Modal -->
<div class="modal fade" id="modalDetail">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Karyawan</h5>

      </div>
        <div class="modal-body">
            <div class="d-flex mb-2">
                <div class="col-md-3">
                    <img  id="foto" class="img-thumbnail" src="" alt="foto" width="250px">

                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">No Ktp:</label>
                            <input type="text" name="no_ktp" id="no_ktp" class="form-control" readonly>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Lengkap:</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">Alamat Tempat Tinggal:</label>
                            <textarea name="alamat_tempat_tinggal" class="form-control" id="alamat_tempat_tinggal" cols="10" rows="5" readonly></textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Lahir:</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tempat Lahir:</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Agama:</label>
                        <input type="text" name="agama" id="agama" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">No Telepon:</label>
                        <input type="text" name="no_telepon" id="no_telepon" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jenis Kelamin:</label>
                        <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Status Pernikahan:</label>
                        <input type="text" id="status_pernikahan" name="status_pernikahan" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Jenjang Pendidikan:</label>
                        <input type="text" name="jenjang_pendidikan" id="jenjang_pendidikan" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Jabatan Kerja:</label>
                        <input type="text" name="jabatan_kerja" id="jabatan_kerja" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">No BPJS Ketenaga Kerja:</label>
                        <input type="text" name="no_bpjs_ketenaga_kerja" id="no_bpjs_ketenaga_kerja" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Gaji:</label>
                        <input type="text" class="form-control" id="gaji" name="gaji">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal Masuk Kerja</label>
                        <input type="text" name="tanggal_masuk_kerja" class="form-control"
                            id="tanggal_mmasuk_kerja" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Status Kerja</label>
                        <input type="text" name="status_kerja" id="status_kerja" class="form-control"
                            placeholder="Masukan status kerja" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Aktif Kerja:</label>
                        <input type="text" name="status_aktif" id="status_aktif" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
