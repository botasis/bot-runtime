<?php

declare(strict_types=1);

namespace Botasis\Runtime\State;

use Botasis\Runtime\Middleware\MiddlewareInterface;
use Botasis\Runtime\Response\ResponseInterface;
use Botasis\Runtime\Update\Update;
use Botasis\Runtime\UpdateHandlerInterface;

final readonly class StateMiddleware implements MiddlewareInterface
{
    public function __construct(private StateRepositoryInterface $repository)
    {
    }

    public function process(Update $update, UpdateHandlerInterface $handler): ResponseInterface
    {
        $state = $this->repository->find($update->user?->id, $update->chat?->id);

        return $handler->handle($update->withAttribute(self::class, $state));
    }
}
