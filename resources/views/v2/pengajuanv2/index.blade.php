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
					Kelompok Tani
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-hover table-striped" id="datatable">
						<thead>
							<th>Nomor Pengajuan</th>
							<th>No. Riph</th>
							<th>Tanggal Pengajuan</th>
							<th>Status Terakhir</th>
							<th>Tanggal Status</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($pengajuans as $pengajuan)
							<tr>
								<td>{{$pengajuan->no_pengajuan}}</td>
								<td>{{$pengajuan->commitmentbackdate->no_ijin}}</td>
								<td>{{$pengajuan->created_at}}</td>
								<td>{{$pengajuan->status}}</td>
								<td>{{$pengajuan->updated_at}}</td>
							</tr>
							@endforeach
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
  // initialize datatable
	$('#datatable').dataTable({
		pagingType: 'full_numbers',
		responsive: true,
		lengthChange: false,
		pageLength: 10,
		order: [
		[0, 'asc']
		],
		dom: // Add the modal button inside the 'B' option of the 'dom' string
		"<'row'<'col-sm-12 col-md-2'fl><'col-sm-12 col-md-8 d-flex'><'col-sm-12 col-md-2 d-flex justify-content-end'B>>" +
		"<'row'<'col-sm-12 col-md-12'tr>>" +
		"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
		buttons: [
			{
				text: '<i class="fal fa-plus mr-1"></i>Kelompok Tani baru',
				className: 'btn btn-primary btn-xs',
				action: function(e, dt, node, config) {
				// find the modal element
					var $modal = $('#myModal');

					// trigger the modal's show method
					$modal.modal('show');
				}
			}
		]
	});
});

</script>

@endsection

