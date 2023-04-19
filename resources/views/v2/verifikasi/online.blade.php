@extends('layouts.admin')
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')

	@can('commitment_access')
		@include('partials.sysalert')
		
	@endcan
@endsection

@section('scripts')
	@parent
    
@endsection
