<div class="flex items-center justify-center gap-2">

    @if ($view)
    <button type="button" x-tooltip="'Lihat'" class="flex items-center size-8 text-xs-plus p-3 text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
        <i class="fa-light fa-eye"></i>
    </button>
    @endif

    @if ($edit)        
    <button type="button" x-tooltip="'Edit'" class="flex items-center size-8 text-xs-plus p-3 text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
        <i class="fa-light fa-edit"></i>
    </button>
    @endif

    @if ($delete)        
    <div x-data="{showModal:false}">
        <button type="button" @click="showModal = true" x-tooltip="'Hapus'" class="flex items-center size-8 text-xs-plus p-3 font-medium text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
            <i class="fa-light fa-trash"></i>
        </button>
        <x-backend.modal-delete :id="$data->id"/>
    </div>
    @endif

</div>