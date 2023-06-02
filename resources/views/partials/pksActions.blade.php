@can($viewGate)
    <a class="btn btn-icon btn-xs btn-success" data-toggle="tooltip" title="Laporan Realisasi" href="{{ route('admin.' . $crudRoutePart . '.realisasi', $row->id) }}">
        <i class="fal fa-seedling"></i>
    </a>
@endcan

@can($viewGate)
    <a class="btn btn-icon btn-xs btn-primary" data-toggle="tooltip" title="Lihat Rincian" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        <i class="fal fa-search-plus"></i>
    </a>
@endcan

@can($editGate)
    <a class="btn btn-icon btn-xs btn-info" data-toggle="tooltip" title="Perbaharui Data" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        <i class="fal fa-edit"></i>
    </a>
@endcan
@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}"  method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-icon btn-xs btn-danger"  data-toggle="tooltip" title="Hapus Data" value="{{ trans('global.delete') }}"><i class="fas fa-trash"></i></button>
    </form>
@endcan
