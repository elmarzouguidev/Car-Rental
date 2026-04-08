@props(['name', 'label', 'multiple' => false])

<label class="flex flex-col gap-2">
    <span class="text-sm font-medium text-slate-700">{{ $label }}</span>
    <input
        type="file"
        name="{{ $multiple ? $name.'[]' : $name }}"
        @if ($multiple) multiple @endif
        {{ $attributes->class('rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-4 text-sm text-slate-600') }}
    >
</label>
