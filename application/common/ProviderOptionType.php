<?php

namespace App\Common;

class ProviderOptionType {
    const Quantity = 0;
    const Shape = 1;
    const Size = 2;
    const Width = 3;
    const Length = 4;
    const Depth = 5;
    const Diameter = 6;
    const Pages = 6;
    const Stock = 7;
    const Color = 8;
    const Finishing = 9;
    const Normal = 999;
    const Turnaround = 1000;

    public const names = [
        self::Quantity => 'Quantity',
        self::Shape => 'Shape',
        self::Size => 'Size',
        self::Width => 'Width',
        self::Length => 'Length',
        self::Depth => 'Depth',
        self::Diameter => 'Diameter',
        self::Pages => 'Pages',
        self::Stock => 'Stock',
        self::Color => 'Color',
        self::Finishing => 'Finishing',
        self::Normal => 'Normal',
        self::Turnaround => 'Turnaround',
    ];

    public const matches = [
        self::Quantity => ['qty', 'quantity'],
        self::Shape => ['shape'],
        self::Size => ['size'],
        self::Width => ['width'],
        self::Length => ['length'],
        self::Depth => ['depth'],
        self::Diameter => ['diameter'],
        self::Pages => ['pages'],
        self::Stock => ['stock'],
        self::Color => ['color'],
        self::Finishing => ['finishing'],
        self::Normal => ['normal'],
        self::Turnaround => ['turnaround'],
    ];
}
