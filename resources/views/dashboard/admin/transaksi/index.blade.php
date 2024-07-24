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
                                <select name="" id="pilihTransaksi" class="form-control-sm" style="outline: none">
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
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nis" class="col-form-label">Masukan Nis</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nis" id="inputNis" class="form-control"
                                        placeholder="Nis 6 Digit">
                                    </div>
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
                        console.log(res)
                    },
                    error: function(xhr, error){
                        console.log(xhr)
                        console.log(error)
                    }
                });
            }
            return;
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


