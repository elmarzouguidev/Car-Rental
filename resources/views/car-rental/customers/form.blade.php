<x-layouts.car-rental :heading="$customer->exists ? 'Edit Customer' : 'Add Customer'" subheading="Keep rental contracts and identification complete">
    <form method="POST" action="{{ $customer->exists ? route('car-rental.customers.update', $customer) : route('car-rental.customers.store') }}" enctype="multipart/form-data" class="grid gap-6 rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
        @csrf
        @if ($customer->exists)
            @method('PUT')
        @endif

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <x-form.input name="first_name" label="First Name" :value="$customer->first_name" />
            <x-form.input name="last_name" label="Last Name" :value="$customer->last_name" />
            <x-form.input name="phone" label="Phone" :value="$customer->phone" />
            <x-form.input name="email" label="Email" type="email" :value="$customer->email" />
            <x-form.input name="national_id_number" label="National ID" :value="$customer->national_id_number" />
            <x-form.input name="passport_number" label="Passport Number" :value="$customer->passport_number" />
            <x-form.input name="driving_license_number" label="Driving License Number" :value="$customer->driving_license_number" />
            <x-form.input name="driving_license_expires_at" label="License Expiry" type="date" :value="optional($customer->driving_license_expires_at)->format('Y-m-d')" />
            <x-form.input name="birth_date" label="Birth Date" type="date" :value="optional($customer->birth_date)->format('Y-m-d')" />
            <x-form.input name="address" label="Address" :value="$customer->address" />
            <x-form.input name="city" label="City" :value="$customer->city" />
            <x-form.input name="country" label="Country" :value="$customer->country" />
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($documentLabels as $type => $label)
                <x-form.file-upload :name="'documents['.$type.']'" :label="$label" />
            @endforeach
        </div>

        <x-form.textarea name="notes" label="Notes" :value="$customer->notes" />

        <div class="flex justify-end">
            <button class="rounded-full bg-slate-900 px-5 py-2.5 text-sm font-medium text-white">Save Customer</button>
        </div>
    </form>
</x-layouts.car-rental>
