@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" media="screen, print" href="{{asset('css/smartadmin/notifications/sweetalert2/sweetalert2.bundle.css')}}">
<style>
	*, *:after, *:before {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
	}

	.swal2-progress-step-line{
		width: 5em !important;
		background-color: #f0f0f0 !important;
	}

	/* Form Progress */
	.progresses {
	width: 1000px;
	margin: 20px auto;
	text-align: center;
	}
	.progresses .circle,
	.progresses .bar {
	display: inline-block;
	background: #fff;
	width: 40px; height: 40px;
	border-radius: 40px;
	border: 1px solid #d5d5da;
	}
	.progresses .bar {
	position: relative;
	width: 80px;
	height: 6px;
	top: -33px;
	margin-left: -5px;
	margin-right: -5px;
	border-left: none;
	border-right: none;
	border-radius: 0;
	}
	.progresses .circle .label {
	display: inline-block;
	width: 32px;
	height: 32px;
	line-height: 32px;
	border-radius: 32px;
	margin-top: 3px;
	color: #b5b5ba;
	font-size: 17px;
	}
	.progresses .circle .title {
	font-size: 13px;
	line-height: 30px;
	margin-left: -5px;
	}

	/* Done / Active */
	.progresses .bar.done,
	.progresses .circle.done {
	}
	.progresses .circle.done .label {
	color: #FFF;
	background: #1dc9b7;
	box-shadow: inset 3px -3px 10px rgba(0, 0, 0, 0.15);
	}
	.progresses .circle.done .title {
	color: #444;
	}
	.progresses .circle.active .label {
	color: #FFF;
	background: #ffc241;
	box-shadow: inset 3px -3px 10px rgba(0, 0, 0, 0.15);
	}
	.progresses .circle.active .title {
	color: #ffc241;
	}
	/* fail*/
	.progresses .circle.fail .label {
	color: #FFF;
	background: #fd3995;
	box-shadow: inset 3px -3px 10px rgba(0, 0, 0, 0.15);
	}
	.progresses .circle.fail .title {
	color: #fd3995;
	}
</style>

