<?php

namespace App\Http\Controllers\Admin;

use App\Models\Poktan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MassDestroyKelompoktaniRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Tests\Browser\KecamatanTest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KelompoktaniController extends Controller
{
    private $access_token;
    private $provinsis;
    private $kecamatans;
    private $kabupatens;
    private $desas;

    
    
    protected function getAPIAccessToken($username, $pass){
        $response = Http::asForm()->post(config('app.simevi_url').'getToken', [
            'username' => $username,
            'password' => $pass
        ]);

        $access_token = $response->json('access_token');
        return $access_token;
    }

    protected function getAPIProvinsi($token){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'provinsis');

        
        return $response->json();
    }

    protected function getAPIKabupaten($token){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kabupatens');

        
        return $response->json();
    }


    protected function getAPIKecamatan($token){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kecamatans');

        
        return $response->json();
    }


    protected function getAPIDesa($token){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'desas');

        
        return $response->json();
    }

    protected function searchProp($json , $str){
        
        foreach ($json['data'] as $item) {
                      
            if ($item['kd_prop'] == $str) {
                return $item['nm_prop'];
            }
        }
    }

    protected function searchKab($json , $str){
        foreach ($json['data'] as $item) {
            if ($item['kd_kab'] == $str) {
                return $item['nama_kab'];
            }
        }
    }

    protected function searchKec($json , $str){
        foreach ($json['data'] as $item) {
            if ($item['kd_kec'] == $str) {
                return $item['nm_kec'];
            }
        }
    }

    protected function searchDesa($json , $str){
        foreach ($json['data'] as $item) {
            if ($item['kd_desa'] == $str) {
                return $item['nm_desa'];
            }
        }
    }

    public function getAPIKabupatenProp($token, $provinsi){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kabupatenwithprop/'.$provinsi);

        
        return $response->json();
    }

    public function getAPIKecamatanKab($token, $kabupaten){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kecamatanwithkab/'.$kabupaten);

        
        return $response->json();
    }

    public function getAPIDesaKec($token, $kecamatan){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'desawithkec/'.$kecamatan);

        
        return $response->json();
    }

    public function __construct()
    {
        // $this->access_token = $this->getAPIAccessToken(config('app.simevi_user'), config('app.simevi_pwd'));
        // $this->provinsis = $this->getAPIProvinsi($this->access_token);
        // $this->kabupatens = $this->getAPIKabupaten($this->access_token);
        // $this->kecamatans = $this->getAPIKecamatan($this->access_token);
        // $this->desas = $this->getAPIDesa($this->access_token);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('poktan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        
        if ($request->ajax()) {
            $npwp = (Auth::user()::find(Auth::user()->id)->data_user->npwp_company ?? null);

            $query = 'select g.no_riph, g.id_kecamatan, g.nama_kelompok, g.nama_pimpinan, g.hp_pimpinan, count(p.nama_petani) as jum_petani, round(SUM(p.luas_lahan),2) as luas 
            from poktans p, group_tanis g
            where p.npwp = "' . $npwp . '"' . ' and p.id_poktan=g.id_poktan
            GROUP BY g.nama_kelompok';

            
            $table = Datatables::of(DB::select(DB::raw($query)));
            $table->addColumn('actions', '&nbsp;');

            
            $table->editColumn('actions', function ($row) {
                $nomor = Str::replace('.', '', $row->no_riph);
                $nomor = Str::replace('/', '', $nomor);
                $urlView = route('admin.task.kelompoktani.show', $nomor );
                return '<a class="btn btn-xs btn-primary " data-toggle="tooltip" title data-original-title="view" href='.$urlView.'>'.
                '    <i class="fal fa-eye"></i></a>';
            });

            
            $table->editColumn('no_riph', function ($row) {
                return $row->no_riph ? $row->no_riph : '';
            });
            
            $table->editColumn('id_kecamatan', function ($row) {
                return $row->id_kecamatan ? $row->id_kecamatan : '';
            });
            
            $table->editColumn('nama_kelompok', function ($row) {
                return $row->nama_kelompok ? $row->nama_kelompok : '';
            });

            $table->editColumn('nama_pimpinan', function ($row) {
                return $row->nama_pimpinan ? $row->nama_pimpinan : '';
            });

            $table->editColumn('hp_pimpinan', function ($row) {
                return $row->hp_pimpinan ? $row->hp_pimpinan : '';
            });
            
            
            $table->editColumn('jum_petani', function ($row) {
                return $row->jum_petani ? $row->jum_petani  : '';
            });
            
            $table->editColumn('luas', function ($row) {
                return $row->luas ? number_format($row->luas, 2, '.', ',') : 0;
            });
            
            
            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        $module_name = 'Proses RIPH' ;
        $page_title = 'Kelompok Tani';
        $page_heading = 'Kelompok Tani' ;
        $heading_class = 'fa fa-user-alt';
        return view('admin.kelompoktani.index', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $kabupaten = $this->getAPIKabupatenProp($this->access_token, '11');
        $kecamatan = $this->getAPIKecamatanKab($this->access_token, '1101');
        $desa = $this->getAPIDesaKec($this->access_token, '1101010');
        $module_name = 'Proses RIPH' ;
        $page_title = 'Tambah Kelompok Tani';
        $page_heading = 'Tambah Kelompok Tani' ;
        $heading_class = 'fa fa-user-alt';
        return view('admin.kelompoktani.create', 
        ['access_token' => $this->access_token,
        'module_name' => $module_name, 
        'page_title' => $page_title, 
        'page_heading' => $page_heading, 
        'heading_class' => $heading_class, 
        'user_id' => $user_id, 
        'provinsis' => $this->provinsis, 
        'kabupatens' => $kabupaten, 
        'kecamatans' => $kecamatan, 
        'desas' => $desa]);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $no_poktan = $request->string('id_simluhtan','');
        $nama_poktan = $request->string('nama_poktan','');
        $provinsi = $request->string('provinsi', '');
        $kabupaten = $request->string('kabupaten', '');
        $kecamatan = $request->string('kecamatan', '');
        $desa = $request->string('desa', '');
        $jumlah_anggota = $request->integer('jumlah_anggota', 0);
        $luas_lahan = $request->float('luas_lahan', 0);
        $cpcl_id = 0;
        $alamat = $request->string('alamat', '');
        $no_hp = $request->string('no_hp', '');
        $pimpinan = $request->string('pimpinan', '');

        //dd($jumlah_anggota, $luas_lahan, $alamat, $no_hp, $pimpinan);

        $kelompoktani = Kelompoktani::create([
            'user_id'       => $user_id,
            'cpcl_id'       => $cpcl_id,
            'no_poktan'     => $no_poktan,
            'nama_poktan'   => $nama_poktan,
            'provinsi'      => $provinsi,
            'kabupaten'     => $kabupaten,
            'kecamatan'     => $kecamatan,
            'desa'          => $desa,
            'jumlah_anggota' => $jumlah_anggota,
            'luas_lahan'    => $luas_lahan,
            'alamat'        => $alamat,
            'no_hp'         => $no_hp,
            'pimpinan'      => $pimpinan
        ]);
        if ($kelompoktani)
        {            
            session()->flash('message', trans('global.create_success'));
            return redirect()->route('admin.task.kelompoktani.index');
        }
        else 
            return back()->withErrors('Gagal menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelompoktani  $kelompoktani
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $nomor)
    {
        abort_if(Gate::denies('poktan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        
        if ($request->ajax()) {
            
            $realno = Str::substr($nomor, 0, 4) . '/' . Str::substr($nomor, 4, 2) . '.' . Str::substr($nomor, 6, 3) . '/' . Str::substr($nomor, 9, 1) . '/' . Str::substr($nomor, 10, 2) . '/' . Str::substr($nomor, 12, 4);

            $query = Poktan::select(sprintf('%s.*', (new Poktan())->table))->where('no_riph', $realno);
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'poktan_show';
                $editGate = 'poktan_edit';
                $deleteGate = 'poktan_delete';
                $crudRoutePart = 'task.kelompoktani';

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
            $table->editColumn('no_riph', function ($row) {
                return $row->no_riph ? $row->no_riph : '';
            });
            $table->editColumn('id_kabupaten', function ($row) {
                return $row->id_kabupaten ? $row->id_kabupaten : '';
            });
            $table->editColumn('id_kecamatan', function ($row) {
                return $row->id_kecamatan ? $row->id_kecamatan : '';
            });
            $table->editColumn('id_kelurahan', function ($row) {
                return $row->id_kelurahan ? $row->id_kelurahan : '';
            });
            $table->editColumn('nama_kelompok', function ($row) {
                return $row->nama_kelompok ? $row->nama_kelompok : '';
            });
            $table->editColumn('nama_pimpinan', function ($row) {
                return $row->nama_pimpinan ? $row->nama_pimpinan : '';
            });
            $table->editColumn('hp_pimpinan', function ($row) {
                return $row->hp_pimpinan ? $row->hp_pimpinan  : '';
            });
            $table->editColumn('nama_petani', function ($row) {
                return $row->nama_petani ? $row->nama_petani  : '';
            });
            $table->editColumn('ktp_petani', function ($row) {
                return $row->ktp_petani ? $row->ktp_petani : 0;
            });
            $table->editColumn('luas_lahan', function ($row) {
                return $row->luas_lahan ? number_format($row->luas_lahan, 2, '.', ',') : 0;
            });
            $table->editColumn('periode_tanam', function ($row) {
                return $row->periode_tanam ? $row->periode_tanam : '';
            });
            
            
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        
        
        
        $realno = Str::substr($nomor, 0, 4) . '/' . Str::substr($nomor, 4, 2) . '.' . Str::substr($nomor, 6, 3) . '/' . Str::substr($nomor, 9, 1) . '/' . Str::substr($nomor, 10, 2) . '/' . Str::substr($nomor, 12, 4);

        $module_name = 'Proses RIPH' ;
        $page_title = 'Detail Kelompok Tani';
        $page_heading = 'Detail Kelompok Tani' ;
        $heading_class = 'fal fa-user-alt';
        
        return view('admin.kelompoktani.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'nomor', 'realno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelompoktani  $kelompoktani
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelompoktani $kelompoktani)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelompoktani  $kelompoktani
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelompoktani $kelompoktani)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelompoktani  $kelompoktani
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('kelompoktani_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $poktan = Kelompoktani::find($id);
        $poktan->delete();

        return back();
    }

    public function massDestroy(MassDestroyKelompoktaniRequest $request)
    {
        
        Kelompoktani::whereIn('id', request('ids'))->delete();
        
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
