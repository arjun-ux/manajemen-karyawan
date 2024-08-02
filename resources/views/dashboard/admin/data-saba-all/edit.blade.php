@extends('dashboard.admin.layouts.app')
@section('content')
<style>
    .file-upload-container {
        position: relative;
        overflow: hidden;
        display: inline-block;
        z-index: 3;
        width: 100%; /* Change this to 100% */
        height: 200px;
        border: rgb(142, 184, 187) solid 1px;
    }
    .file-upload-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }
    .file-upload-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        z-index: 2;
        opacity: 0;
        transition: all 0.2s ease;
    }
    .file-upload-overlay:hover {
        opacity: 1;
    }
    .file-upload-overlay i {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    .file-upload-input {
        position: absolute;
        bottom: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 100px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
        z-index: 3;
        width: 100%;
        height: 100%;
    }
</style>
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
                    <thead>
                        <th colspan="4" id="data-berkas" data-id="{{ $results['saba']->id }}" style="background-color: rgb(244, 255, 236); font-size: 20px;"><i class="lni lni-files fw-bold"></i></th>
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
            <div class="col-md-12 mb-2" id="file_berkas" style="display: none">
                <div class="card card-outline">
                    <div class="card-header fw-medium">Berkas</div>
                    <div class="card-body">
                        <form id="formBerkas" enctype="multipart/form-data" method="POST" action="{{ route('update.berkas', $results['saba']->id) }}">
                            @csrf
                            <input type="hidden" name="sid" id="sid">
                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <h5 class="fw-bold">Foto</h5>
                                    <div class="file-upload-container">
                                        <img id="previewFoto1" src="" alt="foto" class="file-upload-image preview-foto">
                                        <div class="file-upload-overlay">
                                            <i class="lni lni-camera"></i>
                                            <p>Pilih Gambar</p>
                                            <input type="file" class="file-upload-input" id="previewFotoInput1" name="foto">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <h5 class="fw-bold">Kartu Keluarga</h5>
                                    <div class="file-upload-container">
                                        <img id="previewFoto2" src="" alt="kk" class="file-upload-image preview-foto">
                                        <div class="file-upload-overlay">
                                            <i class="lni lni-camera"></i>
                                            <p>Pilih Gambar</p>
                                            <input type="file" class="file-upload-input" id="previewFotoInput2" name="kk">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <h5 class="fw-bold">KTP ORTU</h5>
                                    <div class="file-upload-container">
                                        <img id="previewFoto3" src="" alt="ktp ortu" class="file-upload-image preview-foto">
                                        <div class="file-upload-overlay">
                                            <i class="lni lni-camera"></i>
                                            <p>Pilih Gambar</p>
                                            <input type="file" class="file-upload-input" id="previewFotoInput3" name="ktp_ortu">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <h5 class="fw-bold">KTP WALI</h5>
                                    <div class="file-upload-container">
                                        <img id="previewFoto4" src="" alt="ktp wali" class="file-upload-image preview-foto">
                                        <div class="file-upload-overlay">
                                            <i class="lni lni-camera"></i>
                                            <p>Pilih Gambar</p>
                                            <input type="file" class="file-upload-input" id="previewFotoInput4" name="ktp_wali">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="form-control" style="background-color: rgb(105, 92, 124); color: white;">Update Berkas</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2" id="kamarPesantren">
                <div class="card card-outline">
                    <div class="card-header">
                        <div class="fw-medium">Data Pesantren</div>
                    </div>
                    <div class="card-body">
                        <form id="setKamar">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <label for="selectKamar">Asrama / Kamar</label>
                                </div>
                                <div class="col-md-7">
                                    <select name="kamar_id" id="selectKamar" class="form-control">
                                        @if (isset($results['kamarsaba']->nama_kamar))
                                            <option value="{{ old('nama_kamar', $results['kamarsaba']->nama_kamar) }}">{{ $results['kamarsaba']->nama_kamar }}</option>
                                        @endif
                                        <option value="">Pilih Kamar</option>
                                        @foreach ($results['kamar'] as $val)
                                            <option value="{{ $val->id }}">{{ $val->nama_kamar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2" id="submitKamar" style="display: none">
                                    <button type="submit" class="form-control" style="background-color: green; color:white;">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <form id="postUpdate">
                    @csrf
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
                                        <select name="pendidikan_ayah" id="pendidikan-ayah" class="form-control">
                                            @if (isset($results['ortu']->pendidikan_ayah))
                                            <option value="{{ old('pendidikan_ayah', $results['ortu']->pendidikan_ayah) }}">{{ $results['pendidikanA']->nama_pendidikan }}</option>
                                            @endif
                                            <option value="">Pilih Pendidikan</option>
                                            @foreach ($results['pendidikan'] as $val)
                                                <option value="{{ $val->id }}">{{ $val->nama_pendidikan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
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
                                            <select name="pendidikan_ibu" id="pendidikan-ibu" class="form-control">
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
                    {{--  data wali  --}}
                    <div id="ayahIbu" style="display: none">
                        <div class="card card-outline">
                            <div class="card-header">
                                <div class="fw-bold">Penanggung Jawab Biaya</div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center text-center mb-2">
                                    <div class="col-md-4">
                                        <input type="radio" name="kedudukan_dalam_keluarga" id="waliAyah" value="Ayah">
                                        <label for="waliAyah" class="col-form-label">Ayah</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" name="kedudukan_dalam_keluarga" id="waliIbu" value="Ibu">
                                        <label for="waliIbu" class="col-form-label">Ibu</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" name="kedudukan_dalam_keluarga" id="inputWali" value="Wali">
                                        <label for="inputWali" class="col-form-label">Wali</label>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center text-center">
                                    <div class="alert alert-success" id="ibuWali" style="display: none">
                                        <strong>Ibu Dipilih Sebagai Wali</strong>
                                    </div>
                                    <div class="alert alert-warning" id="ayahWali" style="display: none">
                                        <strong>Ayah Dipilih Sebagai Wali</strong>
                                    </div>
                                    <div class="alert alert-info" id="waliInput" style="display: none">
                                        <strong>Wali Orang Lain</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

        $('#data-berkas').click(function(){
            var sid = $(this).data('id');
            $('#sid').val(sid);
            var loaded = false;

            if(!loaded){
                $.ajax({
                    url: "/load-berkas/" + sid,
                    type: "GET",
                    success: function(res) {
                        if (res.data) {
                            var foto = '{{ asset('storage/') }}' + '/' + res.data.foto;
                            var kk = '{{ asset('storage/') }}' + '/' + res.data.kk;
                            var ktp_ortu = '{{ asset('storage/') }}' + '/' + res.data.ktp_ortu;
                            var ktp_wali = '{{ asset('storage/') }}' + '/' + res.data.ktp_wali;
                            $('#previewFoto1').attr('src', foto);
                            $('#previewFoto2').attr('src', kk);
                            $('#previewFoto3').attr('src', ktp_ortu);
                            $('#previewFoto4').attr('src', ktp_wali);
                            if(res.data.kk == null || res.data.ktp_ortu == null){
                                $('#previewFoto2').attr('src', '{{ asset('img/preview-image.png') }}');
                                $('#previewFoto3').attr('src', '{{ asset('img/preview-image.png') }}');
                                $('#previewFoto4').attr('src', '{{ asset('img/preview-image.png') }}');
                            }
                            loaded = true; // Set flag loaded menjadi true
                            //editBerkas();
                        } else {
                            $('#previewFoto1').attr('src', '{{ asset('img/preview-image.png') }}');
                            $('#previewFoto2').attr('src', '{{ asset('img/preview-image.png') }}');
                            $('#previewFoto3').attr('src', '{{ asset('img/preview-image.png') }}');
                            $('#previewFoto4').attr('src', '{{ asset('img/preview-image.png') }}');
                        }
                    },
                    error: function(xhr, error) {
                        console.log(xhr)
                        console.log(error)
                    }
                });
            }

            $('#file_berkas').show()
            $('#form-santri').hide();
            $('#form-ortu').hide();
            $('#form-wali').hide();
            $('#ayahIbu').hide();
            $('#formAsalSekolah').hide();
            $('#kamarPesantren').hide();

            $('#formBerkas').submit(function(e){
                e.preventDefault();
                $('#loader-container').show();
                $('#loader').show();
                var sid = $('#sid').val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                // Create FormData object to send files
                var formData = new FormData(this);

                //console.log(formData);

                $.ajax({
                    url: '/update-berkas/'+sid,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(res){
                        $('#loader-container').hide();
                        $('#loader').hide();
                        Swal.fire({
                            icon: 'success',
                            title: res.message,
                            toast: true,
                            position: 'top-end',
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                        });
                    },
                    error: function(xhr, error){
                        $('#loader-container').hide();
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

            });
        });
        const previewFotoInputs = document.querySelectorAll('.file-upload-input');
            previewFotoInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                const file = this.files[0];
                const previewFoto = document.getElementById('previewFoto' + this.id.slice(-1));
                if (file) {
                const reader = new FileReader();
                reader.onloadend = function() {
                    previewFoto.src = reader.result;
                    const fileInput = document.getElementById('previewFotoInput' + this.id.slice(-1));
                    fileInput.value = reader.result;
                }
                reader.readAsDataURL(file);
                } else {
                previewFoto.src = "{{ asset('img/preview-image.png') }}";
                }
            });
        });


        $('#postUpdate').submit(function(e){
            e.preventDefault();
            var id = '{{ routeParam::encode($results['saba']->id) }}'
            $('#loader-container').show();
            $('#loader').show();
            $.ajax({
                url: '/saba/'+id+'/update',
                type: 'POST',
                data: $('#postUpdate').serialize(),
                success: function(res){
                    $('#loader-container').hide();
                    $('#loader').hide();
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
                error: function(xhr, error){
                    $('#loader-container').hide();
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
        $('#waliAyah').click(function(){
            $('#ayahWali').show();
            $('#ibuWali').hide();
            $('#waliInput').hide();
        });
        $('#waliIbu').click(function(){
            $('#ibuWali').show();
            $('#ayahWali').hide();
            $('#waliInput').hide();
        });
        $('#inputWali').click(function(){
            $('#waliInput').show();
            $('#ibuWali').hide();
            $('#ayahWali').hide();
        });


        $('#selectKamar').change(function() {
            if ($(this).val() !== '') {
                $('#submitKamar').css('display', 'block');
                $('#setKamar').submit(function(e){
                    e.preventDefault();
                    var id = '{{ routeParam::encode($results['saba']->id) }}'
                    var kamarId = $('#selectKamar').val();
                    $.ajax({
                        url: "/set-kamar-santri/"+id,
                        type: 'POST',
                        data: {
                            kamar_id: kamarId,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(res){
                            Swal.fire({
                                icon: 'success',
                                title: res.message,
                                toast: true,
                                position: 'top-end',
                                timer: 2000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                            }).then(()=>{
                                location.reload();
                            });
                        },
                        error: function(xhr,error){
                            console.log(xhr)
                            console.log(error)
                        }
                    });
                })
            } else {
                $('#submitKamar').css('display', 'none');
            }
        });

        $(document).ready(function() {
            $('#province-dd').on('change', function() {
                var idProvince = this.value;
                $("#city-dd").html('');
                $("#kecamatan-dd").html('<option value=""></option>');
                $("#desa-dd").html('<option value=""></option>');
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
                $("#desa-dd").html('<option value=""></option>');
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
