@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('pengajuan_show')

    <div class="row">
        
        <!-- panel onfarm.Visible saat jenis VERIFIKASI saja -->
        <div class="col-md-12">
            <div class="panel" id="panel-1">
                <div class="panel-hdr bg-warning-50">
                    <h2>
                        ONFARM<span class="fw-300 ml-1"><i>Verification</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table">
                            <table class="table table-sm table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="3">Tanggal</th>
                                        <th class="text-center" colspan="3">Status Verifikasi</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Pengajuan</th>
                                        <th class="text-center">Verifikasi</th>
                                        <th class="text-center">Penetapan</th>
                                        <th class="text-center">Tanam</th>
                                        <th class="text-center">Produksi</th>
                                        <th class="text-center">Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td class="text-center">-</td> 
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center"><span class="badge btn-sm btn-default"> </span></td>
                                    <td class="text-center"><span class="badge btn-sm btn-danger"></span></td>
                                    <td class="text-center"><span class="badge btn-sm btn-success"></span></td>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label" for="tgl">Catatan - Kesimpulan</label>
                                <div class="input-group">
                                    <textarea type="text" class="form-control form-control-sm" aria-label="Tanggal mulai pelaksanaan pemeriksaan" id="tgl_status"  rows="3" readonly>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel onfarm -->
        <!-- panel online-->
        <div class="col-md-12">
            <div class="panel" id="panel-1">
                <div class="panel-hdr bg-primary-50">
                    <h2>
                        ONLINE <span class="fw-300 ml-1"><i>Verification</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        
                        <div class="table">
                            <table class="table table-sm table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="color: maroon">No. dokumen</th>    
                                        <th class="text-center">{{ $pengajuan->no_doc }}</th>    
                                        <th class="text-center" style="color: maroon">Nomor RIPH</th>    
                                        <th class="text-center">{{ $pengajuan->detail }}</th>    
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="3">Tanggal</th>
                                        <th class="text-center align-middle" rowspan="2">Status Verifikasi</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center " >Pengajuan</th>
                                        <th class="text-center">Verifikasi</th>
                                        <th class="text-center">Penetapan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td class="text-center">{{ date('d/m/Y', strtotime($pengajuan->created_at)) }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">
                                        @switch($pengajuan->status)
                                        @case(1)
                                            <span class="badge btn-sm btn-warning">
                                                    Menunggu Review Verifikasi 
                                            </span>
                                            @break
                                        @case(2)
                                            <span class="badge btn-sm btn-info">
                                                Sudah Diverifikasi
                                            </span>
                                            @break
                                        @case(3)
                                            <span class="badge btn-sm btn-primary">
                                                Pengajuan SKL
                                            </span>
                                            @break
                                        @case(4)
                                            <span class="badge btn-sm btn-info">
                                                Review SKL
                                            </span>
                                            
                                            @break
                                        @case(5)
                                            <span class="badge btn-sm btn-success">
                                                SKL Sudah Terbit
                                            </span>
                                            @break
                                        @default
                                            <span class="badge btn-sm btn-danger">
                                                Belum diajukan Verifikasi Oleh Importir
                                            </span>
                                    @endswitch 
                                    
                                    </td>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label" for="tgl">Catatan - Kesimpulan</label>
                                <div class="input-group">
                                    <textarea type="text" class="form-control form-control-sm" aria-label="Tanggal mulai pelaksanaan pemeriksaan" id="tgl_status"  rows="3" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel online-->
        <!-- panel SKL. Visible saat jenis Ket. LUNAS -->
        <div class="col-md-12">
            <div class="panel" id="panel-1">
                <div class="panel-hdr bg-success-50">
                    <h2>
                        Keterangan Lunas</span>
                    </h2>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table">
                            <table class="table table-sm table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="3">Tanggal</th>
                                        <th class="text-center" rowspan="2">Status Pengajuan</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Pengajuan</th>
                                        <th class="text-center">Verifikasi</th>
                                        <th class="text-center">Penetapan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center"><span class="badge btn-sm btn-success"></span></td>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label" for="tgl">Catatan - Kesimpulan</label>
                                <div class="input-group">
                                    <textarea type="text" class="form-control form-control-sm" aria-label="Tanggal mulai pelaksanaan pemeriksaan" id="tgl_status"  rows="3" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel online-->
    </div>
  </div>

@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
@parent


@endsection