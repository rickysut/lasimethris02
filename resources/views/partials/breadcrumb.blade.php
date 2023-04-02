	<!-- breadcrumb -->
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="/">Simethris</a></li>
		@if ($page_title ==='')
			<li class="breadcrumb-item active">{{  ($module_name ?? '') }}</li>	
		@else
			<li class="breadcrumb-item">{{ ($module_name ?? '')  }}</li>
			<li class="breadcrumb-item active">{{  ($page_title ?? '') }}</li>
		@endif
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<!-- End breadcrumb -->