<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function shouldHaveCalledAction(string $action): void
    {
        $original = $this->app->make($action);

        $this->mock($action)
            ->shouldReceive('__invoke')
            ->atLeast()->once()
            ->andReturnUsing(fn (...$args) => $original(...$args));
    }

    public function shouldNotHaveCalledAction(string $action): void
    {
        $this->mock($action)
            ->shouldNotReceive('__invoke');
    }
}
