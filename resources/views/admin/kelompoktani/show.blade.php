@extends('layouts.admin')
@section('content')
@include('partials.breadcrumb')
{{-- @include('partials.subheader') --}}
<style>
    tr.group,
    tr.group:hover {
        background-color: #bdeef9 !important;
    }
</style>
@can('poktan_show')
<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel" data-title="Panel Data" data-intro="Panel ini berisi data-data" data-step="2">
            <div class="panel-hdr">
                <h2>
                    Detail Kelompoktani - No. RIPH = {{ $realno }}
                </h2>
                <div class="panel-toolbar">
                    @can('poktan_create')
                        <a class="btn btn-xs btn-primary mr-1 ml-1" href="{{ route('admin.task.kelompoktani.create') }}"><i class="fal fa-plus mr-1"></i>Kelompoktani</a>
                    @endcan
                    @include('partials.globaltoolbar')
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="table">
                        <div class="table dataTables_wrapper dt-bootstrap4">
                            <table class="table table-sm table-bordered table-striped table-hover ajaxTable datatable datatable-Kelompoktani w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>
                                        {{-- <th>No. RIPH</th> --}}
                                        {{-- <th>Kabupaten</th> --}}
                                        <th>Kecamatan</th>
                                        {{-- <th>Kelurahan</th> --}}
                                        <th>Nama Kelompok</th>
                                        <th>Pimpinan</th>
                                        <th>HP. Pimpinan</th>
                                        <th>Nama Petani</th>
                                        <th>KTP Petani</th>
                                        <th>Luas Lahan (ha)</th>
                                        <th>Periode tanam</th>
                                        {{-- <th style="width: 120px">Aksi</th> --}}
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

<!-- start script for this page -->
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
                extend: 'excelHtml5',
                text: 'Excel',
                titleAttr: 'Generate Excel',
                className: 'btn-outline-success btn-sm mr-1'
            }
            
        ], $.fn.dataTable.defaults.buttons)
        @can('poktan_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.task.kelompoktani.massDestroy') }}",
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
            serverSide: false,
            responsive: true,
            retrieve: true,
            aaSorting: [],
            columnDefs: [  {
                                orderable: false,
                                @can('poktan_delete')
                                className: 'select-checkbox',
                                @endcan
                                targets: 0
                            },{
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
            
            ajax: "{{ route('admin.task.kelompoktani.show', [$nomor]) }}",
            columns: [
                { data: 'placeholder', name: 'placeholder' ,orderable: false},
                // { data: 'id', name: 'id',  },
                // { data: 'no_riph', name: 'no_riph' },
                // { data: 'id_kabupaten', name: 'id_kabupaten' },
                { data: 'id_kecamatan', name: 'id_kecamatan' },
                // { data: 'id_kelurahan', name: 'id_kelurahan' },
                { data: 'nama_kelompok', name: 'nama_kelompok' , visible: false},
                { data: 'nama_pimpinan', name: 'nama_pimpinan' , visible: false},
                { data: 'hp_pimpinan', name: 'hp_pimpinan' , visible: false},
                { data: 'nama_petani', name: 'nama_petani' },
                { data: 'ktp_petani', name: 'ktp_petani' },
                { data: 'luas_lahan', name: 'luas_lahan', class: 'text-right' },
                { data: 'periode_tanam', name: 'periode_tanam' },
                // { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center', orderable: false}
            ],
            orderCellsTop: true,
            order: [[ 2, 'asc' ]],
            displayLength: 25,
            drawCallback: function (settings) {
                var api = this.api();
                var nomor = "";
                if (api.order()[0][0] === 2) {
                    var rows = api.rows({ page: 'all' }).nodes();
                    var last = null;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/,/g, '.')*1 : typeof i === 'number' ? i : 0;
                        };
                    total=[];
                    api.column(2, { page: 'all' })
                        .data()
                        .each(function (group, i) {
                            nomor = group;
                            if(typeof total[nomor] != 'undefined'){
                                total[nomor]=total[nomor]+intVal(api.column(7).data()[i]);
                            }else{
                                total[nomor]=intVal(api.column(7).data()[i]);
                            }
                            if (last !== group) {
                                $(rows)
                                    .eq(i)
                                    .before('<tr class="group"><td></td><td colspan="3"><strong>' + group  + ' - ' + rows.data()[i].nama_pimpinan +  ' (' + rows.data()[i].hp_pimpinan + ')' +'</strong></td>'+
                                        '<td class="'+nomor+' text-right "></td>><td colspan="2"></td></tr>');
                                last = group;
                            }
                        });
                        for(var key in total) {
                            $("."+key).html(Math.round((total[key] + Number.EPSILON) * 100) / 100);
                        }
                }
            }
        };
        let table = $('.datatable-Kelompoktani').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
        
        
    });
        

</script>

@endsection