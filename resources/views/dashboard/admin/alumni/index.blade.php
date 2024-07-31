@extends('dashboard.admin.layouts.app')
@section('content')
<style>
    .custom-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0; /* Border utama di sekitar card */
        border-top: 4px solid green; /* Border atas dengan warna yang menonjol */
        max-height: 180px; /* Atur tinggi maksimum card di sini */
        overflow-y: auto;
    }

    .custom-card ul li {
        padding: 5px 0; /* Sesuaikan padding untuk mengurangi tinggi item list */
        border-bottom: 1px solid #e0e0e0;
        font-size: 14px; /* Sesuaikan ukuran font jika perlu */
        font-family: "Poppins"
    }

    .custom-card ul li:last-child {
        border-bottom: none;
    }

    .custom-card .btn {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        padding: 2px 6px; /* Sesuaikan padding tombol untuk tinggi yang lebih baik */
    }

    .custom-card .btn:hover {
        background-color: #f0f0f0;
        color: #333;
        border-color: #ddd;
    }

    .custom-card .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .custom-card .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #fff;
    }

    .custom-card .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
</style>
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
                <div id="searchWrapper" class="mb-3">
                    <input type="text" id="customSearchInput" placeholder="Search" class="form-control">
                </div>
                <div class="col-md-12" id="tableWrapper">
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
                <div class="col-md-12" id="cardView" ></div>
                <div class="col-md-12" id="pagination"></div>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('script')
  <script>
    $(document).ready(function(){
        var table = $('#tableAlumni').DataTable({
            "processing": false,
            "serverSide": true,
            "ajax": {
                "url": '/data-alumni',
                "type": 'GET',
            },
            drawCallback: function(settings) {
                $('#pagination').text('Total Of Data '+settings.json.recordsTotal);
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
                        return '<span class="btn btn-sm btn-danger">Alumni</span>';
                    }
                },

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
                const card = $('<div class="card custom-card p-3 rounded shadow-sm mb-1"></div>');

                card.html(`
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-fill pe-3">
                            <ul class="list-unstyled mb-0">
                                <li>NIS : <strong>${nis}</strong> </li>
                                <li>NAMA : <strong>${nama}</strong> </li>
                                <li>STATUS : <strong>${status}</strong> </li>
                            </ul>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <a href="/show-saba/${id}" class="btn btn-outline-primary btn-sm mb-2 rounded-pill">
                                <i class="lni lni-pencil-alt"></i>
                            </a>
                            <a href="/lihat-santri/${id}" class="btn btn-outline-warning btn-sm mb-2 rounded-pill">
                                <i class="lni lni-empty-file"></i>
                            </a>
                            <a href="#" data-id="${id}" class="btn-nonAktif btn btn-outline-danger btn-sm rounded-pill">
                                <i class="lni lni-trash-can"></i>
                            </a>
                        </div>
                    </div>
                `);

                cardView.append(card);
            });
        }
        // Call the function to populate card view
        convertTableToCardView();
    });
  </script>
@endpush


