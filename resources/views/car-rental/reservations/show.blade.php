<x-layouts.car-rental :heading="$reservation->reservation_number" subheading="Reservation detail and conversion controls">
    <div class="grid gap-6 lg:grid-cols-[1.25fr_0.75fr]">
        <section class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Reservation Summary</h2>
                <div class="flex gap-2">
                    <a href="{{ route('car-rental.reservations.edit', $reservation) }}" class="rounded-full bg-slate-100 px-4 py-2 text-sm">Edit</a>
                    <form method="POST" action="{{ route('car-rental.reservations.confirm', $reservation) }}">
                        @csrf
                        <button class="rounded-full bg-amber-500 px-4 py-2 text-sm font-medium text-white">Confirm</button>
                    </form>
                    <form method="POST" action="{{ route('car-rental.reservations.convert', $reservation) }}">
                        @csrf
                        <button class="rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white">Convert to Rental</button>
                    </form>
                </div>
            </div>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <div><span class="text-sm text-slate-500">Customer</span><p class="mt-1 font-medium">{{ $reservation->customer->fullName() }}</p></div>
                <div><span class="text-sm text-slate-500">Vehicle</span><p class="mt-1 font-medium">{{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}</p></div>
                <div><span class="text-sm text-slate-500">Pickup</span><p class="mt-1 font-medium">{{ $reservation->pickup_at->format('d/m/Y H:i') }}</p></div>
                <div><span class="text-sm text-slate-500">Return</span><p class="mt-1 font-medium">{{ $reservation->return_at->format('d/m/Y H:i') }}</p></div>
                <div><span class="text-sm text-slate-500">Estimated Total</span><p class="mt-1 font-medium">{{ number_format($reservation->estimated_total, 2) }} MAD</p></div>
                <div><span class="text-sm text-slate-500">Status</span><div class="mt-1"><x-status-badge :value="$reservation->status->value" /></div></div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
            <h2 class="text-lg font-semibold">Operational Notes</h2>
            <p class="mt-4 text-sm text-slate-600">{{ $reservation->notes ?: 'No operational notes recorded.' }}</p>
        </section>
    </div>
</x-layouts.car-rental>
