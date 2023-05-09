<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnggotaMitra;
use App\Models\Commitment;
use App\Models\Commitmentbackdate;
use App\Models\PenangkarMitra;
use App\Models\PksMitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

	public function getRealisasibyYear($periodeTahun)
	{
		$currentUser = Auth::user();
		$users = User::where('id', $currentUser->id)->with(['commitmentbackdate' => function ($query) use ($periodeTahun) {
			$query->where('periodetahun', $periodeTahun);
		}, 'commitmentbackdate.pksmitra.anggotamitras'])->get();

		$results = [];

		foreach ($users as $user) {
			if ($user->commitmentbackdate->count() > 0) {
				$total_luastanam = $user->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->sum('luas_tanam');

				$total_volume = $user->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->sum('volume');

				$total_anggotamitras = $user->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->count();

				$total_import = $user->commitmentbackdate->sum('volume_riph');

				$total_poktan = $user->commitmentbackdate->flatMap->pksmitra->countBy('master_kelompok_id')->count();

				$count_pksmitra = $user->commitmentbackdate->flatMap->pksmitra->count();

				$results[] = [
					'id' => $user->id,
					// 'periode_tahun' => $periodeTahun,
					'total_import' => $total_import,
					'total_luastanam' => $total_luastanam,
					'total_volume' => $total_volume,
					'total_poktan' => $total_poktan,
					'count_pksmitra' => $count_pksmitra,
					'total_anggotamitras' => $total_anggotamitras,
				];
			}
		}

		return response()->json($results);
	}

	public function getRealisasiAll()
	{
		$user = Auth::user();
		$users = User::where('id', $user->id)
			->with(['commitmentbackdate.pksmitra.anggotamitras'])
			->get();
		$results = [];

		foreach ($users as $u) {
			if ($u->commitmentbackdate) {
				$total_luastanam = $u->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->sum('luas_tanam');

				$total_volume = $u->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->sum('volume');

				$total_anggotamitras = $u->commitmentbackdate->flatMap(function ($cb) {
					return $cb->pksmitra->flatMap(function ($pm) {
						return $pm->anggotamitras;
					});
				})->count();
				$total_import = $user->commitmentbackdate->sum('volume_riph');

				$total_poktan = $u->commitmentbackdate->flatMap->pksmitra->countBy('master_kelompok_id')->count();

				$count_pksmitra = $u->commitmentbackdate->flatMap->pksmitra->count();


				$results[] = [
					'id' => $u->id,
					'total_import' => $total_import,
					'total_luastanam' => $total_luastanam,
					'total_volume' => $total_volume,
					'total_poktan' => $total_poktan,
					'count_pksmitra' => $count_pksmitra,
					'total_anggotamitras' => $total_anggotamitras,
				];
			}
		}

		return response()->json($results);
	}

	public function getVerifiedbyYear($periodeTahun)
	{
		$currentUser = Auth::user();
		$users = User::where('id', $currentUser->id)->with(['commitmentbackdate' => function ($query) use ($periodeTahun) {
			$query->where('periodetahun', $periodeTahun);
		}, 'commitmentbackdate.pksmitra.anggotamitras'])->get();

		$results = [];
	}

	public function getVerifiedAll()
	{
		$user = Auth::user();
		$users = User::where('id', $user->id)
			->with(['commitmentbackdate.pksmitra.anggotamitras'])
			->get();
		$results = [];
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
}
