<div>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 space-y-4 lg:col-span-12">
            <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
                <div class="flex flex-col col-span-12">
                    <div class="min-w-full inline-block align-middle">
                        <div class="overflow-hidden space-y-3">

                            {{-- Form Card --}}
                            <div class="overflow-hidden card rounded-xl">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <div class="flex items-center gap-3">
                                        <div class="flex size-7 items-center justify-center rounded-lg bg-primary p-1 text-white dark:bg-accent-light/10 dark:text-accent-light">
                                            <i class="fa-solid text-xs-plus fa-user-edit"></i>
                                        </div>
                                        <h4 class="tracking-wider text-base font-bold text-slate-700 dark:text-navy-100">
                                            Edit Staff - {{ $staf->user->nama_lengkap }}
                                        </h4>
                                    </div>
                                </div>

                                <form wire:submit="update" wire:target='update' class="p-6">
                                    <div class="space-y-4">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                            {{-- Pilih Pengguna --}}
                                            <label class="block space-y-1 col-span-12" wire:ignore>
                                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Pilih Pengguna<p class="text-error">*</p></span>
                                                <select id="user_id" wire:model="user_id" x-init="$el._tom = new Tom($el,{sortField: {field: 'text'}, allowEmptyOption: true})" required class="w-full">
                                                    <option value="">- Pilih Pengguna -</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ $user->id == $user_id ? 'selected' : '' }}>{{ $user->nama_lengkap }} ({{ $user->email }})</option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                                            </label>

                                        </div>
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                            {{-- Tanggal Masuk --}}
                                            <label class="block space-y-1">
                                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Tanggal Masuk<p class="text-error">*</p></span>
                                                <input type="date" id="tanggal_masuk" wire:model="tanggal_masuk" required placeholder="Masukkan Tanggal Masuk" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                                                @error('tanggal_masuk')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                                            </label>

                                            {{-- Status Kepegawaian --}}
                                            <label class="block space-y-1">
                                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Status Kepegawaian<p class="text-error">*</p></span>
                                                <div class="grid grid-cols-2 gap-2">

                                                    {{-- PNS --}}
                                                    <label for="status-pns" class="flex gap-2 items-center px-3 py-2 w-full border border-gray-200 rounded-lg text-sm focus:border-primary focus:ring-primary has-checked:text-primary has-checked:bg-primary/10 has-checked:border-primary">
                                                        <input type="radio" wire:model.live="status_kepegawaian" name="status_kepegawaian" id="status-pns" value="PNS" required class="form-radio is-basic size-4 rounded-full border-gray-200 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary" {{ $status_kepegawaian == 'PNS' ? 'checked' : '' }}>
                                                        <span class="text-xs-plus tracking-wider">PNS</span>
                                                    </label>

                                                    {{-- Honorer --}}
                                                    <label for="status-honorer" class="flex gap-2 items-center px-3 py-2 w-full border border-slate-200 rounded-lg text-sm focus:border-secondary focus:ring-secondary has-checked:text-secondary has-checked:bg-secondary/10 has-checked:border-secondary">
                                                        <input type="radio" wire:model.live="status_kepegawaian" name="status_kepegawaian" id="status-honorer" value="NON-PNS" required class="form-radio is-basic size-4 rounded-full border-gray-200 checked:border-secondary checked:bg-secondary hover:border-secondary focus:border-secondary" {{ $status_kepegawaian == 'NON-PNS' ? 'checked' : '' }}>
                                                        <span class="text-xs-plus tracking-wider">Non PNS</span>
                                                    </label>

                                                </div>
                                                @error('status_kepegawaian')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                                            </label>

                                        </div>

                                        @if($status_kepegawaian == 'PNS')
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                            {{-- NIP --}}
                                            <label class="block space-y-1">
                                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">NIP<p class="text-error">*</p></span>
                                                <input type="text" id="nip" wire:model="nip" required placeholder="Masukkan NIP" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                                                @error('nip')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                                            </label>

                                            {{-- NUPTK --}}
                                            <label class="block space-y-1">
                                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">NUPTK<p class="text-error">*</p></span>
                                                <input type="text" id="nuptk" wire:model="nuptk" required placeholder="Masukkan NUPTK" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                                                @error('nuptk')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                                            </label>

                                        </div>
                                        @endif

                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                            {{-- Pendidikan Terakhir --}}
                                            <label class="block space-y-1">
                                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Pendidikan Terakhir<p class="text-error">*</p></span>
                                                <input type="text" id="pendidikan_terakhir" wire:model="pendidikan_terakhir" required placeholder="Masukkan Pendidikan Terakhir" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                                                @error('pendidikan_terakhir')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                                            </label>

                                            {{-- Jabatan --}}
                                            <label class="block space-y-1" wire:ignore>
                                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Jabatan<p class="text-error">*</p></span>
                                                <select id="jabatan_ids" wire:model="jabatan_ids" x-init="$el._tom = new Tom($el,{sortField: {field: 'text'}, allowEmptyOption: true, dropdownParent: 'body'})" multiple required class="w-full">
                                                    <option value="">- Pilih Jabatan -</option>
                                                    @foreach($jabatan as $jab)
                                                        <option value="{{ $jab->id }}" {{ in_array($jab->id, $jabatan_ids) ? 'selected' : '' }}>{{ $jab->nama_jabatan }}</option>
                                                    @endforeach
                                                </select>
                                                @error('jabatan_ids')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                                            </label>

                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end gap-3 mt-6">
                                        <a href="{{ route('admin.user.staff.index') }}" class="btn bg-gray-100 font-bold text-slate-800 hover:bg-gray-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                            Batal
                                        </a>
                                        <button type="submit" wire:loading.attr="disabled" wire:target='update' class="btn bg-success font-bold text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
                                            <span wire:loading.remove wire:target='update'>Simpan Perubahan</span>
                                            <span wire:loading wire:target='update' class="flex items-center justify-center gap-2">
                                                Memproses...
                                                <i class="fa-duotone fa-spinner-third animate-spin"></i>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
