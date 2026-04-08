@props(['value'])

@php
    $palette = match ((string) $value) {
        'available', 'paid', 'released', 'completed', 'ok' => 'bg-emerald-100 text-emerald-700',
        'reserved', 'pending', 'draft' => 'bg-amber-100 text-amber-700',
        'active', 'confirmed', 'converted', 'collected' => 'bg-sky-100 text-sky-700',
        'maintenance', 'partially_withheld', 'overdue', 'damaged' => 'bg-orange-100 text-orange-700',
        'cancelled', 'failed', 'unavailable' => 'bg-rose-100 text-rose-700',
        default => 'bg-slate-100 text-slate-700',
    };
@endphp

<span {{ $attributes->class("inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide {$palette}") }}>
    {{ str($value)->replace('_', ' ')->title() }}
</span>
