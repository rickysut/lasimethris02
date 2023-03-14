@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/miscellaneous/lightgallery/lightgallery.bundle.css') }}">
@endsection
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('commitment_show')
	<div class="row">
		<div class="col-md-12">
			<div class="panel" id="panel-1">
				<div class="panel-hdr">
					<h2>
						Data <span class="fw-300"><i>Geolokasi</i></span>
					</h2>
					<div class="panel-toolbar">
                        <button class="btn btn-xs btn-info mr-1" type="button"
							data-toggle="modal" data-target=".upload-modal-right" disabled>
                            <a data-toggle="tooltip" data-offset="0,1"
								title data-original-title="Unggah data tunggal untuk lokasi tanam ini.">
								<i class="fas fa-upload"></i> Unggah Berkas
							</a>
                        </button>
						<div class="panel-toolbar">
							@include('partials.globaltoolbar')
						</div>
                    </div>
				</div>
				<div class="panel-container show">
					<form action="{{route('admin.task.anggotamitra.update', $anggotamitras->id)}}"
					method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
						<input type="hidden" name="form_action" value="form1">
						{{-- <input type="text" name="id" value="{{$anggotamitras->id}}">
						<input type="text" name="pks_mitra_id" value="{{$anggotamitras->id}}">
						<input type="text" name="commitmentbackdate_id" value="{{$commitment->id}}">
						<input type="text" name="no_ijin" value="{{$commitment->no_ijin}}">
						<input type="text" name="master_anggota_id" value="{{$anggotamitras->master_anggota_id}}"> --}}
						<div class="panel-content card-header">
							<div class="row">
								<div class="form-group col-md-12">
									<label class="form-label" for="gmap">Buat Peta Polygon bidang lahan dari lokasi yang dipilih<sup class="text-danger"> *</sup></label>
									<iframe id="gmap" src="https://www.google.com/maps/d/embed?mid=1sTXQ7FGmyNhF9ROGa2ZRtQxwu0Jp48o&ehbc=2E312F" width="100%" height="300px"></iframe>
									<span class="help-block">Keterangan cara menentukan titik lokasi dan membuat polygon</span>
								</div>
							</div>
						</div>
						<div class="panel-content">
							<div class="row">
								<div class="form-group col-md-3">
									<label>Nama Lokasi <sup class="text-danger"> **</sup></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fal fa-map-signs"></i></span>
										</div>
										<input type="text" value="{{ old('nama_lokasi', $anggotamitras->nama_lokasi) }}"
											name="nama_lokasi" id="nama_lokasi"
											class="font-weight-bold form-control form-control-sm bg-white" />
									</div>
									<span class="help-block">berikan Nama/ID untuk lokasi ini.</span>
								</div>
								<div class="form-group col-md-3">
									<label>Latitude <sup class="text-info"> *</sup></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fal fa-map-marker"></i></span>
										</div>
										<input type="text" value="{{ old('latitude', $anggotamitras->latitude) }}"
											name="latitude" id="latitude" readonly
											class="disabled font-weight-bold form-control form-control-sm bg-white" />
									</div>
									<span class="help-block">Koordinat Lintang lokasi</span>
								</div>
								<div class="form-group col-md-3">
									<label>Longitude <sup class="text-info"> *</sup></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fal fa-map-marker-alt"></i></span>
										</div>
										<input type="text" value="{{ old('longitude', $anggotamitras->longitude) }}"
											name="longitude" id="longitude" readonly
											class="disabled font-weight-bold form-control form-control-sm bg-white" />
									</div>
									<span class="help-block">Koordinat Bujur lokasi</span>
								</div>
								<div class="form-group col-3">
									<label>Altitude (mdpl) <sup class="text-danger"> **</sup></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fal fa-ruler-vertical"></i></span>
										</div>
										<input type="text" value="{{ old('altitude', $anggotamitras->altitude) }}"
											name="altitude" id="altitude"
											class="font-weight-bold form-control form-control-sm bg-white" />
									</div>
									<span class="help-block">Ketinggian lokasi lahan (rerata ketinggain dpl)</span>
								</div>
								<div class="form-group col-md-7">
									<label>Polygon<sup class="text-info"> *</sup></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fal fa-draw-polygon"></i></span>
										</div>
										<input type="text" value="{{ old('polygon', $anggotamitras->polygon) }}"
										name="polygon" id="polygon" readonly
										class="disabled font-weight-bold form-control form-control-sm bg-white" />
									</div>
									<span class="help-block">Kurva bidang lahan yang ditanami.</span>
								</div>
								<div class="form-group col-md-5">
									<label>Luas Perkiraan (ha)<sup class="text-info"> *</sup></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fal fa-ruler-combined"></i></span>
										</div>
										<input type="text" value="{{ old('luas_kira', $anggotamitras->luas_kira) }}"
											name="luas_kira" id="luas_kira" readonly
											class="disabled font-weight-bold form-control form-control-sm bg-white" />
									</div>
									<span class="help-block">Luas bidang diukur oleh sistem.</span>
								</div>
							</div>
							<div class="mt-5">
								<span class="small mr-3"><span class="text-info mr-1"> *</span>: Autogenerate by System</span>
								<span class="small"><span class="text-danger mr-1"> **</span>: Wajib diisi</span>
							</div>
						</div>
						<div class="card-footer">
							<div class="justify-content-end">
								<a href="{{route('admin.task.pksmitra.show', $anggotamitras->pks_mitra_id)}}"
									class="btn btn-sm btn-info" role="button">
									<i class="fa fa-door-open mr-1"></i>Kembali
								</a>
								<button class="btn btn-sm btn-primary" role="button" type="submit">
									<i class="fa fa-save mr-1"></i>Simpan
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>Realisasi Wajib Tanam</h2>
					<div class="panel-toolbar">
						<button class="btn btn-xs btn-info mr-1" type="button"
							data-toggle="modal" data-target="#modalTanam">
							<i class="fas fa-upload"></i> Dokumentasi
						</button>
					</div>
				</div>
				<div class="panel-container show">
					<form action="{{route('admin.task.anggotamitra.update', $anggotamitras->id)}}"
						method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<input type="hidden" name="form_action" value="form2">
						<div class="panel-content">
							<div class="row mb-3">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-label" for="tgl_tanam">Tanggal Tanam</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
												</div>
												<input type="date" value="{{ old('tgl_tanam', $anggotamitras->tgl_tanam) }}"
													name="tgl_tanam" id="tgl_tanam"
													class="font-weight-bold form-control form-control-sm bg-white" />
											</div>
											<span class="help-block">Tanggal mulai penanaman.</span>
										</div>
										<div class="form-group col-md-6">
											<label for="luas_tanam">Luas Bidang (ha)<sup class="text-danger"> *</sup></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fal fa-ruler-combined"></i></span>
												</div>
												<input type="number" value="{{ old('luas_tanam', $anggotamitras->luas_tanam) }}"
													name="luas_tanam" id="luas_tanam"
													class="font-weight-bold form-control form-control-sm bg-white" />
											</div>
											<span class="help-block">Luas area lahan diukur mandiri.</span>
										</div>
										<div class="form-group col-md-12">
											<label>Varietas yang ditanam <sup class="text-danger"> *</sup></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fal fa-seedling"></i></span>
												</div>
												<input type="text" value="{{ old('varietas', $anggotamitras->varietas) }}"
													name="varietas" id="varietas"
													class="font-weight-bold form-control form-control-sm bg-white" />
											</div>
											<span class="help-block">Realisasi Varietas yang ditanam.</span>
										</div>
									</div>
								</div>
							</div>
							<div>
								<label class="form-label" for="tgl_prod">Dokumentasi Tanam</label>
								<div id="js-galleryTanam">
									<a class="" href="{{asset('img/demo/gallery/16.jpg')}}" data-sub-html="nama berkas">
										<img class="img-responsive" src="{{asset('img/demo/gallery/thumb/16.jpg')}}" alt="nama berkas">
									</a>
									<a class="" href="{{asset('img/demo/gallery/16.jpg')}}" data-sub-html="nama berkas">
										<img class="img-responsive" src="{{asset('img/demo/gallery/thumb/28.jpg')}}" alt="nama berkas">
									</a>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="justify-content-end">
								<a href="{{route('admin.task.pksmitra.show', $anggotamitras->pks_mitra_id)}}"
									class="btn btn-sm btn-info" role="button">
									<i class="fa fa-door-open mr-1"></i>Kembali
								</a>
								@include('components.save', ['buttonText' => 'Click me'])
								<button class="btn btn-sm btn-primary" role="button" type="submit">
									<i class="fa fa-save mr-1"></i>Simpan
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>Realisasi Wajib Produksi</h2>
					<div class="panel-toolbar">
						<button class="btn btn-xs btn-info mr-1" type="button"
							data-toggle="modal" data-target="#modalProduksi">
							<i class="fas fa-upload"></i> Dokumentasi
						</button>
					</div>
				</div>
				<div class="panel-container show">
					<form action="{{route('admin.task.anggotamitra.update', $anggotamitras->id)}}"
						method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<input type="hidden" name="form_action" value="form4">
						<div class="panel-content">
							<div class="row mb-3">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group col-md-12">
											<label class="form-label" for="tgl_panen">Tanggal Panen</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
												</div>
												<input type="date" value="{{ old('tgl_panen', $anggotamitras->tgl_panen) }}"
													name="tgl_panen" id="tgl_panen"
													class="font-weight-bold form-control form-control-sm bg-white" />
											</div>
											<span class="help-block">Tanggal mulai penanaman.</span>
										</div>
										<div class="form-group col-md-12">
											<label for="luas_tanam">Volume Produksi (ton)<sup class="text-danger"> *</sup></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fal fa-ruler-combined"></i></span>
												</div>
												<input type="number" value="{{ old('volume', $anggotamitras->volume) }}"
													name="volume" id="volume"
													class="font-weight-bold form-control form-control-sm bg-white" />
											</div>
											<span class="help-block">Luas area lahan diukur mandiri.</span>
										</div>
									</div>
								</div>
							</div>
							<div>
								<label class="form-label" for="tgl_prod">Dokumentasi Produksi</label>
								<div id="js-galleryProduksi">
									<a class="" href="{{asset('img/demo/gallery/16.jpg')}}" data-sub-html="nama berkas">
										<img class="img-responsive" src="{{asset('img/demo/gallery/thumb/16.jpg')}}" alt="nama berkas">
									</a>
									<a class="" href="{{asset('img/demo/gallery/16.jpg')}}" data-sub-html="nama berkas">
										<img class="img-responsive" src="{{asset('img/demo/gallery/thumb/28.jpg')}}" alt="nama berkas">
									</a>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="justify-content-end">
								<a href="{{route('admin.task.pksmitra.show', $anggotamitras->pks_mitra_id)}}"
									class="btn btn-sm btn-info" role="button">
									<i class="fa fa-door-open mr-1"></i>Kembali
								</a>
								<button class="btn btn-sm btn-primary" role="button" type="submit">
									<i class="fa fa-save mr-1"></i>Simpan
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- modal upload berkas-foto tanam --}}
	<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalTanam">
		<div class="modal-dialog modal-dialog-right">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4"><i class="subheader-icon fas fa-upload text-info"></i> Unggah Berkas Pendukung</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
				</div>
				<div class="alert alert-danger border-0 mb-0">
					<div class="d-flex align-item-center">
						<div class="alert-icon">
							<div class="icon-stack icon-stack-sm mr-3 flex-shrink-0" style="font-size: 20px;">
								<i class="base base-7 icon-stack-3x opacity-100 color-danger-400"></i>
								<i class="base base-7 icon-stack-2x opacity-100 color-danger-800"></i>
								<i class="fa fa-exclamation icon-stack-1x opacity-100 color-white"></i>
							</div>
						</div>
						<div class="flex-1">
							<span><span class="fw-700">PERHATIAN!. </span> Unggahan ini akan menggantikan berkas unggahan terdahulu.</span>
						</div>
					</div>
				</div>
				<form action="{{route('admin.task.anggotamitra.update', $anggotamitras->id)}}"
					method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="modal-body">
						<input type="hidden" name="form_action" value="form3">
						<div class="form-group">
							<label class="form-label">Dokumen Pendukung</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" id="customControlValidation7"
									value="{{ old('tanam_doc', $anggotamitras->tanam_doc) }}"
									name="tanam_doc" id="tanam_doc">
								<label class="custom-file-label" for="customControlValidation7">Choose file...</label>
							</div>
							<span class="help-block">Unggah Dokumen Pendukung. Ekstensi pdf ukuran maks 4mb.</span>
						</div>
						<div class="form-group">
							<label class="form-label">Dokumentasi Tanam</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" id="customControlValidation7"
									value="{{ old('tanam_pict', $anggotamitras->tanam_pict) }}"
									name="tanam_pict" id="tanam_pict">
								<label class="custom-file-label" for="customControlValidation7">Choose file...</label>
							</div>
							<span class="help-block">Unggah Dokumentasi Tanam. Ekstensi jpg ukuran maks 4mb.</span>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-sm btn-info waves-effect waves-themed" type="submit"><i class="fal fa-save mr-1"></i>Unggah</button>
						<button class="btn btn-sm btn-warning waves-effect waves-themed"><i class="fal fa-undo mr-1"></i>Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- modal upload berkas foto produksi --}}
	<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalProduksi">
		<div class="modal-dialog modal-dialog-right">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4"><i class="subheader-icon fas fa-upload text-info"></i> Unggah Berkas Pendukung</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
				</div>
				<div class="alert alert-danger border-0 mb-0">
					<div class="d-flex align-item-center">
						<div class="alert-icon">
							<div class="icon-stack icon-stack-sm mr-3 flex-shrink-0" style="font-size: 20px;">
								<i class="base base-7 icon-stack-3x opacity-100 color-danger-400"></i>
								<i class="base base-7 icon-stack-2x opacity-100 color-danger-800"></i>
								<i class="fa fa-exclamation icon-stack-1x opacity-100 color-white"></i>
							</div>
						</div>
						<div class="flex-1">
							<span><span class="fw-700">PERHATIAN!. </span> Unggahan ini akan menggantikan berkas unggahan terdahulu.</span>
						</div>
					</div>
				</div>
				<form action="{{route('admin.task.anggotamitra.update', $anggotamitras->id)}}"
					method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="modal-body">
						<input type="hidden" name="form_action" value="form5">
						<div class="form-group">
							<label class="form-label">Dokumen Pendukung</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" id="customControlValidation7"
									value="{{ old('panen_doc', $anggotamitras->panen_doc) }}"
									name="panen_doc" id="panen_doc">
								<label class="custom-file-label" for="customControlValidation7">Choose file...</label>
							</div>
							<span class="help-block">Unggah Dokumen Pendukung. Ekstensi pdf ukuran maks 4mb.</span>
						</div>
						<div class="form-group">
							<label class="form-label">Dokumentasi Produksi</label>
							<div class="custom-file input-group">
								<input type="file" class="custom-file-input" id="customControlValidation7"
									value="{{ old('panen_pict', $anggotamitras->panen_pict) }}"
									name="panen_pict" id="panen_pict">
								<label class="custom-file-label" for="customControlValidation7">Choose file...</label>
							</div>
							<span class="help-block">Unggah Dokumentasi Tanam. Ekstensi jpg ukuran maks 4mb.</span>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-sm btn-info waves-effect waves-themed" type="submit"><i class="fal fa-save mr-1"></i>Unggah</button>
						<button class="btn btn-sm btn-warning waves-effect waves-themed"><i class="fal fa-undo mr-1"></i>Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	

