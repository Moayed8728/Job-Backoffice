<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-full border border-transparent bg-slate-950 px-5 py-2.5 text-xs font-black uppercase tracking-widest text-white shadow-lg shadow-slate-300/70 transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-100 active:bg-emerald-800']) }}>
    {{ $slot }}
</button>
