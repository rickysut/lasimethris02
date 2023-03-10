@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('commitment_show')
	{{-- {{ dd($data_poktan) }} --}}
	<div class="row">
		<div class="col-lg-12">
			<form action=" {{route('admin.task.commitments.store')}} " method="POST" enctype="multipart/form-data">
				@csrf
				<div class="panel" id="panel-1">
					<div class="panel-hdr">
						<h2>
							Data <span class="fw-300"><i>Basic</i></span>
						</h2>
						<div class="panel-toolbar">
							@include('partials.globaltoolbar')
						</div>
					</div>
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
									<label for="tgl_akhir">Tanggal Akhir</label>
									<input type="date" name="tgl_akhir" id="tgl_akhir"
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
										class="form-control form-control-sm" placeholder="Volume import yang
										tercantum pada dokumen RIPH" aria-describedby="helpId">
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
									<input type="numeric" name="wajib_produksi" id="wajib_produksi"
									class="form-control form-control-sm" placeholder="Volume wajib produksi"
									aria-describedby="helpId" readonly>
									<small id="helpId" class="text-muted">Volume wajib produksi yang wajib direalisasikan</small>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="panel" id="panel-2">
					<div class="panel-hdr">
						<h2>
							Data <span class="fw-300"><i>Perbenihan</i></span>
						</h2>
						<div class="panel-toolbar">
							@include('partials.globaltoolbar')
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row">
								<div class="form-group col-md-4">
									<label for="kebutuhan_benih">Stok Mandiri (kg)</label>
									<input type="text" name="stok_mandiri" id="stok_mandiri"
										class="form-control form-control-sm"
										placeholder="Stok Mandiri" aria-describedby="helpId">
									<small id="helpId" class="text-muted">
										Jumlah benih yang sudah dimiliki.
									</small>
								</div>
								<div class="form-group col-md-4">
									<label for="kebutuhan_benih">Kebutuhan Benih (kg)</label>
									<input readonly type="text" name="kebutuhan_benih" id="kebutuhan_benih"
										class="form-control form-control-sm"
										placeholder="autocalculate" aria-describedby="helpId">
									<small id="helpId" class="text-muted">
										Jumlah benih dibutuhkan untuk seluruah lokasi lahan.
									</small>
								</div>
								<div class="form-group col-md-4">
									<label for="off_stock">Dari Penangkar (kg)</label>
									<input readonly type="text" name="off_stock" id="off_stock"
										class="form-control form-control-sm"
										placeholder="autocalculate" aria-describedby="helpId">
									<small id="helpId" class="text-muted">
										Pembelian benih dari penangkar.
									</small>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel" id="panel-3">
					<div class="panel-hdr">
						<h2>
							Data <span class="fw-300"><i>Pengendalian</i></span>
						</h2>
						<div class="panel-toolbar">
							@include('partials.globaltoolbar')
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row">
								<div class="form-group col-md-3">
									<label for="organik">Pupuk Organik (kg)</label>
									<input type="text" name="organik" id="organik"
										class="form-control form-control-sm"
										placeholder="Jumlah Pupuk Organik" aria-describedby="helpId">
									<small id="helpId" class="text-muted">
										Jumlah Pupuk Organik
									</small>
								</div>
								<div class="form-group col-md-3">
									<label for="npk">NPK (kg)</label>
									<input type="text" name="npk" id="npk"
										class="form-control form-control-sm"
										placeholder="Jumlah NPK" aria-describedby="helpId">
									<small id="helpId" class="text-muted">
										Nitrogen Phosfor Kalium
									</small>
								</div>
								<div class="form-group col-md-3">
									<label for="dolomit">Dolomit (kg)</label>
									<input type="text" name="dolomit" id="dolomit"
										class="form-control form-control-sm"
										placeholder="Jumlah Dolomit" aria-describedby="helpId">
									<small id="helpId" class="text-muted">
										Jumlah Kapur Dolomit
									</small>
								</div>
								<div class="form-group col-md-3">
									<label for="za">ZA (kg)</label>
									<input type="text" name="za" id="za"
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
				<div class="panel" id="panel-4">
					<div class="panel-hdr">
						<h2>
							Data <span class="fw-300"><i>Lainnya</i></span>
						</h2>
						<div class="panel-toolbar">
							@include('partials.globaltoolbar')
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row">
								<div class="form-group col-md-3">
									<label for="mulsa">Mulsa (kg)</label>
									<input type="text" name="mulsa" id="mulsa"
										class="form-control form-control-sm"
										placeholder="Jumlah Mulsa" aria-describedby="helpId">
									<small id="helpId" class="text-muted">
										Jumlah Mulsa
									</small>
								</div>
								<div class="form-group col-md-3">
									<label class="form-label" for="poktan_share">Bagi Hasil (%)</label>
									<div class="input-group">
										<input type="text" name="poktan_share" id="poktan_share"
											class="form-control form-control-sm"
											placeholder="Bagi hasil (Poktan)" aria-describedby="helpId"
											title="Bagi hasil untuk Kelompoktani">
										<input type="text" name="importir_share" id="importir_share"
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
				<div class="panel" id="panel-5">
					<div class="panel-hdr">
						<h2>
							Tindakan
						</h2>
						<div class="panel-toolbar">
							<a href="{{route('admin.task.commitments.index')}}"
								class="btn btn-default btn-sm mr-1" role="button">
								<i class="fa fa-times-circle text-danger"></i> Cancel
							</a>
							<button class="btn btn-danger btn-sm" type="submit">
								<i class="fa fa-save"></i> Update
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