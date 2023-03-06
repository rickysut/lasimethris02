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
                                        <th>No. RIPH</th>
                                        <th>Kecamatan</th>
                                        <th>Nama Kelompok</th>
                                        <th>Pimpinan</th>
                                        <th>HP. Pimpinan</th>
                                        <th>Jumlah Petani</th>
                                        <th>Luas Lahan (ha)</th>
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
        
        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: false,
            responsive: true,
            retrieve: true,
            aaSorting: [],
            
            dom: 
					"<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8 d-flex'B><'col-sm-12 col-md-2 d-flex justify-content-end'f>>" +
					"<'row'<'col-sm-12 col-md-12'tr>>" +
					"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
            
            ajax: "{{ route('admin.task.kelompoktani') }}",
            columns: [
                { data: 'no_riph', name: 'no_riph', visible: false },
                { data: 'id_kecamatan', name: 'id_kecamatan', visible: true },
                { data: 'nama_kelompok', name: 'nama_kelompok' , visible: true},
                { data: 'nama_pimpinan', name: 'nama_pimpinan' , visible: true},
                { data: 'hp_pimpinan', name: 'hp_pimpinan' , visible: true},
                { data: 'jum_petani', name: 'jum_petani' },
                { data: 'luas', name: 'luas', class: 'text-right' },
                { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' , orderable: false }
            ],
            orderCellsTop: true,
            order: [[ 0, 'asc' ]],
            displayLength: 25,
            
            drawCallback: function (settings) {
                var api = this.api();
                
                var nomor = "";
                if (api.order()[0][0] === 0) {
                    var rows = api.rows({ page: 'all' }).nodes();
                    var last = null;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/,/g, '.')*1 : typeof i === 'number' ? i : 0;
                    };
                    total=[];
                    api.column(0, { page: 'all' })
                        .data()
                        .each(function (group, i) {
                            nomor = group.replace('.', '');
                            nomor = nomor.replace(/\//g,'');
                            if(typeof total[nomor] != 'undefined'){
                                total[nomor]=total[nomor]+intVal(api.column(6).data()[i]);
                            }else{
                                total[nomor]=intVal(api.column(6).data()[i]);
                            }
                            if (last !== group) {
                                urlView = "{{ route('admin.task.kelompoktani.show', ':no' ) }}";
                                urlEdit = "{{ route('admin.task.kelompoktani.edit', ':no') }}";
                                urlView = urlView.replace(':no', nomor);
                                urlEdit = urlEdit.replace(':no', nomor);

                                $(rows)
                                    .eq(i)
                                    .before('<tr class="group"><td colspan="5" class="text-center"><strong>' + group  +'</strong></td>'+
                                        '<td class="'+nomor+' text-right "></td>'+
                                        '<td class="text-center">'+
                                        '<a class="btn btn-xs btn-primary " data-toggle="tooltip" title data-original-title="Lihat Rincian" href='+urlView+'>'+
                                        '    <i class="fal fa-plus-circle"></i>&nbsp;PKS</a>'+
                                        '</td></tr>');
        
                                last = group;
                            }
                        });
                        for(var key in total) {
                            $("."+key).html('<strong>'+Math.round((total[key] + Number.EPSILON) * 100) / 100 + '<strong>');
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

