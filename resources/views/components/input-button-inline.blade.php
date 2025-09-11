@props(['placeholder' => 'Search', 'name' => 'search', 'buttonText' => 'Find', 'old' => ''])

<div class="flex flex-col">
    <form {{ $attributes->merge(['action' => '', 'method' => 'GET', 'class' => 'inline-flex gap-3 flex-wrap sm:flex-nowrap']) }}>
        @if($attributes->get('method') && $attributes->get('method') !== 'GET')
            @csrf
        @endif
        <x-text-input type="text" name="{{$name}}" value="{{old($name) ?: request()->get($name)}}"
                      class="w-full xs:w-fit" placeholder="{{__($placeholder)}}"/>
        <x-primary-button type="submit">
            {{__($buttonText)}}
        </x-primary-button>
    </form>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
