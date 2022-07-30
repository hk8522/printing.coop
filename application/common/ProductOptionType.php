<?php

namespace App\Common;

class ProductOptionType {
    const Quantity = 0;
    const Size = 1;
    const Normal = 2;

    public const names = [
        self::Quantity => 'Quantity',
        self::Size => 'Size',
        self::Normal => 'Normal',
    ];
}
