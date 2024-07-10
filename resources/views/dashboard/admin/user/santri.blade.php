@extends('dashboard.admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h4>User Santri</h4>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-stripped" id="tableUserSantri" style="width: 100%; height: 50%">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NIS</th>
                            <th class="text-center">NAMA</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Modal edit-->
    <div class="modal fade" id="modalFormEdit" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User Santri</h1>
                    <button type="button" class="btn-close xeditmodal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEdit">
                        @csrf
                        {{--  @method('PUT')  --}}
                        <input type="hidden" id="dataId" name="id">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="inputNis" class="col-form-label">NIS</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="inputNis" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="inputName" class="col-form-label">Nama</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="inputName" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="inputPass" class="col-form-label">Password</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="inputPass" class="form-control" name="password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
  <script>

    $(document).ready(function(){
        $('#tableUserSantri').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/getUserSantri',
                "type": 'GET',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'username', name: 'username'},
                {data: 'nama_lengkap', name: 'nama_lengkap'},
                {data: 'action', orderable: false, searchable: false}

            ],
            "deferLoading": 57,
            "deferRender": true,  // Defer rendering for improved performance
            "paging": true,       // Enable pagination
            "pageLength": 5,     // Number of records per page
        });
    });

    $('body').on('click','.btn_edit',function(){
        $('#loader').show();
        var id = $(this).data('id');
        $.ajax({
            url: '/getUserSantriById/'+id,
            type: 'GET',
            success: function(res){
                $('#loader').hide();
                $('#dataId').val(res.id);
                $('#inputNis').val(res.username);
                $('#inputName').val(res.nama_lengkap);
                $('#modalFormEdit').modal('show');
            },
            error: function(xhr, error){
                $('#loader').hide();
                console.log(xhr)
                console.log(error)
            }
        });
        $('#formEdit').submit(function(e){
            e.preventDefault();
            var uid = $('#dataId').val();
            $('#loader').show();
            $.ajax({
                url: '/update-password/'+uid,
                type: 'POST',
                data: $('#formEdit').serialize(),
                success: function(res){
                    $('#loader').hide();
                    $('#modalFormEdit').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                        toast: true,
                        position: "top-end",
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    });
                },
                error: function(xhr, error){
                    $('#loader').hide();
                    let errorMessages = xhr.responseJSON.errors;
                    Object.keys(errorMessages).forEach((key) => {
                        errorMessages[key].forEach((errorMessage) => {
                            toastr.error(errorMessage);
                        });
                    });
                    $('#modalFormEdit').modal('hide');
                }
            });
        })
    });
  </script>
@endpush


