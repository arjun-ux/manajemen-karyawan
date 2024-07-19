@extends('dashboard.admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <th style="background-color: rgb(233, 246, 232)">Pembayaran</th>
                            <th class="text-end" style="background-color: rgb(233, 246, 232)">
                                <a href="#" id="btn-add" class="btn btn-outline-success btn-sm"><i class="lni lni-wallet"></i></a>
                            </th>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped " id="TablejenisPembayaran" style="width: 100%; height: 50%">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center text-light">NO</th>
                                    <th class="text-center text-light">Jenis Pembayaran</th>
                                    <th class="text-center text-light">Jumlah</th>
                                    <th class="text-center text-light">Keterangan</th>
                                    <th class="text-center text-light">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Modal Add-->
    <div class="modal fade" id="addJenisPembayaran">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header card-outline">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembayaran</h1>
                    <button type="button" class="btn-close xeditmodal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAdd">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="jenis_pembayaran" class="col-form-label">Jenis Pembayaran</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="jenis_pembayaran" class="form-control" name="jenis_pembayaran">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="jumlah" class="col-form-label">Jumlah</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="jumlah" class="form-control" name="jumlah" onkeyup="InputRupiah(this)">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="keterangan" class="col-form-label">Keterangan</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="keterangan" class="form-control" name="keterangan">
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
                <div class="modal-header card-outline">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pembayaran</h1>
                    <button type="button" class="btn-close xeditmodal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEdit">
                        @csrf
                        <input type="hidden" id="dataId" name="id">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="editPembayaran" class="col-form-label">Jenis Pembayaran</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="editPembayaran" class="form-control" name="jenis_pembayaran">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="editJumlah" class="col-form-label">Jumlah</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="editJumlah" class="form-control" name="jumlah" onkeyup="InputRupiah(this)">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="editKeterangan" class="col-form-label">Keterangan</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="editKeterangan" class="form-control" name="keterangan">
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
        $('#TablejenisPembayaran').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/data-jenis-pembayaran',
                "type": 'GET',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'jenis_pembayaran', name: 'jenis_pembayaran'},
                {
                    data: 'jumlah',
                    name: 'jumlah',
                    render: function(data, type, full, meta) {
                        // Format data menjadi format rupiah
                        return formatRupiah(data);
                    }
                },
                {data: 'keterangan', name: 'keterangan'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
        // Fungsi untuk format rupiah
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var formatted = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + formatted;
        }
        // input rupiah
        function InputRupiah(el) {
            // Menghilangkan format rupiah sebelum disubmit
            var value = el.value.replace(/\D/g, '');

            // Menambahkan format rupiah
            el.value = formatNumber(value);
        }
        function formatNumber(num) {
            return 'Rp ' + num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }

    });
    // input rupiah
    function InputRupiah(el) {
        // Menghilangkan format rupiah sebelum disubmit
        var value = el.value.replace(/\D/g, '');
        // Menambahkan format rupiah
        el.value = formatNumber(value);
    }
    function formatNumber(num) {
        return 'Rp ' + num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    }

    $('#btn-add').click(function(){
        $('#addJenisPembayaran').modal('show');
    });
    $('#formAdd').submit(function(e){
        e.preventDefault();
        $('#loader').show();
        $.ajax({
            url: '/store-pembayaran',
            type: 'POST',
            data: $('#formAdd').serialize(),
            success: function(res){
                $('#addJenisPembayaran').modal('hide');
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
                    $('#jenis_pembayaran').val(null);
                    $('#jumlah').val(null);
                    $('#keterangan').val(null);
                    $('#TablejenisPembayaran').DataTable().ajax.reload();
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
            url: '/id-pembayaran/'+id,
            type: 'GET',
            success: function(res){
                console.log(res);
                $('#loader').hide();
                $('#dataId').val(res.id);
                $('#editPembayaran').val(res.jenis_pembayaran);
                $('#editJumlah').val(res.jumlah);
                $('#editKeterangan').val(res.keterangan);
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
                url: '/update-pembayaran',
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
                        $('#TablejenisPembayaran').DataTable().ajax.reload();
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
            $('#jenis_pembayaran').val(null);
            $('#jumlah').val(null);
            $('#keterangan').val(null);
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
                url: '/delete-pembayaran/'+id,
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
                        $('#TablejenisPembayaran').DataTable().ajax.reload();
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


