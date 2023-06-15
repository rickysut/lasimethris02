@extends('layouts.admin')
@section('styles')
<style>
	a {
		text-decoration: none !important;
	}
</style>
@endsection
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')


@can('pengajuan_show')

<div class="row">
	<div class="col-12">
		<div class="text-center">
            
			@if($pengajuan->status == '1')
				<i class="fal fa-upload fa-3x subheader-icon text-info"></i>
				<h2 class="text-muted">Sudah Diajukan</h2>
				<div class="row justify-content-center">
					<p class="lead">Anda telah mengajukan permohonan verifikasi.</p>
				</div>
			@elseif($pengajuan->status == '2')
				<i class="fal fa-seacrh fa-3x subheader-icon text-warning"></i>
				<h2 class="text-muted">Verifikasi Data</h2>
				<div class="row justify-content-center">
					<p class="lead">Data Anda telah diperiksa oleh Petugas/Verifikator.</p>
				</div>
			@elseif($pengajuan->status == '3')
				<i class="fal fa-times-circle fa-3x subheader-icon text-danger"></i>
				<h2 class="text-danger">PERBAIKI DATA</h2>
				<div class="row justify-content-center">
					<p class="lead">Pemeriksaan tidak dapat dilanjutkan. Perbaiki Data Anda dan lakukan pengajuan Ulang untuk dilakukan pemeriksaan ulang.</p>
				</div>
			@elseif($pengajuan->status == '4')
				<i class="fal fa-map-marked-alt fa-3x subheader-icon text-warning"></i>
				<h2 class="text-muted">Verifikasi Lapangan</h2>
				<div class="row justify-content-center">
					<p class="lead">Verifikasi Lapangan telah selesai dilakukan oleh Petugas/Verifikator. Surat Keterangan Lunas (SKL) segera diterbitkan</p>
				</div>
			@elseif($pengajuan->status == '5')
				<i class="fal fa-map-marker-times fa-3x subheader-icon text-danger"></i>
				<h2 class="text-danger">PERBAIKI DATA</h2>
				<div class="row justify-content-center">
					<p class="lead">Pemeriksaan Lapangan Telah selesai. Perbaiki data Anda dan lakukan pengajuan kembali untuk dilakukan pemeriksaan ulang</p>
				</div>
			@elseif($pengajuan->status == '6')
				<i class="fal fa-award fa-3x subheader-icon text-success"></i>
				<h2 class="text-success">SKL TERBIT</h2>
				<div class="row justify-content-center">
					<span>
						SELAMAT! SKL telah diterbitkan
					</span>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-6 mb-3">
							<table class="table table-bordered table-sm w-100">
								<thead>
									<th>No. Penerbitan</th>
									<th>Tanggal Terbit</th>
								</thead>
								<tbody>
									@if ($skl)
									<td>
											{{$skl->no_skl}}
									</td>
									<td>
											{{$skl->published_date}}
									</td>
									@endif
								</tbody>
							</table>
					</div>
				</div>
			@elseif($pengajuan->status === '7')
				<span class="badge btn-xs btn-success" title="SKL telah diterbitkan">SKL Terbit</span>
			@endif
		</div>
		<div class="panel" id="panel-1">
			<div class="panel-container card-header show">
				<div class="row d-flex justify-content-between">
					<div class="form-group col-md-4">
						<label class="form-label" for="no_ijin">Nomor Pengajuan</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fal fa-file-invoice"></i>
								</span>
							</div>
							<input type="text" class="form-control form-control-sm bg-white" id="no_pengajuan" value="{{$pengajuan->no_doc}}" disabled="">
						</div>
						<span class="help-block">Nomor Pengajuan.</span>
					</div>
					<div class="form-group col-md-4">
						<label class="form-label" for="no_hs">Nomor RIPH</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fal fa-file-invoice"></i>
								</span>
							</div>
							<input type="text" class="form-control form-control-sm bg-white" id="no_ijin" value="{{ $pull_riph->no_ijin }}" disabled="">
						</div>
						<span class="help-block">Nomor Ijin Rekomendasi Import Produk Hortikultura.</span>
					</div>
					<div class="form-group col-md-4">
						<label class="form-label" for="tgl_ijin">Tanggal Diajukan</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fal fa-calendar-day"></i>
								</span>
							</div>
							<input type="text" class="form-control form-control-sm bg-white" id="tgl_ijin" value="{{$pengajuan->created_at}}" disabled="">
						</div>
						<span class="help-block">Tanggal pengajuan verifikasi.</span>
					</div>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-striped table-bordered table-sm w-100" id="mainCheck">
						<thead>
							<th class="text-muted text-uppercase">Data</th>
							<th class="text-muted text-uppercase">Kewajiban</th>
							<th class="text-muted text-uppercase">Realisasi</th>
							<th class="text-muted text-uppercase">Status</th>
						</thead>
						<tbody>
							<tr>
								<td class="text-muted">
									<span class="fw-700 h6">Wajib Tanam</span><br>
									<span class="help-block">Komitmen wajib tanam yang telah dipenuhi hingga saat ini</span>
								</td>
								<td class="text-right">
									{{ number_format($pull_riph->volume_riph * 5 / 100, 2) }} ha
								</td>
								<td class="text-right">
									{{ number_format($total_luastanam, 2) }} ha
								</td>
								<td>
									@if ($total_luastanam >= $pull_riph->volume_riph * 5 / 100)
										<i class="fas fa-check text-success"></i>
										<i>Terpenuhi</i>
									@else
										<i class="fas fa-times text-danger"></i>
										<i>Tidak Terpenuhi</i>
									@endif
								</td>
							</tr>
							<tr>
								<td class="text-muted">
									<span class="fw-700 h6">Wajib produksi</span><br>
									<span class="help-block">Komitmen wajib tanam yang telah dipenuhi hingga saat ini</span>
								</td>
								<td class="text-right">
									{{ number_format($pull_riph->volume_riph * 5 / 100*6, 2) }} ha
								</td>
								<td class="text-right">
									{{ number_format($total_volume, 2) }} ha
								</td>
								<td>
									@if ($total_volume >= $pull_riph->volume_riph * 5 / 100*6)
										<i class="fas fa-check text-success"></i>
										<i>Terpenuhi</i>
									@else
										<i class="fas fa-times text-danger"></i>
										<i>Tidak Terpenuhi</i>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div id="panel-2" class="panel">
			<div class="panel-hdr">
				<h2>Berkas-berkas lampiran</h2>
				<div class="panel-toolbar">
					<span class="help-block">Daftar Lampiran Berkas Utama</span>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-striped table-bordered table-sm w-100" id="attchCheck">
						<thead class="card-header">
							<tr>
								<th class="text-uppercase text-muted">Form</th>
								<th class="text-uppercase text-muted">Nama Berkas</th>
								<th class="text-uppercase text-muted">Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Penerbitan RIPH</td>
								<td>
									<span class="text-primary">{{ basename($pull_riph->formRiph) }}</span>
								</td>
								<td>
									@if ($pull_riph->formRiph && Storage::disk('public')->exists($pull_riph->formRiph))
										<a href="#" data-toggle="modal" data-target="#viewDocs"
											data-doc="{{ Storage::disk('public')->url($pull_riph->formRiph) }}">
											<i class="fas fa-check text-success mr-1"></i>
											Lihat Dokumen
										</a>
									@else
										<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Form SPTJM</td>
								<td>
									<span class="text-primary">{{ basename($pull_riph->formSptjm) }}</span>
								</td>
								<td>
                                    @if ($pull_riph->formSptjm && Storage::disk('public')->exists($pull_riph->formSptjm)) 
										<a href="#" data-toggle="modal" data-target="#viewDocs" 
                                            data-doc="{{ Storage::disk('public')->url($pull_riph->formSptjm) }}">
											<i class="fas fa-check text-success mr-1"></i>
											Lihat Dokumen
										</a>
									@else

										<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Logbook</td>
								<td>
									<span class="text-primary">{{ basename($pull_riph->logbook) }}</span>
								</td>
								<td>
									@if ($pull_riph->logbook && Storage::disk('public')->exists($pull_riph->logbook))
										<a href="#" data-toggle="modal" data-target="#viewDocs" 
                                            data-doc="{{ Storage::disk('public')->url($pull_riph->logbook) }}">
											<i class="fas fa-check text-success mr-1"></i>
											Lihat Dokumen
										</a>
									@else
										<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Form RT</td>
								<td>
									<span class="text-primary">{{ basename($pull_riph->formRt) }}</span>
								</td>
								<td>
									@if ($pull_riph->formRt && Storage::disk('public')->exists($pull_riph->formRt))
										<a href="#" data-toggle="modal" data-target="#viewDocs" 
                                            data-doc="{{ Storage::disk('public')->url($pull_riph->formRt) }}">
											<i class="fas fa-check text-success mr-1"></i>
											Lihat Dokumen
										</a>
									@else
										<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Form RTA</td>
								<td>
									<span class="text-primary">{{ basename($pull_riph->formRta) }}</span>
								</td>
								<td>
									@if ($pull_riph->formRta && Storage::disk('public')->exists($pull_riph->formRta))
										<a href="#" data-toggle="modal" data-target="#viewDocs" 
                                            data-doc="{{ Storage::disk('public')->url($pull_riph->formRta) }}">
											<i class="fas fa-check text-success mr-1"></i>
											Lihat Dokumen
										</a>
									@else
										<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Form RPO</td>
								<td>
									<span class="text-primary">{{ basename($pull_riph->formRpo) }}</span>
								</td>
								<td>
									@if ($pull_riph->formRpo && Storage::disk('public')->exists($pull_riph->formRpo))
										<a href="#" data-toggle="modal" data-target="#viewDocs" 
                                            data-doc="{{ Storage::disk('public')->url($pull_riph->formRpo) }}">
											<i class="fas fa-check text-success mr-1"></i>
											Lihat Dokumen
										</a>
									@else
										<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Form LA</td>
								<td>
									<span class="text-primary">{{ basename($pull_riph->formLa) }}</span>
								</td>
								<td>
									@if ($pull_riph->formLa && Storage::disk('public')->exists($pull_riph->formLa))
										<a href="#" data-toggle="modal" data-target="#viewDocs" 
                                            data-doc="{{ Storage::disk('public')->url($pull_riph->formLa) }}">
											<i class="fas fa-check text-success mr-1"></i>
											Lihat Dokumen
										</a>
									@else
										<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div id="panel-3" class="panel">
			<div class="panel-hdr">
				<h2>Data Perjanjian Kerjasama</h2>
				<div class="panel-toolbar">
					<span class="help-block">Perjanjian Kerjasama Kemitraan antara Importir dengan Kelompoktani Mitra</span>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="pksCheck" class="table table-bordered table-striped table-sm w-100">
						<thead class="card-header">
							<tr>
								<th class="text-uppercase text-muted">Perjanjian</th>
								<th class="text-uppercase text-muted">Kelompoktani</th>
								<th class="text-uppercase text-muted">Tanggal Mulai</th>
								<th class="text-uppercase text-muted">Tanggal Akhir</th>
								<th class="text-uppercase text-muted">Dokumen</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pull_riph->pksmitra as $pksmitra)
							<tr>
								<td>{{$pksmitra->no_perjanjian}}</td>
								<td>{{$pksmitra->groupTani[0]->nama_kelompok}}</td>
								<td>{{$pksmitra->tgl_perjanjian_start}}</td>
								<td>{{$pksmitra->tgl_perjanjian_end}}</td>
								<td>
									@if ($pksmitra->berkas_pks && Storage::disk('public')->exists($pksmitra->berkas_pks))
										<a href="#" data-toggle="modal" data-target="#viewDocs" 
                                            data-doc="{{ Storage::disk('public')->url($pksmitra->berkas_pks) }}">
											<i class="fas fa-check text-success mr-1"></i>
											Lihat Dokumen
										</a>
									@else
										<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
									@endif
									
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div id="panel-4" class="panel">
			<div class="panel-hdr">
				<h2>Data Lokasi Tanam</h2>
				<div class="panel-toolbar">
					<span class="help-block">Lokasi Tanam dan Volume Produksi.</span>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="dt-ajulokasi" class="table table-sm table-bordered table-striped w-100">
						<thead>
							<tr>
								<th hidden>Kelompoktani</th>
								<th>Nama Lokasi</th>
								<th>Nama Anggota</th>
								<th>Nomor Induk Kependudukan</th>
								<th>Luas Tanam</th>
								<th>Produksi</th>
								<th>Geodata</th>
							</tr>
						</thead>
						<tbody>
							{{-- @foreach ($commitment->pksmitra as $pksmitra)
								@foreach ($pksmitra->anggotamitras as $anggotamitra)
								<tr>
									<td hidden>{{$anggotamitra->pksmitra->masterkelompok->nama_kelompok}}</td>
									<td>{{$anggotamitra->nama_lokasi}}</td>
									<td>{{$anggotamitra->masteranggota->nama_petani}}</td>
									<td>{{$anggotamitra->masteranggota->nik_petani}}</td>
									<td class="text-right">{{$anggotamitra->luas_tanam}} ha</td>
									<td class="text-right">{{$anggotamitra->volume}} ton</td>
									<td class="text-center">
										@if ($anggotamitra->latitude || $anggotamitra->longitude || $anggotamitra->polygon)
											<span class="badge badge-xs badge-success">Ada</span>
										@else
											<span class="badge badge-xs badge-danger">Tidak Ada</span>
										@endif
									</td>
								</tr>
								@endforeach
							@endforeach --}}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- modal view doc --}}
<div class="modal fade" id="viewDocs" tabindex="-1" role="dialog" aria-labelledby="document" aria-hidden="true">
	<div class="modal-dialog modal-dialog-right" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Berkas <span class="fw-300"><i>lampiran </i></span>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="" width="100%"  frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>


@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
@parent
<script>
    $(document).ready(function() {
        $('#viewDocs').on('shown.bs.modal', function (e) {
            var docUrl = $(e.relatedTarget).data('doc');
            $('iframe').attr('src', docUrl);
        });
    });
</script>
@endsection