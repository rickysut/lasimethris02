@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')

<form method="POST" action="{{route('admin.task.pks.store')}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
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
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Kelompoktani Mitra</span>
                                    <h6 class="fw-500 my-0">API Nama Kelompoktani</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Kecamatan</span>
                                    <h6 class="fw-500 my-0">API Kecamatan</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Desa/Kel</span>
                                    <h6 class="fw-500 my-0">API Desa</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Jumlah Anggota</span>
                                    <h6 class="fw-500 my-0">API</h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Luas Garapan</span>
                                    <h6 class="fw-500 my-0">API <sup>ha</sup></h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <span class="text-muted">Periode Tanam</span>
                                    <h6 class="fw-500 my-0">API</h6>
                                </div>
                            </li>
                        </ul>
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
                                    <label class="form-label" for="simpleinputInvalid">Nomor Perjanjian</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend3">123</span>
                                        </div>
                                        <input type="text" class="form-control " id="simpleinputInvalid" required>
                                    </div>
                                    <div class="help-block">
                                        Masukkan nomor Surat Perjanjian Kerjasama dengan Kelompoktani Mitra.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal perjanjian</label>
                                    <div class="input-daterange input-group" id="datepickerstart">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
                                        </div>
                                        <input type="text" class="form-control " name="start" required>
                                    </div>
                                    <div class="help-block">
                                        Pilih Tanggal perjanjian ditandatangani.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal berakhir perjanjian</label>
                                    <div class="input-daterange input-group" id="datepickerend">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
                                        </div>
                                        <input type="text" class="form-control " name="end" required>
                                    </div>
                                    <div class="help-block">
                                        Pilih Tanggal berakhirnya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="simpleinputInvalid">Jumlah Anggota</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend3">
                                                <i class="fal fa-users"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control " id="simpleinputInvalid" required>
                                    </div>
                                    <div class="help-block">
                                        Jumlah Anggota sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="simpleinputInvalid">Luas Rencana</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend3"><i class="fal fa-ruler"></i></span>
                                        </div>
                                        <input type="number" class="form-control " id="simpleinputInvalid" required>
                                    </div>
                                    <div class="help-block">
                                        Jumlah Luas total sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="varietas">Varietas Tanam</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="varietas"><i class="fal fa-seedling"></i></span>
                                        </div>
                                        <input type="text" class="form-control " id="varietas" required>
                                    </div>
                                    <div class="help-block">
                                        Varietas ditanam sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="periode">Periode Tanam</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="varietas"><i class="fal fa-calendar-week"></i></span>
                                        </div>
                                        <input type="text" class="form-control " id="periode" required>
                                    </div>
                                    <div class="help-block">
                                        Periode tanam sesuai dokumen perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="provinsi">Provinsi</label>
                                    <div class="input-group">
                                        <select class="select2-prov form-control" id="provinsi" required>
                                            <option></option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="help-block">
                                        Provinsi tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="kabupaten">Kabupaten/Kota</label>
                                    <div class="input-group">
                                        <select class="select2-kab form-control" id="kabupaten" required>
                                            <option></option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="help-block">
                                        Pilih Kabupaten tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="kecamatan">Kecamatan</label>
                                    <div class="input-group">
                                        <select class="select2-kec form-control" id="kecamatan" required>
                                            <option></option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="help-block">
                                        Pilih Kecamatan tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="desa">Desa</label>
                                    <div class="input-group">
                                        <select class="select2-des form-control" id="desa" required>
                                            <option></option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="help-block">
                                        Pilih Desa tempat terjadinya perjanjian.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Unggah Berkas PKS (Perjanjian Kerjasama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend3">PKS</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="pksFile" required>
                                        <label class="custom-file-label" for="pksFile">Choose file...</label>
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

@endsection