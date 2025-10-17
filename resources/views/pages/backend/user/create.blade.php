<template x-teleport="#x-teleport-target">
    <div @keydown.window.escape="showModal = false" x-show="showModal" role="dialog" class="fixed inset-0 z-100 flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5" >
        <div @click="showModal = false" x-show="showModal" x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"></div>
        <div x-show="showModal" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]" x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave="easy-in" x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]" class="relative lg:w-[700px] w-md rounded-xl bg-white transition-all duration-300">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex size-7 items-center justify-center rounded-lg bg-primary p-1 text-white dark:bg-accent-light/10 dark:text-accent-light">
                        <i class="fa-solid text-xs-plus fa-user-plus"></i>
                    </div>
                    <h4 class="tracking-wider text-base font-bold text-slate-700 dark:text-navy-100">
                        Tambah Pengguna
                    </h4>
                </div>
            </div>
            <form wire:submit="store">
                <div class="space-y-4 px-6 py-4 h-[400px] overflow-hidden overflow-y-auto">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                        {{-- Nama Lengkap --}}
                        <label class="block space-y-1 col-span-2">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Nama Lengkap<p class="text-error">*</p></span>
                            <input type="text" id="nama_lengkap" wire:model="nama_lengkap" required placeholder="Masukkan nama" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                            @error('nama_lengkap')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                        {{-- Role --}}
                        <label class="block space-y-1">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Role<p class="text-error">*</p></span>
                            <select id="role" wire:model="role" required class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary">
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>
                                <option value="wali">Wali</option>
                            </select>
                            @error('role')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        {{-- NIK --}}
                        <label class="block space-y-1">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">NIK<p class="text-error">*</p></span>
                            <input type="number" id="nik" wire:model="nik" required placeholder="Masukkan NIK" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                            @error('nik')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                        {{-- No KK --}}
                        <label class="block space-y-1">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Nomor KK</span>
                            <input type="number" id="no_kk" wire:model="no_kk" placeholder="Masukkan Nomor KK" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                            @error('no_kk')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        {{-- Telepon --}}
                        <label class="block space-y-1">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Telepon<p class="text-error">*</p></span>
                            <input type="number" id="telepon" wire:model="telepon" required placeholder="Masukkan Telepon" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                            @error('telepon')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                        {{-- Email --}}
                        <label class="block space-y-1">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Email<p class="text-error">*</p></span>
                            <input type="email" id="email" wire:model="email" required placeholder="Masukkan Email" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                            @error('email')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        {{-- Tempat Lahir --}}
                        <label class="block space-y-1">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Tempat Lahir<p class="text-error">*</p></span>
                            <input type="text" id="tempat_lahir" wire:model="tempat_lahir" required placeholder="Masukkan Tempat Lahir" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                            @error('tempat_lahir')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                        {{-- Tangal Lahir --}}
                        <label class="block space-y-1">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Tanggal Lahir<p class="text-error">*</p></span>
                            <input type="date" id="tanggal_lahir" wire:model="tanggal_lahir" required placeholder="Masukkan Tanggal Lahir" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"/>
                            @error('tanggal_lahir')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        {{-- Jenis Kelamin --}}
                        <label class="block space-y-1">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Jenis Kelamin<p class="text-error">*</p></span>
                            <div class="grid grid-cols-2 gap-2">

                                {{-- Laki-laki --}}
                                <label for="jenis-kelamin-l" class="flex gap-2 items-center px-3 py-2 w-full border border-gray-200 rounded-lg text-sm focus:border-primary focus:ring-primary  has-[:checked]:text-primary has-[:checked]:bg-primary/10 has-[:checked]:border-primary">
                                    <input type="radio" wire:model="jenis_kelamin" id="laki-laki" value="L" required class="form-radio is-basic size-4 rounded-full border-gray-200 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary">
                                    <span class="text-xs tracking-wider">Laki-Laki</span>
                                </label>

                                {{-- Perempuan --}}
                                <label for="jenis-kelamin-p" class="flex gap-2 items-center px-3 py-2 w-full border border-slate-200 rounded-lg text-sm focus:border-secondary focus:ring-secondary has-[:checked]:text-secondary has-[:checked]:bg-secondary/10 has-[:checked]:border-secondary">
                                    <input type="radio" wire:model="jenis_kelamin" id="perempuan" value="P" required class="form-radio is-basic size-4 rounded-full border-gray-200 checked:border-secondary checked:bg-secondary hover:border-secondary focus:border-secondary">
                                    <span class="text-xs tracking-wider">Perempuan</span>
                                </label>

                            </div>
                            @error('jenis_kelamin')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                        {{-- Status --}}
                        <label class="block space-y-1">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Status<p class="text-error">*</p></span>
                            <div class="grid grid-cols-2 gap-2">

                                {{-- Aktif --}}
                                <label for="status-aktif" class="flex gap-2 items-center px-3 py-2 w-full border border-gray-200 rounded-lg text-sm focus:border-success focus:ring-success  has-[:checked]:text-success has-[:checked]:bg-success/10 has-[:checked]:border-success">
                                    <input type="radio" wire:model="status" id="aktif" value="1" required class="form-radio is-basic size-4 rounded-full border-gray-200 checked:border-success checked:bg-success hover:border-success focus:border-success">
                                    <span class="text-xs tracking-wider">Aktif</span>
                                </label>

                                {{-- Non Aktif --}}
                                <label for="status-nonaktif" class="flex gap-2 items-center px-3 py-2 w-full border border-slate-200 rounded-lg text-sm focus:border-error focus:ring-error has-[:checked]:text-error has-[:checked]:bg-error/10 has-[:checked]:border-error">
                                    <input type="radio" wire:model="status" id="non-akitf" value="0" required class="form-radio is-basic size-4 rounded-full border-gray-200 checked:border-error checked:bg-error hover:border-error focus:border-error">
                                    <span class="text-xs tracking-wider">Non Aktif</span>
                                </label>

                            </div>
                            @error('status')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        {{-- Alamat --}}
                        <label class="block space-y-1 col-span-12">
                            <span class="flex items-center gap-0.5 tracking-wide font-semibold">Alamat<p class="text-error">*</p></span>
                            <textarea id="alamat" wire:model="alamat" required placeholder="Masukkan Alamat" autocomplete="off" class="form-input tracking-wide w-full rounded-lg border border-gray-200 bg-transparent px-3 py-2 placeholder:text-gray-400/70 hover:border-gray-400 focus:border-primary"></textarea>
                            @error('alamat')<p class="text-error mt-1">{{ $message }}</p>@enderror
                        </label>

                    </div>
                </div>
                <div class="border-t border-gray-200 px-6 py-4">
                    <div class="flex items-center justify-end gap-3">
                        <button @click="showModal = false" type="button" class="btn bg-gray-100 font-bold text-slate-800 hover:bg-gray-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" type="button" class="btn bg-success font-bold text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
                            <span wire:loading.remove>Simpan</span>
                            <span wire:loading class="flex items-center justify-center gap-2">
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
