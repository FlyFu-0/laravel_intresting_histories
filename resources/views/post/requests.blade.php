<x-app-layout>
    <x-cards-grid>
        @foreach($posts as $post)
            <x-post-card
                :id="$post->id"
                :title="$post->title"
                :text="$post->text"
                :created_at="$post->created_at"
                :tags="$post->tags->pluck('name')"
                showAdminBtns="true"
            />
        @endforeach
    </x-cards-grid>
</x-app-layout>
