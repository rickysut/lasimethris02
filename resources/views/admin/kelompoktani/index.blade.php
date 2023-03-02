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
@can('poktan_access')
<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel" data-title="Panel Data" data-intro="Panel ini berisi data-data" data-step="2">
            <div class="panel-hdr">
                <h2>
                    Daftar <span class="fw-300"><i>Kelompoktani</i></span>
                </h2>
                <div class="panel-toolbar">
                    {{-- <a class="btn btn-xs btn-primary mr-1 ml-1" href="{{ route('admin.task.kelompoktani.create') }}"><i class="fal fa-plus mr-1"></i>Kelompoktani</a> --}}
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
                                        <th>No. RIPH</th>
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
                                        <th style="width: 120px">Aksi</th>
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
                                targets: 0,
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
            
            ajax: "{{ route('admin.task.kelompoktani') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder', orderable: false },
                // { data: 'id', name: 'id',  },
                { data: 'no_riph', name: 'no_riph', visible: false },
                // { data: 'id_kabupaten', name: 'id_kabupaten' },
                { data: 'id_kecamatan', name: 'id_kecamatan' },
                // { data: 'id_kelurahan', name: 'id_kelurahan' },
                { data: 'nama_kelompok', name: 'nama_kelompok' },
                { data: 'nama_pimpinan', name: 'nama_pimpinan' },
                { data: 'hp_pimpinan', name: 'hp_pimpinan' },
                { data: 'nama_petani', name: 'nama_petani' },
                { data: 'ktp_petani', name: 'ktp_petani' },
                { data: 'luas_lahan', name: 'luas_lahan', class: 'text-right' },
                { data: 'periode_tanam', name: 'periode_tanam' },
                { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' , orderable: false }
            ],
            orderCellsTop: true,
            order: [[ 1, 'asc' ]],
            displayLength: 25,
            
            drawCallback: function (settings) {
                var api = this.api();
                
                var nomor = "";
                if (api.order()[0][0] === 1) {
                    var rows = api.rows({ page: 'all' }).nodes();
                    var last = null;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/,/g, '.')*1 : typeof i === 'number' ? i : 0;
                    };
                    total=[];
                    api.column(1, { page: 'all' })
                        .data()
                        .each(function (group, i) {
                            nomor = group.replace('.', '');
                            nomor = nomor.replace(/\//g,'');
                            if(typeof total[nomor] != 'undefined'){
                                // console.log(intVal(api.column(8).data()[i]));
                                total[nomor]=total[nomor]+intVal(api.column(8).data()[i]);
                            }else{
                                total[nomor]=intVal(api.column(8).data()[i]);
                            }
                            if (last !== group) {
                                //console.log(group);
                                urlView = "{{ route('admin.task.kelompoktani.show', ':no' ) }}";
                                urlEdit = "{{ route('admin.task.kelompoktani.edit', ':no') }}";
                                urlView = urlView.replace(':no', nomor);
                                urlEdit = urlEdit.replace(':no', nomor);

                                $(rows)
                                    .eq(i)
                                    .before('<tr class="group"><td></td><td colspan="6"><strong>' + group  +'</strong></td>'+
                                        '<td class="'+nomor+' text-right "></td>><td></td>'+
                                        '<td class="text-center">'+
                                        '<a class="btn btn-xs btn-primary " data-toggle="tooltip" title data-original-title="Lihat Rincian" href='+urlView+'>'+
                                        '    <i class="fal fa-search-plus"></i></a>'+
                                        '<a class="btn btn-xs btn-info" data-toggle="tooltip" title data-original-title="Perbaharui Data" href='+urlEdit+'>'+
                                        '<i class="fal fa-edit"></i></a>'+
                                        '</td></tr>');
        
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

