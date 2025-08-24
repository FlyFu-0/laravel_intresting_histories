<x-app-layout>
    <div class="divide-y divide-gray-900/10 flex">
        <div class="w-full gap-x-8 gap-y-8 py-10 md:w-3/4 xl:w-1/2 m-auto">
            <form method="POST" action="{{route('posts.create')}}" class="bg-white ring-1 shadow-xs ring-gray-900/5 sm:rounded-xl md:col-span-2">
                @csrf
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-6 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title" class="block min-w-full grow py-1.5 px-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 rounded-md" placeholder="My shopping history">
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="text" class="block text-sm/6 font-medium text-gray-900">Text</label>
                            <div class="mt-2">
                                <textarea name="text" id="text" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                            </div>
                            <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about your story.</p>
                        </div>
                    </div>
                    <div class="mt-6 space-y-6">
                        <select name="tags" multiple class="rounded-md min-w-32">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-6 space-y-6">
                        <div class="flex gap-3">
                            <div class="flex h-6 shrink-0 items-center">
                                <div class="group grid size-4 grid-cols-1">
                                    <input id="publish" aria-describedby="publish-description" name="publish" type="checkbox" class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
                                    <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm/6">
                                <label for="publish" class="font-medium text-gray-900">Publish instantly</label>
                                <p id="publish-description" class="text-gray-500">Send to moderation just after save.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
