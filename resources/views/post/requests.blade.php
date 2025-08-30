<x-app-layout>
    <x-cards-grid>
        @foreach($posts as $post)
            <x-post-card
                :title="$post->title"
                :text="$post->text"
                :created_at="$post->created_at"
                :tags="$post->tags->pluck('name')"
                showAdminBtns="true"
            >
                <form action="{{ route('posts.statusChange', ['POST_ID' => $post->id, 'STATUS' => \App\Models\Post::STATUS_REJECTED]) }}" method="POST">
                    @csrf
                    <x-danger-button>
                        {{ __('Reject') }}
                    </x-danger-button>
                </form>
                <form action="{{ route('posts.statusChange', ['POST_ID' => $post->id, 'STATUS' => \App\Models\Post::STATUS_PUBLISHED]) }}" method="POST">
                    @csrf
                    <x-primary-button>
                        {{ __('Publish') }}
                    </x-primary-button>
                </form>
            </x-post-card>
        @endforeach
    </x-cards-grid>
</x-app-layout>
