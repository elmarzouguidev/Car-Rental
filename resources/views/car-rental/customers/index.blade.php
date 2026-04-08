<x-layouts.car-rental heading="Customer Management" subheading="Store customer identity, license, and history details">
    <div class="mb-4 flex items-center justify-between">
        <div></div>
        <a href="{{ route('car-rental.customers.create') }}" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white">Add Customer</a>
    </div>
    <div class="grid gap-4 lg:grid-cols-3">
        @foreach ($customers as $customer)
            <a href="{{ route('car-rental.customers.show', $customer) }}" class="rounded-[2rem] border border-white/70 bg-white/90 p-5 shadow-sm">
                <p class="text-lg font-semibold">{{ $customer->fullName() }}</p>
                <p class="mt-1 text-sm text-slate-500">{{ $customer->phone }}</p>
                <div class="mt-4 space-y-1 text-sm text-slate-600">
                    <p>License: {{ $customer->driving_license_number ?: 'N/A' }}</p>
                    <p>City: {{ $customer->city ?: 'N/A' }}</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $customers->links() }}</div>
</x-layouts.car-rental>
