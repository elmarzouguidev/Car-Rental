@props(['name', 'label', 'value' => null])

<label class="flex flex-col gap-2">
    <span class="text-sm font-medium text-slate-700">{{ $label }}</span>
    <textarea
        name="{{ $name }}"
        rows="4"
        {{ $attributes->class('rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm outline-none transition focus:border-slate-400') }}
    >{{ old($name, $value) }}</textarea>
</label>
