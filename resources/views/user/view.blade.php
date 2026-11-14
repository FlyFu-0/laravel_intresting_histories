<x-app-layout>
    <x-card class="py-10 px-6">
        <div class="flex items-center justify-between">
            <div class="flex gap-3 items-center">
            <x-user-avatar user-name="{{$user->name}}"/>
            <div class="flex flex-col">
                <span class="font-semibold">{{$user->name}}</span>
                <a href="mailto:{{$user->email}}">{{$user->email}}</a>
            </div>
            </div>
            <form method="POST" action="{{ route('chats.create') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <x-primary-button>
                    {{__('Message')}}
                </x-primary-button>
            </form>
        </div>
    </x-card>
</x-app-layout>
