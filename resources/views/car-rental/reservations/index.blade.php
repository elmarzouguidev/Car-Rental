<x-layouts.car-rental heading="Reservation Management" subheading="Create bookings, confirm them, and avoid double allocation">
    <div class="mb-4 flex items-center justify-between">
        <div></div>
        <a href="{{ route('car-rental.reservations.create') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white">New Reservation</a>
    </div>
    <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/90 shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left text-slate-500">
                <tr>
                    <th class="px-5 py-4">Reservation</th>
                    <th class="px-5 py-4">Customer</th>
                    <th class="px-5 py-4">Vehicle</th>
                    <th class="px-5 py-4">Dates</th>
                    <th class="px-5 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($reservations as $reservation)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4"><a href="{{ route('car-rental.reservations.show', $reservation) }}" class="font-medium">{{ $reservation->reservation_number }}</a></td>
                        <td class="px-5 py-4">{{ $reservation->customer->fullName() }}</td>
                        <td class="px-5 py-4">{{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}</td>
                        <td class="px-5 py-4">{{ $reservation->pickup_at->format('d/m H:i') }} - {{ $reservation->return_at->format('d/m H:i') }}</td>
                        <td class="px-5 py-4"><x-status-badge :value="$reservation->status->value" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $reservations->links() }}</div>
</x-layouts.car-rental>
