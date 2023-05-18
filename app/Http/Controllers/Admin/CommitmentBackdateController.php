<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Commitmentbackdate;
use App\Models\MasterPenangkar;
use App\Models\MasterKelompok;
use App\Models\PenangkarMitra;
use App\Models\Pengajuan;
use App\Models\PengajuanV2;

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
		$module_name = 'Proses RIPH';
		$page_title = 'Daftar Komitmen';
		$page_heading = 'Daftar Komitmen';
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
		$commitments->tgl_end = $request->input('tgl_end');
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

		return redirect()->route('admin.task.commitments.index')->with('success', 'Data Commitment Saved successfully');
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

		$commitment = CommitmentBackdate::with('user', 'pksmitra.masterkelompok', 'penangkarmitra.masterpenangkar', 'pengajuanv2')
			->findOrFail($id);
		$masterkelompoks = MasterKelompok::all();
		$masterpenangkars = MasterPenangkar::all();
		$pengajuanv2 = Pengajuan::all();
		$pksmitras = $commitment->pksmitra;
		$penangkarmitras = $commitment->penangkarmitra;
		// dd();
		return view('v2.commitment.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'masterpenangkars', 'penangkarmitras', 'commitment', 'masterkelompoks', 'pksmitras', 'pengajuanv2'));
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
	 * Show the form in readonly the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function read($id)
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
		$page_heading = 'Data Commitment: ' . $commitments->no_ijin;
		$heading_class = 'fal fa-file-invoice';


		return view('v2.commitment.read', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'commitments', 'masterpenangkars', 'penangkarmitras'));
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
		$commitments->tgl_end = $request->input('tgl_end');
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

	public function createpengajuan($id, Request $request)
	{
		// Find commitment_backdate id
		$commitments = CommitmentBackdate::find($id);

		// Create no_pengajuan
		$last_no_pengajuan = PengajuanV2::whereYear('created_at', date('Y'))
			->whereMonth('created_at', date('m'))
			->whereDay('created_at', date('d'))
			->max('no_pengajuan');
		$no_pengajuan = date('Ymd') . sprintf('%03d', intval(substr($last_no_pengajuan, -3)) + 1);

		// Create status pengajuanv2
		$pengajuan = new PengajuanV2();
		$pengajuan->no_pengajuan = $no_pengajuan;
		$pengajuan->commitmentbackdate_id = $commitments->id;
		$pengajuan->status = '1';

		// Update commitment_backdate
		$commitments->status = '1';
		$commitments->no_pengajuan = $no_pengajuan;
		$commitments->pengajuan_id = $pengajuan->id;
		$fileInputs = [
			'formRiph',
			'formSptjm',
			'logbook',
			'formRt',
			'formRta',
			'formRpo',
			'formLa'
		];
		$commitment_id = $commitments->id;
		$folder_name = "commitmentsv2/$commitment_id";

		foreach ($fileInputs as $fileInput) {
			if ($request->hasFile($fileInput)) {
				$file = $request->file($fileInput);
				$file_name = $fileInput . '_' . $commitment_id . '_' . date('Ymd') . '_' . time() . '.' . $file->getClientOriginalExtension();
				Storage::disk('public')->putFileAs("docs/$folder_name", $file, $file_name);
				$commitments->$fileInput = $file_name;
			}
		}
		$commitments->save();
		$pengajuan->save();
		return redirect()->route('admin.task.commitments.show', $commitments->id)->with('success', 'Data Pengajuan submitted successfully');
	}

	public function pengajuanulang($id, Request $request)
	{
		// Find commitment_backdate id
		$commitment = CommitmentBackdate::find($id);

		// Update pengajuanv2 status
		$pengajuan = PengajuanV2::where('no_pengajuan', $request->input('no_pengajuan'))
			->where('commitmentbackdate_id', $id)
			->firstOrFail();
		$pengajuan->status = '6';
		$pengajuan->save();

		// Update commitment_backdate
		$commitment->status = '6';
		$fileInputs = [
			'formRiph',
			'formSptjm',
			'logbook',
			'formRt',
			'formRta',
			'formRpo',
			'formLa'
		];
		$commitment_id = $commitment->id;
		$folder_name = "commitmentsv2/$commitment_id";

		foreach ($fileInputs as $fileInput) {
			if ($request->hasFile($fileInput)) {
				$file = $request->file($fileInput);
				$file_name = $fileInput . '_' . $commitment_id . '_' . date('Ymd') . '_' . time() . '.' . $file->getClientOriginalExtension();
				Storage::disk('public')->putFileAs("docs/$folder_name", $file, $file_name);
				$commitment->$fileInput = $file_name;
			}
		}

		$commitment->save();

		return redirect()->route('admin.task.commitments.show', $commitment->id)->with('success', 'Data Pengajuan submitted successfully');
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
		$commitments->pengajuanv2()->delete(); //delete related object here
		$commitments->delete();
		return redirect()->route('admin.task.commitments.index')->with('success', 'Data Commitment deleted successfully');
	}
}
