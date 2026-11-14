@props([
    'shortName',
    'bgColor' => 'bg-gray-500',
    'size' => 'size-14',
    'textSize' => 'text-xl'
])

<span class="inline-flex {{$size}} items-center justify-center rounded-full {{$bgColor}}">
  <span class="{{$textSize}} font-medium text-white">{{$shortName}}</span>
</span>
