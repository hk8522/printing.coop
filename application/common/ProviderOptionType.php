<?php

namespace App\Common;

class ProviderOptionType {
    const Quantity = 0;
    const Size = 1;
    const Normal = 2;
    const Turnaround = 0xFFFF;

    public const names = [
        self::Quantity => 'Quantity',
        self::Size => 'Size',
        self::Normal => 'Normal',
        self::Turnaround => 'Turnaround',
    ];
}
