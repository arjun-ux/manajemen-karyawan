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
                            <th style="background-color: rgb(233, 246, 232)">Data Alumni</strong></th>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped" id="tableAlumni" style="width: 100%; height: 50%">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center text-light">NO</th>
                                    <th class="text-center text-light">NIS</th>
                                    <th class="text-center text-light">NAMA</th>
                                    <th class="text-center text-light">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('script')
  <script>
    $(document).ready(function(){
        $('#tableAlumni').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/data-alumni',
                "type": 'GET',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nis', name: 'nis'},
                {data: 'nama_lengkap', name: 'nama_lengkap'},
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, full, meta) {
                        return '<span class="btn btn-sm btn-danger">Alumni</span>';
                    }
                },

            ]
        });
    });
  </script>
@endpush


