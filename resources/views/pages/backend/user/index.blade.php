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
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="">
                                        <tr class="divide-x divide-gray-200">
                                            <th scope="col" class="px-4 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                            <th scope="col" class="px-6 py-2 whitespace-nowrap text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($users as $user)
                                        <tr class="divide-x divide-gray-200">
                                            <td class="px-4 py-2 whitespace-nowrap tracking-wider text-center">
                                                <label class="flex items-center justify-center space-x-2">
                                                    <input type="checkbox" class="form-switch h-5 w-10 rounded-full bg-gray-300 before:rounded-full before:bg-gray-50 checked:bg-primary checked:before:bg-white"
                                                        {{ $user->status ? 'checked' : '' }}
                                                        wire:click.debounce.500ms="toggleStatus({{ $user->id }})"
                                                        wire:loading.attr="disabled"
                                                    />
                                                </label>
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-900">{{ $user->nik }}</td>
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500">{{ $user->nama_lengkap }}</td>
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-center">
                                                @foreach($user->getRoleNames() as $roleName)
                                                    @if($roleName == 'admin')
                                                        <span class="badge px-2 py-1 text-xs tracking-wider border border-error text-error capitalize">{{ $roleName }}</span>
                                                    @elseif($roleName == 'guru')
                                                        <span class="badge px-2 py-1 text-xs tracking-wider border border-info text-info capitalize">{{ $roleName }}</span>
                                                    @elseif($roleName == 'siswa')
                                                        <span class="badge px-2 py-1 text-xs tracking-wider border border-success text-success capitalize">{{ $roleName }}</span>
                                                    @elseif($roleName == 'wali')
                                                        <span class="badge px-2 py-1 text-xs tracking-wider border border-warning text-warning capitalize">{{ $roleName }}</span>
                                                    @else
                                                        <span class="badge px-2 py-1 text-xs tracking-wider border border-secondary text-secondary capitalize">{{ $roleName }}</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500">{{ $user->email }}</td>
                                            <td class="px-6 py-2 whitespace-nowrap tracking-wider text-gray-500">{{ $user->telepon }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap font-medium">
                                                <x-backend.actions :user="$user"/>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data pengguna</td>
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
