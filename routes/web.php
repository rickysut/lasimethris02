<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
	return redirect()->route('login');
});

Route::get('/v2/register', function () {
	return view('v2register');
});

Route::get('/home', function () {
	if (session('status')) {
		return redirect()->route('admin.home')->with('status', session('status'));
	}

	return redirect()->route('admin.home');
});


Auth::routes(['register' => true]); // menghidupkan registration


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

	// landing
	Route::get('/', 'HomeController@index')->name('home');
	// Dashboard
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('/dashboard/monitoring', 'DashboardController@monitoring')->name('dashboard.monitoring');
	Route::get('/dashboard/map', 'DashboardController@map')->name('dashboard.map');
	// Permissions
	Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
	Route::resource('permissions', 'PermissionsController');

	// Roles
	Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
	Route::resource('roles', 'RolesController');

	// Users
	Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
	Route::resource('users', 'UsersController');

	// Audit Logs
	Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

	Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');

	Route::get('profile', 'ProfileController@index')->name('profile.show');
	Route::post('profile', 'ProfileController@store')->name('profile.store');
	Route::post('profile/{id}', 'ProfileController@update')->name('profile.update');

	//posts
	Route::put('posts/{post}/restore', 'PostsController@restore')->name('posts.restore');
	Route::resource('posts', 'PostsController');
	Route::get('allblogs', 'PostsController@allblogs')->name('allblogs');
	Route::post('posts/{post}/star', 'StarredPostController@star')->name('posts.star');
	Route::delete('posts/{post}/unstar', 'StarredPostController@unstar')->name('posts.unstar');

	//categories
	Route::resource('categories', 'CategoryController');

	//messenger
	Route::get('messenger', 'MessengerController@index')->name('messenger.index');
	Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
	Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
	Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
	Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
	Route::post('messenger/{topic}/update', 'MessengerController@updateTopic')->name('messenger.updateTopic');
	Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
	Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
	Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
	Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');

	//verifikasi
	Route::get('dir_check_b', 'MessengerController@showReply')->name('verifikasi.dir_check_b');
	Route::get('dir_check_c', 'MessengerController@showReply')->name('verifikasi.dir_check_c');

	//user task
	Route::group(['prefix' => 'task', 'as' => 'task.'], function () {

		Route::get('pull', 'PullRiphController@index')->name('pull');
		Route::get('getriph', 'PullRiphController@pull')->name('pull.getriph');
		Route::post('pull', 'PullRiphController@store')->name('pull.store');

		Route::get('commitment', 'CommitmentController@index')->name('commitment');
		Route::get('commitment/{pullriph}', 'CommitmentController@show')->name('commitment.show');
		Route::delete('commitment/{pullriph}', 'CommitmentController@destroy')->name('commitment.destroy');
		Route::post('commitment/unggah', 'CommitmentController@store')->name('commitment.store');
		Route::delete('commitmentmd', 'CommitmentController@massDestroy')->name('commitment.massDestroy');

		// kelompoktani
		Route::get('kelompoktani', 'KelompoktaniController@index')->name('kelompoktani');
		Route::get('kelompoktani/{noriph}/edit', 'KelompoktaniController@edit')->name('kelompoktani.edit');
		Route::get('kelompoktani/create', 'KelompoktaniController@create')->name('kelompoktani.create');
		Route::get('kelompoktani/{noriph}', 'KelompoktaniController@show')->name('kelompoktani.show');
		Route::delete('kelompoktanimd', 'KelompoktaniController@massDestroy')->name('kelompoktani.massDestroy');

		// pengajuan
		Route::resource('pengajuan', 'PengajuanController');
		Route::delete('pengajuan/destroy', 'PengajuanController@massDestroy')->name('pengajuan.massDestroy');

		// daftar pks
		Route::resource('pks', 'PksController');
		Route::delete('pksmd', 'PksController@massDestroy')->name('pks.massDestroy');

		Route::resource('skl', 'SklController');

		//berkas
		Route::get('berkas', 'BerkasController@indexberkas')->name('berkas');

		//galeri
		Route::get('galeri', 'BerkasController@indexgaleri')->name('galeri');

		//template
		Route::delete('template/destroy', 'BerkasController@massDestroy')->name('template.massDestroy');
		Route::get('template/create', 'BerkasController@createtemplate')->name('template.create');
		Route::delete('template/{id}', 'BerkasController@destroytemplate')->name('template.destroy');
		Route::post('template', 'BerkasController@storetemplate')->name('template.store');
		//Route::get('template/{berkas}', 'BerkasController@showtemplate')->name('template.show');
		Route::get('template/{berkas}/edit', 'BerkasController@edittemplate')->name('template.edit');
		Route::put('template/{berkas}', 'BerkasController@updatetemplate')->name('template.update');
		Route::get('template', 'BerkasController@indextemplate')->name('template');
	
	
		//route for backdate (v2)
		//commitment (v2)
		Route::resource('commitments', 'CommitmentBackdateController');
		Route::get('commitments/{commitments}/penangkar', 'CommitmentBackdateController@penangkar')->name('commitments.penangkar');
		Route::get('commitments/{commitments}/read', 'CommitmentBackdateController@read')->name('commitments.read');
		Route::get('commitments/{commitments}/pksmitra', 'CommitmentBackdateController@pksmitra')->name('commitments.pksmitra');

		//pks mitra v2
		Route::resource('pksmitra', 'PksMitraController');

		//route for penangkar mitra v2
		Route::get('/penangkarmitra/{penangkarmitra}', 'PenangkarMitraController@show')->name('penangkarmitra.show');
		Route::post('/penangkarmitra/store', 'PenangkarMitraController@store')->name('penangkarmitra.store');
		Route::put('/penangkarmitra/{penangkarmitra}', 'PenangkarMitraController@update')->name('penangkarmitra.update');
		Route::delete('/penangkarmitra/{penangkarmitra}', 'PenangkarMitraController@destroy')->name('penangkarmitra.destroy');

		//anggota mitra pks v2
		Route::get('/anggotamitra', 'AnggotaMitraController@index')->name('anggotamitra');
		Route::get('/anggotamitra/{anggotamitra}', 'AnggotaMitraController@show')->name('anggotamitra.show');
		Route::post('/anggotamitra/store', 'AnggotaMitraController@store')->name('anggotamitra.store');
		Route::put('/anggotamitra/{anggotamitra}/update', 'AnggotaMitraController@update')->name('anggotamitra.update');
		Route::delete('/anggotamitra/{anggotamitra}', 'AnggotaMitraController@destroy')->name('anggotamitra.destroy');

		//master kelompok tani v2
		Route::resource('masterpoktan', 'MasterKelompokController');
		Route::get('masterpoktan/{masterpoktan}/list_anggota', 'MasterKelompokController@listanggota')->name('masterpoktan.listanggota');
		Route::get('masterpoktan/{masterpoktan}/addanggota', 'AnggotaPoktanController@addanggota')->name('masterpoktan.addanggota');

		//Master Anggota kelompok
		Route::resource('anggotapoktan', 'AnggotaPoktanController');

		//Master Penangkar
		Route::resource('masterpenangkar', 'MasterPenangkarController');
		// Route::get('masterpoktan', 'MasterpoktanController@index')->name('masterpoktan');

		//pengajuan v2
		Route::get('commitment/{commitment}/submission/create', 'PengajuanV2Controller@create')->name('submission.create');
		Route::post('commitment/{commitment}/submission/store', 'PengajuanV2Controller@store')->name('submission.store');
		Route::get('submission/{pengajuan}/success', 'PengajuanV2Controller@success')->name('submission.success');
		Route::get('submission/{pengajuan}/view', 'PengajuanV2Controller@show')->name('submission.show');

		//Sisi pelaku usaha, hanya menampilkan list miliknya
		Route::get('submission', 'PengajuanV2Controller@index')->name('submission');

		//sisi admin/verifikator, menampilkan semua pengajuan yang akan di verifikasi
		Route::get('onlinev2', 'OnlineV2Controller@index')->name('onlinev2');

		//verifikasi v2
		Route::get('onlinev2/{id}', 'OnlineV2Controller@check')->name('onlinev2.check');
		Route::get('onlinev2/{id}/show', 'OnlineV2Controller@show')->name('onlinev2.show');
		Route::get('onlinev2/{id}/commitment', 'OnlineV2Controller@commitment')->name('onlinev2.commitment');

		//update verif_commitment
		Route::put('onlinev2/commitment/{id}/update', 'OnlineV2Controller@commitmentsave')->name('onlinev2.commitmentsave');

		Route::put('onlinev2/{id}/baonline', 'OnlineV2Controller@baonline')->name('onlinev2.baonline');

		//panggil id pks yang akan di periksa
		Route::get('onlinev2/{verifikasi}/commitment/{commitment}/pksmitra/{id}/check', 'OnlineV2Controller@pkscheck')->name('onlinev2.pks.check');

		//panggil id pks yang akan di ubah hasil periksa
		Route::get('onlinev2/verifpks/{id}/edit', 'OnlineV2Controller@pksedit')->name('onlinev2.pks.edit');

		//post new verifikasi pks
		Route::post('onlinev2/verifpks/store', 'OnlineV2Controller@pksstore')->name('onlinev2.pks.store');

		//update verifikasi pks
		Route::put('onlinev2/verifpks/{verifpks}/update', 'OnlineV2Controller@pksupdate')->name('onlinev2.pks.update');

		//verifikasi lokasi (online)
		Route::get('onlinev2/anggotamitra/{id}/verifikasi', 'OnlineV2Controller@locationcheck')->name('onlinev2.location.check');

		Route::post('onlinev2/location/store', 'OnlineV2Controller@locationstore')->name('onlinev2.location.store');
		Route::get('onlinev2/veriflokasi/{id}/edit', 'OnlineV2Controller@locationedit')->name('onlinev2.location.edit');
		Route::put('onlinev2/veriflokasi/{id}/update', 'OnlineV2Controller@locationupdate')->name('onlinev2.location.update');

		// verifikasi lokasi (onfarm)
		Route::get('onfarmv2', 'OnfarmV2Controller@index')->name('onfarmv2');
		Route::get('onfarmv2/{id}/list', 'OnfarmV2Controller@list')->name('onfarmv2.list');
		Route::get('onfarmv2/lokasi/{id}/verifikasi', 'OnfarmV2Controller@check')->name('onfarmv2.check');
		Route::put('onfarmv2/lokasi/{id}/update', 'OnfarmV2Controller@update')->name('onfarmv2.update');
		Route::get('onfarmv2/lokasi/{id}/show', 'OnfarmV2Controller@show')->name('onfarmv2.show');
		Route::put('onfarmv2/{id}/baonfarm', 'OnfarmV2Controller@baonfarm')->name('onfarmv2.baonfarm');

		//SKL V2
		Route::get('sklv2', 'SklV2Controller@index')->name('sklv2'); //untuk administrator
		Route::get('sklv2/list', 'SklV2Controller@list')->name('sklv2.list'); //daftar SKL untuk importir
		Route::get('sklv2/commitment/{id}/create', 'SklV2Controller@create')->name('sklv2.create');
		Route::post('pengajuanv2/{id}/skl/store', 'SklV2Controller@store')->name('sklv2.store');
		Route::get('sklv2/{id}/verifikasi', 'SklV2Controller@verifikasi')->name('sklv2.verifikasi');
		Route::get('sklv2/{id}/edit', 'SklV2Controller@edit')->name('sklv2.edit');
		Route::put('sklv2/{id}/update', 'SklV2Controller@update')->name('sklv2.update');
		Route::get('sklv2/{id}/show', 'SklV2Controller@show')->name('sklv2.show');
	});



	Route::resource('riphAdmin', 'RiphAdminController');

	//skl-admin
	Route::resource('skl', 'AdminSKLController');
});

Route::group(['prefix' => 'verification', 'as' => 'verification.', 'namespace' => 'Verifikator', 'middleware' => ['auth']], function () {
	Route::resource('onfarm', 'OnfarmController');
	Route::resource('online', 'OnlineController');
	Route::resource('completed', 'CompletedController');
	//Route::resource('skl', 'SklController' );   
});


Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {

	// Change password
	if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
		Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
		Route::post('password', 'ChangePasswordController@update')->name('password.update');
		Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
		Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
	}
});
