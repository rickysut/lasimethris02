@extends('layouts.admin')
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')

	@can('commitment_access')
		@include('partials.sysalert')
		<div class="row">
			<div class="col-12">
				<ul class=" nav nav-pills" role="tablist">
					<li class="nav-item">
						<a class="btn-sm nav-link active" data-toggle="pill" href="#queue">
							<i class="fas fa-clock mr-1"></i>
							Verification Queue
						</a>
					</li>
					<li class="nav-item">
						<a class="btn-sm nav-link" data-toggle="pill" href="#verified">
							<i class="fas fa-check mr-1"></i>
							Verified
						</a>
					</li>
				</ul>
				<div class="tab-content py-3">
					<div class="tab-pane active" id="queue" role="tabpanel">
						<div class="panel" id="panel-1">
							<div class="panel-container show">
								<div class="panel-content">
									<table id="dataPengajuan" class="table table-sm table-bordered table-striped w-100">
										<thead>
											<tr>
												<th>No. Pengajuan</th>
												<th>No. RIPH</th>
												<th>Tanggal Pengajuan</th>
												<th>Tanggal Verifikasi Data</th>
												<th>Tindakan</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($verifikasis as $verifikasi)
												@if($verifikasi->onlinestatus ==='1')
												<tr>
													<td>{{$verifikasi->no_pengajuan}}</td>
													<td>{{$verifikasi->commitmentbackdate->no_ijin}}</td>
													<td>{{$verifikasi->created_at}}</td>
													<td>{{$verifikasi->onlinedate}}</td>
													<td class="text-center">
														<a href="{{route('admin.task.onfarmv2.list', $verifikasi->id)}}" class="btn btn-icon btn-sm btn-primary"
															title="Mulai/Lanjutkan Pemeriksaan">
															<i class="fal fa-file-search"></i>
														</a>
													</td>
												</tr>
												@endif
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
