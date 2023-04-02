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

class getkeckode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $kd_kec;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($kec)
    {
        $this->kd_kec = $kec;
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
            $job = new gettoken();
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $token = json_decode(file_get_contents($pathjson), true);
            }
        }
        $response = Http::withToken($token['access_token'])->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'kecamatans/'.$this->kd_kec);

        $filepath = 'master/keckode_'.$this->kd_kec.'.json';
        if (Storage::disk('local')->exists($filepath)) 
            Storage::disk('local')->delete($filepath); 
        Storage::disk('local')->put($filepath, json_encode($response->json()));
    }
}
