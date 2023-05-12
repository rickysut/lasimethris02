@extends('layouts.admin')
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')

	@can('commitment_access')
		@include('partials.sysalert')
		<div class="row">
			<div class="col-12">
				<div class="panel" id="panel-1">
					<div class="panel-hdr">
						<h2>Daftar Pengajuan</h2>
						<div class="panel-toolbar">
							<span class="help-block">
								Daftar Pengajuan Permohonan Verifikasi Realisasi Komitmen untuk data RIPH sebelum 2023.
							</span>
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<table id="dataPengajuan" class="table table-sm table-bordered table-striped w-100">
								<thead>
									<tr>
										<th>No. Pengajuan</th>
										<th>No. RIPH</th>
										<th>Jenis Pengajuan</th>
										<th>Tanggal Pengajuan</th>
										<th>Tindakan</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($pengajuans as $pengajuan)
										<tr>
											<td>{{$pengajuan->no_pengajuan}}</td>
											<td>{{$pengajuan->commitmentbackdate->no_ijin}}</td>
											<td>Jenis Permohonan</td>
											<td>{{$pengajuan->created_at}}</td>
											<td class="text-center">
												<a href="" class="btn btn-icon btn-sm btn-primary"
													title="Mulai/Lanjutkan Pemeriksaan">
													<i class="fal fa-file-search"></i>
												</a>
												<a href="" class="btn btn-icon btn-sm btn-warning"
													title="Mulai/Lanjutkan Pemeriksaan">
													<i class="fal fa-map-marker-alt"></i>
												</a>
												<a href="" class="btn btn-icon btn-sm btn-info"
													title="Mulai/Lanjutkan Pemeriksaan">
													<i class="fal fa-file-certificate"></i>
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
		</div>
	@endcan
@endsection

@section('scripts')
	@parent
	<script>
		$(document).ready(function() {
		// initialize datatable
			$('#dataPengajuan').dataTable({
				responsive: true,
				pagingType: 'full_numbers',
				lengthChange: true,
				pageLength: 10,
				order: [
					[3, 'asc']
				],
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
