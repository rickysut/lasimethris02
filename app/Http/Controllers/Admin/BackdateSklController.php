<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BackdateSkl;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BackdateSklController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'Backdate SKL';
		$page_title = 'Daftar SKL Lama';
		$page_heading = 'Data SKL Lama';
		$heading_class = 'fal fa-file-certificate';

		$skls = BackdateSkl::all();

		return view('admin.backdateskl.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'skls'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'Backdate SKL';
		$page_title = 'Rekam SKL Lama';
		$page_heading = 'Rekam SKL Lama';
		$heading_class = 'fal fa-file-certificate';

		return view('admin.backdateskl.create', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden, You do not have permission to perform this action!');

		$skl = new BackdateSkl();
		$skl->no_skl = $request->input('no_skl');
		$skl->no_ijin = $request->input('no_ijin');
		$skl->periode = $request->input('periode');
		$fileskl = str_replace(['.', '/', '-'], '', $request->input('no_skl'));
		$noijin = str_replace(['.', '/'], '', $request->input('no_ijin'));
		if ($request->hasFile('berkas_skl')) {
			$file = $request->file('berkas_skl');
			$filename = 'skl_' . $fileskl . '_' . $noijin . '.' . $file->getClientOriginalExtension();
			$file->storeAs('arsip/backdateskl/', $filename, 'public');
			$skl->berkas_skl = $filename;
		}
		if ($request->hasFile('berkas_dukung')) {
			$file = $request->file('berkas_skl');
			$filename = 'dataduk_' . $fileskl . '_' . $noijin . '.' . $file->getClientOriginalExtension();
			$file->storeAs('arsip/backdateskl/', $filename, 'public');
			$skl->berkas_dukung = $filename;
		}
		// dd($skl);
		$skl->save();

		return redirect()->route('admin.backdateskl')->with('success', 'Data SKL Lama berhasil ditambahkan');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		dd('show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden, You do not have permission to perform this action!');

		$module_name = 'SKL';
		$page_title = 'Ubah Rekam Data';
		$page_heading = 'Ubah Rekam SKL Lama';
		$heading_class = 'fal fa-file-certificate';

		$skl = BackdateSkl::findOrFail($id);

		return view('admin.backdateskl.edit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'skl'));
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
		abort_if(Auth::user()->roleaccess != 1, Response::HTTP_FORBIDDEN, '403 Forbidden, You do not have permission to perform this action!');

		$skl = BackdateSkl::findOrFail($id);
		$skl->no_skl = $request->input('no_skl');
		$skl->no_ijin = $request->input('no_ijin');
		$skl->periode = $request->input('periode');
		$fileskl = str_replace(['.', '/', '-'], '', $request->input('no_skl'));
		$noijin = str_replace(['.', '/'], '', $request->input('no_ijin'));
		if ($request->hasFile('berkas_skl')) {
			$file = $request->file('berkas_skl');
			$filename = 'skl_' . $fileskl . '_' . $noijin . '.' . $file->getClientOriginalExtension();
			$file->storeAs('arsip/backdateskl/', $filename, 'public');
			$skl->berkas_skl = $filename;
		}
		if ($request->hasFile('berkas_dukung')) {
			$file = $request->file('berkas_skl');
			$filename = 'dataduk_' . $fileskl . '_' . $noijin . '.' . $file->getClientOriginalExtension();
			$file->storeAs('arsip/backdateskl/', $filename, 'public');
			$skl->berkas_dukung = $filename;
		}
		// dd($skl);
		$skl->save();

		return redirect()->route('admin.backdateskl')->with('success', 'Data SKL Lama berhasil diperbarui');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		dd('destroy');
	}
}
