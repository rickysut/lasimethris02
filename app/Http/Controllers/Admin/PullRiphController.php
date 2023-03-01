<?php

namespace App\Http\Controllers\Admin;

use App\Models\PullRiph;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use  App\Models\Poktan;

class PullRiphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('pull_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $module_name = 'Proses RIPH' ;
        $page_title = 'Tarik Data RIPH';
        $page_heading = 'Tarik Data RIPH' ;
        $heading_class = 'fa fa-sync-alt';
        $npwp_company = (Auth::user()::find(Auth::user()->id)->data_user->npwp_company ?? null);
        return view('admin.pullriph.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'npwp_company')); 
    }


    public function pull(Request $request)
    {   
        try {
            $options = array(
                'soap_version' => SOAP_1_1,
                'exceptions' => true,
                'trace' => 1,
                'cache_wsdl' => WSDL_CACHE_MEMORY,
                'connection_timeout' => 25,
                'style' => SOAP_RPC,
                'use' => SOAP_ENCODED,
            );
    
            $client = new \SoapClient('http://riph.pertanian.go.id/api.php/simethris?wsdl', $options);
            $parameter = array(
                'user' => 'simethris',
                'pass' => 'wsriphsimethris',
                'npwp' => $request->string('npwp'),
                'nomor' =>  $request->string('nomor')
            );
            $response = $client->__soapCall('get_riph', $parameter);
        } catch (\Exception $e) {

            Log::error('Soap Exception: ' . $e->getMessage());
            throw new \Exception('Problem with SOAP call');
        }
        $res = json_decode(json_encode((array)simplexml_load_string($response)),true);
       
        return $res;
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
        $filepath = '';
        try {
            $options = array(
                'soap_version' => SOAP_1_1,
                'exceptions' => true,
                'trace' => 1,
                'cache_wsdl' => WSDL_CACHE_MEMORY,
                'connection_timeout' => 25,
                'style' => SOAP_RPC,
                'use' => SOAP_ENCODED,
            );
    
            $client = new \SoapClient('http://riph.pertanian.go.id/api.php/simethris?wsdl', $options);
            $stnpwp = $request->get('npwp');
            $npwp = str_replace('.', '', $stnpwp);
            $npwp = str_replace('-', '', $npwp);
            $noijin =  $request->get('no_ijin');
            $fijin = str_replace('.', '', $noijin);
            $fijin = str_replace('/', '', $fijin);
            $parameter = array(
                'user' => 'simethris',
                'pass' => 'wsriphsimethris',
                'npwp' => $npwp,
                'nomor' =>  $request->get('no_ijin')
            );
            $response = $client->__soapCall('get_riph', $parameter);
            $datariph = json_encode((array)simplexml_load_string($response));
            $filepath = 'uploads/'.$npwp . '/' . $fijin . '.json';
            Storage::disk('public')->put($filepath, $datariph);

        } catch (\Exception $e) {

            Log::error('Soap Exception: ' . $e->getMessage());
            throw new \Exception('Problem with SOAP call');
        }
        

        $riph = PullRiph::updateOrCreate(
            [ 'npwp' => $request->get('npwp'), 'no_ijin' => $request->get('no_ijin') ],
            [
                'keterangan'    => $request->get('keterangan'),
                'nama'          => $request->get('nama'),
                'periodetahun'  => $request->get('periodetahun'),
                'tgl_ijin'      => $request->get('tgl_ijin'),
                'tgl_akhir'     => $request->get('tgl_akhir'),
                'no_hs'         => $request->get('no_hs'),
                'volume_riph'   => $request->get('volume_riph'),
                'volume_produksi'  => $request->get('volume_produksi'),
                'luas_wajib_tanam' => $request->get('luas_wajib_tanam'),
                'datariph' => $filepath
            ]
        );
        $dtjson = json_decode($datariph);
        if ($riph){
            //dd($dtjson->riph->wajib_tanam->kelompoktani->loop);
            Poktan::where('no_riph',$noijin )->delete();
            foreach ( $dtjson->riph->wajib_tanam->kelompoktani->loop as $poktan )
            {
                $nama = trim($poktan->nama_kelompok, ' ');
                $ktp = preg_replace('/[^0-9\p{Latin}\pP\p{Sc}@\s]+/u', '', $poktan->ktp_petani);
                $ktp  = trim($ktp , "\u{00a0}");
                $ktp = trim($ktp , "\u{00c2}");
                $ktp = trim($ktp , " ");
                $idpetani = trim($poktan->id_petani, ' ');
                Poktan::updateOrCreate(
                    [
                        'no_riph' => $noijin, 
                        'id_petani' => $idpetani
                          
                        
                    ],
                    [
                        'id_kabupaten' => trim($poktan->id_kabupaten,' ') ,
                        'id_kecamatan' => trim($poktan->id_kecamatan, ' ') ,
                        'id_kelurahan' => (is_string($poktan->id_kelurahan) ? trim($poktan->id_kelurahan, ' '): '') ,
                        'nama_kelompok' => strtoupper($nama) , 
                        'nama_pimpinan' => (is_string($poktan->nama_pimpinan) ? trim($poktan->nama_pimpinan, ' ') :'') , 
                        'hp_pimpinan'   => (is_string($poktan->hp_pimpinan) ? trim($poktan->hp_pimpinan, ' ') : '') ,
                        'nama_petani'  => trim($poktan->nama_petani,' ') ,
                        'ktp_petani' => $ktp,
                        'luas_lahan'   => trim($poktan->luas_lahan, ' ') ,
                        'periode_tanam' => trim($poktan->periode_tanam, ' ')
                    ]
                );    
            }
        }
        
        return back()->with('message', "Sukses menyimpan data RIPH, lihat daftarnya di menu Komitmen ");  
    }

    

    
}


