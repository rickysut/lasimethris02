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
						<span>{{$poktan->nama_kelompok}}</span> Category
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
								@if ($anggotas->count()>0)
									@foreach ($anggotas as $anggota)
										<tr>
											<td> <a href="" class="fw-500">{{$anggota->nama_petani}}</a> </td>
											<td> {{$anggota->nik_petani}} </td>
											<td> {{$anggota->luas_lahan}} </td>
											<td> {{$anggota->jadwal_tanam}} </td>
											<td>
												<button type="button" class="btn btn-icon btn-xs btn-primary"
													title="Edit/Show detail" data-toggle="modal"
													data-target="#myEditModal{{$anggota->id}} ">
													<i class="fal fa-user-edit"></i>
												</button>
												<form action="{{ route('admin.task.anggotapoktan.destroy', $anggota->id) }}"
													method="POST" style="display: inline-block;">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-icon btn-xs btn-danger"
														onclick="return confirm('Are you sure you want to delete this item?');">
														<i class="fal fa-trash-alt"></i>
													</button>
												</form>
											</td>
											{{-- Modal Edit Poktan --}}
											<div class="modal fade" id="myEditModal{{$anggota->id}}"
												tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-right modal-sm" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<div>
																<h6 class="modal-title" id="myModalLabel">Ubah Data Anggota</h6>
																<h4 class="fw-500 text-primary">{{ $anggota->nama_petani }}</h4>
															</div>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<form method="POST" action=" {{ route('admin.task.anggotapoktan.update', $anggota->id) }} "
															enctype="multipart/form-data">
															@csrf
															@method('PUT')
															<div class="modal-body">
																<!-- Add your form fields here to create a new group of farmers -->
																<input type="text" value="{{$poktan->id}}" id="master_kelompok_id" name="master_kelompok_id" hidden>
																<div class="form-group">
																	<label for="">Nama Anggota</label>
																	<input type="text" name="nama_petani" id="nama_petani"
																		value="{{ old('nama_petani', $anggota->nama_petani) }}"
																		class="form-control form-control-sm"
																		placeholder="Nama Anggota" aria-describedby="helpId">
																	{{-- <small id="helpId" class="text-muted">Nama Kelompok Tani</small> --}}
																</div>
																<div class="form-group">
																	<label for="">NIK/No. KTP</label>
																	<input type="text" name="nik_petani" id="nik_petani"
																		value="{{ old('nik_petani', $anggota->nik_petani) }}"
																		class="form-control form-control-sm"
																		placeholder="" aria-describedby="helpId">
																	{{-- <small id="helpId" class="text-muted">Nama Pimpinan Kelompok Tani</small> --}}
																</div>
																<div class="form-group">
																	<label for="">Luas Lahan (ha)</label>
																	<input type="number" step="any" name="luas_lahan" id="luas_lahan"
																		value="{{ old('luas_lahan', $anggota->luas_lahan) }}"
																		class="form-control form-control-sm"
																		placeholder="" aria-describedby="helpId">
																	<small id="helpId" class="text-muted">Luas lahan milik yang akan dikerjasamakan dalam pelaksanaan wajib tanam-produksi (dalam satuan ha).</small>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
																	<i class="fal fa-times-circle text-danger fw-500"></i> Close
																</button>
																<button class="btn btn-primary btn-sm" type="submit">
																	<i class="fal fa-save"></i> Save changes
																</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</tr>
									@endforeach
								@else
									<tr>
										<td class="text-center text-danger fw-400 fs-xxl" colspan="5">
											No Post Available for this Category
										</td>
									</tr>
								@endif
							</tbody>
						</table>
						{{-- Modal Create Anggota --}}
						<div class="modal fade" id="myModal"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-right modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<div>
											<h4 class="modal-title" id="myModalLabel">Registrasi Anggota</h4>
											<small id="helpId" class="text-muted">
												Tambah kelompoktani dalam rangka kerjasama
												pelaksanaan wajib tanam-produksi
											</small>
										</div>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form method="POST" action="{{ route('admin.task.anggotapoktan.store') }}"
										enctype="multipart/form-data">
										@csrf
										<div class="modal-body">
											<!-- Add your form fields here to create a new group of farmers -->
											<input type="text" value="{{$poktan->id}}" id="master_kelompok_id" name="master_kelompok_id" hidden>
											<div class="form-group">
												<label for="">Nama Anggota</label>
												<input type="text" name="nama_petani" id="nama_petani"
													class="form-control form-control-sm"
													placeholder="Nama Anggota" aria-describedby="helpId">
												{{-- <small id="helpId" class="text-muted">Nama Kelompok Tani</small> --}}
											</div>
											<div class="form-group">
												<label for="">NIK/No. KTP</label>
												<input type="text" name="nik_petani" id="nik_petani"
													class="form-control form-control-sm"
													placeholder="Nomor Induk Kependudukan" aria-describedby="helpId">
												<small id="helpId" class="text-muted">Nama Pimpinan Kelompok Tani</small>
											</div>
											<div class="form-group">
												<label for="">Luas Lahan (ha)</label>
												<input type="number" step="any" name="luas_lahan" id="luas_lahan"
													class="form-control form-control-sm"
													placeholder="0.00" aria-describedby="helpId">
												<small id="helpId" class="text-muted">Luas lahan milik yang akan dikerjasamakan dalam pelaksanaan wajib tanam-produksi (dalam satuan ha).</small>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
												<i class="fal fa-times-circle text-danger fw-500"></i> Close
											</button>
											<button class="btn btn-primary btn-sm" type="submit">
												<i class="fal fa-save"></i> Save changes
											</button>
										</div>
									</form>
								</div>
							</div>
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
					text: '<i class="fa fa-user-plus mr-1"></i>',
					titleAttr: 'Add Poktan Member',
					className: 'btn btn-outline-warning btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
					// find the modal element
						var $modal = $('#myModal');

						// trigger the modal's show method
						$modal.modal('show');
					}
				}
			]
		});

	});
</script>

@endsection
