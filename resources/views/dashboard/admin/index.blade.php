@extends('dashboard.admin.layouts.app')
@section('content')
<style>
.card-custom {
  border: none;
  border-radius: 10px; /* Rounded border */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
  transition: box-shadow 0.3s ease-in-out; /* Smooth shadow transition */
  /* Background gradient */
  background: linear-gradient(45deg, #eeffbae8, #92ce82);
  color: #ffffff; /* Text color */
}
.card-custom:hover {
  box-shadow: 0 10px 18px rgba(0, 0, 0, 0.2); /* Larger shadow on hover */
}
.card-body-custom {
  padding: 1.25rem; /* Padding inside the card body */
}

</style>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="alert alert-warning fw-bold">
                * Aplikasi Dalam Pengembangan akan tetapi sudah bisa digunakan
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card-custom py-2">
                    <div class="card-body-custom">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm fw-bold text-black text-uppercase mb-1">
                                    Jumlah Santri </div>
                                <div class="h4 mb-0 font-weight-bold" style="color:rgb(126, 126, 126)">{{ $JUMLAH['jumlahSantri'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="lni lni-users" style="font-size: 50px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card-custom py-2">
                    <div class="card-body-custom">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md fw-bold text-black text-uppercase mb-1">
                                    Pembayaran</div>
                                <div class="h6 mb-0 font-weight-bold"style="color:rgb(126, 126, 126)">{{ $JUMLAH['transaksi'] }}</div>
                            </div>
                            <div class="col-auto">
                                 <i class="lni lni-credit-cards" style="font-size: 50px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card-custom py-2">
                    <div class="card-body-custom">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md fw-bold text-black text-uppercase mb-1">
                                    Laporan</div>
                                <div class="h4 mb-0 font-weight-bold"style="color:rgb(126, 126, 126)">
                                    Bulan Juli
                                </div>
                            </div>
                            <div class="col-auto">
                                 <i class="lni lni-files" style="font-size: 50px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card-custom py-2">
                    <div class="card-body-custom">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md fw-bold text-black text-uppercase mb-1">
                                    Jumlah Admin</div>
                                <div class="h4 mb-0 font-weight-bold"style="color:rgb(126, 126, 126)">{{ $JUMLAH['jumlahAdmin'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="lni lni-user" style="font-size: 50px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 ">
                <div class="card">
                    <div class="card-header">
                        Grafik Santri
                    </div>
                    <div class="card-body">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 ">
                <div class="card">
                    <div class="card-header">
                        Data Kamar
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-stripped" id="tableSantri" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($JUMLAH['kamar'] as $val)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $val->nama_kamar }}</td>
                                            <td>{{ $val->jumlah_saba }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>

</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        chart: {
        type: 'line'
        },
        series: [{
        name: 'sales',
        data: [30,40,35,50,49,60,70,91,125]
        }],
        xaxis: {
        categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();

</script>
@endpush


