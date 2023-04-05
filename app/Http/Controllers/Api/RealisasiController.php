<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnggotaMitra;
use App\Models\Commitmentbackdate;
use App\Models\PenangkarMitra;
use App\Models\PksMitra;
use Illuminate\Http\Request;

class RealisasiController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$anggotaMitras = AnggotaMitra::with('pksMitra')->get();
		$pksMitras = PksMitra::with(['commitmentbackdate', 'anggotaMitras'])->get();
		$commitmentbackdates = Commitmentbackdate::with('user')->get();

		return response()->json([
			'commitment_backdates' => $commitmentbackdates->map(function ($commitmentbackdate) use ($pksMitras, $anggotaMitras) {
				return [
					'id' => $commitmentbackdate->id,
					'user_id' => $commitmentbackdate->user_id,
					'date' => $commitmentbackdate->updated_at,
					'pks_mitras' => $pksMitras->where('commitmentbackdate_id', $commitmentbackdate->id)->map(function ($pksMitra) use ($anggotaMitras) {
						return [
							'id' => $pksMitra->id,
							'master_kelompok_id' => $pksMitra->master_kelompok_id,
							'commitmentbackdate_id' => $pksMitra->commitmentbackdate_id,
							'anggota_mitras' => $anggotaMitras->where('pks_mitra_id', $pksMitra->id)->map(function ($anggotaMitra) {
								return [
									'id' => $anggotaMitra->id,
									'master_anggota_id' => $anggotaMitra->master_anggota_id,
									'pks_mitra_id' => $anggotaMitra->pks_mitra_id,
									'latitude' => $anggotaMitra->latitude,
									'longitude' => $anggotaMitra->longitude,
									'polygon' => $anggotaMitra->polygon,
									'luas_kira' => $anggotaMitra->luas_kira,
								];
							})
						];
					})
				];
			})
		]);
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
