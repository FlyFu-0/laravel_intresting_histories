@props([
    'title',
    'description'
])

<dl class="space-y-10">
    <div>
        <dt class="text-base/7 font-semibold text-gray-900">{{$title}}</dt>
        <dd class="mt-2 text-base/7 text-gray-600">{{$description}}</dd>
    </div>
</dl>
