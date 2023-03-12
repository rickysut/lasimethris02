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
                    Detail Kelompoktani - ID Poktan = {{ $nomor }}
                </h2>
                <div class="panel-toolbar">
                    <a class="btn btn-xs btn-primary mr-1 ml-1" href="javascript:history.back()"><i class="fal fa-plus mr-1"></i>Kembali</a>
                    @include('partials.globaltoolbar')
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="table">
                        <div class="table dataTables_wrapper dt-bootstrap4">
                            <table class="table table-sm table-bordered table-striped table-hover ajaxTable datatable datatable-petani w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Id. Petani</th>
                                        <th>Nama Petani</th>
                                        <th>KTP</th>
                                        <th>Luas Lahan (ha)</th>
                                        <th>Periode Tanam</th>
                                        {{-- <th style="width: 120px">Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tfoot>
									<tr>
										<th colspan="3" class="text-right">
											Total:
										</th>
										<th  class="text-right">
										</th>
										<th >
										</th>
									</tr>
								</tfoot>
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
            serverSide: true,
            responsive: true,
            retrieve: true,
            aaSorting: [],
            dom: 
                    "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8 d-flex'B><'col-sm-12 col-md-2 d-flex justify-content-end'f>>" +
                    "<'row'<'col-sm-12 col-md-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
            
            
            ajax: "{{ route('admin.task.kelompoktani.showtani', [$nomor]) }}",
            columns: [
                { data: 'id_petani', name: 'id_petani', visible: false },
                { data: 'nama_petani', name: 'nama_petani' , visible: true},
                { data: 'ktp_petani', name: 'ktp_petani' , visible: true},
                { data: 'luas_lahan', name: 'luas_lahan', class: 'text-right'  },
                { data: 'periode_tanam', name: 'periode_tanam' },
                // { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' , orderable: false }
            ],
            
            orderCellsTop: true,
            order: [[ 0, 'asc' ]],
            displayLength: 25,
            footerCallback : function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/,/g, '.')*1 : typeof i === 'number' ? i : 0;
                    };

                // Total over this page
                pageTotal1 = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Math.round(((intVal(a) + intVal(b)) + Number.EPSILON) * 100) / 100;
                }, 0 );

                // Update footer
                $( api.column( 3 ).footer() ).html(
                    numberWithCommas(pageTotal1)
                )
            }

        };
        let table = $('.datatable-petani').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
        
        
    });
        

</script>

@endsection