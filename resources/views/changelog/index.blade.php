<x-app-layout>
    <x-card class="bg-white">
        <div class="mx-auto max-w-7xl px-6 py-24 sm:pt-32 lg:px-8 lg:py-40">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="lg:col-span-5">
                    <h2 class="text-3xl font-semibold tracking-tight text-pretty dark:text-gray-300 text-gray-900 sm:text-4xl">{{__('What\'s New')}}?</h2>
                    <p class="mt-4 text-base/7 text-pretty dark:text-gray-500 text-gray-600">{{__('Last Update:')}} @php echo \Carbon\Carbon::now()->translatedFormat('d F Y') @endphp
                        <br>{{__('Have any questions')}}? <a href="https://t.me/cocsi_me" class="font-semibold text-indigo-600 hover:text-indigo-500">{{__('Contact me in Telegram')}}</a>.</p>
                </div>
                <div class=" lg:col-span-7 lg:mt-0">
                    <x-new-description
                        title="{{__('Dark Mode 2.0')}}"
                        description="{{__("Fine-tuned darkness for your eyes' delight. Now even smoother and easier on the screen")}}."
                    />
                    <x-new-description
                        title="{{__('Hide & Seek')}}"
                        description="{{__('Not into a post Now you can hide it and clean up your feed')}}."
                    />
                    <x-new-description
                        title="{{__('Delete for Good')}}"
                        description="{{__('Got regrets Remove posts forever with a single click')}}."
                    />
                    <x-new-description
                        title="{{__('Tag Magic')}}"
                        description="{{__('Adding tags is now smoother than ever. Just type and go')}}!"
                    />
                    <x-new-description
                        title="{{__('Form Saver')}}"
                        description="{{__('Made a mistake? No worries — your form data stays safe even after an error')}}."
                    />
                    <x-new-description
                        title="{{__('Author Spotlight')}}?"
                        description="{{__("Now you can see who wrote each post — giving credit where it's due")}}!"
                    />
                    <x-new-description
                        title="{{__('Under the Hood')}}?"
                        description="{{__("Small tweaks, big gains. We've polished everything for a faster, smoother experience")}}."
                    />
                </div>
            </div>
        </div>
    </x-card>

</x-app-layout>
