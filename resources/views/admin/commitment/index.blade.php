@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
@include('partials.subheader')

@can('commitment_access')
@include('partials.sysalert')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					RIPH Bawang Putih Konsumsi
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
                                    <th>No. RIPH</th>
                                    <th>Tahun</th>
                                    <th>Tgl. Terbit</th>
                                    <th>Tgl. Akhir</th>
                                    <th class="text-center">Vol. Import</th>
                                    <th class="text-center">Kewajiban</th>
                                    <th>Status</th>
                                    <th></th>
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

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
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
				},
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: 'Add new Commitment',
					className: 'btn btn-info btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.task.pull') }}';
					}
				}
			],
            // buttons: dtButtons,
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
            ajax: "{{ route('admin.task.commitment') }}",
            columns: [
                // { data: 'placeholder', name: 'placeholder' },
                // { data: 'id', name: 'id',  },
                { data: 'no_ijin', name: 'no_ijin', render: function( data, type, row ) {
                    return data.toUpperCase();
                 }},
                { data: 'periodetahun', name: 'periodetahun',class: 'text-center' },
                { data: 'tgl_ijin', name: 'tgl_ijin',class: 'text-center'  },
                { data: 'tgl_akhir', name: 'tgl_akhir',class: 'text-center'  },
                { data: 'volume_riph', name: 'volume_riph', class: 'text-right', 
                    render: function( data, type, row ) {
                        return numberWithCommas(data) + ' ton';
                    }
                },
                { data: 'volume_produksi', name: 'volume_produksi',  
                    render: function( data, type, row ) {
                        return '<i class="fal fa-ruler-combined"></i> ' + numberWithCommas(row.luas_wajib_tanam) +  ' ha' + 
                        '<br>' + 
                        '<i class="fal fa-weight-hanging"></i> ' + numberWithCommas(data) + ' ton' ;
                    }
                    
                },
                // { data: 'luas_wajib_tanam', name: 'luas_wajib_tanam', class: 'text-right' },
                { data: 'status', name: 'status', class: 'text-center',
                  render: function( data, type, row ) {
                    out = '';
                    if (data == 0) out = '<span class="badge btn-warning btn-icon btn-xs" data-toggle="tooltip"'+
                                            'title="Belum Mengajukan Verifikasi">'+
                                            '<i class="fal fa-exclamation-circle"></i>'+
                                        '</span>';
                    if (data == 1) out = '<span class="badge btn-primary btn-icon btn-xs" data-toggle="tooltip"'+
                                            'title="Verifikasi sudah diajukan">'+
                                            '<i class="fal fa-hourglass"></i>'+
                                        '</span>';
                    if (data == 2) out =  '<span class="badge btn-success btn-icon btn-xs" data-toggle="tooltip"'+
                                            'title="Verifikasi Data Selesai">'+
                                            '<i class="fal fa-check-circle"></i>'+
                                        '</span>';
                    if (data == 3) out = '<span class="badge btn-danger btn-icon btn-xs" data-toggle="tooltip"'+
                                            'title="Maaf. Verifikasi Data tidak dapat dilanjutkan. Perbaiki Data Anda terlebih dahulu">'+
                                            '<i class="fal fa-check-circle"></i>'+
                                        '</span>';
                    if (data == 4) out = '<span class="badge btn-success btn-icon btn-xs" data-toggle="tooltip"'+
                                            'title="Verifikasi Lapangan Selesai">'+
                                            '<i class="fal fa-map-marker-check"></i>'+
                                        '</span>';
                    if (data == 5) out = '<span class="badge btn-danger btn-icon btn-xs" data-toggle="tooltip"'+
                                            'title="Maaf. Verifikasi Lapangan tidak dapat dilanjutkan. Perbaiki Data Anda terlebih dahulu">'+
                                            '<i class="fal fa-exclamation-circle"></i>'+
                                        '</span>';
                    if (data == 6) out = '<span class="badge btn-success btn-icon btn-xs" data-toggle="tooltip"'+
                                            'title="Hore!. SKL Telah Terbit">'+
                                            '<i class="fal fa-award"></i>'+
                                        '</span>';
                    return out;
                  }
                },
                { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center'}
                
            ],
            orderCellsTop: true,
            order: [[ 0, 'desc' ]],
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