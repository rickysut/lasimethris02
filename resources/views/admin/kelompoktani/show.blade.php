@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
{{-- @include('partials.subheader') --}}
@can('kelompoktani_show')
    
    <div class="row">
        <!-- Left Panel -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel" id="panel-1">
                        <div class="panel-hdr">
                            <h2>
                                DETAIL <span class="fw-300"><i>KELOMPOKTANI</i></span>
                            </h2>
                            <div class="panel-toolbar">
                                <a class="btn btn-xs btn-primary mr-2" href="{{ url()->previous() }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <div class="panel-toolbar">
                                @include('partials.globaltoolbar')
                            </div>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div>
                                            <span class="text-muted">Kelompok Tani</span>
                                            <h6 class="fw-500 my-0">{{ $poktan->nama_poktan }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <span class="text-muted">ID Simluhtan</span>
                                            <h6 class="fw-500 my-0">{{ $poktan->no_poktan }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div>
                                            <span class="text-muted">Alamat</span>
                                            <h6 class="fw-500 my-0">{{ $poktan->alamat }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <span class="text-muted">Provinsi</span>
                                            <h6 class="fw-500 my-0">{{ $poktan->provinsi }}</h6>
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <span class="text-muted">Kabupaten</span>
                                            <h6 class="fw-500 my-0">{{ $poktan->kabupaten }}</h6>
                                        </div>    
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div>
                                            <span class="text-muted">Kecamatan</span>
                                            <h6 class="fw-500 my-0">{{ $poktan->kecamatan }}</h6>
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <span class="text-muted">Desa</span>
                                            <h6 class="fw-500 my-0">{{ $poktan->desa }}</h6>
                                        </div>    
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div>
                                            <span class="text-muted">Pimpinan</span>
                                            <h6 class="fw-500 my-0">{{ $poktan->pimpinan }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <span class="text-muted">No. HP</span>
                                            <h6 class="fw-500 my-0">{{ $poktan->no_hp }}</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div>
                                            <span class="text-muted">Jumlah Anggota</span>
                                            <h6 class="fw-500 my-0">{{ number_format($poktan->jumlah_anggota,0,',', '.') }} orang</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <span class="text-muted">Luas. Lahan</span>
                                            <h6 class="fw-500 my-0">{{ number_format($poktan->luas_lahan,2,',', '.') }} ha</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@parent


@endsection