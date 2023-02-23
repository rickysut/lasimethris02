<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('pengajuan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            //harus di query berdasarkan no riph sesuai user
            $no_doc = (Auth::user()::find(Auth::user()->id)->data_user->pullRiph[0]->no_doc ?? null);
            if (!$no_doc) {
                $query = Pengajuan::select(sprintf('%s.*', (new Pengajuan())->table));
            } else 
                $query = Pengajuan::where('no_doc', $no_doc)->orderBy('created_at', 'desc')->select(sprintf('%s.*', (new Pengajuan())->table));
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pengajuan_show';
                $crudRoutePart = 'task.pengajuan';

                return view('partials.viewOnlyActions', compact(
                'viewGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('no_doc', function ($row) {
                return $row->no_doc ? $row->no_doc : '';
            });
            $table->editColumn('detail', function ($row) {
                return $row->detail ? $row->detail : '';
            });
            $table->editColumn('jenis', function ($row) {
                return $row->jenis ? $row->jenis : 0;
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : 0;
            });
            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? date('d/m/Y', strtotime($row->created_at)) : '';
            });
            $table->editColumn('updated_at', function ($row) {
                return $row->updated_at ? date('d/m/Y', strtotime($row->updated_at)) : '';
            });
            
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $module_name = 'Proses RIPH' ;
        $page_title = 'Daftar Pengajuan';
        $page_heading = 'Daftar Pengajuan' ;
        $heading_class = 'fal fa-ballot-check';
        return view('admin.pengajuan.index', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan $pengajuan)
    {
        abort_if(Gate::denies('pengajuan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $module_name = 'Proses RIPH' ;
        $page_title = 'Detail Pengajuan';
        $page_heading = 'Detail Pengajuan' ;
        $heading_class = 'fal fa-ballot-check';
        
        return view('admin.pengajuan.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'pengajuan'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
