@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
@can('poktan_access')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Daftar Pejabat Penandatangan
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="datatable" class="table table-bordered table-hover table-striped table-sm w-100">
						<thead>
							<th>No. SKL</th>
							<th>No. RIPH</th>
							<th>Periode</th>
							<th>Berkas SKL</th>
							<th>Berkas Dukung</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($skls as $skl)
							<tr>
								<td>{{$skl->no_skl}}</td>
								<td>{{$skl->no_ijin}}</td>
								<td>{{$skl->periode}}</td>
								<td>
									<a href="{{ asset('storage/arsip/backdateskl/'.$skl->berkas_skl) }}" target="_blank">
										Lihat Berkas SKL
									</a>
								</td>
								<td>
									<a href="{{ asset('storage/arsip/backdateskl/'.$skl->berkas_dukung) }}" target="_blank">
										Lihat Berkas Data Dukung
									</a>
								</td>
								<td>
									<a href="{{route('admin.backdateskl.edit', $skl->id)}}" class="btn btn-icon btn-xs btn-outline-default rounded-circle">
										<i class="fa fa-edit text-primary"></i>
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
	$(document).ready(function()
	{

		// initialize datatable
		$('#datatable').dataTable(
		{
			responsive: true,
			lengthChange: false,
			order: [[0, 'desc']],
			rowGroup: {
                dataSrc: 2
            },
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
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
				},
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: 'Tambah Pejabat Penandatangan',
					className: 'btn btn-info btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.backdateskl.create') }}';
					}
				}
			]
		});

	});
</script>

@endsection