@props([
    'text',
    'deleteAction' => null,
    'deleteMethod' => 'POST',
])

<span class="inline-flex items-center rounded-full bg-gray-100 dark:bg-gray-700 dark:text-gray-300 px-2 py-1 text-xs font-medium text-gray-600">
    {{$text}}
    @if($deleteAction)
        <form action="{{$deleteAction}}" method="POST" class="items-center inline-flex">
            @csrf
            @method($deleteMethod)
            <button type="submit" class="group relative -mr-1 size-3.5 rounded-full hover:bg-gray-500/20 dark:hover:bg-gray-300/20">
                <span class="sr-only">Remove</span>
                <svg viewBox="0 0 14 14" class="size-3.5 stroke-gray-700/50 group-hover:stroke-gray-700/75 dark:stroke-gray-300/50 dark:group-hover:stroke-gray-300/75">
                  <path d="M4 4l6 6m0-6l-6 6" />
                </svg>
                <span class="absolute -inset-1"></span>
              </button>
        </form>
    @endif
</span>
