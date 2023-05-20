@can($viewGate)
    <a href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}"
        class="btn btn-icon btn-xs btn-info"
        title="Laporan Realisasi Komitmen">
        <i class="fal fa-ballot-check"></i>
    </a>
@endcan

@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}"  method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="ml-3 btn btn-icon btn-xs btn-danger" title="Hapus data komitment"> 
			<i class="fal fa-trash-alt"></i>
		</button>
    </form>
@endcan
