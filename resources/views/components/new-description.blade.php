@props([
    'title',
    'description'
])

<dl class="space-y-6">
    <div>
        <dt class="text-base/7 font-semibold dark:text-gray-400 text-gray-900">{{$title}}</dt>
        <dd class="text-base/7 dark:text-gray-500 text-gray-600">{{$description}}</dd>
    </div>
</dl>
