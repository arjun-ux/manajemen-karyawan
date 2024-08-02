@extends('dashboard.admin.layouts.app')
@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.0/css/buttons.dataTables.css">
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <th style="background-color: rgb(233, 246, 232)">Report</th>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="card card-outline">
                        <div class="card-body">
                            <form id="filter">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="firstRange">Pilih Bulan</label>
                                        <input type="month" id="firstRange" name="awal" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="kamar">Pilih Kamar</label>
                                        <select name="kamar_id" id="kamar" class="form-control">
                                            <option value="">--Pilih Kamar--</option>
                                            @foreach ($kamar as $val)
                                                <option value="{{ $val->id }}">{{ $val->nama_kamar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endRange">Jenis Tagihan</label>
                                        <select name="jenis_tagihan" id="jenis_tagihan" class="form-control">
                                            <option value="">--Pilih Tagihan--</option>
                                            @foreach ($jenis_tagihan as $val)
                                                <option value="{{ $val->jenis_pembayaran }}">{{ $val->jenis_pembayaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for=""></label>
                                        <button type="submit" class="form-control" style="background-color: green; color: #ffff">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped" id="tableReport" style="width: 100%; height: 50%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Santri</th>
                                    <th>Nama Tagihan</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
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
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.html5.min.js"></script>
  <script>
    $('#tableReport').DataTable();
    $('#filter').submit(function(e){
        e.preventDefault();

        $('#loader-container').show();
        $('#loader').show();
        $.ajax({
            url: '/data-report-bulanan',
            type: 'POST',
            data: $('#filter').serialize(),
            success: function(res){
                $('#loader-container').hide();
                $('#loader').hide();
                tableTransaksi(res)
            },
            error: function(xhr, error){
                $('#loader-container').hide();
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
    function tableTransaksi(res){
        var data = res.data;
        // Hancurkan instance DataTables yang ada
        if ($.fn.DataTable.isDataTable('#tableReport')) {
            $('#tableReport').DataTable().destroy();
        }
        var table = $('#tableReport').DataTable({
            data: data,
            columns: [
                {data: 'id'},
                {data: 'nama_lengkap'},
                {data: 'nama_tagihan'},
                {data: 'bulan_ajaran'},
                {data: 'tahun_ajaran'},
                {
                    data: 'nominal_tagihan',
                    render: function(data){
                        return formatNumber(data)
                    }
                },
                {data: 'status_tagihan'},
            ],
            layout: {
                topStart: {
                    buttons: [
                        'copy', 'excel', 'pdf'
                    ]
                }
            }
        })
    }
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


