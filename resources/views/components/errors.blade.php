@props(['errors'])
@if ($errors->any())
    <ul class="text-center relative">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
