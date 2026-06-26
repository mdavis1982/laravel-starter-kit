<?php

declare(strict_types=1);

namespace App\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Illuminate\Support\Str;

final class TimestampEntry extends TextEntry
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->since()
            ->dateTimeTooltip()
            ->label(
                fn () => Str::of($this->getName())
                    ->snake(' ')
                    ->replace('_', ' ')
                    ->replaceEnd(' at', '')
                    ->apa()
            );
    }
}
