@props([
    'id',
    'title',
    'text',
    'tags',
    'status',
    'updated_at' => '',
    'user' => '',
    'likes' => 0,
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
            @if($user)
                <p>{{__('Written by')}} <span class="font-semibold">{{$user}}</span></p>
            @endif
            <span>{{$updated_at}}</span>
        </div>
        <p class="break-words">{{$text}}</p>
        <div class="mt-auto">
            <div class="inline-flex flex-wrap gap-1 gap-y-2">
                @foreach($tags as $tag)
                    <x-tag-badge text="{{$tag}}"/>
                @endforeach
            </div>
            <div class="text-sm mt-3">
                <form action="{{route('posts.like', $id)}}" method="POST">
                    @csrf
                    <button type="submit">like {{$likes}}</button>
                </form>
            </div>
        </div>
        <div class="xs:self-center flex flex-col xs:flex-row gap-3">
            {{ $slot }}
        </div>
    </div>
</x-card>
