<?php

declare(strict_types=1);

namespace Viktorprogger\TelegramBot\Domain\UpdateRuntime\Middleware\Event;

use Viktorprogger\TelegramBot\Domain\Client\ResponseInterface;
use Viktorprogger\TelegramBot\Domain\UpdateRuntime\Middleware\MiddlewareInterface;

/**
 * AfterMiddleware event is raised after a middleware was executed.
 */
final readonly class AfterMiddleware
{
    /**
     * @param MiddlewareInterface $middleware Middleware that was executed.
     * @param ResponseInterface|null $response Response generated by middleware or null in case there was an error.
     */
    public function __construct(
        public MiddlewareInterface $middleware,
        public ?ResponseInterface $response
    ) {
    }
}
