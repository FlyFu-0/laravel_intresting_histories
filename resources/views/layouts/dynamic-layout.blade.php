@if(auth()->check())
    <x-app-layout {{ $attributes }}>
        {{ $slot }}
    </x-app-layout>
@else
    <x-unauthorized-layout {{ $attributes }}>
        {{ $slot }}
    </x-unauthorized-layout>
@endif
