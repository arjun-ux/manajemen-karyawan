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
                            <th style="background-color: rgb(233, 246, 232)">Report Bulanan</th>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <form id="filter">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <label for="firstRange">Pilih Awal</label>
                                <input type="date" id="firstRange" name="awal" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="endRange">Pilih Akhir</label>
                                <input type="date" id="endRange" name="akhir" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for=""></label>
                                <button type="submit" class="form-control" style="background-color: green; color: #ffff">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped" id="tableReport" style="width: 100%; height: 50%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Kode Transaksi</th>
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
        var awal = $('#firstRange').val();
        var akhir = $('#endRange').val();
        $.ajax({
            url: '/data-report-bulanan',
            type: 'POST',
            data: $('#filter').serialize(),
            success: function(res){
                console.log(res);
                tableTransaksi(res)
            },
            error: function(xhr, error){
                console.log(xhr)
                console.log(error)
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
                {data: 'kode_transaksi'},
                {data: 'nominal'},
                {data: 'status'},
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
  </script>
@endpush


