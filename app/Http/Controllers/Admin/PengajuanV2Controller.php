<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\PengajuanV2;
use App\Models\CommitmentBackdate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanV2Controller extends Controller
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
		$pengajuans = PengajuanV2::whereHas('commitmentBackdate', function ($query) use ($user) {
			$query->where('user_id', $user->id);
		})->paginate(10);

		return view('v2.pengajuanv2.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'user', 'user', 'pengajuans'));
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
		$pengajuan = new PengajuanV2();
		// get current month and year as 2-digit and 4-digit strings
		$month = date('m');
		$year = date('Y');

		// retrieve the latest record for the current month and year
		$latestRecord = PengajuanV2::where('no_pengajuan', 'like', "%/{$month}/{$year}")
			->orderBy('created_at', 'desc')
			->first();

		// get the current increment value for n
		$n = 1;
		if ($latestRecord) {
			$parts = explode('/', $latestRecord->no_pengajuan);
			$n = intval($parts[0]) + 1;
		}

		// mask the n part to always have 3 digits
		$nMasked = str_pad($n, 3, '0', STR_PAD_LEFT);

		// generate the new no_pengajuan value with timestamp and masked n
		$no_pengajuan = "{$nMasked}/PV." . time() . "/simethris/{$month}/{$year}";
		$pengajuan->no_pengajuan = $no_pengajuan;
		$pengajuan->commitmentbackdate_id = $request->input('commitmentbackdate_id');
		$pengajuan->status = '1';
		// dd($pengajuan);
		$pengajuan->save();
		return redirect()->route('admin.task.commitments.show', $pengajuan->commitmentbackdate_id)
			->with('success', 'Permintaan Anda telah kami terima saved successfully');
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
		//
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
	}
}
