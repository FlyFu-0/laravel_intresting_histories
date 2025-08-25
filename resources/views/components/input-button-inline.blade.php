@props(['placeholder' => 'Search', 'name' => 'search', 'buttonText' => 'Find'])

<div class="flex flex-col">
    <form {{ $attributes->merge(['action' => '', 'class' => 'inline-flex gap-3']) }}>
        @csrf
        <x-text-input type="text" name="{{$name}}" placeholder="{{__($placeholder)}}" />
        <x-primary-button type="submit">
            {{__($buttonText)}}
        </x-primary-button>
    </form>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
