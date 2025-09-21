@props([
    'id',
    'title',
    'text',
    'tags',
    'status',
    'updated_at' => '',
    'user' => '',
    'likes' => \Illuminate\Database\Eloquent\Collection::empty(),
    'comments' => [],
])

@php
    $likedStrokeColor = 'currentColor';
    $likedFillColor = 'none';

    if ($currUser = auth()->user()) {
        if ($isLiked = $likes->contains('user', $currUser)) {
            $likedStrokeColor = $likedFillColor = 'red';
        }
    }
@endphp

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
                <form action="{{route('posts.like', $id)}}" method="POST" class="flex">
                    @csrf
                    <button type="submit" class="flex items-center justify-center rounded-md p-1 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                        <svg class="size-6 shrink-0" fill="{{$likedFillColor}}" viewBox="0 0 24 24" stroke-width="1.5" stroke="{{$likedStrokeColor}}" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <span class="sr-only">Like</span>
                    </button>
                    <button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'post-likes-{{$id}}')"
                        class="p-1 my-auto"
                    >
                        {{$likes->count()}}
                    </button>
                </form>
            </div>

            <x-modal name="post-likes-{{$id}}" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Post Likes') }}
                    </h2>

                    <div class="flex flex-col mt-6 gap-3">
                        @foreach($likes as $like)
                            <div class="flex justify-between">
                                <span>{{$like->user->name}}</span>
                                <span>{{$like->created_at}}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-modal>

{{--            <div>--}}
{{--                @foreach($comments as $comment)--}}
{{--                    <div>--}}
{{--                        <span>{{$comment->user->name}}</span>--}}
{{--                        <p>{{$comment->comment}}</p>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
        </div>
        <div class="xs:self-center flex flex-col xs:flex-row gap-3">
            {{ $slot }}
        </div>
    </div>
</x-card>
