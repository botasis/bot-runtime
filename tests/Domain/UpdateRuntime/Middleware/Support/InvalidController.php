<?php

declare(strict_types=1);

namespace Viktorprogger\TelegramBot\Tests\Domain\UpdateRuntime\Middleware\Support;

final class InvalidController
{
    public function index(): int
    {
        return 200;
    }
}
