<x-app-layout>
    <div class="divide-y divide-gray-900/10 flex">
        <div class="w-full gap-x-8 gap-y-8 py-10 md:w-3/4 xl:w-1/2 m-auto">
            <x-card>
                <form method="POST" action="{{route('posts.create')}}" class="md:col-span-2">
                @csrf
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-6 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <x-input-label for="text" :value="__('Story Title')" />
                            <div class="mt-2">
                                <x-text-input value="{{old('title')}}" type="text" name="title" id="title" class="block min-w-full grow py-1.5 px-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 rounded-md" placeholder="{{__('My shopping story')}}" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-full">
                            <x-input-label for="text" :value="__('Story')" />
                            <div class="mt-2">
                                <textarea name="text" id="text" rows="3" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{old('text')}}</textarea>
                                <x-input-error :messages="$errors->get('text')" class="mt-2" />
                            </div>
                            <p class="mt-3 text-sm/6 text-gray-600 dark:text-gray-400">{{__('Write a few sentences about your story')}}.</p>
                        </div>

                        <div class="col-span-full">
                            <x-input-label for="tags-input" :value="__('Tags')"/>
                            <div class="mt-2">
                                <select name="tags[]" id="tags-input" multiple autocomplete="off" placeholder="{{__('Topics of your story')}}"></select>
                                <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 space-y-6">
                        <div class="flex gap-3">
                            <div class="flex h-6 shrink-0 items-center">
                                <div class="group grid size-4 grid-cols-1">
                                    <input id="publish" aria-describedby="publish-description" name="publish" type="checkbox" class="col-start-1 row-start-1 appearance-none rounded-sm dark:focus:ring-offset-gray-300 border border-gray-300 bg-white dark:border-gray-600 dark:bg-gray-300 checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
                                    <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white dark:stroke-gray-300 group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm/6">
                                <label for="publish" class="font-medium text-gray-900 dark:text-gray-100">{{__('Publish')}}</label>
                                <p id="publish-description" class="dark:text-gray-400 text-gray-500">{{__('Send to moderation just after save')}}.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col xs:flex-row xs:items-center justify-end gap-3 px-4 pb-4 sm:px-8">
                    <x-secondary-button type="reset">
                        {{__('Reset')}}
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        {{__('Save')}}
                    </x-primary-button>
                </div>
            </form>
            </x-card>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        window.initTagsInput(@json($tags));
    });
</script>
