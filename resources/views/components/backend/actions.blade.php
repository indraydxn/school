<div x-data="usePopper({placement:'bottom-end',offset:4})" @click.outside="isShowPopper && (isShowPopper = false)" class="inline-flex">
    @props(['user'])
    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper" class="btn size-7 text-gray-500 rounded-lg p-0 border border-gray-200 hover:bg-gray-300/20 focus:bg-gray-300/20 active:bg-gray-300/25">
        <i class="text-sm fa-regular fa-ellipsis-v"></i>
    </button>

    <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
        <div class="popper-box rounded-lg border border-gray-200 bg-white p-1.5 shadow-soft">
            <ul>
                <li>
                    <a href="#" class="flex h-8 items-center space-x-3 px-3 pr-8 text-gray-600 tracking-wide outline-hidden transition-all hover:bg-gray-100 hover:text-gray-800 focus:bg-gray-100 focus:text-gray-800 rounded-lg">
                        <i class="fa-regular fa-eye mt-px"></i>
                        <span>Lihat</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex h-8 items-center space-x-3 px-3 pr-8 text-gray-600 tracking-wide outline-hidden transition-all hover:bg-gray-100 hover:text-gray-800 focus:bg-gray-100 focus:text-gray-800 rounded-lg">
                        <i class="fa-regular fa-edit"></i>
                        <span>Ubah</span>
                    </a>
                </li>
                <li>
                    <div x-data="{showModal:false}">
                        <button type="button" @click="showModal = true" class="flex h-8 items-center space-x-3 px-3 pr-8 tracking-wide text-error outline-hidden transition-all hover:bg-error/20 focus:bg-error/20 rounded-lg">
                            <i class="fa-regular fa-trash"></i>
                            <span>Hapus data</span>
                        </button>
                                                <x-backend.modal-delete :id="$user->id" :name="$user->nama_lengkap"/>
                    </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
