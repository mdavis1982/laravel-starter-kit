<?php

declare(strict_types=1);

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Str;

it('has the correct columns', function (): void {
    expect('users')->toHaveColumns([
        'id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ]);
});

it('casts columns to the correct types', function (string $column, string $type): void {
    $user = User::factory()->create();

    $assertion = Str::contains($type, '\\') ? 'toBeInstanceOf' : 'toBe' . Str::ucfirst($type);

    expect($user->$column)->$assertion($type);
})->with([
    ['id', 'int'],
    ['name', 'string'],
    ['email', 'string'],
    ['email_verified_at', CarbonImmutable::class],
    ['password', 'string'],
    ['remember_token', 'string'],
    ['created_at', CarbonImmutable::class],
    ['updated_at', CarbonImmutable::class],
]);
