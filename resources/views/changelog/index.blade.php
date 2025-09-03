<x-app-layout>
    <x-card class="bg-white">
        <div class="mx-auto max-w-7xl px-6 py-24 sm:pt-32 lg:px-8 lg:py-40">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="lg:col-span-5">
                    <h2 class="text-3xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-4xl">{{__('What\'s New')}}?</h2>
                    <p class="mt-4 text-base/7 text-pretty text-gray-600">{{__('Last Update:')}} @php echo \Carbon\Carbon::now()->translatedFormat('d F Y') @endphp
                        <br>{{__('Have any questions')}}? <a href="https://t.me/cocsi_me" class="font-semibold text-indigo-600 hover:text-indigo-500">{{__('Contact me in Telegram')}}</a>.</p>
                </div>
                <div class="mt-10 lg:col-span-7 lg:mt-0">
                    <x-new-description
                        title="{{__('Dark theme')}}?"
                        description="{{__('You boil the hell out of it. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat')}}."
                    />
                    <x-new-description
                        title="{{__('Errors messages localization')}}?"
                        description="{{__('Errors messages localization')}}."
                    />
                    <x-new-description
                        title="{{__('Who Author')}}?"
                        description="{{__('Added author sign to posts')}}."
                    />
                    <x-new-description
                        title="{{__('I won\'t ')}}?"
                        description="{{__('Added ... to hide own posts')}}."
                    />
                    <x-new-description
                        title="{{__('Too many posts in draft')}}?"
                        description="{{__('No problem. Now, you can clear posts in draft')}}."
                    />
                    <x-new-description
                        title="{{__('Difficult to find needed tags')}}?"
                        description="{{__('Tags input was reformat following modern trends')}}."
                    />
                </div>
            </div>
        </div>
    </x-card>

</x-app-layout>
