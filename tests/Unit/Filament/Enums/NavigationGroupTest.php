<?php

declare(strict_types=1);

use App\Filament\Enums\NavigationGroup;
use Filament\Support\Contracts\HasLabel;

it('has the correct number of cases', function (): void {
    expect(NavigationGroup::cases())
        ->toHaveCount(1);
});

it('contains the correct cases', function (NavigationGroup $group): void {
    expect(NavigationGroup::cases())
        ->toContain($group);
})->with([
    NavigationGroup::Content,
]);

it('returns the correct labels', function (NavigationGroup $group, string $label): void {
    expect($group->label())
        ->toBe($label);
})->with([
    [NavigationGroup::Content, 'Content'],
]);

it('implements the Filament HasLabel contract', function (): void {
    expect(NavigationGroup::class)
        ->toImplement(HasLabel::class);
});
