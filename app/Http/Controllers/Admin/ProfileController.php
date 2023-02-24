<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SimeviTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{

    use SimeviTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $access_token = $this->getAPIAccessToken(config('app.simevi_user'), config('app.simevi_pwd'));
        
        $module_name = 'Profile' ;
        $page_title = 'Myprofile';
        $page_heading = 'Myprofile' ;
        $heading_class = 'fa fa-user';

        $data_user = Auth::user()::find(auth()->id())->data_user;

        $provinsi = $this->getAPIProvinsiAll($access_token);
        $kabupaten = $this->getAPIKabupatenProp($access_token, $data_user->provinsi);
        $kecamatan = $this->getAPIKecamatanKab($access_token, $data_user->kabupaten);
        $desa = $this->getAPIDesaKec($access_token, $data_user->kecamatan);

        return view('admin.profiles.index', compact('module_name', 'page_title', 'page_heading', 'heading_class',
    'access_token', 'provinsi', 'kabupaten', 'kecamatan', 'desa', 'data_user'));
    
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
