@if ($paginator->hasPages() || $paginator->total() > 0)
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center space-y-2">
        <p class="text-gray-300">
            Mostrando <span class="font-semibold">{{ $paginator->firstItem() }}</span>
            - <span class="font-semibold">{{ $paginator->lastItem() }}</span> de
            <span class="font-semibold">{{ $paginator->total() }}</span> cócteles.
        </p>

        <div class="flex items-center space-x-2">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm font-medium bg-gray-800 text-white rounded-md cursor-default">Anterior</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium bg-gray-800 text-white rounded-md hover:bg-gray-700">Anterior</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-4 py-2 text-sm font-medium bg-gray-800 text-white cursor-default">...</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 text-sm font-medium bg-gray-600 text-white rounded-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium bg-gray-800 text-white rounded-md hover:bg-gray-700">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium bg-gray-800 text-white rounded-md hover:bg-gray-700">Siguiente</a>
            @else
                <span class="px-4 py-2 text-sm font-medium bg-gray-800 text-white rounded-md cursor-default">Siguiente</span>
            @endif
        </div>

        <form action="{{ request()->url() }}" method="GET" class="flex items-center space-x-2">
            <label for="page" class="text-gray-300 text-sm">Ir a la página:</label>
            <input type="number" name="page" id="page" min="1" max="{{ $paginator->lastPage() }}"
                   class="w-16 text-center px-2 py-1 text-black rounded-md border border-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400"
                   value="{{ $paginator->currentPage() }}">
            <button type="submit" class="px-3 py-1 text-sm font-medium bg-blue-600 text-white rounded-md hover:bg-blue-500">
                Ir
            </button>
        </form>
    </nav>
@endif