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
					Kelompok Tani
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-hover table-striped" id="datatable">
						<thead>
							<th>Nama Kelompok</th>
							<th>Pimpinan</th>
							<th>Kontak (HP)</th>
							<th>Kota</th>
							<th>Kecamatan - Desa</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($poktans as $poktan)
							<tr>
								<td>{{$poktan->nama_kelompok}}</td>
								<td>{{$poktan->nama_pimpinan}}</td>
								<td>{{$poktan->hp_pimpinan}}</td>
								<td>{{$poktan->id_kabupaten}}</td>
								<td>{{$poktan->id_kecamatan}} - {{$poktan->id_kelurahan}}</td>
								<td>
									<a href="" class="btn btn-icon btn-xs btn-danger">
										<i class="fal fa-users"></i>
									</a>
									<button type="button" class="btn btn-icon btn-xs btn-primary" data-toggle="modal" data-target="#myEditModal{{$poktan->id}} ">
										<i class="fal fa-edit"></i>
									  </button>
									<a href="" class="btn btn-icon btn-xs btn-danger">
										<i class="fal fa-trash-alt"></i>
									</a>
								</td>
								{{-- Modal Edit Poktan --}}
								<div class="modal fade" id="myEditModal{{$poktan->id}}"
									tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-right" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<div>
													<h6 class="modal-title" id="myModalLabel">Ubah Data Kelompoktani</h6>
													<h4 class="fw-500 text-primary">{{ $poktan->nama_kelompok }}</h4>
												</div>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form method="POST" action="{{ route('admin.task.masterpoktan.update', [$poktan->id]) }}"
												enctype="multipart/form-data">
												@csrf
												@method('PUT')
												<div class="modal-body">
													<!-- Add your form fields here to create a new group of farmers -->
													<input type="text" value="{{$user->id}}" id="user_id" name="user_id" hidden>
													<div class="form-group">
														<label for="">Nama Kelompok Tani</label>
														<input type="text" name="nama_kelompok" id="nama_kelompok"
															value="{{ old('nama_kelompok', $poktan->nama_kelompok) }}"
															class="form-control form-control-sm"
															placeholder="Nama Kelompoktani" aria-describedby="helpId">
														{{-- <small id="helpId" class="text-muted">Nama Kelompok Tani</small> --}}
													</div>
													<div class="form-group">
														<label for="">Nama Pimpinan</label>
														<input type="text" name="nama_pimpinan" id="nama_pimpinan"
															value="{{ old('nama_pimpinan', $poktan->nama_pimpinan) }}"
															class="form-control form-control-sm"
															placeholder="" aria-describedby="helpId">
														{{-- <small id="helpId" class="text-muted">Nama Pimpinan Kelompok Tani</small> --}}
													</div>
													<div class="form-group">
														<label for="">Nomor Kontak</label>
														<input type="text" name="hp_pimpinan" id="hp_pimpinan"
															value="{{ old('hp_pimpinan', $poktan->hp_pimpinan) }}"
															class="form-control form-control-sm"
															placeholder="" aria-describedby="helpId">
													<small id="helpId" class="text-muted">Nomor kontak (HP/Telp) aktif yang dapat dihubungi.</small>
													</div>
													<div class="row d-flex justify-content-between">
														<div class="form-group col-md-6">
															<label for="">Provinsi</label>
															<select name="id_provinsi" id="id_provinsi" class="custom-select form-control form-control-sm">
																<option value="" hidden>-- pilih provinsi</option>
																<option value="{{$poktan->id_provinsi}}" selected>{{$poktan->id_provinsi}}</option>
																<option value=""></option>
															</select>
															<small id="helpId" class="text-muted">Provinsi domisili Kelompoktani.</small>
														</div>
														<div class="form-group col-md-6">
															<label for="">Kabupaten</label>
															<select name="id_kabupaten" id="id_kabupaten" class="custom-select form-control form-control-sm">
																<option value="" hidden>-- pilih kabupaten</option>
																<option value="{{$poktan->id_kabupaten}}" selected>{{$poktan->id_kabupaten}}</option>
																<option value=""></option>
															</select>
															<small id="helpId" class="text-muted">Kabupaten domisili Kelompoktani.</small>
														</div>
													</div>
													<div class="row d-flex justify-content-between">
														<div class="form-group col-md-6">
															<label for="">Kecamatan</label>
															<select name="id_kecamatan" id="id_kecamatan" class="custom-select form-control form-control-sm">
																<option value="" hidden>-- pilih kecamatan</option>
																<option value="{{$poktan->id_kecamatan}}" selected>{{$poktan->id_kecamatan}}</option>
																<option value=""></option>
															</select>
															<small id="helpId" class="text-muted">Provinsi domisili Kelompoktani.</small>
														</div>
														<div class="form-group col-md-6">
															<label for="">Kelurahan</label>
															<select name="id_keluarahan" id="id_kelurahan" class="custom-select form-control form-control-sm">
																<option value="" hidden>-- pilih kelurahan</option>
																<option value="{{$poktan->id_kelurahan}}" selected>{{$poktan->id_kelurahan}}</option>
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
					{{-- Modal Create Poktan --}}
					<div class="modal fade" id="myModal"
						tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-right" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<div>
										<h4 class="modal-title" id="myModalLabel">Registrasi Kelompoktani</h4>
									<small id="helpId" class="text-muted">Tambah kelompoktani dalam rangka kerjasama pelaksanaan wajib tanam-produksi</small>
									</div>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{ route('admin.task.masterpoktan.store') }}" method="post">
									@csrf
									<div class="modal-body">
										<!-- Add your form fields here to create a new group of farmers -->
											<input type="text" value="{{$user->id}}" id="user_id" name="user_id" hidden>
											<div class="form-group">
												<label for="">Nama Kelompok Tani</label>
												<input type="text" name="nama_kelompok" id="nama_kelompok"
													class="form-control form-control-sm" placeholder="Nama Kelompoktani" aria-describedby="helpId">
												{{-- <small id="helpId" class="text-muted">Nama Kelompok Tani</small> --}}
											</div>
											<div class="form-group">
												<label for="">Nama Pimpinan</label>
												<input type="text" name="nama_pimpinan" id="nama_pimpinan"
													class="form-control form-control-sm" placeholder="" aria-describedby="helpId">
												{{-- <small id="helpId" class="text-muted">Nama Pimpinan Kelompok Tani</small> --}}
											</div>
											<div class="form-group">
												<label for="">Nomor Kontak</label>
												<input type="text" name="hp_pimpinan" id="hp_pimpinan"
													class="form-control form-control-sm" placeholder="" aria-describedby="helpId">
											<small id="helpId" class="text-muted">Nomor kontak (HP/Telp) aktif yang dapat dihubungi.</small>
											</div>
											<div class="row d-flex justify-content-between">
												<div class="form-group col-md-6">
													<label for="">Provinsi</label>
													<select name="id_provinsi" id="id_provinsi" class="custom-select form-control form-control-sm">
														<option value="" hidden>-- pilih provinsi</option>
													</select>
													<small id="helpId" class="text-muted">Provinsi domisili Kelompoktani.</small>
												</div>
												<div class="form-group col-md-6">
													<label for="">Kabupaten</label>
													<select name="id_kabupaten" id="id_kabupaten" class="custom-select form-control form-control-sm">
														<option value="" hidden>-- pilih kabupaten</option>
													</select>
													<small id="helpId" class="text-muted">Kabupaten domisili Kelompoktani.</small>
												</div>
											</div>
											<div class="row d-flex justify-content-between">
												<div class="form-group col-md-6">
													<label for="">Kecamatan</label>
													<select name="id_kecamatan" id="id_kecamatan" class="custom-select form-control form-control-sm">
														<option value="" hidden>-- pilih kecamatan</option>
													</select>
													<small id="helpId" class="text-muted">Provinsi domisili Kelompoktani.</small>
												</div>
												<div class="form-group col-md-6">
													<label for="">Kelurahan</label>
													<select name="id_keluarahan" id="id_kelurahan" class="custom-select form-control form-control-sm">
														<option value="" hidden>-- pilih kelurahan</option>
													</select>
													<small id="helpId" class="text-muted">Kelurahan domisili Kelompoktani.</small>
												</div>
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button class="btn btn-primary" type="submit">Save changes</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					{{-- Modal Edit Poktan --}}
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
	$('#datatable').dataTable({
		pagingType: 'full_numbers',
		responsive: true,
		lengthChange: false,
		pageLength: 10,
		order: [
		[0, 'asc']
		],
		dom: // Add the modal button inside the 'B' option of the 'dom' string
		"<'row'<'col-sm-12 col-md-2'fl><'col-sm-12 col-md-8 d-flex'><'col-sm-12 col-md-2 d-flex justify-content-end'B>>" +
		"<'row'<'col-sm-12 col-md-12'tr>>" +
		"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
		buttons: [
			{
				text: '<i class="fal fa-plus mr-1"></i>Kelompok Tani baru',
				className: 'btn btn-primary btn-xs',
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

