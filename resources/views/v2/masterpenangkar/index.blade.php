@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')

@can('poktan_access')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Daftar Penangkar Benih Bawang Putih Berlabel
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="datatable" class="table table-bordered table-hover table-striped w-100">
						<thead>
							<th>Nama Lembaga</th>
							<th>Pimpinan</th>
							<th>Alamat & Kontak</th>
							<th>Provinsi</th>
							<th>Kota</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($masterpenangkars as $penangkar)
							<tr>
								<td>{{$penangkar->nama_lembaga}}</td>
								<td>{{$penangkar->nama_pimpinan}}</td>
								<td>
									<div class="row">
										<div class="col-1">
											<i class="mr-1 fal fa-home-alt"></i>
										</div>
										<div class="col">
											{{$penangkar->alamat}}
										</div>
									</div>
									<div class="row">
										<div class="col-1">
											<i class="mr-1 fal fa-phone"></i>
										</div>
										<div class="col">
											{{$penangkar->hp_pimpinan}}
										</div>
									</div>
								</td>
								<td>{{$penangkar->provinsi_id}}</td>
								<td>{{$penangkar->kabupaten_id}}</td>
								<td>
									<button type="button" class="btn btn-icon btn-xs btn-primary"
										data-toggle="modal" data-target="#myEditModal{{$penangkar->id}} ">
										<i class="fal fa-edit"></i>
									</button>
									<form action="{{ route('admin.task.masterpenangkar.destroy', $penangkar->id) }}" method="POST" style="display: inline-block;">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-icon btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
											<i class="fal fa-trash-alt"></i>
										</button>
									</form>
								</td>
								{{-- Modal Edit Poktan --}}
								<div class="modal fade" id="myEditModal{{$penangkar->id}}"
									tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-right" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<div>
													<h6 class="modal-title" id="myModalLabel">Ubah Data Penangkar</h6>
													<h4 class="fw-500 text-primary">{{ $penangkar->nama_lembaga }}</h4>
												</div>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form method="POST" action="{{ route('admin.task.masterpenangkar.update', [$penangkar->id]) }}"
												enctype="multipart/form-data">
												@csrf
												@method('PUT')
												<div class="modal-body">
													<!-- Add your form fields here to create a new group of farmers -->
													<div class="form-group">
														<label for="">Nama Lembaga Penangkar</label>
														<input type="text" name="nama_lembaga" id="nama_lembaga"
															value="{{ old('nama_lembaga', $penangkar->nama_lembaga) }}"
															class="form-control form-control-sm"
															placeholder="Nama Lembaga Penangkar" aria-describedby="helpId">
														{{-- <small id="helpId" class="text-muted">Nama Kelompok Tani</small> --}}
													</div>
													<div class="form-group">
														<label for="">Nama Pimpinan</label>
														<input type="text" name="nama_pimpinan" id="nama_pimpinan"
															value="{{ old('nama_pimpinan', $penangkar->nama_pimpinan) }}"
															class="form-control form-control-sm"
															placeholder="" aria-describedby="helpId">
														{{-- <small id="helpId" class="text-muted">Nama Pimpinan Kelompok Tani</small> --}}
													</div>
													<div class="form-group">
														<label for="">Nomor Kontak</label>
														<input type="text" name="hp_pimpinan" id="hp_pimpinan"
															value="{{ old('hp_pimpinan', $penangkar->hp_pimpinan) }}"
															class="form-control form-control-sm"
															placeholder="" aria-describedby="helpId">
													<small id="helpId" class="text-muted">Nomor kontak aktif yang dapat dihubungi (HP/Telp).</small>
													</div>
													<div class="form-group">
														<label for="">Alamat</label>
														<textarea name="alamat" id="alamat"
															class="form-control form-control-sm" rows="2">{{ old('alamat', $penangkar->alamat) }}</textarea>
														<small id="helpId" class="text-muted">Nomor kontak aktif yang dapat dihubungi (HP/Telp).</small>
													</div>
													<div class="row d-flex justify-content-between">
														<div class="form-group col-md-6">
															<label for="">Provinsi</label>
															<select name="provinsi_id" id="provinsi_id" class="custom-select form-control form-control-sm">
																<option value="" hidden>-- pilih provinsi</option>
																<option value="{{$penangkar->provinsi_id}}" selected>{{$penangkar->provinsi_id}}</option>
																<option value=""></option>
															</select>
															<small id="helpId" class="text-muted">Provinsi domisili Kelompoktani.</small>
														</div>
														<div class="form-group col-md-6">
															<label for="">Kabupaten</label>
															<select name="kabupaten_id" id="kabupaten_id" class="custom-select form-control form-control-sm">
																<option value="" hidden>-- pilih kabupaten</option>
																<option value="{{$penangkar->kabupaten_id}}" selected>{{$penangkar->kabupaten_id}}</option>
																<option value=""></option>
															</select>
															<small id="helpId" class="text-muted">Kabupaten domisili Kelompoktani.</small>
														</div>
													</div>
													<div class="row d-flex justify-content-between">
														<div class="form-group col-md-6">
															<label for="">Kecamatan</label>
															<select name="kecamatan_id" id="kecamatan_id" class="custom-select form-control form-control-sm">
																<option value="" hidden>-- pilih kecamatan</option>
																<option value="{{$penangkar->kecamatan_id}}" selected>{{$penangkar->kecamatan_id}}</option>
																<option value=""></option>
															</select>
															<small id="helpId" class="text-muted">Provinsi domisili Kelompoktani.</small>
														</div>
														<div class="form-group col-md-6">
															<label for="">Kelurahan</label>
															<select name="desa_id" id="desa_id" class="custom-select form-control form-control-sm">
																<option value="" hidden>-- pilih kelurahan</option>
																<option value="{{$penangkar->desa_id}}" selected>{{$penangkar->desa_id}}</option>
																<option value=""></option>
															</select>
															<small id="helpId" class="text-muted">Kelurahan domisili Kelompoktani.</small>
														</div>
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
						</tbody>
					</table>
					{{-- Modal Penangkar --}}
					<div class="modal fade" id="myModal"
						tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-right" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<div>
										<h5 class="modal-title" id="myModalLabel">Register Data Penangkar</h5>
										<small id="helpId" class="text-muted">Tambah Daftar Penangkar Benih berlabel</small>
									</div>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form method="POST" action="{{ route('admin.task.masterpenangkar.store')}}"
									enctype="multipart/form-data">
									@csrf
									<div class="modal-body">
										<!-- Add your form fields here to create a new group of farmers -->
										<div class="form-group">
											<label for="">Nama Lembaga Penangkar</label>
											<input type="text" name="nama_lembaga" id="nama_lembaga"
												class="form-control form-control-sm"
												placeholder="Nama Lembaga Penangkar" aria-describedby="helpId">
											{{-- <small id="helpId" class="text-muted">Nama Kelompok Tani</small> --}}
										</div>
										<div class="form-group">
											<label for="">Nama Pimpinan</label>
											<input type="text" name="nama_pimpinan" id="nama_pimpinan"
												class="form-control form-control-sm"
												placeholder="" aria-describedby="helpId">
											{{-- <small id="helpId" class="text-muted">Nama Pimpinan Kelompok Tani</small> --}}
										</div>
										<div class="form-group">
											<label for="">Nomor Kontak</label>
											<input type="text" name="hp_pimpinan" id="hp_pimpinan"
												class="form-control form-control-sm"
												placeholder="" aria-describedby="helpId">
										<small id="helpId" class="text-muted">Nomor kontak aktif yang dapat dihubungi (HP/Telp).</small>
										</div>
										<div class="form-group">
											<label for="">Alamat</label>
											<textarea name="alamat" id="alamat"
												class="form-control form-control-sm" rows="2"></textarea>
											<small id="helpId" class="text-muted">Nomor kontak aktif yang dapat dihubungi (HP/Telp).</small>
										</div>
										<div class="row d-flex justify-content-between">
											<div class="form-group col-md-6">
												<label for="">Provinsi</label>
												<select name="provinsi_id" id="provinsi_id" class="custom-select form-control form-control-sm">
													<option value="" hidden>-- pilih provinsi</option>
													<option value=""></option>
												</select>
												<small id="helpId" class="text-muted">Provinsi domisili Penangkar.</small>
											</div>
											<div class="form-group col-md-6">
												<label for="">Kabupaten</label>
												<select name="kabupaten_id" id="kabupaten_id" class="custom-select form-control form-control-sm">
													<option value="" hidden>-- pilih kabupaten</option>
													<option value=""></option>
												</select>
												<small id="helpId" class="text-muted">Kabupaten domisili Penangkar.</small>
											</div>
										</div>
										<div class="row d-flex justify-content-between">
											<div class="form-group col-md-6">
												<label for="">Kecamatan</label>
												<select name="kecamatan_id" id="kecamatan_id" class="custom-select form-control form-control-sm">
													<option value="" hidden>-- pilih kecamatan</option>
													<option value=""></option>
												</select>
												<small id="helpId" class="text-muted">Provinsi domisili Penangkar.</small>
											</div>
											<div class="form-group col-md-6">
												<label for="">Kelurahan</label>
												<select name="desa_id" id="desa_id" class="custom-select form-control form-control-sm">
													<option value="" hidden>-- pilih kelurahan</option>
													<option value=""></option>
												</select>
												<small id="helpId" class="text-muted">Kelurahan domisili Penangkar.</small>
											</div>
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

