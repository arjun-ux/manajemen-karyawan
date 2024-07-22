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
                            <th style="background-color: rgb(233, 246, 232)">Tagihan</th>
                            <th class="text-end" style="background-color: rgb(233, 246, 232)">
                                <a id="createInvoice" class="btn btn-outline-success btn-sm" href="#"><i class="lni lni-plus"></i></a>
                            </th>
                        </table>
                    </div>
                </div>
                <div class="col-md-12" style="display: none" id="addTagihan">
                    <div class="card card-outline">
                        <div class="card-header">Tambah Tagihan</div>
                        <div class="card-body">
                            <form id="formTagihanPendaftaran">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 mb-1 mt-1">
                                        <select name="nama_tagihan" id="nama_tagihan" class="form-select">
                                            <option value="">Pilih Tagihan</option>
                                            @foreach ($pembayaran as $val)
                                                <option value="{{ $val->id }}">{{ $val->nama_pembayaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-1 mt-1">
                                        <input type="text" name="nominal_tagihan" id="nominal" placeholder="NOMINAL" class="form-control" onkeyup="InputRupiah(this)" >
                                    </div>
                                    <div class="col-md-2 mb-1 mt-1" style="display: none" id="inputNis">
                                        <input type="text" name="nis" id="nis" placeholder="NIS" class="form-control">
                                    </div>
                                    <div class="col-md-2 mb-1 mt-1">
                                        <input type="month" id="bulanTahun" name="bulanTahun" class="form-control">
                                    </div>
                                    <div class="col-md-2 mb-1 mt-1">
                                        <button type="submit" class="form-control" style="background-color: green; color: white;">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped " id="tableTagihan" style="width: 100%; height: 50%">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center text-light">NO</th>
                                    <th class="text-center text-light">NIS</th>
                                    <th class="text-center text-light">Nama Santri</th>
                                    <th class="text-center text-light">Nama</th>
                                    <th class="text-center text-light">Jenis</th>
                                    <th class="text-center text-light">Nominal</th>
                                    <th class="text-center text-light">Tahun</th>
                                    <th class="text-center text-light">Bulan</th>
                                    <th class="text-center text-light">Status</th>
                                    <th class="text-center text-light">Action</th>
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
</div>
@endsection
@push('script')
  <script>
    $('body').on('click', '.setActive', function(){
        var id = $(this).data("id");
        Swal.fire({
            icon: 'question',
            title: 'Apakah Anda Akan Mengaktifkan Santri Terkait? Jika Iya, Maka Biaya Pendaftaran Akan Lunas!',
            toast: true,
            position: 'center',
            showCancelButton: true,
        }).then((value)=>{
            if(value.isConfirmed){
                setActive(id);
            }
        });
        function setActive(id){
            $.ajax({
                url: '/set-active-santri/'+id,
                type: 'GET',
                success: function(res){
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        toast: true,
                        position: 'top-end',
                        timer: 1500,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    }).then((value)=>{
                        $('#tableTagihan').DataTable().ajax.reload();
                    });
                },
                error: function(xhr, error){
                    console.log(xhr)
                    console.log(error)
                }
            });
        }
    });

    $('#formTagihanPendaftaran').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '/store-tagihan-pendaftaran',
            type: 'POST',
            data: $('#formTagihanPendaftaran').serialize(),
            success: function(res){
                console.log(res)
                Swal.fire({
                    icon: "success",
                    title: res.message,
                    toast: true,
                    position: "top-end",
                    timer: 1500,
                    showConfirmButton: false,
                    timerProgressBar: true,
                }).then(()=>{
                    $('#nis').val(null);
                    $('#nama_tagihan').val(null);
                    $('#nominal').val(null);
                    $('#bulanTahun').val(null);
                    $('#tableTagihan').DataTable().ajax.reload();
                });
            },
            error: function(xhr, error){
                $('#loader').hide();
                if (xhr.status === 404) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    let errorMessages = xhr.responseJSON.errors;
                    if (errorMessages) {
                        Object.keys(errorMessages).forEach((key) => {
                            errorMessages[key].forEach((errorMessage) => {
                                toastr.error(errorMessage);
                            });
                        });
                    } else {
                        toastr.error('Terjadi kesalahan: ' + xhr.status + ' ' + xhr.statusText);
                    }
                }
            }
        });
    });

    $('#createInvoice').click(function(){
        $('#addTagihan').show();
    });
    $('#nama_tagihan').change(function(){
        var id = $('#nama_tagihan').val();
        $.ajax({
            url: '/get-pembayaran/'+id,
            type: 'GET',
            success: function(res){
                $('#nominal').val(res.nominal_pembayaran);
                if(res.jenis_pembayaran == 'ALL'){
                    $('#inputNis').show();
                }else{
                    $('#inputNis').hide();
                }
            },
            error: function(xhr, error){
                console.log(xhr)
                console.log(error)
            }
        });
    });

    $(document).ready(function(){
        $('#tableTagihan').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/allInvoice',
                "type": 'GET',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nis', name: 'nis'},
                {data: 'nama_lengkap', name: 'nama_lengkap'},
                {data: 'nama_tagihan', name: 'nama_tagihan'},
                {data: 'jenis_tagihan', name: 'nama_tagihan'},
                {
                    data: 'nominal_tagihan',
                    name: 'nominal_tagihan',
                    render: function(data, type, full, meta) {
                        // Format data menjadi format rupiah
                        return formatRupiah(data);
                    }
                },
                {data: 'tahun_ajaran', name: 'tahun_ajaran'},
                {data: 'bulan_ajaran', name: 'bulan_ajaran'},
                {
                    data: 'status_tagihan',
                    name: 'status_tagihan',
                    render: function(data, type, full, meta) {
                        if (data === 'Belum Lunas') {
                            return '<span class="btn btn-sm btn-danger">Belum Lunas</span>';
                        } else if (data === 'Lunas') {
                            return '<span class="btn btn-sm btn-success">Lunas</span>';
                        } else {
                            return data; // Handle other cases or return data as-is
                        }
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
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


