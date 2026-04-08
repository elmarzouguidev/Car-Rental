<?php

namespace App\Modules\CarRental\Enums;

enum ReservationStatus: string
{
    case Draft = 'draft';
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Converted = 'converted';
    case Cancelled = 'cancelled';
    case Completed = 'completed';
}
