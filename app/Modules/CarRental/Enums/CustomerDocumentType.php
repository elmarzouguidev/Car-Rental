<?php

namespace App\Modules\CarRental\Enums;

enum CustomerDocumentType: string
{
    case IdentityCard = 'identity_card';
    case Passport = 'passport';
    case DrivingLicense = 'driving_license';
    case ProofOfAddress = 'proof_of_address';
}
