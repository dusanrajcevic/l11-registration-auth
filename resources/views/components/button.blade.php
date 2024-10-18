@props(['type'])
<div>
    <button type="{{ $type }}"
            class="block my-3 py-3 bg-[#ff530e] hover:bg-[#f73] text-white font-bold text-center w-full"
    >{{ $slot }}</button>
</div>
