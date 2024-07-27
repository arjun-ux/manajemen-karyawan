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
                <div class="col-md-12">
                    <form id="filter">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="firstRange">Pilih Awal</label>
                                <input type="date" id="firstRange" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="endRange">Pilih Akhir</label>
                                <input type="date" id="endRange" class="form-control">
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

      $(document).ready(function(){

        var table = $('#tableReport').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/data-report-bulanan',
                "type": 'GET',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'kode_transaksi', name: 'kode_transaksi'},
                {data: 'nominal', name: 'nominal'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            layout: {
                topStart: {
                    buttons: [
                        'copy', 'excel', 'pdf'
                    ]
                }
            }

        });
        $('#firstRange').on('change', function() {
            table.draw();

        });
    });

    $.ajax({
        url: '/data-report-bulanan',
        type: 'GET',
        success: function(data) {
            console.log(data)
        },
        error: function(xhr, error){
            console.log(xhr)
            console.log(error)
        }
    })

  </script>
@endpush


