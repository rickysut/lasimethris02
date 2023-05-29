@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
{{-- @include('partials.subheader') --}}
@can('commitment_access')
@if (!empty($pagedata['alerttitle']))
<div class="" data-title="System Alert" data-intro="Ini adalah Panel yang berisi informasi atau pemberitahuan penting untuk Anda." data-step="1">@include('partials.sysalert')</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel" data-title="Panel Data" data-intro="Panel ini berisi data-data" data-step="2">
            <div class="panel-hdr">
                <h2>
                    Daftar<span class="fw-300"><i>PKS</i></span>
                </h2>
                <div class="panel-toolbar">
                    @include('partials.globaltoolbar')
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="table dataTables_wrapper dt-bootstrap4">
                        <table class="table table-sm table-bordered table-striped table-hover ajaxTable datatable datatable-Riph w-100">
                            <thead class="thead-dark">
                                <tr>
                                    {{-- <th ></th> --}}
                                    {{-- <th hidden>ID</th> --}}
                                    {{-- <th class="text-center">NPWP</th> --}}
                                    <th class="text-center">No. RIPH</th>
                                    {{-- <th class="text-center">ID Poktan</th> --}}
                                    <th class="text-center">No. Perjanjian</th>
                                    <th class="text-center">Tgl. Mulai</th>
                                    <th class="text-center">Tgl. Berakhir</th>
                                    {{-- <th class="text-center">Jumlah Anggota</th> --}}
                                    <th class="text-center">Luas Rencana</th>
                                    <th class="text-center">Varietas Tanam</th>
                                    <th class="text-center">Periode Tanam</th>
                                    {{-- <th class="text-center">Provinsi</th>
                                    <th class="text-center">Kabupaten</th>
                                    <th class="text-center">Kecamatan</th>
                                    <th class="text-center">Desa</th> --}}
                                    {{-- <th class="text-center">Berkas</th> --}}
                                    <th style="width:15%">
                                        {{ trans('global.actions') }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->

@endcan
@endsection

@section('scripts')
@parent
<script>
	
	$(function () 
	{

        $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
            toastr.options.timeOut = 10000;
            toastr.options = {
                positionClass: 'toast-top-full-width'
            };

            toastr.error( 'Gagal mengambil data');
        };

		
        let dtOverrideGlobals = {
            responsive: true,
			lengthChange: false,
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-sm btn-icon mr-1'
				},
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Generate Excel',
					className: 'btn-outline-success btn-sm btn-icon mr-1'
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fal fa-file-csv"></i>',
					titleAttr: 'Generate CSV',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'copyHtml5',
					text: '<i class="fa fa-copy"></i>',
					titleAttr: 'Copy to clipboard',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print"></i>',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				}
				
			],
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            columnDefs: [
                {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }
            ],
            
            ajax: "{{ route('admin.task.pks.index') }}",
            columns: [
                // { data: 'placeholder', name: 'placeholder' },
                // { data: 'id', name: 'id',  },
                // { data: 'npwp', name: 'npwp' },
                { data: 'no_riph', name: 'no_riph' },
                // { data: 'id_poktan', name: 'id_poktan' },
                { data: 'no_perjanjian', name: 'no_perjanjian' },
                { data: 'tgl_perjanjian_start', name: 'tgl_perjanjian_start',class: 'text-center'  },
                { data: 'tgl_perjanjian_end', name: 'tgl_perjanjian_end',class: 'text-center'  },
                // { data: 'jumlah_anggota', name: 'jumlah_anggota', class: 'text-right' },
                { data: 'luas_rencana', name: 'luas_rencana', class: 'text-right', render: function( data, type, row ) {
                    return data + ' ha';
                 } },
                { data: 'varietas_tanam', name: 'varietas_tanam' },
                { data: 'periode_tanam', name: 'periode_tanam' },
                // { data: 'provinsi', name: 'provinsi' },
                // { data: 'kabupaten', name: 'kabupaten' },
                // { data: 'kecamatan', name: 'kecamatan' },
                // { data: 'desa', name: 'desa' },
                // { data: 'berkas_pks', name: 'berkas_pks' },
                { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,
        };
        let table = $('.datatable-Riph').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
        
        
    });
        
</script>


@endsection