@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('commitment_show')
	<div class="row">
		<div class="col">
			<div class="panel" id="panel-6">
				<div class="panel-hdr">
					<h2>
						Daftar <span class="fw-300"><i>Penangkar Benih Mitra</i></span>
					</h2>
					<div class="panel-toolbar">
						Nomor RIPH:
						<span class="ml-1">
							<a href="{{route('admin.task.commitments.show', $commitment->id)}}"
								class="fw-500">
								{{$commitment->no_ijin}}
							</a>
						</span>
                    </div>
                </div>
                <div class="panel-container show">
					<div class="panel-content">
                        <!-- datatable start -->
                        <table id="tblPks" class="table table-sm table-bordered table-hover table-striped w-100">
                            <thead>
								<th>No Perjanjian</th>
								<th>Poktan Mitra</th>
								<th>Masa berlaku</th>
								<th>Rencana</th>
								<th>Tindakan</th>
							</thead>
							<tbody>
								@foreach ($pksmitras as $pksmitra)
								<tr>
									<td> {{$pksmitra->no_pks}} </td>
									<td> {{$pksmitra->masterkelompok->nama_kelompok}} </td>
									<td> {{$pksmitra->tgl_mulai}} s.d {{$pksmitra->tgl_akhir}} </td>
									<td>
										<div class="row col">
											<div class="col-2">
												<i class="fal fa-ruler-combined"></i>
											</div>
											<div class="col-9">
												{{$pksmitra->luas_rencana}} ha
											</div>
										</div>
										<div class="row col">
											<div class="col-2">
												<i class="fal fa-weight-hanging"></i>
											</div>
											<div class="col-9">
												{{$pksmitra->luas_rencana*6}} ha
											</div>
										</div>
									</td>
									<td>
										<a href="{{route('admin.task.pksmitra.show', $pksmitra->id)}}"
											title="Buat Laporan Realisasi" class="btn btn-xs btn-icon btn-primary">
											<i class="fal fa-seedling"></i>
										</a>
										<button type="button" class="btn btn-icon btn-xs btn-warning"
											data-toggle="modal" data-target="#editPks{{$pksmitra->id}} ">
											<i class="fal fa-edit"></i>
										</button>
										<form action="{{ route('admin.task.pksmitra.destroy', $pksmitra->id) }}"
											method="POST" style="display: inline-block;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-icon btn-xs btn-danger ml-3"
											title="Hapus data Perjanjian"
												onclick="return confirm('Anda yakin akan menghapus data ini?');">
												<i class="fal fa-trash-alt"></i>
											</button>
										</form>
									</td>
									{{-- Modal edit PKS --}}
									<div class="modal fade" id="editPks{{$pksmitra->id}}"
										tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-right" role="document">
											<div class="modal-content">
												<div class="modal-header card-header">
													<div>
														<h4 class="modal-title fw-500" id="myModalLabel">Ubah data Perjanjian</h4>
														<small id="helpId" class="text-muted">Ubah/Perbarui Data Perjanjian Kerjasama</small>
													</div>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form action=" {{route('admin.task.pksmitra.update', $pksmitra->id)}} "
													method="POST" enctype="multipart/form-data">
													@csrf
													@method('PUT')
													<div class="modal-body">
														<input type="text" name="commitmentbackdate_id" id="commitmentbackdate_id"
															class="form-control " placeholder="" aria-describedby="helpId"
															value="{{$commitment->id}}" hidden>
														<input type="text" name="no_ijin" id="no_ijin"
															class="form-control " placeholder="" aria-describedby="helpId"
															value="{{$commitment->no_ijin}}">
														<div class="form-group">
															<label for="">Nomor PKS</label>
															<input type="text" name="no_pks" id="no_pks"
																class="form-control " placeholder="misal: 001/PKS/PTABC/V/2022"
																value="{{ old('no_pks', $pksmitra->no_pks) }}"
																aria-describedby="helpId">
															<small id="helpId" class="text-muted">Nomor Perjanjian Kerjasama dengan Poktan Mitra</small>
														</div>
														<div class="form-group">
															<label for="master_kelompok_id">Kelompok Tani</label>
																<select class="form-control custom-select selecteditpoktan"
																	name="master_kelompok_id" id="master_kelompok_id">
																	<option value="{{ isset($pksmitra) ? $pksmitra->masterkelompok->id : '' }}">
																		{{ isset($pksmitra) ? $pksmitra->masterkelompok->id. ' . ' . 
																		$pksmitra->masterkelompok->nama_kelompok . ' - ' . 
																		$pksmitra->masterkelompok->nama_pimpinan : 'Load Record' }}
																	</option>
																	@foreach ($masterkelompoks as $poktan)
																		<option value="{{$poktan->id}}">
																			{{$poktan->id}}. {{$poktan->nama_kelompok}} - {{$poktan->nama_pimpinan}}
																		</option>
																	@endforeach
																</select>
															<small id="helpId" class="text-muted">Kelompoktani Mitra pelaksanaan wajib tanam-produksi</small>
														</div>
														<div class="row d-flex">
															<div class="form-group col-md-6">
																<label for="">Tanggal Perjanjian</label>
																<input type="date" name="tgl_mulai" id="tanggal_mulai"
																	value="{{ old('tgl_mulai', $pksmitra->tgl_mulai) }}"
																	class="form-control " placeholder="tanggal mulai perjanjian"
																	aria-describedby="helpId">
																<small id="helpId" class="text-muted">Tanggal mulai berlaku perjanjian</small>
															</div>
															<div class="form-group col-md-6">
																<label for="">Tanggal Akhir</label>
																<input type="date" name="tgl_akhir" id="tgl_akhir"
																	value="{{ old('tgl_akhir', $pksmitra->tgl_akhir) }}"
																	class="form-control " placeholder="tanggal akhir perjanjian"
																	aria-describedby="helpId">
																<small id="helpId" class="text-muted">Tanggal berakhirnya perjanjian kerjasama</small>
															</div>
														</div>
														<div class="row d-flex">
															<div class="form-group col-md-4">
																<label for="">Luas Rencana Tanam</label>
																<input type="text" name="luas_rencana" id="luas_rencana"
																	value="{{ old('luas_rencana', $pksmitra->luas_rencana) }}"
																	class="form-control " placeholder="dalam satuan hektar (ha)"
																	aria-describedby="helpId">
																{{-- <small id="helpId" class="text-muted">Luas rencana tanam yang dikerjasamakan. Dalam satuan hektar(ha)</small> --}}
															</div>
															<div class="form-group col-md-4">
																<label for="">Varietas</label>
																<input type="text" name="varietas" id="varietas"
																	class="form-control " placeholder="varietas yang akan ditanam"
																	value="{{ old('varietas', $pksmitra->varietas) }}"
																	aria-describedby="helpId">
																{{-- <small id="helpId" class="text-muted">Varietas yang akan ditanam di lahan kerjasama.</small> --}}
															</div>
															<div class="form-group col-md-4">
																<label for="">Periode Tanam</label>
																<input type="text" name="periode_tanam" id="periode_tanam"
																	class="form-control " placeholder="misal: Jan-Feb"
																	value="{{ old('periode_tanam', $pksmitra->periode_tanam) }}"
																	aria-describedby="helpId">
																{{-- <small id="helpId" class="text-muted">Jadwal Periode pelaksanaan penanaman.</small> --}}
															</div>
														</div>
														<div class="form-group">
															<label for="">Salinan Perjanjian Kerjasama</label>
															<input type="file" name="attachment" id="attachment"
																class="form-control " placeholder="unggah lampiran"
																value="{{ old('attachment', $pksmitra->attachment) }}"
																aria-describedby="helpId">
															{{-- <small id="helpId" class="text-muted">Unggah hasil pindai Salinan Perjanjian Kerjasama. Berkas dalam bentuk PDF. Ukuran maks 4 megabytes (mb). </small> --}}
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-outline-secondary btn-sm"
														data-dismiss="modal">
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
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- Modal New PKS --}}
<div class="modal fade" id="modalPks"
	tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-right" role="document">
		<div class="modal-content">
			<div class="modal-header card-header">
				<div>
					<h4 class="modal-title fw-500" id="myModalLabel">Kerjasama baru</h4>
					<small id="helpId" class="text-muted">Tambah Daftar Kerjasama (PKS) baru</small>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{route('admin.task.pksmitra.store')}}"
				method="POST" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<input type="text" name="commitmentbackdate_id" id="commitmentbackdate_id"
						class="form-control " placeholder="" aria-describedby="helpId"
						value="{{$commitment->id}}" hidden>
					<input type="text" name="no_ijin" id="no_ijin"
						class="form-control " placeholder="" aria-describedby="helpId"
						value="{{$commitment->no_ijin}}">
					<div class="form-group">
						<label for="">Nomor PKS</label>
						<input type="text" name="no_pks" id="no_pks"
							class="form-control " placeholder="misal: 001/PKS/PTABC/V/2022"
							aria-describedby="helpId" required>
						<small id="helpId" class="text-muted">Nomor Perjanjian Kerjasama dengan Poktan Mitra</small>
					</div>
					<div class="form-group">
						<label for="">Pilih Kelompok Tani</label>
						<select class="form-control custom-select selectpoktan"
							name="master_kelompok_id" id="master_kelompok_id" required>
							<option value="" hidden>--pilih kelompoktani</option>
							@foreach ($masterkelompoks as $poktan)
								<option value="{{$poktan->id}}">
									{{$poktan->id}}. {{$poktan->nama_kelompok}} - {{$poktan->nama_pimpinan}}
								</option>
							@endforeach
						</select>
						<small id="helpId" class="text-muted">Kelompoktani Mitra pelaksanaan wajib tanam-produksi</small>
					</div>
					<div class="row d-flex">
						<div class="form-group col-md-6">
							<label for="">Tanggal Perjanjian</label>
							<input type="date" name="tgl_mulai" id="tanggal_mulai"
								class="form-control " placeholder="tanggal mulai perjanjian"
								aria-describedby="helpId">
							<small id="helpId" class="text-muted">Tanggal mulai berlaku perjanjian.</small>
						</div>
						<div class="form-group col-md-6">
							<label for="">Tanggal Akhir</label>
							<input type="date" name="tgl_akhir" id="tgl_akhir"
								class="form-control " placeholder="tanggal akhir perjanjian"
								aria-describedby="helpId">
							<small id="helpId" class="text-muted">Tanggal berakhirnya perjanjian.</small>
						</div>
					</div>
					<div class="row d-flex">
						<div class="form-group col-md-4">
							<label for="">Luas Rencana Tanam</label>
							<input type="text" name="luas_rencana" id="luas_rencana"
								class="form-control " placeholder="dalam satuan hektar (ha)"
								aria-describedby="helpId">
							{{-- <small id="helpId" class="text-muted">Luas rencana tanam yang dikerjasamakan. Dalam satuan hektar(ha)</small> --}}
						</div>
						<div class="form-group col-md-4">
							<label for="">Varietas</label>
							<input type="text" name="varietas" id="varietas"
								class="form-control " placeholder="varietas yang akan ditanam"
								aria-describedby="helpId">
							{{-- <small id="helpId" class="text-muted">Varietas yang akan ditanam di lahan kerjasama.</small> --}}
						</div>
						<div class="form-group col-md-4">
							<label for="">Periode Tanam</label>
							<input type="text" name="periode_tanam" id="periode_tanam"
								class="form-control " placeholder="misal: Jan-Feb"
								aria-describedby="helpId">
							{{-- <small id="helpId" class="text-muted">Jadwal Periode pelaksanaan penanaman.</small> --}}
						</div>
					</div>
					<div class="form-group">
						<label for="">Salinan Perjanjian Kerjasama</label>
						<input type="file" name="attachment" id="attachment"
							class="form-control " placeholder="unggah lampiran"
							aria-describedby="helpId">
						<small id="helpId" class="text-muted">Unggah hasil pindai Salinan Perjanjian Kerjasama. Berkas dalam bentuk PDF. Ukuran maks 4 megabytes (mb). </small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary btn-sm"
					data-dismiss="modal">
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

	

@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
@parent

<script>
    $(document).ready(function() {
        $(function() {
            $(".selectpoktan").select2({
                placeholder: "--Pilih Kelompoktani",
				dropdownParent:'#modalPks'
            });

			@isset($pksmitra->id)
			$(".selecteditpoktan").select2({
                placeholder: "--Pilih Kelompoktani",
				dropdownParent:'#editPks{{$pksmitra->id}} '
            });
			@endisset
        });
    });
</script>

<script>
	$(document).ready(function()
	{
		// initialize tblPenangkar
		$('#tblPks').dataTable(
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
					text: '<i class="fa fa-file-signature mr-1"></i>',
					titleAttr: 'Tambah PKS',
					className: 'btn btn-outline-warning btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
					// find the modal element
						var $modal = $('#modalPks');

						// trigger the modal's show method
						$modal.modal('show');
					}
				}
			]
		});
	});
</script>
@endsection