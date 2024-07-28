@extends('dashboard.admin.layouts.app')
@section('content')
<style>
    .card-header {
        background-color: #f8f9fa;
        font-weight: bold;
    }
    .card-body {
        font-size: 1.1rem;
    }
    .card-footer {
        background-color: #f8f9fa;
        text-align: right;
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
                            <th class="col-md-8" style="background-color: rgb(233, 246, 232)">Transaksi</th>
                            <th class="col-md-3 text-end" style="background-color: rgb(233, 246, 232)">
                                <select name="" id="pilihTransaksi" class="form-control form-control-sm" >
                                    <option value="">-- Pilih Transaksi --</option>
                                    <option value="PSB">PENDAFTARAN SANTRI BARU</option>
                                    <option value="SPP">SPP</option>
                                </select>
                            </th>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline">
                        <div class="card-header fw-medium">Buat Transaksi</div>
                        <div class="card-body">

                            <form id="formPendaftaran" style="display: none">
                                @csrf
                                <input type="hidden" name="sabaId" id="saba_id">
                                <input type="hidden" name="tagihanId" id="tagihan_id">
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nis" class="col-form-label">Masukan Nis</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nis" id="inputNis" class="form-control"
                                        placeholder="Nis 6 Digit">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nama_lengkap" class="col-form-label fw-bold">Nama Santri</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nama_lengkap" id="inputNama" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nama_tagihan" class="col-form-label fw-bold">Nama Tagihan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nama_tagihan" id="inputTagihan" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nominalTagihan" class="col-form-label fw-bold">Total Tagihan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nominalTagihan" id="nominalTagihan" class="form-control" readonly onkeyup="InputRupiah(this)">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nominal" class="col-form-label fw-bold">Jumlah Dibayar</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nominal" id="jumlahDibayar" class="form-control" onkeyup="InputRupiah(this)">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <button type="submit" class="form-control" style="background-color: green; color: white; outline:none;">Simpan</button>
                                </div>
                            </form>

                            <form id="formSpp" style="display: none">
                                <div>
                                    @csrf
                                <input type="hidden" name="sabaId" id="IDSANTRI">
                                <input type="hidden" name="tagihanId" id="IDTAGIHAN">
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nis" class="col-form-label">Masukan Nis</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nis" id="SppNIS" class="form-control"
                                        placeholder="Nis 6 Digit">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nama_lengkap" class="col-form-label fw-bold">Nama Santri</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nama_lengkap" id="namaSantri" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nama_tagihan" class="col-form-label fw-bold">Tagihan SPP</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nama_tagihan" id="tagihanSpp" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="bulanTahun" class="col-form-label fw-bold">Bulan / Tahun</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="bulanTahun" id="bulanTahun" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nominalTagihan" class="col-form-label fw-bold">Total Tagihan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nominalTagihan" id="nominalTagihanSpp" class="form-control" readonly onkeyup="InputRupiah(this)">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <button type="submit" class="form-control" style="background-color: green; color: white; outline:none;">Lunas</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mx-auto mb-2">
                    <div class="card shadow-sm">
                        <form id="buktiTransaksi">
                            @csrf
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Bukti Transaksi</span>
                                <!-- Tombol WhatsApp -->
                                <button type="submit" class="btn btn-success">
                                    <i class="lni lni-whatsapp"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Kode Transaksi:</strong>
                                    <p class="mb-0" id="kode-transaksi" ></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Nama Santri:</strong>
                                    <p class="mb-0" id="nama-santri"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Nis Santri:</strong>
                                    <p class="mb-0" id="nis-santri"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Nama Tagihan:</strong>
                                    <p class="mb-0" id="nama-tagihan"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Bulan / Tahun:</strong>
                                    <p class="mb-0" id="bulan-tahun"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Nominal Tagihan:</strong>
                                    <p class="mb-0" id="nominal-tagihan"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Nominal Bayar:</strong>
                                    <p class="mb-0" id="nominal-bayar"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Status Transaksi:</strong>
                                    <p class="mb-0 text-success" id="status-transaksi"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Tanggal Transaksi:</strong>
                                    <p class="mb-0" id="tgl-transaksi"></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                Terima kasih atas transaksi Anda!
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
@push('script')
  <script>
    $(document).ready(function() {
        $('#pilihTransaksi').change(function() {
            var pilih = $(this).val();
            if (pilih === 'PSB') {
                $('#formPendaftaran').show();
                $('#formSpp').hide();
            } else if (pilih === 'SPP') {
                $('#formPendaftaran').hide();
                $('#formSpp').show();
            } else {
                // Handle case where 'pilih' is neither 'PSB' nor 'SPP'
                $('#formPendaftaran').hide();
                $('#formSpp').hide();
            }
        });

        $('#buktiTransaksi').submit(function(e){
            e.preventDefault();

            var kodeTransaksi = $('#kode-transaksi').text();
            var namaSantri = $('#nama-santri').text();
            var nisSantri = $('#nis-santri').text();
            var namaTagihan = $('#nama-tagihan').text();
            var bulanTahun = $('#bulan-tahun').text();
            var nominalTagihan = $('#nominal-tagihan').text();
            var nominalBayar = $('#nominal-bayar').text();
            var statusTransaksi = $('#status-transaksi').text();
            var tglTransaksi = $('#tgl-transaksi').text();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/send-wa-bukti-transaksi',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    kode_transaksi: kodeTransaksi,
                    nama_santri: namaSantri,
                    nis_santri: nisSantri,
                    nama_tagihan: namaTagihan,
                    nominal_tagihan: nominalTagihan,
                    nominal_bayar: nominalBayar,
                    status_transaksi: statusTransaksi,
                    tgl_transaksi: tglTransaksi,
                    bulan_tahun:  bulanTahun,

                },
                success: function(res){
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                        toast: true,
                        position: "top-end",
                        timer: 1000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    }).then(()=>{
                        $('#kode-transaksi').empty();
                        $('#nama-santri').empty();
                        $('#nis-santri').empty();
                        $('#nama-tagihan').empty();
                        $('#bulan-tahun').empty();
                        $('#nominal-tagihan').empty();
                        $('#nominal-bayar').empty();
                        $('#status-transaksi').empty();
                        $('#tgl-transaksi').empty();
                    })
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
        })


        $('#inputNis').on('input',function(){
            var nis = $(this).val();
            if(nis.length === 6){
                $.ajax({
                    url: '/tagihan-psb-by-nis/'+nis,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res){
                        var nominal = res.tagihan.nominal_tagihan;
                        var nominal_tagihan = formatRupiah(nominal);

                        $('#saba_id').val(res.santri.id);
                        $('#tagihan_id').val(res.tagihan.id);
                        $('#inputNama').val(res.santri.nama_lengkap);
                        $('#inputTagihan').val(res.tagihan.nama_tagihan);
                        $('#nominalTagihan').val(nominal_tagihan);
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
            }
            return;
        });
        $('#SppNIS').on('input',function(){
            var nis = $(this).val();
            if(nis.length === 6){
                $.ajax({
                    url: '/tagihan-spp-by-nis/'+nis,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res){
                        var nominal = res.tagihan.nominal_tagihan;
                        var nominal_tagihan = formatRupiah(nominal);

                        var bulan = res.tagihan.bulan_ajaran;
                        var tahun = res.tagihan.tahun_ajaran;

                        $('#IDSANTRI').val(res.tagihan.saba_id);
                        $('#IDTAGIHAN').val(res.tagihan.id);
                        $('#namaSantri').val(res.santri.nama_lengkap);
                        $('#tagihanSpp').val(res.tagihan.nama_tagihan);
                        $('#bulanTahun').val(bulan+' '+tahun);
                        $('#nominalTagihanSpp').val(nominal_tagihan);

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
            }
            return;
        });

        $('#formSpp').submit(function(e){
            e.preventDefault();

            $.ajax({
                url: '/store-transaksi-spp',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res){
                    console.log(res)
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                        toast: true,
                        position: "top-end",
                        timer: 1000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    }).then(()=>{
                        $('#SppNIS').val(null);
                        $('#namaSantri').val(null);
                        $('#tagihanSpp').val(null);
                        $('#nominalTagihanSpp').val(null);
                        $('#bulanTahun').val(null);


                        var isoDateTime = res.back.transaksi.tgl_transaksi;
                        var readableDate = convertIsoToReadableDate(isoDateTime);

                        $('#kode-transaksi').text(res.back.transaksi.kode_transaksi);
                        $('#nama-santri').text(res.back.req.nama_lengkap);
                        $('#nis-santri').text(res.back.req.nis);
                        $('#nama-tagihan').text(res.back.data.nama_tagihan);
                        $('#bulan-tahun').text(res.back.req.bulanTahun);
                        $('#nominal-tagihan').text(res.back.req.nominalTagihan);
                        $('#nominal-bayar').text(res.back.req.nominalTagihan);
                        $('#status-transaksi').text(res.back.transaksi.status);
                        $('#tgl-transaksi').text(readableDate);
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
            })
        })

        $('#formPendaftaran').submit(function(e){
            e.preventDefault();

            $.ajax({
                url: '/store-transaksi-tagihan-psb',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
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
                        $('#inputNis').val(null);
                        $('#inputNama').val(null);
                        $('#inputTagihan').val(null);
                        $('#nominalTagihan').val(null);
                        $('#jumlahDibayar').val(null);

                        var isoDateTime = res.back.transaksi.tgl_transaksi;
                        var readableDate = convertIsoToReadableDate(isoDateTime);

                        $('#kode-transaksi').text(res.back.transaksi.kode_transaksi);
                        $('#nama-santri').text(res.back.req.nama_lengkap);
                        $('#nis-santri').text(res.back.req.nis);
                        $('#nama-tagihan').text(res.back.req.nama_tagihan);
                        $('#nominal-tagihan').text(res.back.req.nominalTagihan);
                        $('#nominal-bayar').text(res.back.req.nominal);
                        $('#status-transaksi').text(res.back.transaksi.status);
                        $('#tgl-transaksi').text(readableDate);
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
    // Fungsi untuk mengubah format ISO 8601 ke format tanggal yang diinginkan
    function convertIsoToReadableDate(isoDateTime) {
        var dateObj = new Date(isoDateTime); // Ubah string ISO 8601 menjadi objek Date JavaScript
        var year = dateObj.getFullYear();
        var month = ('0' + (dateObj.getMonth() + 1)).slice(-2); // Tambahkan '0' jika bulan kurang dari 10
        var date = ('0' + dateObj.getDate()).slice(-2); // Tambahkan '0' jika tanggal kurang dari 10
        return year + '-' + month + '-' + date;
    }
  </script>
@endpush


