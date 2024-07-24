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
                                    transaksi spp
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-outline">
                        <div class="card-body">Bukti Transaksi</div>
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
                        console.log(xhr)
                        console.log(error)
                    }
                });
            }
            return;
        });

        $('#formPendaftaran').submit(function(e){
            e.preventDefault();

            $.ajax({
                url: '/store-transaksi-tagihan-psb',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
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
                        $('#inputNis').val(null);
                        $('#inputNama').val(null);
                        $('#inputTagihan').val(null);
                        $('#nominalTagihan').val(null);
                        $('#jumlahDibayar').val(null);
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
  </script>
@endpush


