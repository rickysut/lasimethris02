@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('commitment_show')
@include('partials.sysalert')
	{{-- {{ dd($data_poktan) }} --}}
	<div class="row">
		<div class="col-lg-12">
			<form action=" {{route('admin.task.commitments.store')}} " method="POST" enctype="multipart/form-data">
				@csrf
				<div class="panel" id="panel-1">
					<div class="panel-hdr">
						<h2>
							Data <span class="fw-300"><i>RIPH</i></span>
						</h2>
						<div class="panel-toolbar">
							@include('partials.globaltoolbar')
						</div>
					</div>
					{{-- data utama --}}
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row">
								<div class="form-group col-md-4">
									<label for="no_ijin">Nomor RIPH</label>
									<input type="text" name="no_ijin" id="no_ijin"
										class="form-control form-control-sm" placeholder="Nomor RIPH"
										aria-describedby="helpId">
									<small id="helpId" class="text-muted">Nomor Penerbitan RIPH</small>
								</div>
								<div class="form-group col-md-2">
									<label for="periodetahun">Periode Tahun</label>
									<input type="number" name="periodetahun" id="periodetahun"
										class="form-control form-control-sm"
										placeholder="Tahun Penerbitan" aria-describedby="helpId">
									<small id="helpId" class="text-muted">Tahun Penerbitan RIPH</small>
								</div>
								<div class="form-group col-md-3">
									<label for="tgl_ijin">Tanggal terbit</label>
									<input type="date" name="tgl_ijin" id="tgl_ijin"
									class="form-control form-control-sm" placeholder="Tanggal ijin diterbitkan"
									aria-describedby="helpId">
									<small id="helpId" class="text-muted">Tanggal ijin RIPH diterbitkan</small>
								</div>
								<div class="form-group col-md-3">
									<label for="tgl_end">Tanggal Akhir</label>
									<input type="date" name="tgl_end" id="tgl_end"
									class="form-control form-control-sm" placeholder="Tanggal akhir berlakunya RIPH"
									aria-describedby="helpId">
									<small id="helpId" class="text-muted">Tanggal akhir berlaku ijin RIPH</small>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-5">
									<label for="no_hs">Produk</label>
									<input type="text" name="hs_code" id="hs_code"
										class="form-control form-control-sm"
										placeholder="HS Code dan Produk" aria-describedby="helpId">
									<small id="helpId" class="text-muted">
										HS Code beserta Nama Produk.
									</small>
								</div>
								<div class="form-group col-md-3">
									<label for="volume_riph">Volume RIPH (ton)</label>
									<input type="number" name="volume_riph" id="volume_riph"
										class="form-control form-control-sm" placeholder="Volume import " aria-describedby="helpId">
									<small id="helpId" class="text-muted">
										Volume import pada dokumen RIPH
									</small>
								</div>
								<div class="form-group col-md-2">
									<label for="wajib_tanam">Wajib Tanam (ha)</label>
									<input type="number" id="wajib_tanam" class="form-control"
									placeholder="autocalculate" readonly>
									<small id="helpId" class="text-muted">Luas tanam yang wajib direalisasikan</small>
								</div>
								<div class="form-group col-md-2">
									<label for="wajib_produksi">Wajib Produksi (ton)</label>
									<input type="number" name="wajib_produksi" id="wajib_produksi"
									class="form-control form-control-sm" placeholder="Volume wajib produksi"
									aria-describedby="helpId" readonly>
									<small id="helpId" class="text-muted">Volume wajib produksi yang wajib direalisasikan</small>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="card-deck mb-4">
					<div class="card" id="perbenihan">
						<div class="panel-hdr">
							<h2>
								Data <span class="fw-300"><i>Perbenihan</i></span>
							</h2>
							<div class="panel-toolbar">
								
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<div class="col mt-3 mb-5">
									<div class="form-group">
										<label for="kebutuhan_benih">Stok Mandiri (kg)</label>
										<input type="number" name="stok_mandiri" id="stok_mandiri"
											class="form-control form-control-sm"
											placeholder="Stok Mandiri" aria-describedby="helpId">
										<small id="helpId" class="text-muted">
											Jumlah benih yang sudah dimiliki.
										</small>
									</div>
									<div class="form-group">
										<label for="kebutuhan_benih">Kebutuhan Benih (kg)</label>
										<input readonly type="number" name="kebutuhan_benih" id="kebutuhan_benih"
											class="form-control form-control-sm"
											placeholder="autocalculate" aria-describedby="helpId">
										<small id="helpId" class="text-muted">
											Jumlah benih dibutuhkan untuk seluruah lokasi lahan (autocalculate).
										</small>
									</div>
									<div class="form-group">
										<label for="off_stock">Dari Penangkar (kg)</label>
										<input readonly type="number" name="off_stock" id="off_stock"
											class="form-control form-control-sm"
											placeholder="autocalculate" aria-describedby="helpId">
										<small id="helpId" class="text-muted">
											Pembelian benih dari penangkar (autocalculate).
										</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card" id="pengendalian">
						<div class="panel-hdr">
							<h2>
								Data <span class="fw-300"><i>Pengendalian</i></span>
							</h2>
							<div class="panel-toolbar">
								
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<div class="col mt-3 mb-5">
									<div class="form-group">
										<label for="organik">Pupuk Organik (kg)</label>
										<input type="number" name="organik" id="organik"
											class="form-control form-control-sm"
											placeholder="Jumlah Pupuk Organik" aria-describedby="helpId">
										<small id="helpId" class="text-muted">
											Jumlah Pupuk Organik
										</small>
									</div>
									<div class="form-group">
										<label for="npk">NPK (kg)</label>
										<input type="number" name="npk" id="npk"
											class="form-control form-control-sm"
											placeholder="Jumlah NPK" aria-describedby="helpId">
										<small id="helpId" class="text-muted">
											Nitrogen Phosfor Kalium
										</small>
									</div>
									<div class="form-group">
										<label for="dolomit">Dolomit (kg)</label>
										<input type="number" name="dolomit" id="dolomit"
											class="form-control form-control-sm"
											placeholder="Jumlah Dolomit" aria-describedby="helpId">
										<small id="helpId" class="text-muted">
											Jumlah Kapur Dolomit
										</small>
									</div>
									<div class="form-group">
										<label for="za">ZA (kg)</label>
										<input type="number" name="za" id="za"
											class="form-control form-control-sm"
											placeholder="Jumlah ZA" aria-describedby="helpId">
										<small id="helpId" class="text-muted">
											Zwavelzure Amonium
										</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card" id="dataLain">
						<div class="panel-hdr">
							<h2>
								Data <span class="fw-300"><i>Lainnya</i></span>
							</h2>
							<div class="panel-toolbar">
								
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<div class="col mt-3 mb-5">
									<div class="form-group">
										<label for="mulsa">Mulsa (kg)</label>
										<input type="number" name="mulsa" id="mulsa"
											class="form-control form-control-sm"
											placeholder="Jumlah Mulsa" aria-describedby="helpId">
										<small id="helpId" class="text-muted">
											Jumlah Mulsa
										</small>
									</div>
									<div class="form-group">
										<label class="form-label" for="poktan_share">Bagi Hasil (%)</label>
										<div class="input-group">
											<input type="number" name="poktan_share" id="poktan_share"
												class="form-control form-control-sm"
												placeholder="Bagi hasil (Poktan)" aria-describedby="helpId"
												title="Bagi hasil untuk Kelompoktani">
											<input type="number" name="importir_share" id="importir_share"
												class="form-control form-control-sm"
												placeholder="autocalculate" aria-describedby="helpId"
												title="Bagi hasil untuk Importir" readonly>
										</div>
										<small id="helpId" class="text-muted">
											Bagi hasil untuk Pelaku Usaha dan Importir.
										</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel" id="panel-4">
					<div class="panel-hdr">
						<h2>
							Berkas <span class="fw-300"><i>Lampiran</i></span>
						</h2>
						<div class="panel-toolbar">
							<span class="help-block"><i class="fas fa-exclamation-circle text-danger mr-1"></i>Berkas-berkas ini diperlukan untuk verifikasi dan Penerbitan SKL.</span>
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="form-label h6">RIPH</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="formRiph"
											accept="image/jpeg,application/pdf">
										<label class="custom-file-label for="formRiph">
											Pilih file...
										  </label>
									</div>
									<span class="help-block">Surat Persetujuan RIPH. (.jpg / .pdf).</span>
								</div>
								<div class="form-group col-md-6">
									<label class="form-label h6">Form SPTJM</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="formSptjm"
											accept="image/jpeg,application/pdf">
										<label class="custom-file-label" for="formSptjm">Pilih file...</label>
									</div>
									<span class="help-block">Form Pertanggungjawaban Mutlak. (.jpg / .pdf).</span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label class="form-label h6">Logbook</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="logbook"
											accept="image/jpeg,application/pdf">
										<label class="custom-file-label" for="logbook">Pilih file...</label>
									</div>
									<span class="help-block">logbook. (.jpg / .pdf).</span>
								</div>
								<div class="form-group col-md">
									<label class="form-label h6">Form-RT</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="formRt"
											accept="image/jpeg,application/pdf">
										<label class="custom-file-label" for="formRt">Pilih file...</label>
									</div>
									<span class="help-block">Form Rencana Tanam. (.jpg / .pdf).</span>
								</div>        
							</div>
							<div class="row">
								<div class="form-group col-lg-4">
									<label class="form-label h6">Form-RTA</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="formRta"
											accept="image/jpeg,application/pdf">
										<label class="custom-file-label" for="formRta">Pilih file...</label>
									</div>
									<span class="help-block">Form Realisasi tanam. (.jpg / .pdf).</span>
								</div>
								<div class="form-group col-lg-4">
									<label class="form-label h6">Form RPO</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="formRpo"
											accept="image/jpeg,application/pdf">
										<label class="custom-file-label" for="formRpo">Pilih file...</label>
									</div>
									<span class="help-block">Form Realisasi Produksi. (.jpg / .pdf).</span>
								</div>
								<div class="form-group col-lg-4">
									<label class="form-label h6">Form LA</label>
									<div class="custom-file input-group">
										<input type="file" class="custom-file-input" name="formLa"
											accept="image/jpeg,application/pdf">
										<label class="custom-file-label" for="formLa">Pilih file...</label>
									</div>
									<span class="help-block">Form Laporan Akhir. (.jpg / .pdf).</span>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="col-md-4 ml-auto text-right">
							<a href="{{route('admin.task.commitments.index')}}" class="btn btn-warning btn-sm">
								<i class="fal fa-undo mr-1"></i>Batal
							</a>
							<button class="btn btn-primary btn-sm" type="submit">
								<i class="fal fa-save mr-1"></i>Simpan
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
@parent
<script>
	$(document).ready(function() {
		var volume_riph = $('#volume_riph');
		var wajib_tanam = $('#wajib_tanam');
		var wajib_produksi = $('#wajib_produksi');
		var kebutuhan_benih = $('#kebutuhan_benih');
		var stok_mandiri = $('#stok_mandiri');
		var off_stock = $('#off_stock');
		var poktan_share = $('#poktan_share');
		var importir_share = $('#importir_share');

	  // Calculate and set the values of wajib_tanam, wajib_produksi, and kebutuhan_benih inputs
	  function calculate() {
		var volume_riph_val = parseFloat(volume_riph.val()) || 0;
		var wajib_tanam_val = volume_riph_val * 0.05 / 6;
		var wajib_produksi_val = volume_riph_val * 0.05;
		var wajib_kebutuhanbenih_val = wajib_tanam_val * 0.8;
		var off_stock_val = kebutuhan_benih.val() - stok_mandiri.val();
		var poktanshare_val = parseFloat(poktan_share.val()) || 0;
		var importirshare_val = 100 - poktanshare_val;

		off_stock.val(off_stock_val < 0 ? 0 : off_stock_val.toFixed(2));
		wajib_tanam.val(wajib_tanam_val.toFixed(2));
		wajib_produksi.val(wajib_produksi_val.toFixed(2));
		kebutuhan_benih.val(wajib_kebutuhanbenih_val.toFixed(2));
		poktan_share.val(poktanshare_val.toFixed(2));
		importir_share.val(importirshare_val.toFixed(2));
	  }

	  // Call the calculate function when vol_import or in_stock input field changes
	  volume_riph.on('input', function() {
		calculate();
	  });
	  stok_mandiri.on('input', function() {
		calculate();
	  });
	  poktan_share.on('input', function() {
		calculate();
	  });

	  // Trigger the input event on the vol_import and in_stock input fields to calculate the off_stock value on page load
	  volume_riph.trigger('input');
	  stok_mandiri.trigger('input');
	  poktan_share.trigger('input');
	});
</script>

@endsection