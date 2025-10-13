<div x-data="usePopper({ placement: 'top-start', offset: 12 })" @click.outside="if(isShowPopper) isShowPopper = false" class="flex">

    {{-- Toggle --}}
    <button @click="isShowPopper = !isShowPopper" x-ref="popperRef" class="w-full overflow-hidden gap-2 flex items-center relative px-3 py-2 rounded-lg border border-gray-200 hover:bg-gray-100/50 hover:text-gray-800 focus:bg-gray-100/50 focus:text-gray-80">
        <img class="rounded-full size-5" src="{{ asset('images/user.png') }}" alt="avatar" />
        <div class="flex gap-0.5 justify-between items-center lg:max-w-38 max-w-32">
            <p class="font-bold text-gray-800 dark:text-gray-300 truncate tracking-wider">
                Nama Lengkap Anda Disini
            </p>
            <i class="fa-regular fa-angles-up-down"></i>
        </div>
    </button>

    {{-- Content --}}
    <div :class="isShowPopper && 'show'" class="popper-root fixed" x-ref="popperRoot">
        <div class="popper-box w-48 lg:w-50 mx-1 rounded-xl border border-slate-150 bg-white shadow-soft">
            <div class="p-1.5 space-y-1.5 w-full">

                {{-- Profile --}}
                <a wire:navigate href="" class="flex items-center gap-3 py-2 px-3 rounded-lg text-gray-600 hover:bg-gray-100/50 hover:text-gray-800 focus:bg-gray-100/50 focus:text-gray-80" >
                    <i class="fa-light fa-address-card"></i>
                    <span class="tracking-wider">
                        Profil
                    </span>
                </a>

                {{-- Pengaturan --}}
                <a wire:navigate href="" class="flex items-center gap-3 py-2 px-3 rounded-lg text-gray-600 hover:bg-gray-100/50 hover:text-gray-800 focus:bg-gray-100/50 focus:text-gray-80" >
                    <i class="fa-light fa-gear"></i>
                    <span class="tracking-wider">
                        Pengaturan
                    </span>
                </a>

                {{-- Logout --}}
                <form action="" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 py-2 px-3 rounded-lg text-white  bg-error hover:bg-error-focus focus:bg-error-focus" >
                        <i class="fa-light fa-sign-out"></i>
                        <span class="tracking-wider">
                            Keluar
                        </span>
                    </button>
                </form>

            </div>
        </div>
    </div>
    {{-- Content --}}

</div>
