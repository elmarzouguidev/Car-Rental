<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Car Rental CRM' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[linear-gradient(180deg,#f7efe5_0%,#f4f7fb_55%,#eef4f8_100%)] text-slate-900">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-6 sm:px-6 lg:px-8">
        <header class="mb-6 rounded-[2rem] border border-white/70 bg-white/85 px-6 py-5 shadow-[0_18px_60px_-30px_rgba(15,23,42,0.45)] backdrop-blur">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">Moroccan Car Rental Agency</p>
                    <h1 class="mt-2 text-3xl font-semibold tracking-tight">{{ $heading ?? 'Car Rental CRM' }}</h1>
                    <p class="mt-1 text-sm text-slate-600">{{ $subheading ?? 'Internal operations dashboard' }}</p>
                </div>
                <nav class="flex flex-wrap gap-2 text-sm">
                    <a href="{{ route('car-rental.dashboard') }}" class="rounded-full px-4 py-2 {{ request()->routeIs('car-rental.dashboard') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700' }}">Dashboard</a>
                    <a href="{{ route('car-rental.vehicles.index') }}" class="rounded-full px-4 py-2 {{ request()->routeIs('car-rental.vehicles.*') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700' }}">Fleet</a>
                    <a href="{{ route('car-rental.customers.index') }}" class="rounded-full px-4 py-2 {{ request()->routeIs('car-rental.customers.*') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700' }}">Customers</a>
                    <a href="{{ route('car-rental.reservations.index') }}" class="rounded-full px-4 py-2 {{ request()->routeIs('car-rental.reservations.*') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700' }}">Reservations</a>
                    <a href="{{ route('car-rental.rentals.index') }}" class="rounded-full px-4 py-2 {{ request()->routeIs('car-rental.rentals.*') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700' }}">Rentals</a>
                </nav>
            </div>
        </header>

        @if (session('status'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <p class="font-semibold">Please fix the highlighted issues.</p>
                <ul class="mt-2 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main class="flex-1">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
