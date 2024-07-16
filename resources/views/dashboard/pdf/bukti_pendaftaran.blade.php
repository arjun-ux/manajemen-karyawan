<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pendaftaran Santri</title>
</head>
<style>
    body {
        margin-top: -1cm;
        margin-bottom: -1cm;
        margin-left: -0.5cm;
        margin-right: -0.5cm;
        font-family: 'Times New Roman';
    }
    .kop {
        width: 100%;
    }
    .table {
        width: 100%;
        text-align: center;
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
        font-family: 'Times New Roman';
    }
    .table-2 {
        width: 90%;
        border-bottom: black solid 3px;
        text-align: center;
        margin: 0 auto;
        font-family: 'Times New Roman';
    }
    .table-3 {
        width: 90%;
        margin: 0 auto;
        padding: 0 12px;
        font-family: 'Times New Roman';
    }
    .table-4 {
        width: 85%;
        margin: 0 auto;
        padding: 0 12px;
        font-family: 'Times New Roman';
    }
    .table-5{
        width: 80%;
        margin: 0 auto;

        font-family: 'Times New Roman';
    }
    .table-6 {
        width: 80%;
        margin: 0 auto;
        margin-top: 20px;
        text-align: right;
        font-family: 'Times New Roman';
    }
    .table-7{
        width: 80%;
        margin: 0 auto;
        font-family: 'Times New Roman';
    }
    .biodata {
        font-size: 16px;
        font-weight: bold;
        font-family: 'Times New Roman';
    }
    .pondok {
        font-size: 13px;
        font-weight: bold;
        font-family: 'Times New Roman';
    }
    .head{
        font-size: 12px;
        font-weight: bold;
        font-family: 'Times New Roman';
    }
    .font-12 {
        font-size: 13px;
    }
    .col-4{
        width: 30%;
    }
    .col-5{
        width: 40%;
    }
    .col-6{
        width: 55%;
    }
    .text-center {
        text-align: center;
    }
    .mb{
      margin-bottom: 50px;
    }
