<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\MasterAnggota;
use App\Models\MasterKelompok;
use App\Models\PksMitra;
use App\Models\AnggotaMitra;
use App\Models\CommitmentBackdate;

class PksMitraController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
		$pksmitra = new PksMitra();

		$pksmitra->commitmentbackdate_id = $request->input('commitmentbackdate_id');
		$pksmitra->master_kelompok_id = $request->input('master_kelompok_id');
		$pksmitra->no_ijin = $request->input('no_ijin');
		$pksmitra->no_pks = $request->input('no_pks');
		$pksmitra->tgl_mulai = $request->input('tgl_mulai');
		$pksmitra->tgl_akhir = $request->input('tgl_akhir');
		$pksmitra->luas_rencana = $request->input('luas_rencana');
		$pksmitra->varietas = $request->input('varietas');
		$pksmitra->periode_tanam = $request->input('periode_tanam');
		$pksmitra->attachment = $request->input('attachment');

		if ($request->hasFile('attachment')) {
			$attch = $request->file('attachment');
			$attchname = 'riph' . $pksmitra->commitmentbackdate_id . '_' . 'pks' . $pksmitra->id . '_' . 'poktan' . $pksmitra->master_kelompok_id . '_' . time() . '.' . $attch->getClientOriginalExtension();
			Storage::disk('public')->putFileAs('docs/pks', $attch, $attchname);
			$pksmitra->attachment = $attchname;
		}

		// dd($pksmitra);
		$pksmitra->save();
		return redirect()->route('admin.task.commitments.show', $pksmitra->commitmentbackdate_id)->with('success', 'Data Perjanjian Kerjasama saved successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$module_name = 'Commitments';
		$page_title = 'Realisasi';
		$page_heading = 'Laporan Realisasi';
		$heading_class = 'fa fa-dolly';

		$commitment = CommitmentBackdate::with('pksmitra.anggotamitras')->findOrFail($id);
		$masterkelompoks = MasterKelompok::all();
		$masterkelompok = MasterKelompok::findOrFail($id);
		$pksmitra = PksMitra::findOrFail($id);
		$masteranggotas = MasterAnggota::where('master_kelompok_id', $pksmitra->master_kelompok_id)->get();
		$anggotamitras = AnggotaMitra::where('pks_mitra_id', $id)->get();

		// Define the groups and their associated fields
		$groups = [
			'Geolokasi' => ['latitude', 'longitude', 'altitudes', 'nama_lokasi', 'polygon'],
			'Tanam' => ['tgl_tanam', 'luas_tanam', 'varietas', 'tanam_doc', 'tanam_pict'],
			'Produksi' => ['tgl_panen', 'volume', 'panen_doc', 'panen_pict'],
		];

		// Initialize variables to keep track of the warnings and errors
		$warns = [];
		$fault = [];

		// Loop through each group and check if any of the fields are empty or null
		foreach ($groups as $group => $fields) {
			$groupComplete = true;

			foreach ($anggotamitras as $anggotamitra) {
				foreach ($fields as $field) {
					if (empty($anggotamitra->$field)) {
						$groupComplete = false;
						break 2;
					}
				}
			}

			if (!$groupComplete) {
				$warns[] = "Data $group belum dilengkapi.";
			}
		}

		return view('v2.commitment.pksmitra.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'masterkelompoks', 'masteranggotas', 'pksmitra', 'anggotamitras', 'commitment', 'masterkelompok', 'warns', 'fault'));
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
		$module_name = 'Commitments';
		$page_title = 'Kerjasama';
		$page_heading = 'Perjanjian Kerjasama';
		$heading_class = 'fa fa-file-signature';

		$commitment = CommitmentBackdate::with('user')->findOrFail($id);
		$masterkelompoks = MasterKelompok::all();
		$commitmentbackdate = CommitmentBackdate::with('pksmitra.masterkelompok')
			->findOrFail($id);
		$pksmitra = PksMitra::findOrFail($id);
		$masterkelompok = MasterKelompok::with('pksmitra')->findOrFail($id);
		$pksmitras = $commitmentbackdate->pksmitra;

		return view('v2.commitment.pksmitra.edit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'commitment', 'masterkelompoks', 'pksmitras', 'commitmentbackdate', 'pksmitra', 'masterkelompok'));
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
		$pksmitra = PksMitra::find($id);
		$pksmitra->commitmentbackdate_id = $request->input('commitmentbackdate_id');
		$pksmitra->master_kelompok_id = $request->input('master_kelompok_id');
		$pksmitra->no_ijin = $request->input('no_ijin');
		$pksmitra->no_pks = $request->input('no_pks');
		$pksmitra->tgl_mulai = $request->input('tgl_mulai');
		$pksmitra->tgl_akhir = $request->input('tgl_akhir');
		$pksmitra->luas_rencana = $request->input('luas_rencana');
		$pksmitra->varietas = $request->input('varietas');
		$pksmitra->periode_tanam = $request->input('periode_tanam');
		$pksmitra->attachment = $request->input('attachment');

		if ($request->hasFile('attachment')) {
			$attch = $request->file('attachment');
			$attchname = 'riph' . $pksmitra->commitmentbackdate_id . '_' . 'pks' . $pksmitra->id . '_' . 'poktan' . $pksmitra->master_kelompok_id . '_' . time() . '.' . $attch->getClientOriginalExtension();
			Storage::disk('public')->putFileAs('docs/pks', $attch, $attchname);
			$pksmitra->attachment = $attchname;
		}

		// dd($pksmitra);
		$pksmitra->save();
		return redirect()->route('admin.task.commitments.show', $pksmitra->commitmentbackdate_id)->with('success', 'Data Perjanjian Kerjasama saved successfully');
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
		$pksmitra = PksMitra::withTrashed()->findOrFail($id);
		// $commitments->childrelatedmodel()->delete(); //delete related object here
		$pksmitra->delete();
		return redirect()->route('admin.task.commitments.show', $pksmitra->commitmentbackdate_id)->with('success', 'Data Perjanjian deleted successfully');
	}
}
