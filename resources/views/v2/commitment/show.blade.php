@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('commitment_show')
    {{-- {{ dd($data_poktan) }} --}}
    <div class="row">
		<div class="col-md-3">
			<div class="panel" id="panel-1">
				<div class="panel-hdr">
					<h2>Data Verifikasi</h2>
				</div>
				<div class="panel-container">
					<div class="panel-content">
						@switch($commitment->status)
							@case(1)
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Status</span>
										<span class="fw-500 text-info">Menunggu hasil review</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Tindakan</span>
										<span><i class="fal fa-hourglass fw-500 mr-1"></i>(menunggu)</span>
									</li>
								</ul>
								@break
							@case(2)
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Status</span>
										<span class="fw-500 text-success">Verifikasi Selesai & Sesuai</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Tindakan</span>
										<a href="#" class="btn btn-xs btn-success" data-toggle="tooltip"
											data-original-title="Ajukan Penerbitan Surat Keterangan Lunas">
											<i class="fal fa-badge-check"></i>
											Ajukan SKL
										</a>
									</li>
								</ul>
								@break
							@case(3)
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Status</span>
										<span class="fw-500 text-warning">Pengajuan Penerbitan SKL</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Tindakan</span>
										<span><i class="fal fa-hourglass fw-500 mr-1"></i>(menunggu)</span>
									</li>
								</ul>
								@break
							@case(4)
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Status</span>
										<span class="fw-500 text-primary">Review Pengajuan SKL</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Tindakan</span>
										<span><i class="fal fa-hourglass fw-500 mr-1"></i>(menunggu)</span>
									</li>
								</ul>
								@break
							@case(5)
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Status</span>
										<span class="fw-500 text-success">SKL diterbitkan</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Tindakan</span>
										<a href="#" class="btn btn-xs btn-success">
											<i class="fas fa-award"></i>
											Lihat SKL
										</a>
									</li>
								</ul>
								@break
							@default
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Status</span>
										<span class="fw-500 text-danger">Belum Mengajukan</span>
									</li>
									<li class="list-group-item">
										<a href="#" class="btn btn-xs btn-danger d-block"
											data-toggle="modal" data-target="#verifikasiModal">
											Ajukan Verifikasi
										</a>
									</li>
								</ul>
						@endswitch
					</div>
				</div>
			</div>
			<div class="panel" id="panel-1">
				<div class="panel-hdr">
					<h2>
						Data <span class="fw-300"><i>Basic</i></span>
					</h2>
					<div class="panel-toolbar">
					</div>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<ul class="list-group mb-3" style="word-break:break-word;">
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Perusahaan/Lembaga</span>
									<h6 class="fw-500 my-0">{{ $commitment->user->data_user->company_name }}</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Nomor RIPH</span>
									<h6 class="fw-500 my-0">{{ $commitment->no_ijin }}</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Tanggal Terbit</span>
									<h6 class="fw-500 my-0">{{ date('d/m/Y', strtotime($commitment->tgl_ijin)) }}</h6>
								</div>
								<div>
									<span class="text-muted">Tanggal Terbit</span>
									<h6 class="fw-500 my-0">{{ date('d/m/Y', strtotime($commitment->tgl_akhir)) }}</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Volume RIPH</span>
									<h6 class="fw-500 my-0">{{ number_format($commitment->volume_riph,2,',', '.') }} ton </h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Wajib Tanam</span>
									<h6 class="fw-500 my-0">{{ number_format($commitment->volume_riph*0.05/6,2,',', '.') }} ha</h6>
								</div>
								<div>
									<span class="text-muted">Wajib Produksi</span>
									<h6 class="fw-500 my-0">{{ number_format( $commitment->volume_riph*0.05,2,',', '.') }} ton</h6>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>
						DATA <span class="fw-300"><i>Perbenihan</i></span>
					</h2>
					<div class="panel-toolbar">
						@include('partials.globaltoolbar')
					</div>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<ul class="list-group mb-3">
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Kebutuhan Benih</span>
									<h6 class="fw-500 my-0"> {{ number_format($commitment->volume_riph*0.05/6*0.8,2,',', '.') }} ton</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Stok Mandiri</span>
									<h6 class="fw-500 my-0"> {{ number_format($commitment->stok_mandiri,2,',', '.') }} ton</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Beli dari Penangkar</span>
									<h6 class="fw-500 my-0"> {{ number_format($commitment->volume_riph*0.05/6*0.8-$commitment->stok_mandiri ,2,',', '.') }} ton</h6>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel" id="panel-3">
				<div class="panel-hdr">
					<h2>
						DATA <span class="fw-300"><i>Pengendalian</i></span>
					</h2>
					<div class="panel-toolbar">
						@include('partials.globaltoolbar')
					</div>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<ul class="list-group mb-3">
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Pupuk Organik</span>
									<h6 class="fw-500 my-0"> {{ number_format($commitment->organik,2,',', '.') }} kg</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Nitrogen Phosfor Kalium (NPK)</span>
									<h6 class="fw-500 my-0"> {{ number_format($commitment->npk,2,',', '.') }} kg</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Dolomit</span>
									<h6 class="fw-500 my-0">{{ number_format($commitment->dolomit,2,',', '.') }} kg</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Zwavelzure Amonium (ZA)</span>
									<h6 class="fw-500 my-0">{{ number_format($commitment->za,2,',', '.') }} kg</h6>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel" id="panel-4">
				<div class="panel-hdr">
					<h2>
						DATA <span class="fw-300"><i>Lainnya</i></span>
					</h2>
					<div class="panel-toolbar">
						@include('partials.globaltoolbar')
					</div>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<ul class="list-group mb-3">
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Saprodi Lainnya</span>
									<div class="d-flex justify-content-between">
										{{-- @isset($pullData['riph']['wajib_tanam']['mulsa']) --}}
											<h6 class="fw-500 my-0">Mulsa:&nbsp;</h6>
											<h6 class="fw-500 my-0"> kg</h6>    
										{{-- @endisset --}}
										
										
									</div>
								</div>
							</li>
							{{-- @isset($pullData['riph']['wajib_tanam']['bagi-hasil']) --}}
							<li class="list-group-item d-flex justify-content-between">
								<div>
									
									<span class="text-muted">Bagi Hasil (%)</span>
									<h6 class="fw-500 my-0">
										{{$commitment->poktan_share}} : {{$commitment->importir_share}}
									</h6>
									
								</div>
							</li>
							{{-- @endisset --}}
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="panel" id="panel-5">
				<div class="panel-hdr">
					<h2>
						Daftar <span class="fw-300"><i>Kelompoktani Mitra & PKS</i></span>
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
								<tr>
									<th>No. Perjanjian</th>
									<th>Poktan Mitra</th>
									<th>Rencana Kerja</th>
									<th>Tindakan</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($pksmitras as $pksmitra)
								<tr>
									<td>{{$pksmitra->no_pks}}</td>
									<td>{{$pksmitra->masterkelompok->nama_kelompok}}</td>
									<td>
										<div class="row">
											<div class="col-2">
												<i class="fal fa-ruler-combined"></i>
											</div>
											<div class="col-9">
												{{$pksmitra->luas_rencana}} ha
											</div>
										</div>
										<div class="row">
											<div class="col-2">
												<i class="fal fa-weight-hanging"></i>
											</div>
											<div class="col-9">
												{{$pksmitra->luas_rencana*6}} ton
											</div>
										</div>
									</td>
									<td>
										<a href="{{route('admin.task.pksmitra.show', $pksmitra->id)}}"
											title="Data Laporan Realisasi" class="btn btn-xs btn-icon btn-primary">
											<i class="fal fa-seedling"></i>
										</a>
										<a href="{{route('admin.task.pksmitra.edit', $pksmitra->id)}}"
											title="Edit/Ubah Data Perjanjian" class="btn btn-xs btn-icon btn-warning">
											<i class="fal fa-edit"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						
					</div>
					
				</div>
			</div>
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
						<table id="tblPenangkar" class="table table-sm table-bordered table-hover table-striped w-100">
							<thead>
								<th>Penangkar</th>
								<th>Pimpinan</th>
								<th>Varietas</th>
								<th>Ketersediaan</th>
							</thead>
							<tbody>
								@foreach ($penangkarmitras as $penangkarmitra)
								<tr>
									<td>
										<a href="javascript:void()" data-toggle="modal" class="fw-500"
											data-target="#editPenangkar{{$penangkarmitra->id}} ">
											{{$penangkarmitra->masterpenangkar->nama_lembaga}}
										</a>
									</td>
									<td> {{$penangkarmitra->masterpenangkar->nama_pimpinan}} </td>
									<td> {{$penangkarmitra->varietas}} </td>
									<td> {{$penangkarmitra->ketersediaan}} </td>
									
									{{-- Modal view Penangkar --}}
									<div class="modal fade" id="editPenangkar{{$penangkarmitra->id}}"
										tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-right" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<div>
														<h5 class="modal-title" id="myModalLabel">Data Penangkar 
															<span class="fw-500 text-info">
																{{$penangkarmitra->masterpenangkar->nama_lembaga}}
															</span>
														</h5>
														<small id="helpId" class="text-muted">
															Tambah Daftar Penangkar Benih berlabel
														</small>
													</div>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="panel" id="panel-2">
														<div class="panel-hdr">
															<h2>
																Daftar <span class="fw-300"><i>Penangkar Benih Mitra</i></span>
															</h2>
															<div class="panel-toolbar">
															</div>
														</div>
														<div class="panel-container show">
															<div class="panel-content">
																<ul class="list-group list-group-flush">
																	<li class="list-group-item d-flex justify-content-between align-items-center">
																		<span class="text-muted">Nama Lembaga</span>
																		<span class="fw-500">{{$penangkarmitra->masterpenangkar->nama_lembaga}}</span>
																	</li>
																	<li class="list-group-item d-flex justify-content-between align-items-center">
																		<span class="text-muted">Nama Pimpinan</span>
																		<span class="fw-500">{{$penangkarmitra->masterpenangkar->nama_pimpinan}}</span>
																	</li>
																	<li class="list-group-item d-flex justify-content-between">
																		<span class="text-muted">Kontak Pimpinan</span>
																		<span class="fw-500">{{$penangkarmitra->masterpenangkar->hp_pimpinan}}</span>
																	</li>
																	<li class="list-group-item d-flex justify-content-between row">
																		<span class="text-muted col-sm-3">Alamat</span>
																		<span class="fw-500 col-sm-9 text-right">
																			{{$penangkarmitra->masterpenangkar->alamat}}
																		</span>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="panel" id="panel-3">
														<div class="panel-hdr">
															<h2>
																Data <span class="fw-300"><i>Benih</i></span>
															</h2>
															<div class="panel-toolbar">
															</div>
														</div>
														<div class="panel-container show">
															<div class="panel-content">
																<ul class="list-group list-group-flush">
																	<li class="list-group-item d-flex justify-content-between align-items-center">
																		<span class="text-muted">Varietas</span>
																		<span class="fw-500">{{$penangkarmitra->varietas}}</span>
																	</li>
																	<li class="list-group-item d-flex justify-content-between align-items-center">
																		<span class="text-muted">Ketersediaan</span>
																		<span class="fw-500">{{$penangkarmitra->ketersediaan}}</span>
																	</li>
																</ul>
															</div>
														</div>
													</div>
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

	{{-- Modal Pengajuan Verifikasi --}}
	<div class="modal fade" id="verifikasiModal" tabindex="-1" role="dialog"
		aria-labelledby="verifikasiModal" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
				Pengajuan <span class="fw-300"><i>Verifikasi</i></span>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="alert alert-warning border-0 mb-0">
				<div class="d-flex align-item-center">
					<div class="alert-icon">
						<div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
							<i class="base base-7 icon-stack-3x opacity-100 color-warning-400"></i>
							<i class="base base-7 icon-stack-2x opacity-100 color-warning-900"></i>
							<i class="fa fa-exclamation icon-stack-1x opacity-100 color-white"></i>
						</div>
					</div>
					<div class="flex-1 help-block">
						<span><h5>Berikut ini adalah berkas-berkas yang <span class="fw-900 text-danger">HARUS Anda unggah </span>(salinan hasil pindai) sebagai syarat wajib pengajuan verifikasi. </h5></span>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<form action="{{ route('admin.task.commitment.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="form-group col">
							<label class="form-label h6">RIPH</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" name="formRiph" required>
								<label class="custom-file-label" for="formRiph">Pilih file...</label>
							</div>
							<span class="help-block">Surat Persetujuan RIPH. (.jpg / .pdf).</span>
						</div>
						<div class="form-group col">
							<label class="form-label h6">Form SPTJM</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" name="formSptjm" required>
								<label class="custom-file-label" for="formSptjm">Pilih file...</label>
							</div>
							<span class="help-block">Form Pertanggungjawaban Mutlak. (.jpg / .pdf).</span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label h6">Logbook</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" name="logBook" required>
								<label class="custom-file-label" for="logBook">Pilih file...</label>
							</div>
							<span class="help-block">Logbook. (.jpg / .pdf).</span>
						</div>
						<div class="form-group col">
							<label class="form-label h6">Form-RT</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" name="formRt" required>
								<label class="custom-file-label" for="formRt">Pilih file...</label>
							</div>
							<span class="help-block">Form Rencana Tanam. (.jpg / .pdf).</span>
						</div>        
					</div>
					
					<div class="row">
						<div class="form-group col">
							<label class="form-label h6">Form-RTA</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" name="formRta" required>
								<label class="custom-file-label" for="formRta">Pilih file...</label>
							</div>
							<span class="help-block">Form Realisasi tanam. (.jpg / .pdf).</span>
						</div>
						<div class="form-group col">
							<label class="form-label h6">Form RPO</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" name="formRpo" required>
								<label class="custom-file-label" for="formRpo">Pilih file...</label>
							</div>
							<span class="help-block">Form Realisasi Produksi. (.jpg / .pdf).</span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col">
							<label class="form-label h6">Form LA</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" name="formLa" required>
								<label class="custom-file-label" for="formLa">Pilih file...</label>
							</div>
							<span class="help-block">Form Laporan Akhir. (.jpg / .pdf).</span>
						</div>
						<div class="modal-footer col">
							<button type="button" class="btn btn-secondary align-bottom" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary align-bottom">Unggah</button>
						</div>    
					</div>
				</form>
				
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
					text: '<i class="fa fa-cart-plus"></i>',
					titleAttr: 'Tambah Penangkar Mitra',
					className: 'btn btn-info btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.task.commitments.penangkar', $commitment->id) }}';
					}
				}
			]
		});

	});
</script>

<script>
	$(document).ready(function()
	{
		
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
					text: '<i class="fa fa-signature"></i>',
					titleAttr: 'Buat Perjanjian Baru',
					className: 'btn btn-info btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.task.commitments.pksmitra', $commitment->id) }}';
					}
				}
			]
		});
	});
</script>
@endsection