@extends('dashboard.admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h4>Data Santri</h4>
            <hr>
            <a class="btn btn-outline-success btn-sm" href="{{ route('create_saba') }}"><i class="lni lni-user"></i></a>
            <table class="table table-bordered table-stripped" id="tableSantri" style="width: 100%; height: 50%">
                <thead class="bg-dark">
                    <tr>
                        <th class="text-center text-light">NO</th>
                        <th class="text-center text-light">NIS</th>
                        <th class="text-center text-light">NAMA</th>
                        <th class="text-center text-light">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('script')
  <script>
    $(document).ready(function(){
        $('#tableSantri').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/getAllSantri',
                "type": 'GET',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nis', name: 'nis'},
                {data: 'nama_lengkap', name: 'nama_lengkap'},
                {data: 'action', orderable: false, searchable: false}

            ],
            "deferLoading": 57,
            "deferRender": true,  // Defer rendering for improved performance
            "paging": true,       // Enable pagination
            "pageLength": 5,     // Number of records per page
        });
    });
  </script>
@endpush


