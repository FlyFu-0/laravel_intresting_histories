@php use Illuminate\Http\Request; @endphp
<x-app-layout>
    <x-cards-grid>
        @foreach($posts as $post)
            <x-post-card
                :title="$post->title"
                :text="$post->text"
                :created_at="$post->created_at"
                :status="$post->status"
                :tags="$post->tags->pluck('name')"
            >
                @if($post->status === \App\Models\Post::STATUS_DRAFT)
                    <x-secondary-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-post-deletion-{{$post->id}}')"
                        class="transition-colors text-red-500 border-red-500 hover:bg-red-500 hover:text-white">
                        {{ __('Delete') }}
                    </x-secondary-button>

{{--                    TODO: bad. creating many modals instead of one --}}
                    <x-modal name="confirm-post-deletion-{{$post->id}}" :show="$errors->postDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('posts.delete', ['POST_ID' => $post->id]) }}" class="p-6">
                            @csrf
                            @method('DELETE')

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Are you sure you want to delete post') }}?
                            </h2>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                    <form
                        action="{{ route('posts.statusChange', ['POST_ID' => $post->id, 'STATUS' => \App\Models\Post::STATUS_PENDING]) }}"
                        method="POST">
                        @csrf
                        <x-primary-button>
                            {{ __('Publish') }}
                        </x-primary-button>
                    </form>
                @endif
            </x-post-card>
        @endforeach
    </x-cards-grid>
</x-app-layout>
