@extends('dashboard.admin.layouts.app')
@section('content')
<style>
    .custom-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0; /* Border utama di sekitar card */
        border-top: 4px solid green; /* Border atas dengan warna yang menonjol */
        max-height: 180px; /* Atur tinggi maksimum card di sini */
        overflow-y: auto;
    }

    .custom-card ul li {
        padding: 5px 0; /* Sesuaikan padding untuk mengurangi tinggi item list */
        border-bottom: 1px solid #e0e0e0;
        font-size: 14px; /* Sesuaikan ukuran font jika perlu */
        font-family: "Poppins"
    }

    .custom-card ul li:last-child {
        border-bottom: none;
    }

    .custom-card .btn {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        padding: 2px 6px; /* Sesuaikan padding tombol untuk tinggi yang lebih baik */
    }

    .custom-card .btn:hover {
        background-color: #f0f0f0;
        color: #333;
        border-color: #ddd;
    }

    .custom-card .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .custom-card .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #fff;
    }

    .custom-card .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
</style>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <th style="background-color: rgb(233, 246, 232)">Data Kamar</strong></th>
                            <th class="text-end" style="background-color: rgb(233, 246, 232)">
                                <a href="#" id="btn-add" class="btn btn-outline-success btn-sm"><i class="lni lni-codepen"></i></a>
                            </th>
                        </table>
                    </div>
                </div>
                <div id="searchWrapper" class="mb-3">
                    <input type="text" id="customSearchInput" placeholder="Search" class="form-control">
                </div>
                <div class="col-md-12" id="tableWrapper">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped" id="tableKamar" style="width: 100%; height: 50%">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center text-light">NO</th>
                                    <th class="text-center text-light">NAMA KAMAR</th>
                                    <th class="text-center text-light">PEMBIMBING</th>
                                    <th class="text-center text-light">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12" id="cardView" ></div>
                <div class="col-md-12" id="pagination"></div>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Modal Add-->
    <div class="modal fade" id="modalAddKamar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kamar</h1>
                    <button type="button" class="btn-close xeditmodal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAdd">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="nama_kamar" class="col-form-label">Nama Kamar</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="nama_kamar" class="form-control" name="nama_kamar">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="pembimbing_kamar" class="col-form-label">Pembimbing</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="pembimbing_kamar" class="form-control" name="pembimbing">
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
                                <label for="editKamar" class="col-form-label">Nama Kamar</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="editKamar" class="form-control" name="nama_kamar">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="editPembimbing" class="col-form-label">Pembimbing</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="editPembimbing" class="form-control" name="pembimbing">
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
        var table = $('#tableKamar').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/data-kamar',
                "type": 'GET',
            },
            drawCallback: function(settings){
                $('#pagination').text('Total Of Data '+settings.json.recordsTotal);
                convertTableToCardView();
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama_kamar', name: 'nama_kamar'},
                {data: 'pembimbing', name: 'pembimbing'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
        // Custom search input event
        $('#customSearchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
        // Function to convert table data to card view
        function convertTableToCardView() {
            const data = table.rows().data().toArray();

            const cardView = $('#cardView');
            $('#searchWrapper').show()
            // Clear card view content
            cardView.empty();
            // Iterate over each row of data
            data.forEach(row => {
                // Assuming row data order: nama kamar, pembimbing
                var id = row['id'];
                const nama_kamar = row['nama_kamar'];
                const pembimbing = row['pembimbing'];

                // Create card elements
                const card = $('<div class="card custom-card p-3 rounded shadow-sm mb-1"></div>');

                card.html(`
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-fill pe-3">
                            <ul class="list-unstyled mb-0">
                                <li>NAMA : <strong>${nama_kamar}</strong> </li>
                                <li>PEMBIMBING : <strong>${pembimbing}</strong> </li>
                            </ul>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <a href="#" data-id="${id}" class="btn_edit btn btn-outline-primary btn-sm mb-2 rounded-pill">
                                <i class="lni lni-pencil-alt"></i>
                            </a>
                            <a href="#" data-id="${id}" class="btn_delete btn btn-outline-danger btn-sm rounded-pill">
                                <i class="lni lni-trash-can"></i>
                            </a>
                        </div>
                    </div>
                `);

                cardView.append(card);
            });
        }
        // Call the function to populate card view
        convertTableToCardView();
    });

    $('#btn-add').click(function(){
        $('#modalAddKamar').modal('show');
    });
    $('#formAdd').submit(function(e){
        e.preventDefault();
        $('#loader').show();
        $.ajax({
            url: '/store-kamar',
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
                    $('#nama_kamar').val(null);
                    $('#pembimbing_kamar').val(null);
                    $('#modalAddKamar').modal('hide');
                    $('#tableKamar').DataTable().ajax.reload();
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

    $('body').on('click','.btn_edit',function(){
        $('#loader').show();
        var id = $(this).data('id');
        $.ajax({
            url: '/id-kamar/'+id,
            type: 'GET',
            success: function(res){
                $('#loader').hide();
                $('#dataId').val(res.id);
                $('#editKamar').val(res.nama_kamar);
                $('#editPembimbing').val(res.pembimbing);
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
            var id = $('#dataId').val();
            $('#loader').show();
            $.ajax({
                url: '/update-kamar',
                type: 'POST',
                data: $('#formEdit').serialize(),
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
                        $('#modalFormEdit').modal('hide');
                        $('#tableKamar').DataTable().ajax.reload();
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
            $('#editKamar').val(null);
            $('#editPembimbing').val(null);
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
                url: '/delete-kamar/'+id,
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
                        timer: 1000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    }).then(()=>{
                        $('#tableKamar').DataTable().ajax.reload();
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


