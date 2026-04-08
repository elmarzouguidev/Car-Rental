<?php

namespace App\Modules\CarRental\Enums;

enum DepositStatus: string
{
    case Pending = 'pending';
    case Collected = 'collected';
    case PartiallyWithheld = 'partially_withheld';
    case Released = 'released';
}
