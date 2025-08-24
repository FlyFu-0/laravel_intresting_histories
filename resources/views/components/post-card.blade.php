@props([
    'id',
    'title',
    'text',
    'tags',
    'status',
    'created_at',
    'updated_at',
    'showAdminBtns',
    'showSendBtn',
])

<x-card>
    <div class="flex flex-col gap-3 h-full">
        <div class="flex justify-between">
            <h4 class="font-bold">{{$title}}</h4>
            @if(isset($status))
            <div class="py-0.5 px-3 border rounded-full">
                    <span>{{$status}}</span>
            </div>
            @endif
        </div>
        @if(isset($updated_at))
            <div>
                <span>{{$updated_at}}</span>
            </div>
        @endif
        <p class="break-words">{{$text}}</p>
        <div>
            @foreach($tags as $tag)
                <x-tag-badge text="{{$tag}}" />
            @endforeach
        </div>
        @if(isset($showAdminBtns) && $showAdminBtns)
            <div class="self-center mt-auto flex gap-3">
                <form action="{{ route('posts.statusChange', ['POST_ID' => $id, 'STATUS' => \App\Models\Post::STATUS_REJECTED]) }}" method="POST">
                    @csrf
                    <x-danger-button>
                        {{ __('Reject') }}
                    </x-danger-button>
                </form>

                <form action="{{ route('posts.statusChange', ['POST_ID' => $id, 'STATUS' => \App\Models\Post::STATUS_PUBLISHED]) }}" method="POST">
                    @csrf
                    <x-primary-button>
                        {{ __('Publish') }}
                    </x-primary-button>
                </form>
            </div>
        @endif
        @if(isset($showSendBtn) && $showSendBtn && $status === \App\Models\Post::STATUS_DRAFT)
        <div class="self-center mt-auto flex gap-3">
            <form action="{{ route('posts.statusChange', ['POST_ID' => $id, 'STATUS' => \App\Models\Post::STATUS_PENDING]) }}" method="POST">
                @csrf
                <x-primary-button>
                    {{ __('Send') }}
                </x-primary-button>
            </form>
        </div>
    @endif
    </div>
</x-card>
