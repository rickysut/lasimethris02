@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/miscellaneous/lightgallery/lightgallery.bundle.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1ea90fk4RXPswzkOJzd17W3EZx_KNB1M&libraries=drawing,geometry"></script>
@endsection
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@include('partials.sysalert')
@can('commitment_show')
	<div class="row">
		<div class="col-md-12">
			<div class="panel" id="panel-1">
				<div class="panel-container show">
					<div id="allMap" style="height: 500px; width: 100%;" class="shadow-sm border-1"></div>
				</div>
			</div>
			<div class="panel" id="panel-2">
				<div class="panel-container show">
					<div class="panel-content">
						<div class="row">
							<div class="col-12">
								<span id="nama_lokasi"></span>
								<table class="table w-100">
									<tbody>
										@foreach ($anggotaMitras as $anggota)
										<tr>
											<td>{{($anggota->pksmitra->id)}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- modal show data --}}
	<!-- Modal -->
	<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="markerModal" tabindex="-1" role="dialog" aria-labelledby="markerModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-right" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary-700">
				<h5 class="modal-title fw-700 text-white" id="nama_lokasi"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card no-shadow" id="card-1">
					<img class="card-img-top img-fluide" alt="Card image cap" id="panenPict" >
					<div class="card-body">
						<ul class="list-group mt-0">
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Nama Lokasi</a>
								<span class="fw-500" id="nama_lokasi"></span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>RIPH</a>
								<span class="fw-500" id="no_ijin"></span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>PKS</a>
								<span class="fw-500" id="no_perjanjian"></span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center p-2">
								<a>Nama Lokasi</a>
								<span class="fw-500" id="nama_lokasi"></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


	

	
		

@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
<script src="{{ asset('js/miscellaneous/lightgallery/lightgallery.bundle.js') }}"></script>
@parent

<script src="{{ asset('js/gmap/allMaps.js') }}"></script>
<script src="{{ asset('js/gmap/clickMap.js') }}"></script>

<!-- gallery -->
	<script>
		$(document).ready(function() {
			var $initScope = $('#js-gallery');
			if ($initScope.length) {
				$initScope.justifiedGallery({
					border: -1,
					rowHeight: 75,
					margins: 8,
					waitThumbnailsLoad: true,
					randomize: false,
				}).on('jg.complete', function() {
					$initScope.lightGallery({
						thumbnail: true,
						animateThumb: true,
						showThumbByDefault: true,
					});
				});
			};
			$initScope.on('onAfterOpen.lg', function(event) {
				$('body').addClass("overflow-hidden");
			});
			$initScope.on('onCloseAfter.lg', function(event) {
				$('body').removeClass("overflow-hidden");
			});
		});
	</script>
<!-- gallery -->
@endsection