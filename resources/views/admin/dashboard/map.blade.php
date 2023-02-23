@extends('layouts.admin')
@section('content')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/miscellaneous/jqvmap/jqvmap.bundle.css') }}">

@include('partials.breadcrumb')
<style>
	.bg-ocean {
		background-color: #eafeff;
	}
	</style>
<!-- Page Title Heading -->
<div class="subheader d-print-none">
	<h1 class="subheader-title">
		<i class="subheader-icon {{ ($heading_class ?? '') }}"></i><span class="fw-700 mr-2">{{  ($page_heading ?? '') }}</span>
	</h1>
	
	<div class="subheader-block d-lg-flex align-items-center">
		<div class="d-inline-flex flex-column justify-content-center ">
			<select type="text" id="statusTanam" class="form-control form-control-sm" data-toggle="tooltip" title data-original-title="pilih tahun awal laporan" placeholder="Task..." aria-label="statusTanam" aria-describedby="statusTanam">
				<option hidden>- pilih tahun laporan</option>
					<option disabled></option>
					<option>2022</option>
					<option>2023</option>
					<option disabled></option>
			</select>
		</div>
	</div>
	<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
		<div class="d-inline-flex flex-column justify-content-center mr-3">
			<button class="btn btn-primary ">Lihat
			</button>
		</div>
	</div>
</div>
{{-- page content --}}
<div class="row">
	<div class="col-md-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					<i class="subheader-icon fal fa-seedling mr-1"></i>Wajib <span class="fw-300"><i>Tanam-Produksi</i></span>
				</h2>
				<div class="panel-toolbar">
					<i class="fal fa-lightbulb-on text-info" data-toggle="tooltip" title data-original-title="Nilai Realisasi pada diagram ini bukan nilai total realisasi, melainkan nilai realisasi yang dilaporkan oleh pelaku usaha dan telah diverifikasi."></i>
				</div>
			</div>
			<div class="panel-container mt-n3 show">
				<div class="panel-content">
					<div class="row">
						<div class="col-lg-8 bg-ocean p-0" style="min-height: 300px;">
							<div id="vector-map" style="height: 100%; width: 100%" class="p-2"></div>
						</div>
						<div class="col-lg-4 p-4">
							<div class="p-1 d-flex align-items-center justify-content-start">
								<div class="border-faded border-top-0 border-left-0 border-bottom-0 py-2 pr-1 mr-1">
									<div class="text-right fw-500 l-h-n d-flex flex-column">
										<img class="d-inline-block js-jqvmap-flag mr-1" alt="logo" src="{{ asset('img/avatars/farmer.png') }}" style="width:auto; height: 55px;">
									</div>
								</div>
								<div class="d-flex justify-content-center flex-wrap d-sm-block">
									<div class="h3 m-0 d-flex align-items-center justify-content-start">
										<h5 class="js-jqvmap-prov mb-0 fw-500 text-dark"><i>- klik pada peta</i></h5>
									</div>
									<span class="m-0 fs-xs text-muted">
										Nomor RIPH
									</span>
								</div>
							</div>
							<div class="mt-2">
								<span class="p-2 fs-xs text-muted">
									Desa - kecamatan, Kab - Prov
								</span>
								<ul class="list-group mt-3">
									<li class="list-group-item d-flex justify-content-between align-items-center p-2">
										<a>Kelompoktani</a>
										<span class="fw-500">Sumber Tani Makmur</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center p-2">
										<a>Komoditas</a>
										<span class="fw-500">Bawang Putih</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center p-2">
										<a>Varietas</a>
										<span class="fw-500">Lumbu Kuning</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center p-2">
										<a>Tanggal tanam</a>
										<span class="fw-500">dd/mm/yyyy</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center p-2">
										<a>Luas Tanam</a>
										<span class="fw-500">1.20 ha</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center p-2">
										<a>Produksi</a>
										<span class="fw-500">12 ton</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center p-2">
										<a></a>
										<span class="fw-500">
											<button class="btn btn-xs btn-primary waves-effect waves-themed" role="button" data-toggle="modal" data-target=".upload-modal-right">Lihat Detail</button>
										</span>
									</li>
								</ul>
							</div>
						</div>
						<div class="col mt-2">
							<nav class="nav nav-pills" role="tablist">
								<a class="nav-item nav-link btn-xs btn-outline-danger" type="button" data-toggle="pill" href="#nav_pills_default-1"><i class="fas fa-map-pin mr-1"></i>Wajib Tanam</a>
								<a class="nav-item nav-link btn-xs btn-outline-info" data-toggle="pill" href="#nav_pills_default-2"><i class="fas fa-map-marker-check mr-1"></i>Terverifikasi</a>
								<a class="nav-item nav-link btn-xs btn-outline-success" data-toggle="pill" href="#nav_pills_default-3"><i class="fal fa-flag-checkered mr-1"></i>Lunas</a>
							</nav>
							<div class="tab-content py-3 small">
								<div class="tab-pane fade text-muted" id="nav_pills_default-1" role="tabpanel">
									Menunjukkan titik lokasi dan petak lahan yang dilaporkan oleh pelaku usaha (show data realisasi only).
								</div>
								<div class="tab-pane fade" id="nav_pills_default-2" role="tabpanel">
									Menunjukkan lokasi lahan yang telah diverifikasi dengan hasil verifikasi sesuai baik verifikasi wajib tanam maupun wajib produksi (show data verified only).
								</div>
								<div class="tab-pane fade" id="nav_pills_default-3" role="tabpanel">
									Menunjukkan lokasi lahan yang telah dinyatakan lunas.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="text-medium-emphasis small d-flex justify-content-between">
					<div class="d-none d-md-block">
						<span class="text-muted">This footer will be used to display anything else.</span>
					</div>
					<div class="text-muted"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal upload Right -->
	<div class="modal fade upload-modal-right" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-right">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4">Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="carousel slide" data-ride="carousel" id="carouselProduksi">
						<div class="carousel-inner">
							<div class="carousel-item active text-center" style="height:30vh">
								<img class="img-responsive card-image-top" src="{{ asset('img/demo/gallery/34.jpg') }}" alt="Judul foto" style="height:30vh; widht:100%;">
							</div>
							<div class="carousel-item text-center" style="height:30vh">
								<img class="img-responsive card-image-top" src="{{ asset('img/demo/gallery/52.jpg') }}" alt="Judul foto" style="height:30vh; widht:100%;">
								<div class="carousel-caption caption d-none d-md-block">
								</div>
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselProduksi" role="button" data-slide="prev">
							<i class="fas fa-chevron-left fa-2x text-warning" style="" aria-hidden="true"></i>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselProduksi" role="button" data-slide="next">
							<i class="fas fa-chevron-right fa-2x text-warning" style="" aria-hidden="true"></i>
							<span class="sr-only">Next</span>
						</a>
					</div>
					<div class="card-body">
						<h5 class="card-title fw-500">Petak 01</h5>
						<ul class="list-group mt-0">
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Pengelola</a>
								<span class="fw-500">Hadi Sudiro</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Nama Lahan</a>
								<span class="fw-500">Petak 01</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Kelompoktani</a>
								<span class="fw-500">Tani Makmur</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Periode Tanam</a>
								<span class="fw-500">Jul-Aug</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Tanggal Tanam</a>
								<span class="fw-500">11-07-2022</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Varietas</a>
								<span class="fw-500">0.75 ha</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Luas Tanam</a>
								<span class="fw-500">0.75 ha</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Tanggal produksi</a>
								<span class="fw-500">11-07-2022</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Produksi</a>
								<span class="fw-500">12 ton</span>
							</li>
						</ul>
						<ul class="list-group mt-3">
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Nomor RIPH</a>
								<span class="fw-500">.../PP.240/D/MM/YYYY</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Status Verifikasi Tanam</a>
								<span class="fw-500 badge btn-xs btn-success">Verified</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Status Verifikasi Produksi</a>
								<span class="fw-500 btn-xs btn-success">Verified</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Status Verifikasi Online</a>
								<span class="fw-500 btn-xs btn-success">Verified</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal upload -->
