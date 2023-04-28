@extends('layouts.admin')
@section('styles')


@endsection
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')
	@can('commitment_access')
		@include('partials.sysalert')
		<div class="row d-flex">
			<div class="col-12">
				<div id="panel-1" class="panel">
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row d-flex justify-content-between">
								<div class="form-group col-md-4">
									<label class="form-label" for="no_pengajuan">Nomor Pengajuan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="no_pengajuan"
											value="{{$verifikasi->no_pengajuan}}" disabled>
									</div>
									<span class="help-block">Nomor Pengajuan Verifikasi.</span>
								</div>
								<div class="form-group col-md-4">
									<label class="form-label" for="no_ijin">Nomor RIPH</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="no_ijin"
											value="{{$verifikasi->commitmentbackdate->no_ijin}}" disabled>
									</div>
									<span class="help-block">Nomor Pengajuan Verifikasi.</span>
								</div>
								<div class="form-group col-md-4">
									<label class="form-label" for="statusVerif">Tanggal Pengajuan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-calendar-day"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="created_at"
											value="{{$verifikasi->created_at}}" disabled>
									</div>
									<span class="help-block">Status Pemeriksaan</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card-deck">
					<div id="panel-2" class="panel card">
						<div class="panel-hdr">
							<h2>
								Lampiran<span class="fw-300"><i>Berkas PKS</i></span>
							</h2>
							<div class="panel-toolbar">
								@include('partials.globaltoolbar')
							</div>
						</div>
						@if ($pksmitra->berkas_pks)
							<div class="panel-container show card-body embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item"
									src="{{ url('storage/docs/' . $commitment->periodetahun . '/commitment_'.$commitment->id.'/pks/'.$pksmitra->berkas_pks) }}" width="100%" frameborder="0">
								</iframe>
							</div>
						@else
							<div class="panel-container show">
								<div class="panel-content text-center">
									<h3 class="text-danger">Tidak ada berkas dilampirkan</h2>
								</div>
							</div>
						@endif
					</div>
					<div class="col">
						<div class="panel" id="panel-3">
							<div class="panel-hdr">
								<h2>
									Data Perjanjian<span class="fw-300"><i>Kerjasama</i></span>
								</h2>
								<div class="panel-toolbar">
									@include('partials.globaltoolbar')
								</div>
							</div>
							<div class="panel-container show">
								<div class="panel-content">
									<ul class="list-group">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Nomor Perjanjian</span>
											<span class="fw-500">
												<i class="fas fa-file-invoice mr-1"></i>
												{{$pksmitra->no_perjanjian}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Kelompoktani</span>
											<span class="fw-500">
												<i class="fas fa-users mr-1"></i>
												{{$pksmitra->masterkelompok->nama_kelompok}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Berlaku sejak</span>
											<span class="fw-500">
												<i class="fa fa-calendar-plus mr-1"></i>
												{{$pksmitra->tgl_perjanjian_start}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Berakhir pada</span>
											<span class="fw-500">
												<i class="fas fa-calendar-check mr-1"></i>
												{{$pksmitra->tgl_perjanjian_end}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Luas Rencana</span>
											<span class="fw-500">
												<i class="fas fa-ruler-combined mr-1"></i>
												{{$pksmitra->luas_rencana}} ha
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Lokasi Perjanjian</span>
											<span class="fw-500 text-right">
												<div class="row flex-column text-uppercase">
													<span>Desa/Kel. {{$pksmitra->desa->nama_desa}} - Kec. {{$pksmitra->kecamatan->nama_kecamatan}}</span>
													<span>{{$pksmitra->kabupaten->nama_kab}} - {{$pksmitra->provinsi->nama}}</span>
												</div>
											</span>
										</li>
									</ul>
									<p></p>
								</div>
							</div>
						</div>
						<div class="panel" id="panel-4">
							<div class="panel-hdr">
								<h2>
									Hasil<span class="fw-300"><i>Pemeriksaan</i></span>
								</h2>
								<div class="panel-toolbar">
									@include('partials.globaltoolbar')
								</div>
							</div>
							<form action="{{route('admin.task.verifikasiv2.online.pks.store')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="panel-container show">
									<div class="panel-content">
										<input type="text" name="pksmitra_id" value="{{$pksmitra->id}}" hidden>
										<input type="text" name="verifcommit_id"
											value="{{$verifcommit->id}}" hidden>
										<input type="text" name="pengajuan_id" value="{{$verifikasi->id}}" hidden>
										<div class="row d-flex align-items-center justify-content-between mb-3">
											<div class="form-group col-md-6">
												<label for="">Hasil Pemeriksaan Berkas</label>
												<select type="text" id="docstatus" name="docstatus" class="form-control form-control-sm" required>
													<option hidden value="">- pilih status dokumen</option>
													<option value="Sesuai">
														Sesuai
													</option>
													<option value="Tidak Sesuai">
														Tidak Sesuai
													</option>
												</select>
												<small id="helpId" class="text-muted">Berikan status hasil pemeriksaan.</small>
											</div>
											<div class="form-group col-md-6">
												<label for="">Status Pemeriksaan</label>
												<select type="text" id="status" name="status" class="form-control form-control-sm" required>
													<option hidden value="">- pilih status periksa</option>
													<option value="Selesai">
														Selesai
													</option>
												</select>
												<small id="helpId" class="text-muted">Berikan status hasil pemeriksaan.</small>
											</div>
											<div class="form-group col-sm-12">
												<label for="">Catatan Pemeriksaan</label>
												<textarea class="form-control form-control-sm" name="note" id="note" rows="5" required></textarea>
												<small id="helpId" class="text-muted">Berikan catatan hasil pemeriksaan.</small>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="form-group">
										<label class="form-label h6">Konfirmasi</label>
										<div class="input-group">
											<input type="text" class="form-control form-control-sm" placeholder="ketik username Anda di sini" id="validasi" name="validasi"required>
											<div class="input-group-append">
												<a class="btn btn-sm btn-warning" href="" role="button"><i class="fal fa-times text-align-center mr-1"></i> Batalkan</a>
											</div>
											<div class="input-group-append">
												<button class="btn btn-sm btn-primary" type="submit" onclick="return validateInput()">
													<i class="fas fa-upload text-align-center mr-1"></i>Simpan
												</button>
											</div>
										</div>
										<span class="help-block">Dengan ini kami menyatakan verifikasi pada bagian ini telah SELESAI.</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endcan
@endsection

@section('scripts')
	@parent
	<script>
		function validateInput() {
			// get the input value and the current username from the page
			var inputVal = document.getElementById('validasi').value;
			var currentUsername = '{{ Auth::user()->username }}';
			
			// check if the input is not empty and matches the current username
			if (inputVal !== '' && inputVal === currentUsername) {
				return true; // allow form submission
			} else {
				alert('Isi kolom dengan username Anda!.');
				return false; // prevent form submission
			}
		}
	</script>
@endsection
