<x-layouts.car-rental :heading="$customer->fullName()" :subheading="$customer->phone">
    <div class="grid gap-6 lg:grid-cols-[1.3fr_0.7fr]">
        <section class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Customer Profile</h2>
                <a href="{{ route('car-rental.customers.edit', $customer) }}" class="rounded-full bg-slate-100 px-4 py-2 text-sm">Edit</a>
            </div>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <div><span class="text-sm text-slate-500">National ID</span><p class="mt-1 font-medium">{{ $customer->national_id_number ?: 'N/A' }}</p></div>
                <div><span class="text-sm text-slate-500">Driving License</span><p class="mt-1 font-medium">{{ $customer->driving_license_number ?: 'N/A' }}</p></div>
                <div><span class="text-sm text-slate-500">License Expiry</span><p class="mt-1 font-medium">{{ optional($customer->driving_license_expires_at)->format('d/m/Y') ?: 'N/A' }}</p></div>
                <div><span class="text-sm text-slate-500">City</span><p class="mt-1 font-medium">{{ $customer->city ?: 'N/A' }}</p></div>
                <div class="md:col-span-2"><span class="text-sm text-slate-500">Notes</span><p class="mt-1 text-sm text-slate-700">{{ $customer->notes ?: 'No notes recorded.' }}</p></div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-white/70 bg-white/90 p-6 shadow-sm">
            <h2 class="text-lg font-semibold">Documents</h2>
            <div class="mt-4 space-y-3 text-sm">
                @forelse ($customer->documents as $document)
                    <a href="{{ Storage::disk('public')->url($document->file_path) }}" target="_blank" class="block rounded-2xl bg-slate-50 px-4 py-3">
                        <p class="font-medium">{{ str($document->type->value)->replace('_', ' ')->title() }}</p>
                    </a>
                @empty
                    <p class="text-slate-500">No documents uploaded.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-layouts.car-rental>
