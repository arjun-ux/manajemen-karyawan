@extends('dashboard.admin.layouts.app')
@section('content')
<style>
.card {
  border: none;
  border-radius: 10px; /* Rounded border */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
  transition: box-shadow 0.3s ease-in-out; /* Smooth shadow transition */
  /* Background gradient */
  background: linear-gradient(45deg, #bafff8e8, #82a4ce);
  color: #ffffff; /* Text color */
}
.card:hover {
  box-shadow: 0 10px 18px rgba(0, 0, 0, 0.2); /* Larger shadow on hover */
}
.card-body {
  padding: 1.25rem; /* Padding inside the card body */
}
.card-title {
  font-size: 1.25rem; /* Title font size */
  margin-bottom: 0.75rem; /* Bottom margin for title */
}
.card-text {
  line-height: 1.6; /* Line height for text */
}
.card-footer {
  background-color: rgba(0, 0, 0, 0.03); /* Footer background */
  border-top: none; /* No top border for footer */
  padding: 1rem; /* Padding for footer */
  border-bottom-left-radius: 10px; /* Rounded bottom left corner */
  border-bottom-right-radius: 10px; /* Rounded bottom right corner */
}
</style>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row p-0">
            {{--  <div class="alert alert-warning fw-bold">
                Aplikasi Dalam Pengembangan
            </div>  --}}
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card py-2">
                    <div class="card-body">
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
                <div class="card py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md fw-bold text-black text-uppercase mb-1">
                                    Pembayaran</div>
                                <div class="h6 mb-0 font-weight-bold"style="color:rgb(126, 126, 126)">Rp. 2000000000000</div>
                            </div>
                            <div class="col-auto">
                                 <i class="lni lni-credit-cards" style="font-size: 50px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card py-2">
                    <div class="card-body">
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
                <div class="card py-2">
                    <div class="card-body">
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

          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection



