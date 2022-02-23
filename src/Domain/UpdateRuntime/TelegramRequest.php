<?php

declare(strict_types=1);

namespace Viktorprogger\TelegramBot\Domain\UpdateRuntime;

use Viktorprogger\TelegramBot\Domain\Entity\User\User;

final class TelegramRequest
{
    private array $attributes = [];

    public function __construct(
        public readonly string $chatId,
        public readonly string $messageId,
        public readonly string $requestData,
        public readonly User $user,
        public readonly ?string $callbackQueryId = null,
    ) {
    }

    public function getAttribute(string $attribute): mixed
    {
        return $this->attributes[$attribute] ?? null;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function withAttribute(string $attribute, string $value): self
    {
        $instance = $this->getNewRequest();
        $instance->attributes[$attribute] = $value;

        return $instance;
    }

    public function withoutAttribute(string $attribute): self
    {
        if (isset($this->attributes[$attribute])) {
            $instance = $this->getNewRequest();
            unset($instance->attributes[$attribute]);

            return $instance;
        }

        return $this;
    }

    /**
     * @return TelegramRequest
     */
    private function getNewRequest(): TelegramRequest
    {
        return new self(
            $this->chatId,
            $this->messageId,
            $this->requestData,
            $this->user,
            $this->callbackQueryId,
        );
    }
}
