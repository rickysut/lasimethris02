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
                    Daftar<span class="fw-300"><i>RIPH</i></span>
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
                                    <th ></th>
                                    {{-- <th hidden>ID</th> --}}
                                    <th >Periode Tahun</th>
                                    <th class="text-center">No. RIPH</th>
                                    <th >Tanggal.Terbit</th>
                                    <th class="text-center">V. RIPH (ton)</th>
                                    <th class="text-center">V. Produksi (ton)</th>
                                    <th class="text-center">L. Wajib Tanam (ha)</th>
                                    <th class="text-center">Status</th>
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

		let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('commitment_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.task.commitment.massDestroy') }}",
                className: 'btn-danger  waves-effect waves-themed  mr-1', 
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                    return entry.id
                });

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')

                    return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: config.url,
                    data: { ids: ids, _method: 'DELETE' }})
                    .done(function () { location.reload() })
                }
                }
            }
            dtButtons.push(deleteButton)
        @endcan
        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            columnDefs: [{
                                orderable: false,
                                className: 'select-checkbox',
                                targets: 0
                            },  {
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
            
            ajax: "{{ route('admin.task.commitment') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                // { data: 'id', name: 'id',  },
                { data: 'periodetahun', name: 'periodetahun' },
                { data: 'no_ijin', name: 'no_ijin' },
                { data: 'tgl_ijin', name: 'tgl_ijin',class: 'text-center'  },
                { data: 'volume_riph', name: 'volume_riph', class: 'text-right' },
                { data: 'volume_produksi', name: 'volume_produksi', class: 'text-right' },
                { data: 'luas_wajib_tanam', name: 'luas_wajib_tanam', class: 'text-right' },
                { data: 'status', name: 'status', class: 'text-center',
                  render: function( data, type, row ) {
                    out = '';
                    if (data == 0) out = 'Belum Diverifikasi';
                    if (data == 1) out = 'Menunggu review verifikasi';
                    if (data == 2) out = 'Sudah Diverifikasi';
                    if (data == 3) out = 'Pengajuan SKL';
                    if (data == 4) out = 'Review SKL';
                    if (data == 5) out = 'SKL Sudah Terbit';
                    return out;
                  }
             },
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