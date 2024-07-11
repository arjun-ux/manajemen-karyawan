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
                            <th style="background-color: rgb(233, 246, 232)">Data <strong>{{ $datas['data']->nama_lengkap }}</strong></th>
                            <th class="text-end" style="background-color: rgb(233, 246, 232)">
                                <button type="button" class="btn btn-sm btn-outline-warning" ><i class="lni lni-cloud-download"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-primary" ><i class="lni lni-pencil-alt"></i></button>
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
                                    <h5>Foto</h5>
                                    <img class="img-thumbnail" src="{{ asset('storage/'. $datas['berkas']->foto) }}" alt="foto-profile-santri">
                                    @else
                                    <img class="img-thumbnail" src="{{ asset('img/pp.png') }}" alt="pp">
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Data Diri</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">NIS</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->nis }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">NAMA</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->nama_lengkap }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">NIK</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->nik }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">NO KK</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->nokk }}</td>
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
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Data Diri</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">JENIS KELAMIN</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->jenis_kelamin }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">ANAK KE</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->anak_ke }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">JUMLAH SAUDARA</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->jumlah_saudara }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">SAUDARA KANDUNG</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->saudara_kandung }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Alamat Santri</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">ALAMAT</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->alamat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">RT/RW</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->rt_rw }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">DUSUN</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['data']->dusun }}</td>
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
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Data Ayah</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">Nama</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['ortu']->nama_ayah }}</td>
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
                                                        <td style="width: 500px">{{ $datas['ortu']->no_hp_ayah }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Data Ibu</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <td class="fw-medium" style="width: 300px">Nama</td>
                                                        <td style="width: 20px">=</td>
                                                        <td style="width: 500px">{{ $datas['ortu']->nama_ibu }}</td>
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
                                                        <td style="width: 500px">{{ $datas['ortu']->no_hp_ibu }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <div class="card-title fw-bold">Penanggung Jawab Biaya</div>
                                        </div>
                                        <div class="card-body"></div>
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

  </script>
@endpush


