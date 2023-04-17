<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commitmentbackdate;
use App\Models\MasterPenangkar;
use App\Models\PenangkarMitra;
use Illuminate\Http\Request;

class MasterPenangkarController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module_name = 'Penangkar'; //usually Model Name
		$page_title = 'Penangkar'; //this will be the page title for browser
		$page_heading = 'Master Penangkar'; //this will be the page heading.
		$heading_class = 'fal fa-seedling'; //this will be the leading icon for the page heading

		$masterpenangkars = MasterPenangkar::all(); //this has no relationship with any table, everyone can add or view the data.

		// Trim the alamat field in each record
		foreach ($masterpenangkars as $penangkar) {
			$penangkar->alamat = trim($penangkar->alamat);
		}

		return view('v2.masterpenangkar.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'masterpenangkars'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		$module_name = 'Master Penangkar'; //usually Model Name
		$page_title = 'Tambah Data'; //this will be the page title for browser
		$page_heading = 'Tambah Data Penangkar'; //this will be the page heading.
		$heading_class = 'fal fa-seedling'; //this will be the leading icon for the page heading

		return view('v2.masterpenangkar.create', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$masterpenangkars = new MasterPenangkar();
		$masterpenangkars->nama_lembaga = $request->input('nama_lembaga');
		$masterpenangkars->nama_pimpinan = $request->input('nama_pimpinan');
		$masterpenangkars->hp_pimpinan = $request->input('hp_pimpinan');
		$masterpenangkars->alamat = $request->input('alamat');
		$masterpenangkars->provinsi_id = $request->input('provinsi_id');
		$masterpenangkars->kabupaten_id = $request->input('kabupaten_id');
		$masterpenangkars->kecamatan_id = $request->input('kecamatan_id');
		$masterpenangkars->kecamatan_id = $request->input('kelurahan_id');

		// dd($request->all());
		$masterpenangkars->save();

		return redirect()->route('admin.task.masterpenangkar.index')->with('success', 'Category saved successfully');
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
		$module_name = 'Master Penangkar'; //usually Model Name
		$page_title = 'Ubah Data'; //this will be the page title for browser
		$page_heading = 'Ubah Data Penangkar'; //this will be the page heading.
		$heading_class = 'fal fa-edit'; //this will be the leading icon for the page heading

		$masterpenangkar = MasterPenangkar::findOrFail($id);

		return view('v2.masterpenangkar.edit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'masterpenangkar'));
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
		$masterpenangkars = MasterPenangkar::find($id);
		$masterpenangkars->nama_lembaga = $request->input('nama_lembaga');
		$masterpenangkars->nama_pimpinan = $request->input('nama_pimpinan');
		$masterpenangkars->nama_pimpinan = $request->input('nama_pimpinan');
		$masterpenangkars->hp_pimpinan = $request->input('hp_pimpinan');
		$masterpenangkars->alamat = $request->input('alamat');
		$masterpenangkars->provinsi_id = $request->input('provinsi_id');
		$masterpenangkars->kabupaten_id = $request->input('kabupaten_id');
		$masterpenangkars->kecamatan_id = $request->input('kecamatan_id');
		$masterpenangkars->kecamatan_id = $request->input('kecamatan_id');
		$masterpenangkars->save();

		return redirect()->route('admin.task.masterpenangkar.index')->with('success', 'Category saved successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$masterpenangkars = MasterPenangkar::withTrashed()->findOrFail($id);
		foreach ($masterpenangkars->penangkarmitra as $penangkarmitra) {
			$penangkarmitra->delete();
		}
		$masterpenangkars->delete();

		return redirect()->route('admin.task.masterpenangkar.index')->with('success', 'Data Penangkar deleted successfully');
	}
}
