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

@can('poktan_access')
<div class="row">
	<div class="col-12">
		<div class="text-center">
			<i class="fal fa-badge-check fa-3x subheader-icon"></i>
			<h2>Pemeriksaan Data</h2>
			<div class="row justify-content-center">
				<!--
				Yang ingin dicapi pada fitur ini adalah:
				menampilkan animasi sistem sedang memeriksa data (check & load query).
			-->
				<p class="lead">Berikut adalah data-data yang telah Anda laporkan dan lampirkan.</p>
				<div class="col-md-8 order-md-2">
					<h3>HASIL PEMERIKSAAN AWAL</h3>
				</div>
			</div>
		</div>
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2>UMUM</h2>
				<div class="panel-toolbar">
					<span class="help-block">Data Umum Komitmen dan Realisasi Wajib Tanam-Produksi.</span>
				</div>
			</div>
			<div class="panel-container show">
				<table id="mainCheck" class="table table-bordered w-100">
					<thead class="card-header">
						<th class="text-uppercase text-muted py-2 px-3">Pemeriksaan</th>
						<th class="text-uppercase text-muted py-2 px-3">Data</th>
						<th class="text-uppercase text-muted py-2 px-3">Status</th>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class='icon-stack display-4 mr-3 flex-shrink-0'>
										<i class="base base-5 icon-stack-3x opacity-100 color-primary-400"></i>
										<i class="base base-5 icon-stack-2x opacity-100 color-primary-800"></i>
										<i class="fal fa-file-invoice icon-stack-1x opacity-100 color-white"></i>
									</div>
									<div class="d-inline-flex flex-column">
										<a class="fs-lg fw-500 d-block">
											Nomor RIPH
										</a>
										<div class="d-block text-muted fs-sm hidden-sm-down">
											Nomor Penerbitan Rekomendasi Impor Produk Hortikultura
										</div>
									</div>
								</div>
							</td>
							<td>
								<div>
									<div class="d-flex align-items-center">
										<div class="flex-1 min-width-0">
											<a href="javascript:void(0)" class="d-block text-truncate">
												{{$commitments->no_ijin}}
											</a>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="p-3 p-md-3">
									<span class="d-block text-muted"><i class="fas fa-check text-success"></i> <i>OK</i></span>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class='icon-stack display-4 mr-3 flex-shrink-0'>
										<i class="base base-5 icon-stack-3x opacity-100 color-success-400"></i>
										<i class="base base-5 icon-stack-2x opacity-100 color-success-800"></i>
										<i class="fal fa-seedling icon-stack-1x opacity-100 color-white"></i>
									</div>
									<div class="d-inline-flex flex-column">
										<a class="fs-lg fw-500 d-block">
											Wajib Tanam (ha)
										</a>
										<div class="d-block text-muted fs-sm hidden-sm-down">
											Komitmen wajib tanam yang telah dipenuhi hingga saat ini
										</div>
									</div>
								</div>
							</td>
							<td>
								<div>
									<div class="d-flex align-items-center">
										<div class="flex-1 min-width-0">
											<span class="d-block text-truncate">
												Kewajiban
											</span>
										</div>
										<div class="flex-1 min-width-0 text-right">
											<span class="d-block fw-700 text-primary" id="kewajibanTanam">
												{{ number_format($commitments->volume_riph * 5 / 100, 2) }} ha
											</span>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div class="flex-1 min-width-0">
											<span class="d-block text-truncate text-info">
												Realisasi
											</span>
										</div>
										<div class="flex-1 min-width-0 text-right">
											<span class="d-block fw-700 text-info" id="realisasiTanam">
												{{ number_format($total_luastanam, 2) }} ha
											</span>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="p-3 p-md-3">
									<span class="d-block text-muted">
										{{-- jika nilai sama dengan atau lebih besar = Terpenuhi Check
										jika nilai kurang = Tidak Terpenuhi times circle --}}
										<i class="{{ ($total_luastanam >= ($commitments->volume_riph * 5 / 100)) ? 'fas fa-check text-success' : 'fas fa-times text-danger' }}">
										</i>
										<i>{{ ($total_luastanam >= ($commitments->volume_riph * 5 / 100)) ? 'Terpenuhi' : 'Tidak terpenuhi' }}</i>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class='icon-stack display-4 mr-3 flex-shrink-0'>
										<i class="base base-5 icon-stack-3x opacity-100 color-warning-400"></i>
										<i class="base base-5 icon-stack-2x opacity-100 color-warning-800"></i>
										<i class="fal fa-dolly icon-stack-1x opacity-100 color-white"></i>
									</div>
									<div class="d-inline-flex flex-column">
										<span class="fs-lg fw-500 d-block">
											Wajib Produksi (ton)
										</span>
										<div class="d-block text-muted fs-sm hidden-sm-down">
											Komitmen wajib produksi yang telah dipenuhi hingga saat ini
										</div>
									</div>
								</div>
							</td>
							<td>
								<div>
									<div class="d-flex align-items-center">
										<div class="flex-1 min-width-0">
											<span href="javascript:void(0)" class="d-block text-truncate">
												Kewajiban
											</span>
										</div>
										<div class="flex-1 min-width-0 text-right">
											<span href="javascript:void(0)" class="d-block text-truncate fw-700">
												{{ number_format($commitments->volume_riph * 5 / 100*6, 2) }} ton
											</span>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div class="flex-1 min-width-0">
											<span href="javascript:void(0)" class="d-block text-truncate">
												Realisasi
											</span>
										</div>
										<div class="flex-1 min-width-0 text-right">
											<span href="javascript:void(0)" class="d-block text-truncate fw-700">
												{{ number_format($total_volume, 2) }} ton
											</span>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="p-3 p-md-3">
									<span class="d-block text-muted">
										<i class="{{ ($total_luastanam >= ($commitments->volume_riph * 0.05*6)) ? 'fas fa-check text-success' : 'fas fa-times text-danger' }}"></i>
										<i>{{ ($total_volume >= ($commitments->volume_riph * 0.05 *6)) ? 'Terpenuhi' : 'Tidak terpenuhi' }}
										</i>
									</span>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="card-footer">
					<div class="help-block">
						Keterangan<br>
						<span><i class="fas fa-check text-success mr-1"></i> Status data tersedia atau memenuhi syarat</span><br>
						<span><i class="fas fa-times text-danger mr-1"></i> Status data tidak tersedia atau tidak memenuhi syarat</span>
					</div>
				</div>
			</div>
		</div>
		<div id="panel-2" class="panel">
			<div class="panel-hdr">
				<h2>Berkas-berkas lampiran</h2>
				<div class="panel-toolbar">
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-striped table-bordered w-100" id="attchCheck">
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
									<span class="text-primary">{{ $commitments->formRiph }}</span>
								</td>
								<td>
									@if(file_exists(storage_path('app/public/docs/commitmentsv2/' . $commitments->periodetahun . '/formRiph/' . $commitments->formRiph)))
										<a href="#" data-toggle="modal" data-target="#viewDocs"
											data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formRiph/' . $commitments->formRiph) }}">
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
									<span class="text-primary">{{ $commitments->formSptjm }}</span>
								</td>
								<td>
									@if(file_exists(storage_path('app/public/docs/commitmentsv2/' . $commitments->periodetahun . '/formSptjm/' . $commitments->formSptjm)))
										<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formSptjm/' . $commitments->formSptjm) }}">
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
									<span class="text-primary">{{ $commitments->logbook }}</span>
								</td>
								<td>
									@if(file_exists(storage_path('app/public/docs/commitmentsv2/' . $commitments->periodetahun . '/logbook/' . $commitments->logbook)))
										<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/logbook/' . $commitments->logbook) }}">
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
									<span class="text-primary">{{ $commitments->formRt }}</span>
								</td>
								<td>
									@if(file_exists(storage_path('app/public/docs/commitmentsv2/' . $commitments->periodetahun . '/formRt/' . $commitments->formRt)))
										<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formRt/' . $commitments->formRt) }}">
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
									<span class="text-primary">{{ $commitments->formRta }}</span>
								</td>
								<td>
									@if(file_exists(storage_path('app/public/docs/commitmentsv2/' . $commitments->periodetahun . '/formRta/' . $commitments->formRta)))
										<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formRta/' . $commitments->formRta) }}">
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
									<span class="text-primary">{{ $commitments->formRpo }}</span>
								</td>
								<td>
									@if(file_exists(storage_path('app/public/docs/commitmentsv2/' . $commitments->periodetahun . '/formRpo/' . $commitments->formRpo)))
										<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formRpo/' . $commitments->formRpo) }}">
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
									<span class="text-primary">{{ $commitments->formLa }}</span>
								</td>
								<td>
									@if(file_exists(storage_path('app/public/docs/commitmentsv2/' . $commitments->periodetahun . '/formLa/' . $commitments->formLa)))
										<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formLa/' . $commitments->formLa) }}">
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
			<div class="card-footer">
				<div class="help-block">
					Keterangan<br>
					<span><i class="fas fa-check text-success mr-1"></i> Status berkas dilampirkan.</span><br>
					<span><i class="fas fa-times text-danger mr-1"></i> Status berkas tidak dilampirkan</span><br>
					<span>klik tanda <i class="fas fa-times text-danger mr-1"></i>untuk melengkapi berkas yang diperlukan.</span><br>
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
					<table id="pksCheck" class="table table-bordered table-striped w-100">
						<thead class="card-header">
							<tr>
								<th class="text-uppercase text-muted">Perjanjian</th>
								<th class="text-uppercase text-muted">Kelompoktani</th>
								<th class="text-uppercase text-muted">Tanggal Mulai</th>
								<th class="text-uppercase text-muted">Tanggal Akhir</th>
								<th class="text-uppercase text-muted">Status Cek</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($commitments->pksmitra as $pksmitra)
							<tr>
								<td>{{$pksmitra->no_perjanjian}}</td>
								<td>{{$pksmitra->masterkelompok->nama_kelompok}}</td>
								<td>{{$pksmitra->tgl_perjanjian_start}}</td>
								<td>{{$pksmitra->tgl_perjanjian_end}}</td>
								<td>
									@if($pksmitra->berkas_pks)
										<a href="#" data-toggle="modal" data-target="#viewDocs"
											data-doc="{{ url('storage/docs/' . $commitments->periodetahun . '/commitment_'.$commitments->id.'/pks/'.$pksmitra->berkas_pks) }}">
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
								<th>Luas Tanam (ha)</th>
								<th>Produksi (ton)</th>
								<th>Data geolokasi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($commitments->pksmitra as $pksmitra)
								@foreach ($pksmitra->anggotamitras as $anggotamitra)
								<tr>
									<td hidden>{{$anggotamitra->pksmitra->masterkelompok->nama_kelompok}}</td>
									<td>{{$anggotamitra->nama_lokasi}}</td>
									<td>{{$anggotamitra->masteranggota->nama_petani}}</td>
									<td>{{$anggotamitra->luas_tanam}}</td>
									<td>{{$anggotamitra->volume}}</td>
									<td>Ada/Tidak ada</td>
								</tr>
								@endforeach
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div id="panel-5" class="panel">
			<div class="panel-container show">
				<div class="panel-content">
					<div class="row">
						<div class="form-group col-6">
							<label class="form-label h6">Surat Pengajuan Verifikasi (jika dipersyaratkan)</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" id="formUpload" @if ($disabled) disabled @endif required>
								<label class="custom-file-label" for="formUpload">pilih berkas...</label>
							</div>
							<span class="help-block">Surat Pengajuan verifikasi Data dan Lapangan. Berkas dengan ekstensi jpg/jpeg/pdf dengan ukuran tidak lebih dari 2 megabyte.</span>
						</div>
						<div class="form-group col-6">
							<label class="form-label h6">Konfirmasi</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="ketik username Anda di sini" id="validasi" name="validasi" @if ($disabled) disabled @endif required>
								<div class="input-group-append">
									<a class="btn btn-danger" href="" role="button"><i class="fal fa-times text-align-center mr-1"></i> Batalkan</a>
								</div>
								<form action="{{ route('admin.task.commitments.storepengajuan', $commitments->id) }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit" onclick="return validateInput()"
											@if ($disabled) disabled @endif>
											<i class="fas fa-upload text-align-center mr-1"></i> Ajukan
										</button>
									</div>
								</form>
							</div>
							<span class="help-block">Dengan ini kami mengajukakan verifikasi untuk lokasi-lokasi tersebut di atas.</span>
						</div>
					</div>
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
  
