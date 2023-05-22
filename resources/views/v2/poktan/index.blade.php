@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')

@can('poktan_access')
@include('partials.sysalert')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Kelompok Tani
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="datatable" class="table table-bordered table-hover table-striped w-100">
						<thead>
							<td hidden></td>
							<th>Nama Kelompok</th>
							<th>Pimpinan</th>
							<th>Kontak (HP)</th>
							<th>Anggota</th>
							<th>Kota</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($masterkelompok as $poktan)
							<tr>
								<td hidden>{{$poktan->updated_at}}</td>
								<td>{{$poktan->nama_kelompok}}</td>
								<td>{{$poktan->nama_pimpinan}}</td>
								<td>{{$poktan->hp_pimpinan}}</td>
								<td class="text-right">{{$poktan->masteranggota_count}} org</td>
								<td>{{$poktan->kabupaten->nama_kab}}</td>
								<td class="d-flex justify-content-end">
									<div class="col">
										<a href="{{ route('admin.task.masterpoktan.listanggota', [$poktan->id]) }}" class="btn btn-icon btn-xs btn-info"
											title="lihat daftar anggota">
											<i class="fal fa-users"></i>
										</a>
										<a href="{{ route('admin.task.masterpoktan.addanggota', [$poktan->id]) }}" class="btn btn-icon btn-xs btn-primary"
											title="tambah anggota">
											<i class="fal fa-user-plus"></i>
										</a>
										<a href="{{ route('admin.task.masterpoktan.edit', [$poktan->id]) }}" class="btn btn-icon btn-xs btn-warning"
											title="ubah data kelompok">
											<i class="fal fa-edit"></i>
										</a>
									</div>
									<div>
										<form action="{{ route('admin.task.masterpoktan.destroy', $poktan->id) }}" method="POST" style="display: inline-block;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-icon btn-xs btn-danger" title="hapus data kelompok"
											onclick="return confirm('Anda yakin ingin menghapus data ini?');">
												<i class="fal fa-trash-alt"></i>
											</button>
										</form>
									</div>
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
			pageLength:10,
			lengthChange: false,
			order:[0,'desc'],
			dom:
				/*	--- Layout Structure 
					--- Options
					l	-	length changing input control
					f	-	filtering input
					t	-	The table!
					i	-	Table information summary
					p	-	pagination control
					r	-	processing display element
					B	-	buttons
					R	-	ColReorder
					S	-	Select

					--- Markup
					< and >				- div element
					<"class" and >		- div with a class
					<"#id" and >		- div with an ID
					<"#id.class" and >	- div with an ID and a class

					--- Further reading
					https://datatables.net/reference/option/dom
					--------------------------------------
				 */
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
					text: '<i class="fa fa-plus mr-1"></i>Tambah Data',
					titleAttr: 'Tambah Data Kelompoktani',
					className: 'btn btn-info btn-xs ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.task.masterpoktan.create') }}';
					}
				}
			]
		});

	});
</script>

@endsection

