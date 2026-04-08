<x-layouts.car-rental :heading="$reservation->exists ? 'Edit Reservation' : 'New Reservation'" subheading="Plan customer bookings and vehicle allocation">
    <form method="POST" action="{{ $reservation->exists ? route('car-rental.reservations.update', $reservation) : route('car-rental.reservations.store') }}" class="grid gap-6 rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
        @csrf
        @if ($reservation->exists)
            @method('PUT')
        @endif

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <x-form.select name="vehicle_id" label="Vehicle" :options="$vehicles->mapWithKeys(fn ($vehicle) => [$vehicle->id => $vehicle->plate_number.' · '.$vehicle->brand.' '.$vehicle->model])->all()" :value="$reservation->vehicle_id" />
            <x-form.select name="customer_id" label="Customer" :options="$customers->mapWithKeys(fn ($customer) => [$customer->id => $customer->fullName().' · '.$customer->phone])->all()" :value="$reservation->customer_id" />
            <x-form.input name="pickup_at" label="Pickup At" type="datetime-local" :value="optional($reservation->pickup_at)->format('Y-m-d\TH:i')" />
            <x-form.input name="return_at" label="Return At" type="datetime-local" :value="optional($reservation->return_at)->format('Y-m-d\TH:i')" />
            <x-form.input name="pickup_location" label="Pickup Location" :value="$reservation->pickup_location" />
            <x-form.input name="return_location" label="Return Location" :value="$reservation->return_location" />
            <x-form.input name="daily_rate" label="Daily Rate (MAD)" type="number" step="0.01" :value="$reservation->daily_rate" />
            <x-form.input name="estimated_total" label="Estimated Total (MAD)" type="number" step="0.01" :value="$reservation->estimated_total" />
        </div>

        <x-form.textarea name="notes" label="Notes" :value="$reservation->notes" />

        <div class="flex justify-end">
            <button class="rounded-full bg-slate-900 px-5 py-2.5 text-sm font-medium text-white">Save Reservation</button>
        </div>
    </form>
</x-layouts.car-rental>
