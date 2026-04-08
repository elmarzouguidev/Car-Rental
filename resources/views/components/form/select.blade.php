@props(['name', 'label', 'options' => [], 'value' => null])

<label class="flex flex-col gap-2">
    <span class="text-sm font-medium text-slate-700">{{ $label }}</span>
    <select
        name="{{ $name }}"
        {{ $attributes->class('rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm outline-none transition focus:border-slate-400') }}
    >
        <option value="">Select...</option>
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected((string) old($name, $value) === (string) $optionValue)>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</label>
