@props(['icon' => '', 'classes' => ''])
<div {{ $attributes->merge(['class' => 'flex items-center gap-2 ' . $classes]) }}>
    <div class="font-semibold bg-primary w-[250px] pl-[2px] text-white py-[2px] rounded-r-[25px] flex items-center gap-2">
        <i class="{{ $icon }} text-xl bg-white text-[30px] w-[50px] text-center text-primary py-1"></i>
        <h2 class="px-2 font-bold">{{ $slot }}</h2>
    </div>
</div>
