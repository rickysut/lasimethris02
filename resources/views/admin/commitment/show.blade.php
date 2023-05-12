@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('commitment_show')
    {{-- {{ dd($data_poktan) }} --}}
    <div class="row">
        <!-- Left Panel -->
        <div class="col-md-4">
            <div class="panel" id="panel-1">
                <div class="panel-hdr">
                    <h2>
                        Data <span class="fw-300"><i>Basic</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        
                    </div>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <ul class="list-group mb-3" style="word-break:break-word;">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Perusahaan/Lembaga</span>
                                    <h6 class="fw-500 my-0">{{ $pullRiph->nama }}</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Nomor RIPH</span>
                                    <h6 class="fw-500 my-0">{{ $pullRiph->no_ijin }}</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Tanggal Terbit</span>
                                    <h6 class="fw-500 my-0">{{ date('d/m/Y', strtotime($pullRiph->tgl_ijin)) }}</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Volume RIPH</span>
                                    <h6 class="fw-500 my-0">{{ number_format($pullRiph->volume_riph,2,',', '.') }} ton </h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Vol. Wajib Produksi</span>
                                    <h6 class="fw-500 my-0">{{ number_format( $pullRiph->volume_produksi,2,',', '.') }} ton</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Luas Wajib Tanam</span>           
                                    <h6 class="fw-500 my-0">{{ number_format($pullRiph->luas_wajib_tanam,2,',', '.') }} ha</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Status dokumen</span>
                                    <h6 class="fw-500 my-0">
                                    @switch($pullRiph->status)
                                        @case(1)
                                            <div class="row">
                                                <div class="col-md-12 my-1">
                                                    Menunggu Review Verifikasi 
                                                </div>
                                                <div class="col-md-12 my-1">
                                                    No Dokumen: <a href="@if ($pengajuan[0]) {{ route('admin.task.pengajuan.show', $pengajuan[0]->id) }} @else # @endif" ><i class="fal fa-arrow-alt-right"></i>&nbsp;{{ $pullRiph->no_doc }}</a>
                                                </div>   
                                            </div>
                                            
                                            @break
                                        @case(2)
                                            <div class="row">
                                                <div class="col-md-12 my-1">
                                                    Sudah Diverifikasi
                                                </div>
                                                <div class="col-md-12 my-1">
                                                    <a href="#" class="btn btn-sm btn-success" data-toggle="tooltip"><i class="fas fa-badge-check"></i> Ajukan SKL</a>
                                                </div>        
                                            </div>
                                            
                                            @break
                                        @case(3)
                                            Pengajuan SKL
                                            @break
                                        @case(4)
                                            Review SKL
                                            @break
                                        @case(5)
                                            SKL Sudah Terbit
                                            @break
                                        @default
                                            <div class="row">
                                                <div class="col-md-12 my-1">
                                                    Belum diajukan Verifikasi Oleh Importir
                                                </div>
                                                <div class="col-md-12 my-1">
                                                    <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#verifikasiModal"><i class="fas fa-badge-check"></i> Ajukan Verifikasi</a>
                                                </div>        
                                            </div>
                                            
                                    @endswitch 
                                    
                                    </h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel" id="panel-2">
                <div class="panel-hdr">
                    <h2>
                        DATA <span class="fw-300"><i>Pembenihan</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Kebutuhan Benih</span>
                                    <h6 class="fw-500 my-0">@if ($pullData){{  number_format($pullData['riph']['wajib_tanam']['kebutuhan_benih'],2,',', '.') }}@endif ton</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Stok Mandiri</span>
                                    <h6 class="fw-500 my-0">@if ($pullData){{ number_format($pullData['riph']['wajib_tanam']['stok_mandiri'],2,',', '.') }}@endif  ton</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Beli dari Penangkar</span>
                                    <h6 class="fw-500 my-0">@if ($pullData){{ number_format($pullData['riph']['wajib_tanam']['beli_penangkar'],2,',', '.') }} @endif ton</h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel" id="panel-3">
                <div class="panel-hdr">
                    <h2>
                        DATA <span class="fw-300"><i>Pengendalian</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Pupuk Organik</span>
                                    <h6 class="fw-500 my-0">@if ($pullData){{ number_format($pullData['riph']['wajib_tanam']['kebutuhan_pupuk']['pupuk_organik'],2,',', '.') }}@endif kg</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Nitrogen Phosfor Kalium (NPK)</span>
                                    <h6 class="fw-500 my-0">@if ($pullData){{ number_format($pullData['riph']['wajib_tanam']['kebutuhan_pupuk']['npk'],2,',', '.') }}@endif kg</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Dolomit</span>
                                    <h6 class="fw-500 my-0">@if ($pullData){{ number_format($pullData['riph']['wajib_tanam']['kebutuhan_pupuk']['dolomit'],2,',', '.') }}@endif kg</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Zwavelzure Amonium (ZA)</span>
                                    <h6 class="fw-500 my-0">@if ($pullData){{ number_format($pullData['riph']['wajib_tanam']['kebutuhan_pupuk']['za'],2,',', '.') }}@endif kg</h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel" id="panel-4">
                <div class="panel-hdr">
                    <h2>
                        DATA <span class="fw-300"><i>Lainnya</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Saprodi Lainnya</span>
                                    <div class="d-flex justify-content-between">
                                        @isset($pullData['riph']['wajib_tanam']['mulsa'])
                                            <h6 class="fw-500 my-0">Mulsa:&nbsp;</h6>
                                            <h6 class="fw-500 my-0">{{ number_format($pullData['riph']['wajib_tanam']['mulsa'],2,',', '.') }} kg</h6>    
                                        @endisset
                                        
                                        
                                    </div>
                                </div>
                            </li>
                            @isset($pullData['riph']['wajib_tanam']['bagi-hasil'])
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    
                                    <span class="text-muted">Bagi Hasil</span>
                                    <h6 class="fw-500 my-0">{{ $pullData['riph']['wajib_tanam']['bagi-hasil'] }}</h6>
                                    
                                </div>
                            </li>
                            @endisset
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- right Panel -->
        <div class="col-md-8">
            <div class="panel" id="panel-5">
                <div class="panel-hdr">
                    <h2>
                        Daftar <span class="fw-300"><i>Kelompoktani Mitra & PKS</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="alert alert-info border-0 mb-0">
                    <div class="d-flex align-item-center">
                        <div class="alert-icon">
                            <div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
                                <i class="base base-7 icon-stack-3x opacity-100 color-primary-400"></i>
                                <i class="base base-7 icon-stack-2x opacity-100 color-primary-800"></i>
                                <i class="fa fa-info icon-stack-1x opacity-100 color-white"></i>
                            </div>
                        </div>
                        <div class="flex-1 help-block">
                            <span>Berikut ini adalah daftar Kelompoktani Binaan yang telah Anda pilih sebelumnya pada form Komitmen Baru.</span>
                        </div>
                        <div class="flex-2">
                            <span><a href="{{ route('admin.task.kelompoktani.show', [$nomor]) }}" class="btn btn-primary">Detail</a></span>
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-keltan" class="table table-sm table-bordered table-hover table-striped w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Kelompok tani</th>
                                    <th>Pimpinan</th>
                                    <th>No. hp</th>
                                    <th>Jumlah Petani</th>
                                    <th>Kecamatan</th>
                                    <th>Luas (Ha)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($poktans)
                                @foreach ( $poktans as $poktan )
                                
                                    <tr>
                                        <td>{{ $poktan->nama_kelompok }}</td>
                                        <td>{{ $poktan->nama_pimpinan }}</td>
                                        <td>{{ $poktan->hp_pimpinan }}</td>
                                        <td style="text-align: center;">{{ $poktan->jum_petani }}</td>
                                        <td>{{ $poktan->kecamatan }}</td>
                                        <td style="text-align: center;">{{ $poktan->luas }}</td>
                                        
                                    </tr>    
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
            </div>

            <div class="panel" id="panel-6">
                <div class="panel-hdr">
                    <h2>
                        Daftar <span class="fw-300"><i>Penangkar Benih Mitra</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="alert alert-info border-0 mb-0">
                    <div class="d-flex align-item-center">
                        <div class="alert-icon">
                            <div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
                                <i class="base base-7 icon-stack-3x opacity-100 color-primary-400"></i>
                                <i class="base base-7 icon-stack-2x opacity-100 color-primary-800"></i>
                                <i class="fa fa-info icon-stack-1x opacity-100 color-white"></i>
                            </div>
                        </div>
                        <div class="flex-1 help-block">
                            <span>Berikut ini adalah daftar Penangkar Benih yang telah Anda laporkan pada aplikasi RIPH Online sebelumnya.</span>
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-tangkar" class="table table-sm table-bordered table-hover table-striped w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th id="nama_usaha">Penangkar</th>
                                    <th id="varietas">Varietas</th>
                                    <th id="alamat">Alamat</th>
                                    <th id="pimpinan">Pimpinan</th>
                                    <th id="no_hp">No. Kontak</th>
                                    <th id="ketersediaan">Ketersediaan</th>
                                    <th id="tindakan">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @isset($pullData['riph']['wajib_tanam']['datapenangkar'])
                                @foreach ($pullData['riph']['wajib_tanam']['datapenangkar'] as $penakar )
                                    {{-- {{ dd($penakar['nama_penangkar']) }} --}}
                                    <tr>
                                        <td>{{ (is_string($penakar['nama_penangkar']) ? $penakar['nama_penangkar'] : '')  }}</td>
                                        <td>{{ (is_string($penakar['varietas']) ? $penakar['varietas'] : '')  }}</td>
                                        <td>{{ (is_string($penakar['alamat']) ? $penakar['alamat'] : '') }}</td>
                                        <td>{{ (is_string($penakar['nama_pimpinan']) ? $penakar['nama_pimpinan'] : '') }}</td>
                                        <td>{{ (is_string($penakar['hp_pimpinan']) ? $penakar['hp_pimpinan'] : '') }}</td>
                                        <td>{{ (is_string($penakar['waktu']) ? $penakar['waktu'] : '') }}</td>
                                        <td class="text-center">
                                            <div class="justify-content-center">
                                                {{-- create button only when there are no data available --}}
                                                <a class="text-info mr-1" href="#" role="button" data-toggle="tooltip" data-original-title="buat Rencana Tanam/PKS" data-offset="0,10"><i class="fal fa-plus-circle"></i></a>
                                            </div>
                                        </td>
                                    </tr>    
                                @endforeach
                                @endisset
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel" id="panel-6" hidden>
                <div class="alert alert-warning border-0 mb-0">
                    <div class="d-flex align-item-center">
                        <div class="alert-icon">
                            <div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
                                <i class="base base-7 icon-stack-3x opacity-100 color-warning-400"></i>
                                <i class="base base-7 icon-stack-2x opacity-100 color-warning-800"></i>
                                <i class="fa fa-ban icon-stack-1x opacity-100 color-white"></i>
                            </div>
                        </div>
                        <div class="flex-1 help-block">
                            <span>
                                <strong>Lakukan Pengajuan</strong>
                                Verifikasi maupun Surat Keterangan Lunas hanya jika Anda telah
                                <strong>melengkapi seluruh syarat yang diwajibkan. </strong>
                            </span>
                            <span>Tombol <a class="badge btn-warning text-dark">Ajukan Verifikasi</a> untuk mengajukan proses verifikasi lapangan maupun verifikasi data online. </span>
                            <span>Tombol <a class="badge btn-success text-white">Ajukan SKL</a> untuk mengajukan Penerbitan Surat Keterangan Lunas.</span>
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content justify-content-center text-center">
                        <div class="row d-flex">
                            <div class="col-md-6 my-1">
                                <a href="#" class="btn btn-sm btn-warning btn-block" data-toggle="tooltip" data-offset="0,10" data-original-title="Ajukan Verifikasi"><i class="fas fa-badge-check"></i> Ajukan Verifikasi</a>
                            </div>
                            <div class="col-md-6 my-1">
                                <a href="#" class="btn btn-sm btn-success btn-block" data-toggle="tooltip" data-offset="0,10" data-original-title="Ajukan Keterangan Lunas"><i class="fas fa-award"></i> Ajukan SKL</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    
    <!-- Modal -->
