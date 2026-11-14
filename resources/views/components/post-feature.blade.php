{{--TODO: make post feature comp--}}

@props([
    'action',
    'title',
    'featureRowsCount',
 ])

<div class="text-sm mt-3">
    <form action="{{route('posts.like', $id)}}" method="POST" class="flex">
        @csrf
        <button type="submit" class="flex items-center justify-center rounded-md p-1 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
            {{$slot}}
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
