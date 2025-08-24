<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Feed') }}
        </h2>
    </x-slot>

    <x-cards-grid>
        @foreach($posts as $post)
            <x-post-card
                :title="$post->title"
                :text="$post->text"
                :created_at="$post->created_at"
                :updated_at="$post->updated_at"
                :tags="$post->tags->pluck('name')"
            />
        @endforeach
    </x-cards-grid>
</x-app-layout>
