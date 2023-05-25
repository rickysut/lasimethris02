@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')

@can('pks_create')
<form method="POST" action="{{route('admin.task.pks.store')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="npwp" value="{{ $npwp }}">
    <input type="hidden" name="no_riph" value="{{ $nomor }}">
    <div class="row">
        <div class="col-md-4">
            <div class="panel" id="panel-1">
                <div class="panel-hdr">
                    <h2>
                        Data<span class="fw-300"><i>PKS</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        @foreach ($poktans as $info)
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Kelompoktani Mitra</span>
                                    <h6 class="fw-500 my-0">{{ $info->nama_kelompok }}</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Kecamatan</span>
                                    <h6 class="fw-500 my-0">{{ $info->kecamatan }}</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Desa/Kel</span>
                                    <h6 class="fw-500 my-0">{{ $info->kelurahan }}</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Jumlah Anggota</span>
                                    <h6 class="fw-500 my-0">{{ $info->jum_petani }}</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Luas Garapan</span>
                                    <h6 class="fw-500 my-0">{{ $info->luas }} ha</h6>
                                </div>
                            </li>
                            {{-- <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Periode Tanam</span>
                                    <h6 class="fw-500 my-0">API</h6>
                                </div>
                            </li> --}}
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel" id="panel-2">
                <div class="panel-hdr">
                    <h2>
                        Data Isian <span class="fw-300"><i>PKS/Rencana Tanam</i></span>
                    </h2>
                    <div class="panel-toolbar">

                    </div>
                </div>
                <div class="alert alert-info border-0 mb-0">
                    <div class="d-flex align-item-center">
                        <div class="alert-icon">
                            <div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
                                <i class="base base-7 icon-stack-3x opacity-100 color-primary-400"></i>
                                <i class="base base-7 icon-stack-2x opacity-100 color-primary-800"></i>
                                <i class="fa fa-info icon-stack-1x opacity-100 color-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <span>Lengkapi kolom-kolom isian berikut sesuai dengan yang tercantum dalam Dokumen Perjanjian Kerjasama antara Pihak Pelaku Usaha dengan Kelompoktani Binaan pada panel Data Kelompoktani di sebelah kiri.</span>
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- add "was-validated" to create validation form style-->
                        <div class="row d-flex">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Perjanjian</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">123</span>
                                        </div>
                                        <input type="text" class="form-control" name="no_perjanjian" required>
                                    </div>
                                    <div class="help-block">
                                        Masukkan nomor Surat Perjanjian Kerjasama dengan Kelompoktani Mitra.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal perjanjian</label>
                                    <div class="input-group" >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="tgl_perjanjian_start" required>
                                    </div>
                                    <div class="help-block">
                                        Pilih Tanggal perjanjian ditandatangani.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal berakhir perjanjian</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
                                        </div>
                                        <input type="date" class="form-control " name="tgl_perjanjian_end" required>
                                    </div>
                                    <div class="help-block">
                                        Pilih Tanggal berakhirnya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Jumlah Anggota</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fal fa-users"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control " name="jumlah_anggota" required>
                                    </div>
                                    <div class="help-block">
                                        Jumlah Anggota sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Luas Rencana</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" ><i class="fal fa-ruler"></i></span>
                                        </div>
                                        <input type="number" class="form-control " name="luas_rencana" required>
                                    </div>
                                    <div class="help-block">
                                        Jumlah Luas total sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" >Varietas Tanam</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" ><i class="fal fa-seedling"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="varietas_tanam" required>
                                    </div>
                                    <div class="help-block">
                                        Varietas ditanam sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Periode Tanam</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-calendar-week"></i></span>
                                        </div>
                                        <input type="month" class="form-control" name="periode_tanam" required>
                                    </div>
                                    <div class="help-block">
                                        Periode tanam sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="provinsi">Provinsi</label>
                                    <select id="province" class="select2-prov form-control w-100" name="provinsi" required>
                                        <optgroup label="Provinsi">
                                            @foreach ($provinsi['data'] as $data )
                                                <option value="{{ $data['kd_prop'] }}" @if($poktans[0]->id_provinsi == $data['kd_prop']) selected @endif >{{ $data['nm_prop'] }}</option>    
                                            @endforeach
                                            
                                        </optgroup>
                                    </select>
                                    <div class="help-block">
                                        Provinsi tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="kabupaten">Kabupaten/Kota</label>
                                    <select id="kabupaten" class="select2-kab form-control w-100" name="kabupaten" required>
                                        @foreach ($kabupaten['data'] as $data )
                                            <option value="{{ $data['kd_kab'] }}" @if($poktans[0]->id_kabupaten== $data['kd_kab']) selected @endif>{{ $data['nama_kab'] }}</option>    
                                        @endforeach
                                    </select>
                                    <div class="help-block">
                                        Pilih Kabupaten tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="kecamatan">Kecamatan</label>
                                    <select id="kecamatan" class="select2-kec form-control w-100" name="kecamatan" required>
                                        @foreach ($kecamatan['data'] as $data )
                                            <option value="{{ $data['kd_kec'] }}" @if($poktans[0]->id_kecamatan == $data['kd_kec']) selected @endif>{{ $data['nm_kec'] }}</option>    
                                        @endforeach
                                        
                                    </select>
                                    <div class="help-block">
                                        Pilih Kecamatan tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="desa">Desa</label>
                                    <select id="desa" class="select2-des form-control w-100" name="desa" required>
                                        @foreach ($desa['data'] as $data )
                                            <option value="{{ $data['kd_desa'] }}" @if($poktans[0]->id_kelurahan == $data['kd_desa']) selected @endif>{{ $data['nm_desa'] }}</option>    
                                        @endforeach
                                    </select>   
                                    <div class="help-block">
                                        Pilih Desa tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Unggah Berkas PKS (Perjanjian Kerjasama)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PKS</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas_pks"  name="berkas_pks" required>
                                        <label class="custom-file-label" for="berkas_pks">Choose file...</label>
                                    </div>
                                </div>
                                <div class="help-block">Unggah hasil pemindaian berkas Form-5 dalam bentuk pdf. Ukuran berkas tidak lebih dari 2 megabytes.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-4 ml-auto text-right">
                        <a href=" {{route('admin.task.pks.index')}} " class="btn btn-warning btn-sm mt-3">Cancel</a>
                        <button id="js-login-btn" type="submit" class="btn btn-primary btn-sm mt-3">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
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