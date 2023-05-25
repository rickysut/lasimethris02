@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')

<div class="alert alert-warning ">
	<div class="d-flex flex-start w-100">
		<div class="mr-2 hidden-md-down">
			<span class="icon-stack icon-stack-lg">
				<i class="base base-7 icon-stack-3x opacity-100 color-warning-200"></i>
				{{-- <i class="base base-7 icon-stack-2x opacity-100 color-danger-300 fa-flip-vertical"></i> --}}
				<i class="fas fa-exclamation-circle icon-stack-1x opacity-100 color-warning"></i>
			</span>
		</div>
		<div class="d-flex flex-fill">
			<div class="flex-fill">
				<span class="h5">Perhatian!</span>
				<p>
					Halaman ini hanya ditujukan untuk <b>mendokumentasikan</b> berkas-berkas SKL yang telah terbit sebelum <b>periode tahun 2022</b>. Bukan untuk menerbitkan SKL.
				</p>
			</div>
		</div>
	</div>
</div>
@can('poktan_access')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Data SKL Lama
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<form method="POST" action="{{ route('admin.backdateskl.store')}}"
					enctype="multipart/form-data">
					@csrf
					<div class="panel-content">
						<div class="row d-flex justify-content between align-items-center">
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_lembaga">Nomor SKL</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="no_skl"><i class="fal fa-file-certificate"></i></span>
										</div>
										<input id="no_skl" name="no_skl" type="text" placeholder="" class="form-control"  required>
									</div>
									<div class="help-block">
										Nomor SKL.
									</div>
								</div>
							</div>
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_pimpinan">Nomor RIPH</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="nip"><i class="fal fa-file-invoice"></i></span>
										</div>
										<input id="no_ijin" name="no_ijin" type="text" placeholder="____/PP.240/D/__/____" data-inputmask="'mask': '9999/PP.240/D/99/9999'" class="form-control"  required>
									</div>
									<div class="help-block">
										Nomor RIPH.
									</div>
								</div>
							</div>
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_pimpinan">Periode RIPH</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="periode"><i class="fal fa-calendar"></i></span>
										</div>
										<input id="periode" name="periode" type="text" placeholder="20__" data-inputmask="'mask': '9999'" class="form-control"  required>
									</div>
									<div class="help-block">
										Nomor RIPH.
									</div>
								</div>
							</div>
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_pimpinan">Unggah Berkas SKL</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="berkas_skl"><i class="fal fa-upload"></i></span>
										</div>
										<input id="berkas_skl" name="berkas_skl" type="file" class="form-control" accept="pdf" required>
									</div>
									<div class="help-block">
										Unggah hasil pemindaian berkas SKL (pdf).
									</div>
								</div>
							</div>
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_pimpinan">Unggah Data Dukung</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="berkas_dukung"><i class="fal fa-upload"></i></span>
										</div>
										<input id="berkas_dukung" name="berkas_dukung" type="file" class="form-control" accept="pdf" required>
									</div>
									<div class="help-block">
										Unggah hasil pemindaian berkas data pendukung (pdf).
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="d-flex justify-content-end align-itmes-center">
							<div></div>
							<div>
								<button class="btn btn-primary btn-sm" role="button" type="submit">
									<i class="fal fa-save"></i>
									Simpan
								</button>
							</div>
						</div>
					</div>
                </form>
			</div>
		</div>
	</div>
</div>
@endcan
@endsection

@section('scripts')
@parent



@endsection