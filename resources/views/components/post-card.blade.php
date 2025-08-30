@props([
    'title',
    'text',
    'tags',
    'status',
    'created_at',
    'updated_at',
])

<x-card>
    <div class="flex flex-col gap-3 h-full">
        <div class="flex justify-between">
            <h4 class="font-bold">{{$title}}</h4>
            @if(isset($status))
                <x-status-badge :text="$status"/>
            @endif
        </div>
        @if(isset($updated_at))
            <div>
                <span>{{$updated_at}}</span>
            </div>
        @endif
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
