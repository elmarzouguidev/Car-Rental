<x-layouts.car-rental :heading="$vehicle->brand.' '.$vehicle->model" :subheading="$vehicle->plate_number">
    <div class="grid gap-6 lg:grid-cols-[1.35fr_0.65fr]">
        <section class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Vehicle Summary</h2>
                <a href="{{ route('car-rental.vehicles.edit', $vehicle) }}" class="rounded-full bg-slate-100 px-4 py-2 text-sm">Edit</a>
            </div>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <div><span class="text-sm text-slate-500">Status</span><div class="mt-1"><x-status-badge :value="$vehicle->status->value" /></div></div>
                <div><span class="text-sm text-slate-500">Rates</span><p class="mt-1 font-medium">{{ number_format($vehicle->daily_rate, 2) }} MAD / day</p></div>
                <div><span class="text-sm text-slate-500">Deposit</span><p class="mt-1 font-medium">{{ number_format($vehicle->deposit_amount, 2) }} MAD</p></div>
                <div><span class="text-sm text-slate-500">Mileage</span><p class="mt-1 font-medium">{{ number_format($vehicle->mileage) }} km</p></div>
                <div class="md:col-span-2"><span class="text-sm text-slate-500">Notes</span><p class="mt-1 text-sm text-slate-700">{{ $vehicle->notes ?: 'No notes recorded.' }}</p></div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
            <h2 class="text-lg font-semibold">Recent Activity</h2>
            <div class="mt-4 space-y-3 text-sm">
                @forelse ($vehicle->rentals->take(5) as $rental)
                    <div class="rounded-2xl bg-slate-50 px-4 py-3">
                        <p class="font-medium">{{ $rental->rental_number }}</p>
                        <p class="text-slate-500">{{ $rental->customer->fullName() }}</p>
                    </div>
                @empty
                    <p class="text-slate-500">No rentals yet.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-layouts.car-rental>
