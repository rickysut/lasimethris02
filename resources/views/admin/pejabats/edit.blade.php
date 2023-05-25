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
					Data Pejabat
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<form method="POST" action="{{ route('admin.pejabat.update', $pejabat->id)}}"
					enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="panel-content">
						<div class="row d-flex justify-content between align-items-center">
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama">Nama Pejabat</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fal fa-user-tie"></i></span>
										</div>
										<input type="text" class="form-control" id="nama" name="nama" placeholder="Prof. DR. Ir. H. Muhammad Subardi, SH, MSc." required value="{{ old('nama', $pejabat->nama) }}">
									</div>
									<div class="help-block">
										Nama lengkap beserta titel yang disandang.
									</div>
								</div>
							</div>
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="nip">Nomor Induk Pegawai</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fal fa-address-card"></i></span>
										</div>
										<input type="text" class="form-control " id="nip" name="nip" placeholder="" data-inputmask="'mask': '999999999999999999'" value="{{ old('nip', $pejabat->nip) }}" required>
									</div>
									<div class="help-block">
										NIP (Nomor Induk Pegawai) Pejabat.
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-label h6">Contoh Tandatangan</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="ttd" id="ttd" value="{{ old('ttd', $pejabat->ttd) }}">
										<label class="custom-file-label {{ $pejabat->ttd ? 'text-primary fw-400' : 'text-muted' }}" for="ttd">
											{{ $pejabat->ttd ? $pejabat->ttd : 'Pilih file...' }}
										  </label>
									</div>
									<span class="help-block">
										@if($pejabat->ttd)
											<a href="{{ url('storage/arsip/pejabat/'.$pejabat->ttd) }}" target="_blank">
												Lihat contoh tandatangan
											</a>
										@else
											Hasil pemindaian contoh tandatangan (jpg).
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
<script src="{{ asset('js/smartadmin/formplugins/inputmask/inputmask.bundle.js') }}"></script>
@parent

<script>
	$(document).ready(function()
	{
		$(":input").inputmask();
	});

</script>
@endsection