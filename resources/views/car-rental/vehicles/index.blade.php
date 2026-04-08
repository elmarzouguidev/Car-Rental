<x-layouts.car-rental heading="Fleet Management" subheading="Manage vehicles, rates, documents, and operational status">
    <div class="mb-4 flex items-center justify-between">
        <div></div>
        <a href="{{ route('car-rental.vehicles.create') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white">Add Vehicle</a>
    </div>
    <div class="grid gap-4 lg:grid-cols-3">
        @foreach ($vehicles as $vehicle)
            <a href="{{ route('car-rental.vehicles.show', $vehicle) }}" class="rounded-[2rem] border border-white/70 bg-white/90 p-5 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-lg font-semibold">{{ $vehicle->brand }} {{ $vehicle->model }}</p>
                        <p class="text-sm text-slate-500">{{ $vehicle->plate_number }}</p>
                    </div>
                    <x-status-badge :value="$vehicle->status->value" />
                </div>
                <dl class="mt-5 grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-slate-500">Daily Rate</dt>
                        <dd class="font-medium">{{ number_format($vehicle->daily_rate, 2) }} MAD</dd>
                    </div>
                    <div>
                        <dt class="text-slate-500">Mileage</dt>
                        <dd class="font-medium">{{ number_format($vehicle->mileage) }} km</dd>
                    </div>
                    <div>
                        <dt class="text-slate-500">Fuel</dt>
                        <dd class="font-medium">{{ $vehicle->fuel_type ?: 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-slate-500">Transmission</dt>
                        <dd class="font-medium">{{ $vehicle->transmission ?: 'N/A' }}</dd>
                    </div>
                </dl>
            </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $vehicles->links() }}</div>
</x-layouts.car-rental>
