<?php

namespace App\Modules\CarRental\Enums;

enum InspectionItemStatus: string
{
    case Ok = 'ok';
    case Noted = 'noted';
    case Damaged = 'damaged';
}
