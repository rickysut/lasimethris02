@extends('layouts.admin')

@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('commitment_show')
	<div class="row">
		<div class="col">
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>
						Data Perjanjian<span class="fw-300"><i>Kerjasama</i></span>
					</h2>
					<div class="panel-toolbar">
						<span class="mr-1">RIPH Nomor:</span>
							<a href="{{route('admin.task.commitments.show', $pksmitra->commitmentbackdate_id)}}"
								class="fw-500">
								{{$commitment->no_ijin}}
							</a>
						<span>
					</div>
				</div>
				<form action=" {{route('admin.task.pksmitra.update', $pksmitra->id)}} "
					method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row d-flex">
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="no_perjanjian">Nomor Perjanjian</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="no_perjanjian">123</span>
											</div>
											<input type="text" class="form-control " id="no_perjanjian" name="no_perjanjian"
												value="{{ old('no_perjanjian', $pksmitra->no_perjanjian) }}" required>
										</div>
										<div class="help-block">
											Nomor Pejanjian Kerjasama dengan Poktan Mitra.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="master_kelompok_id">Kelompoktani - Pimpinan</label>
										<div class="input-group">
											<select class="form-control custom-select selecteditpoktan"
											name="master_kelompok_id" id="master_kelompok_id" required>
												<option value="{{ isset($pksmitra) ? $pksmitra->masterkelompok->id : '' }}">
													{{ isset($pksmitra) ? $pksmitra->masterkelompok->id. ' . ' . 
													$pksmitra->masterkelompok->nama_kelompok . ' - ' . 
													$pksmitra->masterkelompok->nama_pimpinan : 'Load Record' }}
												</option>
												@foreach ($masterkelompoks as $poktan)
													<option value="{{$poktan->id}}">
														{{$poktan->id}}. {{$poktan->nama_kelompok}} - {{$poktan->nama_pimpinan}}
													</option>
												@endforeach
											</select>
										</div>
										<div class="help-block">
											Kelompoktani Mitra pelaksanaan wajib tanam-produksi sesuai dokumen PKS.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label">Tanggal perjanjian</label>
										<div class="input-daterange input-group" id="tgl_perjanjian_start" name="tgl_perjanjian_start">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
											</div>
											<input type="text" name="tgl_perjanjian_start" id="tgl_perjanjian_start"
												value="{{ old('tgl_perjanjian_start', $pksmitra->tgl_perjanjian_start) }}"
												class="form-control " placeholder="tanggal mulai perjanjian"
												aria-describedby="helpId">
										</div>
										<div class="help-block">
											Pilih Tanggal perjanjian ditandatangani.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label">Tanggal berakhir perjanjian</label>
										<div class="input-daterange input-group" id="tgl_perjanjian_end" name="tgl_perjanjian_end">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
											</div>
											<input type="text" name="tgl_perjanjian_end" id="tgl_perjanjian_end"
												value="{{ old('tgl_perjanjian_end', $pksmitra->tgl_perjanjian_end) }}"
												class="form-control " placeholder="tanggal akhir perjanjian"
												aria-describedby="helpId">
										</div>
										<div class="help-block">
											Pilih Tanggal berakhirnya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="simpleinputInvalid">Luas Rencana (ha)</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend3"><i class="fal fa-ruler"></i></span>
											</div>
											<input type="number" class="form-control " name="luas_rencana" id="luas_rencana"
											value="{{ old('luas_rencana', $pksmitra->luas_rencana) }}">
										</div>
										<div class="help-block">
											Jumlah Luas total sesuai dokumen perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="varietas_tanam">Varietas Tanam</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="varietas_tanam"><i class="fal fa-seedling"></i></span>
											</div>
											<input type="text" class="form-control " name="varietas_tanam" id="varietas_tanam"
												placeholder="varietas yang akan ditanam"
												value="{{ old('varietas_tanam', $pksmitra->varietas_tanam) }}">
										</div>
										<div class="help-block">
											Varietas ditanam sesuai dokumen perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="periode">Periode Tanam</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="varietas"><i class="fal fa-calendar-week"></i></span>
											</div>
											<input type="text" name="periode_tanam" id="periode_tanam"
												class="form-control " placeholder="misal: Jan-Feb"
												value="{{ old('periode_tanam', $pksmitra->periode_tanam) }}"
												aria-describedby="helpId">
										</div>
										<div class="help-block">
											Periode tanam sesuai dokumen perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="provinsi">Provinsi</label>
										<div class="input-group">
											<select class="select2-prov form-control" id="provinsi_id" name="provinsi_id" required>
												<option value="{{ isset($pksmitra) ? $pksmitra->provinsi_id : '' }}">
													{{ isset($pksmitra->provinsi) ? $pksmitra->provinsi->nama : '' }}
												</option>												
												@foreach ($provinsis as $provinsi)
													<option value="{{$provinsi->provinsi_id}}">
														{{$provinsi->provinsi_id}} - {{$provinsi->nama}}
													</option>
												@endforeach
											</select>
										</div>
										<div class="help-block">
											Provinsi tempat terjadinya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="kabupaten">Kabupaten/Kota</label>
										<div class="input-group">
											<select class="select2-kab form-control" id="kabupaten_id" name="kabupaten_id" required>
												<option value="{{ isset($pksmitra) ? $pksmitra->kabupaten_id : '' }}">
													{{ isset($pksmitra->kabupaten_id) ? $pksmitra->kabupaten->nama_kab : '' }}
												</option>
											</select>
										</div>
										<div class="help-block">
											Pilih Kabupaten tempat terjadinya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="kecamatan">Kecamatan</label>
										<div class="input-group">
											<select class="select2-kec form-control" id="kecamatan_id" name="kecamatan_id" required>
												<option value="{{ isset($pksmitra) ? $pksmitra->kecamatan_id : '' }}">
													{{ isset($pksmitra->kecamatan_id) ? $pksmitra->kecamatan->nama_kecamatan : '' }}
												</option>
											</select>
										</div>
										<div class="help-block">
											Pilih Kecamatan tempat terjadinya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="desa_id">Desa</label>
										<div class="input-group">
											<select class="select2-des form-control" name="kelurahan_id" id="kelurahan_id" required>
												<option value="{{ isset($pksmitra) ? $pksmitra->kelurahan_id : '' }}">
													{{ isset($pksmitra->kelurahan_id) ? $pksmitra->desa->nama_desa : '' }}
												</option>
											</select>
										</div>
										<div class="help-block">
											Pilih Desa tempat terjadinya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Unggah Berkas PKS (Perjanjian Kerjasama</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="inputGroupPrepend3">PKS</span>
										</div>
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="attachment" name="attachment">
											<label class="custom-file-label" for="attachment">Choose file...</label>
										</div>
									</div>
									<div class="help-block">Unggah hasil pemindaian berkas Form-5 dalam bentuk pdf.</div>
								</div>
								<div class="col-md-6 mb-3">
									<div>&nbsp;</div>
									<div class="d-flex flex-row align-items-center mt-1 mb-1">
										<div class="mr-2 d-inline-block">
											<a class="btn btn-outline-danger btn-icon rounded-circle waves-effect waves-themed"
												href="{{ url('storage/docs/pks/' . $pksmitra->berkas_pks) }}" data-toggle="button">
												@if(in_array(pathinfo($pksmitra->berkas_pks, PATHINFO_EXTENSION), [
													'doc', 'docx', 'xls','xlsx', 'pdf']))
													<i class="fal fa-file fs-md"></i>
												@elseif(in_array(pathinfo($pksmitra->berkas_pks, PATHINFO_EXTENSION), ['zip', 'rar']))
													<i class="fal fa-file-zip fs-md"></i>
												@elseif(in_array(pathinfo($pksmitra->berkas_pks, PATHINFO_EXTENSION), [
													'jpg', 'jpeg', 'png', 'gif']))
													<i class="fal fa-file-image fs-md"></i>
												@else
													<i class="fal fa-file fs-md"></i>
												@endif
											</a>
										</div>
										<div class="info-card-text">
											<a href="{{ url('storage/docs/pks/' . $pksmitra->berkas_pks) }}"
												class="fs-lg text-truncate text-truncate-md">
												{{ $pksmitra->berkas_pks }}
											</a>
											<span class="text-truncate text-truncate-lg opacity-80">Lampiran Berkas Perjanjian.</span>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="col-md-4 ml-auto text-right">
							<a href="{{route('admin.task.commitments.show', $commitment->id)}}" class="btn btn-warning btn-sm">
								<i class="fal fa-undo mr-1"></i>Batal
							</a>
							<button class="btn btn-primary btn-sm" type="submit">
								<i class="fal fa-save mr-1"></i>Simpan Perubahan
							</button>
						</div>
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
            $(".select2-prov").select2({
                placeholder: "--pilih Provinsi"
            });
            $(".select2-kab").select2({
                placeholder: "--pilih Kabupaten"
            });
            $(".select2-kec").select2({
                placeholder: "--pilih Kecamatan"
            });
            $(".select2-des").select2({
                placeholder: "--pilih Desa"
            });
        });
    });
