<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('pks_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        
        if ($request->ajax()) {
            $npwp = (Auth::user()::find(Auth::user()->id)->data_user->npwp_company ?? null);

            if (!auth()->user()->isAdmin){
                $query = Pks::where('npwp', $npwp)->select(sprintf('%s.*', (new Pks())->table));
            } else
                $query = Pks::query()->select(sprintf('%s.*', (new Pks())->table));
            
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pks_show';
                $deleteGate = 'pks_delete';
                $editGate = 'pks_edit';
                $crudRoutePart = 'task.pks';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('npwp', function ($row) {
                return $row->npwp ? $row->npwp : '';
            });
            $table->editColumn('no_riph', function ($row) {
                return $row->no_riph ? $row->no_riph : '';
            });
            $table->editColumn('no_perjanjian', function ($row) {
                return $row->no_perjanjian ? $row->no_perjanjian : '';
            });
            $table->editColumn('tgl_perjanjian_start', function ($row) {
                return $row->tgl_perjanjian_start ? date('d/m/Y', strtotime($row->tgl_perjanjian_start)) : '';
            });
            $table->editColumn('tgl_perjanjian_end', function ($row) {
                return $row->tgl_perjanjian_end ? date('d/m/Y', strtotime($row->tgl_perjanjian_end)) : '';
            });
            $table->editColumn('jumlah_anggota', function ($row) {
                return $row->jumlah_anggota ? $row->jumlah_anggota : 0;
            });
            $table->editColumn('luas_rencana', function ($row) {
                return $row->luas_rencana ? $row->luas_rencana : 0;
            });
            $table->editColumn('varietas_tanam', function ($row) {
                return $row->varietas_tanam ? $row->varietas_tanam : '';
            });
            $table->editColumn('luas_wajib_tanam', function ($row) {
                return $row->periode_tanam ?  $row->periode_tanam : '';
            });
            $table->editColumn('provinsi', function ($row) {
                return $row->provinsi ? $row->provinsi : '';
            });
            $table->editColumn('kabupaten', function ($row) {
                return $row->kabupaten ? $row->kabupaten : '';
            });
            $table->editColumn('kecamatan', function ($row) {
                return $row->kecamatan ? $row->kecamatan : '';
            });
            $table->editColumn('desa', function ($row) {
                return $row->provinsi ? $row->provinsi : '';
            });
            $table->editColumn('berkas_pks', function ($row) {
                return $row->berkas_pks ? $row->berkas_pks : '';
            });
            
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $module_name = 'Proses RIPH' ;
        $page_title = 'Kelompok Tani';
        $page_heading = 'Daftar PKS ' ;
        $heading_class = 'fal fa-ballot-check';
        return view('admin.pks.index', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($no_riph)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pks  $pks
     * @return \Illuminate\Http\Response
     */
    public function show(Pks $pks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pks  $pks
     * @return \Illuminate\Http\Response
     */
    public function edit(Pks $pks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pks  $pks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pks $pks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pks  $pks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pks $pks)
    {
        //
    }
}
