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
							<a href="{{route('admin.task.commitments.show',$commitment->id)}}"
								class="fw-500">
								{{$commitment->no_ijin}}
							</a>
						</span>
                    </div>
                </div>
                <div class="panel-container show">
					<div class="panel-content">
                        <!-- datatable start -->
                        <table id="tblPenangkar" class="table table-sm table-bordered table-hover table-striped w-100">
                            <thead>
								<th>Penangkar</th>
								<th>Pimpinan</th>
								<th>Variets</th>
								<th>Ketersediaan</th>
								<th>Tindakan</th>
							</thead>
							<tbody>
								@foreach ($penangkarmitras as $penangkarmitra)
								<tr>
									<td> {{$penangkarmitra->masterpenangkar->nama_lembaga}} </td>
									<td> {{$penangkarmitra->masterpenangkar->nama_pimpinan}} </td>
									<td> {{$penangkarmitra->varietas}} </td>
									<td> {{$penangkarmitra->ketersediaan}} </td>
									<td>
										<button type="button" class="btn btn-icon btn-xs btn-warning"
											data-toggle="modal" data-target="#editPenangkar{{$penangkarmitra->id}} ">
											<i class="fal fa-edit"></i>
										</button>
										<form action="{{ route('admin.task.penangkarmitra.destroy', $commitment->id) }}"
											method="POST" style="display: inline-block;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-icon btn-xs btn-danger" title="Hapus data penangkar"
												onclick="return confirm('Are you sure you want to delete this item?');">
												<i class="fal fa-trash-alt"></i>
											</button>
										</form>
									</td>
									{{-- Modal edit Penangkar --}}
									<div class="modal fade" id="editPenangkar{{$penangkarmitra->id}}"
										tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-right" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<div>
														<h5 class="modal-title" id="myModalLabel">Tambah Penangkar</h5>
														<small id="helpId" class="text-muted">Tambah Daftar Penangkar Benih berlabel</small>
													</div>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form action=" {{route('admin.task.penangkarmitra.update', $penangkarmitra->id)}} "
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
															<label for=""></label>
															<select class="form-control custom-select selecteditpenangkar" name="penangkar_id" id="penangkar_id">
																<option value="{{ isset($penangkarmitra) ? $penangkarmitra->masterpenangkar->id : '' }}">
																	{{ isset($penangkarmitra) ? $penangkarmitra->penangkar_id . ' . ' . $penangkarmitra->masterpenangkar->nama_lembaga . ' - ' . $penangkarmitra->masterpenangkar->nama_pimpinan : 'Load Record' }}
																</option>
																@foreach ($masterpenangkars as $penangkar)
																	<option value="{{$penangkar->id}}">
																		{{$penangkar->id}}. {{$penangkar->nama_lembaga}} - {{$penangkar->nama_pimpinan}}
																	</option>
																@endforeach
															</select>
															
															<small id="helpId" class="text-muted">Pilih Penangkar</small>
														</div>
														<div class="form-group">
															<label for=""></label>
															<input type="text" name="varietas" id="varietas"
															value="{{ old('varietas', $penangkarmitra->varietas) }}"
																class="form-control " placeholder="misal: Lumbu Kuning"
																aria-describedby="helpId">
															<small id="helpId" class="text-muted">Varietas yang ditanam</small>
														</div>
														<div class="form-group">
															<label for=""></label>
															<input type="text" name="ketersediaan" id="ketersediaan"
																value="{{ old('ketersediaan', $penangkarmitra->ketersediaan) }}"
																class="form-control " placeholder="misal: Jan-Feb"
																aria-describedby="helpId">
															<small id="helpId" class="text-muted">Jadwal ketersediaan</small>
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
	
	{{-- Modal Penangkar --}}
	<div class="modal fade" id="modalPenangkar"
		tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-right" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div>
						<h5 class="modal-title" id="myModalLabel">Tambah Penangkar</h5>
						<small id="helpId" class="text-muted">Tambah Daftar Penangkar Benih berlabel</small>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{route('admin.task.penangkarmitra.store')}}"
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
							<label for=""></label>
							<select class="form-control custom-select selectpenangkar"
								name="penangkar_id" id="penangkar_id" required>
								<option value="" hidden>--pilih penangkar</option>
								@foreach ($masterpenangkars as $penangkar)
									<option value="{{$penangkar->id}}">
										{{$penangkar->nama_lembaga}} - {{$penangkar->nama_pimpinan}}
									</option>
								@endforeach
							</select>
							<small id="helpId" class="text-muted">Pilih Penangkar</small>
						</div>
						<div class="form-group">
							<label for=""></label>
							<input type="text" name="varietas" id="varietas"
								class="form-control " placeholder="misal: Lumbu Kuning"
								aria-describedby="helpId">
							<small id="helpId" class="text-muted">Varietas yang ditanam</small>
						</div>
						<div class="form-group">
							<label for=""></label>
							<input type="text" name="ketersediaan" id="ketersediaan"
								class="form-control " placeholder="misal: Jan-Feb"
								aria-describedby="helpId">
							<small id="helpId" class="text-muted">Help text</small>
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
            $(".selectpenangkar").select2({
                placeholder: "--Pilih Kelompoktani",
				dropdownParent:'#modalPenangkar'
            });

			@isset($penangkarmitra->id)
			$(".selecteditpenangkar").select2({
                placeholder: "--Pilih Kelompoktani",
				dropdownParent:'#editPenangkar{{$penangkarmitra->id}}'
            });
			@endisset
        });
    });
</script>

<script>
	$(document).ready(function()
	{
		// initialize tblPenangkar
		$('#tblPenangkar').dataTable(
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
					titleAttr: 'Tambah Penangkar',
					className: 'btn btn-outline-warning btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
					// find the modal element
						var $modal = $('#modalPenangkar');

						// trigger the modal's show method
						$modal.modal('show');
					}
				}
			]
		});
	});
</script>
@endsection