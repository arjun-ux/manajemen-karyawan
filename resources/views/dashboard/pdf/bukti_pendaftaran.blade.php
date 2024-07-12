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
        border: black solid 2px;
    }
    .kop {
        width: 100%;
    }
    .table {
        width: 100%;
        text-align: center;
        display: flex;
        justify-content: center;
    }
    .table-2 {
        width: 80%;
        border-bottom: black solid 1px;
        text-align: center;
        margin: 0 auto;
    }

    .biodata {
        font-size: 18px;
        font-weight: bolder;
    }
    .pondok {
        font-size: 16px;
        font-weight: bold;
    }
</style>
<body>
    <img class="kop" src="data:image/jpg;base64,<?php echo base64_encode($results['kop']); ?>" alt="KOP">
    <table class="table">
        <table class="table-2">
            <tr>
                <td class="biodata">BIODATA SANTRI</td>
            </tr>
            <tr>
                <td class="pondok">PONDOK PRSANTREN KANAK-KANAK DARUSSALAM</td>
            </tr>
            <tr>
                <td>BLOKAGUNG  BANYUWANGI</td>
            </tr>
        </table>
    </table>
</body>
</html>
