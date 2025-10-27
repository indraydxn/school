<div>
    <template x-teleport="#x-teleport-target">
        <div @keydown.window.escape="showModal = false" x-show="showModal" role="dialog" class="fixed inset-0 z-100 flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5" >
            <div @click="showModal = false" x-show="showModal" x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"></div>
            <div x-show="showModal" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]" x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave="easy-in" x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]" class="relative flex items-center justify-center lg:w-sm w-xs rounded-xl bg-white p-6 text-center transition-all duration-300" >
                <button @click="showModal = false" class="absolute top-4 right-4 size-7 rounded-full text-xs text-gray-500 hover:text-gray-700 bg-gray-100/50 hover:bg-gray-100">
                    <i class="fa-regular fa-times"></i>
                </button>
                <div class="">
                    {{-- <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-primary text-white">
                        <i class="fa-solid fa-down-to-bracket text-2xl"></i>
                    </div> --}}
                    <h3 class="mt-4 text-2xl font-extrabold text-slate-800 tracking-wide dark:text-navy-50">
                        Eksport Data
                    </h3>
                    <p class="text-slate-600 my-2 dark:text-navy-200 tracking-wide">
                        Pilih format untuk mengekspor data!
                    </p>
                    <div class="mt-6 flex justify-center space-x-3 lg:w-[300px] w-[250px] h-[60px]">
                        <form wire:submit="exportPdf" wire:target="exportPdf" class="inline w-full h-full">
                            <button type="submit" wire:loading.attr="disabled" class="btn h-full w-full bg-error/10 border border-error/50 font-bold text-error hover:bg-error/20 focus:bg-error/20">
                                <span wire:loading.remove wire:target="exportPdf" class="flex items-center gap-2">
                                    <img src="{{asset('logos/pdf.svg')}}" alt="pdf" class="size-5">
                                    PDF
                                </span>
                                <span wire:loading wire:target="exportPdf" class="flex items-center justify-center gap-2">
                                    Memproses...
                                    {{-- <i class="fa-duotone fa-spinner-third animate-spin text-error"></i> --}}
                                </span>
                            </button>
                        </form>
                        <form wire:submit="exportExcel" wire:target="exportExcel" class="inline w-full h-full">
                            <button type="submit" wire:loading.attr="disabled" class="btn h-full w-full bg-success/10 border border-success/50 font-bold text-success hover:bg-success/20 focus:bg-success/20">
                                <span wire:loading.remove wire:target="exportExcel" class="flex items-center gap-2">
                                    <img src="{{asset('logos/excel.svg')}}" alt="excel" class="size-5">
                                    Excel
                                </span>
                                <span wire:loading wire:target="exportExcel" class="flex items-center justify-center gap-2">
                                    Memproses...
                                    {{-- <i class="fa-duotone fa-spinner-third animate-spin text-success"></i> --}}
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
