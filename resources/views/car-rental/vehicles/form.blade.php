<x-layouts.car-rental :heading="$vehicle->exists ? 'Edit Vehicle' : 'Add Vehicle'" subheading="Capture operational and pricing details for the fleet">
    <form method="POST" action="{{ $vehicle->exists ? route('car-rental.vehicles.update', $vehicle) : route('car-rental.vehicles.store') }}" enctype="multipart/form-data" class="grid gap-6 rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
        @csrf
        @if ($vehicle->exists)
            @method('PUT')
        @endif

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <x-form.input name="plate_number" label="Plate Number" :value="$vehicle->plate_number" />
            <x-form.input name="vin" label="VIN" :value="$vehicle->vin" />
            <x-form.input name="brand" label="Brand" :value="$vehicle->brand" />
            <x-form.input name="model" label="Model" :value="$vehicle->model" />
            <x-form.input name="year" label="Year" type="number" :value="$vehicle->year" />
            <x-form.input name="color" label="Color" :value="$vehicle->color" />
            <x-form.input name="fuel_type" label="Fuel Type" :value="$vehicle->fuel_type" />
            <x-form.input name="transmission" label="Transmission" :value="$vehicle->transmission" />
            <x-form.input name="daily_rate" label="Daily Rate (MAD)" type="number" step="0.01" :value="$vehicle->daily_rate" />
            <x-form.input name="weekly_rate" label="Weekly Rate (MAD)" type="number" step="0.01" :value="$vehicle->weekly_rate" />
            <x-form.input name="monthly_rate" label="Monthly Rate (MAD)" type="number" step="0.01" :value="$vehicle->monthly_rate" />
            <x-form.input name="deposit_amount" label="Deposit Amount (MAD)" type="number" step="0.01" :value="$vehicle->deposit_amount" />
            <x-form.input name="mileage" label="Mileage" type="number" :value="$vehicle->mileage" />
            <x-form.input name="registration_expires_at" label="Registration Expires" type="date" :value="optional($vehicle->registration_expires_at)->format('Y-m-d')" />
            <x-form.input name="insurance_expires_at" label="Insurance Expires" type="date" :value="optional($vehicle->insurance_expires_at)->format('Y-m-d')" />
            <x-form.select name="status" label="Status" :options="collect($statuses)->mapWithKeys(fn ($status) => [$status->value => str($status->value)->title()])->all()" :value="$vehicle->status?->value" />
        </div>

        <x-form.file-upload name="images" label="Vehicle Images" :multiple="true" />
        <x-form.textarea name="notes" label="Notes" :value="$vehicle->notes" />

        <div class="flex justify-end">
            <button class="rounded-full bg-slate-900 px-5 py-2.5 text-sm font-medium text-white">Save Vehicle</button>
        </div>
    </form>
</x-layouts.car-rental>
