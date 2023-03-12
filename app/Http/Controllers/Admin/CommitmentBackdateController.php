<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Commitmentbackdate;
use App\Models\MasterPenangkar;
use App\Models\MasterKelompok;
use App\Models\PenangkarMitra;

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

		$masterpenangkars = MasterPenangkar::all();
		$user = Auth::user();
		$commitments = $user->commitmentbackdate()->get();

		return view('v2.commitment.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'user', 'commitments', 'masterpenangkars'));
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
		$masterpenangkars = MasterPenangkar::all();

		return view('v2.commitment.create', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'masterpenangkars'));
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
		$module_name = 'Commitments';
		$page_title = 'Commitment';
		$page_heading = 'Detail Commitment';
		$heading_class = 'fa fa-file-invoice';

		$commitment = CommitmentBackdate::with('user')->findOrFail($id);
		$masterpenangkars = MasterPenangkar::all();
		$commitmentbackdate = CommitmentBackdate::with('penangkarmitra.masterpenangkar')
			->findOrFail($id);
		$penangkarmitras = $commitmentbackdate->penangkarmitra;

		return view('v2.commitment.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'commitment', 'masterpenangkars', 'penangkarmitras', 'commitmentbackdate'));
	}

	public function penangkar($id)
	{
		$module_name = 'Commitments';
		$page_title = 'Penangkar';
		$page_heading = 'Penangkar Mitra';
		$heading_class = 'fa fa-file-invoice';

		$commitment = CommitmentBackdate::with('user')->findOrFail($id);
		$masterpenangkars = MasterPenangkar::all();
		$commitmentbackdate = CommitmentBackdate::with('penangkarmitra.masterpenangkar')
			->findOrFail($id);
		$penangkarmitras = $commitmentbackdate->penangkarmitra;

		return view('v2.commitment.penangkarmitra', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'commitment', 'masterpenangkars', 'penangkarmitras', 'commitmentbackdate'));
	}

	public function pksmitra($id)
	{
		$module_name = 'Commitments';
		$page_title = 'Kerjasama';
		$page_heading = 'Perjanjian Kerjasama';
		$heading_class = 'fa fa-file-signature';

		$commitment = CommitmentBackdate::with('user')->findOrFail($id);
		$masterkelompoks = MasterKelompok::all();
		$commitmentbackdate = CommitmentBackdate::with('pksmitra.masterkelompok')
			->findOrFail($id);
		$pksmitras = $commitmentbackdate->pksmitra;

		return view('v2.commitment.pksmitra.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'commitment', 'masterkelompoks', 'pksmitras', 'commitmentbackdate'));
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
		//load all commitments for current user
		$commitments = CommitmentBackdate::with('user')->findOrFail($id);

		//load all Master Penangkar for reference in blade view
		$masterpenangkars = MasterPenangkar::all();

		//load all Penangkar Mitra for current Commitment (commitment_backdate_id)
		$penangkarmitras = PenangkarMitra::with('commitmentbackdate')->get();

		$module_name = 'Commitments';
		$page_title = 'Commitment';
		$page_heading = 'Edit Commitment: ' . $commitments->no_ijin;
		$heading_class = 'fa fa-file-edit';


		return view('v2.commitment.edit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'commitments', 'masterpenangkars', 'penangkarmitras'));
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
		$commitments->penangkarmitra()->delete(); //delete related object here
		$commitments->delete();
		return redirect()->route('admin.task.commitments.index')->with('success', 'Data Commitment deleted successfully');
	}
}
