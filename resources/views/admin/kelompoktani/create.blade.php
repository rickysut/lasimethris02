@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
{{-- @include('partials.subheader') --}}
@can('kelompoktani_create')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route("admin.task.kelompoktani.store") }}" enctype="multipart/form-data">
            @csrf
            <div id="panel-1" class="panel" data-title="Panel Data" data-intro="Panel ini berisi data-data" data-step="2">
                <div class="panel-hdr">
                    <h2>
                        Kelompoktani | <span class="fw-300"><i>Tambah data</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <div class="form-group">
                            <button class="btn btn-success  waves-effect waves-themed btn-sm mr-2 btnsave" type="submit">
                                {{ trans('global.save') }}
                            </button>
                            <a class="btn btn-danger  waves-effect waves-themed btn-sm mr-2" href="{{ route('admin.task.kelompoktani.index') }}">
                                {{ trans('global.cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="required" for="nama_poktan">{{ __('Kelompok Tani') }} <span class="text-danger">*</span></label>
                                    <input class="form-control {{ $errors->has('nama_poktan') ? 'is-invalid' : '' }}" type="text" name="nama_poktan" id="nama_poktan" value="{{ old('nama_poktan', '') }}" required>
                                    @if($errors->has('nama_poktan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nama_poktan') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ __('Nama Kelompoktani binaan.') }}</span>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="required" for="id_simluhtan">{{ __('ID Simluhtan ') }} </label>
                                    <input class="form-control {{ $errors->has('id_simluhtan') ? 'is-invalid' : '' }}" type="text" name="id_simluhtan" id="id_simluhtan" value="{{ old('id_simluhtan', '') }}" >
                                    @if($errors->has('id_simluhtan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('id_simluhtan') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ __('Nomor ID Kelompoktani pada aplikasi SIMLUHTAN (jika ada).') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="address">Alamat <span class="text-danger">*</span></label>
                                <textarea type="text" name="alamat" id="address" class="form-control" placeholder="Alamat lengkap" rows="3"></textarea>
                                <div class="help-block">Alamat lengkap domisili kelompoktani.</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="provinsi">Provinsi <span class="text-danger">*</span></label>
                                <select id="province" class="form-control w-100" name="provinsi" required>
                                    @foreach ($provinsis['data'] as $data )
                                        <option value="{{ $data['kd_prop'] }}">{{ $data['nm_prop'] }}</option>    
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
                                <select id="kabupaten" class="form-control w-100" name="kabupaten" required>
                                    @foreach ($kabupatens['data'] as $data )
                                        <option value="{{ $data['kd_kab'] }}">{{ $data['nama_kab'] }}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                <select id="kecamatan" class="form-control w-100" name="kecamatan" required>
                                    @foreach ($kecamatans['data'] as $data )
                                        <option value="{{ $data['kd_kec'] }}">{{ $data['nm_kec'] }}</option>    
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="desa">Desa <span class="text-danger">*</span></label>
                                <select id="desa" class="form-control w-100" name="desa" required>
                                    @foreach ($desas['data'] as $data )
                                        <option value="{{ $data['kd_desa'] }}">{{ $data['nm_desa'] }}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="required" for="pimpinan">Pimpinan</label>
                                    <input class="form-control {{ $errors->has('pimpinan') ? 'is-invalid' : '' }}" type="text" name="pimpinan" id="pimpinan" value="{{ old('pimpinan', '') }}" >
                                    @if($errors->has('pimpinan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('pimpinan') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Nama Pimpinan/Ketua/Penanggungjawab Kelompok Tani.</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="required" for="no_hp">No. HP</label>
                                    <input class="form-control {{ $errors->has('no_hp') ? 'is-invalid' : '' }}" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', '') }}" >
                                    @if($errors->has('no_hp'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('no_hp') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Nomor kontak pimpinan yang dapat dihubungi (jika ada).</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="required" for="jumlah_anggota">Jumlah anggota</label>
                                    <input class="form-control {{ $errors->has('jumlah_anggota') ? 'is-invalid' : '' }}" type="number" name="jumlah_anggota" id="jumlah_anggota" value="{{ old('jumlah_anggota', '') }}" >
                                    @if($errors->has('jumlah_anggota'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('jumlah_anggota') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Jumlah anggota Kelompok Tani.</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="required" for="luas_lahan">Luas lahan</label>
                                    <input class="form-control {{ $errors->has('luas_lahan') ? 'is-invalid' : '' }}" type="number" step="0.01" name="luas_lahan" id="luas_lahan" value="{{ old('luas_lahan', '') }}" >
                                    @if($errors->has('luas_lahan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('luas_lahan') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Luas lahan tanam.</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endcan
@endsection
<!-- @parent -->
<!-- start script for this page -->
@section('scripts')
<script src="/js/formplugins/select2/select2.bundle.js"></script>
<script>
    $(document).ready(function() {
        $('#province').on('change', function() {
            var province_id =$(this).val();
            var token = "{{ $access_token }}";
            $.ajax({
                type: 'get',
                url: '/api/getAPIKabupatenProp',
                data: {'token': token, 'provinsi':province_id},
                success: function(data){
                    $('#kabupaten').find('option').remove().end();
                    $('#kecamatan').find('option').remove().end();
                    $('#desa').find('option').remove().end();
                    for (var i = 0; i < data.data.length; i++){
                        $('#kabupaten')
                        .find('option')
                        .end()
                        .append('<option value="'+data.data[i].kd_kab+'">'+data.data[i].nama_kab+'</option>');
                    }
                    $('#kabupaten').trigger("change");
                },
                error: function(){
                    console.log('error load kabupaten');
                },
            });
        });
        $('#kabupaten').on('change', function() {
            var kab_id =$(this).val();
            var token = "{{ $access_token }}";
            $.ajax({
                type: 'get',
                url: '/api/getAPIKecamatanKab',
                data: {'token': token, 'kabupaten':kab_id},
                success: function(data){
                    $('#kecamatan').find('option').remove().end();
                    $('#desa').find('option').remove().end();
                    for (var i = 0; i < data.data.length; i++){
                        $('#kecamatan')
                        .find('option')
                        .end()
                        .append('<option value="'+data.data[i].kd_kec+'">'+data.data[i].nm_kec+'</option>');
                    }
                    $('#kecamatan').trigger("change");
                },
                error: function(){
                    console.log('error load kecamatan');
                },
            });
        });
        $('#kecamatan').on('change', function() {
            var kec_id =$(this).val();
            var token = "{{ $access_token }}";
            console
            $.ajax({
                type: 'get',
                url: '/api/getAPIDesaKec',
                data: {'token': token, 'kecamatan':kec_id},
                success: function(data){
                    $('#desa').find('option').remove().end();
                    for (var i = 0; i < data.data.length; i++){
                        $('#desa')
                        .find('option')
                        .end()
                        .append('<option value="'+data.data[i].kd_desa+'">'+data.data[i].nm_desa+'</option>');
                    }
                },
                error: function(){
                    console.log('error load desa');
                },
            });
        });
        
    });
</script>
@endsection