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

                                        {{-- Export --}}
                                        <div x-data="{showModal:false}" @close-modal.window="showModal = false">
                                            <button type="button" @click="showModal = true" class="lg:flex lg:items-center lg:gap-2 font-medium text-gray-500 border border-gray-200 px-3 py-2 rounded-lg bg-white hover:bg-gray-50 disabled:opacity-25">
                                                <i class="text-xs-plus fa-regular fa-down-to-bracket"></i>
                                                <span class="text-xs-plus tracking-wider hidden lg:block">Export</span>
                                            </button>
                                            <livewire:backend.role.export/>
                                        </div>

                                        {{-- Print --}}
                                        <a href="" target="_blank" rel="noopener"
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
                                            <livewire:backend.role.create/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x-auto is-scrollbar-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="divide-x divide-gray-200">
                                            <th scope="col" class="px-4 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Role</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider min-w-16">Nama Guard</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Akses</th>
                                            <th scope="col" class="px-4 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($roles as $index => $role)
                                        <tr class="divide-x divide-gray-200">

                                            {{-- Status --}}
                                            <td class="px-4 py-2 whitespace-nowrap tracking-wider text-center">
                                                <label class="flex items-center justify-center space-x-2">
                                                    <input type="checkbox" {{ $role->status ? 'checked' : '' }} wire:click="toggleStatus({{ $role->id }})" wire:loading.attr="disabled" class="form-switch h-5 w-10 rounded-full bg-gray-300 before:rounded-full before:bg-gray-50 checked:bg-primary checked:before:bg-white"/>
                                                </label>
                                            </td>

                                            {{-- Nama Role --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500 capitalize">
                                                {{ $role->name }}
                                            </td>

                                            {{-- Guard Name --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500 text-center">
                                                @switch($role->guard_name)
                                                    @case('web')
                                                        <span class="badge px-2 py-1 text-xs tracking-wider bg-primary/10 text-primary uppercase">
                                                            {{ $role->guard_name }}
                                                        </span>
                                                        @break
                                                    @case('api')
                                                        <span class="badge px-2 py-1 text-xs tracking-wider bg-secondary/10 text-secondary uppercase">
                                                            {{ $role->guard_name }}
                                                        </span>
                                                        @break
                                                    @default
                                                        <span class="badge px-2 py-1 text-xs tracking-wider bg-gray-500/10 text-gray-500 uppercase">
                                                            {{ $role->guard_name }}
                                                        </span>
                                                @endswitch
                                            </td>

                                            {{-- Permission --}}
                                            <td class="px-6 py-2 text-center whitespace-nowrap tracking-wider text-gray-500">
                                                {{ $role->permissions->count() }} akses
                                            </td>

                                            {{-- Actions --}}
                                            <td class="px-4 py-2 whitespace-nowrap font-medium">
                                                <x-backend.actions
                                                    :data="$role"
                                                    :name="$role->name"
                                                    :view="false"
                                                    :edit="true"
                                                    :delete="true"
                                                    urlEdit="{{ route('admin.role.edit', $role->id) }}"
                                                />
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="px-3 py-15 text-center text-gray-500">
                                                <div class="flex flex-col items-center gap-2">
                                                    <i class="fa-duotone fa-folder-open text-[50px]"></i>
                                                    <span class="text-medium tracking-wide text-base">Tidak ada data</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if($roles->hasPages())
                                <x-pagination
                                    :paginator="$roles"
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
