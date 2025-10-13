@props([
    'paginator' => null,
    'showInfo' => true
])

{{-- Cek apakah paginator ada dan memiliki halaman --}}
@if($paginator && $paginator->hasPages())
    <div class="flex items-center lg:justify-between px-4.5 py-3 border-t border-gray-200 dark:border-navy-500 gap-2 not-lg:space-y-2">

        {{-- Menampilkan info jumlah data yang ditampilkan --}}
        @if($showInfo)
            <div class="text-sm text-gray-500 dark:text-navy-300 hidden lg:block">
                Menampilkan {{ $paginator->firstItem() ?? 0 }} - {{ $paginator->lastItem() ?? 0 }} dari {{ $paginator->total() }} data
            </div>
        @endif
        
        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="not-lg:w-full">
            <div class="flex justify-between items-center w-full space-x-1.5">
                
                {{-- Tombol halaman sebelumnya --}}
                @if ($paginator->onFirstPage())
                    <span class="text-gray-400 border border-gray-200 dark:border-navy-500 dark:text-navy-400 rounded-lg h-8 min-w-[2rem] flex items-center justify-center opacity-50 cursor-not-allowed">
                        <i class="text-base fa-light fa-angle-left"></i>
                    </span>
                @else
                    <button wire:click="previousPage" 
                       aria-label="{{ __('pagination.previous') }}"
                       class="text-gray-500 border border-gray-200 dark:border-navy-500 dark:text-navy-100 hover:bg-gray-200/50 dark:hover:bg-gray-600/50 rounded-lg h-8 min-w-[2rem] flex items-center justify-center">
                        <i class="text-base fa-light fa-angle-left"></i>
                    </button>
                @endif

                {{-- Daftar halaman pagination --}}
                <ol class="pagination space-x-1.5 flex items-center justify-center">
                    @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- Halaman aktif --}}
                            <li>
                                <span class="bg-primary text-white border border-primary rounded-lg h-8 min-w-[2rem] flex items-center justify-center font-medium"
                                      aria-current="page">{{ $page }}</span>
                            </li>
                        @else
                            {{-- Tampilkan halaman pertama, terakhir, dan 2 halaman sebelum/sesudah halaman aktif --}}
                            @if ($page == 1 || $page == $paginator->lastPage() || ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2))
                                <li>
                                    <button wire:click="gotoPage({{ $page }})" 
                                       class="text-gray-500 border border-gray-200 dark:border-navy-500 dark:text-navy-100 hover:bg-gray-200/50 dark:hover:bg-gray-600/50 rounded-lg h-8 min-w-[2rem] flex items-center justify-center"
                                       aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</button>
                                </li>
                            {{-- Tampilkan titik-titik jika ada halaman yang dilewati --}}
                            @elseif ($page == 2 || $page == $paginator->lastPage() - 1)
                                <li>
                                    <span class="text-gray-500 border border-gray-200 dark:border-navy-500 dark:text-navy-100 rounded-lg h-8 min-w-[2rem] flex items-center justify-center">...</span>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ol>

                {{-- Tombol halaman selanjutnya --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" 
                       aria-label="{{ __('pagination.next') }}"
                       class="text-gray-500 border border-gray-200 dark:border-navy-500 dark:text-navy-100 hover:bg-gray-200/50 dark:hover:bg-gray-600/50 rounded-lg h-8 min-w-[2rem] flex items-center justify-center">
                        <i class="text-base fa-light fa-angle-right"></i>
                    </button>
                @else
                    <span class="text-gray-400 border border-gray-200 dark:border-navy-500 dark:text-navy-400 rounded-lg h-8 min-w-[2rem] flex items-center justify-center opacity-50 cursor-not-allowed">
                        <i class="text-base fa-light fa-angle-right"></i>
                    </span>
                @endif

            </div>
        </nav>

    </div>
    
{{-- Jika hanya ingin menampilkan info jumlah data tanpa pagination --}}
@elseif($showInfo && $paginator)
    <div class="flex items-center justify-between px-4.5 py-3 border-t border-gray-200 dark:border-navy-500">
        <div class="text-sm text-gray-500 dark:text-navy-300">
            Menampilkan {{ $paginator->total() }} data
        </div>
    </div>
@endif

