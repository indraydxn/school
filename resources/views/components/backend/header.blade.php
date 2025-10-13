<nav class="header print:hidden">
    <div class="relative flex w-full bg-white header-container dark:bg-gray-900 print:hidden">
        <div class="flex items-center justify-between w-full">

            {{-- Sidebar Toggle --}}
            <button @click="$store.global.isSidebarExpanded = !$store.global.isSidebarExpanded" :class="$store.global.isSidebarExpanded && 'active'" class="menu-toggle cursor-pointer flex size-7 flex-col justify-center space-y-1.5 text-gray-400 hover:text-primary outline-hidden focus:outline-hidden">
                <i class="text-xl fa-jelly fa-regular fa-sidebar"></i>
            </button>

        </div>
        <div class="-mr-1.5 flex items-center space-x-2">

            {{-- Notification --}}
            <x-backend.header-notif />

        </div>
    </div>
</nav>
