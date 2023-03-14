@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('commitment_show')
	<div class="row">
		<div class="col">
			<div class="panel" id="panel-1">
				<div class="panel-hdr">
					<h2>
						Data <span class="fw-300"><i>Informasi</i></span>
					</h2>
					<div class="panel-toolbar">
					</div>
				</div>
				<div class="panel-container show">
					<div class="panel-content row d-flex">
						<div class="form-group col-md-4">
							<label for="">No. RIPH</label>
							<input disabled class="form-control form-control-sm fw-500 text-primary"
							placeholder="" aria-describedby="helpId"
							value="{{$commitment->no_ijin}}">
						</div>
						<div class="form-group col-md-4">
							<label for="">No. Perjanjian</label>
							<input disabled class="form-control form-control-sm fw-500 text-primary"
							placeholder="" aria-describedby="helpId"
							value="{{$pksmitra->no_pks}}">
						</div>
						<div class="form-group col-md-4">
							<label for="">Kelompoktani</label>
							<input disabled class="form-control form-control-sm fw-500 text-primary"
							placeholder="" aria-describedby="helpId"
							value="{{$masterkelompok->nama_kelompok}}">
						</div>
					</div>
				</div>
			</div>
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>
						Daftar <span class="fw-300"><i>Realisasi Lokasi dan Pelaksana</i></span>
					</h2>
					<div class="panel-toolbar">
						@include('partials.globaltoolbar')
					</div>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<!-- datatable start -->
						<table id="tbl" class="table table-sm table-bordered table-hover table-striped w-100">
							<thead>
								<th></th>
								<th>Nama Lokasi</th>
								<th>Petani Pelaksana</th>
								<th>Luas Tanam</th>
								<th>Tanggal Tanam</th>
								<th>Panen</th>
								<th>Tanggal Panen</th>
								<th>Tindakan</th>
							</thead>
							<tbody>
								@foreach ($anggotamitras as $anggotamitra)
								<tr>
									<td class="text-center">
										@if (!empty($warns))
											<i class="fas fa-exclamation-circle text-danger" data-toggle="tooltip" data-html="true" title="{{ implode('<br>', $warns) }}"></i>
										@elseif (empty($fault))
											<i class="fas fa-check-circle text-success"></i>
										@endif
									</td>
									<td>{{$anggotamitra->nama_lokasi}}</td>
									<td>{{$anggotamitra->masteranggota->nama_petani}} - 
										{{$anggotamitra->masteranggota->nik_petani}}
									</td>
									<td class="text-right">{{$anggotamitra->luas_tanam}} ha</td>
									<td class="text-center">{{$anggotamitra->tgl_tanam}}</td>
									<td class="text-right">{{$anggotamitra->volume}} ton</td>
									<td class="text-center">{{$anggotamitra->tgl_panen}}</td>
									<td  class="text-center">
										<a href="{{route('admin.task.anggotamitra.show', $anggotamitra->id)}}"
											title="Buat/Ubah Laporan Realisasi" class="btn btn-xs btn-icon btn-primary"
											data-toggle="tooltip" >
											<i class="fal fa-map"></i>
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
		{{-- Modal New PKS --}}
<div class="modal fade" id="modalAddPetani"
	tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-center" role="document">
		<div class="modal-content">
			<div class="modal-header card-header">
				<div>
					<h4 class="modal-title fw-500" id="myModalLabel">Tambah Petani Pelaksana</h4>
					<small id="helpId" class="text-muted">Petani Pelaksana sesuai Kelompoktani dan Daftar Petani yang tercantum di dalam Perjanjian Kerjasama.</small>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{route('admin.task.anggotamitra.store')}}"
				method="POST" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<input type="text" name="commitmentbackdate_id" id="commitmentbackdate_id"
						value="{{$commitment->id}}" hidden>

					<input type="text" name="pks_mitra_id" id="pks_mitra_id"
						value="{{$pksmitra->id}}" hidden>

					<input type="text" name="no_ijin" id="no_ijin"
						value="{{$commitment->no_ijin}}" hidden>

					<div class="form-group">
						<label for="">No. Reg/Nama Lokasi</label>
						<input type="text" name="nama_lokasi" id="nama_lokasi"
							class="form-control " placeholder="misal: Lokasi 1 Pak Hadi atau 01/PTABC/RIPH/Hadi"
							aria-describedby="helpId" required>
						<small id="helpId" class="text-muted">Berikan nama atau nomor register agar memudahkan dalam pencarian data.</small>
					</div>
					<div class="form-group">
						<label for="">Pilih Petani Pelaksana</label>
						<select class="form-control selectpetani" id="master_anggota_id"
						name="master_anggota_id" required>
						<option value="" hidden>--pilih petani</option>
							@foreach($masteranggotas as $masteranggota)
								<option value="{{ $masteranggota->id }}">{{ $masteranggota->nama_petani}} - {{ $masteranggota->nik_petani}}</option>
							@endforeach
						</select>
						<small id="helpId" class="text-muted">Periksa kesesuaian Nama Petani - NIK</small>
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
            $(".selectpetani").select2({
                placeholder: "--Pilih Kelompoktani",
				dropdownParent:'#modalAddPetani'
            });
        });
    });
</script>

<script>
	$(document).ready(function()
	{
		
		$('#tbl').dataTable(
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
					text: '<i class="fa fa-user-plus"></i>',
					titleAttr: 'Tambah Petani Pelaksana',
					className: 'btn btn-primary btn-sm btn-icon ml-3',
					action: function(e, dt, node, config) {
					// find the modal element
						var $modal = $('#modalAddPetani');

						// trigger the modal's show method
						$modal.modal('show');
					}
				}
			]
		});
	});
</script>
@endsection

{{-- {{ route('admin.task.commitments.pksmitra', $commitment->id) }} --}}