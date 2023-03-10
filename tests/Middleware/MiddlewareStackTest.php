<?php

declare(strict_types=1);

namespace Botasis\Runtime\Tests\Middleware;

use Botasis\Runtime\Entity\User\User;
use Botasis\Runtime\Entity\User\UserId;
use Botasis\Runtime\Middleware\MiddlewareStack;
use Botasis\Runtime\Update\Update;
use Botasis\Runtime\Update\UpdateId;
use Botasis\Runtime\UpdateHandlerInterface;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Yiisoft\Test\Support\EventDispatcher\SimpleEventDispatcher;

final class MiddlewareStackTest extends TestCase
{
    public function testHandleEmpty(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Stack is empty.');

        $request = new Update(
            new UpdateId(123),
            'chatId',
            'messageId',
            'data',
            new User(
                new UserId('user-id'),
                false,
                'testUser',
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ),
            []
        );
        $stack = new MiddlewareStack([], $this->createMock(UpdateHandlerInterface::class), new SimpleEventDispatcher()
        );
        $stack->handle($request);
    }
}