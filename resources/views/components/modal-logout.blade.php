<div>
    <template x-teleport="#x-teleport-target">
        <div @keydown.window.escape="showModal = false" x-show="showModal" role="dialog" class="fixed inset-0 z-100 flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5" >
            <div @click="showModal = false" x-show="showModal" x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/60 backdrop-blur transition-opacity duration-300"></div>
            <div x-show="showModal" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]" x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave="easy-in" x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]" class="relative flex items-center justify-center lg:max-w-md max-w-sm rounded-xl bg-white p-6 text-center transition-all duration-300" >
                <div class="">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-warning text-white">
                        <i class="fa-solid fa-sign-out text-2xl"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-extrabold text-slate-800 tracking-wide dark:text-navy-50">
                        Konfirmasi Log Out
                    </h3>
                    <p class="text-slate-600 dark:text-navy-200 tracking-wide">
                        Apakah Anda yakin ingin keluar dari akun Anda?
                    </p>
                    <div class="mt-6 flex justify-center space-x-3">
                        <button @click="showModal = false" type="button" class="btn bg-gray-100 font-bold text-slate-800 hover:bg-gray-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            Batal
                        </button>
                        <form wire:submit="logout">
                            <button type="submit" wire:loading.attr="disabled" type="button" class="btn bg-warning font-bold text-white hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90">
                                <span wire:loading.remove>Ya, Keluar</span>
                                <span wire:loading class="flex items-center justify-center gap-2">
                                    Memproses...
                                    <i class="fa-duotone fa-spinner-third animate-spin"></i>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
