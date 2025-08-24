<x-app-layout>
    <x-card>
    <form action="" class="inline-flex gap-3">
        @csrf
        <x-text-input type="text" name="search" placeholder="Name or Email" />
        <x-primary-button type="submit">
            {{__('Find')}}
        </x-primary-button>
    </form>
        @if(isset($users))
            <ul role="list" class="divide-y divide-gray-100">
    @foreach($users as $user)
                    <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6 lg:px-8">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-gray-900">
                                    <a href="#">
                                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                        {{$user->name}}
                                    </a>
                                </p>
                                <p class="mt-1 flex text-xs/5 text-gray-500">
                                    <a href="mailto:{{$user->email}}" class="relative truncate hover:underline">{{$user->email}}</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex shrink-0 items-center gap-x-4">
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm/6 text-gray-900">Admin</p>
                                <p class="mt-1 text-xs/5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                            </div>
                        </div>
                    </li>
    @endforeach
            </ul>
        @endif
    </x-card>
</x-app-layout>
