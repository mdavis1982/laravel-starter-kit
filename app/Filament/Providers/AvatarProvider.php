<?php

declare(strict_types=1);

namespace App\Filament\Providers;

use Filament\AvatarProviders\Contracts\AvatarProvider as FilamentAvatarProvider;
use Filament\AvatarProviders\UiAvatarsProvider;
use Filament\Facades\Filament;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final readonly class AvatarProvider implements FilamentAvatarProvider
{
    public function __construct(private UiAvatarsProvider $fallbackProvider) {}

    public function get(Model|Authenticatable $record): string
    {
        if (! $record instanceof Model) {
            return $this->fallbackProvider->get($record);
        }

        return $this->customAvatar($record)
            ?? $this->gravatar($record)
            ?? $this->fallbackProvider->get($record);
    }

    private function customAvatar(Model $record): ?string
    {
        if (! $record->hasAttribute('avatar')) {
            return null;
        }

        $avatar = $record->getAttribute('avatar');

        return is_string($avatar) && $avatar !== '' ? $avatar : null;
    }

    private function gravatar(Model $record): ?string
    {
        if (! $record->hasAttribute('email')) {
            return null;
        }

        $email = $record->getAttribute('email');

        if (! is_string($email) || $email === '') {
            return null;
        }

        // Gravatar renders an initials avatar for the given name when no account
        // exists for the hash, so it doubles as the fallback for unknown emails.
        return sprintf(
            'https://www.gravatar.com/avatar/%s?d=initials&name=%s',
            hash('sha256', Str::of($email)->trim()->lower()->toString()),
            urlencode(Filament::getNameForDefaultAvatar($record)),
        );
    }
}
