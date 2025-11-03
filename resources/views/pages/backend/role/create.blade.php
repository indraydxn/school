<div>
    <template x-teleport="#x-teleport-target">
        <div @keydown.window.escape="showModal = false" x-show="showModal" role="dialog" class="fixed inset-0 z-100 flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5" >
            <div @click="showModal = false" x-show="showModal" x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"></div>
            <div x-show="showModal" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]" x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave="easy-in" x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]" class="relative lg:w-[700px] w-sm rounded-xl bg-white transition-all duration-300">
                <div class="border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="flex size-7 items-center justify-center rounded-lg bg-primary p-1 text-white dark:bg-accent-light/10 dark:text-accent-light">
                            <i class="fa-solid text-xs-plus fa-shield-plus"></i>
                        </div>
                        <h4 class="tracking-wider text-base font-bold text-slate-700 dark:text-navy-100">
                            Tambah Role
                        </h4>
                    </div>
                </div>
                <form wire:submit="store" wire:target="store">
                    <div class="space-y-4 px-6 py-4 h-[400px] overflow-hidden overflow-y-auto scrollbar-custom">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            {{-- Nama Role --}}
                            <label class="block space-y-1">
                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Nama Role<p class="text-error">*</p></span>
                                <input type="text" id="name" wire:model="name" required placeholder="Masukkan nama role" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                                @error('name')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                            </label>

                            {{-- Guard Name --}}
                            <label class="block space-y-1" wire:ignore>
                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Guard Name<p class="text-error">*</p></span>
                                <select id="guard_name" wire:model="guard_name" placeholder="- Pilih Guard -" x-init="$el._tom = new Tom($el,{sortField: {field: 'text'}, allowEmptyOption: true, dropdownParent: 'body'})" required class="w-full tracking-wide">
                                    <option value="web" selected>Web</option>
                                    <option value="api">API</option>
                                </select>
                                @error('guard_name')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                            </label>

                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            {{-- Status --}}
                            <label class="block space-y-1 col-span-12">
                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Status<p class="text-error">*</p></span>
                                <div class="grid grid-cols-2 gap-2">

                                    {{-- Aktif --}}
                                    <label for="status-aktif" class="flex gap-2 items-center px-3 py-2 w-full border border-gray-200 rounded-lg text-sm focus:border-success focus:ring-success has-checked:text-success has-checked:bg-success/10 has-checked:border-success">
                                        <input type="radio" wire:model="status" name="status" id="aktif" value="1" required class="form-radio is-basic size-4 rounded-full border-gray-200 checked:border-success checked:bg-success hover:border-success focus:border-success">
                                        <span class="text-xs-plus tracking-wider">Aktif</span>
                                    </label>

                                    {{-- Non Aktif --}}
                                    <label for="status-nonaktif" class="flex gap-2 items-center px-3 py-2 w-full border border-slate-200 rounded-lg text-sm focus:border-error focus:ring-error has-checked:text-error has-checked:bg-error/10 has-checked:border-error">
                                        <input type="radio" wire:model="status" name="status" id="non-aktif" value="0" required class="form-radio is-basic size-4 rounded-full border-gray-200 checked:border-error checked:bg-error hover:border-error focus:border-error">
                                        <span class="text-xs-plus tracking-wider">Non Aktif</span>
                                    </label>

                                </div>
                            </label>

                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            {{-- Akses --}}
                            <label class="block space-y-1 col-span-12">
                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Akses</span>
                                <div class="grid grid-cols-1 gap-4">
                                    @php
                                        $groupedPermissions = $allPermissions->groupBy('module.name');
                                    @endphp
                                    @foreach($groupedPermissions as $moduleName => $permissions)
                                        <div class="space-y-2 border rounded-lg p-4">
                                            <div class="flex items-center justify-between">
                                                <h5 class="font-bold tracking-wider uppercase text-gray-700">{{ $moduleName }}</h5>
                                                <label class="flex items-center gap-2 px-3 py-2 border border-gray-200 rounded-lg text-sm hover:border-primary has-checked:text-primary has-checked:bg-primary/10 has-checked:border-primary">
                                                    <input type="checkbox" wire:click="toggleModule('{{ $moduleName }}')" {{ count(array_intersect($permissions->pluck('id')->toArray(), $this->permissions ?? [])) === $permissions->count() ? 'checked' : '' }} class="form-checkbox is-basic size-4 rounded border-gray-200 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary">
                                                    <span class="tracking-wider">Pilih Semua</span>
                                                </label>
                                            </div>
                                            <div class="grid grid-cols-3 gap-2">
                                                @foreach($permissions as $permission)
                                                    <label class="flex items-center gap-2 px-3 py-2 border border-gray-200 rounded-lg text-sm hover:border-primary has-checked:text-primary has-checked:bg-primary/10 has-checked:border-primary">
                                                        <input type="checkbox" wire:model="permissions" value="{{ $permission->id }}" class="form-checkbox is-basic size-4 rounded border-gray-200 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary">
                                                        <span class="text-xs-plus tracking-wider">{{ ucfirst($permission->action->name) }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('permissions')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                            </label>

                        </div>
                    </div>
                    <div class="border-t border-gray-200 px-6 py-4">
                        <div class="flex items-center justify-end gap-3">
                            <button @click="showModal = false" type="reset" class="btn bg-gray-100 font-bold text-slate-800 hover:bg-gray-200 focus:bg-gray-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                Batal
                            </button>
                            <button type="submit" wire:target="store" wire:loading.attr="disabled" type="button" class="btn bg-success font-bold text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
                                <span wire:loading.remove wire:target="store">Simpan</span>
                                <span wire:loading wire:target="store" class="flex items-center justify-center gap-2">
                                    Memproses...
                                    <i class="fa-duotone fa-spinner-third animate-spin"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
