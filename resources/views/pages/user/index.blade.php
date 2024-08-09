@extends('layouts.app')

@section('title', 'User')
@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="mb-0 text-gray-600">User</h4>
                <div class="d-flex justify-content-end">
                    <a href="#" id="create" class="btn btn-sm btn-primary">
                        <i class="lni lni-user"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pages.user.add')
    @include('pages.user.edit')
@endsection


@push('script')
    <script>
        var table = $('#table').DataTable({
            processing: false,
            serverSide: true,
            responsive: true,
            pageLength: 10,
            lengthMenu: [
                [10, 20, 25, -1],
                [10, 20, 25, "50"]
            ],

            order: [],
            ajax: {
                url: "{{ route('user.data') }}",
                type: "get",
            },
            columns: [
                {data: 'DT_RowIndex','orderable': false,'searchable': false},
                {data: 'name',name: 'name'},
                {data: 'email',name: 'email'},
                {data: 'role',name: 'role'},
                {data: 'action',name: 'action'},
            ]
        });

        $('#create').click(function(){
            $('#modalAdd').modal('show');
        });
        $('#formPost').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('user.store') }}",
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(res){
                    $('#modalAdd').modal('hide');
                    Swal.fire({
                        icon: res.status,
                        text: res.message,
                        title: 'Berhasil',
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(()=>{
                        $('#formPost')[0].reset();
                        table.ajax.reload();
                    });
                },
                error: function(xhr, error){
                    console.log(xhr.responseText);
                }
            });
        });

        $('body').on('click', '.btn_edit', function(){
            var id = $(this).data('id');
            var url = "{{ route('user.id', ':id') }}".replace(':id', id);
            $.ajax({
                url: url,
                type: "get",
                success: function(res){
                    $('#uid').val(res.id);
                    $('#editName').val(res.name);
                    $('#editEmail').val(res.email);
                    $('#editRole').val(res.role);
                    $('#modalEdit').modal('show');
                },
                error: function(xhr, error){
                    console.log(xhr.responseText)
                }
            })
        });
        $('#formUpdate').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('user.update') }}",
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(res){
                    $('#modalEdit').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        text: res.message,
                        title: 'Berhasil',
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(()=>{
                        $('#formUpdate')[0].reset();
                        table.ajax.reload();
                    });
                },
                error: function(xhr, error){
                    console.log(xhr.responseText);
                }
            });
        });
        // Event handler for modal hide event
        $('#modalEdit').on('hide.bs.modal', function() {
            // Reset input values when the modal is hidden
            $('#editName').val('');
            $('#editEmail').val('');
            $('#editRole').val('');
        });
        $('body').on('click', '.btn_delete', function(){
            let id = $(this).data('id');
            Swal.fire({
                title: 'Delete data?',
                text: "Data akan terhapus!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user.delete') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: data.status,
                                    text: data.message,
                                    title: data.title,
                                    timer: 1500,
                                    showConfirmButton: false,
                                });

                                $('#table').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            });
        });
    </script>
@endpush
