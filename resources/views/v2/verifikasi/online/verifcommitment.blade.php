@extends('layouts.admin')
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')
	@can('commitment_access')
		@include('partials.sysalert')
		<div class="row">
			<div class="col-12">
				<div id="panel-1" class="panel">
					<div class="panel-container show">
						<div class="panel-content">
							
								@method('PUT')
								@csrf
								<div class="row d-flex justify-content-between">
									<div class="form-group col-md-4">
										<label class="form-label" for="no_pengajuan">Nomor Pengajuan</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fal fa-file-invoice"></i>
												</span>
											</div>
											<input type="text" class="form-control form-control-sm" id="no_pengajuan"
												value="{{$verifikasi->no_pengajuan}}" disabled>
										</div>
										<span class="help-block">Nomor Pengajuan Verifikasi.</span>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label" for="no_ijin">Nomor RIPH</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fal fa-file-invoice"></i>
												</span>
											</div>
											<input type="text" class="form-control form-control-sm" id="no_ijin"
												value="{{$verifikasi->commitmentbackdate->no_ijin}}" disabled>
										</div>
										<span class="help-block">Nomor Pengajuan Verifikasi.</span>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label" for="statusVerif">Tanggal Pengajuan</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fal fa-calendar-day"></i>
												</span>
											</div>
											<input type="text" class="form-control form-control-sm" id="created_at"
												value="{{$verifikasi->created_at}}" disabled>
										</div>
										<span class="help-block">Tanggal pengajuan permohonan verifikasi oleh Pelaku Usaha.</span>
									</div>
								</div>
						</div>
					</div>
				</div>
				<div id="panel-2" class="panel">
					<form action="{{route('admin.task.verifikasiv2.online.verifcommitmentupdate', $verifCommitment->id)}}" method="POST" id="form1">
						@csrf
						@method('PUT')
						<div class="panel-hdr">
							<h2>Kelengkapan Berkas</h2>
							<div class="panel-toolbar"></div>
						</div>
						<div class="panel-container show">
							<div class="alert alert-info border-0 mb-0">
								<div class="d-flex align-item-center">
									<i class="fal fa-info-circle mr-1"></i>
									<div class="flex-1">
										<span>Berikut ini adalah berkas-berkas kelengkapan yang diunggah oleh Pelaku Usaha.</span>
									</div>
								</div>
							</div>
							<div class="panel-content">
								<table class="table table-striped table-bordered w-100" id="attchCheck">
									<thead class="card-header">
										<tr>
											<th class="text-uppercase text-muted">Form</th>
											<th class="text-uppercase text-muted">Nama Berkas</th>
											<th class="text-uppercase text-muted">Tindakan</th>
											<th class="text-uppercase text-muted">Hasil Periksa</th>
										</tr>
									</thead>
									<tbody>
										<tr class="align-items-center">
											<td>Penerbitan RIPH</td>
											<td>
												@if ($commitments->formRiph)
													<span class="text-primary">{{ $commitments->formRiph }}</span>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												@if($commitments->formRiph)
													<a href="#" data-toggle="modal" data-target="#viewDocs"
														data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formRiph/' . $commitments->formRiph) }}">
														<i class="fas fa-search mr-1"></i>
														Periksa Dokumen
													</a>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												<select type="text" id="formRiph" name="formRiph" class="form-control form-control-sm">
													<option hidden>- pilih status periksa</option>
													<option value="Sesuai" {{ $verifCommitment && $verifCommitment->formRiph == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
													<option value="Tidak Sesuai" {{ $verifCommitment && $verifCommitment->formRiph == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>

												</select>
											</td>
										</tr>
										<tr>
											<td>Form SPTJM</td>
											<td>
												@if ($commitments->formSptjm)
													<span class="text-primary">{{ $commitments->formSptjm }}</span>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												@if ($commitments->formSptjm)
													<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formSptjm/' . $commitments->formSptjm) }}">
														<i class="fas fa-search mr-1"></i>
														Periksa Dokumen
													</a>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												<select type="text" id="formSptjm" name="formSptjm" class="form-control form-control-sm">
													<option hidden value="">- pilih status periksa</option>
													<option value="Sesuai" {{ $verifCommitment && $verifCommitment->formSptjm == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
													<option value="Tidak Sesuai" {{ $verifCommitment && $verifCommitment->formSptjm == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Logbook</td>
											<td>
												@if ($commitments->logbook)
													<span class="text-primary">{{ $commitments->logbook }}</span>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												@if ($commitments->logbook)
													<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/logbook/' . $commitments->logbook) }}">
														<i class="fas fa-search mr-1"></i>
														Periksa Dokumen
													</a>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												<select type="text" id="logbook" name="logbook" class="form-control form-control-sm">
													<option hidden value="">- pilih status periksa</option>
													<option value="Sesuai" {{ $verifCommitment && $verifCommitment->logbook == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
													<option value="Tidak Sesuai" {{ $verifCommitment && $verifCommitment->logbook == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Form RT</td>
											<td>
												@if ($commitments->formRt)
													<span class="text-primary">{{ $commitments->formRt }}</span>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												@if ($commitments->formRt)
													<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formRt/' . $commitments->formRt) }}">
														<i class="fas fa-search mr-1"></i>
														Periksa Dokumen
													</a>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												<select type="text" id="formRt" name="formRt" class="form-control form-control-sm">
													<option hidden value="">- pilih status periksa</option>
													<option value="Sesuai" {{ $verifCommitment && $verifCommitment->formRt == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
													<option value="Tidak Sesuai" {{ $verifCommitment && $verifCommitment->formRt == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Form RTA</td>
											<td>
												@if ($commitments->formRta)
													<span class="text-primary">{{ $commitments->formRta }}</span>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												@if ($commitments->formRta)
													<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formRta/' . $commitments->formRta) }}">
														<i class="fas fa-search mr-1"></i>
														Periksa Dokumen
													</a>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												<select type="text" id="formRta" name="formRta" class="form-control form-control-sm">
													<option hidden value="">- pilih status periksa</option>
													<option value="Sesuai" {{ $verifCommitment && $verifCommitment->formRta == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
													<option value="Tidak Sesuai" {{ $verifCommitment && $verifCommitment->formRta == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Form RPO</td>
											<td>
												@if ($commitments->formRpo)
													<span class="text-primary">{{ $commitments->formRpo }}</span>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												@if ($commitments->formRpo)
													<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formRpo/' . $commitments->formRpo) }}">
														<i class="fas fa-search mr-1"></i>
														Periksa Dokumen
													</a>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												<select type="text" id="formRpo" name="formRpo" class="form-control form-control-sm">
													<option hidden value="">- pilih status periksa</option>
													<option value="Sesuai" {{ $verifCommitment && $verifCommitment->formRpo == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
													<option value="Tidak Sesuai" {{ $verifCommitment && $verifCommitment->formRpo == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Form LA</td>
											<td>
												@if ($commitments->formLa)
													<span class="text-primary">{{ $commitments->formLa }}</span>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												@if ($commitments->formLa)
													<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/docs/commitmentsv2/' . $commitments->periodetahun . '/formLa/' . $commitments->formLa) }}">
														<i class="fas fa-search mr-1"></i>
														Periksa Dokumen
													</a>
												@else
													<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
												@endif
											</td>
											<td>
												<select type="text" id="formLa" name="formLa" name="formLa" class="form-control form-control-sm">
													<option hidden value="">- pilih status periksa</option>
													<option value="Sesuai" {{ $verifCommitment && $verifCommitment->formLa == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
													<option value="Tidak Sesuai" {{ $verifCommitment && $verifCommitment->formLa == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="panel-content">
								<div class="form-group">
									<label for="">Catatan Pemeriksaan</label>
									<textarea class="form-control form-control-sm" name="note" id="note" rows="5">{{ old('note', $verifCommitment ? $verifCommitment->note : '') }}</textarea>
									<small id="helpId" class="text-muted">Berikan catatan hasil pemeriksaan.</small>
								</div>
							</div>
						</div>
						<div class="card-footer d-flex justify-content-between align-items-center">
							<div class="help-block col-md-7">
								<ul class="list-group">Keterangan
									<li class="d-flex justify-content-start">
										<span class="col-2">Sesuai:</span>
										<span>Jika salinan yang diunggah ADA dan SESUAI</span>
									</li>
									<li class="d-flex justify-content-start">
										<span class="col-2">Tidak Sesuai:</span>
										<span>Jika salinan yang diunggah TIDAK ADA atau ADA namun TIDAK SESUAI</span>
									</li>
								</ul>
							</div>
							<div class="">
								<button class="btn btn-sm btn-info"><i class="fal fa-undo mr-1"></i> Batal</button>
								<button class="btn btn-sm btn-warning" type="submit"><i class="fal fa-save mr-1"></i>Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		{{-- modal view doc --}}
		<div class="modal fade modal-fullscreen" id="viewDocs" tabindex="-1" role="dialog" aria-labelledby="document" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							Berkas <span class="fw-300"><i>lampiran </i></span>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<iframe src="" width="100%" height="100%"></iframe>
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
			$('#viewDocs').on('shown.bs.modal', function (e) {
				var docUrl = $(e.relatedTarget).data('doc');
				$('iframe').attr('src', docUrl);
			});
		});
	</script>
@endsection
