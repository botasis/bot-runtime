<?php

declare(strict_types=1);

namespace Viktorprogger\TelegramBot\Domain\UpdateRuntime;

use Viktorprogger\TelegramBot\Domain\Client\ResponseInterface;
use Viktorprogger\TelegramBot\Domain\Client\TelegramCallbackResponse;use Viktorprogger\TelegramBot\Domain\Client\TelegramClientInterface;

final readonly class Emitter
{
    public function __construct(private TelegramClientInterface $client)
    {
    }

    public function emit(ResponseInterface $response): void
    {
        $callbackResponse = $response->getCallbackResponse();
        if ($callbackResponse !== null) {
            $data = [
                'callback_query_id' => $callbackResponse->id,
                'show_alert' => $callbackResponse->showAlert,
                'cache_time' => $callbackResponse->cacheTime,
            ];

            if ($callbackResponse->text !== null) {
                $data['text'] = $callbackResponse->text;
            }

            $url = $callbackResponse->url;
            if ($url !== null) {
                $data['url'] = $url;
            }
            $this->client->send(
                'answerCallbackQuery',
                $data,
            );
        }

        foreach ($response->getMessageUpdates() as $message) {
            $this->client->updateMessage($message);
        }

        foreach ($response->getKeyboardUpdates() as $message) {
            $this->client->updateKeyboard($message);
        }

        foreach ($response->getMessages() as $message) {
            $this->client->sendMessage($message);
        }
    }
}
