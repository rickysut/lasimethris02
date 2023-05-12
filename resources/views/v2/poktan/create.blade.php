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
					Data Kelompok Tani
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<form action="{{ route('admin.task.masterpoktan.store') }}" method="post">
					@csrf
					<div class="panel-content">
						<div class="row d-flex">
							<div class="col-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_kelompok">Nama Kelompoktani</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="nama_kelompok">
												<i class="fal fa-warehouse-alt"></i>
											</span>
										</div>
										<input type="text" class="form-control " id="nama_kelompok" name="nama_kelompok"
											required>
									</div>
									<div class="help-block">
										Nama Kelompoktani.
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_pimpinan">Nama Pimpinan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="nama_pimpinan">
												<i class="fal fa-user-tie"></i>
											</span>
										</div>
										<input type="text" class="form-control " id="nama_pimpinan" name="nama_pimpinan"
											required>
									</div>
									<div class="help-block">
										Nama Pimpinan.
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label" for="hp_pimpinan">Nomor Kontak</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="hp_pimpinan">
												<i class="fal fa-mobile"></i>
											</span>
										</div>
										<input type="text" class="form-control " id="hp_pimpinan" name="hp_pimpinan"
											required>
									</div>
									<div class="help-block">
										Nomor kontak pimpinan kelompoktani.
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label" for="provinsi">Provinsi</label>
									<div class="input-group">
										<select class="form-control custom-select select2-prov"
										name="provinsi_id" id="provinsi_id" required>
											<option value="{{ isset($pksmitra) ? $pksmitra->provinsi->provinsi_id : '' }}">
												{{ isset($pksmitra) ? $pksmitra->provinsi->provinsi_id. '. ' .  $pksmitra->provinsi->nama   : 'Load Record' }}
											</option>
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
											<option value="{{ isset($pksmitra) ? $pksmitra->kabupaten->kabupaten_id : '' }}">
												{{ isset($pksmitra) ? $pksmitra->kabupaten->kabupaten_id. '. ' . 
												$pksmitra->kabupaten->nama_kab   : 'Load Record' }}
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
									<label class="form-label" for="kecamatan_id">Kecamatan</label>
									<div class="input-group">
										<select class="select2-kec form-control" id="kecamatan_id" name="kecamatan_id" required>
											<option value="{{ isset($pksmitra) ? $pksmitra->kecamatan->kecamatan_id : '' }}">
												{{ isset($pksmitra) ? $pksmitra->kecamatan->kecamatan_id. '. ' . 
												$pksmitra->kecamatan->nama_kecamatan   : 'Load Record' }}
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
									<label class="form-label" for="kelurahan_id">Desa</label>
									<div class="input-group">
										<select class="select2-des form-control" name="kelurahan_id" id="kelurahan_id" required>
											<option value="{{ isset($pksmitra) ? $pksmitra->desa->kelurahan_id : '' }}">
												{{ isset($pksmitra) ? $pksmitra->desa->kelurahan_id. '. ' . 
												$pksmitra->desa->nama_desa  : 'Load Record' }}
											</option>
										</select>
									</div>
									<div class="help-block">
										Pilih Desa tempat terjadinya perjanjian.
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="col-md-4 ml-auto text-right">
							<a href="{{route('admin.task.masterpoktan.index')}}" class="btn btn-warning btn-sm">
								<i class="fal fa-undo mr-1"></i>Batal
							</a>
							<button class="btn btn-primary btn-sm" type="submit">
								<i class="fal fa-save mr-1"></i>Simpan
							</button>
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


//select2
<script>
	$(document).ready(function() {
		$(function() {
            $(".select2-kab").select2({
                placeholder: "--pilih Kabupaten"
            });
            $(".select2-kec").select2({
                placeholder: "--pilih Kecamatan"
            });
            $(".select2-des").select2({
                placeholder: "--pilih Desa/Kelurahan"
            });
		});
	});
</script>


//ajax wilayah
<script>
    $(document).ready(function() {
        $(".select2-prov").select2({
            placeholder: "--Pilih Provinsi",
        });

        const $provinsiSelect = $('#provinsi_id');
        // Populate the provinsi select element with the fetched data
        $.get('/api/getAllProvinsi/', function(data) {
            // Clear the provinsi select element
            $provinsiSelect.empty().append('<option value=""></option>');
            // Populate the provinsi select element with the fetched data
            $.each(data, function(key, value) {
                $provinsiSelect.append('<option value="' + value.provinsi_id + '">' + value.provinsi_id + ' - ' + value.nama + '</option>');
            });
            // Set the selected value, if available
            $provinsiSelect.val('{{ isset($pksmitra) ? $pksmitra->provinsi->provinsi_id : '' }}');
        });
    });
</script>


<script>
	$(document).ready(function() {
		// Get the kabupaten select element
		const $kabupatenSelect = $('#kabupaten_id');
		const $kecamatanSelect = $('#kecamatan_id');
		const $desaSelect = $('#kelurahan_id');

		// Add an event listener to the provinsi select element
		$('#provinsi_id').on('change', function() {
			const provinsiId = $(this).val();
			if (provinsiId) {
			// Make an AJAX request to fetch the corresponding kabupaten
			$.get('/api/getKabupatenByProvinsi/' + provinsiId, function(data) {
				// Clear the kabupaten select element
				$kabupatenSelect.empty().append('<option value=""></option>');
				$kecamatanSelect.empty().append('<option value=""></option>');
				$desaSelect.empty().append('<option value=""></option>');
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
@endsection

