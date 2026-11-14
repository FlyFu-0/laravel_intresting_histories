<x-app-layout>
    <div class="bg-gray-200 rounded-xl flex flex-1 flex-col max-h-[80vh] dark:bg-gray-600">
        <x-card class="flex gap-5 items-center shrink-0">
            <x-user-avatar user-name="UserName"/>
            <div>
                <p>{{$chat->name}}</p>
                <span class="text-sm">Last seen 3h</span>
            </div>
        </x-card>

        <div id="messages-container" class="flex flex-col gap-3 p-3 overflow-auto flex-1">
            @foreach($chat->messages as $message)
                <x-card id="message-{{$message->id}}" class="w-fit max-w-[60%] {{$message->user->id == auth()->id() ? 'self-end' : ''}}">
                    <div class="flex justify-between text-xs gap-3">
                        <span class="font-semibold">{{$message->user->name}}</span>
                        <span>{{$message->created_at?->format('H:i')}}</span>
                    </div>
                    <div class="flex wrap">
                        {{$message->message}}
                    </div>
                </x-card>
            @endforeach
        </div>

        <div class="shrink-0 p-3">
            <form id="message-form" action="{{route('chats.message', $chat)}}" method="POST" class="flex w-full gap-3">
                @csrf
                <x-text-input id="message-input" class="w-full" name="message" autocomplete="off" />
                <x-secondary-button type="submit" class="rounded-full">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.5003 12H5.41872M5.24634 12.7972L4.24158 15.7986C3.69128 17.4424 3.41613 18.2643 3.61359 18.7704C3.78506 19.21 4.15335 19.5432 4.6078 19.6701C5.13111 19.8161 5.92151 19.4604 7.50231 18.7491L17.6367 14.1886C19.1797 13.4942 19.9512 13.1471 20.1896 12.6648C20.3968 12.2458 20.3968 11.7541 20.1896 11.3351C19.9512 10.8529 19.1797 10.5057 17.6367 9.81135L7.48483 5.24303C5.90879 4.53382 5.12078 4.17921 4.59799 4.32468C4.14397 4.45101 3.77572 4.78336 3.60365 5.22209C3.40551 5.72728 3.67772 6.54741 4.22215 8.18767L5.24829 11.2793C5.34179 11.561 5.38855 11.7019 5.407 11.8459C5.42338 11.9738 5.42321 12.1032 5.40651 12.231C5.38768 12.375 5.34057 12.5157 5.24634 12.7972Z" stroke="currentColor" color="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </x-secondary-button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chatId = {{ $chat->id }};
                const currentUserId = {{ auth()->id() }};
                const container = document.getElementById('messages-container');
                const form = document.getElementById('message-form');
                const input = document.getElementById('message-input');

                function appendMessage(data, isOwn = false) {
                    if (document.getElementById('message-' + data.id)) {
                        return;
                    }

                    const card = document.createElement('div');
                    card.id = 'message-' + data.id;
                    card.className = 'rounded-xl p-3 shadow-md bg-white dark:bg-gray-800 dark:text-gray-100 w-fit max-w-[60%]'
                        + (isOwn || data.user_id === currentUserId ? ' self-end' : '');

                    const header = document.createElement('div');
                    header.className = 'flex justify-between text-xs gap-3';

                    const nameSpan = document.createElement('span');
                    nameSpan.className = 'font-semibold';
                    nameSpan.textContent = data.user_name;

                    const timeSpan = document.createElement('span');
                    timeSpan.textContent = data.created_at;

                    header.appendChild(nameSpan);
                    header.appendChild(timeSpan);

                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'flex wrap';
                    messageDiv.textContent = data.message;

                    card.appendChild(header);
                    card.appendChild(messageDiv);
                    container.appendChild(card);
                    container.scrollTop = container.scrollHeight;
                }

                if (window.Echo) {
                    window.Echo.private('chat.' + chatId)
                        .listen('.message.created', (data) => {
                            appendMessage(data, data.user_id === currentUserId);
                        });
                } else {
                    console.error('Laravel Echo is not initialized');
                }

                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const message = input.value.trim();
                    if (!message) return;

                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: JSON.stringify({ message }),
                    })
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Failed to send message');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            if (data.success) {
                                appendMessage(data.message, true);
                                input.value = '';
                            }
                        })
                        .catch((error) => console.error('Error:', error));
                });

                container.scrollTop = container.scrollHeight;
            });
        </script>
    @endpush
</x-app-layout>
