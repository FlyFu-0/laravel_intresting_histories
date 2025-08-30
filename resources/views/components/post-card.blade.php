@props([
    'title',
    'text',
    'tags',
    'status',
    'updated_at' => '',
    'user' => '',
])

<x-card>
    <div class="flex flex-col gap-3 h-full">
        <div class="flex justify-between">
            <h4 class="font-bold first-letter:uppercase text-xl">{{$title}}</h4>
            @if(isset($status))
                <x-status-badge :text="$status"/>
            @endif
        </div>
        <div class="text-sm/6">
            <p>{{__('Written by')}} <span class="font-semibold">{{$user}}</span></p>
            <span>{{$updated_at}}</span>
        </div>
        <p class="break-words">{{$text}}</p>
        <div>
            @foreach($tags as $tag)
                <x-tag-badge text="{{$tag}}" />
            @endforeach
        </div>
        <div class="self-center mt-auto flex gap-3">
            {{ $slot }}
        </div>
    </div>
</x-card>
