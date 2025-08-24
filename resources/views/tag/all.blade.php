<x-app-layout>
    <x-card>
        <div class="flex flex-col gap-5">
            <form action="{{route('tags.create')}}" class="inline-flex gap-3" method="POST">
                @csrf
                <x-text-input type="text" name="name" placeholder="Add new tag" />
                <x-primary-button>{{__('messages.save')}}</x-primary-button>
            </form>
            <div class="inline-flex gap-3">
                @foreach($tags as $tag)
                    <x-tag-badge
                        :text="$tag->name"
                        :deleteMethod="\Illuminate\Http\Request::METHOD_DELETE"
                        :deleteAction="route('tags.delete', $tag)"
                    />
                @endforeach
            </div>
        </div>
    </x-card>
</x-app-layout>
