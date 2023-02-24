<?php

namespace App\Http\Controllers\Traits;

use \SpreadsheetReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait SimeviTrait
{
    public function getAPIAccessToken($username, $pass){
        $response = Http::asForm()->post(config('app.simevi_url').'getToken', [
            'username' => $username,
            'password' => $pass
        ]);

        $access_token = $response->json('access_token');
        return $access_token;
    }

    public function getAPIProvinsiAll($token){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'provinsis');

        
        return $response->json();
    }

    public function getAPIKabupatenAll($token){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kabupatens');

        
        return $response->json();
    }

    public function getAPIKabupatenProp($token, $provinsi){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kabupatenwithprop/'.$provinsi);

        
        return $response->json();
    }

    public function getAPIKabupaten($token, $kode){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kabupatens/'.$kode);

        
        return $response->json();
    }

    public function getAPIKecamatanAll($token){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kecamatans');

        
        return $response->json();
    }

    public function getAPIKecamatanKab($token, $kabupaten){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kecamatanwithkab/'.$kabupaten);

        
        return $response->json();
    }

    public function getAPIKecamatan($token, $kode){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kecamatans/'.$kode);

        
        return $response->json();
    }

    public function getAPIDesaAll($token){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'desas');

        
        return $response->json();
    }

    public function getAPIDesaKec($token, $kecamatan){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'desawithkec/'.$kecamatan);

        
        return $response->json();
    }

    public function getAPIDesa($token, $kode){
        $response = Http::withToken($token)->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'desas/'.$kode);

        
        return $response->json();
    }

    public function pull($npwp, $nomor)
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
                'npwp' => $npwp,
                'nomor' =>  $nomor
            );
            $response = $client->__soapCall('get_riph', $parameter);
        } catch (\Exception $e) {

            Log::error('Soap Exception: ' . $e->getMessage());
            throw new \Exception('Problem with SOAP call');
        }
        $res = json_decode(json_encode((array)simplexml_load_string($response)),true);
        return $res;
    }

    public function chekFromItem($items,$keyToSearch)
    {
        $check = 0;
        if (count($items) > 0)
        {
            foreach($items as $item)
            {   
                
                foreach($item as $key)
                {
                    if($key == $keyToSearch)
                    {
                        $check = 1;
                    }
                }

                if($check == 1)
                {
                    break;
                }
            }
        }
        
        return $check;
    }

}