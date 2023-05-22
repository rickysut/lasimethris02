@extends('layouts.admin')
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')

	@can('commitment_access')
		@include('partials.sysalert')
		<div class="row d-flex justify-content-between">
			<div class="col-md-4">
					<div class="panel">
						<div class="panel-hdr">
							<h2>Data</h2>
						</div>
						<div class="panel-container">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<label class="col-form-label">Nomor RIPH</label>
									<span>{{$verifikasi->commitmentbackdate->no_ijin}}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<label class="col-form-label">No. Pengajuan</label>
									<span>{{$verifikasi->no_pengajuan}}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<label class="col-form-label">Tanggal Pengajuan</label>
									<span>{{$verifikasi->created_at}}</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="panel">
						<div class="panel-hdr">
							<h2></h2>
						</div>
						<div class="form-group">
							<label class="form-label" for="tgl_ijin">Status</label>
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<label class="col-form-label">Verifikasi Data</label>
									@if ($verifikasi->onlinestatus === '1')
										<span class="badge btn-xs btn-success">Selesai</span>
									@elseif($verifikasi->onlinestatus === '2')
										<span class="badge btn-xs btn-danger">Perbaikan</span>
									@endif
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<label class="col-form-label">Verifikasi Lapangan</label>
									@if ($verifikasi->onfarmstatus === '1')
										<span class="badge btn-xs btn-success">Selesai</span>
									@elseif($verifikasi->onfarmstatus === '2')
										<span class="badge btn-xs btn-danger">Perbaikan</span>
									@endif
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<label class="col-form-label">Status terakhir</label>
									@if ($verifikasi->status === '1')
										<span class="badge btn-xs btn-primary">Pengajuan</span>
									@elseif($verifikasi->status === '2')
										<span class="badge btn-xs btn-primary">Verifikasi Data</span>
									@elseif($verifikasi->status === '3')
										<span class="badge btn-xs btn-danger">Ditolak</span>
									@elseif($verifikasi->status === '4')
										<span class="badge btn-xs btn-primary">Verifikasi Lapangan</span>
									@elseif($verifikasi->status === '5')
										<span class="badge btn-xs btn-danger">Ditolak</span>
									@elseif($verifikasi->status === '6')
										<span class="badge btn-xs btn-primary">SKL Terbit</span>
									@endif
								</li>
							</ul>
						</div>
					</div>
					<div class="panel">
						<div class="form-group">
							<label class="form-label" for="tgl_ijin">Catatan</label>
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<label class="col-form-label">Verifikasi Tanam</label>
									<span>{{$verifikasi->luas_verif}} ha</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<label class="col-form-label">Verifikasi Produksi</label>
									<span>{{$verifikasi->volume_verif}} ton</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<div class="me-auto">
										<div>Catatan</div>
										<span>{{$verifikasi->note}}</span>
									</div>
								</li>
							</ul>
						</div>
					</div>
			</div>
			<div class="col-md-8">
				<div class="panel" id="lampiran">
					<div class="panel-hdr">
						<h2>Pemeriksaan Berkas</h2>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<table class="table table-striped table-bordered table-hover w-100" id="tblLampiran">
								<thead>
									<th>Data</th>
									<th>Detail</th>
									<th>Status</th>
								</thead>
								<tbody>
									<tr>
										<td>Wajib Tanam</td>
										<td class="text-right">{{$verifikasi->luas_verif}} ha</td>
										<td>
											@if ($verifikasi->luas_verif >= $verifikasi->commitmentbackdate->volume_riph*0.05)
												<span class="badge btn-xs btn-icon btn-success" title="Terpenuhi">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Terpenuhi</span>
											@else
												<span class="badge btn-xs btn-icon btn-success" title="Tidak terpenuhi">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Tidak terpenuhi</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Wajib Produksi</td>
										<td class="text-right">{{$verifikasi->volume_verif}} ton</td>
										<td>
											@if ($verifikasi->volume_verif >= $verifikasi->commitmentbackdate->volume_riph*0.05/6)
												<span class="badge btn-xs btn-icon btn-success" title="Terpenuhi">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Terpenuhi</span>
											@else
												<span class="badge btn-xs btn-icon btn-success" title="Tidak terpenuhi">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Tidak terpenuhi</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas RIPH</td>
										<td>{{$verifikasi->commitmentbackdate->formRiph}}</td>
										<td>
											@if ($commitment->formRiph === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formRiph === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas SPTJM</td>
										<td>{{$verifikasi->commitmentbackdate->formSptjm}}</td>
										<td>
											@if ($commitment->formSptjm === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formSptjm === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Logbook</td>
										<td>{{$verifikasi->commitmentbackdate->logbook}}</td>
										<td>
											@if ($commitment->logbook === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->logbook === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Rencana Tanam</td>
										<td>{{$verifikasi->commitmentbackdate->formRt}}</td>
										<td>
											@if ($commitment->formRt === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formRt === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Realisasi Tanam</td>
										<td>{{$verifikasi->commitmentbackdate->formRta}}</td>
										<td>
											@if ($commitment->formRta === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formRta === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Realisasi Produksi</td>
										<td>{{$verifikasi->commitmentbackdate->formRpo}}</td>
										<td>
											@if ($commitment->formRpo === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formRpo === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Laporan Akhir</td>
										<td>{{$verifikasi->commitmentbackdate->formLa}}</td>
										<td>
											@if ($commitment->formLa === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formLa === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="panel" id="pks">
					<div class="panel-hdr">
						<h2>Pemeriksaan PKS</h2>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<table class="table table-striped table-bordered table-hover w-100" id="tblPks">
								<thead>
									<th>Data</th>
									<th>Kelompok Tani</th>
									<th>Status</th>
								</thead>
								<tbody>
									@foreach ($pksmitras as $pksmitra)
									<tr>
										<td>{{$pksmitra->pksmitra->no_perjanjian}}</td>
										<td>{{$pksmitra->pksmitra->masterkelompok->nama_kelompok}}</td>
										<td>
											@if($pksmitra->status === '1')
												<span class="badge btn-xs btn-icon btn-success" title="Selesai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Selesai</span>
											@elseif($pksmitra->status === '2')
												<span class="badge btn-xs btn-icon btn-danger" title="Perbaikan">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Perbaikan Data</span>
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="panel" id="realisasi">
					<div class="panel-hdr">
						<h2>Pemeriksaan PKS</h2>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<table class="table table-striped table-bordered table-hover w-100" id="tblRealisasi">
								<thead>
									<th>Data</th>
									<th>Detail</th>
									<th>Status</th>
								</thead>
								<tbody>
									@foreach($onfarms as $onfarm)
									<tr>
										<td>{{$onfarm->anggotamitra->nama_lokasi}}</td>
										<td>
											{{$onfarm->luas_verif}} ha<br>
											{{$onfarm->volume_verif}} ton
										</td>
										<td>
											@if($onfarm->onfarmstatus)
												@if ($onfarm->onfarmstatus === 'Selesai')
													<span class="badge btn-xs btn-icon btn-success" title="Selesai dan sesuai">
														<i class="fa fa-check-circle"></i>
													</span>
													<span class="d-none d-print-block text-success fw-500">Selesai dan Sesuai</span>
												@elseif($onfarm->onfarmstatus === 'Perbaikan')
													<span class="badge btn-xs btn-icon btn-danger" title="Perbaikan">
														<i class="fa fa-exclamation-circle"></i>
													</span>
													<span class="d-none d-print-block text-danger fw-500">Tidak terpenuhi</span>
												@endif
											@else
												@if ($onfarm->onlinestatus === 'Selesai')
													<span class="badge btn-xs btn-icon btn-success" title="Selesai dan sesuai">
														<i class="fa fa-check-circle"></i>
													</span>
													<span class="d-none d-print-block text-success fw-500">Selesai dan Sesuai</span>
												@elseif($onfarm->onlinestatus === 'Perbaikan')
													<span class="badge btn-xs btn-icon btn-danger" title="Perbaikan">
														<i class="fa fa-exclamation-circle"></i>
													</span>
													<span class="d-none d-print-block text-danger fw-500">Tidak terpenuhi</span>
												@endif
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
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
			$('#tblLampiran').dataTable({
			responsive: true,
			lengthChange: true,
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

			$('#tblPks').dataTable({
			responsive: true,
			lengthChange: true,
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
			$('#tblRealisasi').dataTable({
			responsive: true,
			lengthChange: true,
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
@endsection