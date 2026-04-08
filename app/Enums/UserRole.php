<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Manager = 'manager';
    case Agent = 'agent';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Manager => 'Manager',
            self::Agent => 'Agent',
        };
    }

    public function canManageSettings(): bool
    {
        return $this === self::Admin;
    }

    public function canManageOperations(): bool
    {
        return $this === self::Admin || $this === self::Manager;
    }
}
