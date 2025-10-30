<div>
    <template x-teleport="#x-teleport-target">
        <div @keydown.window.escape="$wire.closeModal(); showModal = false" x-show="showModal" role="dialog" class="fixed inset-0 z-100 flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5" >
            <div wire:click="closeModal" @click="showModal = false" x-show="showModal" x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"></div>
            <div x-show="showModal" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]" x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave="easy-in" x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]" class="relative flex items-center justify-center lg:w-sm w-xs rounded-xl bg-white p-6 text-center transition-all duration-300" >
                <div class="">
                    {{-- <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-primary text-white">
                        <i class="fa-solid fa-up-from-bracket text-2xl"></i>
                    </div> --}}
                    <h3 class="mt-4 text-2xl font-extrabold text-slate-800 tracking-wide dark:text-navy-50">
                        Import Data
                    </h3>
                    <p class="text-slate-600 my-2 dark:text-navy-200 tracking-wide">
                        Unggah file Excel untuk mengimpor!
                    </p>
                    <p class="text-slate-500 dark:text-navy-300">
                        <a href="{{ $href }}" target="_blank" class="text-primary hover:text-primary-focus tracking-wide font-medium">
                            Download Template Excel
                        </a>
                    </p>
                    <form wire:submit="import" wire:target="import" class="mt-6">
                        <div class="mb-6">
                            @if($file)
                                <div class="bg-gray-100 border border-dashed border-gray-200 rounded-lg p-3 lg:w-[300px] w-[250px] h-[60px]">
                                    <div class="flex items-center justify-start space-x-2 truncate text-truncate">
                                        <div class="flex items-center">
                                            <button type="button" wire:click="closeModal" class="size-7 rounded-full text-xs text-gray-500 bg-gray-200 hover:bg-gray-300">
                                                <i class="fa-solid fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="flex items-center  truncate text-truncate">
                                            <div class="flex flex-col items-start text-start tracking-wide">
                                                <p class="tracking-wide text-xs-plus font-bold text-gray-900 truncate">{{ $file->getClientOriginalName() }}</p>
                                                <p class="tracking-wide text-xs text-gray-500 truncate">{{ number_format($file->getSize() / 1024, 2) }} KB</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <label class="btn bg-gray-100 relative border border-dashed border-gray-200 font-medium cursor-pointer lg:w-[300px] w-[250px] h-[60px]"  wire:target="file" wire:loading.class="pointer-events-none">
                                    <input tabindex="-1" type="file" wire:target="file" wire:model="file" accept=".xlsx,.xls" class="pointer-events-none absolute inset-0 h-full w-full opacity-0" wire:loading.attr="disabled" />
                                    <div class="flex items-center space-x-2 tracking-wide">
                                        <i wire:loading.remove  wire:target="file" class="fa-solid fa-cloud-arrow-up text-base" aria-hidden="true"></i>
                                        <span wire:loading.remove  wire:target="file">Pilih File</span>
                                        <span wire:loading  wire:target="file" class="flex items-center gap-2">
                                            Mengunggah...
                                            <i class="fa-duotone fa-spinner-third animate-spin"></i>
                                        </span>
                                    </div>
                                </label>
                            @endif
                            @error('file')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex justify-center space-x-3">
                            <button wire:click="closeModal" @click="showModal = false" type="button" class="btn bg-gray-100 font-bold text-slate-800 hover:bg-gray-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                Batal
                            </button>
                            <button type="submit"  wi wire:loading.attr="disabled"re:target="import" class="btn bg-success hover:bg-success-focus font-bold text-white focus:bg-success-focus">
                                <span wire:loading.remove  wire:target="import" class="flex items-center gap-2">
                                    <i class="fa-solid fa-upload"></i>
                                    Impor
                                </span>
                                <span wire:loading  wire:target="import" class="flex items-center justify-center gap-2">
                                    Mengimpor...
                                    <i class="fa-duotone fa-spinner-third animate-spin text-white"></i>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
