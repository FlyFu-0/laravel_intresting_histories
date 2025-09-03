<x-app-layout>
    <x-card>
        <x-input-button-inline/>
        <ul role="list" class="mt-5 divide-y dark:divide-gray-700 divide-gray-100">
            @if(isset($users))
                @foreach($users as $user)
                    @php($isMyself = $user->id === \Illuminate\Support\Facades\Auth::user()->id)

                    <li class="relative flex justify-between rounded-md gap-x-6 px-4 py-5 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700 sm:px-6 lg:px-8 {{$isMyself ? 'bg-yellow-100 hover:bg-yellow-200' : ''}}">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold">
                                    {{$user->name}}
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
                                <p class="text-sm/6 text-red-500">{{$user->isBanned() ? __("Banned") : ''}}</p>
                                <p class="text-sm/6 text-red-400">{{$user->isMuted() ? __("Muted until :date_until", ['date_until' => $user->muted_until]) : ''}}</p>
                            </div>
                            @if(!$isMyself)
                                @if($user->isMuted())
                                    <form action="{{ route('users.mute', $user) }}" method="POST">
                                        @csrf
                                        <x-secondary-danger-button
                                            type="submit"
                                            color="green"
                                            class="hover:bg-green-500"
                                        >
                                            {{__("Unmute")}}
                                        </x-secondary-danger-button>
                                    </form>
                                @else
                                <x-secondary-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'user-mute-{{$user->id}}')"
                                >
                                    {{__("Mute")}}
                                </x-secondary-danger-button>
                                <x-modal name="user-mute-{{$user->id}}" :show="$errors->userMute->isNotEmpty()" focusable>
                                    <form method="POST" action="{{ route('users.mute', $user) }}" class="p-6">
                                        @csrf

                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-3">
                                            {{ __('Mute until') }}
                                        </h2>

                                        <x-text-input type="datetime-local" name="until" value="{{\Carbon\Carbon::now()->addDay(14)->format('Y-m-d H:i')}}" min="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}" max="2038-01-01T00:00"/>

                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>

                                            <x-danger-button class="ms-3">
                                                {{ __('Mute') }}
                                            </x-danger-button>
                                        </div>
                                    </form>
                                </x-modal>
                                @endif
                                @if($user->isBanned())
                                    <form action="{{ route('users.ban', $user) }}" method="POST">
                                        @csrf
                                        <x-secondary-danger-button
                                            type="submit"
                                            color="yellow"
                                            class="hover:bg-yellow-500"
                                        >
                                            {{__("Unban")}}
                                        </x-secondary-danger-button>
                                    </form>
                                @else
                                <x-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'user-ban-{{$user->id}}')"
                                >
                                    {{__("Ban")}}
                                </x-danger-button>
                                <x-modal name="user-ban-{{$user->id}}" :show="$errors->userBan->isNotEmpty()" focusable>
                                    <form method="POST" action="{{ route('users.ban', $user) }}" class="p-6">
                                        @csrf

                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-3">
                                            {{ __('Ban until') }}
                                        </h2>

                                        <x-text-input type="datetime-local" name="until" value="{{\Carbon\Carbon::now()->addDay(14)->format('Y-m-d H:i')}}" min="{{\Carbon\Carbon::now()->format('Y-m-d H:i')}}" max="2038-01-01T00:00"/>

                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>

                                            <x-danger-button class="ms-3">
                                                {{ __('Ban') }}
                                            </x-danger-button>
                                        </div>
                                    </form>
                                </x-modal>
                                @endif
                            @endif
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </x-card>
</x-app-layout>
