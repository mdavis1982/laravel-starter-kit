<?php

declare(strict_types=1);

use App\Providers\ActionsServiceProvider;
use App\Providers\AppServiceProvider;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\Filament\FilamentDefaultsProvider;

return [
    ActionsServiceProvider::class,
    AppServiceProvider::class,
    FilamentDefaultsProvider::class,
    AdminPanelProvider::class,
];