<div class="modal fade" id="verifikasiModal" tabindex="-1" role="dialog" aria-labelledby="verifikasiModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Pengajuan <span class="fw-300"><i>Verifikasi</i></span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="alert alert-warning border-0 mb-0">
            <div class="d-flex align-item-center">
                <div class="alert-icon">
                    <div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
                        <i class="base base-7 icon-stack-3x opacity-100 color-warning-400"></i>
                        <i class="base base-7 icon-stack-2x opacity-100 color-warning-900"></i>
                        <i class="fa fa-exclamation icon-stack-1x opacity-100 color-white"></i>
                    </div>
                </div>
                <div class="flex-1 help-block">
                    <span><h5>Berikut ini adalah berkas-berkas yang <span class="fw-900 text-danger">HARUS Anda unggah </span>(salinan hasil pindai) sebagai syarat wajib pengajuan verifikasi. </h5></span>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.task.commitment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col">
                        <label class="form-label h6">RIPH</label>
                        <div class="custom-file input-group">
                            <input type="file" class="custom-file-input" name="formRiph" required>
                            <label class="custom-file-label" for="formRiph">Pilih file...</label>
                        </div>
                        <span class="help-block">Surat Persetujuan RIPH. (.jpg / .pdf).</span>
                    </div>
                    <div class="form-group col">
                        <label class="form-label h6">Form SPTJM</label>
                        <div class="custom-file input-group">
                            <input type="file" class="custom-file-input" name="formSptjm" required>
                            <label class="custom-file-label" for="formSptjm">Pilih file...</label>
                        </div>
                        <span class="help-block">Form Pertanggungjawaban Mutlak. (.jpg / .pdf).</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label class="form-label h6">Logbook</label>
                        <div class="custom-file input-group">
                            <input type="file" class="custom-file-input" name="logbook" required>
                            <label class="custom-file-label" for="logbook">Pilih file...</label>
                        </div>
                        <span class="help-block">Logbook. (.jpg / .pdf).</span>
                    </div>
                    <div class="form-group col">
                        <label class="form-label h6">Form-RT</label>
                        <div class="custom-file input-group">
                            <input type="file" class="custom-file-input" name="formRt" required>
                            <label class="custom-file-label" for="formRt">Pilih file...</label>
                        </div>
                        <span class="help-block">Form Rencana Tanam. (.jpg / .pdf).</span>
                    </div>        
                </div>
                
                <div class="row">
                    <div class="form-group col">
                        <label class="form-label h6">Form-RTA</label>
                        <div class="custom-file input-group">
                            <input type="file" class="custom-file-input" name="formRta" required>
                            <label class="custom-file-label" for="formRta">Pilih file...</label>
                        </div>
                        <span class="help-block">Form Realisasi tanam. (.jpg / .pdf).</span>
                    </div>
                    <div class="form-group col">
                        <label class="form-label h6">Form RPO</label>
                        <div class="custom-file input-group">
                            <input type="file" class="custom-file-input" name="formRpo" required>
                            <label class="custom-file-label" for="formRpo">Pilih file...</label>
                        </div>
                        <span class="help-block">Form Realisasi Produksi. (.jpg / .pdf).</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label class="form-label h6">Form LA</label>
                        <div class="custom-file input-group">
                            <input type="file" class="custom-file-input" name="formLa" required>
                            <label class="custom-file-label" for="formLa">Pilih file...</label>
                        </div>
                        <span class="help-block">Form Laporan Akhir. (.jpg / .pdf).</span>
                    </div>
                    <div class="modal-footer col">
                        <button type="button" class="btn btn-secondary align-bottom" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary align-bottom">Unggah</button>
                    </div>    
                </div>
            </form>
            
        </div>
        
      </div>
    </div>
  </div>

@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
@parent


@endsection