@props(['color' => 'red'])

@php
    $style = str_replace('#COLOR#', $color, "transition-colors hover:text-white dark:hover:text-white text-#COLOR#-500 dark:text-#COLOR#-500 border-#COLOR#-500 dark:border-#COLOR#-500 hover:bg-#COLOR#-500 dark:hover:bg-#COLOR#-500");
@endphp

<x-secondary-button {{$attributes->merge(['class' => $style])}}>
    {{ $slot }}
</x-secondary-button>
