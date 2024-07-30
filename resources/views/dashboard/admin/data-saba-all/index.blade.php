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
                <div id="searchWrapper" class="mb-3">
                    <input type="text" id="customSearchInput" placeholder="Search" class="form-control">
                </div>
                <div class="col-md-12" id="tableWrapper">
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
                <div class="col-md-12" id="cardView" ></div>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('script')
  <script>
    @php
        use App\Providers\RouteParamService as routeParam;
    @endphp
    var table = $('#tableSantri').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": '/getAllSantri',
            "type": 'GET',
        },
        drawCallback: function(settings) {
            // Call function to populate card view
            convertTableToCardView();
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
    // Custom search input event
    $('#customSearchInput').on('keyup', function() {
        table.search(this.value).draw();
    });


    // Function to convert table data to card view
    function convertTableToCardView() {
        const data = table.rows().data().toArray();
        const cardView = $('#cardView');
        $('#searchWrapper').show()
        // Clear card view content
        cardView.empty();
        // Iterate over each row of data
        data.forEach(row => {


            // Assuming row data order: [NO, NIS, NAMA, STATUS, ACTIOn
            var id = row.id;
            const nis = row['nis'];
            const nama = row['nama_lengkap'];
            const status = row['status'];

            // Create card elements
            const card = $('<div class="card card-outline mb-3"></div>');

            card.html(`
                <div class="card-body d-flex">
                    <div class="col-md-6" style="flex: 1 1 50%;">
                        <div class="fw-medium">NIS: ${nis}</div>
                        <div class="fw-medium">NAMA: ${nama}</div>
                        <div class="fw-medium">STATUS: ${status}</div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center" >
                        <a href="/show-saba/${id}" class="btn_edit btn btn-outline-primary btn-sm mt-1"><i class="lni lni-pencil-alt"></i></a>
                        <a href="/lihat-santri/${id}" class="btn btn-outline-warning btn-sm mt-1"><i class="lni lni-empty-file"></i></a>
                        <a href="#" data-id="${id}" class="btn-nonAktif btn btn-outline-danger btn-sm m-1"><i class="lni lni-trash-can"></i></a>
                    </div>
                </div>
            `);

            cardView.append(card);
        });
    }
    // Call the function to populate card view
    convertTableToCardView();

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


