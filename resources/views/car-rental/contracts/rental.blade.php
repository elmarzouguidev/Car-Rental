<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #0f172a; }
        .page { padding: 12px; }
        .header { border-bottom: 2px solid #0f172a; padding-bottom: 12px; margin-bottom: 18px; }
        .title { font-size: 24px; font-weight: bold; }
        .grid { width: 100%; margin-bottom: 18px; }
        .grid td { width: 50%; vertical-align: top; padding: 6px 0; }
        .box { border: 1px solid #cbd5e1; border-radius: 8px; padding: 12px; margin-bottom: 14px; }
        .label { font-size: 10px; text-transform: uppercase; color: #64748b; }
        .value { font-size: 13px; font-weight: bold; margin-top: 4px; }
        .signature { margin-top: 32px; }
        .signature td { padding-top: 48px; width: 50%; }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="title">Rental Contract</div>
            <div>Contract No. {{ $rental->rental_number }}</div>
            <div>Date: {{ now()->format('d/m/Y') }}</div>
        </div>

        <table class="grid">
            <tr>
                <td>
                    <div class="box">
                        <div class="label">Customer</div>
                        <div class="value">{{ $rental->customer->fullName() }}</div>
                        <div>{{ $rental->customer->phone }}</div>
                        <div>{{ $rental->customer->driving_license_number ?: 'License pending' }}</div>
                    </div>
                </td>
                <td>
                    <div class="box">
                        <div class="label">Vehicle</div>
                        <div class="value">{{ $rental->vehicle->brand }} {{ $rental->vehicle->model }}</div>
                        <div>Plate: {{ $rental->vehicle->plate_number }}</div>
                        <div>VIN: {{ $rental->vehicle->vin ?: 'N/A' }}</div>
                    </div>
                </td>
            </tr>
        </table>

        <div class="box">
            <div class="label">Rental Terms</div>
            <div class="value">{{ $rental->starts_at->format('d/m/Y H:i') }} to {{ $rental->ends_at->format('d/m/Y H:i') }}</div>
            <div>Pickup: {{ $rental->pickup_location ?: 'Agency office' }}</div>
            <div>Return: {{ $rental->return_location ?: 'Agency office' }}</div>
            <div>Daily rate: {{ number_format($rental->daily_rate, 2) }} MAD</div>
            <div>Total amount: {{ number_format($rental->total_amount, 2) }} MAD</div>
            <div>Deposit: {{ number_format(optional($rental->deposit->first())->amount ?? 0, 2) }} MAD</div>
        </div>

        <div class="box">
            <div class="label">Conditions</div>
            <div>The renter agrees to return the vehicle in the recorded condition and on the scheduled date.</div>
            <div>Any damages, fines, or missing fuel may be deducted from the deposit according to the return inspection.</div>
        </div>

        <table class="signature">
            <tr>
                <td>Agency Signature: __________________________</td>
                <td>Customer Signature: ________________________</td>
            </tr>
        </table>
    </div>
</body>
</html>
