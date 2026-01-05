@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-black text-xs uppercase tracking-widest text-slate-500 mb-2']) }}>
    {{ $value ?? $slot }}
</label>