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

	//posts categories
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
	});


	Route::resource('riphAdmin', 'RiphAdminController');

	//skl-admin
	Route::resource('skl', 'AdminSKLController');

	// landing
	Route::get('/', 'HomeController@index')->name('home');
	// Dashboard
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
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

	//posts
	Route::put('posts/{post}/restore', 'PostsController@restore')->name('posts.restore');
	Route::resource('posts', 'PostsController');
	Route::get('allblogs', 'PostsController@allblogs')->name('allblogs');
	Route::post('posts/{post}/star', 'StarredPostController@star')->name('posts.star');
	Route::delete('posts/{post}/unstar', 'StarredPostController@unstar')->name('posts.unstar');

	//posts categories
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

		// pengajuan
		Route::resource('pengajuan', 'PengajuanController');
		Route::delete('pengajuan/destroy', 'PengajuanController@massDestroy')->name('pengajuan.massDestroy');

		// kelompoktani
		Route::get('kelompoktani', 'KelompoktaniController@index')->name('kelompoktani');
		Route::get('kelompoktani/{noriph}/edit', 'KelompoktaniController@edit')->name('kelompoktani.edit');
		Route::get('kelompoktani/create', 'KelompoktaniController@create')->name('kelompoktani.create');
		Route::get('kelompoktani/{noriph}', 'KelompoktaniController@show')->name('kelompoktani.show');
		Route::delete('kelompoktanimd', 'KelompoktaniController@massDestroy')->name('kelompoktani.massDestroy');
		Route::get('petani/{id_poktan}', 'KelompoktaniController@showtani')->name('kelompoktani.showtani');

		// daftar pks
		Route::get('pks/create/{noriph}/{poktan}', 'PksController@create')->name('pks.create');
		Route::delete('pksmd', 'PksController@massDestroy')->name('pks.massDestroy');
		Route::resource('pks', 'PksController')->except(['create']);


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

		//pengajuan v2
		Route::get('commitments/{commitments}/createpengajuan', 'CommitmentBackdateController@createpengajuan')->name('commitments.createpengajuan');
		Route::get('commitments/{commitments}/viewpengajuan', 'CommitmentBackdateController@viewpengajuan')->name('commitments.viewpengajuan');
		Route::post('commitments/{commitments}/storepengajuan', 'CommitmentBackdateController@storepengajuan')->name('commitments.storepengajuan');
		Route::get('pengajuanv2/{pengajuan}/pengajuansuccess', 'CommitmentBackdateController@success')->name('commitments.pengajuansuccess');
		Route::put('commitments/{commitments}/pengajuanulang', 'CommitmentBackdateController@pengajuanulang')->name('commitments.pengajuanulang');
		Route::get('pengajuanv2', 'PengajuanV2Controller@index')->name('pengajuanv2.index');

		//verifikasi v2
		Route::get('verifikasiv2', 'VerifikasiV2Controller@onlinelist')->name('verifikasiv2');
		Route::get('verifikasiv2/{id}', 'VerifikasiV2Controller@onlinecheck')->name('verifikasiv2.online.check');
		Route::get('verifikasiv2/{id}/commitment', 'VerifikasiV2Controller@verifcommitment')->name('verifikasiv2.online.verifcommitment');
		Route::put('verifikasiv2/{id}/baonline', 'VerifikasiV2Controller@baonline')->name('verifikasiv2.online.baonline');

		//panggil id pks yang akan di periksa
		Route::get('verifikasiv2/{verifikasi}/commitment/{commitment}/pksmitra/{id}/check', 'VerifikasiV2Controller@pkscheck')->name('verifikasiv2.online.pks.check');

		//panggil id pks yang akan di ubah hasil periksa
		Route::get('verifikasiv2/verifpks/{id}/edit', 'VerifikasiV2Controller@pksedit')->name('verifikasiv2.online.pks.edit');

		//post new verifikasi pks
		Route::post('verifikasiv2/verifpks/store', 'VerifikasiV2Controller@pksstore')->name('verifikasiv2.online.pks.store');

		//update verifikasi pks
		Route::put('verifikasiv2/verifpks/{verifpks}/update', 'VerifikasiV2Controller@pksupdate')->name('verifikasiv2.online.pks.update');

		//verifikasi lokasi (online)
		Route::get('verifikasiv2/anggotamitra/{id}/check', 'VerifikasiV2Controller@locationcheck')->name('verifikasiv2.online.location.check');

		Route::post('verifikasiv2/location/store', 'VerifikasiV2Controller@locationstore')->name('verifikasiv2.online.location.store');
		Route::get('verifikasiv2/veriflokasi/{id}/edit', 'VerifikasiV2Controller@locationedit')->name('verifikasiv2.online.location.edit');
		Route::put('verifikasiv2/veriflokasi/{id}/update', 'VerifikasiV2Controller@locationupdate')->name('verifikasiv2.online.location.update');

		// verifikasi lokasi (onfarm)
		Route::get('onfarmv2', 'VerifikasiV2Controller@onfarm')->name('onfarmv2');
		Route::get('onfarmv2/{id}/list', 'VerifikasiV2Controller@onfarmlist')->name('onfarmv2.list');
		Route::get('onfarmv2/lokasi/{id}/check', 'VerifikasiV2Controller@onfarmcheck')->name('onfarmv2.check');

		Route::put('verifikasi/backdate/online/verifcommitmentupdate/{verifcommitment}', 'VerifikasiV2Controller@verifcommitmentupdate')->name('verifikasiv2.online.verifcommitmentupdate');

		Route::put('verifikasi/backdate/online/{verifikasi}/update', 'VerifikasiV2Controller@update')->name('verifikasiv2.online.update');

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
