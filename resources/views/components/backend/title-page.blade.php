<div class="flex items-center justify-between">
    <div class="flex items-center lg:gap-2 gap-1">

        {{-- Title Page --}}
        <h2 class="text-xl font-bold text-slate-800 tracking-wide">
            {{ $title }}
        </h2>

    </div>
    <div class="flex items-center lg:gap-2 gap-1">

        {{-- Import --}}
        <button class="lg:flex lg:items-center lg:gap-2 px-3 py-2 font-medium text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
            <i class="text-xs fa-regular fa-up-from-bracket"></i>
            <span class="text-xs tracking-wide hidden lg:block">Import</span>
        </button>

        {{-- Export --}}
        <button class="lg:flex lg:items-center lg:gap-2 px-3 py-2 font-medium text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
            <i class="text-xs fa-regular fa-down-to-bracket"></i>
            <span class="text-xs tracking-wide hidden lg:block">Export</span>
        </button>

        {{-- Print --}}
        <button class="lg:flex lg:items-center lg:gap-2 px-3 py-2 font-medium text-gray-500 border border-gray-200 btn bg-white hover:bg-gray-50 disabled:opacity-25">
            <i class="text-xs fa-regular fa-print"></i>
            <span class="text-xs tracking-wide hidden lg:block">Print</span>
        </button>
        
    </div>
</div>