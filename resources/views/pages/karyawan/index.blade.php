@extends('layouts.app')
@section('content')

    <style>
        .table {
            font-size: 14px !important;
        }
    </style>

    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="mb-0 text-gray-600">Karyawan</h4>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('karyawan.create') }}" class="btn btn-sm btn-primary">
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
                                <th>No Ktp</th>
                                <th>Nama Lengkap</th>
                                <th>Jabatan Kerja</th>
                                <th>Status Aktif</th>
                                <th>No Telepon</th>
                                <th>Status Kerja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        @include('pages.karyawan.detail')
@endsection


@push('script')
    <script>
        $('#table').DataTable({
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
                url: "{{ route('karyawan.data') }}",
                type: "get",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    'orderable': false,
                    'searchable': false
                },
                {
                    data: 'no_ktp',
                    name: 'no_ktp'
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'jabatan_kerja',
                    name: 'jabatan_kerja'
                },
                {
                    data: 'status_aktif',
                    name: 'status_aktif',
                },
                {
                    data: 'no_telepon',
                    name: 'no_telepon',
                },
                {
                    data: 'status_kerja',
                    name: 'status_kerja',
                },

                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });


        $(document).on('click', '#hapus', function() {
            let id = $(this).attr('data-id');
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
                        url: "{{ route('karyawan.hapus') }}",
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
        $(document).on('click','#detail', function(){
            $('#modalDetail').modal('show');
            let id = $(this).attr('data-id');
            $.ajax({
                url: 'karyawan/detail/'+id,
                type: 'GET',
                success: function(res){
                    console.log(res);
                    if(res.foto == null){
                        $('#foto').attr('src', '{{ asset('img/preview-image.png') }}');
                    }
                    var foto = '{{ asset('storage/') }}' + '/' + res.foto;
                    $('#foto').attr('src', foto);


                    $('#no_ktp').val(res.no_ktp);
                    $('#nama_lengkap').val(res.nama_lengkap);
                    $('#alamat_tempat_tinggal').val(res.alamat_tempat_tinggal);
                    $('#tanggal_lahir').val(res.tanggal_lahir);
                    $('#tempat_lahir').val(res.tempat_lahir);
                    $('#agama').val(res.agama);
                    $('#no_telepon').val(res.no_telepon);
                    $('#jenis_kelamin').val(res.jenis_kelamin);
                    $('#status_pernikahan').val(res.status_pernikahan);
                    $('#jenjang_pendidikan').val(res.jenjang_pendidikan);
                    $('#jabatan_kerja').val(res.jabatan_kerja);
                    $('#gaji').val(res.gaji);
                    $('#tanggal_masuk_kerja').val(res.tanggal_masuk_kerja);
                    $('#status_kerja').val(res.status_kerja);
                    $('#status_aktif').val(res.status_aktif);
                    $('#email').val(res.email);
                },
                error: function(xhr, error){
                    console.log(xhr)
                    console.log(error)
                }
            });
        });
    </script>
@endpush
