@if ($paginator instanceof \Illuminate\Pagination\LengthAwarePaginator && $paginator->hasPages())
<div class="flex items-end my-2">
    
    {{-- Botón Primera Página --}}
    @if (!$paginator->onFirstPage())
    <a
        class="mx-1 px-4 py-2 bg-blue-900 border-2 border-blue-900 text-white font-bold text-center hover:bg-blue-400 hover:border-blue-400 rounded-lg cursor-pointer"
        wire:click="gotoPage(1)"
    >
        <<
    </a>
    @if($paginator->currentPage() > 2)
    <a
        class="mx-1 px-4 py-2 bg-blue-900 border-2 border-blue-900 text-white font-bold text-center hover:bg-blue-400 hover:border-blue-400 rounded-lg cursor-pointer"
        wire:click="previousPage"
    >
        <
    </a>
    @endif
    @endif

    {{-- Elementos de Paginación --}}
    @php
        // Generar el rango de páginas manualmente
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $range = array_unique([
            1,
            $current - 2, $current - 1, $current, $current + 1, $current + 2,
            $last
        ]);
        sort($range);
    @endphp

    @foreach ($range as $page)
        @if ($page >= 1 && $page <= $last)
            {{-- Separador ... --}}
            @if (($page > $current + 2 && $page != $last) || ($page < $current - 2 && $page != 1))
                @if ($loop->first || $loop->last)
                    <span class="mx-1 px-4 py-2 border-2 border-blue-900 text-blue-900 font-bold text-center rounded-lg cursor-pointer"
                        wire:click="gotoPage({{ $page }})">{{ $page }}</span>
                @else
                    <div class="text-blue-800 mx-1">
                        <span class="font-bold">.</span>
                        <span class="font-bold">.</span>
                        <span class="font-bold">.</span>
                    </div>
                @endif
            @else
                {{-- Página Activa --}}
                @if ($page == $current)
                    <span class="mx-1 px-4 py-2 border-2 border-blue-400 bg-blue-400 text-white font-bold text-center rounded-lg cursor-pointer">
                        {{ $page }}
                    </span>
                @else
                    <a class="mx-1 px-4 py-2 border-2 border-blue-900 text-blue-900 font-bold text-center hover:text-blue-400 rounded-lg cursor-pointer"
                        wire:click="gotoPage({{ $page }})">
                        {{ $page }}
                    </a>
                @endif
            @endif
        @endif
    @endforeach

    {{-- Botón Última Página --}}
    @if ($paginator->hasMorePages())
        @if($paginator->lastPage() - $paginator->currentPage() >= 2)
            <a class="mx-1 px-4 py-2 bg-blue-900 border-2 border-blue-900 text-white font-bold text-center hover:bg-blue-400 hover:border-blue-400 rounded-lg cursor-pointer"
                wire:click="nextPage">
                >
            </a>
        @endif
        <a
            class="mx-1 px-4 py-2 bg-blue-900 border-2 border-blue-900 text-white font-bold text-center hover:bg-blue-400 hover:border-blue-400 rounded-lg cursor-pointer"
            wire:click="gotoPage({{ $paginator->lastPage() }})">
            >>
        </a>
    @endif
</div>
@endif