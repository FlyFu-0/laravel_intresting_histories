<x-input-label for="text" :value="__('Story')" />
<div class="mt-2">
    <textarea name="text" id="text" rows="3" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{old('text')}}</textarea>
    <x-input-error :messages="$errors->get('text')" class="mt-2" />
</div>
<p class="mt-3 text-sm/6 text-gray-600 dark:text-gray-400">{{__('Write a few sentences about your story')}}.</p>
