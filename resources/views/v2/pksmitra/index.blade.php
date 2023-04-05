@extends('layouts.admin')

@section('styles')

@endsection

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
						@include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
					<div class="panel-content">
                        <!-- datatable start -->
                        <table id="tblPks" class="table table-sm table-bordered table-hover table-striped w-100">
                            <thead>
								<th>Tahun</th>
								<th>No Perjanjian</th>
								<th>No. RIPH</th>
								<th>Poktan Mitra</th>
								<th>Masa berlaku</th>
								<th>Tindakan</th>
							</thead>
							<tbody>
								@foreach ($pksmitras as $pksmitra)
								<tr>
									<td>{{$pksmitra->commitmentbackdate->periodetahun}}</td>
									<td> {{$pksmitra->no_perjanjian}} </td>
									<td>{{$pksmitra->commitmentbackdate->no_ijin}}</td>
									<td> {{$pksmitra->masterkelompok->nama_kelompok}} </td>
									<td> {{$pksmitra->tgl_perjanjian_start}} s.d {{$pksmitra->tgl_perjanjian_end}} </td>
									<td>
										<a href="{{route('admin.task.pksmitra.show', $pksmitra->id)}}"
											title="Buat Laporan Realisasi" class="btn btn-xs btn-icon btn-primary">
											<i class="fal fa-seedling"></i>
										</a>
										<button type="button" class="btn btn-icon btn-xs btn-warning"
											data-toggle="modal" data-target="#editPks{{$pksmitra->id}} ">
											<i class="fas fa-search"></i>
										</button>
									</td>
									{{-- Modal edit PKS --}}
									<div class="modal fade" id="editPks{{$pksmitra->id}}"
										tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-right" role="document">
											<div class="modal-content">
												<div class="modal-header card-header">
													<div>
														<h4 class="modal-title fw-500" id="myModalLabel">Detail Perjanjian</h4>
														<small id="helpId" class="text-muted">Data Detail Perjanjian Kerjasama</small>
													</div>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
                                                <div class="modal-body">
                                                    <ul class="list-group mb-3" style="word-break:break-word;">
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Nomor RIPH</span>
															<h6 class="fw-500 my-0">{{$pksmitra->commitmentbackdate->no_ijin}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Nomor Perjanjian</span>
															<h6 class="fw-500 my-0">{{$pksmitra->no_perjanjian}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Kelompoktani</span>
															<h6 class="fw-500 my-0">{{$pksmitra->masterkelompok->nama_kelompok}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Tanggal Perjanjian</span>
															<h6 class="fw-500 my-0">{{$pksmitra->tgl_perjanjian_start}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Tanggal Akhir</span>
															<h6 class="fw-500 my-0">{{$pksmitra->tgl_perjanjian_end}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Luas Rencana</span>
															<h6 class="fw-500 my-0">{{$pksmitra->luas_rencana}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Varietas</span>
															<h6 class="fw-500 my-0">{{$pksmitra->varietas_tanam}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Periode Tanam</span>
															<h6 class="fw-500 my-0">{{$pksmitra->periode_tanam}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Provinsi</span>
															<h6 class="fw-500 my-0">{{$pksmitra->provinsi_id}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Kabupaten</span>
															<h6 class="fw-500 my-0">{{$pksmitra->kabupaten_id}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Kecamatan</span>
															<h6 class="fw-500 my-0">{{$pksmitra->kecamatan_id}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Desa/Kelurahan</span>
															<h6 class="fw-500 my-0">{{$pksmitra->kelurahan_id}}</h6>
														</li>
														<li class="list-group-item d-flex flex-row justify-content-between align-items-center">
															<span class="text-muted">Berkas PKS</span>
															<h6 class="fw-500 my-0">{{$pksmitra->berkas_pks}}</h6>
														</li>
													</ul>
                                                </div>
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

	

@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
@parent

<script>
$(document).ready(function() {
	var table = $('#tblPks').DataTable({
		responsive: true,
		lengthChange: false,
		dom:
		"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'<'select'>>>" + // Move the select element to the left of the datatable buttons
            "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
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
					text: '<i class="fa fa-calendar-alt"></i>',
					titleAttr: 'Select Period',
					className: 'btn btn-info btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.task.commitments.create') }}';
					}
				}]
			});

			// Get the unique values of the "Year" column
			var years = table.column(0).data().unique().sort();

			// Create the select element and add the options
			var select = $('<select>')
				.addClass('custom-select custom-select-sm col-3 mr-2')
				.on('change', function() {
					var year = $.fn.dataTable.util.escapeRegex($(this).val());
					table.column(0).search(year ? '^' + year + '$' : '', true, false).draw();
				});

			$('<option>').val('').text('Pilih Tahun').appendTo(select);

			$.each(years, function(i, year) {
				$('<option>').val(year).text(year).appendTo(select);
			});

			// Add the select element before the first datatable button
		$('.dt-buttons').before(select);
	});
</script>
@endsection