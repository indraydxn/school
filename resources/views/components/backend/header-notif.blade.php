<div x-effect="if($store.global.isSearchbarActive) isShowPopper = false" x-data="usePopper({ placement: 'bottom-end', offset: 12 })"  @click.outside="if(isShowPopper) isShowPopper = false" class="flex" >

    {{-- Toggle --}}
    <button  x-ref="popperRef" @click="isShowPopper = !isShowPopper" class="relative p-0 rounded-full btn size-8 hover:bg-gray-100/50 hover:text-gray-800 focus:bg-gray-100/50 focus:text-gray-80">
        <i class="text-lg text-slate-500 dark:text-navy-100 fa-jelly fa-bell"></i>
        {{-- <span class="absolute flex items-center justify-center -top-px -right-px size-3">
            <span class="absolute inline-flex w-full h-full rounded-full animate-ping bg-secondary opacity-80"></span>
            <span class="inline-flex rounded-full size-2 bg-secondary"></span>
        </span> --}}
    </button>

    {{-- Content --}}
    <div :class="isShowPopper && 'show'" class="popper-root" x-ref="popperRoot">
        <div x-data="{ activeTab: 'tabBelumBaca' }" class="popper-box lg:m-2 m-0 flex max-h-[calc(100vh-6rem)] w-[calc(100vw-2rem)] flex-col rounded-xl shadow-soft border border-slate-150 bg-white dark:border-gray-800 dark:bg-navy-700 sm:w-80">
            <div class="rounded-t-lg">
                <div class="flex items-center justify-between px-4 py-2">
                    <div class="flex items-center space-x-2">
                        <h3 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">Pemberitahuan</h3>
                        <div class="badge h-5 rounded-full bg-primary/10 px-1.5 text-primary dark:bg-accent-light/15 dark:text-accent-light">99+</div>
                    </div>
                    <button class="btn -mr-1.5 size-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <i class="fa-light fa-gear"></i>
                    </button>
                </div>
                <div class="flex gap-1 overflow-x-auto is-scrollbar-hidden shrink-0 bg-slate-100 dark:bg-navy-800 rounded-lg p-1.5 mx-3">

                    {{-- Belum Baca --}}
                    <button  @click="activeTab = 'tabBelumBaca'" class="flex-1 px-2 py-1 text-sm font-bold btn shrink-0" :class="activeTab === 'tabBelumBaca' ? 'bg-primary text-white' : 'hover:text-primary'" >
                        <span>Belum Baca</span>
                    </button>

                    {{-- Semua --}}
                    <button @click="activeTab = 'tabAll'" class="flex-1 px-2 py-1 text-sm font-bold btn shrink-0" :class="activeTab === 'tabAll' ? 'bg-primary text-white' : 'hover:text-primary'" >
                        <span>Semua</span>
                    </button>

                </div>
            </div>
            <div class="flex flex-col overflow-hidden h-80">

                {{-- Belum  Baca --}}
                <div x-show="activeTab === 'tabBelumBaca'" x-transition:enter="transition-all duration-300 easy-in-out" x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]" x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" class="px-4 py-4 space-y-4 overflow-y-auto is-scrollbar-hidden h-full">
                    <div class="flex items-center justify-center h-full">
                        <div class="p-4 text-center flex-1">
                            <i class="text-4xl text-gray-500 dark:text-gray-400 fa-jelly fa-regular fa-bell"></i>
                            <h4 class="pt-6 tracking-wide font-bold text-base text-gray-500 dark:text-gray-400">Tidak ada notifikasi</h4>
                            <p class="pb-6 text-xs tracking-wide font-semibold text-gray-400 dark:text-gray-300">Semua notifikasi sudah Anda baca.</p>
                        </div>
                    </div>
                </div>

                {{-- Semua --}}
                <div x-show="activeTab === 'tabAll'" x-transition:enter="transition-all duration-300 easy-in-out" x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]" x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" class="px-4 py-4 space-y-4 overflow-y-auto is-scrollbar-hidden h-full">
                    <div class="flex items-center justify-center h-full">
                        <div class="p-4 text-center flex-1">
                            <i class="text-4xl text-gray-500 dark:text-gray-400 fa-jelly fa-regular fa-bell"></i>
                            <h4 class="pt-6 font-bold text-base tracking-wide text-gray-500 dark:text-gray-400">Tidak ada notifikasi</h4>
                            <p class="pb-6 text-xs font-semibold tracking-wide text-gray-400 dark:text-gray-300">Belum ada notifikasi</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- / Content --}}
    
</div>