<?php

namespace App\Http\Controllers\Admin;

use App\Models\Commitment;
use App\Http\Controllers\Controller;
use App\Models\PullRiph;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\DataUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MassDestroyPullriphRequest;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Api\HelperController;
use App\Http\Controllers\Traits\SimeviTrait;
use App\Models\Poktan;

class CommitmentController extends Controller
{
    use SimeviTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('commitment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $npwp = (Auth::user()::find(Auth::user()->id)->data_user->npwp_company ?? null);
            
            // $user = Auth::user()::find(Auth::user()->id)->with('roles');
            if (!auth()->user()->isAdmin){
                $query = PullRiph::where('npwp', $npwp)->orderBy('tgl_ijin', 'desc')->select(sprintf('%s.*', (new PullRiph())->table));
            } else
                $query = PullRiph::query()->select(sprintf('%s.*', (new PullRiph())->table));
            
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'commitment_show';
                $deleteGate = 'commitment_delete';
                $crudRoutePart = 'task.commitment';

                return view('partials.viewDeleteActions', compact(
                'viewGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('no_ijin', function ($row) {
                return $row->no_ijin ? $row->no_ijin : '';
            });
            $table->editColumn('tgl_ijin', function ($row) {
                return $row->tgl_ijin ? date('d/m/Y', strtotime($row->tgl_ijin)) : '';
            });
            $table->editColumn('tgl_akhir', function ($row) {
                return $row->tgl_akhir ? date('d/m/Y', strtotime($row->tgl_akhir)) : '';
            });
            $table->editColumn('periodetahun', function ($row) {
                return $row->periodetahun ? $row->periodetahun : '';
            });
            $table->editColumn('volume_riph', function ($row) {
                return $row->volume_riph ? str_replace('.', ',', $row->volume_riph) : '';
            });
            $table->editColumn('volume_produksi', function ($row) {
                return $row->volume_produksi ? str_replace('.', ',', $row->volume_produksi) : '';
            });
            $table->editColumn('luas_wajib_tanam', function ($row) {
                return $row->luas_wajib_tanam ? str_replace('.', ',', $row->luas_wajib_tanam) : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : 0;
            });
            
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $module_name = 'Proses RIPH' ;
        $page_title = 'Daftar Komitmen';
        $page_heading = 'Daftar Komitmen' ;
        $heading_class = 'fa fa-file-invoice';
        return view('admin.commitment.index', compact('module_name', 'page_title', 'page_heading', 'heading_class')); 
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
        $realnpwp = Auth::user()::find(Auth::user()->id)->data_user->npwp_company;
        
        $pullRiph = PullRiph::where('npwp', $realnpwp)->first();

        

        DB::beginTransaction();
        try {
            if ($pullRiph){
                $npwp = str_replace('.', '', $realnpwp);
                $npwp = str_replace('-', '', $npwp);
                $userFiles = [];
                $userFiles += array('status' => 1);
                if ($request->hasFile('formRiph')) {
                    if  ($request->formRiph !=null){
                        $file = $request->file('formRiph');
                        $file_name = 'formRiph.'.$file->getClientOriginalExtension();
                        $file_path = $file->storeAs('uploads/'.$npwp, $file_name, 'public');
                        $userFiles += array('formRiph' => $file_path);
                    };
                }
                if ($request->hasFile('formSptjm')) {
                    if  ($request->formSptjm !=null){
                        $file = $request->file('formSptjm');
                        $file_name = 'formSptjm.'.$file->getClientOriginalExtension();
                        $file_path = $file->storeAs('uploads/'.$npwp, $file_name, 'public');
                        $userFiles += array('formSptjm' => $file_path);
                    };
                }
                if ($request->hasFile('logBook')) {
                    if  ($request->logBook !=null){
                        $file = $request->file('logBook');
                        $file_name = 'logBook.'.$file->getClientOriginalExtension();
                        $file_path = $file->storeAs('uploads/'.$npwp, $file_name, 'public');
                        $userFiles += array('logBook' => $file_path);
                    };
                }
                if ($request->hasFile('formRt')) {
                    if  ($request->formRt !=null){
                        $file = $request->file('formRt');
                        $file_name = 'formRt.'.$file->getClientOriginalExtension();
                        $file_path = $file->storeAs('uploads/'.$npwp, $file_name, 'public');
                        $userFiles += array('formRt' => $file_path);
                    };
                }
                if ($request->hasFile('formRta')) {
                    if  ($request->formRta !=null){
                        $file = $request->file('formRta');
                        $file_name = 'formRta.'.$file->getClientOriginalExtension();
                        $file_path = $file->storeAs('uploads/'.$npwp, $file_name, 'public');
                        $userFiles += array('formRta' => $file_path);
                    };
                }
                if ($request->hasFile('formRpo')) {
                    if  ($request->formRpo !=null){
                        $file = $request->file('formRpo');
                        $file_name = 'formRpo.'.$file->getClientOriginalExtension();
                        $file_path = $file->storeAs('uploads/'.$npwp, $file_name, 'public');
                        $userFiles += array('formRpo' => $file_path);
                    };
                }
                if ($request->hasFile('formLa')) {
                    if  ($request->formLa !=null){
                        $file = $request->file('formLa');
                        $file_name = 'formLa.'.$file->getClientOriginalExtension();
                        $file_path = $file->storeAs('uploads/'.$npwp, $file_name, 'public');
                        $userFiles += array('formLa' => $file_path);
                    };
                }
                $pengajuan = Pengajuan::updateOrCreate(
                    ['detail' => $pullRiph->no_ijin],
                    ['jenis' => 1 , 'status' => 1]    
                );
                // dd($pengajuan);
                $userFiles += array('no_doc' => $pengajuan->no_doc);
                PullRiph::updateOrCreate(
                    ['npwp' => $realnpwp, 'no_ijin' => $request->get('no_ijin')],
                    $userFiles
                ); 
                
            
            }
        } catch(ValidationException $e)
        {
            DB::rollback();
            return  back()->withErrors('Terjadi kesalahan saat unggah file');
        } catch(\Exception $e)
        {
            DB::rollback();
            //throw $e;
            return back()->withErrors('Terjadi kesalahan saat unggah file');
        }
        
        DB::commit();
        return back()->with('message', 'Sukses mengunggah file..'); 
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PullRiph  $commitment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pullRiph = PullRiph::findOrFail($id);
        $pengajuan = Pengajuan::where('no_doc', $pullRiph->no_doc)->get();
        $npwp = (Auth::user()::find(Auth::user()->id)->data_user->npwp_company ?? null);
        $nomor = '';
        if (!empty($npwp))
        {
            $npwp = str_replace('.', '', $npwp);
            $npwp = str_replace('-', '', $npwp);
            $nomor = str_replace('.', '', $pullRiph->no_ijin);
            $nomor = str_replace('/', '', $nomor);
            $pullData = $this->pull($npwp, $nomor);
        } else 
            $pullData = null;
        

        // $access_token = $this->getAPIAccessToken(config('app.simevi_user'), config('app.simevi_pwd'));

        
        $data_poktan = [];
        $poktans = null;
        if ($pullData){

            $query = 'select g.no_riph, g.id_kecamatan, g.nama_kelompok, g.nama_pimpinan, g.hp_pimpinan, count(p.nama_petani) as jum_petani, round(SUM(p.luas_lahan),2) as luas 
            from poktans p, group_tanis g
            where p.no_riph = "' . $pullRiph->no_ijin . '"' . ' and p.id_poktan=g.id_poktan
            GROUP BY g.nama_kelompok';
            

            $poktans = DB::select(DB::raw($query));
            
            foreach($poktans as $poktan){
                $datakecamatan = $this->getAPIKecamatan(    $poktan->id_kecamatan);
                $kec = $datakecamatan['data'][0]['nm_kec'];
                $poktan->kecamatan = $kec ;
            }
            
        }
        $module_name = 'Proses RIPH' ;
        $page_title = 'Data RIPH';
        $page_heading = 'Data RIPH' ;
        $heading_class = 'fal fa-file-invoice';
        return view('admin.commitment.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'pullRiph', 'pullData', 'pengajuan', 'poktans', 'nomor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commitment  $commitment
     * @return \Illuminate\Http\Response
     */
    public function edit(Commitment $commitment)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commitment  $commitment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commitment $commitment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commitment  $commitment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('commitment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pullRiph = PullRiph::find($id);
        $pullRiph->delete();

        return back();
    }

    public function massDestroy(MassDestroyPullriphRequest $request)
    {
        PullRiph::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

    

