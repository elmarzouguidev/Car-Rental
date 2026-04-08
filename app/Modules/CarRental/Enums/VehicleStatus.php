<?php

namespace App\Modules\CarRental\Enums;

enum VehicleStatus: string
{
    case Available = 'available';
    case Reserved = 'reserved';
    case Rented = 'rented';
    case Maintenance = 'maintenance';
    case Unavailable = 'unavailable';
}
