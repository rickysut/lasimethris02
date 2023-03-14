<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaMitra;
use App\Models\MasterKelompok;
use App\Models\MasterAnggota;
use App\Models\Commitmentbackdate;
use App\Models\PksMitra;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Switch_;

class AnggotaMitraController extends Controller
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
		//
		$anggotamitra = new AnggotaMitra();
		$anggotamitra->pks_mitra_id = $request->input('pks_mitra_id');
		$anggotamitra->commitmentbackdate_id = $request->input('commitmentbackdate_id');
		$anggotamitra->no_ijin = $request->input('no_ijin');
		$anggotamitra->master_anggota_id = $request->input('master_anggota_id');
		$anggotamitra->nama_lokasi = $request->input('nama_lokasi');
		// $anggotamitra->latitude = $request->input('latitude');
		// $anggotamitra->longitude = $request->input('longitude');
		// $anggotamitra->altitude = $request->input('altitude');
		// $anggotamitra->luas_kira = $request->input('luas_kira');
		// $anggotamitra->polygon = $request->input('polygon');
		// $anggotamitra->tgl_tanam = $request->input('tgl_tanam');
		// $anggotamitra->luas_tanam = $request->input('luas_tanam');
		// $anggotamitra->varietas = $request->input('varietas');
		// $anggotamitra->tgl_panen = $request->input('tgl_panen');
		// $anggotamitra->volume = $request->input('volume');
		// $anggotamitra->tanam_doc = $request->input('tanam_doc');
		// $anggotamitra->tanam_pict = $request->input('tanam_pict');
		// $anggotamitra->panen_doc = $request->input('panen_doc');
		// $anggotamitra->panen_pict = $request->input('panen_pict');
		// $anggotamitra->status = $request->input('status');

		// dd($anggotamitra);
		$anggotamitra->save();
		return redirect()->route('admin.task.pksmitra.show', $anggotamitra->pks_mitra_id)->with('success', 'Petani  saved successfully');
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
		$page_title = 'Realisasi';
		$page_heading = 'Laporan Realisasi';
		$heading_class = 'fal fa-farm';

		$commitment = CommitmentBackdate::with('pksmitra.anggotamitras')->findOrFail($id);
		$masterkelompok = MasterKelompok::findOrFail($id);
		$pksmitra = PksMitra::findOrFail($id);
		$masteranggotas = MasterAnggota::where('master_kelompok_id', $pksmitra->master_kelompok_id)->get();
		$anggotamitras = AnggotaMitra::findOrFail($id);
		return view('v2.commitment.anggotamitra.show', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'anggotamitras', 'commitment', 'masterkelompok', 'pksmitra', 'masteranggotas'));
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
		//
		$anggotamitra = AnggotaMitra::find($id);
		// $anggotamitra->pks_mitra_id = $request->input('pks_mitra_id');
		// $anggotamitra->commitmentbackdate_id = $request->input('commitmentbackdate_id');
		// $anggotamitra->no_ijin = $request->input('no_ijin');
		// $anggotamitra->master_anggota_id = $request->input('master_anggota_id');

		switch ($request->input('form_action')) {
			case 'form1':
				$anggotamitra->nama_lokasi = $request->input('nama_lokasi');
				$anggotamitra->latitude = $request->input('latitude');
				$anggotamitra->longitude = $request->input('longitude');
				$anggotamitra->altitude = $request->input('altitude');
				$anggotamitra->luas_kira = $request->input('luas_kira');
				$anggotamitra->polygon = $request->input('polygon');

				break;
			case 'form2':
				$anggotamitra->tgl_tanam = $request->input('tgl_tanam');
				$anggotamitra->luas_tanam = $request->input('luas_tanam');
				$anggotamitra->varietas = $request->input('varietas');
				break;

			case 'form3':
				$anggotamitra->tanam_doc = $request->input('tanam_doc');
				$anggotamitra->tanam_pict = $request->input('tanam_pict');
				break;

			case 'form4':
				$anggotamitra->tgl_panen = $request->input('tgl_panen');
				$anggotamitra->volume = $request->input('volume');
				break;

			case 'form5':
				$anggotamitra->panen_doc = $request->input('panen_doc');
				$anggotamitra->panen_pict = $request->input('panen_pict');
				break;

				//this line will execute by admin/verifikator only
			case 'form6':
				$anggotamitra->status = $request->input('status');
				break;
			default:
				//# code...
				break;
		}
		// dd($anggotamitra);
		$anggotamitra->save();

		return redirect()->route('admin.task.anggotamitra.show', $anggotamitra->id)
			->with('success', 'Petani  saved successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//find id of recorded data
		$anggotamitra = AnggotaMitra::find($id);

		//check if the status is not null
		if ($anggotamitra->status !== null) {
			//cancel and exit action without any change when request are true and redirects back
			return redirect()->route('admin.task.anggotamitra.show', $anggotamitra->id)
				->with('error', 'Cannot delete record ' . $anggotamitra->id . ' with a non-null status.');
		}

		//execute delete when request are false and redirects back
		$anggotamitra->delete();
		return redirect()->route('admin.task.anggotamitra.index')->with('success', 'Record ' . $anggotamitra->id . ' deleted successfully.');
	}
}
