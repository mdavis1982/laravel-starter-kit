<?php

declare(strict_types=1);

use App\Providers\ActionsServiceProvider;
use App\Providers\AppServiceProvider;
use App\Providers\Filament\AdminPanelProvider;

return [
    ActionsServiceProvider::class,
    AppServiceProvider::class,
    AdminPanelProvider::class,
];
