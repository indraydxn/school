<div>
    <template x-teleport="#x-teleport-target">
        <div @keydown.window.escape="showModal = false" x-show="showModal" role="dialog" class="fixed inset-0 z-100 flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5" >
            <div @click="showModal = false" x-show="showModal" x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"></div>
            <div x-show="showModal" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]" x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave="easy-in" x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]" class="relative lg:w-[700px] w-sm rounded-xl bg-white transition-all duration-300">
                <div class="border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="flex size-7 items-center justify-center rounded-lg bg-primary p-1 text-white dark:bg-accent-light/10 dark:text-accent-light">
                            <i class="fa-solid text-xs-plus fa-user-plus"></i>
                        </div>
                        <h4 class="tracking-wider text-base font-bold text-slate-700 dark:text-navy-100">
                            Tambah Wali Siswa
                        </h4>
                    </div>
                </div>
                <form wire:submit="store" wire:target='store'>
                    <div class="space-y-4 px-6 py-4 overflow-hidden overflow-y-auto scrollbar-custom">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            {{-- Pilih Pengguna --}}
                            <label class="block space-y-1" wire:ignore>
                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Pilih Pengguna<p class="text-error">*</p></span>
                                <select id="user_id" wire:model="user_id" placeholder="- Pilih Pengguna -" x-init="$el._tom = new Tom($el,{sortField: {field: 'text'}, allowEmptyOption: true, dropdownParent: 'body'})" required class="w-full tracking-wide">
                                    <option value="">- Pilih Pengguna -</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nama_lengkap }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                                @error('user_id')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                            </label>

                            {{-- Pilih Siswa --}}
                            <label class="block space-y-1" wire:ignore>
                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Pilih Siswa<p class="text-error">*</p></span>
                                <select id="student_id" wire:model="student_id" placeholder="- Pilih Siswa -" x-init="$el._tom = new Tom($el,{sortField: {field: 'text'}, allowEmptyOption: true, dropdownParent: 'body'})" required class="w-full tracking-wide">
                                    <option value="">- Pilih Siswa -</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->user->nama_lengkap }} ({{ $student->nis }})</option>
                                    @endforeach
                                </select>
                                @error('student_id')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                            </label>

                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                            {{-- Hubungan --}}
                            <label class="block space-y-1">
                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Hubungan<p class="text-error">*</p></span>
                                <input type="text" id="hubungan" wire:model="hubungan" required placeholder="Masukkan Hubungan" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                                @error('hubungan')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                            </label>

                            {{-- Pendidikan Terakhir --}}
                            <label class="block space-y-1">
                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Pendidikan Terakhir<p class="text-error">*</p></span>
                                <input type="text" id="pendidikan_terakhir" wire:model="pendidikan_terakhir" required placeholder="Masukkan Pendidikan Terakhir" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                                @error('pendidikan_terakhir')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                            </label>

                            {{-- Pekerjaan --}}
                            <label class="block space-y-1">
                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Pekerjaan</span>
                                <input type="text" id="pekerjaan" wire:model="pekerjaan" placeholder="Masukkan Pekerjaan" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                                @error('pekerjaan')<p class="text-error text-xs tracking-wide mt-1">{{ $message }}</p>@enderror
                            </label>

                        </div>
                    </div>
                    <div class="border-t border-gray-200 px-6 py-4">
                        <div class="flex items-center justify-end gap-3">
                            <button @click="showModal = false; document.getElementById('user_id')._tom.clear(); document.getElementById('student_id')._tom.clear();" type="reset" class="btn bg-gray-100 font-bold text-slate-800 hover:bg-gray-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                Batal
                            </button>
                            <button type="submit" wire:loading.attr="disabled" wire:target='store' type="button" class="btn bg-success font-bold text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
                                <span wire:loading.remove wire:target='store'>Simpan</span>
                                <span wire:loading wire:target='store' class="flex items-center justify-center gap-2">
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
