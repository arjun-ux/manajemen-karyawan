@extends('dashboard.admin.layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="alert alert-warning fw-bold">
                Aplikasi Dalam Pengembangan
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card shadow py-2" style="background-color: rgba(8, 137, 8, 0.417)">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm fw-bold text-black text-uppercase mb-1">
                                    Jumlah Santri </div>
                                <div class="h4 mb-0 font-weight-bold">{{ $JUMLAH['jumlahSantri'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="lni lni-users" style="font-size: 50px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card shadow py-2" style="background-color: rgba(98, 128, 0, 0.615)">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md fw-bold text-black text-uppercase mb-1">
                                    Pembayaran</div>
                                <div class="h6 mb-0 font-weight-bold">Rp. 2000000000000</div>
                            </div>
                            <div class="col-auto">
                                 <i class="lni lni-credit-cards" style="font-size: 50px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card shadow py-2" style="background-color: rgba(0, 128, 113, 0.615)">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md fw-bold text-black text-uppercase mb-1">
                                    Laporan</div>
                                <div class="h4 mb-0 font-weight-bold" style="color:rgb(255, 0, 0)">
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
                <div class="card shadow py-2" style="background-color: rgba(0, 83, 128, 0.615)">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md fw-bold text-black text-uppercase mb-1">
                                    Jumlah Admin</div>
                                <div class="h4 mb-0 font-weight-bold">{{ $JUMLAH['jumlahAdmin'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="lni lni-user" style="font-size: 50px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection



