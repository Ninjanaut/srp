<?php
declare(strict_types=1);

namespace App\Utils;

class Check
{
    public static function IsEmpty(string $value): bool
    {
        return trim($value) == '';
    }

    public static function ID(int $value): bool
    {
        return $value > 0;
    }
}