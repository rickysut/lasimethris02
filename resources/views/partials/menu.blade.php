<aside class="page-sidebar">
	<div class="page-logo">
		<a href="/admin" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
			<img src="{{ asset('img/favicon.png') }}" alt="Simethris" aria-roledescription="logo">
			<img src="{{ asset('img/logo-icon.png') }}" class="page-logo-text mr-1" alt="Simethris"
				aria-roledescription="logo" style="width:50px; height:auto;">

		</a>

	</div>

	<!-- BEGIN PRIMARY NAVIGATION -->
	<nav id="js-primary-nav" class="primary-nav" role="navigation">

		{{-- search menu --}}
		<div class="nav-filter">
			<div class="position-relative">
				<input type="text" id="nav_filter_input" placeholder="Cari menu" class="form-control" tabindex="0">
				<a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
					data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
					<i class="fal fa-chevron-up"></i>
				</a>
			</div>
		</div>

		{{-- picture --}}
		<div class="info-card">
			@if (!empty(Auth::user()::find(Auth::user()->id)->data_user->avatar))
				<img src="{{ Storage::disk('public')->url(Auth::user()::find(Auth::user()->id)->data_user->avatar) }}"
					class="profile-image rounded-circle" alt="">
			@else
				<img src="{{ asset('/img/avatars/farmer.png') }}" class="profile-image rounded-circle" alt="">
			@endif

			<div class="info-card-text">
				<a href="#" class="d-flex align-items-center text-white">
					<span class="text-truncate text-truncate-sm d-inline-block">
						{{ Auth::user()->username }}
					</span>
				</a>

				<span
					class="d-inline-block text-truncate text-truncate-sm">{{ Auth::user()::find(Auth::user()->id)->data_user->company_name ?? 'user' }}</span>
			</div>
			<img src="{{ asset('/img/card-backgrounds/cover-2-lg.png') }}" class="cover" alt="cover">
			<a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
				data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
				<i class="fal fa-angle-down"></i>
			</a>
		</div>


		<ul id="js-nav-menu" class="nav-menu">

			{{-- landing / beranda --}}
			@can('landing_access')
				<li class="c-sidebar-nav-item {{ request()->is('admin') ? 'active' : '' }}">
					<a href="{{ route('admin.home') }}" class="c-sidebar-nav-link"
						data-filter-tags="home beranda landing informasi berita pesan">
						<i class="c-sidebar-nav-icon fal fa-home-alt">
						</i>
						<span class="nav-link-text">{{ trans('cruds.landing.title_lang') }}</span>
					</a>
				</li>
			@endcan

			{{-- dashhboard --}}
			@can('dashboard_access')
				@if (Auth::user()->roles[0]->title == 'User' || Auth::user()->roles[0]->title == 'user_v2')
					<li class="{{ request()->is('admin/dashboard*') ? 'active open' : '' }} ">
						<a href="#" title="Dashboard" data-filter-tags="dashboard pemantauan kinerja">
							<i class="fal fa-analytics"></i>
							<span class="nav-link-text">{{ trans('cruds.dashboard.title_lang') }}</span>
						</a>
						<ul>
							<li class="c-sidebar-nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
								<a href="{{ route('admin.dashboard') }}" title="Dashboard Data Monitor"
									data-filter-tags="dashboard data monitor kinerja">
									<i class="fa-fw fal fa-database c-sidebar-nav-icon"></i>
									<span class="nav-link-text">{{ trans('cruds.dashboardUser.title_lang') }}</span>
								</a>
							</li>
							<li class="c-sidebar-nav-item {{ request()->is('admin/dashboard/map') ? 'active' : '' }}">
								<a href="{{ route('admin.dashboard.map') }}" title="Peta Wajib Tanam"
									data-filter-tags="dashboard peta pemetaan wajib tanam">
									<i class="fa-fw fal fa-map c-sidebar-nav-icon"></i>
									<span class="nav-link-text">Peta Wajib Tanam</span>
								</a>
							</li>
						</ul>
					</li>
				@elseif (Auth::user()->roles[0]->title == 'Admin')
					<li class="{{ request()->is('admin/dashboard*') ? 'active open' : '' }} ">
						<a href="#" title="Dashboard" data-filter-tags="dashboard pemantauan kinerja">
							<i class="fal fa-analytics"></i>
							<span class="nav-link-text">{{ trans('cruds.dashboard.title_lang') }}</span>
						</a>
						<ul>
							<li class="c-sidebar-nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
								<a href="{{ route('admin.dashboard') }}" class="c-sidebar-nav-link"
									data-filter-tags="{{ strtolower(trans('cruds.dashboardAdmin.title_lang')) }}">
									<i
										class="fa-fw fal fa-stamp c-sidebar-nav-icon"></i>{{ trans('cruds.dashboardAdmin.title_lang') }}
								</a>
							</li>
							<li class="c-sidebar-nav-item {{ request()->is('admin/dashboard/monitoring') ? 'active' : '' }}">
								<a href="{{ route('admin.dashboard.monitoring') }}" class="c-sidebar-nav-link"
									data-filter-tags="{{ strtolower(trans('cruds.dashboardAdmin.title_lang')) }}">
									<i class="fa-fw fal fa-chart-pie c-sidebar-nav-icon"></i>Moitoring Realisasi
								</a>
							</li>
							<li class="c-sidebar-nav-item {{ request()->is('admin/dashboard/map') ? 'active' : '' }}">
								<a href="{{ route('admin.dashboard.map') }}" title="Dashboard Pemetaan"
									data-filter-tags="dashboard pemetaan">
									<i class="fa-fw fal fa-map c-sidebar-nav-icon"></i><span class="nav-link-text">Pemetaan</span>
								</a>
							</li>
						</ul>
					</li>
				@elseif (Auth::user()->roles[0]->title == 'Verifikator')
					<li class="{{ request()->is('admin/dashboard*') ? 'active open' : '' }} ">
						<a href="#" title="Dashboard" data-filter-tags="dashboard pemantauan kinerja">
							<i class="fal fa-analytics"></i>
							<span class="nav-link-text">{{ trans('cruds.dashboard.title_lang') }}</span>
						</a>
						<ul>
							<li class="c-sidebar-nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
								<a href="{{ route('admin.dashboard') }}" class="c-sidebar-nav-link"
									data-filter-tags="{{ strtolower(trans('cruds.dashboardVerifikator.title_lang')) }}">
									<i
										class="fa-fw fal fa-stamp c-sidebar-nav-icon"></i>{{ trans('cruds.dashboardVerifikator.title_lang') }}
								</a>
							</li>
							<li class="c-sidebar-nav-item {{ request()->is('admin/dashboard/map') ? 'active' : '' }}">
								<a href="{{ route('admin.dashboard.map') }}" title="Dashboard Pemetaan"
									data-filter-tags="dashboard pemetaan">
									<i class="fa-fw fal fa-map c-sidebar-nav-icon"></i><span class="nav-link-text">Pemetaan</span>
								</a>
							</li>
						</ul>
					</li>
				@endif
			@endcan

			{{-- verificator task --}}
			@can('verificator_task_access')
				<li class="nav-title" data-i18n="nav.administation">VERIFICATOR TASK</li>
				@can('onfarm_access')
					<li class="c-sidebar-nav-item {{ request()->is('verification/onfarm') ? 'active' : '' }}">
						<a href="{{ route('verification.onfarm.index') }}"
							data-filter-tags="verifikasi onfarm lapangan">
							<i class="fal fa-map-marker-check c-sidebar-nav-icon"></i>
							<span class="nav-link-text">{{ trans('cruds.onfarm.title_lang') }}</span>
							@php($unread = \App\Models\QaTopic::unreadCount())
							@if ($unread > 0)
								<span
									class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top">{{ $unread }}
									request</span>
							@endif
						</a>
					</li>
				@endcan
				@can('online_access')
					<li class="c-sidebar-nav-item {{ request()->is('verification/online') ? 'active' : '' }}">
						<a href="{{ route('verification.online.index') }}"
							data-filter-tags="verifikasi data online">
							<i class="fal fa-ballot-check c-sidebar-nav-icon"></i>
							<span class="nav-link-text">{{ trans('cruds.online.title_lang') }}</span>
							{{-- @php($unread = \App\Models\QaTopic::unreadCount()) --}}
							@if ($unread > 0)
								<span
									class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top">{{ $unread }}
									request</span>
							@endif
						</a>
					</li>
				@endcan
				@can('completed_access')
					<li class="c-sidebar-nav-item {{ request()->is('verification/completed') ? 'active' : '' }}">
						<a href="{{ route('verification.completed.index') }}"
							data-filter-tags="verifikasi selesai">
							<i class="fal fa-file-certificate c-sidebar-nav-icon"></i>
							<span class="nav-link-text">{{ trans('cruds.completed.title_lang') }}</span>
							{{-- @php($unread = \App\Models\QaTopic::unreadCount()) --}}
							@if ($unread > 0)
								<span
									class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top">{{ $unread }}
									request</span>
							@endif

						</a>
					</li>
				@endcan
				@can('verification_skl_access')
					<li class="{{ request()->is('admin/verification/skl/*') ? 'active open' : '' }} ">
						<a href="#" title="Surat Keterangan Lunas"
							data-filter-tags="verifikasi skl terbit">
							<i class="fal fal fa-file"></i>
							<span class="nav-link-text">{{ trans('cruds.sklverifikator.title_lang') }}</span>
						</a>
						<ul>
							@can('list_skl_access')
								<li class="c-sidebar-nav-item {{ request()->is('verification/skl/listskl') ? 'active' : '' }}">
									<a href="{{ route('admin.permissions.index') }}" title="listskl"
										data-filter-tags="verifikasi daftar skl">
										<i class="fa-fw fal fa-list c-sidebar-nav-icon"></i>
										<span class="nav-link-text">{{ trans('cruds.listskl.title_lang') }}</span>
									</a>
								</li>
							@endcan
							@can('create_skl_access')
								<li class="c-sidebar-nav-item {{ request()->is('verification/skl/createskl') ? 'active' : '' }}">
									<a href="{{ route('admin.roles.index') }}" title="createskl"
										data-filter-tags="verifikasi create buat skl terbit">
										<i class="fa-fw fal fa-plus c-sidebar-nav-icon"></i>
										<span class="nav-link-text">{{ trans('cruds.createskl.title_lang') }}</span>
									</a>
								</li>
							@endcan
							@can('issued_skl_access')
								<li class="c-sidebar-nav-item {{ request()->is('verification/skl/issuedskl') ? 'active' : '' }}">
									<a href="{{ route('admin.users.index') }}" title="issuedskl"
										data-filter-tags="verifikasi daftar skl terbit">
										<i class="fa-fw fal fa-briefcase c-sidebar-nav-icon"></i>
										<span class="nav-link-text">{{ trans('cruds.issuedskl.title_lang') }}</span>
									</a>
								</li>
							@endcan
						</ul>
					</li>
				@endcan
				{{-- backdate verifikasi --}}
				<li class="
					{{ request()->is('admin/task/pengajuanv2*')
					|| request()->is('admin/task/sklv2*') 
					|| request()->is('admin/task/onfarmv2*') 
					|| request()->is('admin/task/onlinev2*') ? 'active open' : '' }}">
					<a title="Verifikasi Backdate"
						data-filter-tags="verifikasi skl terbit">
						<i class="fal fa-calendar-day"></i>
						<span class="nav-link-text">Backdate Verifikasi</span>
					</a>
					<ul>
						<li class="c-sidebar-nav-item
							{{ request()->is('*pengajuanv2*')
							|| request()->is('admin/task/onlinev2*')
							 ? 'active' : '' }}">
							<a href="{{ route('admin.task.onlinev2') }}" title="Daftar Pengajuan Verifikasi"
								data-filter-tags="verifikasi daftar skl">
								<i class="fa-fw fal fa-file-search c-sidebar-nav-icon"></i>
								<span class="nav-link-text">Online</span>
							</a>
						</li>
						<li class="c-sidebar-nav-item {{ request()->is('*onfarmv2*') ? 'active' : '' }}">
							<a href="{{ route('admin.task.onfarmv2') }}" title="Daftar Verifikasi Onfarm"
								data-filter-tags="verifikasi daftar skl">
								<i class="fa-fw fal fa-map-marker-alt c-sidebar-nav-icon"></i>
								<span class="nav-link-text">Onfarm</span>
							</a>
						</li>
						<li class="c-sidebar-nav-item {{ request()->is('*sklv2*') ? 'active' : '' }}">
							<a href="{{ route('admin.task.sklv2') }}" title="listskl"
								data-filter-tags="verifikasi daftar skl">
								<i class="fa-fw fal fa-file-certificate c-sidebar-nav-icon"></i>
								<span class="nav-link-text">Penerbitan SKL</span>
							</a>
						</li>
					</ul>
				</li>
			@endcan

			{{-- user task --}}
			@can('user_task_access')
				<li class="nav-title">{{ __('PROSES RIPH')}}</li>
				@can('pull_access')
					<li class="c-sidebar-nav-item {{ request()->is('admin/task/pull') ? 'active' : '' }}">
						<a href="{{ route('admin.task.pull') }}"
							data-filter-tags="sinkronisasi sync tarik data siap riph">
							<i class="fa-fw fal fa-sync-alt c-sidebar-nav-icon">
							</i>
							{{ trans('cruds.pullSync.title_lang') }}
						</a>
					</li>
				@endcan
				@can('commitment_access')
					@if (Auth::user()->roles[0]->title == 'user_v2')
						<li class="{{ request()->is('admin/task/commitments')
							|| request()->is('admin/task/pksmitra')
							? 'active open' : '' }}">
							<a href="#" title="Komitmen dan PKS"
								data-filter-tags="data komitmen commitment pks">
								<i class="fa-fw fal fa-ballot c-sidebar-nav-icon"></i>
								<span class="nav-link-text">{{ trans('cruds.commitment.title_lang') }} dan PKS</span>
							</a>
							<ul>
								<li class="c-sidebar-nav-item {{ request()->is('admin/task/commitments') ? 'active' : '' }}">
									<a href="{{ route('admin.task.commitments.index') }}"
										data-filter-tags="daftar komitmen riph index">
										<i class="fa-fw fal fa-ballot c-sidebar-nav-icon"></i>
										{{ trans('cruds.commitment.title_lang') }}
									</a>
								</li>
								<li class="c-sidebar-nav-item {{ request()->is('admin/task/pksmitra') ? 'active' : '' }}">
									<a href="{{ route('admin.task.pksmitra.index') }}"
										data-filter-tags="daftar komitmen riph index">
										<i class="fa-fw fal fa-ballot c-sidebar-nav-icon"></i>
										Daftar PKS
									</a>
								</li>
							</ul>
						</li>
					@else
						<li class="c-sidebar-nav-item {{ request()->is('admin/task/commitment') ? 'active' : '' }}">
							<a href="{{ route('admin.task.commitment') }}"
								data-filter-tags="daftar komitmen riph index">
								<i class="fa-fw fal fa-ballot c-sidebar-nav-icon"></i>
								{{ trans('cruds.commitment.title_lang') }}
							</a>
						</li>
					@endif
				@endcan
				@can('kelompoktani_access')
					<li class="{{ request()->is('admin/task/masterpenangkar') 
						|| request()->is('admin/task/kelompoktani') 
						|| request()->is('admin/task/masterpoktan')
						|| request()->is('admin/task/kelompoktani/*') 
						|| request()->is('admin/task/pks') 
						|| request()->is('admin/task/pks/*') ? 'active open' : '' }}">
						<a href="#" title="Kelompok tani"
							data-filter-tags="data master kelompoktani poktan penangkar pks">
							<i class="fa-fw fal fa-users c-sidebar-nav-icon"></i>
							<span class="nav-link-text">{{ trans('cruds.kelompoktani.title_lang') }} dan Penangkar</span>
						</a>
						<ul>
							@can('poktan_access')
								@if (Auth::user()->roles[0]->title == 'user_v2')
									<li class="c-sidebar-nav-item {{ request()->is('admin/task/masterpoktan') 
										|| request()->is('admin/task/kelompoktani/*') 
										|| request()->is('admin/task/kelompoktani') 
										|| request()->is('admin/task/kelompoktani/*') ? 'active' : '' }}">
										@if (Auth::user()->roles[0]->title == 'user_v2')
										<a href="{{ route('admin.task.masterpoktan.index') }}" title="Daftar Master Kelompoktani"
											data-filter-tags="daftar master kelompoktani poktan">
											<i class="fa-fw fal fa-users c-sidebar-nav-icon"></i>
											{{ trans('cruds.daftarpoktan.title_lang') }}
										</a>
										@else
										<a href="{{ route('admin.task.kelompoktani') }}" title="Daftar poktan"
											data-filter-tags="daftar master kelompoktani poktan">
											<i class="fa-fw fal fa-users c-sidebar-nav-icon"></i>
											{{ trans('cruds.daftarpoktan.title_lang') }}
										</a>
										@endif
									</li>
									<li class="c-sidebar-nav-item {{ request()->is('admin/task/masterpenangkar') 
										|| request()->is('admin/task/masterpenangkar/*') 
										||   request()->is('admin/task/masterpenangkar') 
										|| request()->is('admin/task/masterpenangkar/*') ? 'active' : '' }}">
										@if (Auth::user()->roles[0]->title == 'user_v2')
										<a href="{{ route('admin.task.masterpenangkar.index') }}" title="Daftar Penangkar Benih Bawang Putih Berlabel"
											data-filter-tags="daftar master penangkar benih">
											<i class="fa-fw fal fa-users c-sidebar-nav-icon"></i>
											Master Penangkar
										</a>
										@endif
									</li>
								@else
								@endif
							@endcan
							@can('pks_access')
							<li
								class="c-sidebar-nav-item {{ request()->is('admin/task/pks') 
									|| request()->is('admin/task/pks/*') ? 'active' : '' }}">
								<a href="{{ route('admin.task.pks.index') }}" title="Daftar PKS"
									data-filter-tags="daftar pks perjanjian kerjasama">
									<i class="fa-fw fal fa-users c-sidebar-nav-icon"></i>
									{{ trans('cruds.daftarpks.title_lang') }}
								</a>
							</li>
							@endcan
						</ul>
					</li>
				@endcan
				{{-- permohonan --}}
				@can('permohonan_access')
					<li class="{{ request()->is('admin/task/pengajuan*') 
						|| request()->is('admin/task/skl*') ? 'active open' : '' }} ">
						<a href="#" title="Verifikasi & SKL"
							data-filter-tags="daftar pengajuan permohonan verifikasi skl">
							<i class="fa-fw fal fa-ballot"></i>
							<span class="nav-link-text">{{ trans('cruds.verifikasi.title_lang') }}</span>
						</a>
						<ul>
							@can('pengajuan_access')
								<li class="c-sidebar-nav-item {{ request()->is('admin/task/pengajuan') 
									|| request()->is('admin/task/submission*') ? 'active' : '' }}">
									@if (Auth::user()->roles[0]->title == 'user_v2')
										<a href="{{ route('admin.task.submission') }}"
											data-filter-tags="daftar pengajuan verifikasi data online onfarm">
											<i class="fa-fw fal fa-ballot c-sidebar-nav-icon"></i>
											Pengajuan Verifikasi
										</a>
									@else
										<a href="{{ route('admin.task.pengajuan.index') }}" title="Pengajuan"
											data-filter-tags="daftar pengajuan verifikasi data online onfarm">
											<i class="fa-fw fal fa-file c-sidebar-nav-icon"></i>
											<span class="nav-link-text">
												{{ trans('cruds.pengajuan.title_lang') }}
											</span>
										</a>
									@endif
								</li>
							@endcan
							@can('skl_access')  
								<li class="c-sidebar-nav-item {{ request()->is('admin/task/skl')
									|| request()->is('admin/task/sklv2*')
									|| request()->is('admin/task/skl/*') ? 'active' : '' }}">
									@if (Auth::user()->roles[0]->title == 'user_v2')
										<a href="{{ route('admin.task.sklv2.list') }}" title="Daftar SKL Terbit"
											data-filter-tags="daftar skl terbit">
											<i class="fa-fw fal fa-award c-sidebar-nav-icon"></i>
											<span class="nav-link-text">{{ trans('cruds.skl.title_lang') }}</span>
										</a>
									@else
										<a href="{{ route('admin.task.skl.index') }}" title="Skl"
											data-filter-tags="daftar pengajuan skl">
											<i class="fa-fw fal fa-file c-sidebar-nav-icon"></i>
											<span class="nav-link-text">{{ trans('cruds.skl.title_lang') }}</span>
										</a>
									@endif
								</li>
							@endcan

						</ul>
					</li>
				@endcan
			@endcan

			

			{{-- pengelolaan berkas --}}
			@can('folder_access')
				<li class="{{ request()->is('admin/task/berkas*') 
					|| request()->is('admin/task/galeri*') 
					|| request()->is('admin/task/template*') ? 'active open' : '' }} ">
					<a href="#" title="Pengelolaan Berkas"
						data-filter-tags="pengelolaan manajemen manajer berkas file unggahan unduhan foto">
						<i class="fa-fw fal fa-folders"></i>
						<span class="nav-link-text">{{ trans('cruds.folder.title_lang') }}</span>
					</a>
					<ul>
						@can('berkas_access')
							<li class="c-sidebar-nav-item {{ request()->is('admin/task/berkas') 
								|| request()->is('admin/task/berkas/*') ? 'active' : '' }}">
								<a href="{{ route('admin.task.berkas') }}" title="Berkas"
									data-filter-tags="berkas file unggahan unduhan">
									<i class="fa-fw fal fa-file c-sidebar-nav-icon"></i>
									<span class="nav-link-text">{{ trans('cruds.berkas.title_lang') }}</span>
								</a>
							</li>
						@endcan
						@can('galeri_access')
							<li class="c-sidebar-nav-item {{ request()->is('admin/task/galeri') 
								|| request()->is('admin/task/skl/*') ? 'active' : '' }}">
								<a href="{{ route('admin.task.galeri') }}" title="Galeri"
									data-filter-tags="galeri gallery daftar foto">
									<i class="fa-fw fal fa-images c-sidebar-nav-icon"></i>
									<span class="nav-link-text">{{ trans('cruds.galeri.title_lang') }}</span>
								</a>
							</li>
						@endcan
						@can('template_access')
							<li class="c-sidebar-nav-item {{ request()->is('admin/task/template') 
								|| request()->is('admin/task/template/*') ? 'active' : '' }}">
								<a href="{{ route('admin.task.template') }}" title="Skl"
									data-filter-tags="daftar berkas file template">
									<i class="fa-fw fal fa-folder c-sidebar-nav-icon"></i>
									<span class="nav-link-text">{{ trans('cruds.template.title_lang') }}</span>
								</a>
							</li>
						@endcan

					</ul>
				</li>
			@endcan

			{{-- Feed & Messages --}}
			@can('feedmsg_access')
				<li class="nav-title">BERITA & PESAN</li>
				@can('feeds_access')
					<li class="{{ request()->is('admin/posts*') 
						|| request()->is('admin/categories*') ? 'active open' : '' }}">
						<a href="#" title="Artikel/Berita"
							data-filter-tags="artikel berita informasi">
							<i class="fa-fw fal fa-rss c-sidebar-nav-icon"></i>
							<span class="nav-link-text">Artikel/Berita</span>
						</a>
						<ul>
							@can('feeds_access')
							<li class="c-sidebar-nav-item {{ request()->is('admin/categories') 
								|| request()->is('admin/categories/*') ? 'active' : '' }}">
								<a href="{{ route('admin.categories.index') }}" title="Categories"
									data-filter-tags="categories kategori">
									<i class="fa-fw fal fa-rss c-sidebar-nav-icon"></i>
									Categories
								</a>
							</li>
							<li class="c-sidebar-nav-item {{ request()->is('admin/posts') 
								|| request()->is('admin/posts/*') ? 'active' : '' }}">
								<a href="{{ route('admin.posts.index') }}" title="Posts"
									data-filter-tags="post artikel berita">
									<i class="fa-fw fal fa-rss c-sidebar-nav-icon"></i>
									Articles
								</a>
							</li>
							@endcan
						</ul>
					</li>
				@endcan
				@can('messenger_access')
					@php($unread = \App\Models\QaTopic::unreadCount())
					<li class="c-sidebar-nav-item {{ request()->is('admin/messenger') 
						|| request()->is('admin/messenger/*') ? 'active' : '' }}">
						<a href="{{ route('admin.messenger.index') }}"
							data-filter-tags="kirim pesan perpesanan send message messenger">
							<i class="c-sidebar-nav-icon fal fa-envelope"></i>
							<span class="nav-link-text">{{ trans('global.messages') }}</span>
							@if ($unread > 0)
								<span
									class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top">{{ $unread }}
									pesan</span>
							@endif
						</a>
					</li>
				@endcan
			@endcan
			{{-- end feed --}}

			{{-- administrator access --}}
			@can('administrator_access')
				<li class="nav-title" data-i18n="nav.administation">ADMINISTRATOR</li>
				{{-- user Management --}}
				@can('user_management_access')
					<li class="{{ request()->is('admin/permissions*') 
						|| request()->is('admin/roles*') || request()->is('admin/users*') 
						|| request()->is('admin/audit-logs*') ? 'active open' : '' }} ">
						<a href="#" title="User Management"
							data-filter-tags="setting permission user">
							<i class="fal fal fa-users"></i>
							<span class="nav-link-text">{{ trans('cruds.userManagement.title_lang') }}</span>
						</a>
						<ul>
							@can('permission_access')
								<li class="c-sidebar-nav-item {{ request()->is('admin/permissions') 
									|| request()->is('admin/permissions/*') ? 'active' : '' }}">
									<a href="{{ route('admin.permissions.index') }}" title="Permission"
										data-filter-tags="setting daftar permission user">
										<i class="fa-fw fal fa-unlock-alt c-sidebar-nav-icon"></i>
										<span class="nav-link-text">{{ trans('cruds.permission.title_lang') }}</span>
									</a>
								</li>
							@endcan
							@can('role_access')
								<li class="c-sidebar-nav-item {{ request()->is('admin/roles') 
									|| request()->is('admin/roles/*') ? 'active' : '' }}">
									<a href="{{ route('admin.roles.index') }}" title="Roles"
										data-filter-tags="setting role user">
										<i class="fa-fw fal fa-briefcase c-sidebar-nav-icon"></i>
										<span class="nav-link-text">{{ trans('cruds.role.title_lang') }}</span>
									</a>
								</li>
							@endcan
							@can('user_access')
								<li class="c-sidebar-nav-item {{ request()->is('admin/users') 
									|| request()->is('admin/users/*') ? 'active' : '' }}">
									<a href="{{ route('admin.users.index') }}" title="User"
										data-filter-tags="setting user pengguna">
										<i class="fa-fw fal fa-user c-sidebar-nav-icon"></i>
										<span class="nav-link-text">{{ trans('cruds.user.title_lang') }}</span>
									</a>
								</li>
							@endcan
							@can('audit_log_access')
								<li class="c-sidebar-nav-item {{ request()->is('admin/audit-logs') 
									|| request()->is('admin/audit-logs/*') ? 'active' : '' }}">
									<a href="{{ route('admin.audit-logs.index') }}" title="Audit Log"
										data-filter-tags="setting log_access audit">
										<i class="fa-fw fal fa-file-alt c-sidebar-nav-icon"></i>
										<span class="nav-link-text">{{ trans('cruds.auditLog.title_lang') }}</span>
									</a>
								</li>
							@endcan
						</ul>
					</li>
				@endcan

				{{-- Master data RIPH --}}
				@can('master_riph_access')
					<li class="c-sidebar-nav-item {{ request()->is('admin/riphAdmin') || request()->is('admin/riphAdmin/*') ? 'active' : '' }}">
						<a href="{{ route('admin.riphAdmin.index') }}"
							data-filter-tags="data benchmark riph tahunan">
							<i class="fab fa-stack-overflow c-sidebar-nav-icon"></i>{{ trans('cruds.masterriph.title_lang') }}
						</a>
					</li>
				@endcan

				{{-- Master template --}}
				@can('template_access')
					<li class="c-sidebar-nav-item {{ request()->is('admin/task/template') || request()->is('admin/task/template/*') ? 'active' : '' }}">
						<a href="{{ route('admin.task.template') }}"
							data-filter-tags="{{ strtolower(trans('cruds.mastertemplate.title_lang')) }}">
							<i class="fal fa-file-upload c-sidebar-nav-icon"></i>{{ trans('cruds.mastertemplate.title_lang') }}
						</a>
					</li>
				@endcan

				{{-- data report --}}
				@can('data_report_access')
					<li
						class="{{ request()->is('admin/datareport') || request()->is('admin/datareport/*') ? 'active open' : '' }}">
						<a href="#" title="Data Report"
							data-filter-tags="lapoan wajib tanam produksi report realisasi">
							<i class="fal fa-print c-sidebar-nav-icon"></i>
							<span class="nav-link-text">{{ trans('cruds.datareport.title_lang') }}</span>
						</a>
						<ul>
							@can('commitment_list_access')
								<li class="c-sidebar-nav-item {{ request()->is('admin/datareport/comlist') ? 'active' : '' }}">
									<a href="{{ route('admin.audit-logs.index') }}" title="Commitment List"
										data-filter-tags="laporan realisasi komitmen">
										<i class="fa-fw fal fa-file-alt c-sidebar-nav-icon"></i>
										<span class="nav-link-text">{{ trans('cruds.commitmentlist.title_lang') }}</span>
									</a>
								</li>
							@endcan
							@can('verification_report_access')
								<li
									class="c-sidebar-nav-item {{ request()->is('admin/datareport/verification') ? 'active' : '' }}">
									<a href="#" title="Audit Log"
										data-filter-tags="laporan realisasi verifikasi">
										<i class="fa-fw fal fa-file-alt c-sidebar-nav-icon"></i>
										<span class="nav-link-text">{{ trans('cruds.verificationreport.title_lang') }}</span>
									</a>
									<ul>
										@can('verif_onfarm_access')
											<li>
												<a href=""title="Onfarm"
													data-filter-tags="laporan realisasi verifikasi onfarm">
													<i class="fa-fw fal fa-file-alt c-sidebar-nav-icon"></i>
													<span class="nav-link-text">{{ trans('cruds.verifonfarm.title_lang') }}</span>
												</a>
											</li>
										@endcan
										@can('verif_online_access')
											<li>
												<a href=""title="Online"
													data-filter-tags="laporan realisasi verifikasi online">
													<i class="fa-fw fal fa-file-alt c-sidebar-nav-icon"></i>
													<span class="nav-link-text">{{ trans('cruds.verifonline.title_lang') }}</span>
												</a>
											</li>
										@endcan

									</ul>
								</li>
							@endcan
						</ul>
					</li>
				@endcan

				{{-- SKL --}}
				@can('admin_SKL_access')
					<li 
						class="{{ request()->is('admin/skl') || request()->is('admin/skl/*') ? 'active open' : '' }}">
						<a href="{{ route('admin.skl.index') }}" title="SKL"
							data-filter-tags="Surat Keterangan Lunas SKL">
							<i class="fal fa-briefcase c-sidebar-nav-icon"></i>
							<span class="nav-link-text">{{ trans('cruds.adminskl.title_lang') }}</span>
						</a>
						{{-- <ul>
							@can('admin_SKLlist_access')
								<li class="c-sidebar-nav-item {{ request()->is('admin/skl/skllist') ? 'active' : '' }}">
									<a href="{{ route('admin.audit-logs.index') }}" title="SKL List"
										data-filter-tags="{{ strtolower(trans('cruds.adminskllist.title_lang')) }}">
										<i class="fa-fw fal fa-file-alt c-sidebar-nav-icon"></i>
										<span class="nav-link-text"
											data-i18n="nav.administation_sub1_menu4">{{ trans('cruds.adminskllist.title_lang') }}</span>
									</a>
								</li>
							@endcan  
							@can('admin_SKLcreate_access')
								<li class="c-sidebar-nav-item {{ request()->is('admin/skl/sklcreate') ? 'active' : '' }}">
									<a href="{{ route('admin.audit-logs.index') }}" title="SKL Create"
										data-filter-tags="{{ strtolower(trans('cruds.admincreateskl.title_lang')) }}">
										<i class="fa-fw fal fa-file-alt c-sidebar-nav-icon"></i>
										<span class="nav-link-text"
											data-i18n="nav.administation_sub1_menu4">{{ trans('cruds.admincreateskl.title_lang') }}</span>
									</a>
								</li>
							@endcan    
						</ul> --}}
					</li>
				@endcan
			@endcan

			{{-- personalisasi --}}
			<li class="nav-title" data-i18n="nav.administation">PERSONALISASI</li>
			{{-- Change Password --}}
			@if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
				@can('profile_password_edit')
					<li
						class="c-sidebar-nav-item {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
						<a href="{{ route('profile.password.edit') }}"
							data-filter-tags="personalisasi ganti ubah change password ">
							<i class="fa-fw fas fa-key c-sidebar-nav-icon">
							</i>
							{{ trans('global.change_password') }}
						</a>
					</li>
				@endcan
			@endif

			{{-- logout --}}
			<li class="c-sidebar-nav-item">
				<a href="#" class="c-sidebar-nav-link"
					data-filter-tags="keluar log out tutup"
					onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
					<i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

					</i>
					{{ trans('global.logout') }}
				</a>
			</li>
		</ul>
	</nav>
	<!-- END PRIMARY NAVIGATION -->

</aside>