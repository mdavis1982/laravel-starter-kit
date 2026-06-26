<?php

declare(strict_types=1);

namespace App\Filament\Enums;

use Filament\Support\Contracts\HasLabel;

enum NavigationGroup implements HasLabel
{
    case Content;

    public function label(): string
    {
        return match ($this) {
            self::Content => 'Content',
        };
    }

    public function getLabel(): string
    {
        return $this->label();
    }
}