</style>
<body>
    <img class="kop" src="data:image/png;base64,<?php echo base64_encode($results['kop']); ?>" alt="KOP">
    <table class="table">
        <table class="table-2">
            <tr class="mb"><td class="biodata">BIODATA SANTRI</td></tr>
            <tr class="mb"><td class="pondok">PONDOK PRSANTREN KANAK-KANAK DARUSSALAM</td></tr>
            <tr class="mb"><td class="font-12">BLOKAGUNG  BANYUWANGI</td></tr>
        </table>
    </table>
    <table class="table-3">
        <tr>
            <td class="head" style="width: 135px">A. NO PENDAFTARAN :</td>
            <td class="head" style="width: 50px; border-bottom: black solid 1px;">{{ isset($results['no_daftar']) ? $results['no_daftar'] : '-' }}</td>
            <td class="head" style="width: 40px">NISP :</td>
            <td class="head" style="width: 50px; border-bottom: black solid 1px;">{{ isset($results['saba']->nis) ? $results['saba']->nis : '-' }}</td>
            <td class="head"></td>
        </tr>
        <tr>
            <td class="head">B. IDENTITAS SANTRI</td>
        </tr>
    </table>
    <table class="table-4">
        <tr>
            <td class="font-12 col-5">1. Nama (Sesuai Akte/Kenal Lahir)</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['saba']->nama_lengkap) ? $results['saba']->nama_lengkap : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">2. Jenis Kelamin</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['saba']->jenis_kelamin) ? $results['saba']->jenis_kelamin : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">3. Tempat Tanggal Lahir</td>
            <td class="font-12 col-6" style="border-bottom: 1px solid rgb(0, 0, 0);">
                : {{ isset($results['saba']->tempat_lahir) ? $results['saba']->tempat_lahir : '-' }},
                {{ isset($results['saba']->tanggal_lahir) ? \Carbon\Carbon::parse($results['saba']->tanggal_lahir)->format('d M Y') : '-' }}
            </td>

        </tr>
        <tr>
            <td class="font-12 col-5">4. Anak Ke</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['saba']->anak_ke) ? $results['saba']->anak_ke : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">5. Jumlah Saudara</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['saba']->jumlah_saudara) ? $results['saba']->jumlah_saudara : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">6. Alamat Santri</td>
        </tr>
    </table>
    <table class="table-5">
        <tr>
            <td class="font-12 col-4">- RT / RW</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['saba']->rt_rw) ? $results['saba']->rt_rw : '-' }}</td>
            <td class="font-12 col-4">- Dusun</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['saba']->dusun) ? $results['saba']->dusun : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-4">- Desa</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['desa']->name) ? $results['desa']->name : '-' }}</td>
            <td class="font-12 col-4">- Kecamatan</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['kecamatan']->name) ? $results['kecamatan']->name : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-4">- Kabupaten</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['kabupaten']->name) ? $results['kabupaten']->name : '-' }}</td>
            <td class="font-12 col-4">- Provinsi</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['provinsi']->name) ? $results['provinsi']->name : '-' }}</td>
        </tr>
    </table>
    <table class="table-3">
        <tr>
            <td class="head">C. IDENTITAS ORANG TUA / WALI SANTRI</td>
        </tr>
    </table>
    <table class="table-4">
        <tr><td class="font-12">1. Ayah</td></tr>
    </table>
    <table class="table-5">
        <tr>
            <td class="font-12 col-4">- Nama</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['ortu']->nama_ayah) ? $results['ortu']->nama_ayah : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-4">- Pekerjaan</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['pekerjaanA']->nama_pekerjaan) ? $results['pekerjaanA']->nama_pekerjaan : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-4">- Pendidikan Terakhir</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['pendidikanA']->nama_pendidikan) ? $results['pendidikanA']->nama_pendidikan : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-4">- No. Hp</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['ortu']->no_hp_ayah) ? $results['ortu']->no_hp_ayah : '-' }}</td>
        </tr>
    </table>
    <table class="table-4">
        <tr><td class="font-12">2. Ibu</td></tr>
    </table>
    <table class="table-5">
        <tr>
            <td class="font-12 col-4">- Nama</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['ortu']->nama_ibu) ? $results['ortu']->nama_ibu : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-4">- Pekerjaan</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['pekerjaanI']->nama_pekerjaan) ? $results['pekerjaanI']->nama_pekerjaan : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-4">- Pendidikan Terakhir</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['pendidikanI']->nama_pendidikan) ? $results['pendidikanI']->nama_pendidikan : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-4">- No. Hp</td>
            <td class="font-12 col-6" style="border-bottom: black solid 1px;">: {{ isset($results['ortu']->no_hp_ibu) ? $results['ortu']->no_hp_ibu : '-' }}</td>
        </tr>
    </table>
    <table class="table-3">
        <tr>
            <td class="head">D. MASUK PESANTREN KANAK-KANAK</td>
        </tr>
    </table>
    <table class="table-4">
        <tr>\Carbon\Carbon::parse($results['asal_masuk']->tanggal_masuk)->isoFormat('dddd, D MMMM YYYY')
            <td class="font-12 col-5">1. Hari Tanggal</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ \Carbon\Carbon::parse($results['asal_sekolah']->tanggal_masuk)->isoFormat('dddd, D MMMM YYYY') }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">2. Asal dari TK / SD</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['asal_sekolah']->asal_sekolah) ? $results['asal_sekolah']->asal_sekolah : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">3. Alamat Asal Sekolah</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['asal_sekolah']->alamat_asal_sekolah) ? $results['asal_sekolah']->alamat_asal_sekolah : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">4. Diterima di Kelas</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['asal_sekolah']->diterima_dikelas) ? $results['asal_sekolah']->diterima_dikelas : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">5. Nomor Surat Pindah</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['asal_sekolah']->no_surat_pindah) ? $results['asal_sekolah']->no_surat_pindah : '-' }}</td>
        </tr>
    </table>
    <table class="table-3">
        <tr>
            <td class="head">E. IDENTITAS PENANGGUNG JAWAB BIAYA</td>
        </tr>
    </table>
    <table class="table-4">
        <tr>
            <td class="font-12 col-5">1. Nama</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['wali']->nama_wali) ? $results['wali']->nama_wali : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">2. Kedudukan Dalam Keluarga</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['wali']->kedudukan_dalam_keluarga) ? $results['wali']->kedudukan_dalam_keluarga : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">3. Alamat</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['wali']->alamat_wali) ? $results['wali']->alamat_wali : '-' }}</td>
        </tr>
        <tr>
            <td class="font-12 col-5">4. No. HP</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">: {{ isset($results['wali']->no_hp_wali) ? $results['wali']->no_hp_wali : '-' }}</td>
        </tr>
    </table>
    <table class="table-6">
        <tr>
            <td class="font-12">Blokagung, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</td>
        </tr>
    </table>
    <table class="table-7 text-center">
        <tr>
            <td class="font-12" colspan="2">Mengetahui:</td>
        </tr>
        <tr>
            <td class="font-12">Pengurus Pesantren</td>
            <td class="font-12">Orang Tua / Wali</td>
        </tr>
        <tr>
            <td class="font-12" style="padding-top: 50px">(_________________)</td>
            <td class="font-12" style="padding-top: 50px">{{ isset($results['ortu']->nama_ayah) ? $results['ortu']->nama_ayah : (isset($results['ortu']->nama_ibu) ? $results['ortu']->nama_ibu : (isset($results['wali']->nama_wali) ? $results['wali']->nama_wali : '_______________' )) }}</td>
        </tr>
    </table>
</body>
</html>
