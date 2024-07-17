@extends('dashboard.admin.layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="table-responsive">
                <table class="table text-center table-bordered">
                    <thead>
                        <th id="data-santri" style="background-color: rgb(163, 190, 163); font-size: 20px;"><i class="lni lni-user fw-bold"></i></th>
                        <th id="data-ortu" style="background-color: rgb(188, 209, 206);font-size: 20px;"><i class="lni lni-users fw-bold"></i></th>
                        <th id="data-asal-sekolah" style="background-color: rgb(192, 218, 232); font-size: 20px;"><i class="lni lni-graduation fw-bold"></i></th>
                        <th id="data-wali" style="background-color: rgb(163, 165, 190); font-size: 20px;"><i class="lni lni-handshake fw-bold"></i></th>
                    </thead>
                </table>
            </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <form id="postUpdate">
                @csrf
                <input type="hidden" name="dataid">
                {{--  form data diri santri  --}}
                <div id="form-santri">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-header card-outline">
                                    <div class="fw-bold">Data Diri</div>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="inputnik" class="col-form-label">NIK</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="inputnik" class="form-control"
                                            name="nik" placeholder="Berisi 16 Karakter" value="{{ $results['saba']->nik }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="inputnokk" class="col-form-label">NO KK</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="inputnokk" class="form-control"
                                            name="nokk" placeholder="Berisi 16 Karakter" value="{{ $results['saba']->nokk }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="inputname" class="col-form-label">Nama Lengkap</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="inputname" class="form-control" name="nama_lengkap"
                                            value="{{ $results['saba']->nama_lengkap }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="inputlahir" class="col-form-label">Tempat Lahir</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="inputlahir" class="form-control" name="tempat_lahir"
                                            value="{{ $results['saba']->tempat_lahir }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="inputdateL" class="col-form-label">Tanggal Lahir</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="date" id="inputdateL" class="form-control" name="tanggal_lahir"
                                            value="{{ $results['saba']->tanggal_lahir }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="inputJK" class="col-form-label">Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="jenis_kelamin" id="inputJK" class="form-control">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="laki-laki" {{ $results['saba']->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="perempuan" {{ $results['saba']->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2" id="saudara-kandung">
                                        <div class="col-md-4">
                                            <label for="saudara_kandung" class="col-form-label">Saudara Kandung</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="checkbox" id="saudara_kandung" name="saudara_kandung" value="YA"> Ya
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2" id="saudara-kandung">
                                        <div class="col-md-4">
                                            <label for="anak_ke" class="col-form-label">Anak Ke</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" id="anak_ke" class="form-control" name="anak_ke"
                                            value="{{ $results['saba']->anak_ke }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="jumlahSaudara" class="col-form-label">Jumlah Saudara</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" id="jumlahSaudara" class="form-control" name="jumlah_saudara"
                                            value="{{ $results['saba']->jumlah_saudara }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-outline">
                                    <div class="fw-bold">Alamat</div>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="province-dd" class="col-form-label">Provinsi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control" id="province-dd" name="provinsi">
                                                @if ($results['saba']->provinsi)
                                                    <option value="{{ old('provinsi', $results['saba']->provinsi) }}">{{ $results['saba']->Provinsi->name }}</option>
                                                @endif
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($provinsi as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="city-dd" class="col-form-label">Kabupaten</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control" id="city-dd" name="kabupaten">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="kecamatan-dd" class="col-form-label">Kecamatan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control" id="kecamatan-dd" name="kecamatan">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="desa-dd" class="col-form-label">Desa</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control" id="desa-dd" name="desa">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="inputdus" class="col-form-label">Dusun</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="inputdus" class="form-control" name="dusun"
                                            value="{{ $results['saba']->dusun }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="inputrt" class="col-form-label">RT/RW</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="inputrt" class="form-control" name="rt_rw"
                                            value="{{ $results['saba']->rt_rw }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="inputalam" class="col-form-label">Alamat</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="inputalam" class="form-control" name="alamat"
                                            value="{{ $results['saba']->alamat }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{--  form orang tua  --}}
                <div id="form-ortu" style="display: none">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="card card-outline">
                            <div class="card-header">
                            <div class="fw-bold">Ayah</div>
                            </div>
                            <div class="card-body">
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                    <label for="nik_ayah" class="col-form-label">NIK Ayah</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="nik_ayah" class="form-control"
                                    name="nik_ayah" placeholder="Berisi 16 digit" value="{{ $results['ortu']->nik_ayah }}">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                    <label for="nama_ayah" class="col-form-label">Nama Ayah</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="nama_ayah" class="form-control" name="nama_ayah" value=" {{ $results['ortu']->nama_ayah }}">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                <label for="pekerjaan-ayah" class="col-form-label">Pekerjaan Ayah</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="pekerjaan_ayah" id="pekerjaan-ayah" class="form-control">
                                        @if (isset($results['ortu']->pekerjaan_ayah))
                                            <option value="{{ old('pekerjaan_ayah', $results['ortu']->pekerjaan_ayah) }}">{{ $results['pekerjaanA']->nama_pekerjaan }}</option>
                                        @endif
                                        <option value="">Pilih Pekerjaan</option>
                                        @foreach ($results['pekerjaan'] as $val)
                                            <option value="{{ $val->id }}">{{ $val->nama_pekerjaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                <label for="pendidikan-ayah" class="col-form-label">Pendidikan Ayah</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="pendidikan-ayah" id="pendidikan-ayah" class="form-control">
                                        @if (isset($results['ortu']->pendidikan_ayah))
                                        <option value="{{ old('pendidikan_ayah', $results['ortu']->pendidikan_ayah) }}">{{ $results['pendidikanA']->nama_pendidikan }}</option>
                                        @endif
                                        <option value="">Pilih Pendidikan</option>
                                        @foreach ($results['pendidikan'] as $val)
                                            <option value="{{ $val->id }}">{{ $val->nama_pendidikan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                    <label for="no_hp_ayah" class="col-form-label">No Hp Ayah</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="no_hp_ayah" class="form-control" name="no_hp_ayah" value="{{ $results['ortu']->no_hp_ayah }}">
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="card card-outline">
                            <div class="card-header">
                                <div class="fw-bold">Ibu</div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                    <label for="nik_ibu" class="col-form-label">NIK Ibu</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="nik_ibu" class="form-control"
                                    name="nik_ibu" placeholder="Berisi 16 digit" value="{{ $results['ortu']->nik_ibu }}">
                                </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                    <label for="nama_ibu" class="col-form-label">Nama Ibu</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="nama_ibu" class="form-control" name="nama_ibu" value="{{ $results['ortu']->nama_ibu }}">
                                </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                    <label for="pekerjaan-ibu" class="col-form-label">Pekerjaan Ibu</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="pekerjaan_ibu" id="pekerjaan-ibu" class="form-control">
                                        @if (isset($results['ortu']->pekerjaan_ibu))
                                            <option value="{{ old('pekerjaan_ibu', $results['ortu']->pekerjaan_ibu) }}">{{ $results['pekerjaanI']->nama_pekerjaan }}</option>
                                        @endif
                                        <option value="">Pilih Pekerjaan</option>
                                        @foreach ($results['pekerjaan'] as $val)
                                            <option value="{{ $val->id }}">{{ $val->nama_pekerjaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                    <label for="pendidikan-ibu" class="col-form-label">Pendidikan Ibu</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="pendidikan-ibu" id="pendidikan-ibu" class="form-control">
                                        @if (isset($results['ortu']->pendidikan_ibu))
                                        <option value="{{ old('pendidikan_ibu', $results['ortu']->pendidikan_ibu) }}">{{ $results['pendidikanI']->nama_pendidikan }}</option>
                                        @endif
                                        <option value="">Pilih Pendidikan</option>
                                        @foreach ($results['pendidikan'] as $val)
                                            <option value="{{ $val->id }}">{{ $val->nama_pendidikan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div><div class="row g-3 align-items-center mb-2">
                                <div class="col-md-4">
                                    <label for="no_hp_ibu" class="col-form-label">No Hp Ibu</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="no_hp_ibu" class="form-control" name="no_hp_ibu" value="{{ $results['ortu']->no_hp_ibu }}">
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                @if ($results['wali']->kedudukan_dalam_keluarga == 'Ayah')
                    <div id="ayahIbu" style="display: none">
                        <div class="alert alert-info" id="infoWaliDiPilih">
                            <p>Ayah Dipilih Sebagai Penanggung Jawab Biaya</p>
                        </div>
                    </div>
                @elseif ($results['wali']->kedudukan_dalam_keluarga == 'Ibu')
                    <div id="ayahIbu" style="display: none">
                        <div class="alert alert-info" id="infoWaliDiPilih">
                            <p>Ayah Dipilih Sebagai Penanggung Jawab Biaya</p>
                        </div>
                    </div>
                @else
                    {{--  form wali  --}}
                    <div id="form-wali">
                        <input type="hidden" name="wali" id="wali">
                        <div class="card card-outline">
                            <div class="card-header">
                                <div class="fw-bold">Penanggung Jawab Biaya</div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="nama_wali" class="col-form-label">Nama Wali</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="nama_wali" class="form-control" name="nama_wali">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="kedudukan_dalam_keluarga" class="col-form-label">Kedudukan Dalam Keluarga</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="kedudukan_dalam_keluarga" class="form-control" name="kedudukan_dalam_keluarga">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="alamat_wali" class="col-form-label">Alamat Wali</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="alamat_wali" class="form-control" name="alamat_wali">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="no_hp_wali" class="col-form-label">No HP Wali</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="no_hp_wali" class="form-control" name="no_hp_wali">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{--  form asal sekolah  --}}
                <div id="formAsalSekolah" style="display: none">
                    <div class="col-md-12">
                        <div class="card card-outline">
                            <div class="card-header">
                                <div class="fw-bold">Asal Sekolah</div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="asal-sekolah" class="col-form-label">Nama TK/SD/MI</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="asal-sekolah" class="form-control" name="asal_sekolah"
                                        value="{{ $results['asal_sekolah']->asal_sekolah }}">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="alamat_asal_sekolah" class="col-form-label">Alamat Asal Sekolah</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="alamat_asal_sekolah" class="form-control" name="alamat_asal_sekolah"
                                        value="{{ $results['asal_sekolah']->alamat_asal_sekolah }}">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="diterima_dikelas" class="col-form-label">Diterima Di Kelas</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="diterima_dikelas" class="form-control" name="diterima_dikelas"
                                        value="{{ $results['asal_sekolah']->diterima_dikelas }}">
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-md-4">
                                        <label for="no_surat_pindah" class="col-form-label">No Surat Pindah</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" id="no_surat_pindah" class="form-control" name="no_surat_pindah"
                                        value="{{ $results['asal_sekolah']->no_surat_pindah }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row mt-3" id="submit">
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('script')
    <script>
        @php
        use App\Providers\RouteParamService as routeParam;
        @endphp

        $('#postUpdate').submit(function(e){
            e.preventDefault();
            var id = '{{ routeParam::encode($results['saba']->id) }}'
            $.ajax({
                url: '/saba/'+id+'/update',
                type: 'POST',
                data: $('#postUpdate').serialize(),
                success: function(res){
                    console.log(res);
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        toast: true,
                        position: 'top-end',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    }).then(()=>{
                        window.location.href = '/saba-all';
                    });
                },
                error: function(xhr, error) {
                    let errorMessages = xhr.responseJSON.errors;
                    Object.keys(errorMessages).forEach((key) => {
                        errorMessages[key].forEach((errorMessage) => {
                            toastr.info(errorMessage);
                        });
                    });
                }
            })
        });

        $('#data-santri').click(function(){
            $('#form-santri').show();
            $('#form-ortu').hide();
            $('#form-wali').hide();
            $('#ayahIbu').hide();
            $('#formAsalSekolah').hide();
        });
        $('#data-ortu').click(function(){
            $('#form-ortu').show();
            $('#form-santri').hide();
            $('#form-wali').hide();
            $('#ayahIbu').hide();
            $('#formAsalSekolah').hide();
        });
        $('#data-asal-sekolah').click(function(){
            $('#formAsalSekolah').show();
            $('#form-ortu').hide();
            $('#form-santri').hide();
            $('#form-wali').hide();
            $('#ayahIbu').hide();
        });
        $('#data-wali').click(function(){
            $('#ayahIbu').show();
            $('#form-ortu').hide();
            $('#form-santri').hide();
            $('#formAsalSekolah').hide();
        });



        $(document).ready(function() {
            $('#province-dd').on('change', function() {
                var idProvince = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{ url('api/fetch-kota') }}",
                    type: "POST",
                    data: {
                        province_id: idProvince,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dd').html('<option value="">Pilih Kota/Kabupaten</option>');
                        $.each(result.kota, function(key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#kecamatan-dd').html('<option value=""></option>');
                    }
                });
            });
            $('#city-dd').on('change', function() {
                var idState = this.value;
                $("#kecamatan-dd").html('');
                $.ajax({
                    url: "{{ url('api/fetch-kecamatan') }}",
                    type: "POST",
                    data: {
                        regency_id: idState,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#kecamatan-dd').html('<option value="">Pilih kecamatan</option>');
                        $.each(result.kecamatan, function(key, value) {
                            $("#kecamatan-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#desa-dd').html('<option value=""></option>');
                    }
                });
            });
            $('#kecamatan-dd').on('change', function() {
                var district_id = this.value;
                $("#desa-dd").html('');
                $.ajax({
                    url: "{{ url('api/fetch-desa') }}",
                    type: "POST",
                    data: {
                        district_id: district_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#desa-dd').html('<option value="">Pilih Desa</option>');
                        $.each(res.desa, function(key, value) {
                            $("#desa-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

            var prov = '{{ $results['saba']->provinsi }}'
            var desa = '{{ $results['saba']->desa }}'
            var kab = '{{ $results['saba']->kabupaten }}'
            var kec = '{{ $results['saba']->kecamatan }}'

            var idProvince = this.value;
            if (prov) {
                $.ajax({
                    url: "{{ url('api/fetch-kota') }}",
                    type: "POST",
                    data: {
                        province_id: prov,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dd').html('<option value="">Pilih Kota/Kabupaten</option>');

                        $.each(result.kota, function(key, value) {
                            $("#city-dd").append(
                                `<option value="${value.id}" ${value.id == kab ? 'selected' : ''} > ${value.name}</option>`
                            );
                        });
                        $('#kecamatan-dd').html('<option value=""></option>');
                    }
                });
            }
            if (kab) {
                $.ajax({
                    url: "{{ url('api/fetch-kecamatan') }}",
                    type: "POST",
                    data: {
                        regency_id: kab,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#kecamatan-dd').html('<option value="">Pilih kecamatan</option>');

                        $.each(result.kecamatan, function(key, value) {
                            $("#kecamatan-dd").append(
                                `<option value="${value.id}" ${value.id == kec ? 'selected' : ''} > ${value.name}</option>`
                            );
                        });
                        $('#desa-dd').html('<option value=""></option>');
                    }
                });
            }
            if (kec) {

                $.ajax({
                    url: "{{ url('api/fetch-desa') }}",
                    type: "POST",
                    data: {
                        district_id: kec,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#desa-dd').html('<option value="">Pilih Desa</option>');


                        $.each(res.desa, function(key, value) {
                            $("#desa-dd").append(
                                `<option value="${value.id}" ${value.id == desa ? 'selected' : ''} > ${value.name}</option>`
                            );
                        });
                    }
                });
            }
        });
    </script>
@endpush
