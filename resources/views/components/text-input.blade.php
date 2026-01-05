@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/5 border-white/10 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-white font-bold p-3 placeholder:text-slate-500']) }}>