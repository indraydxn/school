<div class="flex justify-center w-full">
    <main class="flex flex-col items-center w-full bg-white border border-gray-200 lg:m-10 dark:bg-gray-800 dark:border-gray-700 lg:rounded-2xl lg:max-w-md">
        <div class="flex flex-col justify-center w-full max-w-sm px-8 py-10 grow">
            <div class="flex flex-col items-center justify-center gap-4">

                {{-- Logo --}}
                <img alt="logo" class="size-20" src="{{ asset('logos/logo.svg') }}" />

                {{-- Header --}}
                <div class="text-center">
                    <h2 class="text-2xl font-extrabold tracking-wide text-gray-600 dark:text-gray-200">
                        Selamat Datang
                    </h2>
                    <p class="text-base tracking-wide text-gray-400">
                        Silahkan Masuk
                    </p>
                </div>

            </div>
            <form wire:submit="login" class="mt-10 space-y-3">

                {{-- Email --}}
                <div class=" flex flex-col gap-2">
                    <label class="relative flex">
                        <input type="email" wire:model="email" name="email" id="email" autocomplete="off" placeholder="Masukkan Email" required autofocus class="border-2 border-transparent text-base w-full px-4 py-2 font-medium rounded-lg placeholder:font-medium dark:text-gray-300 form-input peer bg-gray-100/50 pl-10 focus:border-primary placeholder:text-gray-400 dark:bg-gray-700/70 dark:border-gray-700/70 dark:focus:border-primary dark:placeholder:text-gray-500"/>
                        <span class="absolute flex items-center justify-center w-10 h-full text-gray-400 pointer-events-none peer-focus:text-primary dark:text-gray-500 dark:peer-focus:text-primary">
                            <i class="transition-colors duration-200 fa-jelly fa-envelope text-md"></i>
                        </span>
                    </label>
                    @error('email')
                    <span class="text-xs text-error dark:text-error font-medium">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class=" flex flex-col gap-2">
                    <label class="relative flex">
                        <input type="password" wire:model="password" name="password" id="password" autocomplete="off" placeholder="Masukkan Password" required class="border-2 border-transparent text-base w-full px-4 py-2 font-medium rounded-lg placeholder:font-medium dark:text-gray-300 form-input peer bg-gray-100/50 pl-10 focus:border-primary placeholder:text-gray-400 dark:bg-gray-700/70 dark:border-gray-700/70 dark:focus:border-primary dark:placeholder:text-gray-500" />
                        <span class="absolute flex items-center justify-center w-10 h-full text-gray-400 pointer-events-none peer-focus:text-primary dark:text-gray-500 dark:peer-focus:text-primary">
                            <i class="transition-colors duration-200 fa-jelly fa-key text-md"></i>
                        </span>
                        <button type="button" data-hs-toggle-password='{"target": "#password"}' class="absolute inset-y-0 z-20 flex items-center px-4 font-semibold text-gray-400 cursor-pointer dark:text-gray-500 end-0 rounded-e-md focus:outline-hidden focus:text-primary dark:focus:text-primary" >
                            <div class="transition-colors duration-200 text-md shrink-0">
                                <span class="hidden hs-password-active:block">
                                    <i class="fa-jelly fa-eye"></i>
                                </span>
                                <span class="hs-password-active:hidden">
                                    <i class="fa-jelly fa-eye-slash"></i>
                                </span>
                            </div>
                        </button>
                    </label>
                    @error('password')
                    <span class="text-xs text-error dark:text-error font-medium">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" wire:loading.attr="disabled" class="text-base flex items-center w-full h-10 mt-2 font-bold text-white btn bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-primary dark:hover:bg-primary-focus dark:focus:bg-primary-focus dark:active:bg-primary/90 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove>Masuk</span>
                    <span wire:loading class="flex items-center gap-2">
                        Memproses...
                        <i class="fa-duotone fa-spinner-third animate-spin"></i>
                    </span>
                </button>

            </form>
        </div>
        <div class="flex justify-center my-5 text-xs tracking-wide text-gray-400 dark:text-gray-300">
            <span>&copy;{{ date('Y') }} {{ config('app.name')}}</span>
        </div>
    </main>
</div>
