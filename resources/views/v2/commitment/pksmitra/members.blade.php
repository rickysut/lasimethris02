@extends ('layouts.admin')
@section ('style')
@endsection
@section('content')
<div class="" data-title="System Alert" data-intro="Ini adalah Panel yang berisi informasi atau pemberitahuan penting untuk Anda." data-step="1">@include('partials.sysalert')</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel" id="panel-1">
            <!--
				Data pada panel ini adalah:
				1. Nama kelompoktani dari json RIPH
				2. Alamat (desa-provinsi) dari json riph
				3. jumlah Anggota dari count anggota json riph
				4. luas sum kolom luas (pks)
				5. periode tanam (pks)
				6. nomor perjanjian (pks)
				7. varietas (pks)
				8. tanggal (pks)
				
				halaman ini hanya merupakan contoh. halaman ini dapat diganti menjadi windows-modal. dapat pula menggunakan proses dan Metode dapat menggunakan teknologi lain yang lebih relevan dan tepat.
			-->
            <div class="panel-hdr">
                <h2>
                    DATA <span class="fw-300"><i>Kelompoktani</i></span>
                </h2>
                <div class="panel-toolbar">

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
        <div class="panel" id="panel-3">
            <div class="panel-hdr">
                <h2>
                    Daftar <span class="fw-300"><i>Anggota</i></span>
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
                        <span>
                            <p>Tabel ini berisi daftar anggota kelompoktani yang tercatat di dalam perjanjian kerjasama pelaksanaan wajib tanam dan produksi yang telah Anda daftarkan sebelumnya.</p>
                            <p><i class="fas fa-map-marked-alt text-warning mr-1"></i>ikon ini menandakan bahwa Anda belum mengisi data realisasi apapun untuk Anggota tersebut.</p>
                            <p><i class="fas fa-map-marked-alt text-info mr-1"></i>ikon ini menandakan bahwa data telah terisi. Klik ikon untuk mengisi data realisasi sesuai daftar anggota yang ada.</p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="daftaranggota" class="table table-sm table-bordered table-hover table-striped w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th id="nama_anggota">Nama Anggota</th>
                                <th id="nik">NIK</th>
                                <th id="luas">Luas</th>
                                <th id="desa">Desa</th>
                                <th id="kecamatan">Kecamatan</th>
                                <th id="kabupaten" hidden>Kabupaten</th>
                                <th id="tindakan">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>API</td>
                                <td>API</td>
                                <td>API</td>
                                <td>API</td>
                                <td>API</td>
                                <td class="" hidden>API Kabupaten</td>
                                <td class="text-center">
                                    <div class="justify-content-center">
                                        <a class="mr-1" href="{{route('v2.farm.index')}}" role="button" data-toggle="tooltip" data-original-title="Farm Management" data-offset="0,10"><i class="fas fa-map-marked-alt text-warning"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>API</td>
                                <td>API</td>
                                <td>API</td>
                                <td>API</td>
                                <td>API</td>
                                <td class="" hidden>API Kabupaten</td>
                                <td class="text-center">
                                    <div class="justify-content-between">
                                        <a class="mr-1" href="{{route('v2.farm.index')}}" role="button" data-toggle="tooltip" data-original-title="Farm Management" data-offset="0,10">
                                            <i class="fas fa-map-marked-alt text-info"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- @parent -->
<!-- start script for this page -->
@section('scripts')
<script src="{{ asset('/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('/js/datagrid/datatables/datatables.export.js') }}"></script>

<script>
    $(document).ready(function() {
        // initialize datatable
        $('#daftaranggota').dataTable({
            pagingType: 'full_numbers',
            responsive: true,
            lengthChange: true,
            pageLength: 10,
            order: [
                [0, 'asc']
            ],
            dom:
                /*	--- Layout Structure 
                	--- Options
                	l	-	length changing input control
                	f	-	filtering input
                	t	-	The table!
                	i	-	Table information summary
                	p	-	pagination control
                	r	-	processing display element
                	B	-	buttons
                	R	-	ColReorder
                	S	-	Select

                	--- Markup
                	< and >				- div element
                	<"class" and >		- div with a class
                	<"#id" and >		- div with an ID
                	<"#id.class" and >	- div with an ID and a class

                	--- Further reading
                	https://datatables.net/reference/option/dom
                	--------------------------------------
                 */
                "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                /*{
                	extend:    'colvis',
                	text:      'Column Visibility',
                	titleAttr: 'Col visibility',
                	className: 'mr-sm-3'
                },*/
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    titleAttr: 'Generate PDF',
                    className: 'btn-outline-danger btn-sm mr-1'
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    titleAttr: 'Generate Excel',
                    className: 'btn-outline-success btn-sm mr-1'
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    titleAttr: 'Generate CSV',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'copyHtml5',
                    text: 'Copy',
                    titleAttr: 'Copy to clipboard',
                    className: 'btn-outline-primary btn-sm mr-1'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    titleAttr: 'Print Table',
                    className: 'btn-outline-primary btn-sm'
                }
            ]
        });

    });
</script>
@endsection