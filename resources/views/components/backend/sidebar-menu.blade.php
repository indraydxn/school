<li>
    <a wire:navigate href="{{ $href }}" class=" {{ $active ? 'text-primary bg-primary/10 hover:bg-primary/20' : 'hover:bg-gray-100/50 hover:text-gray-800 focus:bg-gray-100/50 focus:text-gray-80' }} flex w-full items-center gap-x-2 px-3 py-2 tracking-wider rounded-lg group focus:outline-hidden transition-[color,padding-left] duration-300 ease-in-out hover:pl-4" >
        <div class="flex items-center space-x-3">
            <i class="text-xs fa-light {{ $icon }}"></i>
            <span>{{ $menu }}</span>
        </div>
    </a>
</li>
