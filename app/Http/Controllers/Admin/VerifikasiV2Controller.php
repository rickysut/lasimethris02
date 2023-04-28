<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaMitra;
use App\Models\PengajuanV2;
use App\Models\Commitmentbackdate;
use App\Models\PksMitra;
use App\Models\verif_commitment;
use App\Models\verif_pksmitra;
use App\Models\verif_lokasi;
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
	}

	public function onlinelist()
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Permohonan';
		$page_title = 'Pengajuan Verifikasi';
		$page_heading = 'Daftar Pengajuan Verifikasi Data';
		$heading_class = 'fa fa-file-search';

		$pengajuans = PengajuanV2::where('jenis', 'Verifikasi')->get();

		return view('v2.verifikasi.online.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'pengajuans'));
	}

	public function onlineCheck($id)
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Permohonan';
		$page_title = 'Verifikasi Data';
		$page_heading = 'Data-data Verifikasi';
		$heading_class = 'fal fa-ballot-check';

		$verifikasi = PengajuanV2::findOrFail($id);
		$verifcommit = verif_commitment::where('pengajuan_id', $verifikasi->id)->first();
		$verifpksmitras = verif_pksmitra::where('pengajuan_id', $verifikasi->id)->get();
		$veriflokasis = verif_lokasi::where('pengajuan_id', $verifikasi->id)->get();

		$commitment = CommitmentBackdate::find($verifikasi->commitmentbackdate_id);
		$pksmitras = PksMitra::where('commitmentbackdate_id', $commitment->id)->get();
		$anggotamitras = collect(); // create an empty collection
		foreach ($verifpksmitras as $verifpksmitra) {
			$anggotamitra = AnggotaMitra::where('pks_mitra_id', $verifpksmitra->pksmitra_id)
				->where('commitmentbackdate_id', $verifcommit->commitmentbackdate_id)
				->get();
			$anggotamitras->push($anggotamitra); // add the results to the collection
		};
		$total_luastanam = $commitment->pksmitra->flatMap(function ($pm) {
			return $pm->anggotamitras;
		})->sum('luas_tanam');

		$total_volume = $commitment->pksmitra->flatMap(function ($pm) {
			return $pm->anggotamitras;
		})->sum('volume');



		return view('v2.verifikasi.online.check', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'verifikasi', 'verifcommit', 'verifpksmitras', 'veriflokasis', 'commitment', 'pksmitras', 'anggotamitras', 'total_luastanam', 'total_volume'));
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

		$module_name = 'Verifikasi';
		$page_title = 'Verifikasi Data';
		$page_heading = 'Berkas Komitmen';
		$heading_class = 'fal fa-file-search';

		$user = Auth::user();
		$verifcommit = verif_commitment::findOrFail($id);
		$commitment = Commitmentbackdate::findOrFail($verifcommit->pengajuanv2->commitmentbackdate_id);

		return view('v2.verifikasi.online.verifcommitment', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'verifcommit', 'commitment'));
	}

	public function verifcommitmentupdate(Request $request, $id)
	{
		$user = Auth::user();
		$verifcommit = verif_commitment::find($id);
		$verifcommit->formRiph = $request->input('formRiph');
		$verifcommit->formSptjm = $request->input('formSptjm');
		$verifcommit->logbook = $request->input('logbook');
		$verifcommit->formRt = $request->input('formRt');
		$verifcommit->formRta = $request->input('formRta');
		$verifcommit->formRpo = $request->input('formRpo');
		$verifcommit->formLa = $request->input('formLa');
		$verifcommit->formLa = $request->input('formLa');
		$verifcommit->note = $request->input('note');
		$verifcommit->status = '3'; //selesai
		$verifcommit->verif_at = Carbon::now();
		$verifcommit->verificator_id = $user->id;
		$verifcommit->save();
		return redirect()->route('admin.task.verifikasiv2.online.check', $verifcommit->pengajuan_id)
			->with('success', 'Hasil pemeriksaan/verifikasi data Komitmen berhasil disimpan. Lanjutkan pemeriksaan/verifikasi data PKS/Perjanjian Kerjasama.');
	}

	public function pkscheck($verifikasi, $commitment, $id)
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'Verifikasi';
		$page_title = 'Verifikasi Data';
		$page_heading = 'Data dan Berkas PKS';
		$heading_class = 'fal fa-ballot-check';

		//get single pks to retrieve the data
		$pksmitra = PksMitra::findOrFail($id);

		//get single commitment to retrieve commitment data
		$commitment = CommitmentBackdate::find($pksmitra->commitmentbackdate_id);

		//get single $verifikasi id by previouse line for verifpks
		$verifikasi = PengajuanV2::where('commitmentbackdate_id', $commitment->id)
			->latest()
			->first();

		//get single verif_commitment data to retrive commitment id for $verifikasi & verifpks
		$verifcommit = verif_commitment::where('pengajuan_id', $verifikasi->id)
			->first();

		//get verifpks to retrieve data to be used in blade
		$verifpks = verif_pksmitra::where('pengajuan_id', $verifikasi->id)
			->where('verifcommit_id', $verifcommit->id)
			->first();

		return view('v2.verifikasi.online.pkscheck', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'pksmitra', 'commitment', 'verifikasi', 'verifpks', 'verifcommit'));
	}

	public function pksstore(Request $request)
	{
		$user = Auth::user();
		$verifpks = new verif_pksmitra();
		$verifpks->pengajuan_id = $request->input('pengajuan_id');
		$verifpks->verifcommit_id = $request->input('verifcommit_id');
		$verifpks->pksmitra_id = $request->input('pksmitra_id');
		$verifpks->docstatus = $request->input('docstatus');
		$verifpks->status = $request->input('status');
		$verifpks->note = $request->input('note');
		$verifpks->verificator_id = $user->id;
		$verifpks->verif_at = Carbon::now();
		// dd($verifpks);
		$verifpks->save();

		return redirect()->route('admin.task.verifikasiv2.online.check', $verifpks->pengajuan_id)
			->with('success', 'Hasil Pemeriksaan PKS Kemitraan berhasil disimpan. Lanjutkan pemeriksaan PKS lainnya, atau lakukan pemeriksaan/verifikasi data lokasi tanam dan hasil produksi.');
	}

	public function pksedit($id)
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

		$module_name = 'Verifikasi';
		$page_title = 'Verifikasi PKS';
		$page_heading = 'Ubah Data Pemeriksaan';
		$heading_class = 'fal fa-ballot-check';

		$verifpks = verif_pksmitra::findOrFail($id);
		// //get single pks to retrieve the data based on verifpks
		$pksmitra = PksMitra::find($verifpks->pksmitra_id);
		// //get single commitment to retrieve commitment data based on pksmitra
		$commitment = CommitmentBackdate::find($pksmitra->commitmentbackdate_id);
		// //get single verif_commitment data to retrive commitment id based on commitment
		$verifcommitment = verif_commitment::find($verifpks->commitmentbackdate_id);
		// //get single $verifikasi id by previouse line for verifpks basedon verifcommitment
		$verifikasi = PengajuanV2::find($verifcommitment->pengajuan_id);

		dd($verifikasi);

		return view('v2.verifikasi.online.pksedit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'verifpks'));
	}

	public function pksupdate(Request $request, $id)
	{
		$user = Auth::user();
		$verifpks = verif_pksmitra::findOrFail($id);
		$verifpks->docstatus = $request->input('docstatus');
		$verifpks->status = $request->input('status');
		$verifpks->note = $request->input('note');
		$verifpks->verificator_id = $user->id;
		$verifpks->verif_at = Carbon::now();
		// dd($verifpks);
		$verifpks->save();

		return redirect()->route('admin.task.verifikasiv2.online.check', [$verifpks->pengajuan_id, $verifpks->commitmentbackdate_id])
			->with('success', 'Hasil Pemeriksaan PKS Kemitraan berhasil diubah.');
	}

	public function locationcheck($id)
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Verifikasi';
		$page_title = 'Verifikasi Data Lokasi';
		$page_heading = 'Pemeriksaan Data Tanam dan Produksi';
		$heading_class = 'fal fa-ballot-check';

		$anggotamitra = AnggotaMitra::findOrFail($id);

		//id pksmitra dari anggotamitra tersebut
		$pksmitra = PksMitra::find($anggotamitra->pks_mitra_id);

		//id commitmentbackdate dari anggotamitra tersebut
		$commitment = CommitmentBackdate::find($pksmitra->commitmentbackdate_id);

		//id pengajuan dari commitmentbackdate dari anggotamitra tersebut
		$verifikasi = PengajuanV2::where('commitmentbackdate_id', $commitment->id)
			->latest()
			->first();

		//id verifikasi commitment dari anggotamitra tersebut
		$verifcommit = verif_commitment::where('pengajuan_id', $verifikasi->id)
			->where('commitmentbackdate_id', $verifikasi->commitmentbackdate_id)
			->latest()
			->first();

		$verifpks = verif_pksmitra::where('pengajuan_id', $verifikasi->id)
			->where('verifcommit_id', $verifcommit->id)
			->where('pksmitra_id', $pksmitra->id)
			->first();

		return view('v2.verifikasi.online.locationcheck', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'pksmitra', 'commitment', 'verifikasi', 'verifcommit', 'verifpks', 'anggotamitra'));
	}

	public function locationedit($id)
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Verifikasi';
		$page_title = 'Verifikasi Data Lokasi';
		$page_heading = 'Pemeriksaan Data Tanam dan Produksi';
		$heading_class = 'fal fa-ballot-check';

		$veriflokasi = verif_lokasi::findOrFail($id);
		$anggotamitra = AnggotaMitra::find($veriflokasi->anggotamitra_id);
		$pksmitra = PksMitra::find($veriflokasi->pksmitra_id);
		$commitment = CommitmentBackdate::find($veriflokasi->verifcommit->commitmentbackdate_id);
		$verifcommitment = verif_commitment::find($veriflokasi->pengajuan_id);
		$verifikasi = PengajuanV2::find($verifcommitment->pengajuan_id);
		$verifpks = verif_pksmitra::where('pengajuan_id', $verifikasi->id)
			->where('verifcommit_id', $verifcommitment->id)
			->where('pksmitra_id', $id)
			->first();
		// dd($veriflokasi);
		return view('v2.verifikasi.online.locationedit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'pksmitra', 'commitment', 'verifikasi', 'verifpks', 'veriflokasi', 'anggotamitra'));
	}

	public function locationstore(Request $request)
	{
		$user = Auth::user();
		//case new
		$veriflokasi = new verif_lokasi();
		$veriflokasi->pengajuan_id = $request->input('pengajuan_id');
		$veriflokasi->verifcommit_id = $request->input('verifcommit_id');
		$veriflokasi->verifpks_id = $request->input('verifpks_id');
		$veriflokasi->anggotamitra_id = $request->input('anggotamitra_id');
		// $veriflokasi->markerstatus = $request->input('markerstatus');
		// $veriflokasi->polygonstatus = $request->input('polygonstatus');
		$veriflokasi->datastatus = $request->input('datastatus');
		$veriflokasi->onlinestatus = $request->input('onlinestatus');
		$veriflokasi->onlinenote = $request->input('onlinenote');
		$veriflokasi->onlineverif_at = Carbon::now();
		$veriflokasi->onlineverificator_id = $user->id;

		$veriflokasi->save();
		return redirect()->route('admin.task.verifikasiv2.online.check', [$veriflokasi->pengajuan_id, $veriflokasi->commitmentbackdate_id])
			->with('success', 'Hasil pemeriksaan data lokasi tanam dan Produksi berhasil disimpan. Pemeriksaan lapangan (onfarm) sudah dapat dilakukan. Lanjutkan pemeriksaan online data lokasi lainnya.');
	}

	public function locationupdate(Request $request, $id)
	{
		$user = Auth::user();

		$veriflokasi = verif_lokasi::findOrFail($id);
		// $veriflokasi->markerstatus = $request->input('markerstatus');
		// $veriflokasi->polygonstatus = $request->input('polygonstatus');
		$veriflokasi->datastatus = $request->input('datastatus');
		$veriflokasi->onlinestatus = $request->input('onlinestatus');
		$veriflokasi->onlinenote = $request->input('onlinenote');
		$veriflokasi->onlineverif_at = Carbon::now();
		$veriflokasi->onlineverificator_id = $user->id;

		$veriflokasi->save();
		return redirect()->route('admin.task.verifikasiv2.online.check', [$veriflokasi->pengajuan_id, $veriflokasi->commitmentbackdate_id])
			->with('success', 'Data pemeriksaan data lokasi tanam dan Produksi berhasil diubah.');
	}

	//onfarm section
	public function onfarm()
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Permohonan';
		$page_title = 'Pengajuan Verifikasi';
		$page_heading = 'Daftar Verifikasi';
		$heading_class = 'fal fa-file-search';

		$verifikasis = PengajuanV2::all();

		return view('v2.verifikasi.onfarm.index', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'verifikasis'));
	}

	public function onfarmlist($id)
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Permohonan';
		$page_title = 'Pengajuan Verifikasi';
		$page_heading = 'Daftar Verifikasi Lapangan';
		$heading_class = 'fal fa-map-marker';

		$verifikasi = PengajuanV2::findOrFail($id);
		$onfarms = verif_lokasi::where('pengajuan_id', $id)->get();


		return view('v2.verifikasi.onfarm.list', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'verifikasi', 'onfarms'));
	}



	public function onfarmcheck($id)
	{
		abort_if(Gate::denies('online_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$module_name = 'Verifikasi';
		$page_title = 'Verifikasi Data Lokasi';
		$page_heading = 'Pemeriksaan Data Tanam dan Produksi';
		$heading_class = 'fal fa-ballot-check';

		$veriflokasi = verif_lokasi::findOrFail($id);

		return view('v2.verifikasi.online.locationedit', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'veriflokasi'));
	}

	public function onfarmupdate(Request $request, $id)
	{
		$user = Auth::user();
		$veriflokasi = verif_lokasi::findOrFail($id);
		$veriflokasi->latitude = $request->input('latitude');
		$veriflokasi->longitude = $request->input('longitude');
		$veriflokasi->altitude = $request->input('altitude');
		$veriflokasi->polygon = $request->input('polygon');
		$veriflokasi->luas_verif = $request->input('luas_verif');
		$veriflokasi->tgl_ukur = $request->input('tgl_ukur');
		$veriflokasi->volume_verif = $request->input('volume_verif');
		$veriflokasi->tgl_timbang = $request->input('tgl_timbang');
		$veriflokasi->onfarmstatus = $request->input('onfarmstatus');
		$veriflokasi->onfarmnote = $request->input('onlinenote');
		$veriflokasi->onfarmverif_at = Carbon::now();
		$veriflokasi->onfarmverificator_id = $user->id;

		$veriflokasi->save();
		return redirect()->route('admin.task.verifikasiv2.online.check', $veriflokasi->pengajuan_id)
			->with('success', 'Pemeriksaan Lapangan lokasi tanam dan Produksi berhasil disimpan/diubah/perbarui.');
	}
}
