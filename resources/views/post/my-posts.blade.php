<x-app-layout>
    <x-cards-grid>
        @foreach($posts as $post)
            <x-post-card
                :id="$post->id"
                :title="$post->title"
                :text="$post->text"
                :created_at="$post->created_at"
                :status="$post->status"
                :tags="$post->tags->pluck('name')"
                :showSendBtn="true"
            />
        @endforeach
    </x-cards-grid>
</x-app-layout>
