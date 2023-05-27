@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')

@can('pks_create')
<div class="row">
    <div class="col">
        <div class="panel" id="panel-2">
            <div class="panel-hdr">
                <h2>
                    Data Perjanjian<span class="fw-300"><i>Kerjasama</i></span>
                </h2>
                <div class="panel-toolbar">
                    <span class="mr-1">RIPH Nomor:</span>
                        <a href="{{route('admin.task.commitment.show', $pull->id)}}"
                            class="fw-500">
                            {{$nomor}}
                        </a>
                    <span>
                </div>
            </div>
            <form method="POST" action="{{route('admin.task.pks.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="npwp" value="{{ $npwp }}">
                <input type="hidden" name="no_riph" value="{{ $nomor }}">
                <input type="hidden" name="id_poktan" value="{{ $idpoktan }}">

                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row d-flex">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="no_perjanjian">Nomor Perjanjian</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="no_perjanjian">123</span>
                                        </div>
                                        <input type="text" class="form-control " id="no_perjanjian" name="no_perjanjian"
                                            required>
                                    </div>
                                    <div class="help-block">
                                        Nomor Pejanjian Kerjasama dengan Poktan Mitra.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="master_kelompok_id">Kelompoktani - Pimpinan</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control " readonly value="{{$poktans[0]->nama_kelompok}} - {{$poktans[0]->nama_pimpinan}}">
                                    </div>
                                    <div class="help-block">
                                        Kelompoktani Mitra pelaksanaan wajib tanam-produksi sesuai dokumen PKS.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal perjanjian</label>
                                    <div class="input-daterange input-group" id="tgl_perjanjian_start" name="tgl_perjanjian_start">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
                                        </div>
                                        <input type="date" name="tgl_perjanjian_start" id="tgl_perjanjian_start"
                                            class="form-control " placeholder="tanggal mulai perjanjian"
                                            aria-describedby="helpId">
                                    </div>
                                    <div class="help-block">
                                        Pilih Tanggal perjanjian ditandatangani.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal berakhir perjanjian</label>
                                    <div class="input-daterange input-group" id="tgl_perjanjian_end" name="tgl_perjanjian_end">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
                                        </div>
                                        <input type="date" name="tgl_perjanjian_end" id="tgl_perjanjian_end"
                                            class="form-control " placeholder="tanggal akhir perjanjian"
                                            aria-describedby="helpId">
                                    </div>
                                    <div class="help-block">
                                        Pilih Tanggal berakhirnya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="simpleinputInvalid">Luas Rencana (ha)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend3"><i class="fal fa-ruler"></i></span>
                                        </div>
                                        <input type="number" class="form-control " name="luas_rencana" id="luas_rencana" >
                                    </div>
                                    <div class="help-block">
                                        Jumlah Luas total sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="varietas_tanam">Varietas Tanam</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="varietas_tanam"><i class="fal fa-seedling"></i></span>
                                        </div>
                                        <input type="text" class="form-control " name="varietas_tanam" id="varietas_tanam"
                                            placeholder="varietas yang akan ditanam" >
                                    </div>
                                    <div class="help-block">
                                        Varietas ditanam sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="periode">Periode Tanam</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="varietas"><i class="fal fa-calendar-week"></i></span>
                                        </div>
                                        <input type="text" name="periode_tanam" id="periode_tanam"
                                            class="form-control " placeholder="misal: Jan-Feb" aria-describedby="helpId">
                                    </div>
                                    <div class="help-block">
                                        Periode tanam sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="provinsi">Provinsi</label>
                                    <div class="input-group">
                                        <select id="province" class="select2-prov form-control w-100" name="provinsi" required>
                                            <optgroup label="Provinsi">
                                                @foreach ($provinsi['data'] as $data )
                                                    <option value="{{ $data['kd_prop'] }}" @if($poktans[0]->id_provinsi == $data['kd_prop']) selected @endif >{{ $data['nm_prop'] }}</option>    
                                                @endforeach
                                                
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="help-block">
                                        Provinsi tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="kabupaten">Kabupaten/Kota</label>
                                    <div class="input-group">
                                        <select id="kabupaten" class="select2-kab form-control w-100" name="kabupaten" required>
                                            @foreach ($kabupaten['data'] as $data )
                                                <option value="{{ $data['kd_kab'] }}" @if($poktans[0]->id_kabupaten== $data['kd_kab']) selected @endif>{{ $data['nama_kab'] }}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="help-block">
                                        Pilih Kabupaten tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="kecamatan">Kecamatan</label>
                                    <div class="input-group">
                                        <select id="kecamatan" class="select2-kec form-control w-100" name="kecamatan" required>
                                            @foreach ($kecamatan['data'] as $data )
                                                <option value="{{ $data['kd_kec'] }}" @if($poktans[0]->id_kecamatan == $data['kd_kec']) selected @endif>{{ $data['nm_kec'] }}</option>    
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                    <div class="help-block">
                                        Pilih Kecamatan tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="kelurahan_id">Desa</label>
                                    <div class="input-group">
                                        <select id="desa" class="select2-des form-control w-100" name="desa" required>
                                            @foreach ($desa['data'] as $data )
                                                <option value="{{ $data['kd_desa'] }}" @if($poktans[0]->id_kelurahan == $data['kd_desa']) selected @endif>{{ $data['nm_desa'] }}</option>    
                                            @endforeach
                                        </select>  
                                    </div>
                                    <div class="help-block">
                                        Pilih Desa tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Unggah Berkas PKS (Perjanjian Kerjasama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend3">PKS</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas_pks"  name="berkas_pks" required>
                                        <label class="custom-file-label" for="berkas_pks">Choose file...</label>
                                    </div>
                                </div>
                                <div class="help-block">Unggah hasil pemindaian berkas Form-5 dalam bentuk pdf.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-4 ml-auto text-right">
                        <a href="{{route('admin.task.pks.index')}}" class="btn btn-warning btn-sm">
                            <i class="fal fa-undo mr-1"></i>Batal
                        </a>
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="fal fa-save mr-1"></i>Simpan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endcan

@endsection

@section('scripts')
@parent
<script src="/js/formplugins/select2/select2.bundle.js"></script>
<script>
    $(document).ready(function() {
        $('#province').on('change', function() {
            var province_id =$(this).val();
            $.ajax({
                type: 'get',
                url: '/api/getAPIKabupatenProp',
                data: {'provinsi':province_id},
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
            $.ajax({
                type: 'get',
                url: '/api/getAPIKecamatanKab',
                data: {'kabupaten':kab_id},
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
            $.ajax({
                type: 'get',
                url: '/api/getAPIDesaKec',
                data: {'kecamatan':kec_id},
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