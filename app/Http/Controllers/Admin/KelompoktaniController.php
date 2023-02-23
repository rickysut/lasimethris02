<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelompoktani;
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
        $this->access_token = $this->getAPIAccessToken(config('app.simevi_user'), config('app.simevi_pwd'));
        $this->provinsis = $this->getAPIProvinsi($this->access_token);
        $this->kabupatens = $this->getAPIKabupaten($this->access_token);
        $this->kecamatans = $this->getAPIKecamatan($this->access_token);
        $this->desas = $this->getAPIDesa($this->access_token);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('kelompoktani_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        
        if ($request->ajax()) {
            $user_id = Auth::user()->id;
            
            $user = Auth::user()::find(Auth::user()->id)->with('roles');
            if (!auth()->user()->isAdmin){
                $query = Kelompoktani::where('user_id', $user_id)->select(sprintf('%s.*', (new Kelompoktani())->table));
            } else
                $query = Kelompoktani::select(sprintf('%s.*', (new Kelompoktani())->table));
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'kelompoktani_show';
                $editGate = 'kelompoktani_edit';
                $deleteGate = 'kelompoktani_delete';
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
            $table->editColumn('user_id', function ($row) {
                return $row->user_id ? $row->user_id : '';
            });
            $table->editColumn('cpcl_id', function ($row) {
                return $row->cpcl_id ? $row->cpcl_id : '';
            });
            $table->editColumn('no_poktan', function ($row) {
                return $row->no_poktan ? $row->no_poktan : '';
            });
            $table->editColumn('nama_poktan', function ($row) {
                return $row->nama_poktan ? $row->nama_poktan : '';
            });
            $table->editColumn('provinsi', function ($row) {
                $provinsi = $this->searchProp($this->provinsis, $row->provinsi);
                return $row->provinsi ? ($provinsi ?? $row->provinsi) : '';
            });
            $table->editColumn('kabupaten', function ($row) {
                $kabupaten = $this->searchKab($this->kabupatens, $row->kabupaten);
                return $row->kabupaten ? ($kabupaten ?? $row->kabupaten) : '';
            });
            $table->editColumn('kecamatan', function ($row) {
                $kecamatan = $this->searchKec($this->kecamatans, $row->kecamatan);
                return $row->kecamatan ? ($kecamatan ?? $row->kecamatan ) : '';
            });
            $table->editColumn('desa', function ($row) {
                $desa = $this->searchDesa($this->desas, $row->desa);
                return $row->desa ? ($desa ?? $row->desa)  : '';
            });
            $table->editColumn('jumlah_anggota', function ($row) {
                return $row->jumlah_anggota ? $row->jumlah_anggota : 0;
            });
            $table->editColumn('luas_lahan', function ($row) {
                return $row->luas_lahan ? number_format($row->luas_lahan, 2, ',', '.') : 0;
            });
            $table->editColumn('alamat', function ($row) {
                return $row->alamat ? $row->alamat : '';
            });
            $table->editColumn('no_hp', function ($row) {
                return $row->no_hp ? $row->no_hp : '';
            });
            $table->editColumn('pimpinan', function ($row) {
                return $row->pimpinan ? $row->pimpinan : '';
            });
            
            $table->rawColumns(['actions', 'placeholder']);

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
    public function show($id)
    {
        $poktan = Kelompoktani::findOrFail($id);
        if ($poktan){
            
            if ($poktan->provinsi){
                $provinsi = $this->searchProp($this->provinsis, $poktan->provinsi);
                $poktan->provinsi = $provinsi ;
            }
            if ($poktan->kabupaten){
                $kabupaten = $this->searchKab($this->kabupatens, $poktan->kabupaten);
                $poktan->kabupaten = $kabupaten ;
            }
            if ($poktan->kecamatan){
                $kecamatan = $this->searchKec($this->kecamatans, $poktan->kecamatan);
                $poktan->kecamatan = $kecamatan ;
            }
            if ($poktan->desa){
                $desa = $this->searchDesa($this->desas, $poktan->desa);
                $poktan->desa = $desa ;
            }
        }
        $module_name = 'Proses RIPH' ;
        $page_title = 'Detail Kelompok Tani';
        $page_heading = 'Detail Kelompok Tani' ;
        $heading_class = 'fal fa-user-alt';
        
        return view('admin.kelompoktani.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'poktan'));
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
