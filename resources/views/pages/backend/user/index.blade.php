<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 space-y-4 lg:col-span-12">
        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="flex flex-col col-span-12">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden space-y-3">

                        {{-- Tile Page --}}
                        <x-backend.title-page title="Data Pengguna" :import="false"/>

                        {{-- Table Card --}}
                        <div class="overflow-hidden card rounded-xl">
                            <div class="ps-6 pe-4 py-3 border-b border-gray-200 lg:gap-2 gap-1">
                            </div>
                            <div class="overflow-x-auto is-scrollbar-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="divide-x divide-gray-200">
                                            <th scope="col" class="px-4 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-48">Nama Lengkap</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-56">Email</th>
                                            <th scope="col" class="px-4 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($users as $user)
                                        <tr class="divide-x divide-gray-200">

                                            {{-- Status --}}
                                            <td class="px-4 py-2 whitespace-nowrap tracking-wider text-center">
                                                <label class="flex items-center justify-center space-x-2">
                                                    <input type="checkbox" {{ $user->status ? 'checked' : '' }} wire:click="toggleStatus({{ $user->id }})" wire:loading.attr="disabled" class="form-switch h-5 w-10 rounded-full bg-gray-300 before:rounded-full before:bg-gray-50 checked:bg-primary checked:before:bg-white"/>
                                                </label>
                                            </td>

                                            {{-- Nama Lengkap --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500">
                                                {{ $user->nama_lengkap }}
                                            </td>

                                            {{-- Gender --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-center text-gray-500">
                                                @switch($user->jenis_kelamin)
                                                    @case($user->jenis_kelamin == "L" )
                                                        <span class="badge px-2 py-1 text-xs tracking-wider bg-info/10 text-info capitalize">
                                                            {{  $user->jenis_kelamin }}
                                                        </span>
                                                        @break
                                                    @default
                                                        <span class="badge px-2 py-1 text-xs tracking-wider bg-secondary/10 text-secondary capitalize">
                                                            {{  $user->jenis_kelamin }}
                                                        </span>
                                                @endswitch
                                            </td>

                                            {{-- Role --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-center">
                                                @foreach($user->getRoleNames() as $roleName)
                                                    @switch($roleName)
                                                        @case($roleName == 'admin')
                                                            <span class="badge px-2 py-1 text-xs tracking-wider border border-primary/20 text-primary capitalize">
                                                                {{ $roleName }}
                                                            </span>
                                                            @break
                                                        @case($roleName == 'guru')
                                                            <span class="badge px-2 py-1 text-xs tracking-wider border border-secondary/20 text-secondary capitalize">
                                                                {{ $roleName }}
                                                            </span>
                                                            @break
                                                        @case($roleName == 'siswa')
                                                            <span class="badge px-2 py-1 text-xs tracking-wider border border-success/20 text-success capitalize">
                                                                {{ $roleName }}
                                                            </span>
                                                            @break
                                                        @case($roleName == 'wali')
                                                            <span class="badge px-2 py-1 text-xs tracking-wider border border-error/20 text-error capitalize">
                                                                {{ $roleName }}
                                                            </span>
                                                            @break
                                                        @default
                                                        <span class="badge px-2 py-1 text-xs tracking-wider border border-gray-200/20 capitalize">
                                                            {{ $roleName }}
                                                        </span>
                                                    @endswitch
                                                @endforeach
                                            </td>

                                            {{-- Telepon --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500">
                                                {{ $user->telepon }}
                                            </td>

                                            {{-- Email --}}
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500">
                                                {{ $user->email }}
                                            </td>

                                            {{-- Actions --}}
                                            <td class="px-4 py-2 whitespace-nowrap font-medium">
                                                <x-backend.actions
                                                    :data="$user"
                                                    :name="$user->nama_lengkap"
                                                    :view="true"
                                                    :edit="true"
                                                    :delete="true"
                                                    urlView="{{  route('admin.user.index') }}"
                                                    urlEdit="{{  route('admin.user.index') }}"
                                                />
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                                <div class="flex flex-col items-center gap-2">
                                                    <i class="fa-regular fa-folder-open text-4xl"></i>
                                                    <span>Tidak ada data</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if($users->hasPages())
                                <x-pagination
                                    :paginator="$users"
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
