<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Feed') }}
        </h2>
    </x-slot>

    <x-cards-grid :paginator="$posts">
        @foreach($posts as $post)
            <x-post-card
                :id="$post->id"
                :title="$post->title"
                :text="$post->text"
                :updated_at="$post->updated_at"
                :tags="$post->tags->pluck('name')"
                :user="$post->user->name"
                :likes="$post->like"
                :comments="$post->comments"
            />
        @endforeach
    </x-cards-grid>
</x-app-layout>
