<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 space-y-4 lg:col-span-12">
        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="flex flex-col col-span-12">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden space-y-3">

                        <label class="relative flex lg:hidden">
                            <input type="text" placeholder="Cari..." wire:model.live="search" class="text-xs-plus tracking-wide form-input peer w-full rounded-lg bg-white border border-gray-200 px-3 py-2 pl-9 pr-9 placeholder:text-gray-400/70 focus:border-primary"/>
                            <div class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                <i class="fa-regular fa-magnifying-glass text-xs-plus transition-colors duration-200"></i>
                            </div>
                            <div wire:loading wire:target="search">
                                <div class="absolute inset-y-0 z-20 flex h-full items-center justify-center px-4 font-semibold text-gray-400 cursor-pointer dark:text-gray-500 end-0 rounded-e-md focus:outline-hidden focus:text-primary">
                                    <div class="transition-colors duration-200 shrink-0">
                                        <i class="fa-duotone fa-spinner-third animate-spin text-xs-plus text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </label>

                        {{-- Table Card --}}
                        <div class="overflow-hidden card rounded-xl">
                            <div class="px-4 py-3 border-b border-gray-200 lg:gap-2 gap-1">
                                <div class="flex items-center justify-between lg:gap-2 gap-1">
                                    <div class="flex items-center lg:gap-2 gap-1">

                                        {{-- Import --}}
                                        {{-- <button class="lg:flex lg:items-center lg:gap-2 font-medium text-gray-500 border border-gray-200 px-3 py-2 rounded-lg bg-white hover:bg-gray-50 disabled:opacity-25">
                                            <i class="text-xs-plus fa-regular fa-up-from-bracket"></i>
                                            <span class="text-xs-plus tracking-wider hidden lg:block">Import</span>
                                        </button> --}}

                                        {{-- Export --}}
                                        <div x-data="{showModal:false}" @close-modal.window="showModal = false">
                                            <button type="button" @click="showModal = true" class="lg:flex lg:items-center lg:gap-2 font-medium text-gray-500 border border-gray-200 px-3 py-2 rounded-lg bg-white hover:bg-gray-50 disabled:opacity-25">
                                                <i class="text-xs-plus fa-regular fa-down-to-bracket"></i>
                                                <span class="text-xs-plus tracking-wider hidden lg:block">Export</span>
                                            </button>
                                            <livewire:backend.staff.export/>
                                        </div>

                                        {{-- Print --}}
                                        <a href="{{ route('admin.user.staff.print') }}" target="_blank" rel="noopener"
                                           class="lg:flex lg:items-center lg:gap-2 font-medium text-gray-500 border border-gray-200 px-3 py-2 rounded-lg bg-white hover:bg-gray-50 disabled:opacity-25">
                                            <i class="text-xs-plus fa-regular fa-print"></i>
                                            <span class="text-xs-plus tracking-wider hidden lg:block">Print</span>
                                        </a>

                                    </div>
                                    <div class="flex items-center lg:gap-2 gap-1">

                                        {{-- Cari --}}
                                        <label class="relative lg:flex hidden">
                                            <input type="text" placeholder="Cari..." wire:model.live="search" class="text-xs-plus tracking-wide form-input peer w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 pl-9 pr-9 placeholder:text-gray-400/70 focus:border-primary"/>
                                            <div class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                <i class="fa-regular fa-magnifying-glass text-xs-plus transition-colors duration-200"></i>
                                            </div>
                                            <div wire:loading wire:target="search">
                                                <div class="absolute inset-y-0 z-20 flex h-full items-center justify-center px-4 font-semibold text-gray-400 cursor-pointer dark:text-gray-500 end-0 rounded-e-md focus:outline-hidden focus:text-primary">
                                                    <div class="transition-colors duration-200 shrink-0">
                                                        <i class="fa-duotone fa-spinner-third animate-spin text-xs-plus text-gray-400"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>

                                        {{-- Tambah --}}
                                        <div x-data="{showModal:false}" @close-modal.window="showModal = false">
                                            <button type="button" @click="showModal = true" class="lg:flex lg:items-center lg:gap-2 font-semibold text-white px-3 py-2 rounded-lg bg-primary hover:bg-primary-focus disabled:opacity-25">
                                                <i class="text-xs-plus fa-regular fa-plus"></i>
                                                <span class="text-xs-plus tracking-wider hidden lg:block">Tambah</span>
                                            </button>
                                            <livewire:backend.staff.create/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x-auto is-scrollbar-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="divide-x divide-gray-200">
                                            <th scope="col" class="px-4 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Staf</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-48">Nama Lengkap</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kepegawaian</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                            <th scope="col" class="px-4 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($staff as $staf)
                                        <tr class="divide-x divide-gray-200">

                                            {{-- Status --}}
                                            <td class="px-4 py-2 whitespace-nowrap tracking-wider text-center">
                                                <label class="flex items-center justify-center space-x-2">
                                                    <input type="checkbox" {{ $staf->user->status ? 'checked' : '' }} wire:click="toggleStatus({{ $staf->user->id }})" wire:loading.attr="disabled" class="form-switch h-5 w-10 rounded-full bg-gray-300 before:rounded-full before:bg-gray-50 checked:bg-primary checked:before:bg-white"/>
                                                </label>
                                            </td>

                                            {{-- No Staf --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500">
                                                {{ $staf->no_staf }}
                                            </td>

                                            {{-- Nama Lengkap --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500">
                                                {{ $staf->user->nama_lengkap }}
                                            </td>

                                            {{-- Status Kepegawaian --}}
                                            <td class="px-6 py-2 whitespace-nowrap text-center tracking-wider text-gray-500">
                                                @switch($staf->status_kepegawaian)
                                                    @case('PNS')
                                                        <span class="badge px-2 py-1 text-xs tracking-wider bg-success/10 text-success capitalize">
                                                            {{ $staf->status_kepegawaian }}
                                                        </span>
                                                        @break
                                                    @default
                                                        <span class="badge px-2 py-1 text-xs tracking-wider bg-secondary/10 text-secondary capitalize">
                                                            {{ $staf->status_kepegawaian }}
                                                        </span>
                                                @endswitch
                                            </td>

                                            {{-- Jabatan --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500">
                                                @if($staf->jabatan->count() > 0)
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach($staf->jabatan as $jabatan)
                                                            <span class="badge px-2 py-1 text-xs tracking-wider border border-gray-200 capitalize">
                                                                {{ $jabatan->nama_jabatan }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            {{-- Actions --}}
                                            <td class="px-4 py-2 whitespace-nowrap font-medium">
                                                <x-backend.actions
                                                    :data="$staf"
                                                    :name="$staf->user->nama_lengkap"
                                                    :view="false"
                                                    :edit="true"
                                                    :delete="true"
                                                    urlEdit="{{ route('admin.user.staff.edit', $staf->id) }}"
                                                />
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="px-3 py-8 text-center text-gray-500">
                                                <div class="flex flex-col items-center gap-2">
                                                    <i class="fa-duotone fa-folder-open text-4xl"></i>
                                                    <span>Tidak ada data</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if($staff->hasPages())
                                <x-pagination
                                    :paginator="$staff"
                                    :showInfo="true"
                                    :showSelect="true"
                                    :perPage="$perPage"
                                />
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
