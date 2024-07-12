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
        margin: -0.5cm;
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
        margin-bottom: 20px;
    }
    .table-2 {
        width: 80%;
        border-bottom: black solid 3px;
        text-align: center;
        margin: 0 auto;
    }
    .table-3 {
        width: 80%;
        margin: 0 auto;
    }
    .table-4 {
        width: 70%;
        margin: 0 auto;
        {{--  border: black solid 1px;  --}}
    }
    .biodata {
        font-size: 16px;
        font-weight: bold;
    }
    .pondok {
        font-size: 14px;
        font-weight: bold;
    }
    .head{
        font-size: 12px;
        font-weight: bold;
    }
    .font-12 {
        font-size: 12px;
    }
    .col-5{
        width: 40%;
    }
    .col-6{
        width: 55%;
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
            <td class="head" style="width: 50px; border-bottom: black solid 1px;">002</td>
            <td class="head" style="width: 40px">NISP :</td>
            <td class="head" style="width: 50px; border-bottom: black solid 1px;">240001</td>
            <td class="head"></td>
        </tr>
        <tr>
            <td class="head">B. IDENTITAS SANTRI</td>
        </tr>
    </table>
    <table class="table-4">
        <tr>
            <td class="font-12 col-5">1. Nama (Sesuai Akte/Kenal Lahir)</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">:Hello</td>
        </tr>
        <tr>
            <td class="font-12 col-5">2. Jenis Kelamin</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">:Hello</td>
        </tr>
        <tr>
            <td class="font-12 col-5">3. Tempat Tanggal Lahir</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">:Hello</td>
        </tr>
        <tr>
            <td class="font-12 col-5">4. Anak Ke</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">:Hello</td>
        </tr>
        <tr>
            <td class="font-12 col-5">5. Jumlah Saudara</td>
            <td class="font-12 col-6" style="border-bottom: rgb(0, 0, 0) solid 1px;">:Hello</td>
        </tr>
    </table>
</body>
</html>
