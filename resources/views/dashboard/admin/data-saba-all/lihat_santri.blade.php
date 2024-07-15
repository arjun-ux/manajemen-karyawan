@extends('dashboard.admin.layouts.app')
@section('content')
@php
use App\Providers\RouteParamService as routeParam;
@endphp
<style>
    {{--  checkbox berkas  --}}
    .card-header.flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    }
    .card-header.flex .card-title {
        flex: 1; /* Menggunakan flex untuk memanfaatkan ruang tersedia */
    }
    /* Hide default checkbox */
    input[type="checkbox"] {
        display: none;
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
                            <th style="background-color: rgb(233, 246, 232)">Data <strong>{{ $datas['data']->nama_lengkap }}</strong></th>
                            <th class="text-end" style="background-color: rgb(233, 246, 232)">
                                <a type="button" href="/bukti-pendaftaran/{{ routeParam::encode($datas['data']->id) }}" class="btn btn-sm btn-outline-warning" target="_blank"><i class="lni lni-cloud-download"></i></a>
                                <a type="button" href="/show-saba/{{ routeParam::encode($datas['data']->id) }}" class="btn btn-sm btn-outline-primary" ><i class="lni lni-pencil-alt"></i></a>
                            </th>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-center mb-2">
                                    @if (isset($datas['berkas']->foto))
                                    <img class="img-thumbnail" src="{{ asset('storage/'. $datas['berkas']->foto) }}" alt="foto-profile-santri" style="width: 300px; height: 300px;">
                                    @else
                                    <img class="img-thumbnail" src="{{ asset('img/pp.png') }}" alt="pp">
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-outline mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Data Diri</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">NIS</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->nis) ? $datas['data']->nis : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">NAMA</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->nama_lengkap) ? $datas['data']->nama_lengkap : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">NIK</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->nik) ? $datas['data']->nik : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">NO KK</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->nokk) ? $datas['data']->nokk : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">Tempat Tanggal Lahir</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->tempat_lahir }}, {{ \Carbon\Carbon::parse($datas['data']->tanggal_lahir)->format('d M Y') }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card card-outline mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Data Diri</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">JENIS KELAMIN</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->jenis_kelamin) ? $datas['data']->jenis_kelamin : 'Data Tidak Ditemukan' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">ANAK KE</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->anak_ke) ? $datas['data']->anak_ke : 'Data Tidak Ditemukan' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">JUMLAH SAUDARA</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->jumlah_saudara) ? $datas['data']->jumlah_saudara : 'Data Tidak Ditemukan' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px; font-size: 14px;">SAUDARA KANDUNG</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->saudara_kandung) ? $datas['data']->saudara_kandung : 'Data Tidak Ditemukan' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">TANGGAL MASUK</td>
                                                        <td style="width: 20px">=</td>
                                                        @if (isset($datas['asal_sekolah']->tanggal_masuk))
                                                            <td style="width: 500px">{{ \Carbon\Carbon::parse($datas['asal_sekolah']->tanggal_masuk)->format('d M Y') }}</td>
                                                        @else
                                                            <td style="width: 500px">Data Tidak Ditemukan</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">ASAL SEKOLAH</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['asal_sekolah']->asal_sekolah) ? $datas['asal_sekolah']->asal_sekolah : 'Data Tidak Ditemukan' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">ALAMAT SEKOLAH</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['asal_sekolah']->alamat_asal_sekolah) ? $datas['asal_sekolah']->alamat_asal_sekolah : 'Data Tidak Ditemukan' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card card-outline mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Alamat</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">ALAMAT</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->alamat) ? $datas['data']->alamat : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">RT/RW</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->rt_rw) ? $datas['data']->rt_rw : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">DUSUN</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['data']->dusun) ? $datas['data']->dusun : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">DESA</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['desa']->name) ? $datas['desa']->name : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">KECAMATAN</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['kecamatan']->name) ? $datas['kecamatan']->name : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">KABUPATEN</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['kabupaten']->name) ? $datas['kabupaten']->name : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">PROVINSI</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['provinsi']->name) ? $datas['provinsi']->name : '' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-outline mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Data Ayah</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">Nama</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['ortu']->nama_ayah) ? $datas['ortu']->nama_ayah : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">Pekerjaan</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['pekerjaanA']->nama_pekerjaan) ? $datas['pekerjaanA']->nama_pekerjaan : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">Pendidikan</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['pendidikanA']->nama_pendidikan) ? $datas['pendidikanA']->nama_pendidikan : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">No HP</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['ortu']->no_hp_ayah) ? $datas['ortu']->no_hp_ayah : '' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-outline mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Data Ibu</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">Nama</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['ortu']->nama_ibu) ? $datas['ortu']->nama_ibu : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">Pekerjaan</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['pekerjaanI']->nama_pekerjaan) ? $datas['pekerjaanI']->nama_pekerjaan : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">Pendidikan</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['pendidikanI']->nama_pendidikan) ? $datas['pendidikanI']->nama_pendidikan : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">No HP</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ isset($datas['ortu']->no_hp_ibu) ? $datas['ortu']->no_hp_ibu : '' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-outline mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Penanggung Jawab Biaya</div>
                                        </div>
                                        <div class="card-body">
                                            @if (isset($datas['wali']->kedudukan_dalam_keluarga) && $datas['wali']->kedudukan_dalam_keluarga == 'Ayah')
                                                <div class="alert alert-warning">
                                                    <strong>* Ayah Sebagai Penanggung Jawab</strong>
                                                </div>
                                            @elseif (isset($datas['wali']->kedudukan_dalam_keluarga) && $datas['wali']->kedudukan_dalam_keluarga == 'Ibu')
                                                <div class="alert alert-success">
                                                    <strong>* Ibu Sebagai Penanggung Jawab</strong>
                                                </div>
                                            @else
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td class="fw-medium" style="width: 300px">Nama</td>
                                                            <td style="width: 20px">=</td>
                                                            <td style="width: 500px">{{ isset($datas['wali']->nama_wali) ? $datas['wali']->nama_wali : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium" style="width: 300px">Kedudukan</td>
                                                            <td style="width: 20px">=</td>
                                                            <td style="width: 500px">{{ isset($datas['wali']->kedudukan_dalam_keluarga) ? $datas['wali']->kedudukan_dalam_keluarga : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium" style="width: 300px">Alamat</td>
                                                            <td style="width: 20px">=</td>
                                                            <td style="width: 500px">{{ isset($datas['wali']->alamat_wali) ? $datas['wali']->alamat_wali : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-medium" style="width: 300px">No HP</td>
                                                            <td style="width: 20px">=</td>
                                                            <td style="width: 500px">{{ isset($datas['wali']->no_hp_wali) ? $datas['wali']->no_hp_wali : '' }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-outline">
                                        <div class="card-header flex" data-id="{{ $datas['data']->id }}">
                                            <div class="card-title fw-bold">Berkas</div>
                                            <input type="checkbox" id="checkbox-berkas">
                                            <label for="checkbox-berkas">&#9776;</label>
                                        </div>
                                        <div class="card-body" style="display: none" id="card-body">
                                            <div class="row">
                                                <div class="col-md-4 text-center">
                                                    <img id="kk" class="img-thumbnail"  src="" alt="kartu keluarga" style="width: 300px; height: 300px;">
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    <img id="ktp_ortu" class="img-thumbnail" src="" alt="ktp_ortu" style="width: 300px; height: 300px;">
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    <img id="ktp_wali" class="img-thumbnail" src="" alt="ktp wali" style="width: 300px; height: 300px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
@push('script')
  <script>
    $('.btn-pdf').click(function(){
        $.ajax({
            url: '/bukti-pendaftaran',
            type: 'POST',
            data: {
                dataArray: @json($datas),
                _token: "{{ csrf_token() }}",
            },
            success: function(res){
                console.log(res.message);
                var downloadLink = res.download_link;
                window.location.href = downloadLink;
            },
            error: function(xhr, error){
                console.log(xhr)
                console.log(error)
            }
        });
    });

    $(document).ready(function() {
        var checkbox = $('#checkbox-berkas');
        var cardBody = $('#card-body');
        var loaded = false; // Flag untuk menyimpan status apakah data sudah dimuat

        checkbox.change(function() {
            if (this.checked) {
                // Checkbox dicentang
                if (!loaded) {
                    // Jika data belum dimuat, lakukan permintaan AJAX
                    var sid = $(this).closest('.card-header').data("id");
                    $.ajax({
                        url: "/load-berkas/" + sid,
                        type: "GET",
                        success: function(res) {
                            if (res.data && res.data.kk && res.data.ktp_ortu) {
                                cardBody.show(); // Tampilkan card-body setelah berhasil memuat gambar
                                var kk = '{{ asset('storage/') }}' + '/' + res.data.kk;
                                var ktp_ortu = '{{ asset('storage/') }}' + '/' + res.data.ktp_ortu;
                                var ktp_wali = '{{ asset('storage/') }}' + '/' + res.data.ktp_wali;
                                $('#kk').attr('src', kk);
                                $('#ktp_ortu').attr('src', ktp_ortu);
                                $('#ktp_wali').attr('src', ktp_wali);
                                if(res.data.ktp_wali == null){
                                    $('#ktp_wali').attr('src', '{{ asset('img/preview-image.png') }}');
                                }
                                loaded = true; // Set flag loaded menjadi true
                            } else {
                                $('#kk').attr('src', '{{ asset('img/preview-image.png') }}'); // Kosongkan gambar jika tidak ditemukan
                                $('#ktp_ortu').attr('src', '{{ asset('img/preview-image.png') }}');
                                $('#ktp_wali').attr('src', '{{ asset('img/preview-image.png') }}');
                                cardBody.hide(); // Sembunyikan card-body jika tidak ada gambar yang ditemukan
                            }
                        },
                        error: function() {
                            cardBody.hide(); // Sembunyikan card-body jika terjadi error
                        }
                    });
                } else {
                    // Jika data sudah dimuat sebelumnya, langsung tampilkan card-body
                    cardBody.show();
                }
            } else {
                // Checkbox tidak dicentang, sembunyikan card-body
                cardBody.hide();
            }
        });
    });


  </script>
@endpush


