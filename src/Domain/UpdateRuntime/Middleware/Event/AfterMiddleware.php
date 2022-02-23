<?php

declare(strict_types=1);

namespace Viktorprogger\TelegramBot\Domain\UpdateRuntime\Middleware\Event;

use Viktorprogger\TelegramBot\Domain\Client\ResponseInterface;
use Viktorprogger\TelegramBot\Domain\UpdateRuntime\Middleware\MiddlewareInterface;

/**
 * AfterMiddleware event is raised after a middleware was executed.
 */
final class AfterMiddleware
{
    private MiddlewareInterface $middleware;
    private ?ResponseInterface $response;

    /**
     * @param MiddlewareInterface $middleware Middleware that was executed.
     * @param ResponseInterface|null $response Response generated by middleware or null in case there was an error.
     */
    public function __construct(MiddlewareInterface $middleware, ?ResponseInterface $response)
    {
        $this->middleware = $middleware;
        $this->response = $response;
    }

    /**
     * @return MiddlewareInterface Middleware that was executed.
     */
    public function getMiddleware(): MiddlewareInterface
    {
        return $this->middleware;
    }

    /**
     * @return ResponseInterface|null Response generated by middleware or null in case there was an error.
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
