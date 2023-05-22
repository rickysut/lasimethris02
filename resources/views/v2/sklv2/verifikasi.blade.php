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
				<p class="lead">Berikut adalah data-data hasil verifikasi administratif dan lapangan.</p>
				<div class="col-md-8 order-md-2">
					<h3>HASIL PEMERIKSAAN</h3>
				</div>
			</div>
		</div>
		<div class="panel" id="basic">
			<div class="panel-container card-header show">
				<div class="panel-content">
					<div class="row d-flex justify-content-center">
						<div class="col-md-6 w-100">
							<ul class="list-group">
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<span class="text-muted">Nomor RIPH</span>
									<span>{{$commitment->no_ijin}}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<span class="text-muted">Tanggal Ijin</span>
									<span>{{$commitment->tgl_ijin}}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<span class="text-muted">Tanggal Berakhir</span>
									<span>{{$commitment->tgl_end}}</span>
								</li>
							</ul>
						</div>
						<div class="col-md-6 w-100">
							<ul class="list-group">
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<span class="text-muted">Nomor Pengajuan</span>
									<span>{{$pengajuan->no_pengajuan}}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<span class="text-muted">BA Verifikasi Data</span>
									<a href="">{{$pengajuan->onlineattch}}</a>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									<span class="text-muted">BA Verifikasi Lapangan</span>
									<a href="">{{$pengajuan->onfarmattch}}</a>
								</li>
							</ul>
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
									<span>
										<span class="fw-700 h6 mr-1">Verifikasi Data</span>
										@if ($pengajuan->onlinestatus === '1')
											<span class="badge badge-xs badge-success small">Selesai</span>
										@else
											<span class="badge badge-xs badge-danger small">Perbaikan</span>
										@endif
									</span><br>
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
									<span>
										<span class="fw-700 h6 mr-1">Verifikasi Data</span>
										@if ($pengajuan->onfarmstatus === '1')
											<span class="badge badge-xs badge-success small">Selesai</span>
										@else
											<span class="badge badge-xs badge-danger small">Perbaikan</span>
										@endif
									</span><br>
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
							<th>Tindakan</th>
							<th>Status</th>
						</thead>
						<tbody>
							<tr>
								<td>Berkas RIPH</td>
								<td>{{$pengajuan->commitmentbackdate->formRiph}}</td>
								<td>lihat</td>
								<td>
									@if ($verifcommit->formRiph === 'Sesuai')
										<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
											<i class="fa fa-check-circle"></i>
										</span>
										<span class="d-none d-print-block text-success fw-500">Sesuai</span>
									@elseif ($verifcommit->formRiph === 'Tidak Sesuai')
										<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
											<i class="fa fa-exclamation-circle"></i>
										</span>
										<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Berkas SPTJM</td>
								<td>{{$pengajuan->commitmentbackdate->formSptjm}}</td>
								<td>lihat</td>
								<td>
									@if ($verifcommit->formSptjm === 'Sesuai')
										<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
											<i class="fa fa-check-circle"></i>
										</span>
										<span class="d-none d-print-block text-success fw-500">Sesuai</span>
									@elseif ($verifcommit->formSptjm === 'Tidak Sesuai')
										<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
											<i class="fa fa-exclamation-circle"></i>
										</span>
										<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Berkas Logbook</td>
								<td>{{$pengajuan->commitmentbackdate->logbook}}</td>
								<td>lihat</td>
								<td>
									@if ($verifcommit->logbook === 'Sesuai')
										<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
											<i class="fa fa-check-circle"></i>
										</span>
										<span class="d-none d-print-block text-success fw-500">Sesuai</span>
									@elseif ($verifcommit->logbook === 'Tidak Sesuai')
										<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
											<i class="fa fa-exclamation-circle"></i>
										</span>
										<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Berkas Rencana Tanam</td>
								<td>{{$pengajuan->commitmentbackdate->formRt}}</td>
								<td></td>
								<td>
									@if ($verifcommit->formRt === 'Sesuai')
										<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
											<i class="fa fa-check-circle"></i>
										</span>
										<span class="d-none d-print-block text-success fw-500">Sesuai</span>
									@elseif ($verifcommit->formRt === 'Tidak Sesuai')
										<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
											<i class="fa fa-exclamation-circle"></i>
										</span>
										<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Berkas Realisasi Tanam</td>
								<td>{{$pengajuan->commitmentbackdate->formRta}}</td>
								<td></td>
								<td>
									@if ($verifcommit->formRta === 'Sesuai')
										<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
											<i class="fa fa-check-circle"></i>
										</span>
										<span class="d-none d-print-block text-success fw-500">Sesuai</span>
									@elseif ($verifcommit->formRta === 'Tidak Sesuai')
										<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
											<i class="fa fa-exclamation-circle"></i>
										</span>
										<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Berkas Realisasi Produksi</td>
								<td>{{$pengajuan->commitmentbackdate->formRpo}}</td>
								<td>lihat</td>
								<td>
									@if ($verifcommit->formRpo === 'Sesuai')
										<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
											<i class="fa fa-check-circle"></i>
										</span>
										<span class="d-none d-print-block text-success fw-500">Sesuai</span>
									@elseif ($verifcommit->formRpo === 'Tidak Sesuai')
										<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
											<i class="fa fa-exclamation-circle"></i>
										</span>
										<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
									@endif
								</td>
							</tr>
							<tr>
								<td>Berkas Laporan Akhir</td>
								<td>{{$pengajuan->commitmentbackdate->formLa}}</td>
								<td>lihat</td>
								<td>
									@if ($verifcommit->formLa === 'Sesuai')
										<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
											<i class="fa fa-check-circle"></i>
										</span>
										<span class="d-none d-print-block text-success fw-500">Sesuai</span>
									@elseif ($verifcommit->formLa === 'Tidak Sesuai')
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
				<h2>Data Verifikasi PKS</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-striped table-bordered table-hover w-100" id="tblPks">
						<thead>
							<th>Data</th>
							<th>Kelompok Tani</th>
							<th>Tanggal Periksa</th>
							<th>Detail</th>
							<th>Status</th>
						</thead>
						<tbody>
							@foreach ($verifpks as $verifpksmitra)
							<tr>
								<td>{{$verifpksmitra->pksmitra->no_perjanjian}}</td>
								<td>{{$verifpksmitra->pksmitra->masterkelompok->nama_kelompok}}</td>
								<td>{{$verifpksmitra->verif_at}}</td>
								<td>Lihat</td>
								<td>
									@if($verifpksmitra->status === '1')
										<span class="badge btn-xs btn-icon btn-success" title="Selesai">
											<i class="fa fa-check-circle"></i>
										</span>
										<span class="d-none d-print-block text-success fw-500">Selesai</span>
									@elseif($verifpksmitra->status === '2')
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
				<h2>Data Verifikasi Lokasi</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-striped table-bordered table-hover w-100" id="tblRealisasi">
						<thead>
							<th>pks</th>
							<th>Nama Lokasi</th>
							<th>Nama Pengelola</th>
							<th>Luas</th>
							<th>Volume</th>
							<th>Detail</th>
							<th>Status</th>
						</thead>
						<tbody>
							@foreach($veriflokasis as $veriflokasi)
							<tr>
								<td>{{$veriflokasi->anggotamitra->pksmitra->no_perjanjian}}</td>
								<td>{{$veriflokasi->anggotamitra->nama_lokasi}}</td>
								<td>{{$veriflokasi->anggotamitra->masteranggota->nama_petani}}</td>
								<td>{{$veriflokasi->luas_verif}} ha</td>
								<td>{{$veriflokasi->volume_verif}} ton</td>
								<td>lihat</td>
								<td>
									@if($veriflokasi->onfarmstatus)
										@if ($veriflokasi->onfarmstatus === 'Selesai')
											<span class="badge btn-xs btn-icon btn-success" title="Selesai dan sesuai">
												<i class="fa fa-check-circle"></i>
											</span>
											<span class="d-none d-print-block text-success fw-500">Selesai dan Sesuai</span>
										@elseif($veriflokasi->onfarmstatus === 'Perbaikan')
											<span class="badge btn-xs btn-icon btn-danger" title="Perbaikan">
												<i class="fa fa-exclamation-circle"></i>
											</span>
											<span class="d-none d-print-block text-danger fw-500">Tidak terpenuhi</span>
										@endif
									@else
										@if ($veriflokasi->onlinestatus === 'Selesai')
											<span class="badge btn-xs btn-icon btn-success" title="Selesai dan sesuai">
												<i class="fa fa-check-circle"></i>
											</span>
											<span class="d-none d-print-block text-success fw-500">Selesai dan Sesuai</span>
										@elseif($veriflokasi->onlinestatus === 'Perbaikan')
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

		<div class="panel" id="panel-5">
			<div class="panel-hdr">
				<h2>Penerbitan SKL</h2>
				<div class="panel-toolbar">
					<span class="help-block"></span>
				</div>
			</div>
			<form action="{{route('admin.task.sklv2.store', $pengajuan->id)}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="panel-container show">
					<div class="panel-content">
						<div class="row d-flex align-items-top">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="no_skl">Nomor SKL</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="text" name="no_skl" id="no_skl" class="form-control">
									</div>
									<span class="help-block">Nomor Surat Keterangan Lunas.</span>
								</div>
								<div class="form-group">
									<label class="form-label" for="published_date">Tanggal Penerbitan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="date" name="published_date" id="published_date" class="form-control">
									</div>
									<span class="help-block">Tanggal Surat Keterangan Lunas.</span>
								</div>
								<div class="form-group">
									<label class="form-label" for="nota_attch">Nota Dinas/SK</label>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="nota_attch" name="nota_attch">
											<label class="custom-file-label" for="nota_attch">Pilih berkas</label>
										</div>
									</div>
									<span class="help-block">Lampiran Nota Dinas atau Surat Perintah.</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="pejabat_id">Pejabat Penandatangan</label>
										<select name="pejabat_id" id="pejabat_id" class="form-control form-control-sm">
											<option value="" hidden>-pilih Pejabat</option>
											@foreach ($pejabats as $pejabat)
												<option value="{{$pejabat->id}}">{{$pejabat->id}}. {{$pejabat->nama}}</option>
											@endforeach
										</select>
									<span class="help-block">Pilih Pejabat Penandatangan SKL.</span>
								</div>
								<div class="form-group">
									<label class="form-label" for="pejabat_id">Catatan</label>
										<textarea class="form-control"	name="note" id="note" rows="7"></textarea>
									<span class="help-block">Beri catatan.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer d-flex justify-content-between">
					<div></div>
					<div class="">
						<div class="d-flex">
							<button class="btn btn-sm btn-warning mr-1">
								<i class="fal fa-undo mr-1"></i>Batalkan
							</button>
							<button class="btn btn-sm btn-danger" type="submit">
								<i class="fal fa-award mr-1"></i>Terbitkan
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endcan
@endsection

@section('scripts')
@parent

<script>
    $(document).ready(function() {
        $(function() {
            $("#pejabat_id").select2({
                placeholder: "Pilih Pejabat"
            });
        });
    });
</script>

<script>
	$(document).ready(function() {
		$('#mainCheck').dataTable(
			{
			responsive: true,
			lengthChange: false,
			ordering:false,
			dom:'',
			
		});

		$('#tblLampiran').dataTable({
			responsive: true,
			lengthChange: false,
			ordering: false,
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