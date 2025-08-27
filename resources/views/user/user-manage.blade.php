<x-app-layout>
    <x-card>
        <x-input-button-inline/>
        <ul role="list" class="mt-5 divide-y divide-gray-100">
            @if(isset($users))
                @foreach($users as $user)
                    <li class="relative flex justify-between rounded-md gap-x-6 px-4 py-5 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 sm:px-6 lg:px-8">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold">
                                    <a href="#">
                                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                        {{$user->name}}
                                    </a>
                                </p>
                                <p class="mt-1 flex text-xs/5 text-gray-500 dark:text-gray-400">
                                    <a href="mailto:{{$user->email}}"
                                       class="relative truncate hover:underline">{{$user->email}}</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex shrink-0 items-center gap-x-4">
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                @foreach($user->roles->pluck('name') as $role)
                                    <p class="text-sm/6 ">{{$role}}</p>
                                @endforeach
                                <p class="text-sm/6">{{$user->isBanned() ? 'Banned' : ''}}</p>
                                <p class="text-sm/6">{{$user->isMuted() ? "Muted until {$user->muted_until}" : ''}}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </x-card>
</x-app-layout>
