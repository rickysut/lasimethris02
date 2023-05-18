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
				<h2>
					RIPH Bawang Putih Konsumsi
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="datatable" class="table table-bordered table-hover table-striped w-100">
						<thead>
							<th>No. RIPH</th>
							<th>Tahun</th>
							<th>Tgl. Terbit</th>
							<th>Tgl. Akhir</th>
							<th>Vol. Import</th>
							<th>Kewajiban</th>
							<th>Status</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($commitments as $commitment)
							<tr>
								<td>{{$commitment->no_ijin}}</td>
								<td>{{$commitment->periodetahun}}</td>
								<td>{{$commitment->tgl_ijin}}</td>
								<td>{{$commitment->tgl_end}}</td>
								<td>{{ number_format($commitment->volume_riph, 2, ',','.') }} ton</td>
								<td>
									<div class="row">
										<div class="col-2">
											<i class="fal fa-ruler-combined"></i>
										</div>
										<div class="col-9">
											{{ number_format($commitment->volume_riph * 0.05/6, 2, ',','.') }} ha
										</div>
									</div>
									<div class="row">
										<div class="col-2">
											<i class="fal fa-weight-hanging"></i>
										</div>
										<div class="col-9">
											{{ number_format($commitment->volume_riph * 0.05, 2, ',','.') }} ton
										</div>
									</div>
								</td>
								<td>
									@if (is_null($commitment->status))
										<small><span class="badge badge-danger">No Status</span></small>
									@else
									{{$commitment->status}}
									@endif
								</td>
								<td>
									<a href="{{ route('admin.task.commitments.show', $commitment->id) }}"
										class="btn btn-icon btn-xs btn-info"
										title="Laporan Realisasi Komitmen">
										<i class="fal fa-ballot-check"></i>
									</a>
									<a href="{{ route('admin.task.commitments.penangkar', $commitment->id) }}"
										class="btn btn-icon btn-xs btn-success"
										title="Data Penangkar Mitra">
										<i class="fal fa-seedling"></i>
									</a>
									@if (is_null($commitment->status))
										<a href="{{ route('admin.task.commitments.edit', $commitment->id) }}"
											class="btn btn-icon btn-xs btn-warning"
											title="Ubah Data Komitmen">
											<i class="fal fa-edit"></i>
										</a>
									@else
										<a href="{{ route('admin.task.commitments.read', $commitment->id) }}"
											class="btn btn-icon btn-xs btn-warning"
											title="Lihat Data Komitmen">
											<i class="fal fa-eye"></i>
										</a>
									@endif
									@if (is_null($commitment->status))
										<form action="{{ route('admin.task.commitments.destroy', $commitment->id) }}"
											method="POST" style="display: inline-block;">
											@csrf
											@method('DELETE')
											<button type="submit" class="ml-3 btn btn-icon btn-xs btn-danger" title="Hapus data komitment"
												onclick="return confirm('Are you sure you want to delete this item?');">
												<i class="fal fa-trash-alt"></i>
											</button>
										</form>
									@else
										<span class="btn btn-icon btn-xs btn-default disabled"
											title="Tidak dapat dihapus">
											<i class="fas fa-trash-alt"></i>
										</span>
									@endif
								</td>
							</tr>
								
							@endforeach
						</tbody>
					</table>
					{{-- Modal Create Commitment --}}
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
					},
					{
						text: '<i class="fa fa-plus"></i>',
						titleAttr: 'Add new Commitment',
						className: 'btn btn-info btn-sm btn-icon ml-2',
						action: function(e, dt, node, config) {
							window.location.href = '{{ route('admin.task.commitments.create') }}';
						}
					}
				]
		});

	});
</script>

@endsection
