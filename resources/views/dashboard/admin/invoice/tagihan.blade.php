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
                        </table>
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
                            return '<span style="color: red;">Belum Lunas</span>';
                        } else if (data === 'Lunas') {
                            return '<span style="color: green;">Lunas</span>';
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


