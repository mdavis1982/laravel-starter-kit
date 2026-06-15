<?php

declare(strict_types=1);

use App\Filament\Providers\AvatarProvider;
use App\Models\User;
use Filament\AvatarProviders\UiAvatarsProvider;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

function fakeAvatarFallback(): UiAvatarsProvider
{
    return new class extends UiAvatarsProvider
    {
        public function get(Model|Authenticatable $record): string
        {
            return 'https://fallback.test/avatar.svg';
        }
    };
}

it('returns an explicitly set avatar attribute', function (): void {
    $provider = new AvatarProvider(fakeAvatarFallback());

    $user = new User(['avatar' => 'https://example.com/me.png', 'email' => 'ada@example.com']);

    expect($provider->get($user))
        ->toBe('https://example.com/me.png');
});

it('builds a gravatar initials url from the normalised email', function (): void {
    $provider = new AvatarProvider(fakeAvatarFallback());

    $user = new User(['email' => ' ADA@Example.com ', 'name' => 'Ada Lovelace']);

    expect($provider->get($user))
        ->toBe(sprintf(
            'https://www.gravatar.com/avatar/%s?d=initials&name=Ada+Lovelace',
            hash('sha256', 'ada@example.com'),
        ));
});

it('falls through to gravatar when the avatar attribute is empty', function (): void {
    $provider = new AvatarProvider(fakeAvatarFallback());

    $user = new User(['avatar' => '', 'email' => 'ada@example.com', 'name' => 'Ada']);

    expect($provider->get($user))
        ->toBe(sprintf(
            'https://www.gravatar.com/avatar/%s?d=initials&name=Ada',
            hash('sha256', 'ada@example.com'),
        ));
});

it('falls back to the fallback provider when the model has no email', function (): void {
    $provider = new AvatarProvider(fakeAvatarFallback());

    $user = new User(['name' => 'Ada']);

    expect($provider->get($user))
        ->toBe('https://fallback.test/avatar.svg');
});

it('falls back to the fallback provider for non-model authenticatables', function (): void {
    $provider = new AvatarProvider(fakeAvatarFallback());

    $record = new GenericUser(['id' => 1, 'email' => 'ada@example.com']);

    expect($provider->get($record))
        ->toBe('https://fallback.test/avatar.svg');
});
