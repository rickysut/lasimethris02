<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class getdesakode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $kd_desa;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($desa)
    {
        $this->kd_desa = $desa;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filepath = 'master/token.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $token = json_decode(file_get_contents($pathjson), true);
        } else {
            $response = Http::asForm()->post(config('app.simevi_url').'getToken', [
                'username' => config('app.simevi_user'),
                'password' => config('app.simevi_pwd')
            ]);
            
            // dd($response->json());
            $filepath = 'master/token.json';
            if (Storage::disk('local')->exists($filepath)) 
                Storage::disk('local')->delete($filepath); 
            Storage::disk('local')->put($filepath, json_encode($response->json()));
            $token = $response->json();
        }
        $response = Http::withToken($token['access_token'])->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'desas/'.$this->kd_desa);

        $filepath = 'master/desakode_'.$this->kd_desa.'.json';
        if (Storage::disk('local')->exists($filepath)) 
            Storage::disk('local')->delete($filepath); 
        Storage::disk('local')->put($filepath, json_encode($response->json()));
    }
}
