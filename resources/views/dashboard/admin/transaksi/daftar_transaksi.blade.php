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
                            <th class="col-md-8" style="background-color: rgb(233, 246, 232)">Daftar Transaksi</th>
                            <th class="col-md-3 text-end" style="background-color: rgb(233, 246, 232)">

                            </th>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped" id="tableTransaksi" style="width: 100%; height: 50%">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center text-white">No</th>
                                    <th class="text-center text-white">Kode</th>
                                    <th class="text-center text-white">Nis</th>
                                    <th class="text-center text-white">Nama</th>
                                    <th class="text-center text-white">Tagihan</th>
                                    <th class="text-center text-white">Nominal</th>
                                    <th class="text-center text-white">Status</th>
                                    <th class="text-center text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
    $('#tableTransaksi').DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: '/data-transaksi',
            type: 'GET',
        },
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex', orderable: false,searchable: false},
            {data: 'kode_transaksi',name: 'kode_transaksi'},
            {data: 'nis',name: 'nis'},
            {data: 'nama_lengkap',name: 'nama_lengkap'},
            {data: 'tagihan',name: 'tagihan'},
            {
                data: 'nominal',
                name: 'nominal',
                render: function(data, type, full, meta) {
                    // Format data menjadi format rupiah
                    return formatRupiah(data);
                }
            },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta) {
                    if (data === 'Belum Lunas') {
                        return '<span class="btn btn-sm btn-danger">Belum Lunas</span>';
                    } else if (data === 'Cicilan') {
                        return '<span class="btn btn-sm btn-warning">Cicilan</span>';
                    } else if (data === 'Lunas') {
                        return '<span class="btn btn-sm btn-success">Lunas</span>';
                    } else {
                        return data; // Handle other cases or return data as-is
                    }
                }
            },
            {data: 'action',name: 'action',orderable: false,searchable: false}
        ]
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
