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
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped " id="TablePembayaran" style="width: 100%; height: 50%">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center text-light">NO</th>
                                    <th class="text-center text-light">Nama</th>
                                    <th class="text-center text-light">Nominal</th>
                                    <th class="text-center text-light">Jenis</th>
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
                                <label for="nama" class="col-form-label">Nama Pembayaran</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="nama" class="form-control" name="nama_pembayaran">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="nominal" class="col-form-label">Nominal</label>
                                </div>
                                <div class="col-md-8">
                                <input type="text" id="nominal" class="form-control" name="nominal_pembayaran" onkeyup="InputRupiah(this)">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="jenis" class="col-form-label">Jenis Pembayaran</label>
                            </div>
                            <div class="col-md-8">
                                <select name="jenis_pembayaran" id="jenis" class="form-control">
                                    <option selected="" disabled="">Pilih Jenis Pembayaran</option>
                                    <option value="ALL">ALL</option>
                                    <option value="REGULAR">REGULAR</option>
                                    <option value="SAUDARA KK">SAUDARA KK</option>
                                </select>
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
        $('#TablePembayaran').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/data-pembayaran',
                "type": 'GET',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama_pembayaran', name: 'nama_pembayaran'},
                {
                    data: 'nominal_pembayaran',
                    name: 'nominal_pembayaran',
                    render: function(data, type, full, meta) {
                        // Format data menjadi format rupiah
                        return formatRupiah(data);
                    }
                },
                {data: 'jenis_pembayaran', name: 'jenis_pembayaran'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
        $('body').on('click','.btn_edit',function(){
            $('#loader').show();
            var id = $(this).data('id');
            $.ajax({
                url: '/id-pembayaran/'+id,
                type: 'GET',
                success: function(res){
                    $('#loader').hide();
                    $('#dataId').val(res.id);
                    $('#nama').val(res.nama_pembayaran);
                    $('#nominal').val(res.nominal_pembayaran);
                    $('#jenis option').filter(function(){
                        return this.value == res.jenis_pembayaran;
                    }).prop('selected', true);
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
                            $('#TablePembayaran').DataTable().ajax.reload();
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
                $('#nama').val(null);
                $('#nominal').val(null);
                $('#jenis').val(null);
            });
        });
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
  </script>
@endpush


