@php
    $paginator = $paginator ?? null;
    $rowsPerPage = $paginator ? $paginator->perPage() : ($rowsPerPage ?? 50);
    $currentPage = $paginator ? $paginator->currentPage() : ($currentPage ?? 1);
    $totalRows = $paginator ? $paginator->total() : ($totalRows ?? 0);
    $rowsPerPageOptions = $rowsPerPageOptions ?? [10, 25, 50, 100];
    $label = $label ?? 'Table pagination';

    $totalPages = $paginator ? $paginator->lastPage() : max(1, (int) ceil($totalRows / $rowsPerPage));
    $firstRow = $totalRows > 0 ? (($currentPage - 1) * $rowsPerPage) + 1 : 0;
    $lastRow = min($currentPage * $rowsPerPage, $totalRows);
    $isFirstPage = $currentPage <= 1;
    $isLastPage = $currentPage >= $totalPages;
    $idSuffix = $id ?? 'table';
    $buttonClass = 'inline-flex h-9 w-9 items-center justify-center rounded-lg border border-[#D1D5DB] bg-white text-[#374151] transition-all duration-200 hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB]';
    $disabledButtonClass = $buttonClass . ' cursor-not-allowed text-[#9CA3AF] hover:border-[#D1D5DB] hover:bg-white';
@endphp

<nav class="min-h-12 px-4 sm:px-6 py-3 border-t border-[#D1D5DB]/70 bg-white flex flex-col md:flex-row md:items-center md:justify-between gap-4 font-sans" aria-label="{{ $label }}">
    <div class="flex flex-col sm:flex-row sm:items-center gap-3 text-sm text-[#6B7280]">
        <label for="rows-per-page-{{ $idSuffix }}" class="font-medium text-[#374151]">Rows per page</label>
        @if($paginator)
            <form method="GET" action="{{ url()->current() }}">
                @foreach(request()->except(['per_page', 'page']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <select id="rows-per-page-{{ $idSuffix }}" name="per_page" onchange="this.form.submit()" class="h-9 rounded-lg border border-[#D1D5DB] bg-white px-3 pr-8 text-sm font-medium text-[#374151] shadow-sm outline-none transition-all duration-200 hover:border-[#2563EB] focus:border-[#2563EB] focus:ring-2 focus:ring-blue-100">
                    @foreach($rowsPerPageOptions as $option)
                        <option value="{{ $option }}" @selected((int) $option === (int) $rowsPerPage)>{{ $option }}</option>
                    @endforeach
                </select>
            </form>
        @else
            <select id="rows-per-page-{{ $idSuffix }}" class="h-9 rounded-lg border border-[#D1D5DB] bg-white px-3 pr-8 text-sm font-medium text-[#374151] shadow-sm outline-none transition-all duration-200 hover:border-[#2563EB] focus:border-[#2563EB] focus:ring-2 focus:ring-blue-100">
                @foreach($rowsPerPageOptions as $option)
                    <option value="{{ $option }}" @selected((int) $option === (int) $rowsPerPage)>{{ $option }}</option>
                @endforeach
            </select>
        @endif
        <span class="text-[#6B7280]">
            {{ $firstRow }}&ndash;{{ $lastRow }} of {{ $totalRows }} rows
        </span>
    </div>

    <div class="flex items-center gap-2 text-sm text-[#374151]">
        @if($paginator && !$isFirstPage)
        <a href="{{ $paginator->url(1) }}" aria-label="First page" class="{{ $buttonClass }}">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M5 4v12M15 5l-6 5 6 5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        @else
        <button type="button" aria-label="First page" @disabled($isFirstPage) class="{{ $isFirstPage ? $disabledButtonClass : $buttonClass }}">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M5 4v12M15 5l-6 5 6 5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        @endif

        @if($paginator && !$isFirstPage)
        <a href="{{ $paginator->previousPageUrl() }}" aria-label="Previous page" class="{{ $buttonClass }}">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M12.5 5l-5 5 5 5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        @else
        <button type="button" aria-label="Previous page" @disabled($isFirstPage) class="{{ $isFirstPage ? $disabledButtonClass : $buttonClass }}">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M12.5 5l-5 5 5 5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        @endif

        <label for="current-page-{{ $idSuffix }}" class="sr-only">Current page</label>
        <input id="current-page-{{ $idSuffix }}" type="text" value="{{ $currentPage }}" readonly class="h-9 w-12 rounded-lg border border-[#D1D5DB] bg-white text-center text-sm font-semibold text-[#374151] shadow-sm outline-none focus:border-[#2563EB] focus:ring-2 focus:ring-blue-100" aria-label="Current page">
        <span class="whitespace-nowrap text-[#6B7280]">of {{ $totalPages }}</span>

        @if($paginator && !$isLastPage)
        <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next page" class="{{ $buttonClass }}">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M7.5 5l5 5-5 5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        @else
        <button type="button" aria-label="Next page" @disabled($isLastPage) class="{{ $isLastPage ? $disabledButtonClass : $buttonClass }}">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M7.5 5l5 5-5 5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        @endif

        @if($paginator && !$isLastPage)
        <a href="{{ $paginator->url($totalPages) }}" aria-label="Last page" class="{{ $buttonClass }}">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M5 5l6 5-6 5M15 4v12" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        @else
        <button type="button" aria-label="Last page" @disabled($isLastPage) class="{{ $isLastPage ? $disabledButtonClass : $buttonClass }}">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M5 5l6 5-6 5M15 4v12" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        @endif
    </div>
</nav>
