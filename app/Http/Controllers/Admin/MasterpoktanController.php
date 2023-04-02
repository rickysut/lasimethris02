<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterKelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterpoktanController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		//
		$module_name = 'Kelompok Tani';
		$page_title = 'Kelompoktani';
		$page_heading = 'Master Kelompoktani';
		$heading_class = 'fa fa-users';

		$user = Auth::user();
		$poktans = $user->masterkelompok()->withCount('masteranggota')->get();

		return view('v2.poktan.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'user', 'poktans'));
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
		$masterkelompok = new MasterKelompok();
		$masterkelompok->user_id = $request->input('user_id');
		$masterkelompok->nama_kelompok = $request->input('nama_kelompok');
		$masterkelompok->nama_pimpinan = $request->input('nama_pimpinan');
		$masterkelompok->hp_pimpinan = $request->input('hp_pimpinan');
		$masterkelompok->id_provinsi = $request->input('id_provinsi');
		$masterkelompok->id_kabupaten = $request->input('id_kabupaten');
		$masterkelompok->id_kecamatan = $request->input('id_kecamatan');
		$masterkelompok->id_kelurahan = $request->input('id_kelurahan');

		// dd($request->all());
		$masterkelompok->save();

		return redirect()->route('admin.task.masterpoktan.index')->with('success', 'Kelompoktani saved successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$module_name = 'Kelompok Tani';
		$page_title = 'Detail Kelompoktani';
		$page_heading = 'Master Anggota Poktan';
		$heading_class = 'fa fa-users';

		//load all master kelompok
		$poktans = MasterKelompok::all();

		//load poktan for current id that has anggota
		$poktan = MasterKelompok::with('masteranggota')->findOrFail($id);

		//load anggota for current poktan
		$anggotas = $poktan->masteranggota;

		return view('v2.poktan.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'poktans', 'poktan', 'anggotas'));
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
		$masterkelompok = MasterKelompok::find($id);
		$masterkelompok->user_id = Auth::user()->id;
		$masterkelompok->nama_kelompok = $request->input('nama_kelompok');
		$masterkelompok->nama_pimpinan = $request->input('nama_pimpinan');
		$masterkelompok->hp_pimpinan = $request->input('hp_pimpinan');
		$masterkelompok->id_provinsi = $request->input('id_provinsi');
		$masterkelompok->id_kabupaten = $request->input('id_kabupaten');
		$masterkelompok->id_kecamatan = $request->input('id_kecamatan');
		$masterkelompok->id_kelurahan = $request->input('id_kelurahan');
		$masterkelompok->save();

		return redirect()->route('admin.task.masterpoktan.index')->with('success', 'Kelompoktani updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$masterkelompoks = MasterKelompok::withTrashed()->findOrFail($id);
		$masterkelompoks->masteranggota()->delete();
		$masterkelompoks->delete();

		return redirect()->route('admin.task.masterpoktan.index')->with('success', 'Data Kelompoktani deleted successfully');
	}
}