</div>
{{-- End Page Content --}}

@endsection
@section('scripts')
@parent
<script src="{{ asset('js/miscellaneous/jqvmap/jqvmap.bundle.js') }}"></script>
<script src="{{ asset('js/miscellaneous/jqvmap/maps/jquery.vmap.indonesia.js') }}"></script>
<script type="text/javascript" >
        $(function () 
        {
            $('#vector-map').vectorMap(
            {
                map: 'indonesia_id',
                enableZoom: true,
                backgroundColor: 'transparent',
                color: color.warning._50,
                borderOpacity: 0.5,
                borderWidth: 1,
                hoverColor: color.primary._300,
                hoverOpacity: null,
                selectedColor: color.success._500,
                enableZoom: true,
                showTooltip: true,
                scaleColors: [color.primary._400, color.primary._50],
                normalizeFunction: 'polynomial',
                onRegionClick: function(element, code, region)
                {
                    var message = 'You clicked "'
                    + region
                    + '" which has the code: '
                    + code.toLowerCase();
        
                    //console.log(message);

                    var randomNumber = Math.floor(Math.random() * 10000000);
                    var arrow;

                    if (Math.random() >= 0.5 == true)
                    {
                        arrow = '<div class="ml-2 d-inline-flex"><i class="fal fa-caret-up text-success fs-xs"></i></div>'
                    }
                    else
                    {
                        arrow = '<div class="ml-2 d-inline-flex"><i class="fal fa-caret-down text-danger fs-xs"></i></div>'
                    }

                    $('.js-jqvmap-flag').attr('src', '/img/prov_logo/' + code.toLowerCase() + '.svg');
                    $('.js-jqvmap-prov').html(region);
                }
            });
        });
</script>
@endsection