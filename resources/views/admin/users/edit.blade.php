@extends('layouts.admin')
@section('content')
@include('partials.subheader')
<div class="row">
	<div class="col-12">
		<div id="panel-1" class="panel panel-lock show" data-panel-sortable data-panel-close data-panel-collapsed>
            <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="panel-hdr">
                    <h2>
                        {{ trans('cruds.user.title') }} | <span class="fw-300"><i>Ubah</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <div class="form-group">
                            <button class="btn btn-success  waves-effect waves-themed btn-sm mr-2" type="submit">
                                {{ trans('global.save') }}
                            </button>
                            <a class="btn btn-danger  waves-effect waves-themed btn-sm mr-2" href="{{ route('admin.users.index') }}">
                                {{ trans('global.cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="username">{{ trans('cruds.user.fields.username') }}</label>
                                    <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>
                                    @if($errors->has('username'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('username') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="roleaccess">{{ trans('cruds.user.fields.roleaccess') }}</label>
                                    <select class="form-control select2 {{ $errors->has('roleaccess') ? 'is-invalid' : '' }}" name="roleaccess" id="roleaccess"  required>
                                        @foreach($access as $id => $role)
                                            <option value="{{ $id }}" {{ ($user->roleaccess==$id ? 'selected' : '') }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    
                                    @if($errors->has('roleaccess'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('roleaccess') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.roleaccess_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                                    {{-- <div style="padding-bottom: 4px">
                                        <span class="btn btn-info btn-xs select-all" style="border-radius: 10">{{ trans('global.select_all') }}</span>
                                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 10">{{ trans('global.deselect_all') }}</span>
                                    </div> --}}
                                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                                        @foreach($roles as $id => $role)
                                            <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('roles'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('roles') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection