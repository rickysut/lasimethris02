@extends('layouts.admin')
@section('styles')

@endsection
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')

@can('poktan_access')

<div class="row">
	<div class="col-12">
		<div class="text-center">
			<i class="fa fa-check fa-3x text-success"></i>
			<h2>Selamat!</h2>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-8 order-md-2 mb-4">
				<p class="lead fs-md">Terima kasih Anda telah mengajukan permohonan Verifikasi. Kami akan segera menindaklanjuti pengajuan Anda </p>
				<p>Berikut ini adalah data Pengajuan Permohonan Verifikasi Anda.</p>
				<div class="card">

					<table class="table table-bordered w-100">
						<thead>
							<th>No. Pengajuan</th>
							<th>No. RIPH</th>
							<th>Tanggal Pengajuan</th>
							<th>Jenis Pengajuan</th>
						</thead>
						<tbody>
							<tr>
								<td> {{$pengajuan->no_pengajuan}} </td>
								<td> {{$pengajuan->commitmentbackdate->no_ijin}} </td>
								<td> {{$pengajuan->created_at}} </td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
				<p>Anda dapat melihat dan melacak status pengajuan permohonan Anda pada menu <a href="{{route('admin.task.pengajuanv2.index')}}">Permohonan</a>.</p>
			</div>
		</div>

	</div>
</div>

@endcan
@endsection

@section('scripts')
@parent


@endsection