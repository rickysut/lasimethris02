@extends('layouts.admin')
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')

	@can('commitment_access')
		@include('partials.sysalert')
		<div class="row">
			<div class="col-12">
				<div id="panel-1" class="panel">
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row d-flex justify-content-between">
								<div class="form-group col-md-4">
									<label class="form-label" for="no_pengajuan">Nomor Pengajuan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="no_pengajuan"
											value="{{$verifikasi->commitmentbackdate->no_ijin}}" disabled>
									</div>
									<span class="help-block">Nomor Pengajuan Verifikasi.</span>
								</div>
								<div class="form-group col-md-4">
									<label class="form-label" for="no_ijin">Nomor RIPH</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="no_ijin"
											value="{{$verifikasi->commitmentbackdate->no_ijin}}" disabled>
									</div>
									<span class="help-block">Nomor Pengajuan Verifikasi.</span>
								</div>
								<div class="form-group col-md-4">
									<label class="form-label" for="statusVerif">Tanggal Pengajuan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-calendar-day"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="created_at"
											value="{{$verifikasi->created_at}}" disabled>
									</div>
									<span class="help-block">Status Pemeriksaan</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-between align-items-center">
					<ul class=" nav nav-pills" role="tablist">
						<li class="nav-item">
							<a class="btn-sm nav-link active" data-toggle="pill" href="#queue">
								<i class="fas fa-clock mr-1"></i>
								Queue List
							</a>
						</li>
						<li class="nav-item">
							<a class="btn-sm nav-link" data-toggle="pill" href="#verified">
								<i class="fas fa-check mr-1"></i>
								Verified Sampling
							</a>
						</li>
					</ul>
					<a class="btn btn-sm btn-outline-info" href="{{route('admin.task.onfarmv2')}}">
						<i class="fas fa-undo mr-1"></i>
						ke Daftar Pengajuan
					</a>
				</div>
				<div class="tab-content py-3">
					<div class="tab-pane active" id="queue" role="tabpanel">
						<div class="panel" id="panel-2">
							<div class="panel-container show">
								<div class="panel-content">
									<table id="dataPengajuan" class="table table-sm table-bordered table-striped w-100">
										<thead>
											<tr>
												<th width="15%">Nama Lokasi</th>
												<th>No. Perjanjian</th>
												<th>Luas Dilaporkan</th>
												<th>Luas Verif</th>
												<th>Tanggal Diukur</th>
												<th>Vol. Dilaporkan</th>
												<th>Vol. Verif</th>
												<th>Tanggal Periksa</th>
												<th>Hasil Periksa</th>
												<th>Status Periksa</th>
												<th>Tanggal Selesai</th>
												<th>Tindakan</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($onfarms as $onfarm)
												<tr>
													<td>{{$onfarm->anggotamitra->nama_lokasi}}</td>
													<td>{{$onfarm->verifpks->pksmitra->no_perjanjian}}</td>
													<td class="text-right">{{$onfarm->anggotamitra->luas_tanam}} ha</td>
													<td class="{{ $onfarm->luas_verif ? 'text-right' : 'text-center' }}">
														@if ($onfarm->luas_verif)
															{{$onfarm->luas_verif}} ha
														@endif
													</td>
													<td>{{$onfarm->tgl_ukur}}</td>
													<td class="text-right">{{$onfarm->anggotamitra->volume}} ton</td>
													<td class="{{ $onfarm->volume_verif ? 'text-right' : 'text-center' }}">
														@if ($onfarm->volume_verif)
															{{$onfarm->volume_verif}} ton
														@endif
													</td>
													<td>{{$onfarm->tgl_timbang}}</td>
													<td class="text-center">
														@if ($onfarm->onfarmverif ==='Sesuai')
															<span class="badge btn-xs btn-icon btn-success" data-toggle="tooltip" title data-original-title="data dan hasil pengukuran Sesuai">
																<i class="fal fa-check-circle"></i>
															</span>
														@elseif ($onfarm->onfarmverif ==='Tidak Sesuai')
															<span class="badge btn-xs btn-icon btn-danger" data-toggle="tooltip" title data-original-title="data dan hasil pengukuran tidak sesuai">
																<i class="fal fa-exclamation-circle"></i>
															</span>
														@endif
													</td>
													<td class="text-center">
														@if ($onfarm->onfarmstatus ==='Selesai')
															<span class="badge btn-xs btn-icon btn-success" data-toggle="tooltip" title data-original-title="Pemeriksaan telah selesai">
																<i class="fal fa-check-circle"></i>
															</span>
														@else
															<span class="badge btn-xs btn-icon btn-danger" data-toggle="tooltip" title data-original-title="Belum diperiksa/diukur/diinput/selesai">
																<i class="fal fa-exclamation-circle"></i>
															</span>
														@endif
													</td>
													<td class="text-center">{{$onfarm->onfarmverif_at}}</td>
													<td>
														<a href="{{route('admin.task.onfarmv2.check', $onfarm->anggotamitra->id)}}"
															title data-toggle="tooltip" data-original-title="Input Data Pemeriksaan"
															class="badge btn-xs btn-icon btn-primary">
															<i class="fal fa-map-marker-edit"></i>
														</a>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="verified" role="tabpanel">
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
		// initialize datatable dataPengajuan
			$('#dataPengajuan').dataTable({
				responsive: true,
			lengthChange: false,
			dom:
				"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'<'select'>>>" + // Move the select element to the left of the datatable buttons
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
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
					}]
				});
	
			// Get the unique values of the "Year" column
			var table = $('#dataPengajuan').DataTable(); // add this line to define the 'table' variable
			var years = table.column(3).data().unique().sort();

			// Create the select element and add the options
			var select1 = $('<select>')
				.attr('id', 'selectDataPengajuan') // add unique ID
				.addClass('custom-select custom-select-sm col-3 mr-2')
				.on('change', function() {
					var year = $.fn.dataTable.util.escapeRegex($(this).val());
					table.column(3).search(year ? '^' + year + '-' : '', true, false).draw();
				});

			$('<option>').val('').text('Semua Tahun').appendTo(select1);
			$.each(years, function(i, year) {
				$('<option>').val(year.substring(0,4)).text(year.substring(0,4)).appendTo(select1);
			});

			// Add the select element before the first datatable button in the first table
			$('#dataPengajuan_wrapper .dt-buttons').before(select1);

		//initialize datatable tblVerified
			$('#tblVerified').dataTable({
				responsive: true,
			lengthChange: false,
			dom:
				"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'<'select'>>>" + // Move the select element to the left of the datatable buttons
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
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
					}]
				});
	
			// Get the unique values of the "Year" column
			var table = $('#tblVerified').DataTable(); // add this line to define the 'table' variable
			var years = table.column(3).data().unique().sort();

			// Create the select element and add the options
			var select2 = $('<select>')
				.attr('id', 'selectTblVerified') // add unique ID
				.addClass('custom-select custom-select-sm col-3 mr-2')
				.on('change', function() {
					var year = $.fn.dataTable.util.escapeRegex($(this).val());
					table.column(3).search(year ? '^' + year + '-' : '', true, false).draw();
				});

			$('<option>').val('').text('Semua Tahun').appendTo(select2);
			$.each(years, function(i, year) {
				$('<option>').val(year.substring(0,4)).text(year.substring(0,4)).appendTo(select2);
			});

			// Add the select element before the first datatable button in the second table
			$('#tblVerified_wrapper .dt-buttons').before(select2);
		});
	</script>
@endsection
