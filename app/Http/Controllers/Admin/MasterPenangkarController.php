<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterPenangkar;
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

		return view('v2.penangkar.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'masterpenangkars'));
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
		$masterpenangkars = new MasterPenangkar();
		$masterpenangkars->nama_lembaga = $request->input('nama_lembaga');
		$masterpenangkars->nama_pimpinan = $request->input('nama_pimpinan');
		$masterpenangkars->nama_pimpinan = $request->input('nama_pimpinan');
		$masterpenangkars->hp_pimpinan = $request->input('hp_pimpinan');
		$masterpenangkars->alamat = $request->input('alamat');
		$masterpenangkars->provinsi_id = $request->input('provinsi_id');
		$masterpenangkars->kabupaten_id = $request->input('kabupaten_id');
		$masterpenangkars->kecamatan_id = $request->input('kecamatan_id');
		$masterpenangkars->kecamatan_id = $request->input('kecamatan_id');

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
		$masterpenangkars = MasterPenangkar::findOrFail($id);
		$masterpenangkars->delete();

		return redirect()->route('admin.task.masterpenangkar.index')->with('success', 'Data Penangkar deleted successfully');
	}
}
