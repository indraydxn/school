<div class="flex items-center lg:gap-2 gap-1">
    <button class="lg:flex lg:items-center lg:gap-2 px-3 py-2 font-medium text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
        <i class="text-xs-plus fa-light fa-eye"></i>
    </button>
    <button class="lg:flex lg:items-center lg:gap-2 px-3 py-2 font-medium text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
        <i class="text-xs-plus fa-light fa-edit"></i>
    </button>
    <div x-data="{showModal:false}">
        <button type="button" @click="showModal = true" class="lg:flex lg:items-center lg:gap-2 px-3 py-2 font-medium text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
            <i class="text-xs-plus fa-light fa-trash"></i>
        </button>
        <x-backend.modal-delete :id="$user->id" :name="$user->nama_lengkap"/>
    </div>
</div>