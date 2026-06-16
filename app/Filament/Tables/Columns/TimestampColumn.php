<?php

declare(strict_types=1);

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

final class TimestampColumn extends TextColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->since()
            ->dateTimeTooltip()
            ->sortable()
            ->toggleable()
            ->label(
                fn () => Str::of($this->getName())
                    ->snake(' ')
                    ->replace('_', ' ')
                    ->replaceEnd(' at', '')
                    ->apa()
            );
    }
}
