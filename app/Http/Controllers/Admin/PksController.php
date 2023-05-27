<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SimeviTrait;
use App\Models\GroupTani;
use App\Models\PullRiph;
use Gate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PksController extends Controller
{
    use SimeviTrait;
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
            $table->editColumn('id_poktan', function ($row) {
                return $row->id_poktan ? $row->id_poktan : '';
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
        $page_title = 'Daftar PKS';
        $page_heading = 'Daftar PKS ' ;
        $heading_class = 'fal fa-ballot-check';
        return view('admin.pks.index', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_if(Gate::denies('pks_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $no_riph = $request->no_riph;
        $idpoktan = $request->idpoktan;
        // dd($no_riph, $idpoktan);
        $npwp = (Auth::user()::find(Auth::user()->id)->data_user->npwp_company ?? null);

        $nomor = Str::substr($no_riph, 0, 4) . '/' . Str::substr($no_riph, 4, 2) . '.' . Str::substr($no_riph, 6, 3) . '/' . 
        Str::substr($no_riph, 9, 1) . '/' . Str::substr($no_riph, 10, 2) . '/' . Str::substr($no_riph, 12, 4);
        $pull = PullRiph::where('no_ijin', $nomor)->first();
        
        $query = 'select g.nama_kelompok, g.nama_pimpinan, g.id_poktan, SUBSTR(g.id_kecamatan,1,2) as id_provinsi, g.id_kabupaten, g.id_kecamatan, g.id_kelurahan , count(p.nama_petani) as jum_petani, round(SUM(p.luas_lahan),2) as luas 
            from poktans p, group_tanis g
            where p.npwp = "' . $npwp . '"' . ' and p.id_poktan=g.id_poktan and g.no_riph= "' .$nomor . '" and g.id_poktan = "' . $idpoktan . '"
            GROUP BY g.nama_kelompok';

            
        $poktans = DB::select(DB::raw($query));
        //  dd($poktans);
        foreach ($poktans as $poktan){
            // $access_token = $this->getAPIAccessToken(config('app.simevi_user'), config('app.simevi_pwd'));
            $datakecamatan = $this->getAPIKecamatan( $poktan->id_kecamatan);
            if($datakecamatan['data'][0]){
                $kec = $datakecamatan['data'][0]['nm_kec'];
                $poktan->kecamatan = $kec;
            }
            $datakelurahan = $this->getAPIDesa($poktan->id_kelurahan);
            if($datakelurahan['data'][0]){
                $desa = $datakelurahan['data'][0]['nm_desa'];
                $poktan->kelurahan = $desa;
            }
        }

        $provinsi = $this->getAPIProvinsiAll();
        $kabupaten = $this->getAPIKabupatenProp($poktans[0]->id_provinsi);
        $kecamatan = $this->getAPIKecamatanKab($poktans[0]->id_kabupaten);
        $desa = $this->getAPIDesaKec($poktans[0]->id_kecamatan);

        // dd($poktans);
        $module_name = 'Proses RIPH';
		$page_title = 'Kerjasama';
		$page_heading = 'Perjanjian Kerjasama';
		$heading_class = 'fa fa-file-signature';

        // $module_name = 'Proses RIPH' ;
        // $page_title = 'Buat PKS';
        // $page_heading = 'Buat PKS ' ;
        // $heading_class = 'fal fa-ballot-check';
        return view('admin.pks.create', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'npwp', 'nomor', 'poktans', 'provinsi', 'kabupaten', 'kecamatan', 'desa','idpoktan','pull' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->all();
        $realnpwp = $data['npwp'];
        $npwp = str_replace('.', '', $realnpwp);
        $npwp = str_replace('-', '', $npwp);

        $nomor = Str::replace('.', '', $data['no_riph']);
        $noriph = Str::replace('/', '', $nomor);

        if (array_key_exists('berkas_pks', $data)) {
            if  ($data['berkas_pks']!=null){
                $file_name = $noriph.'_'.$data['id_poktan']. '_berkaspks.'.$data['berkas_pks']->getClientOriginalExtension();
                $file_path = $data['berkas_pks']->storeAs('uploads/'.$npwp, $file_name, 'public');
                $spath = $file_path;
                $data['berkas_pks'] = $spath;
            };
        }

        Pks::create($data);


        return redirect()->route('admin.task.pks.index')->with('success', 'Task created successfully.');
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
    public function edit(Request $request)
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
        abort_if(Gate::denies('pks_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pks->delete();

        return back();
    }
}
