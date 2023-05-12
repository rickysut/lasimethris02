@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/formplugins/bootstrap-colorpicker/bootstrap-colorpicker.css') }}">
@endsection
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
    @can('feeds_access')
	@include('partials.sysalert')
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					<i class="subheader-icon fal fa-ballot-check mr-1"></i>
					<span>
						<i class="fw-300 mr-1">Kelompoktani:</i>
						<span>{{$poktan->nama_kelompok}}</span>
					</span>
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div>
						<table id="datatable" class="table table-bordered table-hover table-striped w-100">
							<thead class="bg-primary-600">
								<tr>
									<th>Nama Anggota</th>
									<th>NIK/No. KTP</th>
									<th>Lahan Dimiliki</th>
									<th>Jadwal Tanam</th>
									<th>Tindakan</th>
								</tr>
							</thead>
							<tbody>
									@foreach ($anggotas as $anggota)
										<tr>
											<td> <a href="" class="fw-500">{{$anggota->nama_petani}}</a> </td>
											<td> {{$anggota->nik_petani}} </td>
											<td> {{$anggota->luas_lahan}} </td>
											<td> {{$anggota->jadwal_tanam}} </td>
											<td class="d-flex justify-content-end">
												<div class="col">
													<a href="{{route('admin.task.anggotapoktan.edit', $anggota->id)}}"
														class="btn btn-icon btn-xs btn-primary"
														title="Ubah data anggota">
														<i class="fal fa-user-edit"></i>
													</a>
												</div>
												<div class="col">
													<form action="{{ route('admin.task.anggotapoktan.destroy', $anggota->id) }}"
														method="POST" style="display: inline-block;">
														@csrf
														@method('DELETE')
														<button type="submit" class="btn btn-icon btn-xs btn-danger"
															title="hapus data anggota"
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
					text: '<i class="fa fa-user-plus mr-1"></i>Anggota Baru',
					titleAttr: 'Tambah Anggota',
					className: 'btn btn-info btn-xs ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.task.masterpoktan.addanggota', $poktan->id) }}';
					}
				}
			]
		});

	});
</script>

@endsection
