@props([
    'action', 'method' => 'post'
])
<section class="flex h-[100vh] flex-col md:flex-row">
    <aside class="basis-1/3 bg-[#ffbb33] px-[1em]">
        <img src="https://res.cloudinary.com/hz3gmuqw6/image/upload/f_auto,dpr_2.0/v1649162527/pages/homepage/cozymeal-logo.png"
             alt="Cozy meal"
             class="max-w-full m-auto mt-10 block"
        >
    </aside>
    <div class="basis-2/3 flex px-[1em]">
        <form action="{{$action}}" method="{{$method}}" class="m-auto w-full max-w-[450px]">
            {{ $slot }}
        </form>
    </div>
</section>
