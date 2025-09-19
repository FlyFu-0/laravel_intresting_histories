<x-input-label for="text" :value="__('Story Title')"/>
<div class="mt-2">
    <x-text-input value="{{old('title')}}" type="text" name="title" id="title"
                  class="block min-w-full grow py-1.5 px-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 rounded-md"
                  placeholder="{{__('My shopping story')}}"
                  maxlength="{{\App\Models\Post::MAX_TITLE_LENGTH}}" />
    <x-input-error :messages="$errors->get('title')" class="mt-2"/>
</div>
