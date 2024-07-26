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
                            <th style="background-color: rgb(233, 246, 232)">Data Santri</strong></th>
                            <th class="text-end" style="background-color: rgb(233, 246, 232)">
                                <a class="btn btn-outline-success btn-sm" href="{{ route('create_saba') }}"><i class="lni lni-user"></i></a>
                            </th>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped" id="tableSantri" style="width: 100%; height: 50%">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-center text-light">NO</th>
                                    <th class="text-center text-light">NIS</th>
                                    <th class="text-center text-light">NAMA</th>
                                    <th class="text-center text-light">STATUS</th>
                                    <th class="text-center text-light">ACTION</th>
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
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, full, meta) {
                        if (data === 'Register') {
                            return '<span class="btn btn-sm btn-danger">Register</span>';
                        } else if (data === 'Pending') {
                            return '<span class="btn btn-sm btn-warning">Pending</span>';
                        } else if (data === 'Aktif') {
                            return '<span class="btn btn-sm btn-success">Aktif</span>';
                        } else {
                            return data; // Handle other cases or return data as-is
                        }
                    }
                },
                {data: 'action', orderable: false, searchable: false}

            ]
        });
    });

    $('body').on('click', '.btn-nonAktif', function(){
        var id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan di nonaktifkan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Nonaktifkan!'
        }).then((value)=>{
            if(value.isConfirmed){
                setBoyong(id);
            }
        });
    });
    function setBoyong(id){
        $.ajax({
            url: '/set-boyong/'+id,
            type: 'post',
            data: {
                _token: "{{ @csrf_token() }}"
            },
            success: function(res){
                Swal.fire({
                    title: res.message,
                    icon: 'success',
                    toast: true,
                    timer: 1500,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                }).then(()=>{
                    $('#tableSantri').DataTable().ajax.reload();
                });
            },
            error: function(xhr, error){
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
        });
    }
  </script>
@endpush