@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
<script src="{{ asset('js/miscellaneous/lightgallery/lightgallery.bundle.js') }}"></script>
@parent
<!-- gallery Tanam -->
<script>
    $(document).ready(function() {
        var $initScope = $('#js-galleryTanam');
        if ($initScope.length) {
            $initScope.justifiedGallery({
                border: -1,
                rowHeight: 75,
                margins: 8,
                waitThumbnailsLoad: true,
                randomize: false,
            }).on('jg.complete', function() {
                $initScope.lightGallery({
                    thumbnail: true,
                    animateThumb: true,
                    showThumbByDefault: true,
                });
            });
        };
        $initScope.on('onAfterOpen.lg', function(event) {
            $('body').addClass("overflow-hidden");
        });
        $initScope.on('onCloseAfter.lg', function(event) {
            $('body').removeClass("overflow-hidden");
        });
    });
</script>
<!-- gallery Tanam -->
<!-- gallery Tanam -->
<script>
    $(document).ready(function() {
        var $initScope = $('#js-galleryProduksi');
        if ($initScope.length) {
            $initScope.justifiedGallery({
                border: -1,
                rowHeight: 75,
                margins: 8,
                waitThumbnailsLoad: true,
                randomize: false,
            }).on('jg.complete', function() {
                $initScope.lightGallery({
                    thumbnail: true,
                    animateThumb: true,
                    showThumbByDefault: true,
                });
            });
        };
        $initScope.on('onAfterOpen.lg', function(event) {
            $('body').addClass("overflow-hidden");
        });
        $initScope.on('onCloseAfter.lg', function(event) {
            $('body').removeClass("overflow-hidden");
        });
    });
</script>
<!-- gallery Tanam -->
@endsection