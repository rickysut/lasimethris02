<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Commitmentbackdate;
use Database\Factories\CommitmentBackdateFactory;

class CommitmentBackdateController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		//
		$module_name = 'Commitments';
		$page_title = 'Commitment';
		$page_heading = 'Daftar Commitment';
		$heading_class = 'fa fa-file-invoice';

		$user = Auth::user();
		$commitments = $user->commitmentbackdate()->get();

		return view('v2.commitment.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'user', 'commitments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		$module_name = 'Commitments';
		$page_title = 'Commitment';
		$page_heading = 'Create New Commitment: ';
		$heading_class = 'fa fa-file-edit';

		return view('v2.commitment.create', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
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
		$commitments = new CommitmentBackdate();
		$commitments->user_id = Auth::user()->id;
		$commitments->no_ijin = $request->input('no_ijin');
		$commitments->periodetahun = $request->input('periodetahun');
		$commitments->tgl_ijin = $request->input('tgl_ijin');
		$commitments->tgl_akhir = $request->input('tgl_akhir');
		$commitments->no_hs = $request->input('no_hs');
		$commitments->volume_riph = $request->input('volume_riph');
		$commitments->no_hs = $request->input('no_hs');
		$commitments->stok_mandiri = $request->input('stok_mandiri');
		$commitments->organik = $request->input('organik');
		$commitments->npk = $request->input('npk');
		$commitments->dolomit = $request->input('dolomit');
		$commitments->za = $request->input('za');
		$commitments->mulsa = $request->input('mulsa');
		$commitments->poktan_share = $request->input('poktan_share');
		// dd($commitments);
		$commitments->save();

		return redirect()->route('admin.task.commitments.index')->with('success', 'Data Commitment updated successfully');
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
		$module_name = 'Commitments';
		$page_title = 'Commitment';
		$page_heading = 'Detail Commitment';
		$heading_class = 'fa fa-file-invoice';

		$commitments = CommitmentBackdate::with('user')->findOrFail($id);
		return view('v2.commitment.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'commitments'));
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
		$commitments = CommitmentBackdate::with('user')->findOrFail($id);

		$module_name = 'Commitments';
		$page_title = 'Commitment';
		$page_heading = 'Edit Commitment: ' . $commitments->no_ijin;
		$heading_class = 'fa fa-file-edit';

		return view('v2.commitment.edit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'commitments'));
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
		$commitments = CommitmentBackdate::find($id);
		$commitments->user_id = Auth::user()->id;
		$commitments->no_ijin = $request->input('no_ijin');
		$commitments->periodetahun = $request->input('periodetahun');
		$commitments->tgl_ijin = $request->input('tgl_ijin');
		$commitments->tgl_akhir = $request->input('tgl_akhir');
		$commitments->no_hs = $request->input('no_hs');
		$commitments->volume_riph = $request->input('volume_riph');
		$commitments->no_hs = $request->input('no_hs');
		$commitments->stok_mandiri = $request->input('stok_mandiri');
		$commitments->organik = $request->input('organik');
		$commitments->npk = $request->input('npk');
		$commitments->dolomit = $request->input('dolomit');
		$commitments->za = $request->input('za');
		$commitments->mulsa = $request->input('mulsa');
		$commitments->poktan_share = $request->input('poktan_share');
		// dd($commitments);
		$commitments->save();
		return redirect()->route('admin.task.commitments.index')->with('success', 'Data Commitment updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$commitments = CommitmentBackdate::withTrashed()->findOrFail($id);
		// $commitments->childrelatedmodel()->delete(); //delete related object here
		$commitments->delete();
		return redirect()->route('admin.task.commitments.index')->with('success', 'Data Commitment deleted successfully');
	}
}
