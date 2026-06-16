<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use Filament\Actions\Action;
use Filament\Support\Enums\Width;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;

final class FilamentDefaultsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->configureTables();
    }

    /**
     * Configure the application's Filament tables.
     */
    private function configureTables(): void
    {
        Table::configureUsing(fn (Table $table): Table => $table
            ->reorderableColumns()
            ->columnManagerColumns(2)
            ->columnManagerTriggerAction(fn (Action $action): Action => $action->button()->label('Columns'))
            ->filtersTriggerAction(fn (Action $action): Action => $action->button()->label('Filters')->slideOver()->closeModalByClickingAway(true))
            ->filtersFormWidth(Width::Small)
            ->paginationPageOptions([10, 25, 50, 100])
        );
    }
}
