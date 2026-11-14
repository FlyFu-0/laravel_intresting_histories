@php
    $likedStrokeColor = 'currentColor';
    $likedFillColor = 'none';

    if ($currUser = auth()->user()) {
        if ($isLiked = $post->like->contains('user', $currUser)) {
            $likedStrokeColor = $likedFillColor = 'red';
        }
    }
@endphp

<x-app-layout>
    <x-post-card
        :id="$post->id"
        :title="$post->title"
        :text="$post->text"
        :updated_at="$post->updated_at"
        :tags="$post->tags->pluck('name')"
        :user="$post->user->name"
        :likes="$post->like"
        :comments="$post->comments->count()"
    />

{{--    <x-card>--}}
{{--        <div class="flex flex-col gap-3 h-full">--}}
{{--            <div class="flex justify-between">--}}
{{--                <h4 class="font-bold first-letter:uppercase text-xl">{{$post->title}}</h4>--}}
{{--            </div>--}}
{{--            <div class="text-sm/6">--}}
{{--                @if($post->user)--}}
{{--                    <p>{{__('Written by')}} <span class="font-semibold">{{$post->user->name}}</span></p>--}}
{{--                @endif--}}
{{--                <span>{{$post->updated_at}}</span>--}}
{{--            </div>--}}
{{--            <p class="break-words">{{$post->text}}</p>--}}
{{--            <div class="mt-auto">--}}
{{--                <div class="inline-flex flex-wrap gap-1 gap-y-2">--}}
{{--                    @foreach($post->tags as $tag)--}}
{{--                        <x-tag-badge text="{{$tag->name}}"/>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

{{--                <div class="flex gap-3">--}}

{{--                    <div class="text-sm mt-3">--}}
{{--                        <form action="{{route('posts.like', $post->id)}}" method="POST" class="flex">--}}
{{--                            @csrf--}}
{{--                            <button type="submit"--}}
{{--                                    class="flex items-center justify-center rounded-md p-1 text-gray-400 hover:bg-gray-100 hover:text-gray-500">--}}
{{--                                <svg class="size-6 shrink-0" fill="{{$likedFillColor}}" viewBox="0 0 24 24"--}}
{{--                                     stroke-width="1.5" stroke="{{$likedStrokeColor}}" aria-hidden="true"--}}
{{--                                     data-slot="icon">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>--}}
{{--                                </svg>--}}
{{--                                <span class="sr-only">Like</span>--}}
{{--                            </button>--}}
{{--                            <button--}}
{{--                                x-data=""--}}
{{--                                x-on:click.prevent="$dispatch('open-modal', 'post-likes-{{$post->id}}')"--}}
{{--                                class="p-1 my-auto"--}}
{{--                            >--}}
{{--                                {{$post->like->count()}}--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <x-modal name="post-likes-{{$post->id}}" focusable>--}}
{{--                        <div class="p-6">--}}
{{--                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">--}}
{{--                                {{ __('Post Likes') }}--}}
{{--                            </h2>--}}

{{--                            <div class="flex flex-col mt-6 gap-3">--}}
{{--                                @foreach($post->like as $like)--}}
{{--                                    <div class="flex justify-between">--}}
{{--                                        <span>{{$like->user->name}}</span>--}}
{{--                                        <span>{{$like->created_at}}</span>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </x-modal>--}}

{{--                    <div class="text-sm mt-3">--}}
{{--                        <a href="{{route('posts.detail', $post->id)}}" class="flex items-center">--}}
{{--                            <svg class="size-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
{{--                                 stroke="currentColor" aria-hidden="true" data-slot="icon">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>--}}
{{--                            </svg>--}}
{{--                            <span class="sr-only">Comments</span>--}}
{{--                            {{$post->comments->count()}}--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <x-card class="mt-3">
            <form action="{{route('posts.comment', $post->id)}}" method="POST" class="flex w-full py-1 px-3 gap-3">
                @csrf
                <x-text-input class="w-full" name="comment" />
                <x-secondary-button type="submit" class="rounded-full">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.5003 12H5.41872M5.24634 12.7972L4.24158 15.7986C3.69128 17.4424 3.41613 18.2643 3.61359 18.7704C3.78506 19.21 4.15335 19.5432 4.6078 19.6701C5.13111 19.8161 5.92151 19.4604 7.50231 18.7491L17.6367 14.1886C19.1797 13.4942 19.9512 13.1471 20.1896 12.6648C20.3968 12.2458 20.3968 11.7541 20.1896 11.3351C19.9512 10.8529 19.1797 10.5057 17.6367 9.81135L7.48483 5.24303C5.90879 4.53382 5.12078 4.17921 4.59799 4.32468C4.14397 4.45101 3.77572 4.78336 3.60365 5.22209C3.40551 5.72728 3.67772 6.54741 4.22215 8.18767L5.24829 11.2793C5.34179 11.561 5.38855 11.7019 5.407 11.8459C5.42338 11.9738 5.42321 12.1032 5.40651 12.231C5.38768 12.375 5.34057 12.5157 5.24634 12.7972Z" stroke="currentColor" color="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </x-secondary-button>
            </form>
        </x-card>

        <div class="mt-6 flex flex-col gap-3">
            @foreach($post->comments as $comment)
                <x-card>
                    <div class="flex justify-between">
                        <span>{{$comment->user->name}}</span>
                        <span>{{$comment->created_at}}</span>
                    </div>
                    <p>{{$comment->comment}}</p>
                </x-card>
            @endforeach
        </div>
{{--    </x-card>--}}
</x-app-layout>
