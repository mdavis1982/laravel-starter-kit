<?php

declare(strict_types=1);

namespace App\Filament\Components\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use FuzzyFox\Lucide\Lucide;

final class IdentifierColumn extends TextColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->fontFamily('mono')
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true)
            ->copyable()
            ->copyMessage('ID copied')
            ->icon(Lucide::ClipboardCopy)
            ->label('ID');
    }
}
