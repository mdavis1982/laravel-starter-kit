<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rules\Password;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureDates();
        $this->enforceHttps();
        $this->configureModels();
        $this->configureMorphMap();
        $this->configurePasswordValidation();
        $this->configureTesting();
        $this->configureVite();
    }

    /**
     * Configure the application's commands.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction()
        );
    }

    /**
     * Configure the application's date handling.
     */
    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    /**
     * Force the application to use HTTPS.
     */
    private function enforceHttps(): void
    {
        URL::forceHttps();
    }

    /**
     * Configure the application's models.
     */
    private function configureModels(): void
    {
        Model::unguard();
        Model::preventSilentlyDiscardingAttributes();
        Model::preventAccessingMissingAttributes();

        // Prevent lazy loading always...
        Model::preventLazyLoading();

        // ...but in production, log the violation instead of throwing an exception.
        if (app()->isProduction()) {
            Model::handleLazyLoadingViolationUsing(function (Model $model, string $attribute): void {
                logger()->warning(
                    'Lazy loading violation detected.',
                    [
                        'model' => $model::class,
                        'attribute' => $attribute,
                    ]
                );
            });
        }
    }

    /**
     * Configure the application's morph map.
     */
    private function configureMorphMap(): void
    {
        Relation::enforceMorphMap([
            'user' => User::class,
        ]);
    }

    /**
     * Configure the application's password validation rules.
     */
    private function configurePasswordValidation(): void
    {
        Password::defaults(function () {
            if (! app()->isProduction() || ! app()->runningUnitTests()) {
                return null;
            }

            return Password::min(8)
                ->max(255)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });
    }

    /**
     * Configure the application's testing environment.
     */
    private function configureTesting(): void
    {
        if (! app()->runningUnitTests()) {
            return;
        }

        Http::preventStrayRequests();
        Sleep::fake();
    }

    /**
     * Configure the application's Vite usage.
     */
    private function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }
}
