<?php

namespace App\Http\Controllers\Traits;

use \SpreadsheetReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
            $pathjson = Storage::disk('public')->url('uploads/'.$npwp);
            $res = json_decode(file_get_contents($pathjson . '/'.$nomor.'.json'), true);
        } catch (\Exception $e) {
            Log::error('Load JSON Exception: ' . $e->getMessage());
            throw new \Exception('Problem with json file');
        }
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