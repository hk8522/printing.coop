<?php

namespace App\Common;

class ProductAttributeType {
    const Normal = '0';
    const Size = 1;
    const Quantity = 2;

    public const names = [
        self::Normal => 'Normal',
        self::Size => 'Size',
        self::Quantity => 'Quantity',
    ];
}
