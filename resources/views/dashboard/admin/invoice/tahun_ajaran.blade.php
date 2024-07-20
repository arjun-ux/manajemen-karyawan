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
                            <th style="background-color: rgb(233, 246, 232)">SPP Tahun Ajaran</th>
                            <th class="text-end" style="background-color: rgb(233, 246, 232)">
                                <a href="#" id="btn-add" class="btn btn-outline-success btn-sm"><i class="lni lni-plus"></i></a>
                            </th>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-outline" id="addData" style="display: none">
                        <div class="card-header">
                            <div class="fw-medium">Tambah</div>
                        </div>
                        <div class="card-body">
                            <form id="formAdd">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-sm-8 mb-2">
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                <label for="bulanTahun" class="col-form-label">Bulan</label>
                                            </div>
                                            <div class="col-8">
                                                <input type="month" class="form-control" id="bulanTahun" name="bulanTahun">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-8 mb-2">
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                <label for="pembayaran_id" class="col-form-label">Jenis SPP</label>
                                            </div>
                                            <div class="col-8">
                                                <select id="pembayaran_id" class="form-control" name="pembayaran_id">
                                                    <option value="">Pilih SPP</option>
                                                    @foreach ($jenis_pembayaran as $val)
                                                        <option value="{{ $val->id }}">{{ $val->jenis_pembayaran }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-8 mb-2">
                                        <div class="row">
                                            <button type="submit" class="btn btn-outline-success btn-block">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped" id="tableTahunAjaran" style="width: 100%; height: 50%">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center text-light">NO</th>
                                    <th class="text-center text-light">Bulan</th>
                                    <th class="text-center text-light">Tahun</th>
                                    <th class="text-center text-light">Jenis SPP</th>
                                    <th class="text-center text-light">Jmlh Santri</th>
                                    <th class="text-center text-light">Total Uang</th>
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
    <!-- /.content -->
</div>
@endsection
@push('script')
  <script>

    $(document).ready(function(){
        $('#tableTahunAjaran').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/data-tahun-ajaran',
                "type": 'GET',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'bulan', name: 'bulan'},
                {data: 'tahun', name: 'tahun'},
                {data: 'pembayaran', name: 'pembayaran.jenis_pembayaran'},
                {data: 'jumlah_santri', name: 'jumlah_santri'},
                {
                    data: 'total_uang',
                    name: 'total_uang',
                    render: function(data, type, full, meta){
                        return formatRupiah(data);
                    }
                },
                {data: 'action', name: 'action'},
            ],
        });
        // Fungsi untuk format rupiah
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var formatted = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + formatted;
        }

        function bulanKeHuruf(bulan) {
            const bulanMap = {
                '01': 'Januari',
                '02': 'Februari',
                '03': 'Maret',
                '04': 'April',
                '05': 'Mei',
                '06': 'Juni',
                '07': 'Juli',
                '08': 'Agustus',
                '09': 'September',
                '10': 'Oktober',
                '11': 'November',
                '12': 'Desember'
            };
            // Validasi bulan
            if (!bulan || !bulanMap[bulan]) {
                throw new Error('Input bulan tidak valid');
            }
            return bulanMap[bulan];
        }
        $('#btn-add').click(function(){
            $('#addData').show();
        });
        $('#formAdd').submit(function(e){
            e.preventDefault();

            var bulanTahun = $('#bulanTahun').val();
            var parts = bulanTahun.split('-');
            var bulan = parts[1];
            var tahun = parts[0];
            var bulanHuruf = bulanKeHuruf(bulan);
            var pembayaran_id = $('#pembayaran_id').val();

            $('#loader').show();
            $.ajax({
                url: '/store-spp-tahun',
                type: 'POST',
                data: {
                    bulan: bulanHuruf,
                    tahun: tahun,
                    pembayaran_id: pembayaran_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(res){
                    console.log(res)
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
                        $('#bulanTahun').val(null);
                        $('#pembayaran_id').val(null);
                        $('#tableTahunAjaran').DataTable().ajax.reload();
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
        $('body').on('click', '.setTagihan', function(){
            var id = $(this).data("id");
            $.ajax({
                url: '/set-tagihan/'+id,
                type: 'GET',
                success: function(res){
                    console.log(res);
                },
                error: function(xhr, error){
                    console.log(xhr)
                    console.log(error)
                }
            });
        });
    });


  </script>
@endpush


