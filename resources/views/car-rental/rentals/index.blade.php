<x-layouts.car-rental heading="Rental Management" subheading="Track active contracts, inspections, payments, and overdue returns">
    <div class="overflow-hidden rounded-[2rem] border border-white/70 bg-white/90 shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-left text-slate-500">
                <tr>
                    <th class="px-5 py-4">Rental</th>
                    <th class="px-5 py-4">Customer</th>
                    <th class="px-5 py-4">Vehicle</th>
                    <th class="px-5 py-4">Period</th>
                    <th class="px-5 py-4">Deposit</th>
                    <th class="px-5 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($rentals as $rental)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4"><a href="{{ route('car-rental.rentals.show', $rental) }}" class="font-medium">{{ $rental->rental_number }}</a></td>
                        <td class="px-5 py-4">{{ $rental->customer->fullName() }}</td>
                        <td class="px-5 py-4">{{ $rental->vehicle->plate_number }}</td>
                        <td class="px-5 py-4">{{ $rental->starts_at->format('d/m H:i') }} - {{ $rental->ends_at->format('d/m H:i') }}</td>
                        <td class="px-5 py-4">{{ number_format(optional($rental->deposit)->amount ?? 0, 2) }} MAD</td>
                        <td class="px-5 py-4"><x-status-badge :value="$rental->status->value" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $rentals->links() }}</div>
</x-layouts.car-rental>
