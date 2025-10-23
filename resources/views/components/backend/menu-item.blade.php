<li x-data="accordionItem('menu-item-{{ $title }}')" x-init="if ({{ $active }}) expanded = true">
    <a :class="expanded ? 'text-primary hover:text-primary-focus hover:bg-primary/5' : 'hover:bg-gray-100/50 hover:text-gray-800 focus:bg-gray-100/50 focus:text-gray-80'" @click="expanded = !expanded" class="flex w-full items-center justify-between gap-x-2 px-3 py-2 tracking-wider rounded-lg group focus:outline-hidden transition-[color,padding-left] duration-300 ease-in-out hover:pl-4" href="javascript:void(0);">
        <div class="flex items-center space-x-3">
            <i class="text-xs fa-light {{ $icon }}"></i>
            <span>{{ $title }}</span>
        </div>
        <svg :class="expanded && 'rotate-90'" xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-400 transition-transform ease-in-out" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>
    <ul x-collapse x-show="expanded" class="py-1 space-y-1 ml-5">
        {{ $slot }}
    </ul>
</li>
