@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')

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
				<form method="POST" action="{{ route('admin.backdateskl.update', $skl->id)}}"
					enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="panel-content">
						<div class="row d-flex justify-content between align-items-center">
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_lembaga">Nomor SKL</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="no_skl"><i class="fal fa-file-certificate"></i></span>
										</div>
										<input id="no_skl" name="no_skl" type="text" placeholder="" class="form-control"
											value="{{ old('no_skl', $skl->no_skl) }}" required>
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
										<input id="no_ijin" name="no_ijin" type="text" placeholder="____/PP.240/D/__/____" data-inputmask="'mask': '9999/PP.240/D/99/9999'" class="form-control" 
											value="{{ old('no_ijin', $skl->no_ijin) }}" required>
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
										<input id="periode" name="periode" type="text" placeholder="20__" data-inputmask="'mask': '9999'" value="{{ old('periode', $skl->periode) }}" class="form-control"  required>
									</div>
									<div class="help-block">
										Nomor RIPH.
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label h6">Unggah berkas SKL</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="berkas_skl" id="berkas_skl" value="{{ old('berkas_skl', $skl->berkas_skl) }}">
										<label class="custom-file-label {{ $skl->berkas_skl ? 'text-primary fw-400' : 'text-muted' }}" for="berkas_skl">
											{{ $skl->berkas_skl ? $skl->berkas_skl : 'Pilih file...' }}
										  </label>
									</div>
									<span class="help-block">
										@if($skl->berkas_skl)
											<a href="{{ asset('storage/arsip/backdateskl/'.$skl->berkas_skl) }}" target="_blank">
												Lihat Berkas SKL
											</a>
										@else
											Surat Persetujuan RIPH (.pdf).
										@endif
									</span>
								</div>
							</div>
							<div class="col-lg-6 mb-3">
								<div class="form-group">
									<label class="form-label h6">Unggah berkas data pendukung</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="berkas_dukung" id="berkas_dukung" value="{{ old('berkas_dukung', $skl->berkas_dukung) }}">
										<label class="custom-file-label {{ $skl->berkas_dukung ? 'text-primary fw-400' : 'text-muted' }}" for="berkas_dukung">
											{{ $skl->berkas_dukung ? $skl->berkas_dukung : 'Pilih file...' }}
										  </label>
									</div>
									<span class="help-block">
										@if($skl->berkas_dukung)
											<a href="{{ asset('storage/arsip/backdateskl/'.$skl->berkas_dukung) }}" target="_blank">
												Lihat Berkas data dukung
											</a>
										@else
											Berkas data pendukung (.pdf).
										@endif
									</span>
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