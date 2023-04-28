@extends('layouts.admin')
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')

	@can('commitment_access')
		@include('partials.sysalert')
		<div class="row">
			<div class="col-12">
				<div class="panel" id="panel-1">
					<div class="panel-hdr">
						<h2>Daftar Pengajuan</h2>
						<div class="panel-toolbar">
							<span class="help-block">
								Daftar Pengajuan Permohonan Verifikasi Realisasi Komitmen untuk data RIPH sebelum 2023.
							</span>
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<table id="dataPengajuan" class="table table-sm table-bordered table-striped w-100">
								<thead>
									<tr>
										<th>Nama Lokasi</th>
										<th>No. Perjanjian</th>
										<th>Tanggal Pengajuan</th>
										<th>Luas Dilaporkan</th>
										<th>Volume Dilaporkan</th>
										<th>Luas Verifikasi</th>
										<th>Volume Verifikasi</th>
										<th>Status Hasil</th>
										<th>Status Periksa</th>
										<th>Tindakan</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($onfarms as $onfarm)
										<tr>
											<td>{{$onfarm->id}}</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="{{route('admin.task.verifikasiv2.onfarm.check', $onfarm->id)}}">Check</a>
											</td>
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
@endsection
