@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')
@can('commitment_show')
	<div class="row">
		<div class="col">
			<div class="panel" id="panel-6">
				<div class="panel-hdr">
					<h2>
						Daftar <span class="fw-300"><i>Penangkar Benih Mitra</i></span>
					</h2>
					<div class="panel-toolbar">
						Nomor RIPH:
						<span class="ml-1">
							<a href="{{route('admin.task.commitments.show', $commitment->id)}}"
								class="fw-500">
								{{$commitment->no_ijin}}
							</a>
						</span>
                    </div>
                </div>
                <div class="panel-container show">
					<div class="panel-content">
						<form action=" {{route('admin.task.pksmitra.update', $pksmitra->id)}} "
							method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<input type="text" name="commitmentbackdate_id" id="commitmentbackdate_id"
							class="form-control " placeholder="" aria-describedby="helpId"
							value="{{$commitment->id}}" hidden>
							<input type="text" name="no_ijin" id="no_ijin"
								class="form-control " placeholder="" aria-describedby="helpId"
								value="{{$commitment->no_ijin}}" hidden>
							<div class="row d-flex">
								<div class="form-group col-md-6">
									<label for="">Nomor PKS</label>
									<input type="text" name="no_pks" id="no_pks"
										class="form-control " placeholder="misal: 001/PKS/PTABC/V/2022"
										value="{{ old('no_pks', $pksmitra->no_pks) }}"
										aria-describedby="helpId" hi>
									<small id="helpId" class="text-muted">Nomor Perjanjian Kerjasama dengan Poktan Mitra</small>
								</div>
								<div class="form-group col-md-6">
									<label for="master_kelompok_id">Kelompok Tani</label>
										<select class="form-control custom-select selecteditpoktan"
											name="master_kelompok_id" id="master_kelompok_id">
											<option value="{{ isset($pksmitra) ? $pksmitra->masterkelompok->id : '' }}">
												{{ isset($pksmitra) ? $pksmitra->masterkelompok->id. ' . ' . 
												$pksmitra->masterkelompok->nama_kelompok . ' - ' . 
												$pksmitra->masterkelompok->nama_pimpinan : 'Load Record' }}
											</option>
											@foreach ($masterkelompoks as $poktan)
												<option value="{{$poktan->id}}">
													{{$poktan->id}}. {{$poktan->nama_kelompok}} - {{$poktan->nama_pimpinan}}
												</option>
											@endforeach
										</select>
									<small id="helpId" class="text-muted">Kelompoktani Mitra pelaksanaan wajib tanam-produksi</small>
								</div>
							</div>
							<div class="row d-flex">
								<div class="form-group col-md-6">
									<label for="">Tanggal Perjanjian</label>
									<input type="date" name="tgl_mulai" id="tanggal_mulai"
										value="{{ old('tgl_mulai', $pksmitra->tgl_mulai) }}"
										class="form-control " placeholder="tanggal mulai perjanjian"
										aria-describedby="helpId">
									<small id="helpId" class="text-muted">Tanggal mulai berlaku perjanjian</small>
								</div>
								<div class="form-group col-md-6">
									<label for="">Tanggal Akhir</label>
									<input type="date" name="tgl_akhir" id="tgl_akhir"
										value="{{ old('tgl_akhir', $pksmitra->tgl_akhir) }}"
										class="form-control " placeholder="tanggal akhir perjanjian"
										aria-describedby="helpId">
									<small id="helpId" class="text-muted">Tanggal berakhirnya perjanjian kerjasama</small>
								</div>
							</div>
							<div class="row d-flex">
								<div class="form-group col-md-4">
									<label for="">Luas Rencana Tanam</label>
									<input type="text" name="luas_rencana" id="luas_rencana"
										value="{{ old('luas_rencana', $pksmitra->luas_rencana) }}"
										class="form-control " placeholder="dalam satuan hektar (ha)"
										aria-describedby="helpId">
									{{-- <small id="helpId" class="text-muted">Luas rencana tanam yang dikerjasamakan. Dalam satuan hektar(ha)</small> --}}
								</div>
								<div class="form-group col-md-4">
									<label for="">Varietas</label>
									<input type="text" name="varietas" id="varietas"
										class="form-control " placeholder="varietas yang akan ditanam"
										value="{{ old('varietas', $pksmitra->varietas) }}"
										aria-describedby="helpId">
									{{-- <small id="helpId" class="text-muted">Varietas yang akan ditanam di lahan kerjasama.</small> --}}
								</div>
								<div class="form-group col-md-4">
									<label for="">Periode Tanam</label>
									<input type="text" name="periode_tanam" id="periode_tanam"
										class="form-control " placeholder="misal: Jan-Feb"
										value="{{ old('periode_tanam', $pksmitra->periode_tanam) }}"
										aria-describedby="helpId">
									{{-- <small id="helpId" class="text-muted">Jadwal Periode pelaksanaan penanaman.</small> --}}
								</div>
							</div>
							<div class="row d-flex">
								<div class="col-md-5">
									<div style="display: flex; flex: 1 1 auto;">
										<div class="img-square-wrapper" style="overflow: hidden;">
											@if(in_array($pksmitra->attachment, ['doc', 'docx', 'pdf']))
												<i class="fal fa-file fa-6x rounded img-cropped"></i>
											@elseif(in_array($pksmitra->attachment, ['zip', 'rar']))
												<i class="fal fa-file-archive fa-6x rounded img-cropped"></i>
											@elseif(in_array($pksmitra->attachment, ['jpg', 'jpeg', 'png', 'gif']))
												<img src="{{ asset('storage/docs/files/' . $pksmitra->attachment) }}" alt="Card image cap" class="img-cropped">
											@else
												<i class="fal fa-file fa-10x rounded img-cropped"></i>
											@endif
										</div>
										<div class="col p-3">
											<div class="d-flex justify-content-between mb-3">
												<span>Lihat berkas:</span>
												<a class="fw-500 d-block text-truncate" href="{{ asset('storage/docs/files/' . $pksmitra->attachment) }}">{{ $pksmitra->attachment }}</a>
											</div>
											<div class="form-group">
												<label class="form-label">Ganti berkas</label>
												<div class="custom-file input-group">
													<input type="file" class="custom-file-input" id="attachment" name="attachment">
													<label class="custom-file-label" for="docFile">Pilih berkas...</label>
												</div>
												<span class="help-block">Unggah dokumen pengganti berkas sebelumnya.</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button type="button" class="btn btn-outline-secondary btn-sm"
								data-dismiss="modal">
									<i class="fal fa-times-circle text-danger fw-500"></i> Close
								</button>
								<button class="btn btn-primary btn-sm" type="submit">
									<i class="fal fa-save"></i> Save changes
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
@parent

<script>
    $(document).ready(function() {
        $(function() {
			@isset($pksmitra->id)
			$(".selecteditpoktan").select2({
                placeholder: "--Pilih Kelompoktani",
            });
			@endisset
        });
    });
</script>
@endsection