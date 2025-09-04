<x-app-layout>
    <x-card>
        <div class="flex flex-col gap-5">
            <x-input-button-inline
               action="{{route('tags.create')}}"
               method="POST"
               name="name"
               placeholder="{{__('New Tag')}}"
               buttonText="{{__('Save')}}"
            />
            <div class="inline-flex flex-wrap gap-3">
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
