@extends('layouts.admin')
@section('styles')
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
		<div class="panel" id="basic">
			<div class="panel-container card-header show">
				<div class="panel-content">
					<div class="row d-flex justify-content-between">
						<div class="form-group col-md-4">
							<label class="form-label" for="no_ijin">Nomor RIPH</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fal fa-file-invoice"></i>
									</span>
								</div>
								<input type="text" class="form-control form-control-sm bg-white" id="no_ijin" value="{{$commitment->no_ijin}}" disabled>
							</div>
							<span class="help-block">Nomor Ijin RIPH.</span>
						</div>
						<div class="form-group col-md-4">
							<label class="form-label" for="no_hs">Pengajuan Verifikasi</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fal fa-file-invoice"></i>
									</span>
								</div>
								<input type="text" class="form-control form-control-sm bg-white" id="no_pengajuan" value="{{$pengajuan->no_pengajuan}}" disabled>
							</div>
							<span class="help-block">Dari nomor Pengajuan Verifikasi terakhir.</span>
						</div>
						<div class="form-group col-md-2">
							<label class="form-label" for="tgl_ijin">Tanggal Ijin</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fal fa-calendar-day"></i>
									</span>
								</div>
								<input type="text" class="form-control form-control-sm bg-white" id="tgl_ijin"
									value="{{$commitment->tgl_ijin}}" disabled>
							</div>
							<span class="help-block">Tanggal RIPH diterbitkan</span>
						</div>
						<div class="form-group col-md-2">
							<label class="form-label" for="tgl_end">Tanggal Berakhir</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fal fa-calendar-day"></i>
									</span>
								</div>
								<input type="text" class="form-control form-control-sm bg-white" id="tgl_end"
									value="{{$commitment->tgl_end}}" disabled>
							</div>
							<span class="help-block">Tanggal berakhir RIPH.</span>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-striped table-bordered w-100" id="mainCheck">
						<thead>
							<th>Pemeriksaan</th>
							<th>Kewajiban</th>
							<th>Realisasi dilaporkan</th>
							<th>Realisasi diverifikasi</th>
							<th>Status</th>
						</thead>
						<tbody>
							<tr>
								<td class="text-muted">
									<span class="fw-700 h6">Verifikasi Data</span><br>
									<span class="help-block">Hasil pemeriksaan data yang dilaporkan oleh Pelaku Usaha</span>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td class="text-muted">
									@if ($pengajuan->onlinestatus === '1')
										<i class="fas fa-check text-success mr-1"></i>
										<i>Memenuhi Syarat</i>
									@else
										<i class="fas fa-times text-danger mr-1"></i>
										<i>Tidak Memenuhi Syarat</i>
									@endif
								</td>
							</tr>
							<tr>
								<td class="text-muted">
									<span class="fw-700 h6">Verifikasi Lapangan</span><br>
									<span class="help-block">Hasil pemeriksaan/verifikasi lapangan oleh Tim Verifikator</span>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td class="text-muted">
									@if ($pengajuan->onfarmstatus === '1')
										<i class="fas fa-check text-success mr-1"></i>
										<i>Memenuhi Syarat</i>
									@else
										<i class="fas fa-times text-danger mr-1"></i>
										<i>Tidak Memenuhi Syarat</i>
									@endif
								</td>
							</tr>
							<tr>
								<td class="text-muted">
									<span class="fw-700 h6">Luas Tanam</span><br>
									<span class="help-block">Komitmen wajib tanam yang telah dipenuhi hingga saat ini</span>
								</td>
								<td>{{ number_format($commitment->volume_riph * 5 / 100, 2) }} ha</td>
								<td>{{ number_format($total_luastanam, 2) }} ha</td>
								<td>{{ number_format($pengajuan->luas_verif, 2) }} ha</td>
								<td>
									<span class="d-block text-muted">
										<i class="{{ ($pengajuan->luas_verif >= ($commitment->volume_riph * 5 / 100)) ? 'fas fa-check text-success' : 'fas fa-times text-danger' }}">
										</i>
										<i>{{ ($pengajuan->luas_verif >= ($commitment->volume_riph * 5 / 100)) ? 'Terpenuhi' : 'Tidak terpenuhi' }}</i>
									</span>
								</td>
							</tr>
							<tr>
								<td class="text-muted">
									<span class="fw-700 h6">Volume Produksi</span><br>
									<span class="help-block">Komitmen Produksi yang telah dipenuhi hingga saat ini</span>
								</td>
								<td>{{ number_format($commitment->volume_riph * 5 / 100*6, 2) }} ton</td>
								<td>{{ number_format($total_volume, 2) }} ton</td>
								<td>{{ number_format($pengajuan->volume_verif, 2) }} ton</td>
								<td>
									<span class="d-block text-muted">
										<i class="{{ ($pengajuan->volume_verif >= ($commitment->volume_riph * 0.05*6)) ? 'fas fa-check text-success' : 'fas fa-times text-danger' }}"></i>
										<i>{{ ($pengajuan->volume_verif >= ($commitment->volume_riph * 0.05 *6)) ? 'Terpenuhi' : 'Tidak terpenuhi' }}
										</i>
									</span>
								</td>
							</tr>
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