<script>
	$(document).ready(function() {

		$('#mainCheck').dataTable(
			{
			responsive: true,
			lengthChange: false,
			order:[],
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
			
		});

		$('#attchCheck').dataTable(
			{
			responsive: true,
			lengthChange: false,
			order:[],
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'>>",
			buttons: [
				/*{
					extend:    'colvis',
					text:      'Column Visibility',
					titleAttr: 'Col visibility',
					className: 'mr-sm-3'
				},*/
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-sm btn-icon mr-1'
				},
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Generate Excel',
					className: 'btn-outline-success btn-sm btn-icon mr-1'
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fal fa-file-csv"></i>',
					titleAttr: 'Generate CSV',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'copyHtml5',
					text: '<i class="fa fa-copy"></i>',
					titleAttr: 'Copy to clipboard',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print"></i>',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				}
			]
		});

		$('#pksCheck').dataTable(
			{
			responsive: true,
			lengthChange: false,
			order:[],
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				/*{
					extend:    'colvis',
					text:      'Column Visibility',
					titleAttr: 'Col visibility',
					className: 'mr-sm-3'
				},*/
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-sm btn-icon mr-1'
				},
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Generate Excel',
					className: 'btn-outline-success btn-sm btn-icon mr-1'
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fal fa-file-csv"></i>',
					titleAttr: 'Generate CSV',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'copyHtml5',
					text: '<i class="fa fa-copy"></i>',
					titleAttr: 'Copy to clipboard',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print"></i>',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				}
			]
		});

		$('#dt-ajulokasi').dataTable({
			responsive: true,
			select: true,
			pageLength: 10,
			order: [
				[0, 'asc']
			],
			rowGroup: {
				dataSrc: 0
			},
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'fl><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				/*{
					extend:    'colvis',
					text:      'Column Visibility',
					titleAttr: 'Col visibility',
					className: 'mr-sm-3'
				},*/
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-sm btn-icon mr-1'
				},
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Generate Excel',
					className: 'btn-outline-success btn-sm btn-icon mr-1'
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fal fa-file-csv"></i>',
					titleAttr: 'Generate CSV',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'copyHtml5',
					text: '<i class="fa fa-copy"></i>',
					titleAttr: 'Copy to clipboard',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print"></i>',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				}
			]
		});
	});
</script>

<script>
	function validateInput() {
		// get the input value and the current username from the page
		var inputVal = document.getElementById('validasi').value;
		var currentUsername = '{{ Auth::user()->username }}';
		
		// check if the input is not empty and matches the current username
		if (inputVal !== '' && inputVal === currentUsername) {
			return true; // allow form submission
		} else {
			alert('Input validasi harus diisi dan bernilai sama dengan username Anda.');
			return false; // prevent form submission
		}
	}
</script>

@endsection