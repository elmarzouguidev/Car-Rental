@props(['name', 'label', 'type' => 'text', 'value' => null])

<label class="flex flex-col gap-2">
    <span class="text-sm font-medium text-slate-700">{{ $label }}</span>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->class('rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm outline-none transition focus:border-slate-400') }}
    >
</label>
