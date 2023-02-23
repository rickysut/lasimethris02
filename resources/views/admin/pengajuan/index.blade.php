@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
{{-- @include('partials.subheader') --}}
@can('pengajuan_access')

<div class="row">
    <div class="col-lg-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Daftar<span class="fw-300">|<i>Pengajuan</i></span>
                </h2>
                <div class="panel-toolbar">
                    @include('partials.globaltoolbar')
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="table">
                        <div class="table dataTables_wrapper dt-bootstrap4">
                            <table class="table table-sm table-bordered table-striped table-hover ajaxTable datatable datatable-Pengajuan w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        {{-- <th ></th> --}}
                                        <th>Nomor Pengajuan</th>
                                        <th>No. RIPH</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th>Tanggal diajukan</th>
                                        <th>Tanggal Status</th>
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
</div>
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

		let dtButtons = $.extend(true, [
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
        ], $.fn.dataTable.defaults.buttons)
        
        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            columnDefs: [  {
                                orderable: false,
                                searchable: false,
                                targets: -1
                            }
                        ],
            select: {
                        style:    'multi+shift',
                        selector: 'td:first-child'
            },
            dom: 
					"<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8 d-flex'B><'col-sm-12 col-md-2 d-flex justify-content-end'f>>" +
					"<'row'<'col-sm-12 col-md-12'tr>>" +
					"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
            
            ajax: "{{ route('admin.task.pengajuan.index') }}",
            columns: [
                // { data: 'placeholder', name: 'placeholder' },
                // { data: 'id', name: 'id',  },
                { data: 'no_doc', name: 'no_doc' },
                { data: 'detail', name: 'detail' },
                { data: 'jenis', name: 'jenis',class: 'text-center', render: function( data, type, row ) {
                    out = '';
                    if (data == 0) out = '';
                    if (data == 1) out = 'Dokumen Verifikasi';
                    if (data == 2) out = 'Dokumen SKL';
                    return out;
                  }  
                },
                { data: 'status', name: 'status', class: 'text-center', render: function( data, type, row ) {
                    out = '';
                    if (data == 0) out = '';
                    if (data == 1) out = 'Pengajuan Verifikasi';
                    if (data == 2) out = 'Sudah Diverifikasi';
                    if (data == 3) out = 'Pengajuan SKL';
                    if (data == 4) out = 'Review SKL';
                    if (data == 5) out = 'SKL Sudah Terbit';
                    return out;
                  }  },
                { data: 'created_at', name: 'created_at', class: 'text-center' },
                { data: 'updated_at', name: 'updated_at', class: 'text-center' },
                { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,
        };
        let table = $('.datatable-Pengajuan').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
        
        
    });
        
</script>
	
@endsection

