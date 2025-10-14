@if($paginator && $paginator->hasPages())
    <div class="flex items-center lg:justify-between px-6 py-3 border-t border-gray-200 gap-2 not-lg:space-y-2">
        @if ($showSelect) 
        <div class="items-center space-x-2 hidden lg:flex">
            <select wire:model.live="perPage" class="form-select h-7 ps-3 text-xs w-12 rounded-lg space-x-2 border border-gray-200 font-medium cursor:pointer">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
        @endif
        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="not-lg:w-full">
            <div class="flex justify-between items-center w-full space-x-1.5 bg-gray-100 rounded-lg p-1">
                @if ($paginator->onFirstPage())
                    <span class="text-gray-400 bg-white font-bold rounded-lg size-7 text-xs flex items-center justify-center opacity-80 cursor-not-allowed">
                        <i class="text-base fa-regular fa-angle-left"></i>
                    </span>
                @else
                    <button wire:click="previousPage" aria-label="{{ __('pagination.previous') }}" class="text-gray-500 font-bold bg-white hover:bg-white/50 rounded-lg size-7 text-xs flex items-center justify-center">
                        <i class="text-base fa-regular fa-angle-left"></i>
                    </button>
                @endif
                <ol class="pagination space-x-1.5 flex items-center justify-center">
                    @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span aria-current="page" class="bg-primary text-white rounded-lg size-7 text-xs flex items-center justify-center">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            @if ($page == 1 || $page == $paginator->lastPage() || ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2))
                                <li>
                                    <button wire:click="gotoPage({{ $page }})" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="text-gray-500 bg-white font-bold hover:bg-white/50 rounded-lg size-7 text-xs flex items-center justify-center">
                                        {{ $page }}
                                    </button>
                                </li>
                            @elseif ($page == 1 || $page == $paginator->lastPage() - 1)
                                <li>
                                    <span class="text-gray-500 font-bold rounded-lg size-7 text-xs flex items-center justify-center">
                                        ...
                                    </span>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ol>
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" aria-label="{{ __('pagination.next') }}" class="text-gray-500 font-bold bg-white hover:bg-white/50 rounded-lg size-7 text-xs flex items-center justify-center">
                        <i class="text-base fa-regular fa-angle-right"></i>
                    </button>
                @else
                    <span class="text-gray-400 bg-white font-bold rounded-lg size-7 text-xs flex items-center justify-center opacity-80 cursor-not-allowed">
                        <i class="text-base fa-regular fa-angle-right"></i>
                    </span>
                @endif
            </div>
        </nav>
        @if($showInfo)
            <div class="text-xs-plus text-gray-500 font-medium dark:text-navy-300 hidden lg:block tracking-wide">
                {{ $paginator->firstItem() ?? 0 }} - {{ $paginator->lastItem() ?? 0 }} dari {{ $paginator->total() }} data
            </div>
        @endif
    </div>
@elseif($showInfo && $paginator)
    <div class="flex items-center justify-between px-4.5 py-3 border-t border-gray-200">
        <div class="text-sm text-gray-500 font-bold dark:text-navy-300">
            Menampilkan {{ $paginator->total() }} data
        </div>
    </div>
@endif

