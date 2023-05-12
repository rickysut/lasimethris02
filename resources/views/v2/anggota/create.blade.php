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
					Data Anggota Baru
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<form method="POST" action="{{ route('admin.task.anggotapoktan.store') }}"
					enctype="multipart/form-data">
					@csrf
					<div class="panel-content">
						<input type="text" value="{{$poktan->id}}" id="master_kelompok_id" name="master_kelompok_id" hidden>
						<div class="col-12 mb-3">
							<div class="form-group">
								<label class="form-label" for="nama_petani">Nama Anggota</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="nama_petani"><i class="fal fa-user"></i></span>
									</div>
									<input type="text" class="form-control " id="nama_petani" name="nama_petani" placeholder="contoh: Ahmad Sobari" required>
								</div>
								<div class="help-block">
									Nama lengkap Anggota/Petani.
								</div>
							</div>
						</div>
						<div class="col-12 mb-3">
							<div class="form-group">
								<label class="form-label" for="nik_petani">NIK Anggota</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="nik_petani"><i class="fal fa-address-card"></i></span>
									</div>
									<input type="text" class="form-control " id="nik_petani" name="nik_petani" placeholder="contoh: 3101012205890001" required>
								</div>
								<div class="help-block">
									16 digit Nomor Induk Kependudukan/NIK (tanpa spasi/pemisah).
								</div>
							</div>
						</div>
						<div class="col-12 mb-3">
							<div class="form-group">
								<label class="form-label" for="luas_lahan">Luas Lahan (ha)</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="luas_lahan"><i class="fal fa-ruler-combined"></i></span>
									</div>
									<input type="number" step="0.01" class="form-control " id="luas_lahan" name="luas_lahan"
										required>
								</div>
								<div class="help-block">
									Luas lahan yang akan dikerjasamakan (dalam satuan ha/hektar).
								</div>
							</div>
						</div>
						<div class="col-12 mb-3">
							<div class="form-group">
								<label class="form-label" for="periode_tanam">Periode Tanam</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="periode_tanam"><i class="fal fa-calendar-week"></i></span>
									</div>
									<input type="text" class="form-control " id="periode_tanam" name="periode_tanam" placeholder="contoh: Jan-Feb">
								</div>
								<div class="help-block">
									Periode/Jadwal tanam.
								</div>
							</div>
						</div>
					</div>
					<div class="panel-content card-footer">
						<div class="d-flex justify-content-end">
							<div></div>
							<div>
								<a href="{{ route('admin.task.masterpoktan.listanggota', $poktan->id) }}" class="btn btn-warning btn-sm">
									<i class="fal fa-times-circle fw-500"></i> Batal
								</a>
								<button class="btn btn-primary btn-sm" type="submit">
									<i class="fal fa-save"></i> Tambahkan
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


</script>

@endsection

