@extends('dashboard.admin.layouts.app')
@section('content')
<style>
    .custom-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0; /* Border utama di sekitar card */
        border-top: 4px solid green; /* Border atas dengan warna yang menonjol */
        max-height: 200px; /* Atur tinggi maksimum card di sini */
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
                                        <select name="nama_tagihan" id="nama_tagihan" class="form-control">
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
                <div id="searchWrapper" class="mb-3">
                    <input type="text" id="customSearchInput" placeholder="Search" class="form-control">
                </div>
                <div class="col-md-12" id="tableWrapper">
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
                                    <th class="text-center text-light">Bulan</th>
                                    <th class="text-center text-light">Tahun</th>
                                    <th class="text-center text-light">Status</th>
                                    <th class="text-center text-light">Action</th>
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
</div>
@endsection
@push('script')
  <script>
    $('#formTagihanPendaftaran').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '/store-tagihan-pendaftaran',
            type: 'POST',
            data: $('#formTagihanPendaftaran').serialize(),
            success: function(res){
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
        var table = $('#tableTagihan').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/allInvoice',
                "type": 'GET',
            },
            drawCallback: function(settings) {
                $('#pagination').text('Total Of Data '+settings.json.recordsTotal);
                // Call function to populate card view
                convertTableToCardView();
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
                {data: 'bulan_ajaran', name: 'bulan_ajaran'},
                {data: 'tahun_ajaran', name: 'tahun_ajaran'},
                {
                    data: 'status_tagihan',
                    name: 'status_tagihan',
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
                // Assuming row data order: [NO, NIS, NAMA, STATUS, ACTIOn
                var id = row.id;
                const nis = row['nis'];
                const nama = row['nama_lengkap'];
                const nama_tagihan = row['nama_tagihan'];
                const jenis_tagihan = row['jenis_tagihan'];
                const nominal = row['nominal'];
                const bulan_ajaran = row['bulan_ajaran'];
                const tahun_ajaran = row['tahun_ajaran'];
                const status = row['status_tagihan'];

                // Create card elements
                const card = $('<div class="card custom-card p-3 rounded shadow-sm mb-1"></div>');

                card.html(`
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-fill pe-3">
                            <ul class="list-unstyled mb-0">
                                <li>NIS : <strong>${nis}</strong> </li>
                                <li>NAMA : <strong>${nama}</strong> </li>
                                <li>NAMA TAGIHAN : <strong>${nama_tagihan}</strong> </li>
                                <li>BULAN : <strong>${bulan_ajaran}</strong> <strong>${tahun_ajaran}</strong></li>
                                ${status === 'Belum Lunas' ?
                                    `<li>STATUS : <strong style="color: red;">${status}</strong></li>` :
                                    `<li>STATUS : <strong style="color: green;">${status}</strong></li>`
                                }
                            </ul>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <a href="/show-saba/${id}" class="btn btn-outline-primary btn-sm mb-2 rounded-pill">
                                <i class="lni lni-pencil-alt"></i>
                            </a>
                            <a href="/lihat-santri/${id}" class="btn btn-outline-warning btn-sm mb-2 rounded-pill">
                                <i class="lni lni-empty-file"></i>
                            </a>
                            <a href="#" data-id="${id}" class="btn-nonAktif btn btn-outline-danger btn-sm rounded-pill">
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


