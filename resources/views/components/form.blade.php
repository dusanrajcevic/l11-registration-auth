@props([
    'action', 'method' => 'post'
])
<form action="{{$action}}" method="{{$method}}">
    {{ $slot }}
</form>
