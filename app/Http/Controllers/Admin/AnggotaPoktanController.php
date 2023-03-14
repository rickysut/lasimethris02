<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterAnggota;
use Illuminate\Http\Request;

class AnggotaPoktanController extends Controller
{
	public function index(Request $request)
	{
		//
	}

	public function create()
	{
		//
	}

	public function store(Request $request)
	{
		$anggota = new MasterAnggota();
		$anggota->master_kelompok_id = $request->input('master_kelompok_id');
		$anggota->nama_petani = $request->input('nama_petani');
		$anggota->nik_petani = $request->input('nik_petani');
		$anggota->luas_lahan = $request->input('luas_lahan');

		// dd($request->all());
		$anggota->save();

		return redirect()->route('admin.task.masterpoktan.show', $anggota->master_kelompok_id)->with('success', 'Anggota saved successfully');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update(Request $request, $id)
	{
		$anggota = MasterAnggota::find($id);
		$anggota->master_kelompok_id = $request->input('master_kelompok_id');
		$anggota->nama_petani = $request->input('nama_petani');
		$anggota->nik_petani = $request->input('nik_petani');
		$anggota->luas_lahan = $request->input('luas_lahan');
		$anggota->save();

		return redirect()->route('admin.task.masterpoktan.show', $anggota->master_kelompok_id)->with('success', 'Data Anggota Updated successfully');
	}

	public function destroy($id)
	{
		$anggota = MasterAnggota::findOrFail($id);
		$anggota->delete();

		return redirect()->route('admin.task.masterpoktan.show', $anggota->master_kelompok_id)->with('success', 'Data Anggota deleted successfully');
	}
}