@endsection
@section('content')
@include('partials.breadcrumb')
@include('partials.subheaderwithfilter')
@can('dashboard_access')
<div class="row">
	<div class="col-md-4">
		<div id="totalRiph" class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
			<div class="">
				<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Volume import produk hortikultura yang tercantum di dalam Surat Rekomendasi Import Produk Hortikultura">
					<span id="volume_riph">0</span>
					<small class="m-0 l-h-n">Volume RIPH (ton)</small>
				</h3>
			</div>
			<i class="fal fa-globe-asia position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
		</div>
	</div>
	<div class="col-md-4">
		<div id="totalTanam" class="p-3 bg-success-500 rounded overflow-hidden position-relative text-white mb-g">
			<div class="">
				<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Jumlah Kelompoktani yang menjadi mitra pada periode ini.">
					<span id="total_poktan">0</span>
					<small class="m-0 l-h-n">Kelompoktani</small>
				</h3>
			</div>
			<i class="fal fa-users position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:6rem"></i>
		</div>
	</div>
	<div class="col-md-4">
		<div id="totalProduksi" class="p-3 bg-warning-500 rounded overflow-hidden position-relative text-white mb-g">
			<div class="">
				<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Jumlah Anggota Kelompoktani yang menjadi mitra wajib tanam-produksi pada periode ini.">
					<span id="total_anggotamitras">0</span>
					<small class="m-0 l-h-n">Jumlah Anggota Mitra (orang)</small>
				</h3>
			</div>
			<i class="fal fa-hands-helping position-absolute pos-right pos-bottom opacity-40 mb-n1 mr-n1" style="font-size:6rem"></i>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					<i class="subheader-icon fal fa-seedling mr-1"></i>Realisasi <span class="fw-300"><i>Wajib Tanam</i></span>
				</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<!-- Row -->
					<div class="row mb-3">
						<div class="col-lg-5 col-sm-6 align-self-center text-center">
							<div class="c-chart-wrapper">
								<div 
									id = "naschartTanam"
									class="js-easy-pie-chart color-success-300 position-relative d-inline-flex align-items-center justify-content-center "
									data-percent="50.00"
									data-piesize="145"
									data-linewidth="10"
									data-linecap="butt"
									data-scalelength="7"
									data-toggle="tooltip"
									title data-original-title=""
									data-placement="bottom">
									<div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-xl">
										<span class="fs-xxl fw-500 text-dark"><span id="realisasiTanam"></span><sup>%</sup></span>
										<!--<span class="display-5 fw-500 js-percent d-block text-dark">97.68</span>-->
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 col-sm-6">
							<div class="shadow-1 p-1 bg-success-100 rounded overflow-hidden position-relative text-white mb-2">
								<div class="text-dark ml-2">
									<span class="small">Kewajiban</span>
									<h5 class="d-block l-h-n m-0 fw-500">
										<span id="wajibTanam"></span> ha
									</h5>
								</div>
								<i class="fal fa-hand-holding-seedling position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
							<div class="shadow-1 p-1 bg-success-300 rounded overflow-hidden position-relative text-white mb-2">
								<div class="text-dark ml-2">
									<span class="small">Realisasi</span>
									<h5 class="d-block l-h-n m-0 fw-500">
										<span id="total_luastanam"></span> ha
									</h5>
								</div>
								<i class="fal fa-seedling position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
							<div class="shadow-1 p-1 bg-success-500 rounded overflow-hidden position-relative text-white mb-2">
								<div class="ml-2">
									<span class="small">Diverifikasi</span>
									<h5 class="d-block l-h-n m-0 fw-500">
										<span id="sumVerifTanam"></span> ha
									</h5>
								</div>
								<i class="fal fa-leaf position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel" id="panel-2">
			<div class="panel-hdr">
				<h2>
					<i class="subheader-icon fal fa-balance-scale-left mr-1"></i>Realisasi <span class="fw-300"><i>Wajib Produksi</i></span>
				</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<!-- Row -->
					<div class="row mb-3">
						<div class="col-lg-5 col-sm-6 align-self-center text-center">
							<div class="c-chart-wrapper">
								<div  id = "naschartProduksi" class="js-easy-pie-chart color-warning-500 position-relative d-inline-flex align-items-center justify-content-center"
									data-percent="50.00"
									data-piesize="145"
									data-linewidth="10"
									data-linecap="butt"
									data-scalelength="7"
									data-toggle="tooltip"
									title data-original-title=""
									data-placement="bottom">
									<div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-xl">
										<span class="fs-xxl fw-500 text-dark"><span id="realisasiProduksi"></span><sup>%</sup></span>
										<!--<span class="display-5 fw-500 js-percent d-block text-dark">97.68</span>-->
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 col-sm-6">
							<div class="shadow-1 p-1 bg-warning-300 rounded overflow-hidden position-relative text-white mb-2">
								<div class="text-dark ml-2">
									<span class="small">Kewajiban</span>
									<h5 class="d-block l-h-n m-0 fw-500">
										<span id="wajibProduksi"></span> ton
									</h5>
								</div>
								<i class="fal fa-dolly-empty position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
							<div class="shadow-1 p-1 bg-warning-500 rounded overflow-hidden position-relative text-white mb-2">
								<div class="text-dark ml-2">
									<span class="small">Realisasi</span>
									<h5 class="d-block l-h-n m-0 fw-500">
										<span id="total_volume"></span> ton
									</h5>
								</div>
								<i class="fal fa-dolly position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
							<div class="shadow-1 p-1 bg-warning-700 rounded overflow-hidden position-relative text-white mb-2">
								<div class="ml-2">
									<span class="small">Diverifikasi</span>
									<h5 class="d-block l-h-n m-0 fw-500">
										<span id="sumVerifProduksi"></span> ton
									</h5>
								</div>
								<i class="fal fa-dolly-flatbed position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel" id="panel-2">
			<div class="panel-hdr">
				<h2>
					<i class="subheader-icon fal fa-ballot-check mr-1"></i>STATUS <span class="fw-300"><i>Verifikasi</i></span>
				</h2>
				<div class="panel-toolbar">
					@include('layouts.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-hover table-striped table-bordered w-100" id="verifprogress">
						<thead>
							<th>Nomor Pengajuan</th>
							<th>Nomor RIPH</th>
							<th>Verifikasi Data</th>
							<th>Verifikasi Lapangan</th>
							<th>Penerbitan SKL</th>
							<th>Progress</th>
						</thead>
						<tbody>
						</tbody>
					</table>
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
	$(document).ready(function() {
	  $('#periodetahun').change(function() {
		var periodetahun = $(this).val();
		var url = '/api/getAPIRealisasiByYear/' + periodetahun;
		var verificationUrl = '/api/getAPIVerifiedByYear/' + periodetahun;
	
		if (periodetahun == '') return;
		if (periodetahun == 'all') {
		  url = '/api/getAPIRealisasiAll';
		  verificationUrl = '/api/getAPIVerifiedAll'
		}
	
		$.get(url, function(data) {
			$('#userId').text(data[0].id);
			$('#volume_riph').text(data[0].total_import.toLocaleString('en-US'));
			$('#total_poktan').text(data[0].total_poktan);
			$('#total_volume').text(data[0].total_volume.toLocaleString('en-US'));
			$('#total_luastanam').text(data[0].total_luastanam.toLocaleString('en-US'));
			$('#total_anggotamitras').text(data[0].total_anggotamitras);
			$('#sumVerifTanam').text(data[0].sumVerifTanam.toLocaleString('en-US'));
			$('#sumVerifProduksi').text(data[0].sumVerifProduksi.toLocaleString('en-US'));

			var wajibProduksi = (data[0].total_import * 0.05);
			$('#wajibProduksi').text(wajibProduksi.toLocaleString('en-US', { maximumFractionDigits: 2 }));

			var wajibTanam = (data[0].total_import*0.05/6);
			$('#wajibTanam').text(wajibTanam.toLocaleString('en-US', { maximumFractionDigits: 2 }));

			var realisasiTanam = (data[0].total_luastanam / (data[0].total_import*0.05/6)*100);
			$('#realisasiTanam').text(realisasiTanam.toLocaleString('en-US', { maximumFractionDigits: 2 }));

			var realisasiProduksi = (data[0].total_volume / (data[0].total_import*0.05)*100).toFixed(2);
			$('#realisasiProduksi').text(realisasiProduksi.toLocaleString('en-US', { maximumFractionDigits: 2 }));

			$('#naschartTanam').attr('data-percent', realisasiTanam);
			$('#naschartTanam').attr('data-original-title', realisasiTanam  + '% dari kewajiban');
			var $chartTanam = $('#naschartTanam');
			$chartTanam.data('easyPieChart').update(realisasiTanam);

			$('#naschartProduksi').attr('data-percent', realisasiProduksi);
			$('#naschartProduksi').attr('data-original-title', realisasiProduksi + '% dari kewajiban');
			var $chartProduksi = $('#naschartProduksi');
			$chartProduksi.data('easyPieChart').update(realisasiProduksi);
		});

		$.get(verificationUrl, function(verificationData) {
			var tableBody = $('#verifprogress tbody');
			tableBody.empty(); // Clear the table body

			verificationData.commitments.forEach(function(commitment) {
				// var nomorRIPH = commitment.no_ijin;
				var pengajuanV2s = verificationData.pengajuanV2s.filter(function(pengajuan) {
					return pengajuan.commitmentbackdate_id === commitment.id;
				});

				if (pengajuanV2s.length >0) {
					pengajuanV2s.forEach(function(pengajuan) {
						var row = $('<tr></tr>');
						var noAju = $('<td></td>').text(pengajuan.no_pengajuan)
						var noIjin = $('<td></td>').text(commitment.no_ijin)
						var verifikasiData = $('<td class="text-center"></td>').html(function() {
							if (!pengajuan.status) {
								return '<span class="badge badge-xs badge-warning"><i class="fal fa-exclamation-circle mr-1"></i>Belum diajukan</span>';
							} else if (!pengajuan.onlinestatus) {
								return '<span class="badge badge-xs badge-primary"><i class="fal fa-check-circle mr-1"></i>Diajukan</span>';
							} else if (pengajuan.onlinestatus === '1') {
								return '<span class="badge badge-xs badge-success"><i class="fal fa-check-circle mr-1"></i>Selesai</span>';
							} else if (pengajuan.onlinestatus === '2') {
								return '<span class="badge badge-xs badge-danger"><i class="fal fa-ban mr-1"></i>Perbaikan</span>';
							}
						});

						var verifikasiLapangan = $('<td class="text-center"></td>').html(function() {
							if (!pengajuan.status && !pengajuan.onlinestatus && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-warning"><i class="fal fa-exclamation-circle mr-1"></i>Belum diajukan</span>';
							} else if (pengajuan.status && !pengajuan.onlinestatus && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-info"><i class="fal fa-hourglass mr-1"></i>Menunggu</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '1' && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-info"><i class="fal fa-hourglass mr-1"></i>Menunggu</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '2' && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-secondary"><i class="fal fa-times-circle mr-1"></i>Batal Periksa</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '1' && pengajuan.onfarmstatus === '1') {
								return '<span class="badge badge-xs badge-success"><i class="fal fa-check-circle mr-1"></i>Selesai</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '1' && pengajuan.onfarmstatus === '2') {
								return '<span class="badge badge-xs badge-danger"><i class="fal fa-ban mr-1"></i>Perbaikan</span>';
							}
						});
						var penerbitanSKL = $('<td></td>').html(function() {
							if (!pengajuan.status && !pengajuan.onlinestatus && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-warning"><i class="fal fa-exclamation-circle mr-1"></i>Belum diajukan</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '2' && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-secondary"><i class="fal fa-times-circle mr-1"></i>Batal Periksa</span>';
							} else if (pengajuan.status === '6' && pengajuan.onlinestatus === '1' && pengajuan.onfarmstatus === '1') {
								return '<span class="badge badge-xs badge-success"><i class="fal fa-file-certificate mr-1"></i>SKL Terbit</span>';
							} else if (pengajuan.onlinestatus === '1' && pengajuan.onfarmstatus === '2') {
								return '<span class="badge badge-xs badge-secondary"><i class="fal fa-times-circle mr-1"></i>Batal Periksa</span>';
							} else {
								return '<span class="badge badge-xs badge-info"><i class="fal fa-hourglass mr-1"></i>Menunggu</span>';
							}
						});
						var progress = $('<td></td>').html(function() {
							if (pengajuan.status === '1') {
								return '<span class="badge badge-xs badge-info"><i class="fal fa-upload mr-1"></i>Pengajuan</span>';
							} else if (pengajuan.status === '2' || pengajuan.status === '3') {
								return '<span class="badge badge-xs badge-primary"><i class="fal fa-file-search mr-1"></i>Verifikasi Data</span>';
							} else if (pengajuan.status === '4' || pengajuan.status === '5') {
								return '<span class="badge badge-xs badge-warning"><i class="fal fa-map-marker-check mr-1"></i>Verifikasi Lapangan</span>';
							} else if (pengajuan.status === '6') {
								return '<span class="badge badge-xs badge-success"><i class="fal fa-award mr-1"></i>Lunas</span>';
							} else {
								return '';
							}
						});
						row.append(noAju, noIjin, verifikasiData, verifikasiLapangan, penerbitanSKL, progress); tableBody.append(row);
					});
				}
			});
		});
	});
});
</script>

@endsection