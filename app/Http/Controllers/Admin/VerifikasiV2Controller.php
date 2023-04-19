<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanV2;
use App\Models\Commitmentbackdate;
use App\Models\verif_commitment;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifikasiV2Controller extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module_name = 'Permohonan';
		$page_title = 'Daftar Pengajuan';
		$page_heading = 'Verifikasi Backdate';
		$heading_class = 'fa fa-file-invoice';

		$verifikasis = PengajuanV2::all();

		return view('v2.verifikasi.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'verifikasis'));
	}


	public function onlinelist()
	{
		$module_name = 'Permohonan';
		$page_title = 'Pengajuan Verifikasi';
		$page_heading = 'Daftar Verifikasi Online';
		$heading_class = 'fa fa-file-search';

		$verifikasis = PengajuanV2::all();

		return view('v2.verifikasi.online.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'verifikasis'));
	}

	public function onlineCheck($id)
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Permohonan';
		$page_title = 'Verifikasi';
		$page_heading = 'Pemeriksaan Data Online';
		$heading_class = 'fal fa-ballot-check';

		$verifikasi = PengajuanV2::findOrFail($id);
		$commitments = CommitmentBackdate::where('id', $verifikasi->commitmentbackdate_id)->first();
		$verifCommitment = verif_commitment::where('pengajuan_id', $verifikasi->id)
			->where('commitmentbackdate_id', $verifikasi->commitmentbackdate_id)
			->first();
		// dd($verifCommitment);
		$total_luastanam = $commitments->pksmitra->flatMap(function ($pm) {
			return $pm->anggotamitras;
		})->sum('luas_tanam');

		$total_volume = $commitments->pksmitra->flatMap(function ($pm) {
			return $pm->anggotamitras;
		})->sum('volume');

		// dd($commitments);
		return view('v2.verifikasi.online.check', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'verifikasi', 'commitments', 'total_luastanam', 'total_volume', 'verifCommitment'));
	}

	public function update(Request $request, $id)
	{
		$user = Auth::user();
		$verifikasi = PengajuanV2::findOrFail($id);
		$commitment = CommitmentBackdate::where('id', $verifikasi->commitmentbackdate_id)->first();
		$verifCommitment = verif_commitment::where('pengajuan_id', $verifikasi->id)
			->where('commitmentbackdate_id', $verifikasi->commitmentbackdate_id)
			->first();
		switch ($request->input('form_action')) {
			case 'form1':
				//simpan update form pengajuanv2 status 2-3-4- dst
				break;
			default:
				//...
				break;
		}
		$verifCommitment->save();
		return redirect()->route('admin.task.verifikasiv2.online.check', $verifikasi->id)
			->with('success', 'Verifikasi dimulai');
	}

	public function verifcommitment($id)
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'Permohonan';
		$page_title = 'Pengajuan Verifikasi';
		$page_heading = 'Daftar Verifikasi Online';
		$heading_class = 'fa fa-file-search';

		$user = Auth::user();
		$verifCommitment = verif_commitment::findOrFail($id);
		$commitments = Commitmentbackdate::findOrFail($verifCommitment->commitmentbackdate_id);
		$verifikasi = PengajuanV2::where('id', $verifCommitment->pengajuan_id)
			->where('commitmentbackdate_id', $verifCommitment->commitmentbackdate_id)
			->findOrFail($verifCommitment->pengajuan_id);


		return view('v2.verifikasi.online.verifcommitment', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'verifCommitment', 'commitments', 'verifikasi'));
	}

	public function verifcommitmentupdate(Request $request, $id)
	{
		$user = Auth::user();
		$verifCommitment = verif_commitment::find($id);
		$verifCommitment->formRiph = $request->input('formRiph');
		$verifCommitment->formSptjm = $request->input('formSptjm');
		$verifCommitment->logbook = $request->input('logbook');
		$verifCommitment->formRt = $request->input('formRt');
		$verifCommitment->formRta = $request->input('formRta');
		$verifCommitment->formRpo = $request->input('formRpo');
		$verifCommitment->formLa = $request->input('formLa');
		$verifCommitment->formLa = $request->input('formLa');
		$verifCommitment->note = $request->input('note');
		$verifCommitment->status = '3'; //selesai
		$verifCommitment->verif_at = Carbon::now();
		$verifCommitment->verificator_id = $user->id;
		// dd($verifCommitment);
		$verifCommitment->save();
		return redirect()->route('admin.task.verifikasiv2.online.check', $verifCommitment->pengajuan_id)
			->with('success', 'Verifikasi komitmen sudah dilakukan');
	}
}