</script>

<script>
	$(document).ready(function() {
		// Get the kabupaten select element
		const $kabupatenSelect = $('#kabupaten_id');

		// Add an event listener to the provinsi select element
		$('#provinsi_id').on('change', function() {
			const provinsiId = $(this).val();
			if (provinsiId) {
			// Make an AJAX request to fetch the corresponding kabupaten
			$.get('/api/getKabupatenByProvinsi/' + provinsiId, function(data) {
				// Clear the kabupaten select element
				$kabupatenSelect.empty().append('<option value=""></option>');
				// Populate the kabupaten select element with the fetched data
				$.each(data, function(key, value) {
				$kabupatenSelect.append('<option value="' + value.kabupaten_id + '">' + value.kabupaten_id + ' - ' + value.nama_kab + '</option>');
				});
			});
			} else {
			// Clear the kabupaten select element if no provinsi is selected
			$kabupatenSelect.empty().append('<option value=""></option>');
			}
		});

		// Get the kecamatan select element
		const $kecamatanSelect = $('#kecamatan_id');

		// Add an event listener to the provinsi select element
		$('#kabupaten_id').on('change', function() {
			const kabupatenId = $(this).val();
			if (kabupatenId) {
			// Make an AJAX request to fetch the corresponding kabupaten
			$.get('/api/getKecamatanByKabupaten/' + kabupatenId, function(data) {
				// Clear the kabupaten select element
				$kecamatanSelect.empty().append('<option value=""></option>');
				// Populate the kabupaten select element with the fetched data
				$.each(data, function(key, value) {
				$kecamatanSelect.append('<option value="' + value.kecamatan_id + '">' + value.kecamatan_id + ' - '  + value.nama_kecamatan + '</option>');
				});
			});
			} else {
			// Clear the kabupaten select element if no provinsi is selected
			$kecamatanSelect.empty().append('<option value=""></option>');
			}
		});

		// Get the kecamatan select element
		const $desaSelect = $('#kelurahan_id');

		// Add an event listener to the provinsi select element
		$('#kecamatan_id').on('change', function() {
			const kecamatanId = $(this).val();
			if (kecamatanId) {
			// Make an AJAX request to fetch the corresponding kabupaten
			$.get('/api/getDesaByKecamatan/' + kecamatanId, function(data) {
				// Clear the kabupaten select element
				$desaSelect.empty().append('<option value=""></option>');
				// Populate the kabupaten select element with the fetched data
				$.each(data, function(key, value) {
				$desaSelect.append('<option value="' + value.kelurahan_id + '">' + value.kelurahan_id + ' - '  + value.nama_desa + '</option>');
				});
			});
			} else {
			// Clear the kabupaten select element if no provinsi is selected
			$desaSelect.empty().append('<option value=""></option>');
			}
		});
	});
</script>

<script>
    $("#js-login-btn").click(function(event) {

        // Fetch form to apply custom Bootstrap validation
        var form = $("#js-login")

        if (form[0].checkValidity() === false) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.addClass('was-validated');
        // Perform ajax submit here...
    });
</script>


<script>
    $(document).ready(function() {
        $(function() {
			@isset($pksmitra->id)
			$(".selecteditpoktan").select2({
                placeholder: "--Pilih Kelompoktani",
            });
			@endisset
        });
    });
</script>
@endsection