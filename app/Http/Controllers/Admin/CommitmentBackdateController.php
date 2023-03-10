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
		$commitments = CommitmentBackdate::withTrashed()->findOrFail($id);
		// $commitments->childrelatedmodel()->delete(); //delete related object here
		$commitments->delete();
	}
}
