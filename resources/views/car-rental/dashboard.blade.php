<x-layouts.car-rental heading="Car Rental Dashboard" subheading="Monitor fleet, reservations, and overdue rentals at a glance">
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        @foreach ([
            'Fleet' => $stats['vehicles'],
            'Available' => $stats['availableVehicles'],
            'Reservations' => $stats['activeReservations'],
            'Active Rentals' => $stats['activeRentals'],
            'Customers' => $stats['customers'],
        ] as $label => $value)
            <div class="rounded-[1.75rem] border border-white/70 bg-white/90 p-5 shadow-sm">
                <p class="text-sm text-slate-500">{{ $label }}</p>
                <p class="mt-3 text-3xl font-semibold">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <section class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Upcoming Reservations</h2>
                <a href="{{ route('car-rental.reservations.index') }}" class="text-sm text-slate-600">View all</a>
            </div>
            <div class="mt-4 space-y-3">
                @forelse ($upcomingReservations as $reservation)
                    <a href="{{ route('car-rental.reservations.show', $reservation) }}" class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                        <div>
                            <p class="font-medium">{{ $reservation->reservation_number }}</p>
                            <p class="text-sm text-slate-500">{{ $reservation->customer->fullName() }} · {{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}</p>
                        </div>
                        <p class="text-sm text-slate-500">{{ $reservation->pickup_at->format('d/m H:i') }}</p>
                    </a>
                @empty
                    <p class="text-sm text-slate-500">No upcoming reservations.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Overdue Rentals</h2>
                <a href="{{ route('car-rental.rentals.index') }}" class="text-sm text-slate-600">View all</a>
            </div>
            <div class="mt-4 space-y-3">
                @forelse ($overdueRentals as $rental)
                    <a href="{{ route('car-rental.rentals.show', $rental) }}" class="flex items-center justify-between rounded-2xl bg-rose-50 px-4 py-3">
                        <div>
                            <p class="font-medium">{{ $rental->rental_number }}</p>
                            <p class="text-sm text-slate-500">{{ $rental->customer->fullName() }} · {{ $rental->vehicle->plate_number }}</p>
                        </div>
                        <p class="text-sm font-medium text-rose-700">{{ $rental->ends_at->diffForHumans() }}</p>
                    </a>
                @empty
                    <p class="text-sm text-slate-500">No overdue rentals.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-layouts.car-rental>
