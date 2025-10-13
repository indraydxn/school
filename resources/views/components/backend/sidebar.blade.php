<div class="sidebar print:hidden">
    <div class="sidebar-panel">
        <div class="flex flex-col h-full bg-white not-lg:border-gray-200 not-lg:border-r grow dark:bg-gray-900 not-lg:dark:border-gray-700">
            <div class="flex items-center justify-between w-full px-6 h-13">
    
                {{-- Logo --}}
                <div class="flex items-center gap-2">
                    <div class="hidden lg:flex">
                        <img alt="logo" src="{{ asset('logos/logo.svg') }}" class="size-5" />
                    </div>
                    <p class="text-2xl font-extrabold tracking-wider text-gray-800 line-clamp-1 dark:text-gray-50">
                        {{ config('app.name') }}
                    </p>
                </div>
    
                {{-- Sidebar Toggle --}}
                <button @click="$store.global.isSidebarExpanded = false" class="p-0 rounded-full lg:hidden btn size-7 text-primary hover:bg-gray-300/20 focus:bg-gray-300/20 active:bg-gray-300/25">
                    <i class="text-lg fa-jelly fa-regular fa-sidebar"></i>
                </button>
    
            </div>
            <div class="flex h-[calc(100%-4.5rem)] grow flex-col">
                <div class="overflow-y-auto is-scrollbar-hidden grow">
                    <div class="mt-6">
                        <ul class="space-y-1.5 px-6 lg:pl-6 lg:pr-3 font-inter text-xs-plus font-medium">
    
                            {{ $slot }}
    
                        </ul>
                    </div>
                </div>
                <div class="px-6 py-4 lg:pl-6 lg:pr-2">
                    <ul class="space-y-1.5 font-inter text-xs-plus font-medium">
    
                        {{-- Profile --}}
                        <x-backend.header-profile/>
    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
