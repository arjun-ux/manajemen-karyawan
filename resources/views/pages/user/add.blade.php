<!-- Modal -->
<div class="modal fade" id="modalAdd">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
      </div>
        <div class="modal-body">
            <form id="formPost">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-group">
                            <label for="name">Nama Lengkap:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">Pilih Role</option>
                                <option value="superadmin">Superadmin</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                    <button class="form-control" type="submit" style="background-color: #0c2435a9; color:whitesmoke">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
