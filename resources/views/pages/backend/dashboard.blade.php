<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 lg:gap-5 md:gap-4 gap-3">
    <div class="card p-4">
        <div class="flex items-center">
            <div class="size-13 flex items-center justify-center bg-primary rounded-xl">
                <i class="fa-regular fa-users text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-gray-600 tracking-wider">Total Pengguna</p>
                <p class="text-2xl font-extrabold text-gray-900">{{ $jmlUser }}</p>
            </div>
        </div>
    </div>
    <div class="card p-4">
        <div class="flex items-center">
            <div class="size-13 flex items-center justify-center bg-secondary rounded-xl">
                <i class="fa-regular fa-user-graduate text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-gray-600 tracking-wider">Total Siswa</p>
                <p class="text-2xl font-extrabold text-gray-900">{{ $jmlSiswa }}</p>
            </div>
        </div>
    </div>
    <div class="card p-4">
        <div class="flex items-center">
            <div class="size-13 flex items-center justify-center bg-success rounded-xl">
                <i class="fa-regular fa-chalkboard-teacher text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-gray-600 tracking-wider">Total Guru</p>
                <p class="text-2xl font-extrabold text-gray-900">{{ $jmlGuru }}</p>
            </div>
        </div>
    </div>
    <div class="card p-4">
        <div class="flex items-center">
            <div class="size-13 flex items-center justify-center bg-error rounded-xl">
                <i class="fa-regular fa-user-friends text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-gray-600 tracking-wider">Total Wali Siswa</p>
                <p class="text-2xl font-extrabold text-gray-900">{{ $jmlWali }}</p>
            </div>
        </div>
    </div>
</div>