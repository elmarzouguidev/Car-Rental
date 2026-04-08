<x-layouts.car-rental :heading="$rental->rental_number" subheading="Rental operations, inspections, deposit, payments, and contract">
    <div class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
        <section class="space-y-6">
            <div class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold">Rental Summary</h2>
                        <p class="mt-1 text-sm text-slate-500">{{ $rental->customer->fullName() }} · {{ $rental->vehicle->brand }} {{ $rental->vehicle->model }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('car-rental.rentals.contract', $rental) }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white">Contract PDF</a>
                        <form method="POST" action="{{ route('car-rental.rentals.return', $rental) }}">
                            @csrf
                            <button class="rounded-full bg-emerald-600 px-4 py-2 text-sm font-medium text-white">Process Return</button>
                        </form>
                    </div>
                </div>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    <div><span class="text-sm text-slate-500">Status</span><div class="mt-1"><x-status-badge :value="$rental->status->value" /></div></div>
                    <div><span class="text-sm text-slate-500">Total</span><p class="mt-1 font-medium">{{ number_format($rental->total_amount, 2) }} MAD</p></div>
                    <div><span class="text-sm text-slate-500">Start</span><p class="mt-1 font-medium">{{ $rental->starts_at->format('d/m/Y H:i') }}</p></div>
                    <div><span class="text-sm text-slate-500">End</span><p class="mt-1 font-medium">{{ $rental->ends_at->format('d/m/Y H:i') }}</p></div>
                </div>
            </div>

            <div class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
                <h2 class="text-lg font-semibold">Inspections</h2>
                <div class="mt-4 space-y-4">
                    @foreach ($rental->inspections as $inspection)
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <div class="flex items-center justify-between">
                                <p class="font-medium">{{ str($inspection->type->value)->title() }} Inspection</p>
                                <x-status-badge :value="$inspection->type->value" />
                            </div>
                            <p class="mt-1 text-sm text-slate-500">{{ $inspection->inspected_at->format('d/m/Y H:i') }} · {{ number_format($inspection->mileage) }} km</p>
                        </div>
                    @endforeach
                </div>

                <form method="POST" action="{{ route('car-rental.inspections.store', $rental) }}" enctype="multipart/form-data" class="mt-6 grid gap-4 rounded-2xl bg-slate-50 p-4">
                    @csrf
                    <div class="grid gap-4 md:grid-cols-2">
                        <x-form.select name="type" label="Inspection Type" :options="['pickup' => 'Pickup', 'return' => 'Return']" />
                        <x-form.input name="inspected_at" label="Inspected At" type="datetime-local" :value="now()->format('Y-m-d\TH:i')" />
                        <x-form.input name="mileage" label="Mileage" type="number" :value="$rental->vehicle->mileage" />
                        <x-form.input name="fuel_level" label="Fuel Level" />
                    </div>
                    <x-form.textarea name="notes" label="Inspection Notes" />
                    <x-form.file-upload name="photos" label="Inspection Photos" :multiple="true" />
                    <button class="w-fit rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white">Save Inspection</button>
                </form>
            </div>
        </section>

        <section class="space-y-6">
            <div class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
                <h2 class="text-lg font-semibold">Deposit</h2>
                @php($deposit = $rental->deposit)
                <div class="mt-4">
                    <p class="text-sm text-slate-500">Amount</p>
                    <p class="mt-1 text-2xl font-semibold">{{ number_format($deposit?->amount ?? 0, 2) }} MAD</p>
                </div>
                @if ($deposit)
                    <form method="POST" action="{{ route('car-rental.deposits.update', $deposit) }}" class="mt-4 grid gap-4">
                        @csrf
                        @method('PATCH')
                        <x-form.select name="status" label="Deposit Status" :options="['pending' => 'Pending', 'collected' => 'Collected', 'partially_withheld' => 'Partially Withheld', 'released' => 'Released']" :value="$deposit->status->value" />
                        <x-form.input name="withheld_amount" label="Withheld Amount" type="number" step="0.01" :value="$deposit->withheld_amount" />
                        <x-form.textarea name="notes" label="Deposit Notes" :value="$deposit->notes" />
                        <button class="w-fit rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white">Update Deposit</button>
                    </form>
                @endif
            </div>

            <div class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
                <h2 class="text-lg font-semibold">Payments</h2>
                <div class="mt-4 space-y-3">
                    @forelse ($rental->payments as $payment)
                        <div class="rounded-2xl bg-slate-50 px-4 py-3">
                            <div class="flex items-center justify-between">
                                <p class="font-medium">{{ number_format($payment->amount, 2) }} MAD</p>
                                <x-status-badge :value="$payment->status->value" />
                            </div>
                            <p class="mt-1 text-sm text-slate-500">{{ str($payment->method->value)->replace('_', ' ')->title() }} · {{ optional($payment->paid_at)->format('d/m/Y H:i') ?: 'Not dated' }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">No payments recorded yet.</p>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('car-rental.payments.store') }}" class="mt-6 grid gap-4 rounded-2xl bg-slate-50 p-4">
                    @csrf
                    <input type="hidden" name="rental_id" value="{{ $rental->id }}">
                    <input type="hidden" name="deposit_id" value="{{ $deposit?->id }}">
                    <div class="grid gap-4 md:grid-cols-2">
                        <x-form.input name="amount" label="Amount" type="number" step="0.01" />
                        <x-form.input name="paid_at" label="Paid At" type="datetime-local" :value="now()->format('Y-m-d\TH:i')" />
                        <x-form.select name="method" label="Method" :options="['cash' => 'Cash', 'card' => 'Card', 'bank_transfer' => 'Bank Transfer', 'check' => 'Check']" />
                        <x-form.select name="status" label="Status" :options="['paid' => 'Paid', 'pending' => 'Pending', 'refunded' => 'Refunded', 'failed' => 'Failed']" :value="'paid'" />
                    </div>
                    <x-form.input name="reference" label="Reference" />
                    <x-form.textarea name="notes" label="Payment Notes" />
                    <button class="w-fit rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white">Record Payment</button>
                </form>
            </div>
        </section>
    </div>
</x-layouts.car-rental>
