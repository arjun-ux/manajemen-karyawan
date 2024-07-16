@extends('dashboard.admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h4>User Admin</h4>
            <hr>
            <a href="#" id="btn-add" class="btn btn-outline-success btn-sm"><i class="lni lni-user"></i></a>
            <div class="table-responsive">
                <table class="table table-bordered table-stripped" id="tableUserAdmin" style="width: 100%; height: 50%">
                    <thead class="bg-dark">
                        <tr>
                            <th class="text-center text-light">NO</th>
                            <th class="text-center text-light">USERNAME</th>
                            <th class="text-center text-light">NAMA</th>
                            <th class="text-center text-light">NO WHATSAPP</th>
                            <th class="text-center text-light">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Modal Add-->
    <div class="modal fade" id="modalAddUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin</h1>
                    <button type="button" class="btn-close xeditmodal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAdd">
                        @csrf
                        <input type="hidden" id="DataId" name="id">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="addUsername" class="col-form-label">Username</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="addUsername" class="form-control" name="username">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="addName" class="col-form-label">Nama</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="addName" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="AddWa" class="col-form-label">No WA</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="addWa" class="form-control" name="no_wa">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="addPass" class="col-form-label">Password</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="addPass" class="form-control" name="password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal edit-->
    <div class="modal fade" id="modalFormEdit" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User Admin</h1>
                    <button type="button" class="btn-close xeditmodal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEdit">
                        @csrf
                        <input type="hidden" id="dataId" name="id">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="inputUsername" class="col-form-label">Username</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="inputUsername" class="form-control" name="username">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="inputName" class="col-form-label">Nama</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="inputName" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="inputNo" class="col-form-label">No WA</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="inputNo" class="form-control" name="no_wa">
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
        $('#tableUserAdmin').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/getUserAdmin',
                "type": 'GET',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'username', name: 'username'},
                {data: 'name', name: 'name'},
                {data: 'no_wa', name: 'no_wa'},
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <a href="#" data-id="${row.id}" class="btn_edit btn btn-outline-primary btn-sm mt-1">
                                <i class="lni lni-pencil-alt"></i>
                            </a>
                            <a href="#" data-id="${row.id}" class="btn_delete btn btn-outline-danger btn-sm mt-1">
                                <i class="lni lni-trash-can"></i>
                            </a>
                        `;
                    }
                }

            ],
            "deferLoading": 57,
            "deferRender": true,  // Defer rendering for improved performance
            "paging": true,       // Enable pagination
            "pageLength": 5,     // Number of records per page
        });
    });

    $('#btn-add').click(function(){
        $('#modalAddUser').modal('show');
        $('#formAdd').submit(function(e){
            e.preventDefault();
            $('#loader').show();
            $.ajax({
                url: '/store-admin',
                type: 'POST',
                data: $('#formAdd').serialize(),
                success: function(res){
                    $('#loader').hide();
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                        toast: true,
                        position: "top-end",
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    }).then(()=>{
                        $('#DataId').val(null);
                        $('#addUsername').val(null);
                        $('#addName').val(null);
                        $('#addWa').val(null);
                        $('#addPass').val(null);
                        $('#modalAddUser').modal('hide');
                        $('#tableUserAdmin').DataTable().ajax.reload();
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
                }
            });
        })
    });

    $('body').on('click','.btn_edit',function(){
        $('#loader').show();
        var id = $(this).data('id');
        $.ajax({
            url: '/get-id-admin/'+id,
            type: 'GET',
            success: function(res){
                console.log(res.data);
                $('#loader').hide();
                $('#dataId').val(res.data.id);
                $('#inputUsername').val(res.data.username);
                $('#inputName').val(res.data.name);
                $('#inputNo').val(res.data.no_wa);
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
                url: '/update-admin',
                type: 'POST',
                data: $('#formEdit').serialize(),
                success: function(res){
                    console.log(res);
                    $('#loader').hide();
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                        toast: true,
                        position: "top-end",
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    }).then(()=>{
                        $('#modalFormEdit').modal('hide');
                        $('#tableUserAdmin').DataTable().ajax.reload();
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
                }
            });
        });
        $('.btn-close').on('click', function(){
            $('#dataId').val(null);
            $('#inputUsername').val(null);
            $('#inputName').val(null);
            $('#inputNo').val(null);
        });
    });

    $('body').on('click','.btn_delete',function(){
        var id = $(this).data('id');
        Swal.fire({
            icon: "question",
            title: 'Anda Yakin Menghapus Data Ini?',
            toast: true,
            position: "top",
            showConfirmButton: true,
            showCancelButton: true,
        }).then((value)=>{
            if(value.isConfirmed){
                deleteAdmin();
            }
        });
        function deleteAdmin(){
            $('#loader').show();
            $.ajax({
                url: '/delete-admin/'+id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res){
                    $('#loader').hide();
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                        toast: true,
                        position: "top-end",
                        timer: 1500,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    }).then(()=>{
                        $('#tableUserAdmin').DataTable().ajax.reload();
                    });
                },
                error: function(xhr, error){
                    $('#loader').hide();
                    console.log(xhr)
                    console.log(error)
                }
            });
        }
    });
  </script>
@endpush


