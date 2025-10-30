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
                                            Edit Wali Siswa - {{ $siswa->user->nama_lengkap }}
                                        </h4>
                                    </div>
                                </div>
                                <form wire:submit="store" wire:target='store'>
                                    <div class="space-y-4 px-6 py-4 overflow-hidden overflow-y-auto scrollbar-custom">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                            {{-- Pilih Pengguna --}}
                                            <label class="block space-y-1" wire:ignore>
                                                <span class="flex items-center gap-0.5 tracking-wide font-semibold">Pilih Pengguna<p class="text-error">*</p></span>
                                                <select id="user_id" wire:model="user_id" placeholder="- Pilih Pengguna -" disabled x-init="$el._tom = new Tom($el,{sortField: {field: 'text'}, allowEmptyOption: true, dropdownParent: 'body'})" required class="w-full tracking-wide">
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
                                            <a href="{{ route('admin.user.parent.index') }}" class="btn bg-gray-100 font-bold text-slate-800 hover:bg-gray-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                                Batal
                                            </a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
