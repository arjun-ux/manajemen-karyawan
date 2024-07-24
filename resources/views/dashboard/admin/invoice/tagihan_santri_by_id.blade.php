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
                            <th style="background-color: rgb(233, 246, 232)" id="namaTagihan"></th>
                            <th class="text-end" style="background-color: rgb(233, 246, 232)">
                                <a id="createInvoice" class="btn btn-outline-success btn-sm" href="#"><i class="lni lni-plus"></i></a>
                            </th>
                        </table>
                    </div>
                </div>
                <h3 id="namaSantri"></h3>
                <div class="col-md-12" style="display: none" id="addTagihan">
                    <div class="card card-outline">
                        <div class="card-header">Tambah Tagihan</div>
                        <div class="card-body">
                            <form id="formTagihanPendaftaran">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 mb-1 mt-1">
                                        <select name="nama_tagihan" id="nama_tagihan" class="form-select">
                                            <option value="">Pilih Tagihan</option>
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
            </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
@push('script')
  <script>
    {{--  ambil id dari halaman  --}}
    var id = "{{ $id }}";
    $.ajax({
        url: '/data-tagihan/'+id,
        type: 'GET',
        dataType: 'json',
        success: function(res){
            console.log(res);
            $('#namaTagihan').text(res.tagihan.nama_tagihan)
            $('#namaSantri').text(res.santri.nama_lengkap)
        },
        error: function(xhr, error){
            console.log(xhr)
            console.log(error)
        }
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


