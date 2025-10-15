<div class="flex items-center justify-center gap-2">

    @if ($view)
    <a href="{{ $urlView }}" x-tooltip="'Lihat'" class="flex items-center size-8 text-xs-plus p-3 text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
        <i class="fa-light fa-eye"></i>
    </a>
    @endif

    @if ($edit)
    <a href="{{ $urlEdit }}" x-tooltip="'Edit'" class="flex items-center size-8 text-xs-plus p-3 text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
        <i class="fa-light fa-edit"></i>
    </a>
    @endif

    @if ($delete)
    <div x-data="{showModal:false}">
        <button type="button" @click="showModal = true" x-tooltip="'Hapus'" class="flex items-center size-8 text-xs-plus p-3 font-medium text-error border border-error/20 btn bg-white hover:bg-error/20 disabled:opacity-25">
            <i class="fa-light fa-trash"></i>
        </button>
        <x-backend.modal-delete :id="$data->id" :name="$name"/>
    </div>
    @endif

</div>
