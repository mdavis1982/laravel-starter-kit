<?php

declare(strict_types=1);

namespace App\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontFamily;
use FuzzyFox\Lucide\Lucide;

final class IdentifierEntry extends TextEntry
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->fontFamily(FontFamily::Mono)
            ->copyable()
            ->copyMessage('ID copied')
            ->icon(Lucide::ClipboardCopy);
    }
}
