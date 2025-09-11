@props([
    "paginator" => null,
])

@php
    if ($paginator->lastPage() < 2) {
        return;
    }

    $activeStyle = "inline-flex items-center border-t-2 border-indigo-500 px-4 pt-4 text-sm font-medium text-indigo-600";
    $currentStyle = "border-indigo-500 text-indigo-600";
    $defaultStyle = "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300";
    $style = "inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700";

    function buildUrl($page) {
        $queryParams = request()->except('page');
        $queryParams['page'] = $page;
        return url()->current() . '?' . http_build_query($queryParams);
    }
@endphp

<nav class="flex justify-between items-center relative border-t border-gray-200 px-4 sm:px-0 gap-x-5 mt-10">
    @if($paginator->currentPage() > 1)
    <div class="absolute left-0 -mt-px flex">
        <a href="{{buildUrl($paginator->currentPage() - 1)}}" class="inline-flex items-center border-t-2 border-transparent pt-4 pr-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
            <svg class="mr-3 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M18 10a.75.75 0 0 1-.75.75H4.66l2.1 1.95a.75.75 0 1 1-1.02 1.1l-3.5-3.25a.75.75 0 0 1 0-1.1l3.5-3.25a.75.75 0 1 1 1.02 1.1l-2.1 1.95h12.59A.75.75 0 0 1 18 10Z" clip-rule="evenodd" />
            </svg>
            {{__("Previous")}}
        </a>
    </div>
    @endif
    <div class="hidden md:-mt-px md:flex m-auto">
        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
        @for($i = 1; $i <= $paginator->lastPage(); $i++)
            <a href="{{buildUrl($i)}}" class="{{($paginator->currentPage() == $i) ? $activeStyle : $style}}" aria-current="page">{{$i}}</a>
        @endfor
        {{--            <span class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500">...</span>--}}
    </div>
    @if($paginator->currentPage() < $paginator->lastPage())
        <div class="absolute right-0 -mt-px flex">
        <a href="{{buildUrl($paginator->currentPage() + 1)}}" class="inline-flex items-center border-t-2 border-transparent pt-4 pl-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
            {{__("Next")}}
            <svg class="ml-3 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M2 10a.75.75 0 0 1 .75-.75h12.59l-2.1-1.95a.75.75 0 1 1 1.02-1.1l3.5 3.25a.75.75 0 0 1 0 1.1l-3.5 3.25a.75.75 0 1 1-1.02-1.1l2.1-1.95H2.75A.75.75 0 0 1 2 10Z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
    @endif
</nav>
